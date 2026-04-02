<?php

namespace App\Mail;

use App\Models\CourseEnrollment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CourseEnrollmentRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public CourseEnrollment $enrollment,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Enrollment Request: ' . $this->enrollment->course->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.course-enrollment-request',
        );
    }
}
