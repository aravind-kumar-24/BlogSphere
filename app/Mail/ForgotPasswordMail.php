<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $blogger_name;

    public $blogger_new_password;

    public function __construct($name, $password)
    {
        $this->blogger_name = $name;

        $this->blogger_new_password = $password;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Forgot Password',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email_templates.ForgotPassword',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
