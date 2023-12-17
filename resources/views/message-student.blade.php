<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Student Account Creation Message</title>
</head>

<body>
    <p>Hello {{ $student_name }},</p>
    <p>You can now log in to your IOMS Account. Your credentials are as follows: <br>
        <b>Email:</b> {{ $student_email }} <br>
        <b>Password:</b> {{ $student_password }}
    </p>
    <p>Please use the provided credentials to log in initially (link: <a href="https://pnphioms.online/login">https://pnphioms.online/login</a>). Once logged in, kindly change your password for your
        safety.</p>
    <p>If there are problems while logging in, please try checking your internet connection and reload the page. <br>If
        the
        issue persist please feel free to reply on this email or contact the admin through this: <a
            href="mailto:lorenfe.cuadero@student.passerellesnumeriques.org">lorenfe.cuadero@student.passerellesnumeriques.org</a>
    </p>
    <p>Thank you,<br>Passerelles Numériques Philippines</p>
</body>

</html>
