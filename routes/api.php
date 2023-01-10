<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use DefStudio\Telegraph\Controllers\WebhookController;



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
Route::post('/telegraph/5941198915:AAFpQD_AvVJfiXjH6gaD3oBZgxbe06sTvyc/webhook', [WebhookController::class, 'handle'])->name('telegraph.webhook');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
