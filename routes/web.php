<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\LawyersController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\MeetingsController;
use App\Http\Controllers\GetclientAJAXController;

Route::get('/', function () {
    return view('home');
})->name('home')->middleware('auth');


Route::get('/clients', [ClientsController::class, 'AllClients'])->name('clients')->middleware('auth');

Route::post('/clients/add', [ClientsController::class, 'submit'])->name('add-client')->middleware('auth');

Route::get('/clients/{id}', [ClientsController::class, 'showClientById'])->name('showClientById')->middleware('auth');

Route::get('/clients/{id}/edit', [ClientsController::class, 'updateClient'])->name('Client-Update')->middleware('auth');

Route::post('/clients/{id}/edit', [ClientsController::class, 'updateClientSubmit'])->name('Client-Update-Submit')->middleware('auth');

Route::get('/clients/{id}/delete', [ClientsController::class, 'ClientDelete'])->name('Client-Delete')->middleware('auth');



Route::get('/leads', [LeadsController::class, 'showleads'])->name('leads')->middleware('auth');

Route::post('/leads/add', [LeadsController::class, 'addlead'])->name('addlead')->middleware('auth');

Route::get('/leads/{id}', [LeadsController::class, 'showLeadById'])->name('showLeadById')->middleware('auth');

Route::post('/leads/{id}/edit', [LeadsController::class, 'LeadUpdateSubmit'])->name('LeadUpdateSubmit')->middleware('auth');

Route::get('/leads/{id}/delete', [LeadsController::class, 'LeadDelete'])->name('LeadDelete')->middleware('auth');



Route::get('/tasks', function () {return view('tasks');})->middleware('auth');

Route::get('/contacts', function () {return view('contacts');})->middleware('auth');


Route::get('/meetings', [MeetingsController::class, 'index'])->name('meetings')->middleware('auth');

Route::post('/meetings/add', [MeetingsController::class, 'create'])->name('addmeetings')->middleware('auth');

Route::get('/meetings/{id}', [MeetingsController::class, 'showMeetengById'])->name('showMeetengById')->middleware('auth');

Route::post('/meetings/{id}/edit', [MeetingsController::class, 'editMeetengById'])->name('editMeetengById')->middleware('auth');

Route::get('/meetings/{id}/delete', [MeetingsController::class, 'MeetingDelete'])->name('MeetingDelete')->middleware('auth');




Route::get('/services', [ServicesController::class, 'showservices'])->name('showservices')->middleware('auth');

Route::post('/services/add', [ServicesController::class, 'addservice'])->name('addservice')->middleware('auth');



Route::get('/payments', [PaymentsController::class, 'showpayments'])->name('payments')->middleware('auth');

Route::post('/payments/add', [PaymentsController::class, 'addpayment'])->name('addpayment')->middleware('auth');

Route::get('/payments/{id}', [PaymentsController::class, 'showPaymentById'])->name('showPaymentById')->middleware('auth');

//Route::get('/payments/{id}/edit', [PaymentsController::class, 'PaymentUpdate'])->name('PaymentUpdate')->middleware('auth');

Route::post('/payments/{id}/edit', [PaymentsController::class, 'PaymentUpdateSubmit'])->name('PaymentUpdateSubmit')->middleware('auth');

Route::get('/payments/{id}/delete', [PaymentsController::class, 'PaymentDelete'])->name('PaymentDelete')->middleware('auth');



Route::get('/test', [MeetingsController::class, 'index'])->name('test')->middleware('auth');


Route::get('ajax',function() {
   return view('message');
});


Route::POST('/getclient', [GetclientAJAXController::class, 'getclient'])->name('getclient')->middleware('auth');



Route::get('/lawyers', [LawyersController::class, 'Alllawyers'])->name('lawyers');

Route::post('/lawyers/add', [LawyersController::class, 'submit'])->name('add-lawyer');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
