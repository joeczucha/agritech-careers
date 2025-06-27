<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            padding: 2rem;
        }

        .container {
            background-color: #ffffff;
            border-radius: 6px;
            padding: 2rem;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .heading {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            color: #1a202c;
        }

        .field {
            margin-bottom: 1rem;
        }

        .label {
            font-weight: bold;
            margin-bottom: 0.25rem;
            display: block;
            color: #4a5568;
        }

        .value {
            color: #2d3748;
        }

        .note {
            white-space: pre-wrap;
            border-left: 3px solid #e2e8f0;
            padding-left: 1rem;
            margin-top: 0.5rem;
            color: #2d3748;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="heading">New Contact Form Submission</div>

        <div class="field">
            <span class="label">First Name:</span>
            <span class="value">{{ $application->first_name }}</span>
        </div>

        <div class="field">
            <span class="label">Last Name:</span>
            <span class="value">{{ $application->last_name }}</span>
        </div>

        <div class="field">
            <span class="label">Email:</span>
            <span class="value">{{ $application->email }}</span>
        </div>

        <div class="field">
            <span class="label">LinkedIn Profile:</span>
            <span class="value">
                <a href="{{ $application->linkedin_profile }}">{{ $application->linkedin_profile }}</a>
            </span>
        </div>

        <div class="field">
            <span class="label">Phone:</span>
            <span class="value">{{ $application->phone }}</span>
        </div>

        <div class="field">
            <span class="label">Location:</span>
            <span class="value">{{ $application->location }}</span>
        </div>

        <div class="field">
            <span class="label">Cover Note:</span>
            <div class="note">{!! $application->cover_note !!}</div>
        </div>

        <p style="margin-top: 2rem; color: #718096;">
            Submission received {{ $application->created_at->format('d M Y \a\t H:i') }}
        </p>
    </div>
</body>

</html>
