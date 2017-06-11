@extends('foodie.layout')
@section('page_head')
@endsection

@section('page_content')

    @if($ordersCount>0)
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
                                    @if($order->order_type=='c')
                                        <div>
                                            <button onclick="window.location.href='{{route('foodie.order.single',['order'=>$order->id])}}'" class="btn">See Customization</button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
        </div>
    @else
        No Orders Yet!
    @endif

@endsection