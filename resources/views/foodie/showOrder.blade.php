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
                    <a href="#bankPay" class="modal-trigger"><h4>Pay online</h4></a>
                    <h4>Bank Deposit</h4>
                </div>
            </div>
        </div>
    </div>

    <div id="bankPay" class="modal">
        <div class="modal-content">
            <form action="{{route('deposit.order', $order->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <input type="text" name="name" id=""><br>
                <input type="text" name="receipt_number"><br>

                <input type="file" name="image" id="">

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection