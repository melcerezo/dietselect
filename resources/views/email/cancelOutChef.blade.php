<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Cancelled Order</h1>
<div>
    <div>
        <p>Hello, this is DietSelect!</p>
        <p>{{$foodieName}} has cancelled their order for: </p>
        <ul>
            @foreach($planName as $plan)
                <li>{{$plan}}</li>
            @endforeach
        </ul>
        <p>Reason: Failure to Pay on {{$timeCancel}} at 3:00pm </p>
    </div>
</div>
</body>
</html>