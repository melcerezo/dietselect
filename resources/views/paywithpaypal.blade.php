@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row" style="margin-top: 50px;">
            <div class="col s4 offset-s4">
                <div class="panel panel-default">
                    {{--{{$message}}--}}
                    {{Session::get('success')}}
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
                                    <input id="amount" type="text" class="form-control" name="amount" value="{{ $order->total }}" autofocus readonly>
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
    </div>
@endsection