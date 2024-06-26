<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DayOffController;
use App\Http\Controllers\MainController;
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

require __DIR__ . '/auth.php';


Route::get('/index', [MainController::class, 'index']);

Route::get('/services', [MainController::class, 'services'])->name('services');

Route::get('/services/save-work-id/{interval}/{workId}', [MainController::class, 'saveWorkId'])->name('save-work-id');
Route::get('/services/{interval}/{workId}', [MainController::class, 'timeSlot'])->name('timeSlot');


Route::get('/master', [MainController::class, 'master']);
Route::get('/master/{id}', [MainController::class, 'services']);
Route::get('/master/{id}', [MainController::class, 'saveMasterId'])->name('saveMasterId');
Route::get('/order/{startSlot}/{endSlot}', [MainController::class, 'order'])->name('order');
Route::get('/master', [MainController::class, 'master']);

Route::get('/order/confirm', [MainController::class, 'ShowWorkOrder'])->name('confirm');

Route::get('/order/create', '\App\Http\Controllers\MainController@create')->name('order.create');
Route::post('/order/store', '\App\Http\Controllers\MainController@store')->name('order.store');


Route::get('/schedules', [MainController::class, 'schedules'])->middleware(['auth.assistant']);
Route::put('/schedulesDay', 'App\Http\Controllers\MainController@schedules')->name('schedulesDay');

Route::get('/schedules/{userid}', [MainController::class, 'userHistory']);


Route::get('/about', function () {
    return view('about');
});


Route::get('/dayOff', [DayOffController::class, 'TotalDayOff']);
Route::get('/dayOff/{startDate}/{interval}/{workerId}', [DayOffController::class, 'SaveDayOffSlot']);
Route::get('/dayOff/create', '\App\Http\Controllers\DayOffController@create')->name('DayOff.create');
Route::post('/dayOff/store', '\App\Http\Controllers\DayOffController@store')->name('DayOff.store');


Route::get('/dayOff', [DayOffController::class, 'TotalDayOff'])->middleware('auth.manager');
Route::get('/dayOff/{any}', [DayOffController::class, 'TotalDayOff'])->where('any', '.*')->middleware('auth.manager');


Route::middleware('auth.admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'adminListUser'])->name('adminListUser');
    Route::get('/admin/{status}/{id}', [AdminController::class, 'adminListChange']);

    Route::get('/adminWorker', [AdminController::class, 'adminWorker'])->name('adminWorker');
    Route::post('/adminAdWorker', 'App\Http\Controllers\AdminController@addWorker')->name('adminAdWorker');
    Route::delete('/adminWorker/delete/{id}', 'App\Http\Controllers\AdminController@workerDelete')->name('adminWorkerDelete');
    Route::get('/adminWorkerEdit/{id}', [App\Http\Controllers\AdminController::class, 'workerEdit'])->name('adminWorkerEdit');
    Route::put('/adminWorkerUpdate/{id}', 'App\Http\Controllers\AdminController@workerUpdate')->name('adminWorkerUpdate');
    Route::get('/adminWorkerWorkDay/{id}', [App\Http\Controllers\AdminController::class, 'adminDayOff'])->name('adminWorkerWorkDay');
    Route::delete('/adminWorkerWorkDayDelete/{id}', 'App\Http\Controllers\AdminController@adminDayOffDelete')->name('adminWorkerWorkDay');
    Route::put('/adminWorkerDayEdit/{id}', [App\Http\Controllers\AdminController::class, 'adminWorkerEdit'])->name('adminWorkerDayEdit');

    Route::get('/adminListOfWork', [AdminController::class, 'worksList'])->name('adminListOfWork');
    Route::post('/adminListOfWork', 'App\Http\Controllers\AdminController@addWorks')->name('adminAddWorks');
    Route::delete('/adminListOfWork/{id}', 'App\Http\Controllers\AdminController@worksDelete')->name('adminListOfWorkDel');
    Route::get('/adminListOfWork/{id}/edit', 'App\Http\Controllers\AdminController@editWork')->name('adminListOfWorkEdit');
    Route::put('/adminListOfWork/{id}/update', 'App\Http\Controllers\AdminController@updateWork')->name('work.update');
    Route::get('/adminDashboard', [AdminController::class, 'sumPriceTotal'])->name('sumPriceTotal');
    Route::put('/sumPriceTotal', 'App\Http\Controllers\AdminController@sumPriceTotal')->name('sumPriceTotal');
});
