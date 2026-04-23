<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Rescheduled</title>
</head>
<body style="margin:0;padding:0;background-color:#f3f4f6;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;">
@php $_logoPath = public_path('images/logo_small_black.png'); $logoSrc = file_exists($_logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($_logoPath)) : asset('images/logo_small_black.png'); @endphp
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f3f4f6;padding:48px 20px;">
        <tr>
            <td align="center">

                <table width="520" cellpadding="0" cellspacing="0" style="background-color:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.08);">

                    {{-- Brand Header --}}
                    <tr>
                        <td style="padding:36px 40px 24px;text-align:center;border-bottom:1px solid #f1f5f9;">
                            <img src="{{ $logoSrc }}" alt="{{ config('app.name') }}" width="100" height="30" style="display:block;margin:0 auto 12px;">
                            <p style="margin:0;font-size:20px;font-weight:800;color:#1e293b;letter-spacing:-0.5px;">
                                {{ config('app.name') }}
                            </p>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding:36px 40px 0;">
                            <p style="margin:0 0 6px;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#e85d26;">Schedule Update</p>
                            <p style="margin:0 0 16px;font-size:22px;font-weight:800;color:#1e293b;">Class Rescheduled 📅</p>
                            <p style="margin:0;font-size:15px;color:#475569;line-height:1.6;">
                                Hello, <strong style="color:#1e293b;">{{ $recipientName }}</strong>! A class on your course has been rescheduled to a new date. Please see the updated details below.
                            </p>
                        </td>
                    </tr>

                    {{-- Lesson Details Box --}}
                    <tr>
                        <td style="padding:24px 40px 0;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="background-color:#f1f5f9;border-radius:10px;padding:18px 22px;">
                                        <p style="margin:0 0 4px;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#94a3b8;">Course</p>
                                        <p style="margin:0 0 12px;font-size:15px;font-weight:600;color:#1e293b;">{{ $lesson->course->title }}</p>
                                        <p style="margin:0 0 4px;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#94a3b8;">Lesson</p>
                                        <p style="margin:0 0 12px;font-size:17px;font-weight:700;color:#1e293b;">{{ $lesson->title }}</p>
                                        <p style="margin:0 0 4px;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#94a3b8;">New Date</p>
                                        <p style="margin:0;font-size:15px;font-weight:600;color:#e85d26;">
                                            {{ $lesson->available_date?->format('l, j F Y') ?? 'To be confirmed' }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Reason --}}
                    @if($lesson->reschedule_reason)
                    <tr>
                        <td style="padding:20px 40px 0;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="background-color:#fffbeb;border-left:3px solid #f59e0b;border-radius:0 8px 8px 0;padding:14px 18px;">
                                        <p style="margin:0 0 4px;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#92400e;">Note from instructor</p>
                                        <p style="margin:0;font-size:14px;color:#78350f;line-height:1.6;">{{ $lesson->reschedule_reason }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @endif

                    {{-- Footer --}}
                    <tr>
                        <td style="padding:32px 40px;text-align:center;border-top:1px solid #f1f5f9;margin-top:28px;">
                            <p style="margin:0;font-size:12px;color:#94a3b8;">
                                You are receiving this because you are enrolled in this course.<br>
                                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
