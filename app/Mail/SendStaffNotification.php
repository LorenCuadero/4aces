<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendStaffNotification extends Mailable {
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $staff_name;

    public $staff_email;

    public $staff_password;

    public function __construct($staff_name, $staff_email, $staff_password) {
        $this->staff_name = $staff_name;
        $this->staff_email = $staff_email;
        $this->staff_password = $staff_password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope {
        return new Envelope(
            subject: "PNPh: Staff Account Created",
        );
    }


    /**
     * Get the message content definition.
     */
    public function content(): Content {
        return new Content(
            view: 'message-staff',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array {
        return [];
    }

    private function getMonthName($month) {
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
