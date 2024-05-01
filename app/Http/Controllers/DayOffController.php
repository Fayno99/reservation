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
        $MasterSchedules= \App\Models\Master_schedule::with('master')->get();
        $MasterSchedulesList = [];
        foreach ($MasterSchedules as $MasterSchedule)
        {
            $MasterSchedule->masterName = $MasterSchedule->master->name;
            unset($MasterSchedule->masters_id);
            $MasterSchedulesList[] = $MasterSchedule;
        }
     //   dd($MasterSchedulesList);


        $Master = \App\Models\Master::all();

        return view('dayOff', ['MasterSchedules' => $MasterSchedulesList, 'Masters' => $Master ]);
    }
    public function SaveDayOffSlot($dayStart,  $WorkerId, $DayOffInterval,)
    {
        $start = new DateTime($dayStart); // Сьогоднішня дата
        $end = clone $start; // Клонуємо початкову дату
        $end->add(new DateInterval("P{$DayOffInterval}D"));

        $totalDeyOff = [];

        while ($start <= $end) {
            $totalDeyOff[] = [
                'dayOff' => $start->format('Y-m-d'),
                'WorkerId' => $WorkerId,
            ];
            $start->add(new DateInterval('P1D')); // Додаємо один день
        }

        foreach ($totalDeyOff as $dayOffSlot) {
            $masterSchedule = new Master_schedule();
            $masterSchedule->masters_id = $dayOffSlot['WorkerId'];
            $masterSchedule->work_day = $dayOffSlot['dayOff'];
            $masterSchedule->save();
        }


        return view('DayOffSave', ['DayOffSlots' => $totalDeyOff]);
    }

}


