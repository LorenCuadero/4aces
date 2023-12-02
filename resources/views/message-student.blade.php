<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Student Account Creation Message</title>
</head>

<body>
    <p>Hello {{ $student_name }},</p>
    <p>You can now log in to your IOMS. Your credentials are as follows: <br>
        <b>Email:</b> {{ $student_email }} <br>
        <b>Password:</b> {{ $student_password }}
    </p>
    <p>Please use the provided credentials to log in initially. Once logged in, kindly change your password for your
        safety.</p>
    <p>Thank you,<br>Passerelles Numériques Philippines</p>
</body>

</html>
