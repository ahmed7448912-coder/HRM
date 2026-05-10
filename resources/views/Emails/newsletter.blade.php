<!DOCTYPE html>
<html>
<head>
    <title>New Subscription</title>
</head>
<body style="font-family: sans-serif; line-height: 1.6; color: #333; padding: 20px;">
    <div style="padding: 20px; border: 1px solid #eee; border-radius: 10px; max-width: 600px; margin: 0 auto;">
        <div style="font-size: 20px; font-weight: bold; margin-bottom: 20px; color: #6366f1;">
            New Newsletter Subscriber
        </div>
        
        <p>You have a new subscriber to your newsletter!</p>
        
        <div style="margin-bottom: 10px; background: #f8fafc; padding: 15px; border-radius: 8px;">
            <span style="font-weight: bold;">Email:</span> {{ $email }}
        </div>
        
        <p style="font-size: 0.9rem; color: #64748b; margin-top: 20px;">
            This email was sent from your website's footer subscription form.
        </p>
    </div>
</body>
</html>
