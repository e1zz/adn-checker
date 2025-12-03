<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MutationController;

Route::post('/mutation', [MutationController::class, 'check']);