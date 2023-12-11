<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Resend OTP Message</title>
</head>

<body>
    <p>Hello {{ $email }},</p>
    <p>We received a request to resend the one-time password (OTP) for your verification. Your new OTP is:
        <b>{{ $otp }}</b>.<br>Please use this OTP to complete login process.
    </p>
    <p>If you did not request this OTP or if you have already completed the process, you can safely ignore this message.
        <br>For security reasons, please do not share this OTP with anyone. <br>
        Thank you.
    </p>
</body>

</html>
