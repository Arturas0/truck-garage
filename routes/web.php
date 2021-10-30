<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\MechanicController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix' => 'trucks'], function () {
    Route::get('', [TruckController::class, 'index'])->name('truck_index');
    Route::get('create', [TruckController::class, 'create'])->name('truck_create');
    Route::post('store', [TruckController::class, 'store'])->name('truck_store');
    Route::get('edit/{truck}', [TruckController::class, 'edit'])->name('truck_edit');
    Route::post('update/{truck}', [TruckController::class, 'update'])->name('truck_update');
    Route::post('delete/{truck}', [TruckController::class, 'destroy'])->name('truck_destroy');
    Route::get('show/{truck}', [TruckController::class, 'show'])->name('truck_show');
});

Route::group(['prefix' => 'mechanics'], function () {
    Route::get('', [MechanicController::class, 'index'])->name('mechanic_index');
    Route::get('create', [MechanicController::class, 'create'])->name('mechanic_create');
    Route::post('store', [MechanicController::class, 'store'])->name('mechanic_store');
    Route::get('edit/{mechanic}', [MechanicController::class, 'edit'])->name('mechanic_edit');
    Route::post('update/{mechanic}', [MechanicController::class, 'update'])->name('mechanic_update');
    Route::post('delete/{mechanic}', [MechanicController::class, 'destroy'])->name('mechanic_destroy');
    Route::get('show/{mechanic}', [MechanicController::class, 'show'])->name('mechanic_show');
});
