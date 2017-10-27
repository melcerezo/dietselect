@extends('chef.layout')
@section('page_head')
    <title>App - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="/css/chef/chefDash.css">
    <script src="/js/chef/chefDash.js" defer></script>
@endsection

@section('page_content')
    <div class="container dshMnCnt">
        <div class="row">
            <div class="col s12 m6 l2">
                <div class="row">
                    <div>
                        ACCOUNT DASHBOARD
                    </div>
                </div>
                <div class="divider"></div>
                <ul class="collection">
                    <li class="collection-item">
                        <a href="{{route("chef.order.view", ['id'=> 0])}}">Orders</a>
                    </li>
                    <li class="collection-item">
                        <a href="{{route("chef.getCommissions)}}">Commissions</a>
                    </li>
                    <li class="collection-item">
                        <a href="{{route('chef.plan')}}">View Your Plans</a>
                    </li>
                    <li class="collection-item">
                        <a href="{{route('chef.profile')}}">Profile</a>
                    </li>
                    <li class="collection-item">
                        <a href="{{route('chef.message.index')}}">Messages</a>
                        {{--@if($messages->count()>0)--}}
                            {{--<span class="new badge red">{{$messages->count()}}</span>--}}
                        {{--@endif--}}
                    </li>
                    <li class="collection-item">
                        <a href="{{route('chef.ratings')}}">Ratings</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m6 l3">
                <div class="card">
                    <div class="card-image dshPrfCrdCnt">
                        @if($chef->cover==null)
                            <a id="coverLinkPhoto" href="#addCover" class="modal-trigger">
                                <span class="fa fa-camera grey-text lighten-3" style="position: absolute; top:12px; left: 0; display: block; font-size: 8em; margin: 0.15em auto; width: 100%; text-align: center;"></span>
                                <div id="addCoverPhotoLink">
                                    <div style="padding-top:15%; margin: 0 auto; width: 50%;">
                                        <span class="orange-text" style="font-size: 40px;">+Add Photo</span>
                                    </div>
                                </div>
                            </a>
                        @else
                            <a href="#addCover" class="modal-trigger">
                                <img class="dshPrfCrdImgBan" src="/img/{{ $chef->cover }}">
                                <div id="addCoverPhotoLink">
                                    <div style="padding-top:15%; margin: 0 auto; width: 50%;">
                                        <span class="orange-text" style="font-size: 40px;">+Add Photo</span>
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="card-content">
                        <img src="/img/{{ $chef->avatar }}" class="circle dshPrfCrdImgUs">
                        <span class="card-title">{{$chef->name}}</span>
                        <div class="divider dshPrfCrdDvd"></div>
                        <div class="dshPrfCrdInf">
                            <p>Email:</p>
                            <p class="truncate">{{$chef->email}}</p>
                            <p>Phone Number:</p>
                            <p>{{'0'.$chef->mobile_number}}</p>
                        </div>
                        <div>
                            <a href="{{route('chef.profile')}}">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3">
                <ul class="collection">
                    <li class="collection-item">
                        <div class="collection-header">Pending Delivery</div>
                    </li>
                    @if(count($paidOrders)>0)
                        @foreach($paidOrders as $orderItem)
                            <li class="collection-item">
                                <a href="{{route('chef.order.single',$orderItem['id'])}}">
                                    <p>Plan: <span>{{$orderItem['name']}}</span></p>
                                    <div class="divider"></div>
                                    <p>Foodie:
                                        @foreach($foodies as $foodie)
                                            @if($foodie->id == $orderItem['foodie_id'])
                                                <span>{{$foodie->first_name.' '.$foodie->last_name}}</span>
                                            @endif
                                        @endforeach
                                    </p>
                                    {{--<div class="divider"></div>--}}
                                    {{--<p>--}}
                                        {{--@if($orderItem['is_delivered']==0)--}}
                                            {{--<span>Not Delivered</span>--}}
                                        {{--@elseif($orderItem['is_delivered']==1)--}}
                                            {{--<span>Delivered</span>--}}
                                        {{--@endif--}}
                                    {{--</p>--}}
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li class="collection-item">
                            <span>No Pending Delivery</span>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col s12 m6 l3">
                <ul class="collection">
                    <li class="collection-item">
                        <span class="collection-header">Upcoming Plans</span>
                    </li>
                    @if($pendPlans->count()>0)
                        @foreach($pendPlans as $plan)
                            <li class="collection-item">
                                <a href="{{ route('chef.plan.table',['plan'=>$plan->id]) }}">
                                    <p>Plan: {{$plan->plan_name}}</p>
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li class="collection-item">
                            <div style="margin: 5px;">
                                <span>No Pending Plans</span>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
        {{--<div class="row">--}}
            {{--<div class="col s12 m6 l4">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-image dshPrfCrdCnt">--}}
                        {{--@if($chef->cover==null)--}}
                            {{--<a id="coverLinkPhoto" href="#addCover" class="modal-trigger">--}}
                                {{--<span class="fa fa-camera grey-text lighten-3" style="position: absolute; top:12px; left: 0; display: block; font-size: 8em; margin: 0.15em auto; width: 100%; text-align: center;"></span>--}}
                                {{--<div id="addCoverPhotoLink">--}}
                                    {{--<div style="padding-top:15%; margin: 0 auto; width: 50%;">--}}
                                        {{--<span class="orange-text" style="font-size: 40px;">+Add Photo</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--@else--}}
                            {{--<a href="#addCover" class="modal-trigger">--}}
                                {{--<img class="dshPrfCrdImgBan" src="/img/{{ $chef->cover }}">--}}
                                {{--<div id="addCoverPhotoLink">--}}
                                    {{--<div style="padding-top:15%; margin: 0 auto; width: 50%;">--}}
                                        {{--<span class="orange-text" style="font-size: 40px;">+Add Photo</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                    {{--<div class="card-content">--}}
                        {{--<img src="/img/{{ $chef->avatar }}" class="circle dshPrfCrdImgUs">--}}
                        {{--<span class="card-title">{{$chef->name}}</span>--}}
                        {{--<div class="divider dshPrfCrdDvd"></div>--}}
                        {{--<div class="dshPrfCrdInf">--}}
                            {{--<p>Email: {{$chef->email}}</p>--}}
                            {{--<p>Phone Number: {{'0'.$chef->mobile_number}}</p>--}}
                        {{--</div>--}}
                        {{--<div>--}}
                            {{--<a href="{{route('chef.profile')}}">Edit Profile</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<ul class="collection">--}}
                    {{--<li class="collection-item light-green lighten-1 white-text">--}}
                        {{--<span class="collection-header">Messages From Foodie</span>--}}
                    {{--</li>--}}
                    {{--@if($messages->count()>0)--}}
                        {{--@foreach($chats->take(3) as $chat)--}}
                            {{--@if($chat->message->where('is_read',0)->where('receiver_type','c')->count()>0)--}}
                                {{--<li class="collection-item">--}}
                                    {{--@foreach($foodies as $foodie)--}}
                                        {{--@if($foodie->id == $chat->foodie_id)--}}
                                            {{--<i class="material-icons">message</i>--}}
                                            {{--<span class="truncate dshMsgName">Message From: {{$foodie->first_name.' '.$foodie->last_name}}</span><br>--}}
                                            {{--<a href="{{route('chef.message.message', $chat->id)}}">--}}
                                                {{--<h6>Message:</h6>--}}
                                                {{--<p class="truncate">{{$chat->message()->latest()->first()->subject}}</p>--}}
                                            {{--</a>--}}
                                        {{--@endif--}}
                                    {{--@endforeach--}}
                                {{--</li>--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                    {{--@else--}}
                        {{--<li class="collection-item">--}}
                            {{--<span>No new messages!</span>--}}
                        {{--</li>--}}
                    {{--@endif--}}
                {{--</ul>--}}
                {{--<div>--}}
                    {{--<a href="{{route('chef.message.index')}}">See All</a>--}}
                {{--</div>--}}
                {{--<ul class="collection">--}}
                    {{--<li class="collection-item light-green lighten-1 white-text">--}}
                        {{--<span class="collection-header">Latest Ratings</span>--}}
                    {{--</li>--}}
                    {{--@if($ratings->count()>0)--}}
                        {{--@foreach($ratings as $rating)--}}
                            {{--<li class="collection-item">--}}
                                    {{--<div>--}}
                                        {{--<h6><img class="circle" style="width: 60px;" src="/img/{{ $rating->foodie->avatar }}"> {{$rating->foodie->first_name.' '.$rating->foodie->last_name}}</h6>--}}
                                    {{--</div>--}}
                                    {{--@if($rating->rating == 5)--}}
                                        {{--@for($i=0; $i<5; $i++)--}}
                                            {{--<span><i class="fa fa-star" style="color: gold"></i></span>--}}
                                        {{--@endfor--}}
                                    {{--@elseif($rating->rating == 4)--}}
                                        {{--@for($i=0; $i<4; $i++)--}}
                                            {{--<span><i class="fa fa-star" style="color: gold"></i></span>--}}
                                        {{--@endfor--}}
                                    {{--@elseif($rating->rating == 3)--}}
                                        {{--@for($i=0; $i<3; $i++)--}}
                                            {{--<span><i class="fa fa-star" style="color: gold"></i></span>--}}
                                        {{--@endfor--}}
                                    {{--@elseif($rating->rating == 2)--}}
                                        {{--@for($i=0; $i<2; $i++)--}}
                                            {{--<span><i class="fa fa-star" style="color: gold"></i></span>--}}
                                        {{--@endfor--}}
                                    {{--@elseif($rating->rating == 1)--}}
                                        {{--@for($i=0; $i<1; $i++)--}}
                                            {{--<span><i class="fa fa-star" style="color: gold"></i></span>--}}
                                        {{--@endfor--}}
                                    {{--@endif--}}
                                    {{--@if($rating->feedback!=null)--}}
                                        {{--<p>Comment: {{$rating->feedback}}</p>--}}
                                    {{--@endif--}}
                            {{--</li>--}}
                        {{--@endforeach--}}
                    {{--@else--}}
                        {{--<li class="collection-item">--}}
                            {{--<span>No Ratings Yet!</span>--}}
                        {{--</li>--}}
                    {{--@endif--}}
                {{--</ul>--}}
                {{--<div>--}}
                    {{--<a href="{{route('chef.ratings')}}">See All</a>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col s12 m6 l6">--}}
                {{--<div class="row">--}}
                    {{--<div class="col s12 m6">--}}
                        {{--<ul class="collection">--}}
                            {{--<li class="collection-item light-green lighten-1 white-text">--}}
                                {{--<div class="collection-header">Pending Order</div>--}}
                            {{--</li>--}}
                            {{--@if(count($pendingOrders)>0)--}}
                                {{--@foreach($pendingOrders as $orderItem)--}}
                                    {{--<li class="collection-item">--}}
                                        {{--<a href="{{route('chef.order.single',$orderItem['id'])}}">--}}
                                            {{--<p>Plan: <span>{{$orderItem['name']}}</span></p>--}}
                                            {{--<div class="divider"></div>--}}
                                            {{--<p>Foodie:--}}
                                                {{--@foreach($foodies as $foodie)--}}
                                                    {{--@if($foodie->id == $orderItem['foodie_id'])--}}
                                                        {{--<span>{{$foodie->first_name.' '.$foodie->last_name}}</span>--}}
                                                    {{--@endif--}}
                                                {{--@endforeach--}}
                                            {{--</p>--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                {{--@endforeach--}}
                            {{--@else--}}
                                {{--<li class="collection-item">--}}
                                    {{--<span>No Pending Orders</span>--}}
                                {{--</li>--}}
                            {{--@endif--}}
                        {{--</ul>--}}
                        {{--<div>--}}
                            {{--<a href="{{route('chef.order.view', ['from'=>1])}}">See All</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col s12 m6">--}}
                        {{--<ul class="collection">--}}
                            {{--<li class="collection-item light-green lighten-1 white-text">--}}
                                {{--<div class="collection-header">Paid Order</div>--}}
                            {{--</li>--}}
                            {{--@if(count($paidOrders)>0)--}}
                                {{--@foreach($paidOrders as $orderItem)--}}
                                    {{--<li class="collection-item">--}}
                                        {{--<a href="{{route('chef.order.single',$orderItem['id'])}}">--}}
                                            {{--<p>Plan: <span>{{$orderItem['name']}}</span></p>--}}
                                            {{--<div class="divider"></div>--}}
                                            {{--<p>Foodie:--}}
                                                {{--@foreach($foodies as $foodie)--}}
                                                    {{--@if($foodie->id == $orderItem['foodie_id'])--}}
                                                        {{--<span>{{$foodie->first_name.' '.$foodie->last_name}}</span>--}}
                                                    {{--@endif--}}
                                                {{--@endforeach--}}
                                            {{--</p>--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                {{--@endforeach--}}
                            {{--@else--}}
                                {{--<li class="collection-item">--}}
                                    {{--<span>No Paid Orders</span>--}}
                                {{--</li>--}}
                            {{--@endif--}}
                        {{--</ul>--}}
                        {{--<div>--}}
                            {{--<a href="{{route('chef.order.view', ['from'=>2])}}';}}">See All</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                    {{--<div class="col s12 m6">--}}
                        {{--<ul class="collection">--}}
                            {{--<li class="collection-item light-green lighten-1 white-text">--}}
                                {{--<span class="collection-header">Upcoming Plans</span>--}}
                            {{--</li>--}}
                            {{--@if($pendPlans->count()>0)--}}
                                {{--@foreach($pendPlans as $plan)--}}
                                    {{--<li class="collection-item">--}}
                                        {{--<a href="{{ route('chef.plan.table',['plan'=>$plan->id]) }}">--}}
                                            {{--<p>Plan: {{$plan->plan_name}}</p>--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                {{--@endforeach--}}
                            {{--@else--}}
                                {{--<li class="collection-item">--}}
                                    {{--<div style="margin: 5px;">--}}
                                        {{--<span>No Pending Plans</span>--}}
                                    {{--</div>--}}
                                {{--</li>--}}
                            {{--@endif--}}
                            {{--</ul>--}}
                            {{--<div>--}}
                                {{--<a href="{{route('chef.plan')}}">--}}
                                    {{--@if($pendPlans->count()>0)--}}
                                        {{--See All--}}
                                    {{--@else--}}
                                        {{--View Plans--}}
                                    {{--@endif--}}
                                {{--</a>--}}
                            {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="col s12 m6">--}}
                        {{--<ul class="collection">--}}
                            {{--<li class="collection-item light-green lighten-1 white-text">--}}
                                {{--<span class="collection-header">Current Plans</span>--}}
                            {{--</li>--}}
                            {{--@if($plans->count()>0)--}}
                                {{--@foreach($plans as $plan)--}}
                                    {{--<li class="collection-item">--}}
                                        {{--<a href="{{ route('chef.plan.table',['plan'=>$plan->id]) }}">--}}
                                            {{--<p>Plan: {{$plan->plan_name}}</p>--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                {{--@endforeach--}}
                            {{--@else--}}
                                {{--<li class="collection-item">--}}
                                    {{--<div style="margin: 5px;">--}}
                                        {{--<span>No Plans Added For This Week</span>--}}
                                    {{--</div>--}}
                                {{--</li>--}}
                            {{--@endif--}}
                        {{--</ul>--}}
                        {{--<div>--}}
                            {{--<a href="{{route('chef.plan')}}">--}}
                                {{--@if($plans->count()>0)--}}
                                    {{--See All--}}
                                {{--@else--}}
                                    {{--View Plans--}}
                                {{--@endif--}}
                            {{--</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{-- placeholder--}}
        {{--</div>--}}

    <div id="addCover" class="modal">
        <div class="modal-content">
            <form id="coverPhoto" method="post" action="{{route('chef.profile.coverPhoto')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="file-field input-field">
                        <label for="cover" class="active">Picture Upload:</label>
                        <div style="padding-top: 10px;">
                            <div class="btn">
                                <span>File</span>
                                <input type="file" data-error=".error-pic" id="cover" name="cover">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" >
                            </div>
                            <div class="error-pic err"></div>
                        </div>
                    </div>
                </div>
                <div>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

@endsection
