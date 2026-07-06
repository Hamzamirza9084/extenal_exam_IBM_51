<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BmiRecordController;

Route::get('/', [BmiRecordController::class, 'index'])->name('bmi.index');
Route::post('/calculate', [BmiRecordController::class, 'calculate'])->name('bmi.calculate');
