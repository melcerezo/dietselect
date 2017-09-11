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
        <div class="container" style="width: 85%;">
            <div class="row" style="margin-top: 1rem;">
                <nav class="light-green lighten-1 white-text">
                    <div class="left col s12">
                        <ul>
                            <li>
                                <span style="font-size: 20px;">View Orders</span>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="row">
                <div class="col s6">
                    <div id="allLinkContain" class="col s3 center"><a href="#!" class="allLink">All</a></div>
                    <div id="pendLinkContain" class="col s3 center"><a href="#!" class="pendLink">Pending</a></div>
                    <div id="paidLinkContain" class="col s3 center"><a href="#!" class="paidLink">Paid</a></div>
                    <div id="cancelLinkContain" class="col s3 center"><a href="#!" class="cancelLink">Cancelled</a></div>
                </div>
            </div>

            <div id="ordAll">
                @foreach($orders as $order)
                    @if($order['is_paid']==0 && $order['is_cancelled']==0)
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
                                </div>
                            </div>
                            <div class="divider" style="margin: 0 5px;">
                            </div>
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s12 m2">
                                        <img src="/img/{{$order['picture']}}" class="img-responsive" style="max-width:100px;"/>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Plan:</div><div>{{$order['plan_name']}}</div>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Type:</div><div>{{$order['order_type']}}</div>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Quantity:</div><div>{{$order['quantity']}}</div>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Amount:</div><div>{{$order['price']}}</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m2">
                                        <a href="{{route('chef.order.single', $order['id'])}}" class="btn btn-primary waves-effect waves-light" style="font-weight: 100;">Details</a>
                                    </div>
                                    {{--<div class="col s12 m2">--}}
                                    {{--<button data-target="cancelAllModal{{$order->id}}" class="btn btn-primary waves-effect waves-light red modal-trigger" style="font-weight: 100;">Cancel</button>--}}
                                    {{--</div>--}}
                                </div>
                                {{--<div id="cancelAllModal{{$order->id}}" class="modal">--}}
                                {{--<div class="modal-content">--}}
                                {{--<form action="{{route('foodie.orderAll.cancel', $order->id)}}" method="post">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--<button class="btn waves-effect waves-light">Cancel Order?</button>--}}
                                {{--</form>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    @elseif($order['is_paid']==1 && $order['is_cancelled']==0)
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
                                </div>
                            </div>
                            <div class="divider" style="margin: 0 5px;">
                            </div>
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s12 m2">
                                        <img src="/img/{{$order['picture']}}" class="img-responsive" style="max-width:100px;"/>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Plan:</div><div>{{$order['plan_name']}}</div>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Type:</div><div>{{$order['order_type']}}</div>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Quantity:</div><div>{{$order['quantity']}}</div>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Amount:</div><div>{{$order['price']}}</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m2">
                                        <a href="{{route('chef.order.single', $order['id'])}}" class="btn btn-primary waves-effect waves-light" style="font-weight: 100;">Details</a>
                                    </div>
                                    {{--<div class="col s12 m2">--}}
                                    {{--<button data-target="cancelAllModal{{$order->id}}" class="btn btn-primary waves-effect waves-light red modal-trigger" style="font-weight: 100;">Cancel</button>--}}
                                    {{--</div>--}}
                                </div>
                                {{--<div id="cancelAllModal{{$order->id}}" class="modal">--}}
                                {{--<div class="modal-content">--}}
                                {{--<form action="{{route('foodie.orderAll.cancel', $order->id)}}" method="post">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--<button class="btn waves-effect waves-light">Cancel Order?</button>--}}
                                {{--</form>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div id="ordPend">
                @foreach($orders as $order)
                    @if($order['is_paid']==0 && $order['is_cancelled']==0)
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
                                </div>
                            </div>
                            <div class="divider" style="margin: 0 5px;">
                            </div>
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s12 m2">
                                        <img src="/img/{{$order['picture']}}" class="img-responsive" style="max-width:100px;"/>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Plan:</div><div>{{$order['plan_name']}}</div>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Type:</div><div>{{$order['order_type']}}</div>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Quantity:</div><div>{{$order['quantity']}}</div>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Amount:</div><div>{{$order['price']}}</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m2">
                                        <a href="{{route('chef.order.single', $order['id'])}}" class="btn btn-primary waves-effect waves-light" style="font-weight: 100;">Details</a>
                                    </div>
                                    {{--<div class="col s12 m2">--}}
                                    {{--<button data-target="cancelAllModal{{$order->id}}" class="btn btn-primary waves-effect waves-light red modal-trigger" style="font-weight: 100;">Cancel</button>--}}
                                    {{--</div>--}}
                                </div>
                                {{--<div id="cancelAllModal{{$order->id}}" class="modal">--}}
                                {{--<div class="modal-content">--}}
                                {{--<form action="{{route('foodie.orderAll.cancel', $order->id)}}" method="post">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--<button class="btn waves-effect waves-light">Cancel Order?</button>--}}
                                {{--</form>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div id="ordPaid">
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
                                </div>
                            </div>
                            <div class="divider" style="margin: 0 5px;">
                            </div>
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s12 m2">
                                        <img src="/img/{{$order['picture']}}" class="img-responsive" style="max-width:100px;"/>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Plan:</div><div>{{$order['plan_name']}}</div>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Type:</div><div>{{$order['order_type']}}</div>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Quantity:</div><div>{{$order['quantity']}}</div>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Amount:</div><div>{{$order['price']}}</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m2">
                                        <a href="{{route('chef.order.single', $order['id'])}}" class="btn btn-primary waves-effect waves-light" style="font-weight: 100;">Details</a>
                                    </div>
                                    {{--<div class="col s12 m2">--}}
                                    {{--<button data-target="cancelAllModal{{$order->id}}" class="btn btn-primary waves-effect waves-light red modal-trigger" style="font-weight: 100;">Cancel</button>--}}
                                    {{--</div>--}}
                                </div>
                                {{--<div id="cancelAllModal{{$order->id}}" class="modal">--}}
                                {{--<div class="modal-content">--}}
                                {{--<form action="{{route('foodie.orderAll.cancel', $order->id)}}" method="post">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--<button class="btn waves-effect waves-light">Cancel Order?</button>--}}
                                {{--</form>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div id="ordCancel">
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
                                </div>
                            </div>
                            <div class="divider" style="margin: 0 5px;">
                            </div>
                            <div class="card-content">
                                <div class="row">
                                    <div class="col s12 m2">
                                        <img src="/img/{{$order['picture']}}" class="img-responsive" style="max-width:100px;"/>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Plan:</div><div>{{$order['plan_name']}}</div>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Type:</div><div>{{$order['order_type']}}</div>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Quantity:</div><div>{{$order['quantity']}}</div>
                                    </div>
                                    <div class="col s12 m2" style="font-size: 20px;">
                                        <div>Amount:</div><div>{{$order['price']}}</div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col s12 m2">
                                        <a href="{{route('chef.order.single', $order['id'])}}" class="btn btn-primary waves-effect waves-light" style="font-weight: 100;">Details</a>
                                    </div>
                                    {{--<div class="col s12 m2">--}}
                                    {{--<button data-target="cancelAllModal{{$order->id}}" class="btn btn-primary waves-effect waves-light red modal-trigger" style="font-weight: 100;">Cancel</button>--}}
                                    {{--</div>--}}
                                </div>
                                {{--<div id="cancelAllModal{{$order->id}}" class="modal">--}}
                                {{--<div class="modal-content">--}}
                                {{--<form action="{{route('foodie.orderAll.cancel', $order->id)}}" method="post">--}}
                                {{--{{ csrf_field() }}--}}
                                {{--<button class="btn waves-effect waves-light">Cancel Order?</button>--}}
                                {{--</form>--}}
                                {{--</div>--}}
                                {{--</div>--}}
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            {{--@foreach($orders as $order)--}}
                {{--@if($order['is_cancelled']==0)--}}
                    {{--<div class="row">--}}
                        {{--<div class="card">--}}
                            {{--<div class="card-panel">--}}
                                {{--<a href="{{route('chef.order.single', $order['id'])}}">--}}
                                    {{--<table class="responsive-table centered" style="table-layout: fixed;">--}}
                                        {{--<thead>--}}
                                            {{--<tr>--}}
                                                {{--<th>ID</th>--}}
                                                {{--<th>Plan Name</th>--}}
                                                {{--<th>Foodie Name</th>--}}
                                                {{--<th>Quantity</th>--}}
                                                {{--<th>Amount</th>--}}
                                                {{--<th>Type</th>--}}
                                                {{--<th>Payment Status</th>--}}
                                            {{--</tr>--}}
                                        {{--</thead>--}}
                                        {{--<tbody>--}}
                                            {{--<tr>--}}
                                                {{--<td class="orderID">{{$order['id']}}</td>--}}
                                                {{--<td class="planName">{{$order['plan_name']}}</td>--}}
                                                {{--@foreach($foodies as $foodie)--}}
                                                    {{--@if($foodie->id==$order['foodie_id'])--}}
                                                        {{--<td class="foodieName">{{$foodie->first_name.' '.$foodie->last_name}}</td>--}}
                                                    {{--@endif--}}
                                                {{--@endforeach--}}
                                                {{--<td class="quantity">{{$order['quantity']}}</td>--}}
                                                {{--<td class="amount">{{$order['price']}}</td>--}}
                                                {{--<td class="type">--}}
                                                    {{--<p>--}}
                                                        {{--@if($order['order_type']==0)--}}
                                                            {{--<span>Standard</span>--}}
                                                        {{--@elseif($order['order_type']==1 || $order['order_type']==2)--}}
                                                            {{--<span>Customized</span>--}}
                                                        {{--@endif--}}
                                                    {{--</p>--}}
                                                {{--</td>--}}
                                                {{--<td class="paid">--}}
                                                    {{--@if($order['is_cancelled']==0)--}}
                                                        {{--@if($order['is_paid']==1)--}}
                                                            {{--<p>Paid</p>--}}
                                                        {{--@elseif($order['is_paid']==0)--}}
                                                            {{--<p>Pending</p>--}}
                                                        {{--@endif--}}
                                                    {{--@else--}}
                                                        {{--<p>Cancelled</p>--}}
                                                    {{--@endif--}}
                                                {{--</td>--}}
                                                {{--<td>--}}
                                                    {{--@if($order->is_paid==0)--}}
                                                        {{--<p>Pending</p>--}}
                                                    {{--@else--}}
                                                        {{--<p>Paid</p>--}}
                                                    {{--@endif--}}
                                                {{--</td>--}}
                                            {{--</tr>--}}
                                        {{--</tbody>--}}
                                    {{--</table>--}}
                                {{--</a>--}}
                            {{--@if($order['is_paid']==1)--}}
                            {{--<div>--}}
                                {{--<button onclick="window.location.href='{{route('chef.order.single',['order'=>$order['id']])}}'" class="btn">See Plan</button>--}}
                            {{--</div>--}}
                            {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endif--}}
            {{--@endforeach--}}
        </div>
    @else
        No Orders Yet!
    @endif

@endsection