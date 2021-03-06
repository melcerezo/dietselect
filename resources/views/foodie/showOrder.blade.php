@extends('foodie.layout')
@section('page_head')
    <script src="/js/foodie/orderValidate.js" defer></script>
    {{--<link rel="stylesheet" href="/css/foodie/order.css">--}}
    <link rel="stylesheet" href="/css/foodie/orderShow.css">

@endsection
@section('page_content')

    <div class="container shOrdCntr">
        {{--<div class="row">--}}
            {{--<a href="{{route('foodie.order.view', ['from'=>1])}}" class="orange-text text-darken-2">< Order History</a>--}}
        {{--</div>--}}
        <div class="row">
            @if($order->is_cancelled!=1)
                <div class="col s12 m7">
                    <div class="payBox">
                        <div class="payMainTitle">
                            <span style="font-size: 30px; font-weight: bold;">Payment Methods</span>
                        </div>
                        <div class="payTabsContainer">
                            <div class="payTabs">
                                <div class="row">
                                    <div data-pay-reveal="bank" class="col s12 m3 payTab">
                                        <span class="bankIcon"><i class="fa fa-bank"></i></span>
                                        <span class="bankDes">Bank</span>
                                    </div>
                                    <div data-pay-reveal="paypal" class="col s12 m3 payTab">
                                        <span class="payPalIcon"><i class="fa fa-paypal"></i></span>
                                        <span class="payPalDes">Paypal</span>
                                    </div>
                                    <div data-pay-reveal="gcash" class="col s12 m3 payTab">
                                        <span class="gcashIcon">GCash</span>
                                        <span class="gcashDes">Gcash</span>
                                    </div>
                                    <div id="cancelOrder" class="col s12 m3 cancelTab red">
                                        <a href="#cancelOrderModal" class="modal-trigger white-text">
                                            <span class="cancelIcon"><i class="fa fa-ban"></i></span>
                                            <span class="cancelDes">Cancel</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="payTabsWrapper">
                                <div id="defaultPay" class="payForm" style="height: 100px;">
                                    <span>Choose a method of payment!</span>
                                </div>
                                <div id="bankPayment" class="payForm">
                                    <div>Please pay your balance with this information :</div>

                                    <div class="payInfoCntr">
                                        <div class="payInfo"><span style="font-size: 30px;">Payment Information</span></div>
                                        <div class="divider"></div>
                                        <div class="payInfo">BDO Savings Account: 007110023351</div>
                                        <div class="divider"></div>
                                        <div class="payInfo">DietSelect</div>
                                    </div>
                                    <form id="bankPayForm" action="{{route('deposit.order', $order->id)}}" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <div class="row">
                                            <div><label for="receipt">Receipt Number</label></div>
                                            <div><input type="text" id="receipt" data-error=".error-recpt" name="receipt_number"></div>
                                            <div class="error-recpt err"></div>
                                        </div>
                                        <div class="row">
                                            <div><label for="datePay">Date of Transaction:</label></div>
                                            <div><input id="datePay" name="datePay" data-error=".error-date-pay" type="text" class="datepicker"></div>
                                            <div class="error-date-pay err"></div>

                                        </div>
                                        <div class="row">
                                            <div class="file-field">
                                                <div id="bankContainer">
                                                </div>
                                                <label for="image" class="active">Picture Upload:</label>
                                                <div style="padding-top: 10px;">
                                                    <div class="btn orange darken-2">
                                                        <span>File</span>
                                                        <input type="file" data-error=".error-image" id="image" name="image">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text" >
                                                    </div>
                                                    <div class="error-image err"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-bottom: 5px;">
                                            <button class="btn waves-light waves-light orange darken-2" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <div id="payPalPayment" class="payForm">
                                   <div style="margin: 10px 0; font-size: 20px;">
                                       Please login to your paypal account to pay.
                                   </div>
                                    <div>
                                        <form method="POST" id="payment-form" role="form" action="{{route('addmoney.paypal', compact('order'))}}" >
                                            {{ csrf_field() }}

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light orange darken-2">
                                                    Pay with Paypal
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="gcashPayment" class="payForm">
                                        <div>
                                            <span>Please send your gcash payment to the number below. Fill out this form with a screenshot of the confirmation text from Globe.</span>
                                        </div>
                                        <div class="payInfoCntr">
                                            <div class="payInfo"><span style="font-size: 30px;">Payment Information</span></div>
                                            <div class="divider"></div>
                                            <div class="payInfo">Gcash Number: 09950893073</div>
                                            <div class="divider"></div>
                                            <div class="payInfo">DietSelect</div>
                                        </div>
                                        <form id="gcPayForm" action="{{route('deposit.gcash', $order->id)}}" method="post" enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div>
                                                <div class="row">
                                                    <div><label for="gcDatePay">Date of Transaction:</label></div>
                                                    <div><input id="gcDatePay" name="gcDatePay" data-error=".error-gcdate-pay" type="text" class="datepicker"></div>
                                                    <div class="error-gcdate-pay err"></div>
                                                </div>
                                                <div class="row">
                                                    <div id="gcashContainer">
                                                    </div>
                                                    <div class="file-field">
                                                        <label for="gcPic" class="active">Picture Upload:</label>
                                                        <div style="padding-top: 10px;">
                                                            <div class="btn orange darken-2">
                                                                <span>File</span>
                                                                <input type="file" data-error=".error-gcpic" id="gcPic" name="gcPic">
                                                            </div>
                                                            <div class="file-path-wrapper">
                                                                <input class="file-path validate" type="text" >
                                                            </div>
                                                            <div class="error-gcpic err"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <button class="btn waves-effect waves-light orange darken-2">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col s12 m7">
                        <span style="font-size: 60px">THIS ORDER HAS BEEN CANCELLED</span>
                    </div>
                @endif
                <div class="col s12 m5">
                    <div class="addressInfo">
                        <div class="row">
                            <div>
                                <span style="font-size: 20px; font-weight: bold;">Delivery Address:</span>
                            </div>
                            <div class="divider" style="margin: 10px 0;"></div>
                            @if($orderAddress!=null)
                                <div>
                                    <span>{{$orderAddress->unit}}</span>
                                    @unless($orderAddress->bldg=='')
                                        <span> {{$orderAddress->bldg}}, </span>
                                    @endunless
                                    <span>{{$orderAddress->street}}, </span>
                                    <span>{{$orderAddress->brgy}}, </span>
                                    <span>{{$orderAddress->city}}</span>
                                </div>
                                @if($order->is_paid==0)
                                    <div>
                                        <a href="#pickOrderAddressModal" class="modal-trigger"><span>Change Address</span></a>
                                    </div>
                                @endif
                            @else
                                <div>
                                    @if(count($foodieAddress)==0)
                                        <a href="{{route('foodie.profile')}}">
                                            <span>No Address Available. Please add one so we can deliver to you!</span>
                                        </a>
                                    @else
                                        <a href="#pickOrderAddressModal" class="modal-trigger">
                                            <span>No Order Address Picked. Please add one so we can deliver to you!</span>
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="orderInfo">
                        <div class="row">
                            <span style="font-size: 20px; font-weight: bold;">Order Summary</span>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <table class="centered">
                                <thead>
                                    <tr>
                                        <th>Plan</th>
                                        <th>Chef</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($orderItems as $orderItem)
                                    <tr>
                                        @foreach($orderPlans as $orderPlan)
                                            @if($orderPlan->id == $orderItem->plan_id)
                                                @if($orderItem->order_type==0)
                                                    <td>{{$orderPlan->plan_name}}</td>
                                                    <td>{{$orderPlan->chef->name}}</td>
                                                @elseif($orderItem->order_type==1 || $orderItem->order_type==2)
                                                    <td>{{$orderPlan->plan->plan_name}}</td>
                                                    <td>{{$orderPlan->plan->chef->name}}</td>
                                                @endif
                                            @endif
                                        @endforeach
                                        <td>x{{$orderItem->quantity}}</td>
                                        <td>{{'PHP '.number_format($orderItem->price,2,'.',',')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <span style="font-size: 20px; font-weight: bold;">STATUS</span>
                            <span class="right">{{$order->is_paid == 1 ? 'Paid' : 'Pending'}}</span>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <span style="font-size: 20px; font-weight: bold;">WEEK OF</span>
                            <span class="right">{{$nextWeek.' - '.$nextWeekEnd}}</span>
                        </div>
                        <div class="divider"></div>
                        <div class="row">
                            <span style="font-size: 30px; font-weight: bold;">TOTAL</span>
                            <span class="right" style="color: #f57c00; font-size: 30px;">{{'PHP '.number_format($order->total,2,'.',',')}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{--<div class="row">--}}
        {{--<div class="col s12 light-green lighten-1 white-text shOrdMnTtl valign-wrapper">--}}
            {{--<span>Order Payment</span>--}}
        {{--</div>--}}
    {{--</div>--}}
    {{--<div class="row">--}}
        {{--<div class="col s12 m8" style="padding: 0;">--}}
            {{--<div class="card-panel shOrdMlTbl">--}}
            {{--<table class="centered">--}}
                {{--<thead class="light-green lighten-1 white-text" style="border: none;">--}}
                    {{--<tr>--}}
                        {{--<th>Plan</th>--}}
                        {{--<th>Chef</th>--}}
                        {{--<th>Quantity</th>--}}
                        {{--<th>Price</th>--}}
                    {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                    {{--@foreach($orderItems as $orderItem)--}}
                        {{--@if($orderItem->order_type==2)--}}
                            {{--<a href="{{route('foodie.order.simpCust', $orderItem->id)}}">--}}
                        {{--@endif--}}
                        {{--<tr>--}}
                        {{--<div class="orderItem">--}}
                            {{--@foreach($orderPlans as $orderPlan)--}}
                                {{--@if($orderPlan->id == $orderItem->plan_id)--}}
                                    {{--@if($orderItem->order_type==0)--}}
                                        {{--<div><a href="{{route('foodie.order.single', $orderItem->id)}}">{{$orderPlan->plan_name}}</a></div>--}}
                                        {{--<div>{{$orderPlan->chef->name}}</div>--}}
                                    {{--@elseif($orderItem->order_type==1 || $orderItem->order_type==2)--}}
                                        {{--<div><a href="{{route('foodie.order.single', $orderItem->id)}}">{{$orderPlan->plan->plan_name}}</a></div>--}}
                                        {{--<div>{{$orderPlan->plan->chef->name}}</div>--}}
                                    {{--@endif--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                            {{--<div>{{$orderItem->quantity}}</div>--}}
                            {{--<div>{{'PHP '.$orderItem->price}}</div>--}}
                        {{--</div>--}}
                        {{--@if($orderItem->order_type==2)--}}
                            {{--</a>--}}
                        {{--@endif--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                {{--</tbody>--}}
            {{--</table>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col s12 m4">--}}
            {{--<ul class="collection" style="margin: 0;">--}}
                {{--<li class="collection-item light-green lighten-1 white-text">--}}
                    {{--<span class="collection-header">Total Order:</span>--}}
                {{--</li>--}}
                {{--<li class="collection-item">--}}
                    {{--<span>Total: {{'PHP '.$order->total}}</span>--}}
                {{--</li>--}}
                {{--<li class="collection-item">--}}
                    {{--<span>Status: {{$order->is_paid == 1 ? 'Paid' : 'Pending'}}</span>--}}
                {{--</li>--}}
                {{--<li class="collection-item">--}}
                    {{--<span>Week of: {{$nextWeek.' - '.$nextWeekEnd}}</span>--}}
                {{--</li>--}}
                {{--<li class="collection-item">--}}
                    {{--<div>--}}
                        {{--<span>Delivery Address:</span>--}}
                    {{--</div>--}}
                    {{--@if($orderAddress!=null)--}}
                        {{--<div>--}}
                            {{--<span>{{$orderAddress->unit}}</span>--}}
                            {{--@unless($orderAddress->bldg=='')--}}
                                {{--<span> {{$orderAddress->bldg}}, </span>--}}
                            {{--@endunless--}}
                            {{--<span>{{$orderAddress->street}}, </span>--}}
                            {{--<span>{{$orderAddress->brgy}}, </span>--}}
                            {{--<span>{{$orderAddress->city}}</span>--}}
                        {{--</div>--}}
                        {{--@if($order->is_paid==0)--}}
                            {{--<div>--}}
                                {{--<a href="#pickOrderAddressModal" class="modal-trigger"><span>Change Address</span></a>--}}
                            {{--</div>--}}
                        {{--@endif--}}
                    {{--@else--}}
                        {{--<div>--}}
                            {{--@if(count($foodieAddress)==0)--}}
                                {{--<a href="{{route('foodie.profile')}}">--}}
                                    {{--<span>No Address Available. Please add one so we can deliver to you!</span>--}}
                                {{--</a>--}}
                            {{--@else--}}
                                {{--<a href="#pickOrderAddressModal" class="modal-trigger">--}}
                                    {{--<span>No Order Address Picked. Please add one so we can deliver to you!</span>--}}
                                {{--</a>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--@endif--}}
                {{--</li>--}}
            {{--</ul>--}}
            {{--<div style="margin: 10px 0 0 0; border: 1px dashed #d1d1d1; border-radius: 10px; padding: 5px;">--}}
                {{--<div>--}}
                    {{--<span>Payment Methods</span>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                    {{--<div class="col s12 m6 center">--}}
                        {{--<button data-target="bankPay" class="modal-trigger btn waves-effect waves-light" style="padding: 0; width:100%;">--}}
                            {{--<i class="fa fa-bank"></i>--}}
                            {{--<span style="font-size: 15px;">Bank</span>--}}
                        {{--</button>--}}
                    {{--</div>--}}
                    {{--<div class="col s12 m6 center">--}}
                        {{--<button data-target="paypalPay" class="modal-trigger btn waves-light waves-effect" style="padding: 0; width:100%;">--}}
                            {{--<i class="fa fa-paypal"></i>--}}
                            {{--<span style="font-size: 15px;">PayPal</span>--}}
                        {{--</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                    {{--<div class="col s12 m6 center">--}}
                        {{--<button data-target="gcashModal" class="modal-trigger btn waves-effect waves-light" style="padding: 0; width:100%;">--}}
                            {{--<span>GCash</span>--}}
                        {{--</button>--}}
                    {{--</div>--}}
                    {{--<div class="col s12 m6 center">--}}
                        {{--<button data-target="cancelOrderModal" class="modal-trigger btn waves-effect waves-light red" style="padding: 0; width:100%;">--}}
                            {{--<i class="fa fa-ban"></i>--}}
                            {{--<span style="font-size: 15px;">Cancel</span>--}}
                        {{--</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--@unless($order->is_cancelled==1)--}}
            {{--<div class="row">--}}
                {{--@unless($order->is_paid==1 || count($foodieAddress)==0 || $orderAddress==null)--}}
                    {{--<div class="col s12 m4 offset-m8">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col s12 m3 center">--}}
                                {{--<button data-target="bankPay" class="modal-trigger btn waves-effect waves-light" style="padding: 0; width:100%;">--}}
                                    {{--<i class="fa fa-bank"></i>--}}
                                    {{--<span style="font-size: 15px;">Bank</span>--}}
                                {{--</button>--}}
                            {{--</div>--}}
                            {{--<div class="col s12 m3 center">--}}
                                {{--<button data-target="paypalPay" class="modal-trigger btn waves-light waves-effect" style="padding: 0; width:100%;">--}}
                                        {{--<i class="fa fa-paypal"></i>--}}
                                        {{--<span style="font-size: 15px;">PayPal</span>--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            {{--<div class="col s12 m3 center">--}}
                                {{--<button data-target="gcashModal" class="modal-trigger btn waves-effect waves-light" style="padding: 0; width:100%;">--}}
                                    {{--<span>GCash</span>--}}
                                {{--</button>--}}
                            {{--</div>--}}
                            {{--<div class="col s12 m3 center">--}}
                                {{--<button data-target="cancelOrderModal" class="modal-trigger btn waves-effect waves-light red" style="padding: 0; width:100%;">--}}
                                    {{--<i class="fa fa-ban"></i>--}}
                                    {{--<span style="font-size: 15px;">Cancel</span>--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endunless--}}
                {{--</div>--}}
        {{--@endunless--}}
    {{--</div>--}}

                {{--<div style="margin-top: 20px;"><button data-target="paypalPay" class="modal-trigger btn">Paypal</button></div>--}}
                {{--<div style="margin-top: 20px;"><button data-target="gcashModal" class="modal-trigger btn">G-Cash</button></div>--}}
            {{--@if($order->is_paid==0 && count($foodieAddress)>0 && $orderAddress!=null)--}}
                {{--<div class="col s12 offset-m2 m4">--}}
            {{--@else--}}
                {{--<div class="col s12 m4 offset-m8 right">--}}
            {{--@endif--}}
                {{--<ul class="collection" style="margin: 0;">--}}
                    {{--<li class="collection-item light-green lighten-1 white-text">--}}
                        {{--<span class="collection-header">Total Order:</span>--}}
                    {{--</li>--}}
                    {{--<li class="collection-item">--}}
                        {{--<span>Total: {{'PHP '.$order->total}}</span>--}}
                    {{--</li>--}}
                    {{--<li class="collection-item">--}}
                        {{--<span>Status: {{$order->is_paid == 1 ? 'Paid' : 'Pending'}}</span>--}}
                    {{--</li>--}}
                    {{--<li class="collection-item">--}}
                        {{--<span>Week of: {{$nextWeek.' - '.$nextWeekEnd}}</span>--}}
                    {{--</li>--}}
                    {{--<li class="collection-item">--}}
                        {{--<div>--}}
                            {{--<span>Delivery Address:</span>--}}
                        {{--</div>--}}
                        {{--@if($orderAddress!=null)--}}
                            {{--<div>--}}
                                {{--<span>{{$orderAddress->unit}}</span>--}}
                                {{--@unless($orderAddress->bldg=='')--}}
                                    {{--<span> {{$orderAddress->bldg}}, </span>--}}
                                {{--@endunless--}}
                                {{--<span>{{$orderAddress->street}}, </span>--}}
                                {{--<span>{{$orderAddress->brgy}}, </span>--}}
                                {{--<span>{{$orderAddress->city}}</span>--}}
                            {{--</div>--}}
                            {{--@if($order->is_paid==0)--}}
                                {{--<div>--}}
                                    {{--<a href="#pickOrderAddressModal" class="modal-trigger"><span>Change Address</span></a>--}}
                                {{--</div>--}}
                            {{--@endif--}}
                        {{--@else--}}
                            {{--<div>--}}
                                {{--@if(count($foodieAddress)==0)--}}
                                    {{--<a href="{{route('foodie.profile')}}">--}}
                                        {{--<span>No Address Available. Please add one so we can deliver to you!</span>--}}
                                    {{--</a>--}}
                                {{--@else--}}
                                    {{--<a href="#pickOrderAddressModal" class="modal-trigger">--}}
                                        {{--<span>No Order Address Picked. Please add one so we can deliver to you!</span>--}}
                                    {{--</a>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--@endif--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--@endunless--}}


    <div id="pickOrderAddressModal" class="modal">
        <div>
            <span style="font-size: 30px; margin-left: 10px;">Choose Order Address</span>
        </div>
        <div class="modal-content">
            <div class="row">
                <span>Please choose an address for us to deliver.</span>
            </div>
            <form action="{{route('foodie.order.address', $order->id)}}" method="post" id="pickAddressForm">
            {{ csrf_field() }}
                <div class="form-group">
                    <select class="form-control" name="addressSelect" id="addressSelect">
                        <option disabled selected>Please Choose an address</option>;
                        @foreach($foodieAddress as $address)
                            <option value="{{$address->id}}">
                                {{$address->unit}} @unless($address->bldg==''){{$address->bldg}},@endunless{{$address->street}},{{$address->brgy}},{{$address->city}}
                            </option>
                        @endforeach
                    </select>
                    <div></div>
                </div>
                <input type="submit" class="btn waves-effect waves-light orange darken-2"/>
            </form>
        </div>
    </div>
    <div id="cancelOrderModal" class="modal">
            <div>
                <span style="font-size: 30px; margin-left: 10px;">Cancel Order</span>
            </div>
        <div class="modal-content">
            <form method="post" action="{{route('foodie.order.cancel', $order->id)}}" id="cancelOrderForm">
                {{ csrf_field() }}
                <div>
                    <span>Please tell us why you are cancelling</span>
                </div>
                <div>
                    <input type="radio" name="cancelReason" value="0" class="filled-in" id="pref-none" data-error=".error-pref" checked/>
                    <label for="pref-none">No Reason</label><br/>
                </div>
                <div>
                    <input type="radio" name="cancelReason" value="1" class="filled-in" id="pref-noInt" data-error=".error-pref"/>
                    <label for="pref-noInt">Not Interested Anymore</label><br/>
                </div>
                <div>
                    <input type="radio" name="cancelReason" value="2" class="filled-in" id="pref-noDel" data-error=".error-pref"/>
                    <label for="pref-noDel">Cannot Take Delivery at This Time</label><br/>
                </div>
                <div>
                    <input type="radio" name="cancelReason" value="3" class="filled-in" id="pref-noTown" data-error=".error-pref"/>
                    <label for="pref-noTown">Out of Town</label><br/>
                </div>
                <div>
                    <input type="radio" name="cancelReason" value="4" class="filled-in" id="pref-CustReason" data-error=".error-pref"/>
                    <label for="pref-CustReason">Other</label><br/>
                </div>
                <div id="otherReasonContainer">
                    <input type="text" data-error=".error-otherReason" name="otherReason" id="otherReason" placeholder="Please give your reason for cancellation">
                    <div class="error-otherReason">
                    </div>
                </div>

                <button type="submit" id="cancelOrderSubmit" class="btn waves-effect waves-light orange darken-2">Submit</button>
            </form>
        </div>
    </div>

    <div id="bankPay" class="modal">
        <nav class="light-green lighten-1 white-text">
            <div class="left col s12 m5 l5">
                <ul>
                    <li>
                        <span style="margin-left: 20px;">Bank Payment</span>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="modal-content">
            <div>Please pay your balance with this information :</div>

            <ul class="collection">
                <li class="collection-item light-green lighten-1 white-text"><span class="collection-header">Order Review</span></li>
                <li class="collection-item">BDO Savings Account: 007110023351</li>
                <li class="collection-item">DietSelect</li>
                <li class="collection-item">Total {{$order->total}}</li>
            </ul>
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
                <div class="row">
                    <div class="file-field">
                        <label for="image" class="active">Picture Upload:</label>
                        <div style="padding-top: 10px;">
                            <div class="btn">
                                <span>File</span>
                                <input type="file" data-error=".error-image" id="image" name="image">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" >
                            </div>
                            <div class="error-image err"></div>
                        </div>
                    </div>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>

    <div id="paypalPay" class="modal">
        <nav class="light-green lighten-1 white-text">
            <div class="left col s12 m5 l5">
                <ul>
                    <li>
                        <span style="margin-left: 20px;">PayPal Payment</span>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="modal-content">
            <ul class="collection">
                <li class="collection-item light-green lighten-1 white-text"><span class="collection-header">Order Review</span></li>
                <li class="collection-item">Total {{$order->total}}</li>
            </ul>

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
            <div>
                {{--<ul class="collection">--}}
                    {{--<li class="collection-item light-green lighten-1 white-text"><span class="collection-header">Order Review</span></li>--}}
                    {{--<li class="collection-item">Chef Name: {{$plan->chef->name}}</li>--}}
                    {{--<li class="collection-item">Plan Name: {{$plan->plan_name}}</li>--}}
                    {{--<li class="collection-item">Plan Price: {{$plan->price}}</li>--}}
                {{--</ul>--}}
                <form method="POST" id="payment-form" role="form" action="{{route('addmoney.paypal', compact('order'))}}" >
                    {{ csrf_field() }}

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">
                            Pay with Paypal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="gcashModal" class="modal">
        <nav class="light-green lighten-1 white-text">
            <div class="left col s12 m5 l5">
                <ul>
                    <li>
                        <span style="margin-left: 20px;">GCash Payment</span>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="modal-content">
            <div>
                <span>Please send your gcash payment to the number below. Fill out this form with a screenshot of the confirmation text from Globe.</span>
            </div>
            <ul class="collection">
                <li class="collection-item light-green lighten-1 white-text"><span class="collection-header">Order Review</span></li>
                <li class="collection-item">Gcash Number: 09950893073</li>
                <li class="collection-item">DietSelect</li>
                <li class="collection-item">Total: {{$order->total}}</li>
            </ul>
            <form id="gcPayForm" action="{{route('deposit.gcash', $order->id)}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div>
                    <div class="row">
                        <div><label for="gcDatePay">Date of Transaction:</label></div>
                        <div><input id="gcDatePay" name="gcDatePay" data-error=".error-gcdate-pay" type="text" class="datepicker"></div>
                        <div class="error-gcdate-pay err"></div>
                    </div>
                    <div class="row">
                        <div class="file-field">
                            <label for="gcPic" class="active">Picture Upload:</label>
                            <div style="padding-top: 10px;">
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file" data-error=".error-gcpic" id="gcPic" name="gcPic">
                                </div>
                                <div class="file-path-wrapper">
                                    <input class="file-path validate" type="text" >
                                </div>
                                <div class="error-gcpic err"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <button class="btn waves-effect waves-light">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="loadWait" class="valign-wrapper">
        <div id="loadStatus" class="preloader-wrapper active valign">
            <div class="spinner-layer spinner-red-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>
            {{--<h2 class="center white-text">Order Confirmation</h2>--}}
            {{--<div><span class="center full-width white-text" style="font-size: 1.5em">You have placed your order!</span>--}}
            {{--</div>--}}
            {{--<div><span class="center full-width white-text" style="font-size: 1.5em">Please settle your order before Saturday!</span>--}}
            {{--</div>--}}
            {{--<div class="card papaya-whip">--}}
                {{--<div class="card-content">--}}
                    {{--<h4 class="mustard-text">Meal Plans:</h4>--}}
                    {{--<div>{{$plan->chef->name}}</div>--}}
                    {{--<div>{{$plan->plan_name}}</div>--}}
                    {{--<div>{{$plan->price}}</div>--}}
                    {{--<div><a href="#bankPay" class="modal-trigger"><h4>Bank Deposit</h4></a></div>--}}
                    {{--<div><a href="#paypalPay" class="modal-trigger"><h4>Pay online</h4></a></div>--}}
                    {{--<div><h1>Payment:</h1></div>--}}
                    {{--{{$order->is_paid == 1 ? 'Paid' : 'Not Paid!'}}--}}
                    {{--<a href="{!! URL::route('addmoney.paypal', $order->id) !!}"><h4>Pay online</h4></a>--}}
                {{--</div>--}}
            {{--</div>--}}
@endsection
