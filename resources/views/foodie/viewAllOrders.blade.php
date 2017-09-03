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
    @if($ordersCount>0)
    <div class="row">
        <div class="col s6">
            <div id="allLinkContain" class="col s3 center"><a href="#!" class="allLink">All</a></div>
            <div id="pendLinkContain" class="col s3 center"><a href="#!" class="pendLink">Pending</a></div>
            <div id="paidLinkContain" class="col s3 center"><a href="#!" class="paidLink">Paid</a></div>
            <div id="cancelLinkContain" class="col s3 center"><a href="#!" class="cancelLink">Cancelled</a></div>

        </div>
        {{--<div class="row" >--}}
            {{--<div class="col s12" style="margin-top: 6px;">--}}
                {{--<div class="divider"></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
    <div id="ordAll">
        @foreach($orders as $order)
            @if($order->is_paid==0 && $order->is_cancelled==0)
                    <div class="card">
                        @foreach($orderArray as $orderItem)
                            @if($orderItem['id'] == $order->id)
                        <div class="card-title" style="font-size: 18px;">
                            <div class="row light-green lighten-1 white-text" style="margin: 0 0 20px 0; padding: 5px;">
                                <div class="col s12 m1">
                                    <div>ID</div>
                                    <div style="font-size: 22px;">{{$orderItem['id']}}</div>
                                </div>
                                <div class="col s12 m2">
                                    <div>For Week Of</div>
                                    <div style="font-size: 22px;">{{$orderItem['week']}}</div>
                                </div>
                                <div class="col s12 m2">
                                    <div>Total</div>
                                    <div style="font-size: 22px;">{{'PHP'.$orderItem['total']}}</div>
                                </div>
                                <div class="col s12 m4">
                                    <div>Address</div>
                                    <div style="font-size: 22px;">{{$orderItem['address']}}</div>
                                </div>
                                <div class="col s12 m3">
                                    <div>Status</div>
                                    <div style="font-size: 22px;">{{$orderItem['is_paid']}}</div>
                                </div>
                            </div>
                        </div>
                            @endif
                        @endforeach
                        <div class="card-content">
                            @foreach($orderItemArray as $orderItemItem)
                                @if($orderItemItem['order_id']==$order->id)
                            <div class="row">
                                <div class="col s12 m3">
                                    <img src="/img/{{$orderItemItem['planPic']}}" class="img-responsive" style="max-width:150px;"/>
                                </div>
                                <div class="col s12 m4" style="font-size: 20px;">
                                    <div>{{$orderItemItem['plan']}}</div>
                                    <div>Made By: {{$orderItemItem['chef']}}</div>
                                    <div>Type:  {{$orderItemItem['type']}}</div>
                                    <div>Quantity: {{$orderItemItem['quantity']}}</div>
                                    <div>Amount: {{$orderItemItem['price']}}</div>
                                </div>
                                <div class="col s12 offset-m2 m2">
                                    <div>
                                        <a href="{{route('foodie.order.single', $orderItemItem['id'])}}" class="btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                        <div class="row">
                            <div class="col s12">
                                <a href="{{route('order.show', $order->id)}}" class="btn btn-primary waves-effect waves-light" style="font-weight: 100;">Pay</a>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($order->is_paid==1 && $order->is_cancelled==0)
                <div class="card">
                    @foreach($orderArray as $orderItem)
                        @if($orderItem['id'] == $order->id)
                            <div class="card-title" style="font-size: 18px;">
                                <div class="row light-green lighten-1 white-text" style="margin: 0 0 20px 0; padding: 5px;">
                                    <div class="col s12 m1">
                                        <div>ID</div>
                                        <div style="font-size: 22px;">{{$orderItem['id']}}</div>
                                    </div>
                                    <div class="col s12 m2">
                                        <div>For Week Of</div>
                                        <div style="font-size: 22px;">{{$orderItem['week']}}</div>
                                    </div>
                                    <div class="col s12 m2">
                                        <div>Total</div>
                                        <div style="font-size: 22px;">{{'PHP'.$orderItem['total']}}</div>
                                    </div>
                                    <div class="col s12 m4">
                                        <div>Address</div>
                                        <div style="font-size: 22px;">{{$orderItem['address']}}</div>
                                    </div>
                                    <div class="col s12 m3">
                                        <div>Status</div>
                                        <div style="font-size: 22px;">{{$orderItem['is_paid']}}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    <div class="card-content">
                        @foreach($orderItemArray as $orderItemItem)
                            @if($orderItemItem['order_id']==$order->id)
                                <div class="row">
                                    <div class="col s12 m3">
                                        <img src="/img/{{$orderItemItem['planPic']}}" class="img-responsive" style="max-width:150px;"/>
                                    </div>
                                    <div class="col s12 m4" style="font-size: 20px;">
                                        <div>{{$orderItemItem['plan']}}</div>
                                        <div>Made By: {{$orderItemItem['chef']}}</div>
                                        <div>Type:  {{$orderItemItem['type']}}</div>
                                        <div>Quantity: {{$orderItemItem['quantity']}}</div>
                                        <div>Amount: {{$orderItemItem['price']}}</div>
                                    </div>
                                    <div class="col s12 offset-m2 m2">
                                        <a href="{{route('foodie.order.single', $orderItemItem['id'])}}" class="btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div id="ordPend">
        @if($pendOrdCount>0)
            @foreach($orders as $order)
                @if($order->is_paid==0 && $order->is_cancelled==0)
                    <div class="card">
                        @foreach($orderArray as $orderItem)
                            @if($orderItem['id'] == $order->id)
                                <div class="card-title" style="font-size: 18px;">
                                    <div class="row light-green lighten-1 white-text" style="margin: 0 0 20px 0; padding: 5px;">
                                        <div class="col s12 m1">
                                            <div>ID</div>
                                            <div style="font-size: 22px;">{{$orderItem['id']}}</div>
                                        </div>
                                        <div class="col s12 m2">
                                            <div>For Week Of</div>
                                            <div style="font-size: 22px;">{{$orderItem['week']}}</div>
                                        </div>
                                        <div class="col s12 m2">
                                            <div>Total</div>
                                            <div style="font-size: 22px;">{{'PHP'.$orderItem['total']}}</div>
                                        </div>
                                        <div class="col s12 m4">
                                            <div>Address</div>
                                            <div style="font-size: 22px;">{{$orderItem['address']}}</div>
                                        </div>
                                        <div class="col s12 m3">
                                            <div>Status</div>
                                            <div style="font-size: 22px;">{{$orderItem['is_paid']}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="card-content">
                            @foreach($orderItemArray as $orderItemItem)
                                @if($orderItemItem['order_id']==$order->id)
                                    <div class="row">
                                        <div class="col s12 m3">
                                            <img src="/img/{{$orderItemItem['planPic']}}" class="img-responsive" style="max-width:150px;"/>
                                        </div>
                                        <div class="col s12 m4" style="font-size: 20px;">
                                            <div>{{$orderItemItem['plan']}}</div>
                                            <div>Made By: {{$orderItemItem['chef']}}</div>
                                            <div>Type:  {{$orderItemItem['type']}}</div>
                                            <div>Quantity: {{$orderItemItem['quantity']}}</div>
                                            <div>Amount: {{$orderItemItem['price']}}</div>
                                        </div>
                                        <div class="col s12 offset-m2 m2">
                                            <a href="{{route('foodie.order.single', $orderItemItem['id'])}}" class="btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="row">
                                <div class="col s12">
                                    <a href="{{route('order.show', $order->id)}}" class="btn btn-primary waves-effect waves-light" style="font-weight: 100;">Pay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @else
            No Pending Orders
        @endif
    </div>
    <div id="ordPaid">
        @if($paidOrdCount>0)
            @foreach($orders as $order)
                @if($order->is_paid==1 && $order->is_cancelled==0)
                        <div class="card">
                            @foreach($orderArray as $orderItem)
                                @if($orderItem['id'] == $order->id)
                                    <div class="card-title" style="font-size: 18px;">
                                        <div class="row light-green lighten-1 white-text" style="margin: 0 0 20px 0; padding: 5px;">
                                            <div class="col s12 m1">
                                                <div>ID</div>
                                                <div style="font-size: 22px;">{{$orderItem['id']}}</div>
                                            </div>
                                            <div class="col s12 m2">
                                                <div>For Week Of</div>
                                                <div style="font-size: 22px;">{{$orderItem['week']}}</div>
                                            </div>
                                            <div class="col s12 m2">
                                                <div>Total</div>
                                                <div style="font-size: 22px;">{{'PHP'.$orderItem['total']}}</div>
                                            </div>
                                            <div class="col s12 m4">
                                                <div>Address</div>
                                                <div style="font-size: 22px;">{{$orderItem['address']}}</div>
                                            </div>
                                            <div class="col s12 m3">
                                                <div>Status</div>
                                                <div style="font-size: 22px;">{{$orderItem['is_paid']}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                                <div class="card-content">
                                    @foreach($orderItemArray as $orderItemItem)
                                        @if($orderItemItem['order_id']==$order->id)
                                    <div class="row">
                                        <div class="col s12 m3">
                                            <img src="/img/{{$orderItemItem['planPic']}}" class="img-responsive" style="max-width:150px;"/>
                                        </div>
                                        <div class="col s12 m4" style="font-size: 20px;">
                                            <div>{{$orderItemItem['plan']}}</div>
                                            <div>Made By: {{$orderItemItem['chef']}}</div>
                                            <div>Type:  {{$orderItemItem['type']}}</div>
                                            <div>Quantity: {{$orderItemItem['quantity']}}</div>
                                            <div>Amount: {{$orderItemItem['price']}}</div>
                                        </div>
                                        <div class="col s12 offset-m2 m2">
                                            <a href="{{route('foodie.order.single', $orderItemItem['id'])}}" class="btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                                </div>
                        </div>

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
                @endif
            @endforeach
        @else
            No Paid Orders
        @endif
        </div>
        <div id="ordCancel">
            @if($cancelOrdCount)
            @foreach($orders as $order)
                @if($order->is_cancelled==1)
                        <div class="card">
                            @foreach($orderArray as $orderItem)
                                @if($orderItem['id'] == $order->id)
                                    <div class="card-title" style="font-size: 18px;">
                                        <div class="row light-green lighten-1 white-text" style="margin: 0 0 20px 0; padding: 5px;">
                                            <div class="col s12 m1">
                                                <div>ID</div>
                                                <div style="font-size: 22px;">{{$orderItem['id']}}</div>
                                            </div>
                                            <div class="col s12 m2">
                                                <div>For Week Of</div>
                                                <div style="font-size: 22px;">{{$orderItem['week']}}</div>
                                            </div>
                                            <div class="col s12 m2">
                                                <div>Total</div>
                                                <div style="font-size: 22px;">{{'PHP'.$orderItem['total']}}</div>
                                            </div>
                                            <div class="col s12 m4">
                                                <div>Address</div>
                                                <div style="font-size: 22px;">{{$orderItem['address']}}</div>
                                            </div>
                                            <div class="col s12 m3">
                                                <div>Status</div>
                                                <div style="font-size: 22px;">Cancelled</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="card-content">
                                @foreach($orderItemArray as $orderItemItem)
                                    @if($orderItemItem['order_id']==$order->id)
                                        <div class="row">
                                            <div class="col s12 m3">
                                                <img src="/img/{{$orderItemItem['planPic']}}" class="img-responsive" style="max-width:150px;"/>
                                            </div>
                                            <div class="col s12 m4" style="font-size: 20px;">
                                                <div>{{$orderItemItem['plan']}}</div>
                                                <div>Made By: {{$orderItemItem['chef']}}</div>
                                                <div>Type:  {{$orderItemItem['type']}}</div>
                                                <div>Quantity: {{$orderItemItem['quantity']}}</div>
                                                <div>Amount: {{$orderItemItem['price']}}</div>
                                            </div>
                                            <div class="col s12 offset-m2 m2">
                                                <a href="{{route('foodie.order.single', $orderItemItem['id'])}}" class="btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                @endif
            @endforeach
        @else
            No Cancelled Orders
        @endif
    </div>
@else
    No Orders Yet!
@endif
</div>




@endsection