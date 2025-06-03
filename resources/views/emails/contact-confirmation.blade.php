<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Confirmation</title>
</head>
<body>
    @php
        $setting = \App\Models\Setting::first();
    @endphp
    <h2>Hello {{ $contact->name }},</h2>
    <p>Thank you for contacting us. We have received your message:</p>

    <p><strong>Subject:</strong> {{ $contact->subject }}</p>
    <p><strong>Message:</strong> {{ $contact->message }}</p>

    <p>We will get back to you as soon as possible.</p>

    <br>
    <p>Best Regards,</p>
    <p style="margin-top: 30px;">Have questions or want to collaborate? Just hit reply to this email — I'd love to
        hear from you!</p>

    <p style="margin-top: 30px;>
        ©{{ \Carbon\Carbon::now()->year }} <a href="{{ $setting?->website_url }}">{{ $setting?->site_name }}</a>
      </p>
    </div>
</body>
</html>
