<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageMail;
use App\Models\ContactMessage;
use App\Models\WorshipCentre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class ContactController extends Controller
{
    public function index()
    {
        $locations = WorshipCentre::active()->ordered()->get();

        return view('pages.contact', compact('locations'));
    }

    public function store(Request $request)
    {
        // Honeypot check — bots fill hidden fields, humans don't
        if ($request->filled('website')) {
            return back()->with('success', 'Thank you! Your message has been received.');
        }

        $key = 'contact:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            return back()
                ->withInput()
                ->withErrors(['rate_limit' => 'Too many submissions. Please try again later.']);
        }

        RateLimiter::hit($key, 300);

        $validated = $request->validate([
            'name'         => ['required', 'string', 'max:150'],
            'email'        => ['required', 'email', 'max:200'],
            'phone'        => ['nullable', 'string', 'max:30'],
            'enquiry_type' => ['required', 'in:general,prayer,volunteering,events,bible-school,other'],
            'subject'      => ['required', 'string', 'max:200'],
            'message'      => ['required', 'string', 'min:10', 'max:3000'],
        ]);

        $contact = ContactMessage::create($validated);

        try {
            Mail::to(config('mail.from.address'))
                ->send(new ContactMessageMail($contact));
        } catch (\Throwable) {
            // Mail failure should not block the user
        }

        return back()->with('success', 'Thank you, ' . e($contact->name) . '! Your message has been received and we will get back to you shortly.');
    }
}
