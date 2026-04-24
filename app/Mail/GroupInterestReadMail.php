<?php

namespace App\Mail;

use App\Models\MinistryEnquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GroupInterestReadMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public MinistryEnquiry $enquiry,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            to: [new Address($this->enquiry->email, $this->enquiry->full_name)],
            subject: 'We\'ve received your interest — ' . ($this->enquiry->ministry?->name ?? 'Life Group'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.group-interest-read',
        );
    }
}
