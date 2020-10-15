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
    $allShifts = \App\Models\Shift::all();

    $dayOfWeekShifts = getShiftsPerDayOfWeek($allShifts);

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
