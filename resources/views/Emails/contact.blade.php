<!DOCTYPE html>
<html>
<head>
    <title>New Contact Message</title>
</head>
<body style="font-family: sans-serif; line-height: 1.6; color: #333; padding: 20px;">
    <div style="padding: 20px; border: 1px solid #eee; border-radius: 10px; max-width: 600px; margin: 0 auto;">
        <div style="font-size: 20px; font-weight: bold; margin-bottom: 20px; color: #6366f1;">
            New Contact Form Submission
        </div>
        
        <div style="margin-bottom: 10px;">
            <span style="font-weight: bold;">Name:</span> {{ $data['name'] }}
        </div>
        <div style="margin-bottom: 10px;">
            <span style="font-weight: bold;">Email:</span> {{ $data['email'] }}
        </div>
        <div style="margin-bottom: 10px;">
            <span style="font-weight: bold;">Subject:</span> {{ $data['subject'] }}
        </div>
        <div style="margin-bottom: 10px;">
            <span style="font-weight: bold;">Message:</span><br>
            {{ $data['message'] }}
        </div>
    </div>
</body>
</html>
