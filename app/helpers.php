<?php

function days(){
    return ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabádo'];
}

function employeeWorksOnDay($employee, $dayOfWeek){
    return in_array($dayOfWeek, $employee->works_on_days_of_week);
}

function employeeBadger($employee, $dayOfWeek){
    return employeeWorksOnDay($employee, $dayOfWeek) ? 'badge-success' : 'badge-danger';
}

function parseMinutesToTimeString($minutes){
    $hours = floor($minutes / 60);
    $minutes = $minutes % 60;

    return str_pad($hours, 2, '0', STR_PAD_LEFT).':'.str_pad($minutes, 2, '0', STR_PAD_LEFT);
}

function employeeGetShiftForDay($employee, $dayOfWeek){
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

    $hours = intval($groups[0]);
    $minutes = intval($groups[1]);

    $minutes += $hours * 59;

    return $minutes;
}
