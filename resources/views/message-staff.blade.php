<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Staff Account Creation Message</title>
</head>

<body>
    <p>Hello {{ $staff_name }},</p>
    <p>You can now log in to your IOMS. Your credentials are as follows: <br>
        <b>Email:</b> {{ $staff_email }} <br>
        <b>Password:</b> {{ $staff_password }}
    </p>
    <p>Please use the provided credentials to log in initially. Once logged in, kindly change your password for your
        safety.</p>
    <p>If ever you have problems while logging in, please reply to this email or check your internet connection and
        refresh.</p>
    <p>Thank you,<br>Passerelles Numériques Philippines</p>
</body>

</html>
