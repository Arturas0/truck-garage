<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\MechanicController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    Route::prefix('trucks')->group(function () {
        Route::as('truck_')->group(function () {
            Route::get('', [TruckController::class, 'index'])->name('index');
            Route::get('create', [TruckController::class, 'create'])->name('create');
            Route::post('store', [TruckController::class, 'store'])->name('store');
            Route::get('edit/{truck}', [TruckController::class, 'edit'])->name('edit');
            Route::post('update/{truck}', [TruckController::class, 'update'])->name('update');
            Route::post('delete/{truck}', [TruckController::class, 'destroy'])->name('destroy');
            Route::get('show/{truck}', [TruckController::class, 'show'])->name('show');
        });
    });

    Route::group(['prefix' => 'mechanics'], function () {
        Route::as('mechanic_')->group(function () {
            Route::get('', [MechanicController::class, 'index'])->name('index');
            Route::get('create', [MechanicController::class, 'create'])->name('create');
            Route::post('store', [MechanicController::class, 'store'])->name('store');
            Route::get('edit/{mechanic}', [MechanicController::class, 'edit'])->name('edit');
            Route::post('update/{mechanic}', [MechanicController::class, 'update'])->name('update');
            Route::post('delete/{mechanic}', [MechanicController::class, 'destroy'])->name('destroy');
            Route::get('show/{mechanic}', [MechanicController::class, 'show'])->name('show');
        });
    });
});
