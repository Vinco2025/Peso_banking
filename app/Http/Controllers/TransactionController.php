<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    // Show deposit form
    public function depositForm()
    {
        $accounts = auth()->user()->accounts;
        return view('customer.transactions.deposit', compact('accounts'));
    }

    // Handle deposit
    public function deposit(Request $request)
    {
        $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'amount'     => 'required|numeric|min:1',
            'description'=> 'nullable|string|max:255',
        ]);

        // Make sure the account belongs to the logged-in user
        $account = Account::where('id', $request->account_id)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

        // DB::transaction makes sure BOTH the balance update
        // and transaction record succeed together, or both fail
        DB::transaction(function () use ($account, $request) {
            $account->increment('balance', $request->amount);

            Transaction::create([
                'to_account_id' => $account->id,
                'type'          => 'deposit',
                'amount'        => $request->amount,
                'description'   => $request->description ?? 'Deposit',
            ]);
        });

        return redirect()->route('accounts.index')
                        ->with('success', '₱' . number_format($request->amount, 2) . ' deposited successfully!');
    }

    // Show withdrawal form
    public function withdrawForm()
    {
        $accounts = auth()->user()->accounts;
        return view('customer.transactions.withdraw', compact('accounts'));
    }

    // Handle withdrawal
    public function withdraw(Request $request)
    {
        $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'amount'     => 'required|numeric|min:1',
            'description'=> 'nullable|string|max:255',
        ]);

        $account = Account::where('id', $request->account_id)
                        ->where('user_id', auth()->id())
                        ->firstOrFail();

        // Check if balance is enough
        if ($account->balance < $request->amount) {
            return back()->withErrors(['amount' => 'Insufficient balance.'])->withInput();
        }

        DB::transaction(function () use ($account, $request) {
            $account->decrement('balance', $request->amount);

            Transaction::create([
                'from_account_id' => $account->id,
                'type'            => 'withdrawal',
                'amount'          => $request->amount,
                'description'     => $request->description ?? 'Withdrawal',
            ]);
        });

        return redirect()->route('accounts.index')
                        ->with('success', '₱' . number_format($request->amount, 2) . ' withdrawn successfully!');
    }
}