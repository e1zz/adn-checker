<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MutationController;
use App\Http\Controllers\StatsController;

Route::post('/mutation', [MutationController::class, 'check']);
Route::get('/stats', [StatsController::class, 'index']);
