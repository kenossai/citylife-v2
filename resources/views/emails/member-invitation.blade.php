<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You have been registered</title>
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
                            <p style="margin:0 0 6px;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#e85d26;">Member Portal</p>
                            <p style="margin:0 0 16px;font-size:22px;font-weight:800;color:#1e293b;">Welcome to {{ config('app.name') }}!</p>
                            <p style="margin:0 0 16px;font-size:15px;color:#475569;line-height:1.6;">
                                Hello, <strong style="color:#1e293b;">{{ $member->first_name }}</strong>. You have been registered as a member of
                                <strong style="color:#1e293b;">{{ config('app.name') }}</strong>.
                            </p>
                            <p style="margin:0;font-size:15px;color:#475569;line-height:1.6;">
                                To access your member dashboard — where you can view courses, lessons, and your progress — please set up your password using the button below.
                            </p>
                        </td>
                    </tr>

                    {{-- CTA Button --}}
                    <tr>
                        <td style="padding:28px 40px 0;text-align:center;">
                            <a href="{{ $setupUrl }}" style="display:inline-block;background-color:#e85d26;color:#ffffff;font-size:15px;font-weight:700;text-decoration:none;padding:14px 32px;border-radius:100px;">
                                Set Up My Password
                            </a>
                        </td>
                    </tr>

                    {{-- Expiry notice --}}
                    <tr>
                        <td style="padding:20px 40px 0;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="background-color:#fffbeb;border:1px solid #fde68a;border-radius:10px;padding:14px 18px;">
                                        <p style="margin:0;font-size:13px;color:#92400e;line-height:1.5;">
                                            &#9675; This link will expire in <strong>7 days</strong>. If you were not expecting this email, you can safely ignore it.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Plain-text fallback link --}}
                    <tr>
                        <td style="padding:20px 40px 0;">
                            <p style="margin:0;font-size:12px;color:#94a3b8;line-height:1.6;">
                                If the button above doesn't work, copy and paste this URL into your browser:
                            </p>
                            <p style="margin:6px 0 0;font-size:12px;color:#64748b;word-break:break-all;">
                                {{ $setupUrl }}
                            </p>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="padding:28px 40px 36px;">
                            <p style="margin:0;font-size:13px;color:#94a3b8;line-height:1.6;">
                                — The {{ config('app.name') }} Team
                            </p>
                        </td>
                    </tr>

                    {{-- Bottom bar --}}
                    <tr>
                        <td style="background-color:#f8fafc;border-top:1px solid #f1f5f9;padding:16px 40px;text-align:center;">
                            <p style="margin:0;font-size:11px;color:#cbd5e1;">
                                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
