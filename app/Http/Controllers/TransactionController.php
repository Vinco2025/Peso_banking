<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

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

        if ($account->status === 'inactive') {
            return back()->withErrors(['account_id' => 'This account is inactive.']);
        }

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

        if ($account->status === 'inactive') {
            return back()->withErrors(['account_id' => 'This account is inactive.']);
        }

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

    public function transferForm()
    {
        $accounts = auth()->user()->accounts;
        return view('customer.transactions.transfer', compact('accounts'));
    }

    public function transfer(Request $request)
    {
        $request->validate([
            'from_account_id' => 'required|exists:accounts,id',
            'to_account_number' => 'required|string',
            'amount' => 'required|numeric|min:0.01',
        ]);

        $fromAccount = Account::where('id', $request->from_account_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($fromAccount->status === 'inactive') {
            return back()->withErrors(['from_account_id' => 'This account is inactive.']);
        }

        $toAccount = Account::where('account_number', $request->to_account_number)->first();

        if (!$toAccount) {
            return back()->withErrors(['to_account_number' => 'Destination account not found.']);
        }

        if ($toAccount->id === $fromAccount->id) {
            return back()->withErrors(['to_account_number' => 'Cannot transfer to the same account.']);
        }

        if ((float) $fromAccount->balance < (float) $request->amount) {
            return back()->withErrors(['amount' => 'Insufficient balance.']);
        }

        DB::transaction(function () use ($fromAccount, $toAccount, $request) {
            $fromAccount->decrement('balance', $request->amount);
            $toAccount->increment('balance', $request->amount);

            Transaction::create([
                'from_account_id' => $fromAccount->id,
                'to_account_id' => $toAccount->id,
                'type' => 'transfer',
                'amount' => $request->amount,
            ]);
        });

        return redirect()->route('accounts.index')->with('success', 'Transfer successfully!');
    }

    public function history(Request $request)
    {
        $user = auth()->user();
        $accountIds = $user->accounts()->pluck('id');

        $query = \App\Models\Transaction::where(function($q) use ($accountIds) {
                $q->whereIn('from_account_id', $accountIds)
                ->orWhereIn('to_account_id', $accountIds);
            })
            ->with(['fromAccount', 'toAccount'])
            ->latest();
        
        if ($request->type) {
            $query->where('type', $request->type);
        }

        if ($request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $transactions = $query->paginate(10);

        return view('customer.transactions.history', compact('transactions'));
    }

    public function exportPdf()
    {
        $user =auth()->user();
        $accountIds = $user->accounts()->pluck('id');

        $transactions = \App\Models\Transaction::whereIn('from_account_id', $accountIds)
            ->orWhereIn('to_account_id', $accountIds)
            ->with(['FromAccount', 'toAccount'])
            ->latest()
            ->get();

        $pdf = Pdf::loadview('transactions.pdf', compact('user', 'transactions'));

        return $pdf->download('transaction-history.pdf');
    }

    public function receipt(Transaction $transaction)
    {
        $user = auth()->user();
        $accountIds = $user->accounts()->pluck('id');

        $owns = $accountIds->contains($transaction->from_account_id) ||
                $accountIds->contains($transaction->to_account_id);

        if (!$owns) {
            abort(403);
        }

        $transaction->load(['fromAccount.user', 'toAccount.user']);

        return view('customer.transactions.receipt', compact('transaction'));
    }
}