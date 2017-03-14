
{{$plan[0]->chef->name}} <br>
{{$plan[0]->plan_name}} <br>
{{$plan[0]->price}}<br>

<h1>Is Paid ? {{!empty($order->is_paid) ? 'Paid' : 'Not Paid!'}}</h1>

<h4>Pay online</h4>
<h4>Bank Deposit</h4>