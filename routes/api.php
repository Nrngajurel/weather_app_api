<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\WeatherController;
use App\Jobs\FetchWeatherJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/address', AddressController::class);

// weather by address
Route::get('/weather/{address:address}', [WeatherController::class, 'weatherByAddress']);
Route::get('/weather/{address:address}/{date?}', [WeatherController::class, 'weatherByAddressDate']);
Route::apiResource('/weather', WeatherController::class)->except(['index','show']);
