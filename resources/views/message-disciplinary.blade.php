{{-- <!DOCTYPE html>
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
        ).
        <br
        >We value
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

</html> --}}
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

        @if (isset($student_verbal_warning_date) || isset($student_written_warning_date) || isset($student_provisionary_date))
            <table style="border-collapse: collapse; width: 100%; border: 1px solid color rgb(31, 60, 136); font-size: 14px">
                <thead>
                    <tr>
                        <th style="border: 1px solid #000; padding: 8px;">Warning Type</th>
                        <th style="border: 1px solid #000; padding: 8px;">Warning Description</th>
                        <th style="border: 1px solid #000; padding: 8px;">Warning Date</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($student_verbal_warning_date))
                        <tr>
                            <td style="border: 1px solid #000; padding: 8px; text-align:center">Formal Verbal Warning</td>
                            <td style="border: 1px solid #000; padding: 8px;text-align:center">{{ $student_verbal_warning_description }}</td>
                            <td style="border: 1px solid #000; padding: 8px;text-align:center">{{ \Carbon\Carbon::parse($student_verbal_warning_date)->format('F d, Y') }}</td>
                        </tr>
                    @endif

                    @if (isset($student_written_warning_date))
                        <tr>
                            <td style="border: 1px solid #000; padding: 8px; text-align:center">Written Warning</td>
                            <td style="border: 1px solid #000; padding: 8px; text-align:center">{{ $student_written_warning_description }}</td>
                            <td style="border: 1px solid #000; padding: 8px; text-align:center">{{ \Carbon\Carbon::parse($student_written_warning_date)->format('F d, Y') }}</td>
                        </tr>
                    @endif

                    @if (isset($student_provisionary_date))
                        <tr>
                            <td style="border: 1px solid #000; padding: 8px; text-align:center">Probationary</td>
                            <td style="border: 1px solid #000; padding: 8px; text-align:center">{{ $student_provisionary_description }}</td>
                            <td style="border: 1px solid #000; padding: 8px; text-align:center">{{ \Carbon\Carbon::parse($student_provisionary_date)->format('F d, Y') }}</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        @else
            <p>No warnings to display.</p>
        @endif

        <p>We value you, our dear student, and believe that with the right adjustments, we can overcome these challenges together. It is crucial that we address these issues promptly to maintain a positive and productive environment. Additionally, please feel free to reach out if you have any questions or if you would like to discuss this matter further.</p>

        <p>We are confident that, with your commitment and cooperation, we can work towards a resolution and a more positive relationship, moving forward.</p>
        <p>Thank you for your understanding and cooperation in this matter.</p>
        <p>Best,<br>{{ \Auth::user()->name }}
            <br>Passerelles Numeriques
            Philippines
        </p>
</body>

</html>
