<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use app\Http\Controllers\ApiController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/index', [\App\Http\Controllers\ApiController::class, 'index']);

Route::get('/companies',[\App\Http\Controllers\ApiController::class, 'companies']);
Route::get('/master/{companies_id}',[\App\Http\Controllers\ApiController::class, 'master']);
Route::get('/services',[\App\Http\Controllers\ApiController::class, 'services']);
Route::get('/time-slots/{interval}/{master}', [\App\Http\Controllers\ApiController::class, 'timeSlot']);

Route::middleware('verify.token')->group(function () {
    Route::post('/selectData', [\App\Http\Controllers\ApiController::class, 'selectData']);
    Route::post('/submitOrder', [\App\Http\Controllers\ApiController::class, 'submitOrder']);
});
