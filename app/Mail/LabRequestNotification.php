<?php

namespace App\Mail;

use App\Models\LabRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LabRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $labRequest;

    /**
     * Create a new message instance.
     */
    public function __construct(LabRequest $labRequest)
    {
        $this->labRequest = $labRequest;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Lab Request Submitted - Request #' . $this->labRequest->id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.lab_request_notification',
            with: [
                'labRequest' => $this->labRequest,
            ],
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