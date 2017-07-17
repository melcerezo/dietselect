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
<h1>Payment Made</h1>
<p>{{$foodieName}} has confirmed their order for: </p>
<ul>
    @foreach($chefOrderPlans as $chefOrderPlan)
        <li>{{$chefOrderPlan['plan_name'].'-'.$chefOrderPlan['type']}}</li>
    @endforeach
</ul>
</body>
</html>