<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use App\Models\Master;
use App\Models\Master_schedule;
use App\Models\Review;
use App\Models\TemporaryOrder;
use App\Models\Work;
use App\Models\Work_order;
use App\Services\MainService;
use App\Services\TimeSlotsService;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    protected $mainService;
    protected $timeSlotService;

    public function __construct(MainService $mainService, TimeSlotsService $timeSlotService)
    {
        $this->mainService = $mainService;
        $this->timeSlotService = $timeSlotService;
    }

    public function index()
    {
        $allData = $this->mainService->index();
        return response()->json(
            ['reviewList' => $allData['reviews'],
                'masterList' => $allData["masters"],
                'serviceList' => $allData ['service']]);
    }


    public function companies()
    {
        $companies = Company::all();
        return response()->json($companies);
    }

    public function master($companyId)
    {
        $masters = Master::where('companies_id', $companyId)->get();

        return response()->json($masters);
    }

    public function services()
    {
        $service = Work::all();
        return response()->json($service);
    }


    public function timeSlot($interval, $masterId)
    {
        $timeSlots = $this->timeSlotService->timeSlot($interval, $masterId);
        return response()->json($timeSlots);
    }

    private function getSessionId(Request $request)
    {
        return $request->header('X-Session-ID') ?? Str::uuid()->toString();
    }

    public function selectData(Request $request)
    {
        $sessionId = $this->getSessionId($request);

        $tempOrder = TemporaryOrder::firstOrNew(['session_id' => $sessionId]);
        $client = new Client();
        if ($request->has('companies_id')) {
            $tempOrder->companies_id = $request->input('companies_id');
            $tempOrder->masters_id = $request->input('masters_id');

        }
        if ($request->has('masters_id')) {
            $tempOrder->masters_id = $request->input('masters_id');
            $tempOrder->works_id = $request->input('works_id');

        }
        if ($request->has('works_id')) {
            $tempOrder->works_id = $request->input('works_id');
            $tempOrder->start_order = $request->input('start_order');

        }
        if ($request->has('time_slot')) {
            $tempOrder->start_order = $request->input('start_order');
            $tempOrder->stop_order = $request->input('stop_order');
        }
        if ($request->has('client')) {
            $client->name = $request->input('name');
            $client->email = $request->input('email');
            $client->telephone = $request->input('telephone');
            $tempOrder->motorcycles = $request->input('motorcycles');
            $client->save();
            $tempOrder->clients_id = $client->id;
            $tempOrder->users_id = 1;

        }
        $tempOrder->save();

        if (!$tempOrder->companies_id) {
            return response()->json(['next_step' => 'select_company', 'error' => 'Company data is missing'], 400);
        }
        if ($tempOrder->companies_id && !$tempOrder->masters_id) {
            return response()->json(['next_step' => 'select_master', 'session_id' => $sessionId]);
        }
        if ($tempOrder->companies_id && $tempOrder->masters_id && !$tempOrder->works_id) {
            return response()->json(['next_step' => 'select_service']);
        }
        if ($tempOrder->companies_id && $tempOrder->masters_id && $tempOrder->works_id && !$tempOrder->start_order && !$tempOrder->stop_order) {
            return response()->json(['next_step' => 'select_time_slot']);
        }
        if ($tempOrder->companies_id && $tempOrder->masters_id && $tempOrder->works_id && $tempOrder->start_order && $tempOrder->stop_order && !$tempOrder->clients_id) {

            return response()->json(['next_step' => 'enter_user_data']);
        }

        if ($tempOrder->companies_id && $tempOrder->masters_id && $tempOrder->works_id && $tempOrder->start_order && $tempOrder->stop_order && $tempOrder->clients_id) {
            return response()->json(['message' => 'All data collected. Ready to submit order.']);
        }

        return response()->json(['error' => 'Invalid data'], 400);
    }

    public function submitOrder(Request $request)
    {
        $sessionId = $this->getSessionId($request);
        $tempOrder = TemporaryOrder::where('session_id', $sessionId)->first();

        if (!$tempOrder) {
            return response()->json(['error' => 'No order data found'], 400);
        }
        $order = Work_order::create([
            'companies_id' => $tempOrder->companies_id,
            'masters_id' => $tempOrder->masters_id,
            'works_id' => $tempOrder->works_id,
            'start_order' => $tempOrder->start_order,
            'stop_order' => $tempOrder->stop_order,
            'clients_id' => $tempOrder->clients_id,
            'motorcycles' => $tempOrder->motorcycles,
            'users_id' => $tempOrder->users_id,
        ]);

        $tempOrder->delete();

        return response()->json(['message' => 'Order submitted successfully', 'order_id' => $order->id]);
    }

}
