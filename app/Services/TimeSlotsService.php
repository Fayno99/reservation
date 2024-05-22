<?php

namespace App\Services;

use DateTime;
use DateInterval;
use DatePeriod;
use Session;
use Carbon\Carbon;
use App\Models\Master_schedule;
use App\Models\Work_order;

class TimeSlotsService
{
    public function timeSlot($interval,$idMaster)
    {
        $start = new DateTime();
        $start->setTime(8, 0);
        $end = clone $start;
        $end->add(new DateInterval('P14D'))->setTime(18, 0);
        return $this->getTimeSlots($interval, $start, $end, $idMaster);
    }
    public  function getTimeSlots(int $interval, DateTime $start, DateTime $end, $idMaster)
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
                $masterId = session()->has('master_id') ? session()->get('master_id') : $idMaster;

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
        return $timeSlots;
       }

}
