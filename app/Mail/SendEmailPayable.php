<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmailPayable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $student_name;

    public $month;

    public $year;

    public function __construct($student_name, $month, $year)
    {
        $this->student_name = $student_name;
        $this->month = $month;
        $this->year = $year;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Statement of Account for Parents' Counterpart Balances as of: {$this->month} {$this->year}"
        );
    }
    

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'payable-email',
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
