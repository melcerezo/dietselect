@extends("layouts.app")
@section('head')
    <script src="/js/admin/admin.js" defer></script>
@endsection

@section('content')
    <nav>
        <div class="nav-wrapper light-green lighten-1">
            <div style="margin-left: 10px;">
                <a href="{{route("admin.dashboard")}}" class="brand-logo">Admin Panel</a>
            </div>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li>
                    <a href="{{route("admin.dashboard")}}">
                        <span class="valign-wrapper" style="position: relative;">
                            <span style="margin-left: 2px;">
                                Dashboard
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{route("admin.commissions")}}">
                        <span class="valign-wrapper" style="position: relative;">
                            <span style="margin-left: 2px;">
                                Commissions
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.foodies')}}">
                        <span class="valign-wrapper">
                            <span style="margin-left: 2px;">
                                Foodies
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.chefs')}}">
                        <span class="valign-wrapper">
                            <span style="margin-left: 2px;">
                                Chefs
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.orders')}}">
                        <span style="margin-left: 2px;">
                            Orders
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.adminRefund')}}">
                        <span style="margin-left: 2px;">
                            Refunds
                        </span>
                    </a>
                </li>
                <li>
                    <form id="logout" method="post" action="{{ route('admin.logout') }}">
                        {{ csrf_field() }}
                        <a id="logout-link" class="nvItLnk" href="#">
                            {{--<i class="fa fa-sign-out" aria-hidden="true"></i>--}}
                            <span class="hide-on-med-and-down">Logout</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" style="width: 85%;">
        <div class="row">
            <div class="col s12 m2">
                <ul class="collection">
                    <li class="collection-item light-green lighten-1 white-text">
                        <span class="collection-header">
                            Admin
                        </span>
                    </li>
                    <li class="collection-item"><a href="{{route('admin.commissions')}}">Commissions</a></li>
                    <li class="collection-item"><a href="{{route('admin.adminRefund')}}">Refunds</a></li>
                    <li class="collection-item"><a href="{{route('admin.orders')}}">Orders</a></li>
                    <li class="collection-item"><a href="{{route('admin.foodies')}}">Foodies</a></li>
                    <li class="collection-item"><a href="{{route('admin.chefs')}}">Chefs</a></li>
                </ul>
            </div>
            <div class="col s12 m10">
                <div class="card">
                    <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                        <div>
                            <span>
                                Order: {{$order->id}}
                            </span>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12 l8">
                                <div class="card-panel" style="padding: 0;">
                                    <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                                        <div>
                                            <span>
                                                Order Items
                                            </span>
                                        </div>
                                    </div>
                                    @foreach($orderItemArray as $orderItemItem)
                                        @if($orderItemItem['order_id']==$order->id)
                                            <div class="row">
                                                <div class="col s12 l4">
                                                    <img src="/img/{{$orderItemItem['planPic']}}" class="img-responsive" style="max-width:150px;"/>
                                                </div>
                                                <div class="col s12 l6" style="font-size: 20px;">
                                                    <div>{{$orderItemItem['plan']}}</div>
                                                    <div>Made By: {{$orderItemItem['chef']}}</div>
                                                    <div>Type:  {{$orderItemItem['type']}}</div>
                                                    <div>Quantity: {{$orderItemItem['quantity']}}</div>
                                                    <div>Amount: {{$orderItemItem['price']}}</div>
                                                    <div>
                                                        @if($orderItemItem['is_cancelled']==0)
                                                            @if($orderItemItem['is_delivered']==0)
                                                                <span>Delivery: Pending</span>
                                                            @elseif($orderItemItem['is_delivered']==1)
                                                                <span>Delivery: Delivered</span>
                                                            @endif
                                                        @elseif($orderItemItem['is_cancelled']==1)
                                                            <span>Cancelled</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                {{--<div class="col s12 l3">--}}
                                                    {{--<div style="padding: 10px">--}}
                                                        {{--<a href="{{route('admin.plan', $order->id)}}" class="btn waves-effect waves-light valign" style="font-weight: 100; padd">Details</a>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12 m6">
                                <ul class="collection">
                                    <li class="collection-item grey lighten-3">
                                        <div class="collection-header">Pending Order</div>
                                    </li>
                                    <li class="collection-item">Ordered By: {{$order->foodie->first_name.' '.$order->foodie->last_name}}</li>
                                    <li class="collection-item">Address: {{$orderAddress}}</li>
                                    <li class="collection-item">Payment:
                                        @if($order->is_cancelled==0)
                                            @if($order->is_paid==0)
                                                <span>Pending</span>
                                            @elseif($order->is_paid==1)
                                                <span>Paid</span>
                                            @endif
                                        @elseif($order->is_cancelled==1)
                                            <span>Cancelled</span>
                                        @endif
                                    </li>
                                    <li class="collection-item">Total: {{'PHP '.number_format($order->total, 2, '.', ',')}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col offset-m2 s12 m3">
                <button data-target="cancelModal" class="btn waves-effect waves-light modal-trigger">Cancel</button>
            </div>
        </div>
    </div>
    <div id="cancelModal" class="modal">
        <div class="modal-content">
            <a href="{{route('admin.order.cancel', $order->id)}}" class="btn waves-effect waves-light" style="font-weight: 100;">Cancel Order?</a>
        </div>
    </div>



@endsection