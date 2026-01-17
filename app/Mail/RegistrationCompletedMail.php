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
    public $verification_url;

    public function __construct($name, $url)
    {
        $this->blogger_name = $name;
        $this->verification_url = $url;
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
