<?php

namespace App\Mail;

use App\Models\LabRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $labRequest;

    public function __construct(LabRequest $labRequest)
    {
        $this->labRequest = $labRequest;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Lab Request Rejected - ' . $this->labRequest->experiment->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.request-rejected',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}