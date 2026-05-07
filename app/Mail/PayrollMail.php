<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PayrollMail extends Mailable
{
    use Queueable, SerializesModels;

    public $payroll;

    public function __construct($payroll)
    {
        $this->payroll = $payroll;
    }

    public function build()
    {
        return $this->subject('Salary Details')
            ->view('emails.payroll');
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
