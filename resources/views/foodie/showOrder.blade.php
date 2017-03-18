@extends('foodie.layout')
@section('page_content')

    <div class="container">
        <div class="row">
            <h2 class="center white-text">Order Confirmation</h2>
            <div><span class="center full-width white-text" style="font-size: 1.5em">You have placed your order!</span></div>
            <div><span class="center full-width white-text" style="font-size: 1.5em">Please settle your order before Saturday!</span></div>
            <div class="card papaya-whip">
                <div class="card-content">
                    <h4 class="mustard-text">Meal Plans:</h4>
                    {{$plan[0]->chef->name}} <br>
                    {{$plan[0]->plan_name}} <br>
                    {{$plan[0]->price}}<br>
                    <h1>Is Paid ? {{!empty($order->is_paid) ? 'Paid' : 'Not Paid!'}}</h1>
                    <h4>Pay online</h4>
                    <h4>Bank Deposit</h4>
                </div>
            </div>
        </div>
    </div>
@endsection