<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
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
                            <p style="margin:0 0 6px;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#e85d26;">Contact Message</p>
                            <p style="margin:0 0 16px;font-size:22px;font-weight:800;color:#1e293b;">New Message Received</p>
                            <p style="margin:0;font-size:15px;color:#475569;line-height:1.6;">
                                Someone has sent a message through the website and is awaiting a response.
                            </p>
                        </td>
                    </tr>

                    {{-- Details --}}
                    <tr>
                        <td style="padding:24px 40px 28px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="border:1px solid #e2e8f0;border-radius:10px;overflow:hidden;">
                                <tr>
                                    <td style="padding:14px 18px;border-bottom:1px solid #f1f5f9;">
                                        <p style="margin:0 0 3px;font-size:10px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#94a3b8;">From</p>
                                        <p style="margin:0;font-size:15px;font-weight:600;color:#1e293b;">{{ $contact->name }}</p>
                                        <p style="margin:2px 0 0;font-size:13px;color:#64748b;">{{ $contact->email }}</p>
                                        @if($contact->phone)
                                        <p style="margin:2px 0 0;font-size:13px;color:#64748b;">{{ $contact->phone }}</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 18px;border-bottom:1px solid #f1f5f9;">
                                        <p style="margin:0 0 3px;font-size:10px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#94a3b8;">Enquiry Type</p>
                                        <p style="margin:0;font-size:15px;font-weight:600;color:#1e293b;">{{ ucfirst(str_replace('-', ' ', $contact->enquiry_type)) }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 18px;border-bottom:1px solid #f1f5f9;">
                                        <p style="margin:0 0 3px;font-size:10px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#94a3b8;">Subject</p>
                                        <p style="margin:0;font-size:15px;font-weight:600;color:#1e293b;">{{ $contact->subject }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 18px;">
                                        <p style="margin:0 0 6px;font-size:10px;font-weight:700;letter-spacing:1px;text-transform:uppercase;color:#94a3b8;">Message</p>
                                        <p style="margin:0;font-size:14px;color:#475569;line-height:1.7;white-space:pre-line;">{{ $contact->message }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Closing --}}
                    <tr>
                        <td style="padding:0 40px 36px;border-top:1px solid #f1f5f9;">
                            <p style="margin:24px 0 0;font-size:13px;color:#94a3b8;">
                                Received {{ now()->format('j F Y, g:i A') }} &middot; City Life International Church, Sheffield
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
