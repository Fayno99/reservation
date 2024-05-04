<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('index');
});

Route::get('/dashboard', function () {
    return redirect('index');


})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/index', [\App\Http\Controllers\MainController::class, 'index']);

Route::get('/services', [\App\Http\Controllers\MainController::class, 'services'])->name('services');

Route::get('/services/save-work-id/{interval}/{workId}', [\App\Http\Controllers\MainController::class, 'saveWorkId']);
Route::get('/services/{interval}/{workId}', [\App\Http\Controllers\MainController::class, 'timeSlot'])->name('timeSlot');


Route::get('/master', [\App\Http\Controllers\MainController::class, 'master']);
Route::get('/master/{id}', [\App\Http\Controllers\MainController::class, 'services']);
Route::get('/master/{id}', [\App\Http\Controllers\MainController::class, 'saveMasterId']);
Route::get('/order/{startSlot}/{endSlot}', [\App\Http\Controllers\MainController::class, 'order'])->name('order');
Route::get('/master', [\App\Http\Controllers\MainController::class, 'master']);

Route::get('/order/confirm', [\App\Http\Controllers\MainController::class, 'ShowWorkOrder'])->name('confirm');

Route::get('/order/create', '\App\Http\Controllers\MainController@create')->name('order.create');
Route::post('/order/store', '\App\Http\Controllers\MainController@store')->name('order.store');


Route::get('/schedules',[\App\Http\Controllers\MainController::class, 'schedules'])->middleware('can:view-schedules');
Route::get('/schedules/{userid}',[\App\Http\Controllers\MainController::class, 'userHistory']);


Route::get('/about', function () {
    return view('about');
});



Route::get('/dayOff', [\App\Http\Controllers\DayOffController::class, 'TotalDayOff']);
Route::get('/dayOff/{startDate}/{interval}/{workerId}', [\App\Http\Controllers\DayOffController::class, 'SaveDayOffSlot']);
Route::get('/dayOff/create', '\App\Http\Controllers\DayOffController@create')->name('DayOff.create');
Route::post('/dayOff/store', '\App\Http\Controllers\DayOffController@store')->name('DayOff.store');




Route::get('/dayOff', [\App\Http\Controllers\DayOffController::class, 'TotalDayOff'])->middleware('can:view-day-off');
Route::get('/dayOff/{any}', [\App\Http\Controllers\DayOffController::class, 'TotalDayOff'])->where('any', '.*')->middleware('can:view-day-off');

