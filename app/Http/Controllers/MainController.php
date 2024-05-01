<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Master_schedule;
use App\Models\Work_order;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use function Symfony\Component\String\s;

class MainController extends Controller
{
    public function index()
    {

        $reviews = \App\Models\Review::with('master')->get();
        $reviewList = [];
        foreach ($reviews as $review)
        {
            $review->masterName = $review->master->name;
            unset($review->masters_id);
            $reviewList[] = $review;
        }
        //dd($reviewList);
      $masters= \App\Models\Master::with('companies')->get();
        $masterList=[];
        foreach ($masters as $master)
        {
            $master->CompaniesName=$master->companies->name;
            unset($master->companies_id);
            $masterList[] = $master;
        }
     //   dd($masterList);
        $service = \App\Models\Work::all();
//dd($review,$master);

return view('index', ['reviewList'=>$reviewList,'masterList'=>$masterList, 'serviceList'=>$service]);
    }


    public function timeSlot( $interval)
    {
       // dd($interval);
        $start = new DateTime(); // Сьогоднішня дата
        $start->setTime(8, 0); // Початок робочого дня
        $end = clone $start; // Клонуємо початкову дату
        $end->add(new DateInterval('P14D'))->setTime(18, 0); // Додаємо 14 днів і встановлюємо час закінчення робочого дня

        return $this->getTimeSlots($interval, $start, $end);
    }


    private function getTimeSlots(int $interval, DateTime $start, DateTime $end)
    {
        $totalInterval = new DateInterval("PT" . ($interval + 10) . "M"); // Додаємо 10 хвилин до інтервалу
        $timeSlots = [];



        while ($start < $end) {
            $endOfDay = (clone $start)->setTime(17, 00);

            if ($start > $endOfDay) {
                $start->add(new DateInterval('P1D'))->setTime(8, 0);
                continue;
            }

            $periods = new DatePeriod($start, $totalInterval, $endOfDay); // Використовуємо totalInterval замість interval

            foreach ($periods as $period) {
                $slotStart = clone $period; // Створюємо копію для збереження початкового значення
                $slotEnd = (clone $period)->add(new DateInterval("PT{$interval}M")); // Додаємо лише інтервал слоту часу, не включаючи перерву

                $startHour = $slotStart->format('H');

                if ($startHour == '12') {
                    $start->add(new DateInterval('PT1H'));
                    continue;
                }

                $date = $slotStart->format('Y-m-d');
                if (!isset($timeSlots[$date])) {
                    $timeSlots[$date] = [];
                }

                // Перевірка, чи існує вже запис у базі даних
                $masterId = Session::get('master_id');
                $existingSlot = Master_schedule::where('masters_id', $masterId)
                    ->where('work_day', $date)
                    ->first();

                if (!$existingSlot) {
                    $timeSlots[$date][] = [
                        'start_time' => $slotStart->format('H:i'),
                        'end_time'   => $slotEnd->format('H:i'),
                    ];
                }
            }

            $start = $endOfDay->add(new DateInterval('PT10M'));
        }
//dd($timeSlots);
        // Перевірка, чи існує вже Work_order з таким часом початку і кінця
        $workOrders = Work_order::where('masters_id', $masterId)->get();

        foreach ($timeSlots as $date => $slots) {
            foreach ($slots as $key => $slot) {
                $isSetWork = $workOrders->first(function ($workOrder) use ($slot, $date) {
                    $startOrder = Carbon::createFromFormat('Y-m-d H:i:s', $date . ' ' . $slot['start_time'] . ':00');
                    $stopOrder = Carbon::createFromFormat('Y-m-d H:i:s', $date . ' ' . $slot['end_time'] . ':00');
                    $workOrderStart = Carbon::createFromFormat('Y-m-d H:i:s', $workOrder->start_order);
                    $workOrderEnd = Carbon::createFromFormat('Y-m-d H:i:s', $workOrder->stop_order);
                    // Перевірка, чи перекриває новий слот часу існуючий слот часу
                    return $startOrder->between($workOrderStart, $workOrderEnd) || $stopOrder->between($workOrderStart, $workOrderEnd);
                });

                //  dd($isSetWork);
                if ($isSetWork) {
                    unset($timeSlots[$date][$key]);
                }
            }
        }
//dd($timeSlots);
        // return $timeSlots;
        return view('timeSlots',  ['timeSlots'=>$timeSlots]);
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
//dd($user_id);
        return view('services', ['reviewList'=>$review, 'masterList'=>$master,'serviceList'=>$service]);
    }

        public function master()
    {

        $master = \App\Models\Master::all();

        return view('master', ['masterList'=>$master]);
    }


    public function saveMasterId($masterId)
    {
        // Збережемо ідентифікатор майстра в сесії
        Session::put('master_id', $masterId);

        // Перенаправимо користувача на наступну сторінку
        return redirect()->route('services');
    }


    public function saveWorkId($interval,$workId)
    {
        Session::put('service_id', $workId);
        Session::put('service_time_for_work', $interval);
     //dd($workId,$interval);
        // Перенаправимо користувача на наступну сторінку
        return redirect()->route('timeSlot', [$interval,$workId]);
    }

    public function order($start,$stop)
    {
       Session::put('start-time',$start );
        Session::put('end-time',$stop );

      //  dd(session());

        return view ('order', [$start,$stop]);
    }

        public function store(Request $request)
    {
        $client = new Client();
        $client->name = $request->input('name');
        $client->password = bcrypt($request->input('password'));
        $client->email = $request->input('email');
        $client->telephone = $request->input('telephone');
        $client->Type_of_moto = $request->input('Type_of_moto');
        $client->save();
        Session::put('id_client',$client->id );

        $startTime = Session::get('start-time');
        $endTime = Session::get('end-time');
        $masterId = Session::get('master_id');
        $serviceId = Session::get('service_id');
        $clientId = Session::get('id_client');

        $order = new Work_order();
        $order->companies_id = (1);
        $order->masters_id = $masterId;
        $order->clients_id = $clientId ;
        $order->works_id = $serviceId;
        $order->start_order = $startTime;
        $order->stop_order = $endTime;
        $order->save();

        Session::put('orderId',$order->id );
       // dd(session(), $client, $order);

        return redirect()->route('confirm')->with('success', 'Користувача успішно збережено, ваш запит на послугу створений.' );
    }

    public function ShowWorkOrder(Request $request)
    {
        $id = Session::get('orderId');
      $work_order = \App\Models\Work_order::find($id);
        return  view('confirm', ['work_order'=>$work_order]);
    }

    public function schedules()
    {
       // $schedules = \App\Models\Work_order::all();

        $schedules = \App\Models\Work_order::with('master','companies','client','work')->get();
        $scheduleList = [];
        foreach ($schedules as $schedule)
        {
            $schedule->masterName = $schedule->master->name;
            $schedule->clientName = $schedule->client->name;
            $schedule->companiesName = $schedule->companies->name;
            $schedule->workName = $schedule->work->name_of_work;
            unset($schedule->masters_id);
            $scheduleList[] = $schedule;
        }
//dd($scheduleList);


        return view('schedules', ['schedules'=>$scheduleList]);
    }
}

