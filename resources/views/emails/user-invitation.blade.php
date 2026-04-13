<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>You're Invited</title>
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
                            <p style="margin:0 0 16px;font-size:16px;color:#1e293b;">
                                Hello, <strong>{{ $user->name }}</strong>
                            </p>
                            <p style="margin:0 0 16px;font-size:15px;color:#475569;line-height:1.6;">
                                You have been invited to join the <strong style="color:#1e293b;">{{ config('app.name') }}</strong>
                                admin dashboard by <strong style="color:#1e293b;">{{ $inviterName }}</strong>.
                            </p>
                            <p style="margin:0 0 24px;font-size:15px;color:#475569;line-height:1.6;">
                                This platform helps manage members, ministries, events, and communication all in one place.
                            </p>
                        </td>
                    </tr>

                    {{-- Role Box --}}
                    <tr>
                        <td style="padding:0 40px 28px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="background-color:#f1f5f9;border-radius:10px;padding:18px 22px;">
                                        <p style="margin:0 0 4px;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#94a3b8;">
                                            Your Role
                                        </p>
                                        <p style="margin:0;font-size:17px;font-weight:700;color:#1e40af;">
                                            {{ ucfirst(str_replace('_', ' ', $roleName)) }}
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- CTA --}}
                    <tr>
                        <td style="padding:0 40px 32px;text-align:center;">
                            <p style="margin:0 0 20px;font-size:15px;color:#475569;line-height:1.6;text-align:left;">
                                Click the button below to accept the invitation and set up your account.
                            </p>
                            <table cellpadding="0" cellspacing="0" style="margin:0 auto;">
                                <tr>
                                    <td style="border-radius:10px;background-color:#e85d26;">
                                        <a href="{{ $acceptUrl }}"
                                           style="display:inline-block;padding:14px 36px;font-size:15px;font-weight:700;color:#ffffff;text-decoration:none;border-radius:10px;">
                                            Accept Invitation
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Notice --}}
                    <tr>
                        <td style="padding:0 40px 32px;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="background-color:#fffbeb;border:1px solid #fde68a;border-radius:10px;padding:14px 18px;">
                                        <p style="margin:0;font-size:13px;color:#92400e;line-height:1.5;">
                                            &#9675; This invitation link expires in <strong>48 hours</strong>. Clicking it will take you directly to a page where you can set your own password.
                                            If you were not expecting this invitation, you can safely ignore this email.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Closing --}}
                    <tr>
                        <td style="padding:0 40px 36px;border-top:1px solid #f1f5f9;">
                            <p style="margin:24px 0 4px;font-size:15px;color:#475569;line-height:1.6;">
                                Welcome aboard. We're excited to have you on the team and look forward to serving together.
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
