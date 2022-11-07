<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consulation Approval</title>
</head>
<body>
    <div>
        <p>Hello {{$details['fullname']}}, </p>
        <p>I am happy to inform you that 
            your consultaion on {{$details['service_type']}} 
            Booked for {{$details['consult_date']}} has been approved 
            successfully.
        </p><br><br>

        <p>Thank you</p>
    </div>
</body>
</html>