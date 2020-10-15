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
    if(request()->ajax())
        return view('home')->renderSections()['content'];
    return view('home');
});

Route::get('/gerenciarFuncionario', function () {
    $employees = \App\Models\Employee::all();

    if(request()->ajax())
        return view('gerenciarFuncionario')->with(['employees' => $employees])->renderSections()['content'];

    return view('gerenciarFuncionario')->with(['employees' => $employees]);
})->name('gerenciarFuncionario');

Route::get('/simular', function () {
    if(request()->ajax())
        return view('simular')->renderSections()['content'];
    return view('simular');
})->name('simular');

Route::get('/employee/{id}/edit', [\App\Http\Controllers\EmployeeController::class, 'edit']);
