<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Kontaktanfrage</title>
</head>
<body style="margin:0;padding:24px;background:#f5f6f8;font-family:Arial,Helvetica,sans-serif;color:#212529;">
    <div style="max-width:600px;margin:0 auto;background:#ffffff;border:1px solid #e5e7eb;border-radius:8px;padding:28px;">
        <h1 style="margin:0 0 4px;font-size:20px;">Neue Kontaktanfrage</h1>
        <p style="margin:0 0 24px;color:#6c757d;font-size:14px;">
            Eingegangen am {{ now()->format('d.m.Y \u\m H:i') }} Uhr
        </p>

        <table style="width:100%;border-collapse:collapse;font-size:14px;">
            <tr>
                <td style="padding:8px 0;color:#6c757d;width:140px;">Name</td>
                <td style="padding:8px 0;"><strong>{{ $data['name'] }}</strong></td>
            </tr>
            <tr>
                <td style="padding:8px 0;color:#6c757d;">E-Mail</td>
                <td style="padding:8px 0;"><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></td>
            </tr>
            @if(!empty($data['phone']))
            <tr>
                <td style="padding:8px 0;color:#6c757d;">Telefon</td>
                <td style="padding:8px 0;">{{ $data['phone'] }}</td>
            </tr>
            @endif
            <tr>
                <td style="padding:8px 0;color:#6c757d;">Betreff</td>
                <td style="padding:8px 0;">{{ $data['subject'] }}</td>
            </tr>
        </table>

        <hr style="border:0;border-top:1px solid #e5e7eb;margin:20px 0;">

        <p style="margin:0 0 8px;color:#6c757d;font-size:14px;">Nachricht</p>
        <p style="margin:0;font-size:14px;line-height:1.6;white-space:pre-line;">{{ $data['message'] }}</p>

        <hr style="border:0;border-top:1px solid #e5e7eb;margin:24px 0 12px;">
        <p style="margin:0;color:#6c757d;font-size:12px;">
            Antworten Sie einfach auf diese E-Mail, um {{ $data['name'] }} direkt zu erreichen.
        </p>
    </div>
</body>
</html>
