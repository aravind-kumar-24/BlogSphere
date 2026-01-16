<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegistrationCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $blogger_name;

    public function __construct($name)
    {
        $this->blogger_name = $name;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Registration Completed Successfully!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email_templates.RegistrationCompleted',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
