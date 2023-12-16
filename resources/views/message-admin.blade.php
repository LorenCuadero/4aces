<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Admin Account Creation Message</title>
</head>

<body>
    <p>Hello {{ $admin_name }},</p>
    <p>You are now added as an administrator in IOMS. Your credentials are as follows: <br>
        <b>Email:</b> {{ $admin_email }} <br>
        <b>Password:</b> {{ $admin_password }}
    </p>
    <p>Please use the provided credentials to log in initially. Once logged in, kindly change your password for your
        safety.</p>
    <p>If there are problems while logging in, please try checking your internet connection and reload the page. <br>If
        the
        issue persist please feel free to reply on this email or contact the admin through this: <a
            href="#">lorenfe.cuadero@student.passerellesnumeriques.org</a>
    </p>
    <p>Thank you,<br>Passerelles Numériques Philippines</p>
</body>

</html>
