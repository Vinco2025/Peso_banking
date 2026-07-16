<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

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

Route::middleware(['auth', 'role:customer'])->prefix('customer')->group(function () {
    Route::get('/dashboard', fn() => view('customer.dashboard'))->name('customer.dashboard');

    // This routes to the account
    Route::resource('accounts', AccountController::class)->only(['index', 'create', 'store']);

    // This routes to the deposit
    Route::get('/deposit', [TransactionController::class, 'depositForm'])->name('deposit.form');
    Route::post('/deposit', [TransactionController::class, 'deposit'])->name('deposit');

    // This routes to the withdrawal
    Route::get('/withdraw', [TransactionController::class, 'withdrawForm'])->name('withdraw.form');
    Route::post('/withdraw', [TransactionController::class, 'withdraw'])->name('withdraw');

    // This routes to the transfer
    Route::get('/transfer', [TransactionController::class, 'transferForm'])->name('transfer.form');
    Route::post('/transfer', [TransactionController::class, 'transfer'])->name('transfer.submit');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', fn() => view('admin.dashboard'))->name('admin.dashboard');
});

require __DIR__.'/auth.php';
