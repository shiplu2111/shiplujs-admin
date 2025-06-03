<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @php
    $setting = \App\Models\Setting::first();
@endphp
    <title>Reply from {{  $setting?->site_name }}</title>
    <style>

        body {
            margin: 0;
            padding: 0;
            background-color: #f2f4f6;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }
        .email-wrapper {
            width: 100%;
            background-color: #f2f4f6;
            padding: 20px;
        }
        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }
        .email-header {
            background-color: #0d6efd;
            padding: 20px;
            text-align: center;
            color: #ffffff;
            font-size: 24px;
            font-weight: bold;
        }
        .email-body {
            padding: 30px;
            color: #333333;
            font-size: 16px;
            line-height: 1.6;
        }
        .email-footer {
            text-align: center;
            padding: 20px;
            font-size: 13px;
            color: #888888;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #0d6efd;
            color: #ffffff;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
        }
        .message-content {
            white-space: pre-line;
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-left: 4px solid #0d6efd;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <div class="email-wrapper">
        <div class="email-content">
            <div class="email-header">
                {{ $setting?->site_name }}
            </div>

            <div class="email-body">
                <p>Hello,</p>

                <p>We have responded to your message. Please see our reply below:</p>

                <div class="message-content">
                   {!! $reply !!}
                </div>

                <a href="{{  $setting?->website_url }}" class="button">Visit Our Website</a>
            </div>

            <div class="email-footer">
                &copy; {{ date('Y') }} {{  $setting?->site_name }}. All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>
