<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
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
                                Contact Message
                            </p>
                            <h1 style="margin:12px 0 0;font-size:22px;font-weight:800;color:#ffffff;">
                                New Message Received
                            </h1>
                            <p style="margin:8px 0 0;font-size:14px;color:rgba(255,255,255,0.5);line-height:1.5;">
                                Someone has sent a message through the City Life International website.
                            </p>
                        </td>
                    </tr>

                    {{-- Details Card --}}
                    <tr>
                        <td style="padding:24px 32px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.08);border-radius:12px;overflow:hidden;">
                                <tr>
                                    <td style="padding:16px 20px;border-bottom:1px solid rgba(255,255,255,0.06);">
                                        <p style="margin:0;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:rgba(255,255,255,0.35);">From</p>
                                        <p style="margin:4px 0 0;font-size:15px;font-weight:600;color:#ffffff;">{{ $contact->name }}</p>
                                        <p style="margin:2px 0 0;font-size:13px;color:rgba(255,255,255,0.5);">{{ $contact->email }}</p>
                                        @if($contact->phone)
                                        <p style="margin:2px 0 0;font-size:13px;color:rgba(255,255,255,0.5);">{{ $contact->phone }}</p>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:16px 20px;border-bottom:1px solid rgba(255,255,255,0.06);">
                                        <p style="margin:0;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:rgba(255,255,255,0.35);">Enquiry Type</p>
                                        <p style="margin:4px 0 0;font-size:15px;font-weight:600;color:#ffffff;">{{ ucfirst(str_replace('-', ' ', $contact->enquiry_type)) }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:16px 20px;border-bottom:1px solid rgba(255,255,255,0.06);">
                                        <p style="margin:0;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:rgba(255,255,255,0.35);">Subject</p>
                                        <p style="margin:4px 0 0;font-size:15px;font-weight:600;color:#ffffff;">{{ $contact->subject }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:16px 20px;">
                                        <p style="margin:0;font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:rgba(255,255,255,0.35);">Message</p>
                                        <p style="margin:8px 0 0;font-size:14px;line-height:1.7;color:rgba(255,255,255,0.8);white-space:pre-line;">{{ $contact->message }}</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="padding:0 32px 32px;text-align:center;">
                            <p style="margin:0;font-size:12px;color:rgba(255,255,255,0.3);line-height:1.6;">
                                City Life International Church · Sheffield, UK<br>
                                Received {{ now()->format('j F Y, g:i A') }}
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
