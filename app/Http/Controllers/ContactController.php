<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\NewsletterRequest;
use App\Mail\ContactMail;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(ContactRequest $request)
    {
        $data = $request->validated();

        // ADD YOUR EMAIL HERE
        $recipient = 'ahmed7448912@gmail.com';

        Mail::to($recipient)->send(new ContactMail($data));

        return back()->with('success', 'Your message has been sent successfully!');
    }

    public function subscribe(NewsletterRequest $request)
    {
        $email = $request->validated()['email'];

        // ADD YOUR EMAIL HERE
        $recipient = 'ahmed7448912@gmail.com';

        Mail::to($recipient)->send(new NewsletterMail($email));

        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}
