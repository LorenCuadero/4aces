<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Student Account Creation Message</title>
</head>

<body>
    <p>Hello {{ $student_name }},</p>
    <p>{{ $course }}, was updated

        @if (isset($year_and_sem))
            for @if ($year_and_sem == 0)
                1st year - first semester
                @endif @if ($year_and_sem == 1)
                    1st year - second semester
                @endif
                @if ($year_and_sem == 2)
                    2nd year - first semester
                @endif
                @if ($year_and_sem == 3)
                    2nd year - second semester
                @endif
                @if ($year_and_sem == 4)
                    3rd year - first semester
                @endif
            @endif
            @if (isset($midterm))
                and your midterm grade is {{ $midterm }}
            @endif
            @if (isset($final_grade))
                , and your final grade is {{ $final_grade }}.
            @endif
            .
    </p>
    <p>For further details, kindly click this link: <a href="https://pnphioms.online/login" title="PNPh ioms page">PNPh
            IOMS</a></p>
    <p>Thank you,<br>Passerelles Numériques Philippines</p>
</body>

</html>
