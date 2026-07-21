<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    if ($user->accounts()->exists()) {
        return redirect()->route('customer.dashboard');
    }

    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:customer', 'check.status'])->prefix('customer')->group(function () {
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

    // This routes to the history
    Route::get('/history', [TransactionController::class, 'history'])->name('transaction.history');

    // This routes to the exporting of transactions
    Route::get('/transactions/export-pdf', [TransactionController::class, 'exportPdf'])->name('transactions.export-pdf');

    // This routes to the transactions receipt
    Route::get('/transactions/{transaction}/receipt', [TransactionController::class, 'receipt'])->name('transaction.receipt');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transactions');
    Route::post('/users/{user}/suspend', [AdminController::class, 'suspendUser'])->name('admin.users.suspend');
    Route::post('/users/{user}/activate', [AdminController::class, 'activateUser'])->name('admin.users.activate');
    Route::post('/accounts/{account}/deactivate', [AdminController::class, 'deactivateAccount'])->name('admin.accounts.deactivate');
    Route::post('/accounts/{account}/activate', [AdminController::class, 'activateAccount'])->name('admin.accounts.activate');
    Route::get('/admin/users/{user}/transactions', [AdminController::class, 'userTransactions'])->name('admin.user.transactions');
});

require __DIR__.'/auth.php';
