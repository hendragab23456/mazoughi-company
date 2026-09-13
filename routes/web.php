<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;








Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/transactions', [TransactionController::class, 'index'])
        ->name('transactions.index');
        
        Route::get('/reports', [ReportController::class, 'index'])
    ->name('reports.index');

    Route::get('/transactions/create', [TransactionController::class, 'create'])
        ->name('transactions.create');

    Route::post('/transactions', [TransactionController::class, 'store'])
        ->name('transactions.store');

    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])
        ->name('transactions.show');

    Route::post('/transactions/{transaction}/approve', [TransactionController::class, 'approve'])
        ->name('transactions.approve');

    Route::post('/transactions/{transaction}/reject', [TransactionController::class, 'reject'])
        ->name('transactions.reject');

    Route::resource('workers', WorkerController::class);
Route::resource('projects', ProjectController::class);




    Route::resource('clients', ClientController::class); 
     Route::resource('suppliers', SupplierController::class);


    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

Route::get('/test', function () {
    return 'Laravel is working!';
});

require __DIR__.'/auth.php';

