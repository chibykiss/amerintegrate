<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consultation Notification</title>
</head>
<body>
    <div>
        <h3>New Consultationhas been Booked</h3>
        <p>Details Below</p><br>
        <p>FullName: {{$data['fullname']}}</p>
        <p>Email: {{$data['email']}}</p>
        <p>Phone Number: {{$data['phone_number']}}</p>
        <p>Country: {{$data['country']}}</p>
        <p>State: {{$data['state']}}</p>
        <p>Date/Time: {{$data['consult_date']}}</p>
        <p>Service Type: {{$data['service_type']}}</p>
        <p>Consultation Type: {{$data['consultation_type']}}</p>
    </div>
</body>
</html>