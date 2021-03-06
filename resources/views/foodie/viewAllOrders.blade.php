@extends('foodie.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/foodie/orderAll.css">
    <script>
        from = '{{$from}}'
    </script>
    <script src="/js/foodie/orderAll.js" defer></script>


@endsection

@section('page_content')

    <div class="container" style="width:85%;">
        {{--<div class="row" style="margin-top: 1rem;">--}}
            {{--<nav class="light-green lighten-1 white-text">--}}
                {{--<div class="left col s12">--}}
                    {{--<ul>--}}
                        {{--<li>--}}
                            {{--<span style="font-size: 20px;">View Orders</span>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</nav>--}}
        {{--</div>--}}
    @if($ordersCount>0)
    <div class="row" style="margin-top: 1rem;">
        <div class="col s7 offset-m2">
            <div id="allLinkContain" class="col s2 center"><a href="#!" class="allLink">All</a></div>
            <div id="pendLinkContain" class="col s2 center"><a href="#!" class="pendLink">Pending</a></div>
            <div id="paidLinkContain" class="col s2 center"><a href="#!" class="paidLink">Paid</a></div>
            <div id="cancelLinkContain" class="col s2 center"><a href="#!" class="cancelLink">Cancelled</a></div>
            {{--<div id="refundLinkContain" class="col s2 center"><a href="#!" class="refundLink">Refunds</a></div>--}}
        </div>
        {{--<div class="row" >--}}
            {{--<div class="col s12" style="margin-top: 6px;">--}}
                {{--<div class="divider"></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
    <div class="row">
        <div class="col s12 m2">
            <div class="row">
                <div>
                    ORDERS
                </div>
            </div>
            <div class="divider"></div>
            <div class="row">
                <ul class="collection">
                    <li class="collection-item" style="border: 1px solid #f57c00;">
                        <a href="{{route("foodie.order.view", ['id'=> 0])}}" style="color: #f57c00;">Orders</a>
                    </li>
                    <li class="collection-item">
                        <a href="{{route('foodie.plan.show')}}">Browse Plans</a>
                    </li>
                    <li class="collection-item">
                        <a href="{{route('foodie.profile')}}">Profile</a>
                    </li>
                    <li class="collection-item">
                        <a href="{{route('foodie.message.index')}}">Messages</a>
                        {{--@if($messages->count()>0)--}}
                            {{--<span class="new badge red">{{$messages->count()}}</span>--}}
                        {{--@endif--}}
                    </li>
                    <li class="collection-item">
                        <a href="{{route('chef.rating', ['id'=>1])}}">Ratings</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <ul class="collection">
                    <li class="collection-item"><div>Total Orders:</div> <span style="font-size: 14px;">{{$ordersCount}} orders</span></li>
                    <li class="collection-item"><div>Total Paid:</div> <span style="font-size: 14px;">PHP {{number_format($totalPaid,2,'.',',')}}</span></li>
                    <li class="collection-item"><div>Total Unpaid:</div> <span style="font-size: 14px;">PHP {{number_format($totalPend,2,'.',',')}}</span></li>
                    {{--<li class="collection-item"></li>--}}
                </ul>
            </div>
        </div>
            <div class="col s12 m10">
                    <div id="ordAll">
                        <div class="row">
                            <div class="col s12 m3">
                                <div>
                                    <span>Search by Interval:</span>
                                </div>
                                <select id="orderFilter">
                                    <option value="1">Today</option>
                                    <option value="2" selected>This Week</option>
                                    <option value="3">This Month</option>
                                    <option value="4">This Year</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col s12 m3">
                                    <div>
                                        <span>Search By Date:</span>
                                    </div>
                                    {{--<select id="yearFilter"></select>--}}
                                    {{--<select id="monthFilter"></select>--}}
                                    {{--<select id="dayFilter"></select>--}}
                                    <input type="text" id="dateFilter" placeholder="Please choose a day">
                                    {{--<select id="dateFilter">--}}
                                    {{--</select>--}}
                                </div>
                            </div>
                        </div>
                        <div id="dayPick">

                        </div>
                        {{--<div class="row" id="ordAllContent">--}}
                            {{--@foreach($orders as $order)--}}
                                {{--@if($order->is_paid==0 && $order->is_cancelled==0)--}}
                                        {{--<div class="card">--}}
                                            {{--@foreach($orderArray as $orderItem)--}}
                                                {{--@if($orderItem['id'] == $order->id)--}}
                                            {{--<div class="card-title" style="font-size: 18px;">--}}
                                                {{--<div class="row" style="margin: 0 0 20px 0; padding: 5px;">--}}
                                                    {{--<div class="col s12 m1">--}}
                                                        {{--<div>ID</div>--}}
                                                        {{--<div style="font-size: 22px;">{{$orderItem['id']}}</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col s12 m2">--}}
                                                        {{--<div>For Week Of</div>--}}
                                                        {{--<div style="font-size: 22px;">{{$orderItem['week']}}</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col s12 m3">--}}
                                                        {{--<div>Total</div>--}}
                                                        {{--<div style="font-size: 22px;">{{'PHP '.$orderItem['total']}}</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col s12 m4">--}}
                                                        {{--<div>Address</div>--}}
                                                        {{--<div style="font-size: 22px;">{{$orderItem['address']}}</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col s12 m3">--}}
                                                        {{--<div>Status</div>--}}
                                                        {{--<div style="font-size: 22px;">{{$orderItem['is_paid']}}</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--<div class="row" style="margin: 0 0 20px 0; padding: 5px;">--}}
                                                    {{--<div class="col s12 m2">--}}
                                                        {{--<div>Order Date</div>--}}
                                                        {{--<div style="font-size: 22px;">{{$orderItem['created_at']}}</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                            {{--<div class="divider" style="margin: 0 5px;">--}}
                                            {{--</div>--}}
                                            {{--<div class="card-content">--}}
                                                {{--@foreach($orderItemArray as $orderItemItem)--}}
                                                    {{--@if($orderItemItem['order_id']==$order->id)--}}
                                                {{--<div class="row">--}}
                                                    {{--<div class="col s12 m3">--}}
                                                        {{--<img src="/img/{{$orderItemItem['planPic']}}" class="img-responsive" style="max-width:150px;"/>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col s12 m4" style="font-size: 20px;">--}}
                                                        {{--<div>{{$orderItemItem['plan']}}</div>--}}
                                                        {{--<div>Made By: {{$orderItemItem['chef']}}</div>--}}
                                                        {{--<div>Type:  {{$orderItemItem['type']}}</div>--}}
                                                        {{--<div>Quantity: {{$orderItemItem['quantity']}}</div>--}}
                                                        {{--<div>Amount: {{$orderItemItem['price']}}</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="col s12 offset-m2 m2">--}}
                                                        {{--<div>--}}
                                                            {{--<a href="{{route('foodie.order.single', $orderItemItem['id'])}}" class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col s12 m2">--}}
                                                    {{--<a href="{{route('order.show', $order->id)}}" class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Pay</a>--}}
                                                {{--</div>--}}
                                                {{--<div class="col s12 m2">--}}
                                                    {{--<button data-target="cancelAllModal{{$order->id}}" class="btn btn-primary waves-effect waves-light red modal-trigger" style="font-weight: 100;">Cancel</button>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div id="cancelAllModal{{$order->id}}" class="modal">--}}
                                                {{--<div class="modal-content">--}}
                                                    {{--<div>--}}
                                                        {{--<span>Are you sure you want to cancel your order?</span>--}}
                                                    {{--</div>--}}
                                                    {{--<form action="{{route('foodie.orderAll.cancel', $order->id)}}" method="post">--}}
                                                        {{--{{ csrf_field() }}--}}
                                                        {{--<button class="red btn waves-effect waves-light">Cancel</button>--}}
                                                    {{--</form>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--@elseif($order->is_paid==1 && $order->is_cancelled==0)--}}
                                    {{--<div class="card">--}}
                                        {{--@foreach($orderArray as $orderItem)--}}
                                            {{--@if($orderItem['id'] == $order->id)--}}
                                                {{--<div class="card-title" style="font-size: 18px;">--}}
                                                    {{--<div class="row" style="margin: 0 0 20px 0; padding: 5px;">--}}
                                                        {{--<div class="col s12 m1">--}}
                                                            {{--<div>ID</div>--}}
                                                            {{--<div style="font-size: 22px;">{{$orderItem['id']}}</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 m2">--}}
                                                            {{--<div>For Week Of</div>--}}
                                                            {{--<div style="font-size: 22px;">{{$orderItem['week']}}</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 m3">--}}
                                                            {{--<div>Total</div>--}}
                                                            {{--<div style="font-size: 22px;">{{'PHP '.$orderItem['total']}}</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 m4">--}}
                                                            {{--<div>Address</div>--}}
                                                            {{--<div style="font-size: 22px;">{{$orderItem['address']}}</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 m3">--}}
                                                            {{--<div>Status</div>--}}
                                                            {{--<div style="font-size: 22px;">{{$orderItem['is_paid']}}</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="row" style="margin: 0 0 20px 0; padding: 5px;">--}}
                                                        {{--<div class="col s12 m2">--}}
                                                            {{--<div>Order Date</div>--}}
                                                            {{--<div style="font-size: 22px;">{{$orderItem['created_at']}}</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--@endif--}}
                                        {{--@endforeach--}}
                                        {{--<div class="divider" style="margin: 0 5px;">--}}
                                        {{--</div>--}}
                                        {{--<div class="card-content">--}}
                                            {{--@foreach($orderItemArray as $orderItemItem)--}}
                                                {{--@if($orderItemItem['order_id']==$order->id)--}}
                                                    {{--<div class="row">--}}
                                                        {{--<div class="col s12 m3">--}}
                                                            {{--<img src="/img/{{$orderItemItem['planPic']}}" class="img-responsive" style="max-width:150px;"/>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 m4" style="font-size: 20px;">--}}
                                                            {{--<div>{{$orderItemItem['plan']}}</div>--}}
                                                            {{--<div>Made By: {{$orderItemItem['chef']}}</div>--}}
                                                            {{--<div>Type:  {{$orderItemItem['type']}}</div>--}}
                                                            {{--<div>Quantity: {{$orderItemItem['quantity']}}</div>--}}
                                                            {{--<div>Amount: {{$orderItemItem['price']}}</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 offset-m2 m2">--}}
                                                            {{--<a href="{{route('foodie.order.single', $orderItemItem['id'])}}" class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">View</a>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</div>--}}
                    </div>
                    <div id="ordPend">
                        <div class="row">
                            <div class="col s12 m3">
                                <div>
                                    <span>Search by Interval:</span>
                                </div>
                                <select id="orderPendFilter">
                                    <option value="1">Today</option>
                                    <option value="2" selected>This Week</option>
                                    <option value="3">This Month</option>
                                    <option value="4">This Year</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col s12 m3">
                                    <div>
                                        <span>Search By Date:</span>
                                    </div>
                                    {{--<select id="yearFilter"></select>--}}
                                    {{--<select id="monthFilter"></select>--}}
                                    {{--<select id="dayFilter"></select>--}}
                                    <input type="text" id="datePendFilter" placeholder="Please choose a day">

                                    {{--<select id="datePendFilter">--}}
                                    {{--</select>--}}
                                </div>
                            </div>
                        </div>
                        <div id="dayPendPick">

                        </div>
                        {{--@if($pendOrdCount>0)--}}
                            {{--@foreach($orders as $order)--}}
                                {{--@if($order->is_paid==0 && $order->is_cancelled==0)--}}
                                    {{--<div class="card">--}}
                                        {{--@foreach($orderArray as $orderItem)--}}
                                            {{--@if($orderItem['id'] == $order->id)--}}
                                                {{--<div class="card-title" style="font-size: 18px;">--}}
                                                    {{--<div class="row" style="margin: 0 0 20px 0; padding: 5px;">--}}
                                                        {{--<div class="col s12 m1">--}}
                                                            {{--<div>ID</div>--}}
                                                            {{--<div style="font-size: 22px;">{{$orderItem['id']}}</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 m2">--}}
                                                            {{--<div>For Week Of</div>--}}
                                                            {{--<div style="font-size: 22px;">{{$orderItem['week']}}</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 m3">--}}
                                                            {{--<div>Total</div>--}}
                                                            {{--<div style="font-size: 22px;">{{'PHP '.$orderItem['total']}}</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 m4">--}}
                                                            {{--<div>Address</div>--}}
                                                            {{--<div style="font-size: 22px;">{{$orderItem['address']}}</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 m3">--}}
                                                            {{--<div>Status</div>--}}
                                                            {{--<div style="font-size: 22px;">{{$orderItem['is_paid']}}</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="row" style="margin: 0 0 20px 0; padding: 5px;">--}}
                                                        {{--<div class="col s12 m2">--}}
                                                            {{--<div>Order Date</div>--}}
                                                            {{--<div style="font-size: 22px;">{{$orderItem['created_at']}}</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--@endif--}}
                                        {{--@endforeach--}}
                                        {{--<div class="divider" style="margin: 0 5px;">--}}
                                        {{--</div>--}}
                                        {{--<div class="card-content">--}}
                                            {{--@foreach($orderItemArray as $orderItemItem)--}}
                                                {{--@if($orderItemItem['order_id']==$order->id)--}}
                                                    {{--<div class="row">--}}
                                                        {{--<div class="col s12 m3">--}}
                                                            {{--<img src="/img/{{$orderItemItem['planPic']}}" class="img-responsive" style="max-width:150px;"/>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 m4" style="font-size: 20px;">--}}
                                                            {{--<div>{{$orderItemItem['plan']}}</div>--}}
                                                            {{--<div>Made By: {{$orderItemItem['chef']}}</div>--}}
                                                            {{--<div>Type:  {{$orderItemItem['type']}}</div>--}}
                                                            {{--<div>Quantity: {{$orderItemItem['quantity']}}</div>--}}
                                                            {{--<div>Amount: {{$orderItemItem['price']}}</div>--}}
                                                            {{--@if($orderItemItem['is_delivered']==0)--}}
                                                                {{--<div>Delivery: Pending</div>--}}
                                                            {{--@elseif($orderItemItem['is_delivered']==1)--}}
                                                                {{--<div>Delivery: Delivered</div>--}}
                                                            {{--@endif--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 offset-m2 m2">--}}
                                                            {{--<a href="{{route('foodie.order.single', $orderItemItem['id'])}}" class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">View</a>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                            {{--<div class="row">--}}
                                                {{--<div class="col s12 m2">--}}
                                                    {{--<a href="{{route('order.show', $order->id)}}" class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Pay</a>--}}
                                                {{--</div>--}}
                                                {{--<div class="col s12 m2">--}}
                                                    {{--<button data-target="cancelPendModal{{$order->id}}" class="btn btn-primary waves-effect waves-light red modal-trigger" style="font-weight: 100;">Cancel</button>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<div id="cancelPendModal{{$order->id}}" class="modal">--}}
                                                {{--<div class="modal-content">--}}
                                                    {{--<div>--}}
                                                        {{--<span>Are you sure you want to cancel your order?</span>--}}
                                                    {{--</div>--}}
                                                    {{--<form action="{{route('foodie.orderAll.cancel', $order->id)}}" method="post">--}}
                                                        {{--{{csrf_field()}}--}}
                                                        {{--<button class="btn waves-effect waves-light">Cancel</button>--}}
                                                    {{--</form>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--@else--}}
                            {{--No Pending Orders--}}
                        {{--@endif--}}
                    </div>
                    <div id="ordPaid">
                        <div class="row">
                            <div class="col s12 m3">
                                <div>
                                    <span>Search by Interval:</span>
                                </div>
                                <select id="orderPaidFilter">
                                    <option value="1">Today</option>
                                    <option value="2" selected>This Week</option>
                                    <option value="3">This Month</option>
                                    <option value="4">This Year</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col s12 m3">
                                    <div>
                                        <span>Search By Date:</span>
                                    </div>
                                    {{--<select id="yearFilter"></select>--}}
                                    {{--<select id="monthFilter"></select>--}}
                                    {{--<select id="dayFilter"></select>--}}
                                    <input type="text" id="datePaidFilter" placeholder="Please choose a day">
                                    {{--<select id="datePaidFilter">--}}
                                    {{--</select>--}}
                                </div>
                            </div>
                        </div>
                        <div id="dayPaidPick">

                        </div>
                        {{--@if($paidOrdCount>0)--}}
                            {{--@foreach($orders as $order)--}}
                                {{--@if($order->is_paid==1 && $order->is_cancelled==0)--}}
                                        {{--<div class="card">--}}
                                            {{--@foreach($orderArray as $orderItem)--}}
                                                {{--@if($orderItem['id'] == $order->id)--}}
                                                    {{--<div class="card-title" style="font-size: 18px;">--}}
                                                        {{--<div class="row" style="margin: 0 0 20px 0; padding: 5px;">--}}
                                                            {{--<div class="col s12 m1">--}}
                                                                {{--<div>ID</div>--}}
                                                                {{--<div style="font-size: 22px;">{{$orderItem['id']}}</div>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="col s12 m2">--}}
                                                                {{--<div>For Week Of</div>--}}
                                                                {{--<div style="font-size: 22px;">{{$orderItem['week']}}</div>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="col s12 m3">--}}
                                                                {{--<div>Total</div>--}}
                                                                {{--<div style="font-size: 22px;">{{'PHP '.$orderItem['total']}}</div>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="col s12 m4">--}}
                                                                {{--<div>Address</div>--}}
                                                                {{--<div style="font-size: 22px;">{{$orderItem['address']}}</div>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="col s12 m3">--}}
                                                                {{--<div>Status</div>--}}
                                                                {{--<div style="font-size: 22px;">{{$orderItem['is_paid']}}</div>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="row" style="margin: 0 0 20px 0; padding: 5px;">--}}
                                                            {{--<div class="col s12 m2">--}}
                                                                {{--<div>Order Date</div>--}}
                                                                {{--<div style="font-size: 22px;">{{$orderItem['created_at']}}</div>--}}
                                                            {{--</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                                {{--<div class="divider" style="margin: 0 5px;">--}}
                                                {{--</div>--}}
                                                {{--<div class="card-content">--}}
                                                    {{--@foreach($orderItemArray as $orderItemItem)--}}
                                                        {{--@if($orderItemItem['order_id']==$order->id)--}}
                                                    {{--<div class="row">--}}
                                                        {{--<div class="col s12 m3">--}}
                                                            {{--<img src="/img/{{$orderItemItem['planPic']}}" class="img-responsive" style="max-width:150px;"/>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 m4" style="font-size: 20px;">--}}
                                                            {{--<div>{{$orderItemItem['plan']}}</div>--}}
                                                            {{--<div>Made By: {{$orderItemItem['chef']}}</div>--}}
                                                            {{--<div>Type:  {{$orderItemItem['type']}}</div>--}}
                                                            {{--<div>Quantity: {{$orderItemItem['quantity']}}</div>--}}
                                                            {{--<div>Amount: {{$orderItemItem['price']}}</div>--}}
                                                            {{--@if($orderItemItem['is_delivered']==0)--}}
                                                                {{--<div>Delivery: Pending</div>--}}
                                                            {{--@elseif($orderItemItem['is_delivered']==1)--}}
                                                                {{--<div>Delivery: Delivered</div>--}}
                                                            {{--@endif--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 offset-m2 m2">--}}
                                                            {{--<a href="{{route('foodie.order.single', $orderItemItem['id'])}}" class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100; ">View</a>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--@endif--}}
                                                {{--@endforeach--}}
                                                {{--</div>--}}
                                        {{--</div>--}}

                                    {{--<a href="{{route('order.show', $order->id)}}">--}}
                                        {{--<div class="row">--}}
                                            {{--<div class="card">--}}
                                                {{--<div class="card-panel">--}}
                                                    {{--<table>--}}
                                                        {{--<thead>--}}
                                                        {{--<tr>--}}
                                                            {{--<th>ID</th>--}}
                                                            {{--<th>Week</th>--}}
                                                            {{--<th>Address</th>--}}
                                                            {{--<th>Payment Status</th>--}}
                                                            {{--<th>Total</th>--}}
                                                        {{--</tr>--}}
                                                        {{--</thead>--}}
                                                        {{--<tbody>--}}
                                                        {{--@foreach($orderArray as $orderItem)--}}
                                                            {{--@if($orderItem['id'] == $order->id)--}}
                                                                {{--<tr>--}}
                                                                    {{--<td class="orderID">{{$orderItem['id']}}</td>--}}
                                                                    {{--<td class="orderWeek">{{$orderItem['week']}}</td>--}}
                                                                    {{--<td class="orderAddress">{{$orderItem['address']}}</td>--}}
                                                                    {{--<td class="orderPaid">{{$orderItem['is_paid']}}</td>--}}
                                                                    {{--<td class="orderPaid">{{'PHP'.$orderItem['total']}}</td>--}}
                                                                {{--</tr>--}}
                                                            {{--@endif--}}
                                                        {{--@endforeach--}}
                                                        {{--</tbody>--}}
                                                    {{--</table>--}}

                                                    {{--<table>--}}
                                                        {{--<thead>--}}
                                                        {{--<tr>--}}
                                                            {{--<th>Plan Name</th>--}}
                                                            {{--<th>Chef Name</th>--}}
                                                            {{--<th>Quantity</th>--}}
                                                            {{--<th>Amount</th>--}}
                                                            {{--<th>Type</th>--}}
                                                        {{--</tr>--}}
                                                        {{--</thead>--}}
                                                        {{--<tbody>--}}
                                                        {{--@foreach($orderItemArray as $orderItemItem)--}}
                                                            {{--@if($orderItemItem['order_id']==$order->id)--}}
                                                                {{--<tr>--}}
                                                                    {{--<td>{{$orderItemItem['plan']}}</td>--}}
                                                                    {{--<td>{{$orderItemItem['chef']}}</td>--}}
                                                                    {{--<td>{{$orderItemItem['quantity']}}</td>--}}
                                                                    {{--<td>{{$orderItemItem['price']}}</td>--}}
                                                                    {{--<td>{{$orderItemItem['type']}}</td>--}}
                                                                {{--</tr>--}}
                                                            {{--@endif--}}
                                                        {{--@endforeach--}}
                                                        {{--</tbody>--}}
                                                    {{--</table>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--@else--}}
                            {{--No Paid Orders--}}
                        {{--@endif--}}
                    </div>
                    <div id="ordCancel">
                        <div class="row">
                            <div class="col s12 m3">
                                <div>
                                    <span>Search by Interval:</span>
                                </div>
                                <select id="orderCancelFilter">
                                    <option value="1">Today</option>
                                    <option value="2" selected>This Week</option>
                                    <option value="3">This Month</option>
                                    <option value="4">This Year</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col s12 m3">
                                    <div>
                                        <span>Search By Date:</span>
                                    </div>
                                    {{--<select id="yearFilter"></select>--}}
                                    {{--<select id="monthFilter"></select>--}}
                                    {{--<select id="dayFilter"></select>--}}
                                    <input type="text" id="dateCancelFilter" placeholder="Please choose a day">
                                    {{--<select id="dateCancelFilter">--}}
                                    {{--</select>--}}
                                </div>
                            </div>
                        </div>
                        <div id="dayCancelPick">

                        </div>
                        {{--@if($cancelOrdCount)--}}
                        {{--@foreach($orders as $order)--}}
                            {{--@if($order->is_cancelled==1)--}}
                                    {{--<div class="card">--}}
                                        {{--@foreach($orderArray as $orderItem)--}}
                                            {{--@if($orderItem['id'] == $order->id)--}}
                                                {{--<div class="card-title" style="font-size: 18px;">--}}
                                                    {{--<div class="row" style="margin: 0 0 20px 0; padding: 5px;">--}}
                                                        {{--<div class="col s12 m1">--}}
                                                            {{--<div>ID</div>--}}
                                                            {{--<div style="font-size: 22px;">{{$orderItem['id']}}</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 m2">--}}
                                                            {{--<div>For Week Of</div>--}}
                                                            {{--<div style="font-size: 22px;">{{$orderItem['week']}}</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 m3">--}}
                                                            {{--<div>Total</div>--}}
                                                            {{--<div style="font-size: 22px;">{{'PHP'.$orderItem['total']}}</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 m4">--}}
                                                            {{--<div>Address</div>--}}
                                                            {{--<div style="font-size: 22px;">{{$orderItem['address']}}</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 m3">--}}
                                                            {{--<div>Status</div>--}}
                                                            {{--<div style="font-size: 22px;">Cancelled</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="row" style="margin: 0 0 20px 0; padding: 5px;">--}}
                                                        {{--<div class="col s12 m2">--}}
                                                            {{--<div>Order Date</div>--}}
                                                            {{--<div style="font-size: 22px;">{{$orderItem['created_at']}}</div>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--@endif--}}
                                        {{--@endforeach--}}
                                        {{--<div class="divider" style="margin: 0 5px;">--}}
                                        {{--</div>--}}
                                        {{--<div class="card-content">--}}
                                            {{--@foreach($orderItemArray as $orderItemItem)--}}
                                                {{--@if($orderItemItem['order_id']==$order->id)--}}
                                                    {{--<div class="row">--}}
                                                        {{--<div class="col s12 m3">--}}
                                                            {{--<img src="/img/{{$orderItemItem['planPic']}}" class="img-responsive" style="max-width:150px;"/>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 m4" style="font-size: 20px;">--}}
                                                            {{--<div>{{$orderItemItem['plan']}}</div>--}}
                                                            {{--<div>Made By: {{$orderItemItem['chef']}}</div>--}}
                                                            {{--<div>Type:  {{$orderItemItem['type']}}</div>--}}
                                                            {{--<div>Quantity: {{$orderItemItem['quantity']}}</div>--}}
                                                            {{--<div>Amount: {{'PHP '.$orderItemItem['price']}}</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col s12 offset-m2 m2">--}}
                                                            {{--<a href="{{route('foodie.order.single', $orderItemItem['id'])}}" class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">View</a>--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                    {{--@else--}}
                        {{--No Cancelled Orders--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--@else--}}
                {{--No Orders Yet!--}}
            {{--@endif--}}
        </div>
        {{--<div id="ordRefund">--}}
            {{--<div class="row">--}}
                {{--<div class="col s12 m3">--}}
                    {{--<div>--}}
                        {{--<span>Search by Interval:</span>--}}
                    {{--</div>--}}
                    {{--<select id="orderRefundFilter">--}}
                        {{--<option value="1">Today</option>--}}
                        {{--<option value="2" selected>This Week</option>--}}
                        {{--<option value="3">This Month</option>--}}
                        {{--<option value="4">This Year</option>--}}
                    {{--</select>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div id="dayRefundPick">--}}

            {{--</div>--}}
        {{--</div>--}}
        @else
            No Orders Yet!
        @endif
    </div>
</div>
</div>


<div id="cancelModal" class="modal">
    <div class="modal-content">

            <div>
                <form method="post" action="{{route('foodie.orderAll.cancel')}}" id="cancelForm">
                    {{ csrf_field() }}
                    <input type="hidden" name="cancelId" id="cancelId" value="">
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
                        <label for="pref-noDel">Cannot Take Delivery</label><br/>
                    </div>
                    <div>
                        <input type="radio" name="cancelReason" value="3" class="filled-in" id="pref-noTown" data-error=".error-pref"/>
                        <label for="pref-noTown">Out of Town</label><br/>
                    </div>

                    <button type="submit" class="btn waves-effect waves-light orange darken-2">Submit</button>
                </form>
            </div>
    </div>
</div>

@endsection