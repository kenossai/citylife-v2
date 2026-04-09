<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Enrollment Request</title>
</head>
<body style="margin:0;padding:0;background-color:#f3f4f6;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;">
@php $logoSrc = 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('images/logo_small_black.png'))); @endphp
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
                            <p style="margin:0 0 6px;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#e85d26;">Course Enrollment</p>
                            <p style="margin:0 0 16px;font-size:22px;font-weight:800;color:#1e293b;">New Enrollment Request</p>
                            <p style="margin:0;font-size:15px;color:#475569;line-height:1.6;">
                                Someone has requested to enrol in a course and is awaiting your approval.
                            </p>
                        </td>
                    </tr>

                    {{-- Details --}}
                    <tr>
                        <td style="padding:24px 40px 0;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #e2e8f0;border-radius:10px;overflow:hidden;">
                                <tr>
                                    <td style="padding:14px 18px;border-bottom:1px solid #f1f5f9;">
                                        <p style="margin:0 0 3px;font-size:10px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#94a3b8;">Student</p>
                                        <p style="margin:0;font-size:15px;font-weight:600;color:#1e293b;">{{ $enrollment->member->full_name }}</p>
                                        <p style="margin:2px 0 0;font-size:13px;color:#64748b;">{{ $enrollment->member->email }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 18px;border-bottom:1px solid #f1f5f9;">
                                        <p style="margin:0 0 3px;font-size:10px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#94a3b8;">Course</p>
                                        <p style="margin:0;font-size:15px;font-weight:600;color:#1e293b;">{{ $enrollment->course->title }}</p>
                                        @if($enrollment->course->instructor_name)
                                        <p style="margin:2px 0 0;font-size:13px;color:#64748b;">Instructor: {{ $enrollment->course->instructor_name }}</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 18px;">
                                        <p style="margin:0 0 3px;font-size:10px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#94a3b8;">Requested On</p>
                                        <p style="margin:0;font-size:15px;font-weight:600;color:#1e293b;">{{ $enrollment->enrolled_at->format('j F Y, g:i A') }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- CTA --}}
                    <tr>
                        <td style="padding:24px 40px 32px;text-align:center;">
                            <p style="margin:0 0 20px;font-size:15px;color:#475569;line-height:1.6;text-align:left;">
                                Click the button below to review and approve or decline this enrollment request.
                            </p>
                            <table cellpadding="0" cellspacing="0" style="margin:0 auto;">
                                <tr>
                                    <td style="border-radius:10px;background-color:#e85d26;">
                                        <a href="{{ url('/admin/course-enrollments/' . $enrollment->id . '/edit') }}"
                                           style="display:inline-block;padding:14px 36px;font-size:15px;font-weight:700;color:#ffffff;text-decoration:none;border-radius:10px;">
                                            Review &amp; Approve
                                        </a>
                                    </td>
                                </tr>
                            </table>
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
