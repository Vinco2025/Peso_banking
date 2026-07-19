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
            ->paginate(10);

        return view('admin.transactions', compact('transactions'));
    }

    public function suspendUser(User $user)
    {
        $user->status = 'suspended';
        $user->save();
        return back()->with('success', $user->name . ' has been suspended.');
    }

    public function activateUser(User $user)
    {
        $user->status = 'active';
        $user->save();
        return back()->with('success', $user->name . ' has been activated.');
    }

    public function deactivateAccount(Account $account)
    {
        $account->status = 'inactive';
        $account->save();
        return back()->with('success', 'Account ' . $account->account_number . ' has been deactivated.');
    }

    public function activateAccount(Account $account)
    {
        $account->status = 'active';
        $account->save();
        return back()->with('success', 'Account ' . $account->account_number . ' has been activated.');
    }
}
