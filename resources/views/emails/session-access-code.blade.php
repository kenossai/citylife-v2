<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Access Code</title>
</head>
<body style="margin:0;padding:0;background-color:#f9fafb;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f9fafb;padding:40px 20px;">
        <tr>
            <td align="center">
                <table width="480" cellpadding="0" cellspacing="0" style="background-color:#13131f;border-radius:16px;overflow:hidden;">
                    {{-- Header --}}
                    <tr>
                        <td style="padding:32px 32px 0;text-align:center;">
                            <p style="margin:0;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#ff8904;">
                                Bible School International
                            </p>
                            <h1 style="margin:12px 0 0;font-size:24px;font-weight:800;color:#ffffff;">
                                Your Access Code
                            </h1>
                            <p style="margin:8px 0 0;font-size:14px;color:rgba(255,255,255,0.5);line-height:1.5;">
                                Use the code below to unlock your teaching sessions.
                            </p>
                        </td>
                    </tr>

                    {{-- Code --}}
                    <tr>
                        <td style="padding:24px 32px;text-align:center;">
                            <div style="display:inline-block;padding:16px 40px;background-color:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:12px;">
                                <span style="font-size:32px;font-weight:800;letter-spacing:8px;color:#ffffff;font-family:'Courier New',monospace;">{{ $code }}</span>
                            </div>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="padding:0 32px 32px;text-align:center;">
                            <p style="margin:0;font-size:13px;color:rgba(255,255,255,0.35);line-height:1.5;">
                                This code expires in 15 minutes. If you didn't request this, you can safely ignore this email.
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
