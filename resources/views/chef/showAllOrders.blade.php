@extends('chef.layout')
@section('page_head')
@endsection

@section('page_content')

    @if($orders->count())
        <div class="container">
            <div class="row">
                <h2 class="center white-text">View Orders</h2>
                <span class="center full-width white-text" style="font-size: 1.5em">See who has ordered from you!</span>
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
                                    <th>Amount</th>
                                    <th>Type</th>
                                    <th>Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="orderID">{{$order->id}}</td>
                                    <td class="planName">{{$order->plan->plan_name}}</td>
                                    <td class="foodieName">{{$order->foodie->first_name.' '.$order->foodie->last_name}}</td>
                                    <td class="amount">{{$order->plan->price}}</td>
                                    <td class="type">
                                        @if($order->order_type=='c')
                                            <p>Customized</p>
                                        @else
                                            <p>Standard</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if($order->is_paid==0)
                                            <p>Pending</p>
                                        @else
                                            <p>Paid</p>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @if($order->order_type=='c')
                    <div>
                        <button onclick="window.location.href='{{route('chef.order.single',['order'=>$order->id])}}'" class="btn">See Customization</button>
                    </div>
                    @endif
                    </div>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    @else
        No Orders Yet!
    @endif

@endsection