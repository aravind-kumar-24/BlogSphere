<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BloggerRejectedMail extends Mailable
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
            subject: 'Blogger Rejected',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email_templates.BloggerRejected',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
