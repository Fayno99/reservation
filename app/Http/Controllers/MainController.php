<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Master;
use App\Models\Master_schedule;
use App\Models\User;
use App\Models\Work_order;
use App\Services\MainService;
use App\Services\TimeSlotsService;
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

    protected $mainService;
    protected $timeSlotService;
    private $str;

    public function __construct(MainService $mainService, TimeSlotsService $timeSlotService)
    {
        $this->mainService = $mainService;
        $this->timeSlotService = $timeSlotService;
    }

    public function index()
    {
        $allData = $this->mainService->index();
        return view('index',
            ['reviewList' => $allData['reviews'],
                'masterList' => $allData["masters"],
                'serviceList' => $allData ['service']]
        );
    }


    public function timeSlot($interval, $test)
    {
        $timeSlots = $this->timeSlotService->timeSlot($interval, $test);
        return view('timeSlots', ['timeSlots' => $timeSlots]);
    }


    public function about()
    {
        return view('about');
    }

    public function services()
    {
        $servicesData = $this->mainService->services();

        return view('services',
            ['reviewList' => $servicesData['review'],
                'masterList' => $servicesData['master'],
                'serviceList' => $servicesData['service']]);
    }

    public function master()
    {

        $master = Master::all();

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
        $userId = '1';
        $this->str = '1';
        $clientId = $this->str;
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
        $work_orders = Work_order::with('master', 'companies', 'client', 'work')->where('id', $id)->get();

        return view('confirm', ['work_order' => $work_orders]);
    }

    public function schedules(Request $request)
    {
        $startDate = $request->myStartDate;
        $endDate = $request->myStopDate;

        if ($startDate == null && $endDate == null) {
            $start_date = Carbon::now();
            $end_date = Carbon::now()->addDays(14);
        } else {
            $start_date = Carbon::parse($startDate)->startOfDay();
            $end_date = Carbon::parse($endDate)->endOfDay();
        }

        $schedules = Work_order::with('master', 'companies', 'client', 'user', 'work')
            ->whereBetween('start_order', [$start_date, $end_date]) // Умова для дати
            ->orderBy('masters_id')
            ->orderBy('start_order')
            ->get();

        $groupedSchedules = $schedules->groupBy(function ($item, $key) {
            return $item->master->name;
        });

        return view('schedules', [
            'schedules' => $groupedSchedules,
            'start_date' => $start_date,
            'end_date' => $end_date,
            ]);
    }


    public function userHistory(Request $request, $id)
    {
        $histories = Work_order::with('master', 'companies', 'client', 'work')->where('users_id', $id)->get();

        return view('userHistory', ['historyList' => $histories]);

    }


}
