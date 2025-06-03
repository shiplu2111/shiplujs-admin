<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You Email</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
        }

        .header img {
            max-width: 100px;
        }

        h1 {
            color: #333333;
        }

        p {
            color: #666666;
            line-height: 1.6;
        }

        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 24px;
            background-color: #007BFF;
            color: #ffffff;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #aaaaaa;
        }
    </style>
</head>

<body>

    <div class="email-container">
        <div class="header">
            @php
                $setting = \App\Models\Setting::first();

                if (!empty($setting->logo) && !filter_var($setting->logo, FILTER_VALIDATE_URL)) {
                    $setting->logo = asset('storage/' . ltrim($setting->logo, '/'));
                }
            @endphp
            <!-- Optional Logo -->
            <img src="{{ $setting?->logo }}" alt="{{ $setting?->site_name }}">
        </div>

        <h1>Thank You for Subscribing! 🎉</h1>
        <p>Hi Subscriber,</p>
        <p>Thank you for subscribing to {{ $setting?->site_name }}! I'm excited to have you here.</p>
        <p>You'll now get updates about my latest projects, creative work, and more.</p>

        <a href="{{ $setting?->website_url }}" class="button">Explore My Work</a>

        <p style="margin-top: 30px;">Have questions or want to collaborate? Just hit reply to this email — I'd love to
            hear from you!</p>

        <div class="footer">
            © {{ $setting?->site_name }} | {{ $setting?->website_url }} <br>
          </div>
        </div>
    </div>

</body>

</html>
