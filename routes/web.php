<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $dayOfWeekShifts = [
        0 => [],
        1 => [],
        2 => [],
        3 => [],
        4 => [],
        5 => [],
        6 => []
    ];

    $allShifts = \App\Models\Shift::all();

    $allShifts->groupBy('day_of_week')->each(function ($shifts, $day) use (&$dayOfWeekShifts){
        $sortedPairs = $shifts->map(function ($item) {
            return ['start'=> intval($item->start_time), 'end' => intval($item->end_time)];
        })->sortBy('start')->values();

        $start = $sortedPairs[0]["start"];
        $end = $sortedPairs[0]["end"];

        for($i = 1; $i < sizeof($sortedPairs); ++$i){
            $pair = $sortedPairs[$i];

            if($end < $pair['start']) {
                $dayOfWeekShifts[$day][] = ['start'=> $start, 'end' => $end];

                $start = $pair['start'];
                $end = $pair['end'];
            }

            $end = max($end, $pair['end']);
        }

        $dayOfWeekShifts[$day][] = ['start'=> $start, 'end' => $end];

    });

    $maxShifts = collect($dayOfWeekShifts)->map(function ($el){
        return sizeof($el);
    })->max();

    if(request()->ajax())
        return view('home')->with(['dayOfWeekShifts' => $dayOfWeekShifts, 'maxShifts' => $maxShifts])->renderSections()['content'];
    return view('home')->with(['dayOfWeekShifts' => $dayOfWeekShifts, 'maxShifts' => $maxShifts]);
});

Route::get('/gerenciarFuncionario', [\App\Http\Controllers\EmployeeController::class, 'index'])->name('gerenciarFuncionario');

Route::get('/simular', function () {
    if(request()->ajax())
        return view('simular')->renderSections()['content'];
    return view('simular');
})->name('simular');

Route::get('/employee/{id}/edit', [\App\Http\Controllers\EmployeeController::class, 'edit']);
