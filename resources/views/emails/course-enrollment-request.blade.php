<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Enrollment Request</title>
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
                                Course Enrollment
                            </p>
                            <h1 style="margin:12px 0 0;font-size:22px;font-weight:800;color:#ffffff;">
                                New Enrollment Request
                            </h1>
                            <p style="margin:8px 0 0;font-size:14px;color:rgba(255,255,255,0.5);line-height:1.5;">
                                Someone has requested to enrol in a course and is awaiting your approval.
                            </p>
                        </td>
                    </tr>

                    {{-- Details Card --}}
                    <tr>
                        <td style="padding:24px 32px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08);border-radius:12px;overflow:hidden;">
                                <tr>
                                    <td style="padding:16px 20px;border-bottom:1px solid rgba(255,255,255,0.06);">
                                        <p style="margin:0;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:rgba(255,255,255,0.35);">Student</p>
                                        <p style="margin:4px 0 0;font-size:15px;font-weight:600;color:#ffffff;">{{ $enrollment->member->full_name }}</p>
                                        <p style="margin:2px 0 0;font-size:13px;color:rgba(255,255,255,0.5);">{{ $enrollment->member->email }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:16px 20px;border-bottom:1px solid rgba(255,255,255,0.06);">
                                        <p style="margin:0;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:rgba(255,255,255,0.35);">Course</p>
                                        <p style="margin:4px 0 0;font-size:15px;font-weight:600;color:#ffffff;">{{ $enrollment->course->title }}</p>
                                        @if ($enrollment->course->instructor_name)
                                            <p style="margin:2px 0 0;font-size:13px;color:rgba(255,255,255,0.5);">Instructor: {{ $enrollment->course->instructor_name }}</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:16px 20px;">
                                        <p style="margin:0;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:rgba(255,255,255,0.35);">Requested On</p>
                                        <p style="margin:4px 0 0;font-size:15px;font-weight:600;color:#ffffff;">{{ $enrollment->enrolled_at->format('j F Y, g:i A') }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- CTA --}}
                    <tr>
                        <td style="padding:0 32px 32px;text-align:center;">
                            <a href="{{ url('/admin/course-enrollments/' . $enrollment->id . '/edit') }}"
                               style="display:inline-block;padding:14px 32px;background-color:#e85d26;border-radius:10px;font-size:14px;font-weight:700;color:#ffffff;text-decoration:none;">
                                Review &amp; Approve
                            </a>
                            <p style="margin:16px 0 0;font-size:12px;color:rgba(255,255,255,0.3);line-height:1.5;">
                                Log in to the admin panel to approve or decline this request.
                            </p>
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
