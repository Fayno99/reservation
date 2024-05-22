<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Http\Controllers\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/index', [\App\Http\Controllers\ApiController::class, 'index']);

Route::get('/companies',[\App\Http\Controllers\ApiController::class, 'companies']);
Route::get('/master',[\App\Http\Controllers\ApiController::class, 'master']);
Route::get('/services',[\App\Http\Controllers\ApiController::class, 'services']);
Route::get('/time-slots/{interval}/{master}', [\App\Http\Controllers\ApiController::class, 'timeSlot']);

Route::middleware('verify.token')->group(function () {
Route::post('/selectCompanies', [\App\Http\Controllers\ApiController::class, 'selectCompanies']);
Route::post('/selectMaster', [\App\Http\Controllers\ApiController::class, 'selectMasterId']);
Route::post('/selectService', [\App\Http\Controllers\ApiController::class, 'selectService']);
Route::post('/selectDataTime', [\App\Http\Controllers\ApiController::class, 'selectDataTime']);
Route::post('/selectUserData', [\App\Http\Controllers\ApiController::class, 'selectUserData']);

Route::post('/submitOrder', [\App\Http\Controllers\ApiController::class, 'submitOrder']);
});
