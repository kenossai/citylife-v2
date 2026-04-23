<?php

namespace App\Mail;

use App\Models\CourseLesson;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CourseLessonRescheduledMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public CourseLesson $lesson,
        public string $recipientName,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Class Rescheduled: ' . $this->lesson->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.course-lesson-rescheduled',
        );
    }
}
