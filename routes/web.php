<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\LawyersController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\MeetingsController;
use App\Http\Controllers\GetclientAJAXController;

Route::get('/', function () {
    return redirect('/home');
});
Route::get('/logout', function () {
    return redirect('/login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');


Route::get('/clients', [ClientsController::class, 's'])->name('home')->middleware('auth');


Route::get('/clients', [ClientsController::class, 'AllClients'])->name('clients')->middleware('auth');

Route::post('/clients/add', [ClientsController::class, 'submit'])->name('add-client')->middleware('auth');

Route::get('/clients/{id}', [ClientsController::class, 'showClientById'])->name('showClientById')->middleware('auth');

Route::get('/clients/{id}/edit', [ClientsController::class, 'updateClient'])->name('Client-Update')->middleware('auth');

Route::post('/clients/{id}/edit', [ClientsController::class, 'updateClientSubmit'])->name('Client-Update-Submit')->middleware('auth');

Route::get('/clients/{id}/delete', [ClientsController::class, 'ClientDelete'])->name('Client-Delete')->middleware('auth');


/*
Route::get('/leads', [LeadsController::class, 'showleads'])->name('leads')->middleware('auth');

Route::post('/leads/add', [LeadsController::class, 'addlead'])->name('addlead')->middleware('auth');

Route::get('/leads/{id}', [LeadsController::class, 'showLeadById'])->name('showLeadById')->middleware('auth');

Route::post('/leads/{id}/edit', [LeadsController::class, 'LeadUpdateSubmit'])->name('LeadUpdateSubmit')->middleware('auth');

Route::get('/leads/{id}/delete', [LeadsController::class, 'LeadDelete'])->name('LeadDelete')->middleware('auth');
*/

Route::get('/tasks', [TasksController::class, 'index'])->name('tasks')->middleware('auth');

Route::post('/tasks/add', [TasksController::class, 'create'])->name('addtask')->middleware('auth');

Route::get('/tasks/{id}', [TasksController::class, 'showTaskById'])->name('showTaskById')->middleware('auth');

Route::post('/tasks/{id}/edit', [TasksController::class, 'editTaskById'])->name('editTaskById')->middleware('auth');

Route::get('/tasks/{id}/delete', [TasksController::class, 'TaskDelete'])->name('TaskDelete')->middleware('auth');


Route::get('/contacts', function () {return view('contacts');})->middleware('auth');


  Route::middleware(['auth'])->group(function () {

    Route::controller(LeadsController::class)->group(function () {
      Route::get('/leads', 'showleads')->name('leads');
      Route::post('/leads/add', 'addlead')->name('addlead');
      Route::get('/leads/{id}', 'showLeadById')->name('showLeadById');
      Route::post('/leads/{id}/edit', 'LeadUpdateSubmit')->name('LeadUpdateSubmit');
      Route::get('/leads/{id}/delete', 'leadDelete')->name('leadDelete');
      Route::post('/leads/{id}/towork', 'leadToWork')->name('leadToWork');
      Route::get('/leads/{id}/toclient', 'leadToClient')->name('leadToClient');
    });

    Route::controller(MeetingsController::class)->group(function () {
      Route::get('/meetings', 'index')->name('meetings');
      Route::post('/meetings/add', 'create')->name('addmeetings');
      Route::get('/meetings/{id}', 'showMeetengById')->name('showMeetengById');
      Route::post('/meetings/{id}/edit', 'editMeetengById')->name('editMeetengById');
      Route::get('/meetings/{id}/delete', 'MeetingDelete')->name('MeetingDelete');
    });

    Route::controller(TasksController::class)->group(function () {
      Route::get('/tasks', 'index')->name('tasks');
      Route::post('/tasks/add', 'create')->name('addtask');
      Route::get('/tasks/{id}', 'showTaskById')->name('showTaskById');
      Route::post('/tasks/{id}/edit', 'editTaskById')->name('editTaskById');
      Route::get('/tasks/{id}/delete', 'TaskDelete')->name('TaskDelete');
    });
  });






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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Auth::routes();
