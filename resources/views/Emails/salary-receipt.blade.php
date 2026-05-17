<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .wrap {
            max-width: 520px;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
        }

        .header {
            background: #0f6e56;
            padding: 28px 32px;
        }

        .header h1 {
            color: #fff;
            margin: 0;
            font-size: 20px;
            font-weight: 600;
        }

        .header p {
            color: #9FE1CB;
            margin: 4px 0 0;
            font-size: 13px;
        }

        .body {
            padding: 28px 32px;
        }

        .amount {
            font-size: 36px;
            font-weight: 700;
            color: #0f6e56;
            margin: 0 0 4px;
        }

        .badge {
            display: inline-block;
            background: #EAF3DE;
            color: #27500A;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 10px 0;
            font-size: 13px;
            border-bottom: 1px solid #f0f0f0;
        }

        td:first-child {
            color: #888;
        }

        td:last-child {
            text-align: right;
            font-weight: 500;
        }

        .mono {
            font-family: monospace;
            font-size: 11px;
            color: #555;
        }

        .footer {
            padding: 16px 32px;
            background: #f9f9f9;
            font-size: 11px;
            color: #aaa;
            text-align: center;
            border-top: 1px solid #eee;
        }
    </style>
</head>

<body>
    <div class="wrap">
        <div class="header">
            <h1>Salary Receipt</h1>
            <p>Your salary has been processed successfully.</p>
        </div>
        <div class="body">
            <div class="amount">${{ number_format($transaction->amount, 2) }}</div>
            <div class="badge">✓ Paid</div>

            <table>
                <tr>
                    <td>Employee</td>
                    <td>{{ $salary->employee->name }}</td>
                </tr>
                <tr>
                    <td>Month</td>
                    <td>{{ $salary->month }}</td>
                </tr>
                <tr>
                    <td>Paid on</td>
                    <td>{{ $salary->paid_at->format('d M Y, h:i A') }}</td>
                </tr>
                <tr>
                    <td>Payment method</td>
                    <td>Stripe (Card)</td>
                </tr>
                <tr>
                    <td>Transaction ID</td>
                    <td class="mono">{{ $transaction->transaction_id }}</td>
                </tr>
            </table>
        </div>
        <div class="footer">
            This is an automated receipt. Contact HR for any queries.
        </div>
    </div>
</body>

</html>