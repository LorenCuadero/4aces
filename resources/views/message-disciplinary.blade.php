<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Student Disciplinary Notification Message</title>
</head>

<body>
    <p>Hello {{ $student_name }},</p>

    <p>I hope this email finds you well.</p>
    <p>This message is to inform you that, unfortunately, we need to address some concerns regarding your recent
        performance. <br>
        This is your

        @if (isset($student_verbal_warning_date))
            Formal Verbal Warning
        @endif
        @if (isset($student_written_warning_date))
            Written Warning
        @endif
        @if (isset($student_provisionary_date))
            Probationary
        @endif
        .
        This is issued in response to (
        @if (isset($student_verbal_warning_description))
            {{ $student_verbal_warning_description }}
        @endif
        @if (isset($student_written_warning_description))
            {{ $student_written_warning_description }}
        @endif
        @if (isset($student_provisionary_description))
            {{ $student_provisionary_description }}
        @endif

        ) last (
        @if (isset($student_verbal_warning_date))
            {{ \Carbon\Carbon::parse($student_verbal_warning_date)->format('F d, Y') }}
        @endif
        @if (isset($student_written_warning_date))
            {{ \Carbon\Carbon::parse($student_written_warning_date)->format('F d, Y') }}
        @endif
        @if (isset($student_provisionary_date))
            {{ \Carbon\Carbon::parse($student_provisionary_date)->format('F d, Y') }}
        @endif
        ). <br>We value
        you our dear student and believe that with the right adjustments, we can overcome these challenges together. It
        is
        crucial that we address these issues promptly to maintain a positive and productive environment. Additionally,
        please feel free to reach out if you have any questions or if you would like to discuss this matter further.
    </p>

    <p>We are confident that, with your commitment and cooperation, we can work towards a resolution and a more positive
        relationship, moving forward.</p>
    <p>Thank you for your understanding and cooperation in this matter.</p>
    <p>Best,<br>{{ \Auth::user()->name }}
        <br>Passerelles Numeriques
        Philippines
    </p>

</body>

</html>
