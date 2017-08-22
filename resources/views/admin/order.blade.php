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
                    <a href="#">
                        <span style="margin-left: 2px;">
                            Orders
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
                    <li class="collection-item"><a href="#">Orders</a></li>
                    <li class="collection-item"><a href="#">Foodies</a></li>
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
                                        <div class="col s12 offset-m1 m2">
                                            {{--<a href="{{route('admin.plan', $order->id)}}" class="btn btn-primary waves-effect waves-light" style="font-weight: 100; width:100%;">Details</a>--}}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        <div class="row">
                            <div class="col s12 m4">
                                <ul class="collection">
                                    <li class="collection-item">{{$order->foodie->first_name.' '.$order->foodie->last_name}}</li>
                                    <li class="collection-item">{{$orderAddress}}</li>
                                    <li class="collection-item">
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
                                    <li class="collection-item">{{$order->total}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection