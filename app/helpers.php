<?php

function days(){
    return ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabádo'];
}

function employeeWorksOnDay($employee, $dayOfWeek){
    if($employee == null) return false;
    return in_array($dayOfWeek, $employee->works_on_days_of_week);
}

function employeeBadger($employee, $dayOfWeek){
    return employeeWorksOnDay($employee, $dayOfWeek) ? 'badge-success' : 'badge-danger';
}

function parseMinutesToTimeString($minutes){
    $hours = floor($minutes / 60);
    $min= $minutes % 60;

    return str_pad($hours, 2, '0', STR_PAD_LEFT).':'.str_pad($min, 2, '0', STR_PAD_LEFT);
}

function employeeGetShiftForDay($employee, $dayOfWeek){
    if($employee == null) return 0;

    return $employee->shifts->filter(function ($val) use ($dayOfWeek){
        return $val->day_of_week == $dayOfWeek;
    })->first();
}

function employeeGetStartTime($employee, $dayOfWeek){
    $minutes = intval(employeeGetShiftForDay($employee, $dayOfWeek)->start_time);
    return parseMinutesToTimeString($minutes);
}

function employeeGetEndTime($employee, $dayOfWeek){
    $minutes = intval(employeeGetShiftForDay($employee, $dayOfWeek)->end_time);
    return parseMinutesToTimeString($minutes);
}

function parseTimeStringToMinutes($timeStr){
    preg_match('/^(\d{2}):(\d{2})$/', $timeStr, $groups);

    $hours = intval(ltrim($groups[1], '0'));
    $minutes = intval(ltrim($groups[2], '0'));

    $minutes += $hours * 60;

    return $minutes;
}

/**
 * @param $shifts
 * @return array[]
 */
function getShiftsPerDayOfWeek($allShifts): array
{
    $dayOfWeekShifts = [
        0 => [],
        1 => [],
        2 => [],
        3 => [],
        4 => [],
        5 => [],
        6 => []
    ];


    $allShifts->groupBy('day_of_week')->each(function ($shifts, $day) use (&$dayOfWeekShifts) {
        $sortedPairs = $shifts->map(function ($item) {
            return ['start' => intval($item->start_time), 'end' => intval($item->end_time)];
        })->sortBy('start')->values();

        $start = $sortedPairs[0]["start"];
        $end = $sortedPairs[0]["end"];

        for ($i = 1; $i < sizeof($sortedPairs); ++$i) {
            $pair = $sortedPairs[$i];

            if ($end < $pair['start']) {
                $dayOfWeekShifts[$day][] = ['start' => $start, 'end' => $end];

                $start = $pair['start'];
                $end = $pair['end'];
            }

            $end = max($end, $pair['end']);
        }

        $dayOfWeekShifts[$day][] = ['start' => $start, 'end' => $end];

    });
    return $dayOfWeekShifts;
}
