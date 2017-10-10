@extends('chef.layout')
@section('page_head')
@endsection
    <link rel="stylesheet" href="/css/chef/orderAll.css">
    <script>
        from = '{{$from}}'
    </script>
    <script src="/js/chef/orderAll.js" defer></script>

@section('page_content')

    @if(count($orders)>0)
        <div class="container" style="width: 85%; margin-top: 1rem;">
            <div class="row">
                <div class="col offset-m2 s7">
                    <div id="allLinkContain" class="col s2 center"><a href="#!" class="allLink">All</a></div>
                    <div id="pendLinkContain" class="col s2 center"><a href="#!" class="pendLink">Pending</a></div>
                    <div id="paidLinkContain" class="col s2 center"><a href="#!" class="paidLink">Paid</a></div>
                    <div id="deliveredLinkContain" class="col s2 center"><a href="#!" class="deliveredLink">Delivered</a></div>
                    <div id="cancelLinkContain" class="col s2 center"><a href="#!" class="cancelLink">Cancelled</a></div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m2">
                    <div class="row">
                        <div>
                           ORDERS
                        </div>
                    </div>
                    <div class="divider"></div>
                    <ul class="collection">
                        <li class="collection-item" style="border: 1px solid #f57c00;">
                            <a href="{{route("chef.order.view", ['id'=> 0])}}" style="color: #f57c00;" >Orders</a>
                        </li>
                        <li class="collection-item" >
                            <a href="{{route('chef.plan')}}" >View Your Plans</a>
                        </li>
                        <li class="collection-item">
                            <a href="{{route('chef.profile')}}">Profile</a>
                        </li>
                        <li class="collection-item" >
                            <a href="{{route('chef.message.index')}}" >Messages</a>
                            {{--@if($messages->count()>0)--}}
                                {{--<span class="new badge red">{{$messages->count()}}</span>--}}
                            {{--@endif--}}
                        </li>
                        <li class="collection-item" >
                            <a href="{{route('chef.ratings')}}" >Ratings</a>
                        </li>
                    </ul>
                    <div>
                        <ul class="collection">
                            <li class="collection-item"><div>Total Orders:</div> <span style="font-size: 14px;">{{$orderItems->count()}} orders</span></li>
                            <li class="collection-item"><div>Pending Delivery:</div> <span style="font-size: 14px;">{{$orderItems->where('is_delivered','=',0)->count()}} orders</span></li>
                            <li class="collection-item"><div>Delivered:</div> <span style="font-size: 14px;">{{$orderItems->where('is_delivered','=',1)->count()}} orders</span></li>
                            <li class="collection-item"><div>Total Paid:</div> <span style="font-size: 14px;">PHP {{number_format($totalPaid,2,'.',',')}}</span></li>
                            <li class="collection-item"><div>Total Unpaid:</div> <span style="font-size: 14px;">PHP {{number_format($pendPaid,2,'.',',')}}</span></li>
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
                            <div class="col s12 m2">
                                <div>
                                    <span>Search By Date:</span>
                                </div>
                                {{--<select id="yearFilter"></select>--}}
                                {{--<select id="monthFilter"></select>--}}
                                {{--<select id="dayFilter"></select>--}}
                                {{--<input type="text" id="dateFilter" placeholder="Please choose a day">--}}
                                <select id="dateFilter">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="dayPick">

                    </div>
                    {{--@foreach($orders as $order)--}}
                        {{--@if($order['is_paid']==0 && $order['is_cancelled']==0)--}}
                            {{--<div class="card">--}}
                                {{--<div class="card-title" style="font-size: 18px;">--}}
                                    {{--<div class="row" style="margin: 0 0 20px 0; padding: 5px;">--}}
                                        {{--<div class="col s12 m2">--}}
                                            {{--<div>For Week Of</div>--}}
                                            {{--<div style="font-size: 22px;">{{$order['week']}}</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col s12 m3" style="font-size: 20px;">--}}
                                            {{--<div>--}}
                                                {{--<div> Ordered By:</div>--}}
                                                {{--<div>--}}
                                                    {{--@foreach($foodies as $foodie)--}}
                                                        {{--@if($order['foodie_id']==$foodie->id)--}}
                                                            {{--<span>{{$foodie->first_name.' '.$foodie->last_name}}</span>--}}
                                                        {{--@endif--}}
                                                    {{--@endforeach--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col s12 m3" style="font-size: 20px;">--}}
                                            {{--<div>--}}
                                                {{--<div>Status:</div>--}}
                                                {{--<div>--}}
                                                   {{--Pending--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="divider" style="margin: 0 5px;">--}}
                                {{--</div>--}}
                                {{--<div class="card-content">--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col s12 m2">--}}
                                            {{--<img src="/img/{{$order['picture']}}" class="img-responsive" style="max-width:100px;"/>--}}
                                        {{--</div>--}}
                                        {{--<div class="col s12 m4">--}}
                                            {{--<div style="font-size: 20px;">--}}
                                                {{--<span>Plan: </span><span>{{$order['plan_name']}}</span>--}}
                                            {{--</div>--}}
                                            {{--<div style="font-size: 20px;">--}}
                                                {{--<span>Type: </span><span>{{$order['order_type']}}</span>--}}
                                            {{--</div>--}}
                                            {{--<div style="font-size: 20px;">--}}
                                                {{--<span>Quantity: </span><span>{{$order['quantity']}}</span>--}}
                                            {{--</div>--}}
                                            {{--<div style="font-size: 20px;">--}}
                                                {{--<span>Amount: </span><span>{{'PHP '.number_format($order['price'],2,'.',',')}}</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col s12 m2 offset-m2">--}}
                                            {{--<a href="{{route('chef.order.single', $order['id'])}}" class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Details</a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@elseif($order['is_paid']==1 && $order['is_cancelled']==0)--}}
                            {{--<div class="card">--}}
                                {{--<div class="card-title" style="font-size: 18px;">--}}
                                    {{--<div class="row" style="margin: 0 0 20px 0; padding: 5px;">--}}
                                        {{--<div class="col s12 m2">--}}
                                            {{--<div>For Week Of</div>--}}
                                            {{--<div style="font-size: 22px;">{{$order['week']}}</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col s12 m3" style="font-size: 20px;">--}}
                                            {{--<div>--}}
                                                {{--<div> Ordered By:</div>--}}
                                                {{--<div>--}}
                                                    {{--@foreach($foodies as $foodie)--}}
                                                        {{--@if($order['foodie_id']==$foodie->id)--}}
                                                            {{--<span>{{$foodie->first_name.' '.$foodie->last_name}}</span>--}}
                                                        {{--@endif--}}
                                                    {{--@endforeach--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col s12 m3" style="font-size: 20px;">--}}
                                            {{--<div>--}}
                                                {{--<div>Status:</div>--}}
                                                {{--<div>--}}
                                                    {{--Paid--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="divider" style="margin: 0 5px;">--}}
                                {{--</div>--}}
                                {{--<div class="card-content">--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="col s12 m2">--}}
                                            {{--<img src="/img/{{$order['picture']}}" class="img-responsive" style="max-width:100px;"/>--}}
                                        {{--</div>--}}
                                        {{--<div class="col s12 m4">--}}
                                            {{--<div style="font-size: 20px;">--}}
                                                {{--<span>Plan: </span><span>{{$order['plan_name']}}</span>--}}
                                            {{--</div>--}}
                                            {{--<div style="font-size: 20px;">--}}
                                                {{--<span>Type: </span><span>{{$order['order_type']}}</span>--}}
                                            {{--</div>--}}
                                            {{--<div style="font-size: 20px;">--}}
                                                {{--<span>Quantity: </span><span>{{$order['quantity']}}</span>--}}
                                            {{--</div>--}}
                                            {{--<div style="font-size: 20px;">--}}
                                                {{--<span>Amount: </span><span>{{'PHP '.number_format($order['price'],2,'.',',')}}</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="col s12 m2 offset-m2">--}}
                                            {{--<a href="{{route('chef.order.single', $order['id'])}}" class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Details</a>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endif--}}
                    {{--@endforeach--}}
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
                            <div class="col s12 m2">
                                <div>
                                    <span>Search By Date:</span>
                                </div>
                                {{--<select id="yearFilter"></select>--}}
                                {{--<select id="monthFilter"></select>--}}
                                {{--<select id="dayFilter"></select>--}}
                                {{--<input type="text" id="dateFilter" placeholder="Please choose a day">--}}
                                <select id="datePendFilter">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="dayPendPick">

                    </div>
                    <div id="ordPendAll">
                        @foreach($orders as $order)
                            @if($order['is_delivered']==0 && $order['is_cancelled']==0)
                                <div class="card">
                                    <div class="card-title" style="font-size: 18px;">
                                        <div class="row" style="margin: 0 0 20px 0; padding: 5px;">
                                            <div class="col s12 m2">
                                                <div>For Week Of</div>
                                                <div style="font-size: 22px;">{{$order['week']}}</div>
                                            </div>
                                            <div class="col s12 m3" style="font-size: 20px;">
                                                <div>
                                                    <div> Ordered By:</div>
                                                    <div>
                                                        @foreach($foodies as $foodie)
                                                            @if($order['foodie_id']==$foodie->id)
                                                                <span>{{$foodie->first_name.' '.$foodie->last_name}}</span>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12 m2" style="font-size: 20px;">
                                                <div>
                                                    <div>Payment:</div>
                                                    <div>
                                                        @if($order['is_paid']==0)
                                                            Pending
                                                        @else
                                                            Paid
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12 m2" style="font-size: 20px;">
                                                <div>
                                                    <div>Order Date:</div>
                                                    <div>
                                                        {{$order['created_at']}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12 m2" style="font-size: 20px;">
                                                <div>
                                                    <div>Delivery:</div>
                                                    <div>
                                                        Pending
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;">
                                    </div>
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col s12 m2">
                                                <img src="/img/{{$order['picture']}}" class="img-responsive" style="max-width:100px;"/>
                                            </div>
                                            <div class="col s12 m4">
                                                <div style="font-size: 20px;">
                                                    <span>Plan: </span><span>{{$order['plan_name']}}</span>
                                                </div>
                                                <div style="font-size: 20px;">
                                                    <span>Type: </span><span>{{$order['order_type']}}</span>
                                                </div>
                                                <div style="font-size: 20px;">
                                                    <span>Quantity: </span><span>{{$order['quantity']}}</span>
                                                </div>
                                                <div style="font-size: 20px;">
                                                    <span>Amount: </span><span>{{'PHP '.number_format($order['price'],2,'.',',')}}</span>
                                                </div>
                                            </div>
                                            <div class="col s12 m2 offset-m2">
                                                <a href="{{route('chef.order.single', $order['id'])}}" class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
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
                            <div class="col s12 m2">
                                <div>
                                    <span>Search By Date:</span>
                                </div>
                                {{--<select id="yearFilter"></select>--}}
                                {{--<select id="monthFilter"></select>--}}
                                {{--<select id="dayFilter"></select>--}}
                                {{--<input type="text" id="dateFilter" placeholder="Please choose a day">--}}
                                <select id="datePaidFilter">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="dayPaidPick">

                    </div>
                    <div id="ordPaidAll">
                        @foreach($orders as $order)
                            @if($order['is_paid']==1 && $order['is_cancelled']==0)
                                <div class="card">
                                    <div class="card-title" style="font-size: 18px;">
                                        <div class="row" style="margin: 0 0 20px 0; padding: 5px;">
                                            <div class="col s12 m2">
                                                <div>For Week Of</div>
                                                <div style="font-size: 22px;">{{$order['week']}}</div>
                                            </div>
                                            <div class="col s12 m3" style="font-size: 20px;">
                                                <div>
                                                    <div> Ordered By:</div>
                                                    <div>
                                                        @foreach($foodies as $foodie)
                                                            @if($order['foodie_id']==$foodie->id)
                                                                <span>{{$foodie->first_name.' '.$foodie->last_name}}</span>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12 m2" style="font-size: 20px;">
                                                <div>
                                                    <div>Payment:</div>
                                                    <div>
                                                        Paid
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12 m2" style="font-size: 20px;">
                                                <div>
                                                    <div>Order Date:</div>
                                                    <div>
                                                        {{$order['created_at']}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col s12 m2" style="font-size: 20px;">
                                                <div>
                                                    <div>Delivery:</div>
                                                    <div>
                                                        @if($order['is_delivered']==0)
                                                            Pending
                                                        @else
                                                            Delivered
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;">
                                    </div>
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col s12 m2">
                                                <img src="/img/{{$order['picture']}}" class="img-responsive" style="max-width:100px;"/>
                                            </div>
                                            <div class="col s12 m4">
                                                <div style="font-size: 20px;">
                                                    <span>Plan: </span><span>{{$order['plan_name']}}</span>
                                                </div>
                                                <div style="font-size: 20px;">
                                                    <span>Type: </span><span>{{$order['order_type']}}</span>
                                                </div>
                                                <div style="font-size: 20px;">
                                                    <span>Quantity: </span><span>{{$order['quantity']}}</span>
                                                </div>
                                                <div style="font-size: 20px;">
                                                    <span>Amount: </span><span>{{'PHP '.number_format($order['price'],2,'.',',')}}</span>
                                                </div>
                                            </div>
                                            <div class="col s12 m2 offset-m2">
                                                <a href="{{route('chef.order.single', $order['id'])}}" class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div id="ordDelivered">
                    <div class="row">
                        <div class="col s12 m3">
                            <div>
                                <span>Search by Interval:</span>
                            </div>
                            <select id="orderDeliverFilter">
                                <option value="1">Today</option>
                                <option value="2" selected>This Week</option>
                                <option value="3">This Month</option>
                                <option value="4">This Year</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col s12 m2">
                                <div>
                                    <span>Search By Date:</span>
                                </div>
                                {{--<select id="yearFilter"></select>--}}
                                {{--<select id="monthFilter"></select>--}}
                                {{--<select id="dayFilter"></select>--}}
                                {{--<input type="text" id="dateFilter" placeholder="Please choose a day">--}}
                                <select id="dateDeliverFilter">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="dayDeliverPick">

                    </div>
                    @foreach($orders as $order)
                        @if($order['is_delivered']==1 && $order['is_cancelled']==0)
                            <div class="card">
                                <div class="card-title" style="font-size: 18px;">
                                    <div class="row" style="margin: 0 0 20px 0; padding: 5px;">
                                        <div class="col s12 m2">
                                            <div>For Week Of</div>
                                            <div style="font-size: 22px;">{{$order['week']}}</div>
                                        </div>
                                        <div class="col s12 m3" style="font-size: 20px;">
                                            <div>
                                                <div> Ordered By:</div>
                                                <div>
                                                    @foreach($foodies as $foodie)
                                                        @if($order['foodie_id']==$foodie->id)
                                                            <span>{{$foodie->first_name.' '.$foodie->last_name}}</span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 m2" style="font-size: 20px;">
                                            <div>
                                                <div>Payment:</div>
                                                <div>
                                                    Paid
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 m2" style="font-size: 20px;">
                                            <div>
                                                <div>Order Date:</div>
                                                <div>
                                                    {{$order['created_at']}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 m2" style="font-size: 20px;">
                                            <div>
                                                <div>Delivery:</div>
                                                <div>
                                                    @if($order['is_delivered']==0)
                                                        Pending
                                                    @else
                                                        Delivered
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider" style="margin: 0 5px;">
                                </div>
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col s12 m2">
                                            <img src="/img/{{$order['picture']}}" class="img-responsive" style="max-width:100px;"/>
                                        </div>
                                        <div class="col s12 m4">
                                            <div style="font-size: 20px;">
                                                <span>Plan: </span><span>{{$order['plan_name']}}</span>
                                            </div>
                                            <div style="font-size: 20px;">
                                                <span>Type: </span><span>{{$order['order_type']}}</span>
                                            </div>
                                            <div style="font-size: 20px;">
                                                <span>Quantity: </span><span>{{$order['quantity']}}</span>
                                            </div>
                                            <div style="font-size: 20px;">
                                                <span>Amount: </span><span>{{'PHP '.number_format($order['price'],2,'.',',')}}</span>
                                            </div>
                                        </div>
                                        <div class="col s12 m2 offset-m2">
                                            <a href="{{route('chef.order.single', $order['id'])}}" class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
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
                            <div class="col s12 m2">
                                <div>
                                    <span>Search By Date:</span>
                                </div>
                                {{--<select id="yearFilter"></select>--}}
                                {{--<select id="monthFilter"></select>--}}
                                {{--<select id="dayFilter"></select>--}}
                                {{--<input type="text" id="dateFilter" placeholder="Please choose a day">--}}
                                <select id="dateCancelFilter">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="dayCancelPick">

                    </div>
                    @foreach($orders as $order)
                        @if($order['is_cancelled']==1)
                            <div class="card">
                                <div class="card-title" style="font-size: 18px;">
                                    <div class="row" style="margin: 0 0 20px 0; padding: 5px;">
                                        <div class="col s12 m2">
                                            <div>For Week Of</div>
                                            <div style="font-size: 22px;">{{$order['week']}}</div>
                                        </div>
                                        <div class="col s12 m3" style="font-size: 20px;">
                                            <div>
                                                <div> Ordered By:</div>
                                                <div>
                                                    @foreach($foodies as $foodie)
                                                        @if($order['foodie_id']==$foodie->id)
                                                            <span>{{$foodie->first_name.' '.$foodie->last_name}}</span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 m3" style="font-size: 20px;">
                                            <div>
                                                <div>Status:</div>
                                                <div>
                                                    Cancelled
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 m2" style="font-size: 20px;">
                                            <div>
                                                <div>Order Date:</div>
                                                <div>
                                                    {{$order['created_at']}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider" style="margin: 0 5px;">
                                </div>
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col s12 m2">
                                            <img src="/img/{{$order['picture']}}" class="img-responsive" style="max-width:100px;"/>
                                        </div>
                                        <div class="col s12 m4">
                                            <div style="font-size: 20px;">
                                                <span>Plan: </span><span>{{$order['plan_name']}}</span>
                                            </div>
                                            <div style="font-size: 20px;">
                                                <span>Type: </span><span>{{$order['order_type']}}</span>
                                            </div>
                                            <div style="font-size: 20px;">
                                                <span>Quantity: </span><span>{{$order['quantity']}}</span>
                                            </div>
                                            <div style="font-size: 20px;">
                                                <span>Amount: </span><span>{{'PHP '.number_format($order['price'],2,'.',',')}}</span>
                                            </div>
                                        </div>
                                        <div class="col s12 m2 offset-m2">
                                            <a href="{{route('chef.order.single', $order['id'])}}" class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

        </div>
    </div>
    @else
        No Orders Yet!
    @endif
</div>

@endsection