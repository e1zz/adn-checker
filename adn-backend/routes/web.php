<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MutationController;
use App\Http\Controllers\StatsController;
use Illuminate\Support\Facades\Route;

Route::post('/mutation', [MutationController::class, 'check']);
Route::get('/stats', [StatsController::class, 'index']);

Route::get('/test-db', function () {
    try {
        \DB::connection()->getPdo();
        return response()->json(['status' => 'conectado']);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
