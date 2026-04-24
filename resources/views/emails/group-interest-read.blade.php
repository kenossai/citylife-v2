<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>We've received your interest</title>
</head>
<body style="margin:0;padding:0;background-color:#f3f4f6;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;">
@php
    $_logoPath = public_path('images/logo_small_black.png');
    $logoSrc = file_exists($_logoPath)
        ? 'data:image/png;base64,' . base64_encode(file_get_contents($_logoPath))
        : asset('images/logo_small_black.png');
    $ministryName = $enquiry->ministry?->name ?? 'Life Group';
    $firstName    = explode(' ', trim($enquiry->full_name))[0] ?? $enquiry->full_name;
@endphp

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
                            <p style="margin:0 0 6px;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#e85d26;">Life Groups</p>
                            <p style="margin:0 0 16px;font-size:22px;font-weight:800;color:#1e293b;">We've received your interest! 🙌</p>
                            <p style="margin:0 0 16px;font-size:15px;color:#475569;line-height:1.6;">
                                Hi <strong style="color:#1e293b;">{{ $firstName }}</strong>, thank you for expressing your interest in joining
                                <strong style="color:#1e293b;">{{ $ministryName }}</strong>.
                            </p>
                            <p style="margin:0;font-size:15px;color:#475569;line-height:1.6;">
                                A member of our team has reviewed your request and we will be in touch with you shortly to connect you with the right people.
                            </p>
                        </td>
                    </tr>

                    {{-- Ministry Details Box --}}
                    <tr>
                        <td style="padding:24px 40px 0;">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="background-color:#fff7f3;border:1px solid #fde0cf;border-radius:10px;padding:18px 22px;">
                                        <p style="margin:0 0 4px;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#e85d26;">Your Interest</p>
                                        <p style="margin:0 0 6px;font-size:17px;font-weight:700;color:#1e293b;">{{ $ministryName }}</p>
                                        @if($enquiry->message)
                                        <p style="margin:0;font-size:13px;color:#64748b;line-height:1.5;font-style:italic;">"{{ $enquiry->message }}"</p>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- What happens next --}}
                    <tr>
                        <td style="padding:24px 40px 0;">
                            <p style="margin:0 0 12px;font-size:14px;font-weight:700;color:#1e293b;">What happens next?</p>
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="padding:0 0 10px;">
                                        <table cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="width:28px;vertical-align:top;padding-top:1px;">
                                                    <div style="width:22px;height:22px;border-radius:50%;background-color:#e85d26;text-align:center;line-height:22px;font-size:11px;font-weight:700;color:#fff;">1</div>
                                                </td>
                                                <td style="font-size:14px;color:#475569;line-height:1.5;padding-left:10px;">Our team will review your interest and match you with the right Life Group leader.</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:0 0 10px;">
                                        <table cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="width:28px;vertical-align:top;padding-top:1px;">
                                                    <div style="width:22px;height:22px;border-radius:50%;background-color:#e85d26;text-align:center;line-height:22px;font-size:11px;font-weight:700;color:#fff;">2</div>
                                                </td>
                                                <td style="font-size:14px;color:#475569;line-height:1.5;padding-left:10px;">You'll receive a personal follow-up from one of our pastors or group leaders.</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="width:28px;vertical-align:top;padding-top:1px;">
                                                    <div style="width:22px;height:22px;border-radius:50%;background-color:#e85d26;text-align:center;line-height:22px;font-size:11px;font-weight:700;color:#fff;">3</div>
                                                </td>
                                                <td style="font-size:14px;color:#475569;line-height:1.5;padding-left:10px;">Get connected, grow in community, and do life together!</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Divider --}}
                    <tr>
                        <td style="padding:28px 40px 0;">
                            <hr style="border:none;border-top:1px solid #f1f5f9;margin:0;">
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="padding:24px 40px 36px;text-align:center;">
                            <p style="margin:0 0 6px;font-size:13px;color:#94a3b8;">
                                Questions? Reply to this email or contact us at
                                <a href="mailto:{{ config('mail.from.address') }}" style="color:#e85d26;text-decoration:none;">{{ config('mail.from.address') }}</a>
                            </p>
                            <p style="margin:0;font-size:12px;color:#cbd5e1;">
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
