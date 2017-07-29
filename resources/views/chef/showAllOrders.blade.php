@extends('chef.layout')
@section('page_head')
@endsection

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
            @foreach($orders as $order)
            <div class="row">
                <div class="card">
                    <div class="card-panel">
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Plan Name</th>
                                    <th>Foodie Name</th>
                                    <th>Quantity</th>
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="orderID">{{$order->id}}</td>
                                    <td class="planName">{{$order->plan_name}}</td>
                                    @foreach($foodies as $foodie)
                                        @if($foodie->id==$order->foodie_id)
                                            <td class="foodieName">{{$foodie->first_name.' '.$foodie->last_name}}</td>
                                        @endif
                                    @endforeach
                                    <td class="quantity">{{$order->quantity}}</td>
                                    <td class="amount">{{$order->price}}</td>
                                    <td class="type">
                                        @if($order->order_type==1)
                                            <p>Customized</p>
                                        @else
                                            <p>Standard</p>
                                        @endif
                                    </td>
                                    <td class="paid">
                                        @if($order->is_cancelled==0)
                                            @if($order->is_paid==1)
                                                <p>Paid</p>
                                            @elseif($order->is_paid==0)
                                                <p>Pending</p>
                                            @endif
                                        @else
                                            <p>Cancelled</p>
                                        @endif
                                    </td>
                                    {{--<td>--}}
                                        {{--@if($order->is_paid==0)--}}
                                            {{--<p>Pending</p>--}}
                                        {{--@else--}}
                                            {{--<p>Paid</p>--}}
                                        {{--@endif--}}
                                    {{--</td>--}}
                                </tr>
                            </tbody>
                        </table>
                    @if($order->order_type==1)
                    <div>
                        <button onclick="window.location.href='{{route('chef.order.single',['order'=>$order->id])}}'" class="btn">See Customization</button>
                    </div>
                    @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        No Orders Yet!
    @endif

@endsection