@extends('foodie.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/foodie/orderAll.css">
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
            <div id="allLinkContain" class="col s4 center"><a href="#!" class="allLink">All</a></div>
            <div id="pendLinkContain" class="col s4 center"><a href="#!" class="pendLink">Pending</a></div>
            <div id="paidLinkContain" class="col s4 center"><a href="#!" class="paidLink">Paid</a></div>
        </div>
        {{--<div class="row" >--}}
            {{--<div class="col s12" style="margin-top: 6px;">--}}
                {{--<div class="divider"></div>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
    <div id="ordAll">
        @foreach($orders as $order)
            @if($order->is_paid==0)
                <a href="{{route('order.show', $order->id)}}">
                    <div class="row">
                        <div class="card">
                            <div class="card-panel">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Plan Name</th>
                                        <th>Chef Name</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Payment Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="orderID">{{$order->id}}</td>
                                        <td class="planName">{{$order->plan->plan_name}}</td>
                                        <td class="chefName">{{$order->chef->name}}</td>
                                        <td class="amount">{{$order->plan->price}}</td>
                                        <td class="type">
                                            @if($order->order_type=='c')
                                                <p>Customized</p>
                                            @else
                                                <p>Standard</p>
                                            @endif
                                        </td>
                                        <td>
                                            <p>Pending</p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                {{--@if($order->order_type=='c')--}}
                                    {{--<div>--}}
                                        {{--<button onclick="window.location.href='{{route('foodie.cust.single',['order'=>$order->id])}}'" class="btn">See Customization</button>--}}
                                    {{--</div>--}}
                                {{--@endif--}}
                            </div>
                        </div>
                    </div>
                </a>
            @else
                <a href="#!">
                    <div class="row">
                        <div class="card">
                            <div class="card-panel">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Plan Name</th>
                                        <th>Chef Name</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Payment Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="orderID">{{$order->id}}</td>
                                        <td class="planName">{{$order->plan->plan_name}}</td>
                                        <td class="chefName">{{$order->chef->name}}</td>
                                        <td class="amount">{{$order->plan->price}}</td>
                                        <td class="type">
                                            @if($order->order_type=='c')
                                                <p>Customized</p>
                                            @else
                                                <p>Standard</p>
                                            @endif
                                        </td>
                                        <td>
                                            <p>Paid</p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                {{--@if($order->order_type=='c')--}}
                                    {{--<div>--}}
                                        {{--<button onclick="window.location.href='{{route('foodie.order.single',['order'=>$order->id])}}'" class="btn">See Customization</button>--}}
                                    {{--</div>--}}
                                {{--@endif--}}
                            </div>
                        </div>
                    </div>
                </a>
            @endif
        @endforeach
    </div>
    <div id="ordPend">
        @foreach($orders as $order)
            @if($order->is_paid==0)
                <a href="{{route('order.show', $order->id)}}">
                    <div class="row">
                        <div class="card">
                            <div class="card-panel">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Plan Name</th>
                                        <th>Chef Name</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                        <th>Payment Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="orderID">{{$order->id}}</td>
                                        <td class="planName">{{$order->plan->plan_name}}</td>
                                        <td class="chefName">{{$order->chef->name}}</td>
                                        <td class="amount">{{$order->plan->price}}</td>
                                        <td class="type">
                                            @if($order->order_type=='c')
                                                <p>Customized</p>
                                            @else
                                                <p>Standard</p>
                                            @endif
                                        </td>
                                        <td>
                                            <p>Pending</p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </a>
            @endif
        @endforeach
    </div>
    <div id="ordPaid">
            @foreach($orders as $order)
                @if($order->is_paid==1)
                    <a href="{{route('order.show', $order->id)}}">
                        <div class="row">
                            <div class="card">
                                <div class="card-panel">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Plan Name</th>
                                            <th>Chef Name</th>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Payment Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="orderID">{{$order->id}}</td>
                                            <td class="planName">{{$order->plan->plan_name}}</td>
                                            <td class="chefName">{{$order->chef->name}}</td>
                                            <td class="amount">{{$order->plan->price}}</td>
                                            <td class="type">
                                                @if($order->order_type=='c')
                                                    <p>Customized</p>
                                                @else
                                                    <p>Standard</p>
                                                @endif
                                            </td>
                                            <td>
                                                <p>Paid</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
        </div>
@else
    No Orders Yet!
@endif
</div>




@endsection