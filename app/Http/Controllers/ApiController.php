<?php

namespace App\Http\Controllers;
use App\Models\Client;
use App\Models\Master_schedule;
use App\Models\Review;
use App\Models\TemporaryOrder;
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
     $allData=$this->mainService->index();
     return response()->json(
         ['reviewList' => $allData['reviews'],
         'masterList' => $allData["masters"],
         'serviceList' => $allData ['service']]);
 }

    public function services()
    {
        $service = \App\Models\Work::all();
return response()->json($service);
    }
    public function companies()
    {
        $companies = \App\Models\Company::all();
        return response()->json($companies);
    }
    public function master()
    {
        $master = \App\Models\Master::all();
return response()->json($master);
    }



    public function timeSlot($interval,$test)
    {
    $timeSlots = $this->timeSlotService->timeSlot($interval,$test);
       return response()->json($timeSlots);
    }

    private function getSessionId(Request $request)
    {
        return $request->header('X-Session-ID') ?? Str::uuid()->toString();
    }

    public function selectCompanies(Request $request)
    {
        $companiesId = $request->input('companies_id');
        $sessionId = $this->getSessionId($request);
        TemporaryOrder::updateOrCreate(
            ['session_id' => $sessionId],
            [
                'companies_id' => $companiesId
            ]
        );
        return response()->json(['data' => $companiesId, 'session_id'=>$sessionId ]);
    }

    public function selectMasterId(Request $request)
    {
        $sessionId = $this->getSessionId($request);
        $masterId = $request->input('masters_id');

        TemporaryOrder::updateOrCreate(
            ['session_id' => $sessionId],
            ['masters_id' => $masterId,]
        );

        return response()->json(['masters_id' => $masterId, 'session_id' => $sessionId]);
    }

    public function selectService(Request $request)
    {
        $sessionId = $this->getSessionId($request);
        $workId = $request->input('works_id');

        TemporaryOrder::updateOrCreate(
            ['session_id' => $sessionId],
            ['works_id' => $workId]
        );

        return response()->json(['workId' => $workId, 'session_id' => $sessionId]);
    }

    public function selectDataTime(Request $request)
    {
        $sessionId = $this->getSessionId($request);
        $startOrder = $request->input('start_order');
        $stopOrder = $request->input('stop_order');

        TemporaryOrder::updateOrCreate(
            ['session_id' => $sessionId],
            ['start_order' => $startOrder,
            'stop_order' => $stopOrder],
        );

        $array=[
            "start_order" => $startOrder,
            "stop_order" => $stopOrder
        ];

        return response()->json(['data' => $array, 'session_id' => $sessionId]);
    }


    public function selectUserData(Request $request)
    {
        $sessionId = $this->getSessionId($request);
        $name = $request->input('name');
        $email = $request->input('email');
        $telephone = $request->input('telephone');
        $typeOfMoto = $request->input('typeOfMoto');

        $user = new Client();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->telephone = $request->input('telephone');
        $user->save();
        $clientId = $user->id;

        TemporaryOrder::updateOrCreate(
            ['session_id' => $sessionId],
            ['clients_id'=> $clientId,
            'motorcycles' => $typeOfMoto]
        );

        $array = [
            "name" => $name,
            "email" => $email,
            "telephone" => $telephone,
            "typeOfMoto" => $typeOfMoto,
            'clients_id'=> $clientId

        ];

        return response()->json(['data' => $array, 'session_id' => $sessionId]);
    }



    public function submitOrder(Request $request)
    {
        $sessionId = $this->getSessionId($request);
        $temporaryOrder = TemporaryOrder::where('session_id', $sessionId)->first();
        if ($temporaryOrder) {
            $orderData = $temporaryOrder->toArray();
            unset($orderData['id'], $orderData['session_id'], $orderData['created_at'], $orderData['updated_at']);
             Work_order::create($orderData);
            $temporaryOrder->delete();
            return response()->json(['message' => 'Order has been submitted and saved successfully']);
        }
        return response()->json(['message' => 'Some data is missing'], 400);
    }


}
