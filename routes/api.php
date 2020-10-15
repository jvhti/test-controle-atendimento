<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('/employee', \App\Http\Controllers\EmployeeController::class);

Route::get('/simulate', function (Request $request){
    $timeInShift = 0;
    $timeOutOfShift = 0;

    $startDate= Carbon\Carbon::createFromFormat('d/m/Y G:i', $request->input('start'));
    $endDate= Carbon\Carbon::createFromFormat('d/m/Y G:i', $request->input('end'));

    $endDay = $startDate->isSameDay($endDate);
    $endMin = ($endDate->hour * 60) + $endDate->minute;

    $allShifts = \App\Models\Shift::all();

    $dayOfWeekShifts = getShiftsPerDayOfWeek($allShifts);

    $dayOfWeek = $startDate->dayOfWeek;

    $curMin = ($startDate->hour * 60) + $startDate->minute;

    $curShift = 0;
    $shift = $dayOfWeekShifts[$dayOfWeek][0] ?? ['start' => 0, 'end' => 1];
    while (true){
        if($endDay && $curMin == $endMin) break;

        if ($curMin < $shift['start'] && (!$endDay || $shift['start'] <= $endMin)){
            $timeOutOfShift += $shift['start'] - $curMin;
            $curMin = $shift['start'];
        } else if ($curMin < $shift['start'] && $endDay && $shift['start'] > $endMin){
            $timeOutOfShift += $endMin - $curMin;
            break;
        }else if ($curMin >= $shift['start'] && (!$endDay || $shift['end'] <= $endMin)){
            if($shift['end'] >= $curMin) {
                $timeInShift += $shift['end'] - $curMin;
                $curMin = $shift['end'];
            }

            if($curShift + 1 >= sizeof($dayOfWeekShifts[$dayOfWeek])){
                $first = true;
                do {
                    $timeOutOfShift += (!$first || !$endDay ? (24 * 60) : $endMin) - max($shift['end'], $curMin);
                    $first = false;
                    ++$dayOfWeek;
                    $startDate->setHours(0)->setMinutes(0)->addDay();
                    if ($startDate->isSameDay($endDate))
                        $endDay = true;
                    $curMin = 0;
                    $curShift = 0;
                    if($dayOfWeek > 6) $dayOfWeek = 0;
                }
                while(sizeof($dayOfWeekShifts[$dayOfWeek]) == 0 && $startDate < $endDate);
                if($startDate >= $endDate) break;
            }else {
                $curShift++;
            }
            $shift = $dayOfWeekShifts[$dayOfWeek][$curShift];
        } else if ($curMin >= $shift['start'] && $endDay && $shift['end'] > $endMin){
            $timeInShift += $endMin - $curMin;
            break;
        }

        if($curMin >= 24 * 60) {
            ++$dayOfWeek;
            $curMin = 0;
            $startDate->setHours(0)->setMinutes(0)->addDay();
            if($startDate->isSameDay($endDate))
                $endDay = true;
        }
    }

    return response()->json([
        'timeOutOfShift' => $timeOutOfShift,
        'timeInShift' => $timeInShift,
        'totalTime' => $timeOutOfShift + $timeInShift
    ]);
});
