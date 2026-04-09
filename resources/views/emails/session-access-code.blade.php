<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Access Code</title>
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
                            <p style="margin:0 0 6px;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#e85d26;">Bible School International</p>
                            <p style="margin:0 0 16px;font-size:22px;font-weight:800;color:#1e293b;">Your Access Code</p>
                            <p style="margin:0;font-size:15px;color:#475569;line-height:1.6;">
                                Use the code below to unlock your teaching sessions.
                            </p>
                        </td>
                    </tr>

                    {{-- Code Box --}}
                    <tr>
                        <td style="padding:24px 40px 0;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="background-color:#f1f5f9;border-radius:10px;padding:24px;text-align:center;">
                                        <p style="margin:0 0 4px;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#94a3b8;">Your Code</p>
                                        <p style="margin:0;font-size:36px;font-weight:800;letter-spacing:10px;color:#1e293b;font-family:'Courier New',monospace;">{{ $code }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Notice --}}
                    <tr>
                        <td style="padding:24px 40px 32px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="background-color:#fffbeb;border:1px solid #fde68a;border-radius:10px;padding:14px 18px;">
                                        <p style="margin:0;font-size:13px;color:#92400e;line-height:1.5;">
                                            &#9675; This code expires in <strong>15 minutes</strong>. If you did not request this, you can safely ignore this email.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Closing --}}
                    <tr>
                        <td style="padding:0 40px 36px;border-top:1px solid #f1f5f9;">
                            <p style="margin:24px 0 0;font-size:15px;color:#475569;">
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
