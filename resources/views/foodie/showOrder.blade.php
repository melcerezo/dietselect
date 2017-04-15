@extends('foodie.layout')
@section('page_head')
    <script src="/js/foodie/orderValidate.js" defer></script>
    <link rel="stylesheet" href="/css/foodie/order.css">

@endsection
@section('page_content')

    <div class="container">
        <div class="row">
            <h2 class="center white-text">Order Confirmation</h2>
            <div><span class="center full-width white-text" style="font-size: 1.5em">You have placed your order!</span>
            </div>
            <div><span class="center full-width white-text" style="font-size: 1.5em">Please settle your order before Saturday!</span>
            </div>
            <div class="card papaya-whip">
                <div class="card-content">
                    <h4 class="mustard-text">Meal Plans:</h4>
                    <div>{{$plan->chef->name}}</div>
                    <div>{{$plan->plan_name}}</div>
                    <div>{{$plan->price}}</div>
                    <div><a href="#bankPay" class="modal-trigger"><h4>Bank Deposit</h4></a></div>
                    <div><a href="#paypalPay" class="modal-trigger"><h4>Pay online</h4></a></div>
                    {{--<div><h1>Payment:</h1></div>--}}
                    {{--{{$order->is_paid == 1 ? 'Paid' : 'Not Paid!'}}--}}
                    {{--<a href="{!! URL::route('addmoney.paypal', $order->id) !!}"><h4>Pay online</h4></a>--}}
                </div>
            </div>
        </div>
    </div>

    <div id="bankPay" class="modal">
        <div class="modal-content">
            <div>
                <h4>Bank Payment Form</h4>
            </div>
            <form id="bankPayForm" action="{{route('deposit.order', $order->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div>
                    <div><label for="receipt">Receipt Number</label></div>
                    <div><input type="text" id="receipt" data-error=".error-recpt" name="receipt_number"></div>
                    <div class="error-recpt err"></div>
                </div>
                <div>
                    <div><label for="datePay">Date of Transaction:</label></div>
                    <div><input id="datePay" name="datePay" data-error=".error-date-pay" type="text" class="datepicker"></div>
                    <div class="error-date-pay err"></div>

                </div>
                <div>
                    <label for="image">Image</label>
                    <input type="file" name="image" data-error=".error-image" id="image">
                    <div class="error-image err"></div>

                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <div id="paypalPay" class="modal">
        <div class="modal-content">
            <div class="panel panel-default">
                @if ($message = Session::get('success'))
                    <div class="custom-alerts alert alert-success fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        {!! $message !!}
                    </div>
                    <?php Session::forget('success');?>
                @endif
                @if ($message = Session::get('error'))
                    <div class="custom-alerts alert alert-danger fade in">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        {!! $message !!}
                    </div>
                    <?php Session::forget('error');?>
                @endif
                <div class="panel-heading">Pay with PayPal</div><br>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" id="payment-form" role="form" action="{!! URL::route('addmoney.paypal', compact('order')) !!}" >
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                            <label for="amount" class="col-md-4 control-label">Amount</label>
                            <div class="col-md-6">
                                {{--<input id="amount" type="text" class="form-control" name="amount" value="{{ old('amount') }}" autofocus>--}}
                                <div>
                                    {{$order->plan->price}}
                                </div>
                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Pay with Paypal
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection