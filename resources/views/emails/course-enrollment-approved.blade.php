<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Approved</title>
</head>
<body style="margin:0;padding:0;background-color:#f9fafb;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f9fafb;padding:40px 20px;">
        <tr>
            <td align="center">
                <table width="480" cellpadding="0" cellspacing="0" style="background-color:#13131f;border-radius:16px;overflow:hidden;">

                    {{-- Header --}}
                    <tr>
                        <td style="padding:32px 32px 0;text-align:center;">
                            <p style="margin:0;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#e85d26;">
                                {{ $enrollment->course->category ?? 'Bible School' }}
                            </p>
                            <h1 style="margin:12px 0 0;font-size:22px;font-weight:800;color:#ffffff;">
                                You're In! 🎉
                            </h1>
                            <p style="margin:8px 0 0;font-size:14px;color:rgba(255,255,255,0.5);line-height:1.5;">
                                Your enrollment has been approved. Welcome to the course!
                            </p>
                        </td>
                    </tr>

                    {{-- Course Card --}}
                    <tr>
                        <td style="padding:24px 32px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color:rgba(232,93,38,0.1);border:1px solid rgba(232,93,38,0.25);border-radius:12px;overflow:hidden;">
                                <tr>
                                    <td style="padding:20px 20px 0;">
                                        <p style="margin:0;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:rgba(232,93,38,0.8);">Course</p>
                                        <p style="margin:6px 0 0;font-size:18px;font-weight:700;color:#ffffff;">{{ $enrollment->course->title }}</p>
                                    </td>
                                </tr>
                                @if ($enrollment->course->instructor_name)
                                <tr>
                                    <td style="padding:8px 20px 0;">
                                        <p style="margin:0;font-size:13px;color:rgba(255,255,255,0.5);">Instructor: {{ $enrollment->course->instructor_name }}</p>
                                    </td>
                                </tr>
                                @endif
                                @if ($enrollment->course->start_date)
                                <tr>
                                    <td style="padding:8px 20px 20px;">
                                        <p style="margin:0;font-size:13px;color:rgba(255,255,255,0.5);">Starts: {{ $enrollment->course->start_date->format('j F Y') }}</p>
                                    </td>
                                </tr>
                                @else
                                <tr><td style="padding-bottom:20px;"></td></tr>
                                @endif
                            </table>
                        </td>
                    </tr>

                    {{-- Membership note (CDC) --}}
                    @if ($enrollment->course->is_membership_course)
                    <tr>
                        <td style="padding:0 32px 8px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.2);border-radius:12px;">
                                <tr>
                                    <td style="padding:16px 20px;">
                                        <p style="margin:0;font-size:13px;font-weight:600;color:#4ade80;">Church Membership</p>
                                        <p style="margin:4px 0 0;font-size:13px;color:rgba(255,255,255,0.5);line-height:1.5;">
                                            As part of completing this course you will be welcomed as an active member of City Life International Church. We look forward to journeying with you!
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    @endif

                    {{-- Footer message --}}
                    <tr>
                        <td style="padding:16px 32px 0;text-align:center;">
                            <p style="margin:0;font-size:13px;color:rgba(255,255,255,0.4);line-height:1.6;">
                                Welcome, {{ $enrollment->member->first_name }}! If you have any questions, feel free to reach out to us. We are excited to have you on this journey.
                            </p>
                        </td>
                    </tr>

                    {{-- CTA button --}}
                    <tr>
                        <td style="padding:24px 32px 32px;text-align:center;">
                            @if ($enrollment->member->password_setup_token)
                                {{-- First-time member: create password --}}
                                <a href="{{ route('member.setup-password.show', $enrollment->member->password_setup_token) }}"
                                   style="display:inline-block;background-color:#e85d26;color:#ffffff;font-size:14px;font-weight:700;text-decoration:none;padding:14px 32px;border-radius:100px;">
                                    Create Password &amp; Access Dashboard →
                                </a>
                                <p style="margin:14px 0 0;font-size:12px;color:rgba(255,255,255,0.3);">
                                    This link expires in 7 days. If it expires, you can request a new one from the login page.
                                </p>
                            @else
                                {{-- Returning member: go straight to dashboard --}}
                                <a href="{{ route('member.dashboard') }}"
                                   style="display:inline-block;background-color:#e85d26;color:#ffffff;font-size:14px;font-weight:700;text-decoration:none;padding:14px 32px;border-radius:100px;">
                                    Go to My Dashboard →
                                </a>
                            @endif
                        </td>
                    </tr>

                </table>

                <p style="margin:20px 0 0;font-size:12px;color:#98a2b3;">
                    &copy; {{ date('Y') }} City Life International Church
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
