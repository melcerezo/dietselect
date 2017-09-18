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
                <div class="col offset-m2 s6">
                    <div id="allLinkContain" class="col s3 center"><a href="#!" class="allLink">All</a></div>
                    <div id="pendLinkContain" class="col s3 center"><a href="#!" class="pendLink">Pending</a></div>
                    <div id="paidLinkContain" class="col s3 center"><a href="#!" class="paidLink">Paid</a></div>
                    <div id="cancelLinkContain" class="col s3 center"><a href="#!" class="cancelLink">Cancelled</a></div>
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
                </div>
            <div class="col s12 m10">
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
                                        <div class="col s12 m3" style="font-size: 20px;">
                                            <div>
                                                <div>Status:</div>
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
                                        </div>
                                        <div style="font-size: 20px;">
                                            <span>Plan:</span><span>{{$order['plan_name']}}</span>
                                        </div>
                                        <div style="font-size: 20px;">
                                            <span>Type:</span><span>{{$order['order_type']}}</span>
                                        </div>
                                        <div style="font-size: 20px;">
                                            <span>Quantity:</span><span>{{$order['quantity']}}</span>
                                        </div>
                                        <div style="font-size: 20px;">
                                            <span>Amount:</span><span>{{'PHP '.number_format($order['price'],2,'.',',')}}</span>
                                        </div>
                                        <div class="col s12 m2 offset-m2">
                                            <a href="{{route('chef.order.single', $order['id'])}}" class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Details</a>
                                        </div>
                                    </div>
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
                                        <div class="col s12 m3" style="font-size: 20px;">
                                            <div>
                                                <div>Status:</div>
                                                <div>
                                                    Paid
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
                                        </div>
                                        <div style="font-size: 20px;">
                                            <span>Plan:</span><span>{{$order['plan_name']}}</span>
                                        </div>
                                        <div style="font-size: 20px;">
                                            <span>Type:</span><span>{{$order['order_type']}}</span>
                                        </div>
                                        <div style="font-size: 20px;">
                                            <span>Quantity:</span><span>{{$order['quantity']}}</span>
                                        </div>
                                        <div style="font-size: 20px;">
                                            <span>Amount:</span><span>{{'PHP '.number_format($order['price'],2,'.',',')}}</span>
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
                                        <div class="col s12 m3" style="font-size: 20px;">
                                            <div>
                                                <div>Status:</div>
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
                                            <div>Amount:</div><div>{{'PHP '.number_format($order['price'],2,'.',',')}}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m2">
                                            <a href="{{route('chef.order.single', $order['id'])}}" class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Details</a>
                                        </div>
                                    </div>
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
                                        <div class="col s12 m3" style="font-size: 20px;">
                                            <div>
                                                <div>Status:</div>
                                                <div>
                                                    Paid
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
                                            <div>Amount:</div><div>{{'PHP '.number_format($order['price'],2,'.',',')}}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m2">
                                            <a href="{{route('chef.order.single', $order['id'])}}" class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Details</a>
                                        </div>
                                        {{--<div class="col s12 m2">--}}
                                        {{--<button data-target="cancelAllModal{{$order->id}}" class="btn btn-primary waves-effect waves-light red modal-trigger" style="font-weight: 100;">Cancel</button>--}}
                                        {{--</div>--}}
                                    </div>
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
                                        <div class="col s12 m3" style="font-size: 20px;">
                                            <div>
                                                <div>Status:</div>
                                                <div>
                                                    Cancelled
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
                                            <div>Amount:</div><div>{{'PHP '.number_format($order['price'],2,'.',',')}}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m2">
                                            <a href="{{route('chef.order.single', $order['id'])}}" class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">Details</a>
                                        </div>
                                        {{--<div class="col s12 m2">--}}
                                        {{--<button data-target="cancelAllModal{{$order->id}}" class="btn btn-primary waves-effect waves-light red modal-trigger" style="font-weight: 100;">Cancel</button>--}}
                                        {{--</div>--}}
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

@endsection