<?php

namespace App\Http\Controllers;

use App\Models\Master_schedule;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;

class DayOffController extends Controller
{
    public function TotalDayOff()
    {
        $masterSchedules= \App\Models\Master_schedule::with('master')->get();

        $Master = \App\Models\Master::all();

        return view('dayOff', ['masterSchedules' => $masterSchedules, 'Masters' => $Master ]);
    }
    public function SaveDayOffSlot($dayStart,  $workerId, $dayOffInterval,)
    {
        $start = new DateTime($dayStart); // Сьогоднішня дата
        $end = clone $start; // Клонуємо початкову дату
        $end->add(new DateInterval("P{$dayOffInterval}D"));

        $totalDeyOff = [];

        while ($start <= $end) {
            $totalDeyOff[] = [
                'dayOff' => $start->format('Y-m-d'),
                'WorkerId' => $workerId,
            ];
            $start->add(new DateInterval('P1D')); // Додаємо один день
        }

        foreach ($totalDeyOff as $dayOffSlot) {
            $masterSchedule = new Master_schedule();
            $masterSchedule->masters_id = $dayOffSlot['WorkerId'];
            $masterSchedule->work_day = $dayOffSlot['dayOff'];
            $masterSchedule->save();
        }


        return view('DayOffSave', ['dayOffSlots' => $totalDeyOff]);
    }

}


