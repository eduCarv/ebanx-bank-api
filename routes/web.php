<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\GeneralApiController;
use Illuminate\Support\Facades\Route;

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

Route::post('/reset', [GeneralApiController::class, 'reset']);

//Account routes
Route::get('/balance', [AccountController::class, 'balance']);
Route::post('/event', [AccountController::class, 'event']);
