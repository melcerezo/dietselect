<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Successful Payment</title>
</head>
<body>
<p>Your payment was successful.</p>
<ul>
    @foreach($orderPlanNames as $orderPlanName)
        <li>
            <span>{{$orderPlanName['plan_name'].'-'.$orderPlanName['chef_name'].'-'.$orderPlanName['type']}}</span>
        </li>
    @endforeach
</ul>
<p>Amount: {{$amount}}</p>
</body>
</html>