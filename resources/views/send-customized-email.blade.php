<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customized Email</title>
</head>

<body style="background-color: transparent; color: black; font-family: Arial, Helvetica, sans-serif">
    <p style="background-color: transparent; color: black; font-family: Arial, Helvetica, sans-serif">{{ $salutation }} Batch {{ $selectedBatchYear }},</p>
    <p style="background-color: transparent; color: black; font-family: Arial, Helvetica, sans-serif; white-space:pre-line">{{ $message_content }}</p>
    <p style="background-color: transparent; color: black; font-family: Arial, Helvetica, sans-serif">{{ $conclusion_salutation }}, <br>
        {{ $sender }}</p>
</body>

</html>
