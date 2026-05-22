<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to the Team!</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        .email-wrapper {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        .email-header {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            padding: 40px 40px 30px;
            text-align: center;
        }
        .email-header .icon {
            font-size: 48px;
            margin-bottom: 12px;
        }
        .email-header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .email-header p {
            color: rgba(255,255,255,0.85);
            margin: 6px 0 0;
            font-size: 14px;
        }
        .email-body {
            padding: 36px 40px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 12px;
        }
        .message {
            font-size: 15px;
            color: #475569;
            line-height: 1.7;
            margin-bottom: 24px;
        }
        .info-box {
            background-color: #f0f9ff;
            border-left: 4px solid #3b82f6;
            border-radius: 8px;
            padding: 18px 20px;
            margin-bottom: 28px;
        }
        .info-box p {
            margin: 4px 0;
            font-size: 14px;
            color: #334155;
        }
        .info-box strong {
            color: #1d4ed8;
            min-width: 100px;
            display: inline-block;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        .divider {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 28px 0;
        }
        .note {
            font-size: 13px;
            color: #94a3b8;
            line-height: 1.6;
        }
        .email-footer {
            background-color: #f8fafc;
            padding: 20px 40px;
            text-align: center;
            font-size: 12px;
            color: #94a3b8;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-header">
            <div class="icon">🎉</div>
            <h1>Welcome to the Team!</h1>
            <p>PeopleDesk HR System</p>
        </div>

        <div class="email-body">
            <div class="greeting">Hello, {{ $employee->name }}!</div>

            <div class="message">
                We are thrilled to welcome you to our team! Your employee profile has been
                successfully created in our HR system. Here are your details:
            </div>

            <div class="info-box">
                <p><strong>Name:</strong> {{ $employee->name }}</p>
                <p><strong>Email:</strong> {{ $employee->email }}</p>
                @if($employee->department)
                <p><strong>Department:</strong> {{ $employee->department->name }}</p>
                @endif
                <p><strong>Joining Date:</strong> {{ \Carbon\Carbon::parse($employee->joining_date)->format('d M, Y') }}</p>
            </div>

            <a href="{{ config('app.url') }}/login" class="cta-button">Log In to HR Portal →</a>

            <hr class="divider">

            <div class="note">
                If you have any questions or need assistance getting started, please don't hesitate to
                reach out to the HR team.<br><br>
                — The PeopleDesk HR Team
            </div>
        </div>

        <div class="email-footer">
            © {{ date('Y') }} PeopleDesk HR. All rights reserved.
        </div>
    </div>
</body>
</html>