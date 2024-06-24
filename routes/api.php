<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\GeneralApiController;
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

Route::post('/reset', [GeneralApiController::class, 'reset']);

//Account routes
Route::get('/balance', [AccountController::class, 'balance']);
Route::post('/event', [AccountController::class, 'event']);