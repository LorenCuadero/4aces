<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin Account Creation Message</title>
</head>

<body>
    <p>Hello {{ $admin_name }},</p>
    <p>You are now added as an administrator on IOMS. For the credentials:
       <b> Email: <b>{{ $admin_email }}.</b>
        <b> Password: <b>{{ $admin_password }}.</b>
        Please use the provided credentials to log in initially. Once logged in, kindly change your password for your safety.</p>
    <p>Thank you,<br>Passerelles Numeriques
        Philippines</p>
</body>

</html>
