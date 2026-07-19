<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Transaction History</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        h1 { font-size: 18px; margin-bottom: 4px; }
        p { margin: 2px 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th { background: #f3f4f6; text-align: left; padding: 8px; font-size: 11px; text-transform: uppercase; }
        td { padding: 8px; border-bottom: 1px solid #e5e7eb; }
        .badge { padding: 2px 8px; border-radius: 4px; font-size: 10px; font-weight: bold; }
        .deposit { background: #d1fae5; color: #065f46; }
        .withdrawal { background: #fee2e2; color: #991b1b; }
        .transfer { background: #dbeafe; color: #1e40af; }
    </style>
</head>
<body>
    <h1>Peso Bank — Transaction History</h1>
    <p>Account Holder: {{ $user->name }}</p>
    <p>Generated: {{ now()->format('F d, Y h:i A') }}</p>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>From Account</th>
                <th>To Account</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->created_at->format('M d, Y h:i A') }}</td>
                    <td>
                        <span class="badge {{ $transaction->type }}">
                            {{ ucfirst($transaction->type) }}
                        </span>
                    </td>
                    <td>{{ $transaction->fromAccount->account_number ?? 'N/A' }}</td>
                    <td>{{ $transaction->toAccount->account_number ?? '—' }}</td>
                    <td>₱{{ number_format($transaction->amount, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center; color:#9ca3af;">No transactions found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>