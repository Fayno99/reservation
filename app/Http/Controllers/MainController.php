<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Master_schedule;
use App\Models\User;
use App\Models\Work_order;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use function Symfony\Component\String\s;

class MainController extends Controller
{
    public function index()
    {
        $reviews = \App\Models\Review::with('master')->get();

        $masters = \App\Models\Master::with('companies')->get();

        $service = \App\Models\Work::all();

        return view('index', ['reviewList' => $reviews, 'masterList' => $masters, 'serviceList' => $service]);
    }


    public function timeSlot($interval)
    {
        $start = new DateTime();
        $start->setTime(8, 0);
        $end = clone $start;
        $end->add(new DateInterval('P14D'))->setTime(18, 0);
        return $this->getTimeSlots($interval, $start, $end);
    }


    private function getTimeSlots(int $interval, DateTime $start, DateTime $end)
    {
        $totalInterval = new DateInterval("PT" . ($interval + 10) . "M");
        $timeSlots = [];


        while ($start < $end) {
            $endOfDay = (clone $start)->setTime(17, 00);

            if ($start > $endOfDay) {
                $start->add(new DateInterval('P1D'))->setTime(8, 0);
                continue;
            }

            $periods = new DatePeriod($start, $totalInterval, $endOfDay);

            foreach ($periods as $period) {
                $slotStart = clone $period;
                $slotEnd = (clone $period)->add(new DateInterval("PT{$interval}M"));

                $startHour = $slotStart->format('H');

                if ($startHour == '12') {
                    $start->add(new DateInterval('PT1H'));
                    continue;
                }

                $date = $slotStart->format('Y-m-d');
                if (!isset($timeSlots[$date])) {
                    $timeSlots[$date] = [];
                }

                $masterId = Session::get('master_id');
                $existingSlot = Master_schedule::where('masters_id', $masterId)
                    ->where('work_day', $date)
                    ->first();

                if (!$existingSlot) {
                    $timeSlots[$date][] = [
                        'start_time' => $slotStart->format('H:i'),
                        'end_time' => $slotEnd->format('H:i'),
                    ];
                }
            }

            $start = $endOfDay->add(new DateInterval('PT10M'));
        }

        $workOrders = Work_order::where('masters_id', $masterId)->get();

        foreach ($timeSlots as $date => $slots) {
            foreach ($slots as $key => $slot) {
                $isSetWork = $workOrders->first(function ($workOrder) use ($slot, $date) {
                    $startOrder = Carbon::createFromFormat('Y-m-d H:i:s', $date . ' ' . $slot['start_time'] . ':00');
                    $stopOrder = Carbon::createFromFormat('Y-m-d H:i:s', $date . ' ' . $slot['end_time'] . ':00');
                    $workOrderStart = Carbon::createFromFormat('Y-m-d H:i:s', $workOrder->start_order);
                    $workOrderEnd = Carbon::createFromFormat('Y-m-d H:i:s', $workOrder->stop_order);
                    return $startOrder->between($workOrderStart, $workOrderEnd) || $stopOrder->between($workOrderStart, $workOrderEnd);
                });

                if ($isSetWork) {
                    unset($timeSlots[$date][$key]);
                }
            }
        }

        return view('timeSlots', ['timeSlots' => $timeSlots]);
    }


    public function about()
    {
        return view('about');
    }

    public function services()
    {
        $review = \App\Models\Review::all();
        $master = \App\Models\Master::all();
        $service = \App\Models\Work::all();
        $user_id = Session::get('master_id');
        return view('services', ['reviewList' => $review, 'masterList' => $master, 'serviceList' => $service]);
    }

    public function master()
    {

        $master = \App\Models\Master::all();

        return view('master', ['masterList' => $master]);
    }


    public function saveMasterId($masterId)
    {
        Session::put('master_id', $masterId);

        return redirect()->route('services');
    }


    public function saveWorkId($interval, $workId)
    {
        Session::put('service_id', $workId);
        Session::put('service_time_for_work', $interval);

        return redirect()->route('timeSlot', [$interval, $workId]);
    }

    public function order($start, $stop)
    {
        Session::put('start-time', $start);
        Session::put('end-time', $stop);

        return view('order', [$start, $stop]);
    }

    public function store(Request $request)
    {
        $userId = '0';
        $clientId = '1';
        if (Auth::check()) {
            $userId = Auth::id();

        } else {
            $client = new Client();
            $client->name = $request->input('name');
            $client->email = $request->input('email');
            $client->telephone = $request->input('telephone');

            $client->save();
            Session::put('id_client', $client->id);
            $clientId = Session::get('id_client');
        }


        $startTime = Session::get('start-time');
        $endTime = Session::get('end-time');
        $masterId = Session::get('master_id');
        $serviceId = Session::get('service_id');


        $order = new Work_order();
        $order->companies_id = (1);
        $order->masters_id = $masterId;
        $order->clients_id = $clientId;
        $order->users_id = $userId;
        $order->works_id = $serviceId;
        $order->motorcycles = $request->input('motorcycles');
        $order->start_order = $startTime;
        $order->stop_order = $endTime;
        $order->save();

        Session::put('orderId', $order->id);

        return redirect()->route('confirm')->with('success', 'Користувача успішно збережено, ваш запит на послугу створений.');
    }

    public function ShowWorkOrder(Request $request)
    {
        $id = Session::get('orderId');
        $work_orders = \App\Models\Work_order::with('master', 'companies', 'client', 'work')->where('id', $id)->get();

        return view('confirm', ['work_order' => $work_orders]);
    }

    public function schedules()
    {
        $schedules = \App\Models\Work_order::with('master', 'companies', 'client', 'user', 'work')
            ->orderBy('masters_id')
            ->orderBy('start_order')
            ->get();

        $groupedSchedules = $schedules->groupBy(function ($item, $key) {
            return $item->master->name;
        });
//dd($groupedSchedules);
        return view('schedules', ['schedules' => $groupedSchedules]);
    }


    public function userHistory(Request $request, $id)
    {
        $histories = \App\Models\Work_order::with('master', 'companies', 'client', 'work')->where('users_id', $id)->get();

        return view('userHistory', ['historyList' => $histories]);

    }

    public function adminListUser(Request $request)
    {
        $adminList = \App\Models\User::get();

        // Заміна числових значень на назви ролей
        foreach ($adminList as $admin) {
            switch ($admin->isAdmin) {
                case \App\Models\User::ROLE_ADMIN:
                    $admin->isAdmin = 'ADMIN';
                    break;
                case \App\Models\User::ROLE_USER:
                    $admin->isAdmin = 'USER';
                    break;
                case \App\Models\User::ROLE_MANAGER:
                    $admin->isAdmin = 'MANAGER';
                    break;
                case \App\Models\User::ROLE_ASSISTANT:
                    $admin->isAdmin = 'ASSISTANT';
                    break;
                default:
                    $admin->isAdmin = 'UNKNOWN';
            }
        }
        return view('adminList', ['adminList' => $adminList]);

    }

    public function adminListChange(Request $request, $id,$status)
    {
        $client = User::find($id);
        if($client){
            $client->isAdmin = $status;
            $client->save();
        }
       // dd($client);
      return redirect()->route('adminListUser');
    }
}
