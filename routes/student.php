<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/',[RoutingController::class,'student'])->name('student.dashboard');

Route::get('registerstu',[RoutingController::class,'registerstu'])->name('registerstu');

Route::get('addstudent',[RoutingController::class,'addstudent'])->name('addstudent');

Route::post('registerstusubmit',[LoginController::class,'registerstusubmit'])->name('admin.registerstusubmit');

Route::get('liststudent',[RoutingController::class,'liststudent'])->name('liststudent');

Route::post('studentregister',[LoginController::class,'studentregister'])->name('student.register');
