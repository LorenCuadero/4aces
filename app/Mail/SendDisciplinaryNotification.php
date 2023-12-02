<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendDisciplinaryNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $student_name;

    public $student_verbal_warning_date;

    public $student_written_warning_date;
    public $student_provisionary_date;
    public $student_verbal_warning_description;
    public $student_written_warning_description;
    public $student_provisionary_description;


    public function __construct($student_name, $student_verbal_warning_description, $student_written_warning_description, $student_verbal_warning_date, $student_written_warning_date, $student_provisionary_date) {
        $this->student_name = $student_name;
        $this->student_verbal_warning_description = $student_verbal_warning_description;
        $this->student_written_warning_description = $student_written_warning_description;
        $this->student_verbal_warning_date = $student_verbal_warning_date;
        $this->student_verbal_warning_date = $student_verbal_warning_date;
        $this->student_written_warning_date = $student_written_warning_date;
        $this->student_provisionary_date = $student_provisionary_date;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "PNPh: Disciplinary Notification" ,
        );
    }


    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'message-disciplinary',
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

    private function getMonthName($month)
    {
        $months = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];

        return $months[$month] ?? 'Unknown'; // Provide a default value for unknown months
    }
}
