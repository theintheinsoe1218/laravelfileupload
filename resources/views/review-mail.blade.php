<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Review Mail</title>
</head>
<body>
    <h1>Name - {{ $reviewData['name']}}</h1>
    <h3>Email - {{ $reviewData['email'] }}</h3>
    <p>Message - {{ $reviewData['message'] }}</p>

</body>
</html>