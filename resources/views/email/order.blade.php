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
    <h1>Pending Order</h1>
    <div>
        <div>
            <p>Hello, this is DietSelect!</p>
            <p>You have just placed an order for:</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Chef</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach($chefOrderPlans as $chefOrderPlan)
                    <tr>
                        <td>{{$mailHTML['name']}}</td>
                        <td>{{$mailHTML['chef']}}</td>
                        <td>{{$mailHTML['type']}}</td>
                        <td>{{$mailHTML['qty']}}</td>
                        <td>{{$mailHTML['price']}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <p>Total: {{$price}}</p>
    <p>Please pay before {{$mailHTML['date']}}</p>
</body>
</html>