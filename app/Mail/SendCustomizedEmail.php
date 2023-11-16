<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendCustomizedEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $student_name;
    public $subject;
    public $greetings;
    public $intro;
    public $body;
    public $conclusion;

    public $attachment;

    public function __construct($student_name, $subject, $greetings, $intro, $body, $conclusion, $attachment)
    {
        $this->student_name = $student_name;
        $this->subject = $subject;
        $this->greetings = $greetings;
        $this->intro = $intro;
        $this->body = $body;
        $this->conclusion = $conclusion;
        $this->attachment = $attachment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'send-customized-email',
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
