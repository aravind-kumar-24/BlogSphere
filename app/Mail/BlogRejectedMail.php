<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BlogRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $blog_name;

    public $blog_id;

    public $blogger_name;

    public function __construct($name, $id, $blogger_name)
    {
        $this->blog_name = $name;
        $this->blog_id = $id;
        $this->blogger_name = $blogger_name;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Blog Rejected',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'email_templates.BlogRejected',
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
