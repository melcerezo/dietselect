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
                @foreach($mailHTML as $item)
                    <tr>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['chef']}}</td>
                        <td>{{$item['type']}}</td>
                        <td>{{$item['qty']}}</td>
                        <td>{{$item['price']}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <p>Total: {{$price}}</p>
    <p>Please pay before {{$mailHTML[0]['date']}}</p>
</body>
</html>