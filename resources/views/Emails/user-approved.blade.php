<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Approved</title>
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
            background: linear-gradient(135deg, #22c55e, #16a34a);
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
            margin-bottom: 28px;
        }
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, #22c55e, #16a34a);
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
            <div class="icon">✅</div>
            <h1>Account Approved!</h1>
            <p>PeopleDesk HR System</p>
        </div>

        <div class="email-body">
            <div class="greeting">Hello, {{ $user->name }}!</div>

            <div class="message">
                We're pleased to inform you that your account registration has been
                <strong>reviewed and approved</strong> by our administrator.
                You can now log in and access the HR system with full access.
            </div>

            <a href="{{ config('app.url') }}/login" class="cta-button">Log In to Your Account →</a>

            <hr class="divider">

            <div class="note">
                If you did not register for an account, please ignore this email or contact support.
                <br><br>
                — The PeopleDesk HR Team
            </div>
        </div>

        <div class="email-footer">
            © {{ date('Y') }} PeopleDesk HR. All rights reserved.
        </div>
    </div>
</body>
</html>
