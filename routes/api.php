<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\DeviceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'details');
    });

    Route::controller(RoomController::class)->group(function () {
        Route::get('/rooms', 'list');
    });

    Route::controller(DeviceController::class)->group(function () {
        Route::get('/room/{room}/devices', 'get_by_room');
    });






});
