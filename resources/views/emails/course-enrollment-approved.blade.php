<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Approved</title>
</head>
<body style="margin:0;padding:0;background-color:#f3f4f6;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;">
@php $_logoPath = public_path('images/logo_small_black.png'); $logoSrc = file_exists($_logoPath) ? 'data:image/png;base64,' . base64_encode(file_get_contents($_logoPath)) : asset('images/logo_small_black.png'); @endphp
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f3f4f6;padding:48px 20px;">
        <tr>
            <td align="center">

                {{-- Card --}}
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
                            <p style="margin:0 0 6px;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#e85d26;">Welcome</p>
                            <p style="margin:0 0 16px;font-size:22px;font-weight:800;color:#1e293b;">You're Enrolled! 🎉</p>
                            <p style="margin:0;font-size:15px;color:#475569;line-height:1.6;">
                                Hello, <strong style="color:#1e293b;">{{ $enrollment->member?->first_name ?? $enrollment->guest_name }}</strong>! Your enrollment has been approved. Welcome to the course!
                            </p>
                        </td>
                    </tr>

                    {{-- Course Details Box --}}
                    <tr>
                        <td style="padding:24px 40px 0;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="background-color:#f1f5f9;border-radius:10px;padding:18px 22px;">
                                        <p style="margin:0 0 4px;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#94a3b8;">Course</p>
                                        <p style="margin:0 0 4px;font-size:17px;font-weight:700;color:#1e293b;">{{ $enrollment->course->title }}</p>
                                        @if($enrollment->course->instructor_name)
                                        <p style="margin:0 0 2px;font-size:13px;color:#64748b;">Instructor: {{ $enrollment->course->instructor_name }}</p>
                                        @endif
                                        @if($enrollment->course->start_date)
                                        <p style="margin:0;font-size:13px;color:#64748b;">Starts: {{ $enrollment->course->start_date->format('j F Y') }}</p>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Membership Note --}}
                    @if($enrollment->course->is_membership_course)
                    <tr>
                        <td style="padding:16px 40px 0;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="background-color:#f0fdf4;border:1px solid #bbf7d0;border-radius:10px;padding:14px 18px;">
                                        <p style="margin:0 0 3px;font-size:13px;font-weight:700;color:#15803d;">Church Membership</p>
                                        <p style="margin:0;font-size:13px;color:#475569;line-height:1.5;">
                                            As part of completing this course you will be welcomed as an active member of City Life International Church. We look forward to journeying with you!
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @endif

                    {{-- CTA --}}
                    <tr>
                        <td style="padding:24px 40px 0;text-align:center;">
                            @if($enrollment->member?->password_setup_token)
                            <p style="margin:0 0 20px;font-size:15px;color:#475569;line-height:1.6;text-align:left;">
                                Click the button below to create your password and access your learning dashboard.
                            </p>
                            <table cellpadding="0" cellspacing="0" style="margin:0 auto;">
                                <tr>
                                    <td style="border-radius:10px;background-color:#e85d26;">
                                        <a href="{{ route('member.setup-password.show', $enrollment->member->password_setup_token) }}"
                                           style="display:inline-block;padding:14px 36px;font-size:15px;font-weight:700;color:#ffffff;text-decoration:none;border-radius:10px;">
                                            Create Password &amp; Access Dashboard
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            @elseif($enrollment->member)
                            <p style="margin:0 0 20px;font-size:15px;color:#475569;line-height:1.6;text-align:left;">
                                You can now access your course from your member dashboard.
                            </p>
                            <table cellpadding="0" cellspacing="0" style="margin:0 auto;">
                                <tr>
                                    <td style="border-radius:10px;background-color:#e85d26;">
                                        <a href="{{ route('member.dashboard') }}"
                                           style="display:inline-block;padding:14px 36px;font-size:15px;font-weight:700;color:#ffffff;text-decoration:none;border-radius:10px;">
                                            Go to My Dashboard
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            @else
                            <p style="margin:0 0 20px;font-size:15px;color:#475569;line-height:1.6;text-align:left;">
                                We will be in touch with more details about your course. If you have any questions in the meantime, feel free to contact us.
                            </p>
                            @endif
                        </td>
                    </tr>

                    {{-- Password link expiry notice --}}
                    @if($enrollment->member?->password_setup_token)
                    <tr>
                        <td style="padding:16px 40px 32px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="background-color:#fffbeb;border:1px solid #fde68a;border-radius:10px;padding:14px 18px;">
                                        <p style="margin:0;font-size:13px;color:#92400e;line-height:1.5;">
                                            &#9675; This link expires in <strong>7 days</strong>. If it expires, you can request a new one from the login page.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @else
                    <tr><td style="padding-bottom:32px;"></td></tr>
                    @endif

                    {{-- Closing --}}
                    <tr>
                        <td style="padding:0 40px 36px;border-top:1px solid #f1f5f9;">
                            <p style="margin:24px 0 4px;font-size:15px;color:#475569;line-height:1.6;">
                                We are excited to have you on this journey. If you have any questions, do not hesitate to reach out to us.
                            </p>
                            <p style="margin:16px 0 0;font-size:15px;color:#475569;">
                                In Christ,<br>
                                <strong style="color:#1e293b;">The {{ config('app.name') }} Team</strong>
                            </p>
                        </td>
                    </tr>

                </table>

                {{-- Footer --}}
                <p style="margin:20px 0 0;font-size:12px;color:#94a3b8;">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                </p>

            </td>
        </tr>
    </table>
</body>
</html>
