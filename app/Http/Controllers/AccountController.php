<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    // This shows all the accounts of the logged-in customer
    public function index()
    {
        $accounts = auth()->user()->accounts;
        return view('customer.accounts.index', compact('accounts'));
    }

    // This show form to create a new account
    public function create()
    {
        return view('customer.accounts.create');
    }

    // This store the new account
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:savings,checking',
        ]);

        Account::create([
            'user_id' => auth()->id(),
            'account_number' => "ACC-" . strtoupper(Str::random(8)),
            'balance' => 0.00,
            'type' => $request->type,
        ]);

        return redirect()->route('accounts.index')
                        ->with('success', 'Account created successfully!');
    }
}
