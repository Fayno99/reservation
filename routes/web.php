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


Route::get('/schedules',[\App\Http\Controllers\MainController::class, 'schedules'])->middleware('auth.assistant');
Route::get('/schedules/{userid}',[\App\Http\Controllers\MainController::class, 'userHistory']);


Route::get('/about', function () {
    return view('about');
});



Route::get('/dayOff', [\App\Http\Controllers\DayOffController::class, 'TotalDayOff']);
Route::get('/dayOff/{startDate}/{interval}/{workerId}', [\App\Http\Controllers\DayOffController::class, 'SaveDayOffSlot']);
Route::get('/dayOff/create', '\App\Http\Controllers\DayOffController@create')->name('DayOff.create');
Route::post('/dayOff/store', '\App\Http\Controllers\DayOffController@store')->name('DayOff.store');




Route::get('/dayOff', [\App\Http\Controllers\DayOffController::class, 'TotalDayOff'])->middleware('auth.manager');
Route::get('/dayOff/{any}', [\App\Http\Controllers\DayOffController::class, 'TotalDayOff'])->where('any', '.*')->middleware('auth.manager');



Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'adminListUser'])->name('adminListUser')->middleware('auth.admin');
Route::get('/admin/{status}/{id}', [\App\Http\Controllers\AdminController::class, 'adminListChange'])->middleware('auth.admin');

Route::get('/adminWorker', [\App\Http\Controllers\AdminController::class, 'adminWorker'])->name('adminWorker')->middleware('auth.admin');
//Route::get('/adminWorker/{status}/{id}', [\App\Http\Controllers\AdminController::class, 'adminListChange'])->middleware('auth.admin');
Route::post('/adminAdWorker', 'App\Http\Controllers\AdminController@addWorker')->name('adminAdWorker')->middleware('auth.admin');
Route::delete('/adminWorker/delete/{id}', 'App\Http\Controllers\AdminController@workerDelete')->name('adminWorkerDelete')->middleware('auth.admin');
Route::get('/adminWorkerEdit/{id}', [App\Http\Controllers\AdminController::class, 'workerEdit'])->name('adminWorkerEdit')->middleware('auth.admin');
Route::put('/adminWorkerUpdate/{id}', 'App\Http\Controllers\AdminController@workerUpdate')->name('adminWorkerUpdate')->middleware('auth.admin');
Route::get('/adminWorkerWorkDay/{id}', [App\Http\Controllers\AdminController::class, 'adminDayOff'])->name('adminWorkerWorkDay')->middleware('auth.admin');
Route::delete('/adminWorkerWorkDayDelete/{id}', 'App\Http\Controllers\AdminController@adminDayOffDelete')->name('adminWorkerWorkDay')->middleware('auth.admin');
Route::put('/adminWorkerDayEdit/{id}', [App\Http\Controllers\AdminController::class, 'adminWorkerEdit'])->name('adminWorkerDayEdit')->middleware('auth.admin');

Route::get('/adminListOfWork', [\App\Http\Controllers\AdminController::class, 'worksList'])->name('adminListOfWork')->middleware('auth.admin');
Route::post('/adminListOfWork', 'App\Http\Controllers\AdminController@addWorks')->name('adminAddWorks')->middleware('auth.admin');
Route::delete('/adminListOfWork/{id}', 'App\Http\Controllers\AdminController@worksDelete')->name('adminListOfWorkDel')->middleware('auth.admin');
Route::get('/adminListOfWork/{id}/edit', 'App\Http\Controllers\AdminController@editWork')->name('adminListOfWorkEdit')->middleware('auth.admin');
Route::put('/adminListOfWork/{id}/update', 'App\Http\Controllers\AdminController@updateWork')->name('work.update')->middleware('auth.admin');
Route::get('/adminDashboard', [\App\Http\Controllers\AdminController::class, 'sumPriceTotal'])->name('sumPriceTotal')->middleware('auth.admin');
Route::put('/sumPriceTotal', 'App\Http\Controllers\AdminController@sumPriceTotal')->name('sumPriceTotal')->middleware('auth.admin');
