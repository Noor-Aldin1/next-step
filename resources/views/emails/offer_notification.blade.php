<!DOCTYPE html>
<html>

<head>
    <title>Offer Notification</title>
</head>

<body>
    <h1>{{ $offerDetails['title'] }}</h1>
    <p>{{ $offerDetails['message'] }}</p>
    <p><a href="{{ $offerDetails['link'] }}" target="_blank">View Offers</a></p>
    <p>Thank you for subscribing!</p>
</body>

</html>
