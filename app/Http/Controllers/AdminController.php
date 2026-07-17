<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::where('role', 'customer')->count();
        $totalAccounts = Account::count();
        $totalTransactions = Transaction::count();
        $totalBalance = Account::sum('balance');

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalAccounts',
            'totalTransactions',
            'totalBalance'
        ));
    }

    public function users()
    {
        $users = User::where('role', 'customer')->with('accounts')->get();
        return view('admin.users', compact('users'));
    }

    public function transactions(Request $request)
    {
        $transactions = Transaction::with(['fromAccount.user', 'toAccount.user'])
            ->when($request->type, fn($q) => $q->where('type', $request->type))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.transactions', compact('transactions'));
    }
}
