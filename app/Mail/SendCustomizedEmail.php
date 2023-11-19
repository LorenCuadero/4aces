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

    public $subject;
    public $salutation;
    public $selectedBatchYear;
    public $message_content;
    public $conclusion_salutation;
    public $sender;
    public $attachment;

    public function __construct($subject, $salutation, $selectedBatchYear, $message_content, $conclusion_salutation, $sender, $attachment)
    {
        $this->subject = $subject;
        $this->salutation = $salutation;
        $this->selectedBatchYear = $selectedBatchYear;
        $this->message_content = $message_content;
        $this->conclusion_salutation = $conclusion_salutation;
        $this->sender = $sender;
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
