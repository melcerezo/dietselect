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
    <h1>Payment Successful</h1>
    <p>You have confirmed order for: </p>
    <table>
        <tr>
            <td>Name</td>
            <td>Chef</td>
            <td>Type</td>
            <td>Price</td>
        </tr>
        @foreach($orderPlanNames as $orderPlanName)
            <tr>
                <td>{{$orderPlanName['plan_name']}}</td>
                <td>{{$orderPlanName['chef_name']}}</td>
                <td>{{$orderPlanName['type']}}</td>
                <td>{{$orderPlanName['price']}}</td>
            </tr>
        @endforeach
    </table>
    <p>Amount: {{$amount}}</p>
</body>
</html>