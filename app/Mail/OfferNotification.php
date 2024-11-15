<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OfferNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $offerDetails;

    public function __construct($offerDetails)
    {
        $this->offerDetails = $offerDetails;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Exciting Job Opportunity Just for You!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.offer_notification',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
