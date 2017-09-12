@extends('foodie.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/foodie/foodieDash.css">
    <script src="/js/foodie/foodieDash.js" defer></script>
    <title>App - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
@endsection

@section('page_content')
    <div class="container dshMnCnt">
        <div class="row">
            <div class="col s12 m2">
                <div class="row">
                    <div>
                        ACCOUNT DASHBOARD
                    </div>
                </div>
                <div class="divider"></div>
                <div class="row">
                    <ul class="collection">
                        <li class="collection-item">
                            <a href="{{route("foodie.order.view", ['id'=> 0])}}">Order History</a>
                        </li>
                        <li class="collection-item">
                            <a href="{{route('foodie.plan.show')}}">Browse Plans</a>
                        </li>
                        <li class="collection-item">
                            <a href="{{route('foodie.profile')}}">Profile</a>
                        </li>
                        <li class="collection-item">
                            <a href="{{route('foodie.message.index')}}">Messages</a>
                            @if($messages->count()>0)
                                <span class="badge red">{{$messages->count()}}</span>
                            @endif
                        </li>
                        <li class="collection-item">
                            <a href="{{route('chef.rating', ['id'=>1])}}">Ratings</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col s12 m3">
                <div class="card">
                    <div class="card-image grey lighten-1 dshPrfCrdCnt" style="position: relative">
                        @if($foodie->cover==null)
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
                                <img class="dshPrfCrdImgBan" src="/img/{{ $foodie->cover }}">
                                <div id="addCoverPhotoLink">
                                    <div style="padding-top:15%; margin: 0 auto; width: 50%;">
                                        <span class="orange-text" style="font-size: 40px;">+Add Photo</span>
                                    </div>
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="card-content">
                        <img src="/img/{{ $foodie->avatar }}" class="circle dshPrfCrdImgUs">
                        <span class="card-title">{{$foodie->first_name.' '.$foodie->last_name}}</span>
                        <div class="divider dshPrfCrdDvd"></div>
                        <div class="dshPrfCrdInf">
                            <p>Birthday:</p>
                            <p class="truncate">{{$foodie->birthday}}</p>
                            <p>Email:</p>
                            <p class="truncate">{{$foodie->email}}</p>
                        </div>
                        <div>
                            <a href="{{route('foodie.profile')}}">Edit Profile</a>
                        </div>
                        {{--<p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>--}}
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div>
                    <ul class="collection">
                        <li class="collection-item">
                            <div class="collection-header">Pending Orders</div>
                        </li>
                        @if($orders->count()>0)
                            @foreach($orderArray as $order)

                                <li class="collection-item">
                                    <a href="{{route('order.show',$order['id'])}}">
                                        <p>For Week Of: {{$order['week']}}</p>
                                        <div class="divider"></div>
                                        <p>Total: {{$order['total']}}</p>
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <li class="collection-item">
                                <span>No Pending Orders</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col s12 m3">
                <ul class="collection">
                    <li class="collection-item">
                        <div class="collection-header">Pending Ratings</div>
                    </li>
                    @if(count($ordersRatingPlans)>0)
                        @foreach($ordersRatingPlans as $rating)
                            <li class="collection-item">
                                <a href="{{route('chef.rating', ['id'=>0])}}">
                                    <i class="material-icons">stars</i>
                                    {{$rating['plan_name'].'-'.$rating['type']}}<br>
                                </a>
                            </li>
                        @endforeach
                    @else
                        <li class="collection-item">
                            <span>No Pending Ratings!</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>


        {{--<div class="row">--}}
            {{--<div class="col s12 m6 l4">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-image grey lighten-1 dshPrfCrdCnt" style="position: relative">--}}
                        {{--@if($foodie->cover==null)--}}
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
                                {{--<img class="dshPrfCrdImgBan" src="/img/{{ $foodie->cover }}">--}}
                                {{--<div id="addCoverPhotoLink">--}}
                                    {{--<div style="padding-top:15%; margin: 0 auto; width: 50%;">--}}
                                         {{--<span class="orange-text" style="font-size: 40px;">+Add Photo</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</a>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                    {{--<div class="card-content">--}}
                        {{--<img src="/img/{{ $foodie->avatar }}" class="circle dshPrfCrdImgUs">--}}
                        {{--<span class="card-title">{{$foodie->first_name.' '.$foodie->last_name}}</span>--}}
                        {{--<div class="divider dshPrfCrdDvd"></div>--}}
                        {{--<div class="dshPrfCrdInf">--}}
                            {{--<p>Birthday: {{$foodie->birthday}}</p>--}}
                            {{--<p>Email: {{$foodie->email}}</p>--}}
                            {{--<p>Phone Number: {{"0".$foodie->mobile_number}}</p>--}}
                        {{--</div>--}}
                        {{--<div>--}}
                            {{--<a href="{{route('foodie.profile')}}">Edit Profile</a>--}}
                        {{--</div>--}}
                        {{--<p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="card">--}}
                {{--@if($paidOrderUpcoming!=null)--}}
                            {{--<div class="light-green lighten-1 white-text dshMnClTtl">--}}
                                {{--<span class="activator dshMnTtl">--}}
                                    {{--Upcoming Plans: {{$nextWeek}}--}}
                                {{--</span>--}}
                            {{--</div>--}}
                            {{--<table class="dshMlTbl centered">--}}
                                    {{--<tr>--}}
                                        {{--<td>Name</td>--}}
                                        {{--<td>Chef</td>--}}
                                        {{--<td>Type</td>--}}
                                    {{--</tr>--}}
                                    {{--@foreach($orderItemArrayUpcoming as $orderItem)--}}
                                        {{--<tr>--}}
                                            {{--<td>{{$orderItem['plan']}}</td>--}}
                                            {{--<td>{{$orderItem['chef']}}</td>--}}
                                            {{--<td>{{$orderItem['type']}}</td>--}}
                                        {{--</tr>--}}
                                    {{--@endforeach--}}
                            {{--</table>--}}
                {{--@else--}}
                        {{--<div class="light-green lighten-1 white-text activator dshMnClTtl">--}}
                            {{--<span>Nothing Ordered for Next week</span>--}}
                        {{--</div>--}}
                        {{--<div class="dshNoOrd">--}}
                            {{--<a href="{{route('foodie.plan.show')}}"> Take a Look at our available plans!</a>--}}
                        {{--</div>--}}
                {{--@endif--}}
                {{--</div>--}}
                {{--<div class="card">--}}
                    {{--@if($paidOrder!=null)--}}
                    {{--<div class="light-green lighten-1 white-text dshMnClTtl">--}}
                            {{--<span class="activator dshMnTtl">--}}
                                {{--Order for Week of: {{$thisWeek}}--}}
                            {{--</span>--}}
                    {{--</div>--}}
                        {{--<table class="dshMlTbl centered">--}}
                                {{--<tr>--}}
                                    {{--<td>Name</td>--}}
                                    {{--<td>Chef</td>--}}
                                    {{--<td>Type</td>--}}
                                {{--</tr>--}}
                                {{--@foreach($orderItemArray as $orderItem)--}}
                                    {{--<tr>--}}
                                        {{--<td>{{$orderItem['plan']}}</td>--}}
                                        {{--<td>{{$orderItem['chef']}}</td>--}}
                                        {{--<td>{{$orderItem['type']}}</td>--}}
                                    {{--</tr>--}}
                                {{--@endforeach--}}
                        {{--</table>--}}

                    {{--@else--}}
                        {{--<div class="light-green lighten-1 white-text activator dshMnClTtl">--}}
                            {{--<span>Nothing Ordered for this week</span>--}}
                        {{--</div>--}}
                        {{--<div class="dshNoOrd">--}}
                        {{--</div>--}}
                    {{--@endif--}}
                {{--</div>--}}
                {{--<ul class="collection">--}}
                    {{--<li class="collection-item light-green lighten-1 white-text">--}}
                        {{--<span class="collection-header">Messages From Chef</span>--}}
                    {{--</li>--}}
                    {{--@if($messages->count()>0)--}}
                        {{--@foreach($chats->take(3) as $chat)--}}
                            {{--@if($chat->message->where('is_read',0)->where('receiver_type','f')->count()>0)--}}
                                {{--<li class="collection-item">--}}
                                    {{--@foreach($chefs as $chef)--}}
                                        {{--@if($chef->id == $chat->chef_id)--}}
                                                {{--<i class="material-icons">message</i>--}}
                                                {{--Message From: {{$chef->name}}<br>--}}
                                                {{--<a href="{{route('foodie.message.message', $chat->id)}}">--}}
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
                {{--<ul class="collection">--}}
                    {{--<li class="collection-item light-green lighten-1 white-text">--}}
                        {{--<span class="collection-header">Suggested Meal Plans</span>--}}
                    {{--</li>--}}
                    {{--@if(count($suggested)>0)--}}
                        {{--@foreach($suggested as $sug)--}}
                            {{--<li class="collection-item">--}}
                                {{--<a href="{{route('foodie.plan.standard', $sug['id'])}}">{{$sug['name']}}</a>--}}
                            {{--</li>--}}
                        {{--@endforeach--}}
                    {{--@else--}}
                        {{--<li class="collection-item">--}}
                            {{--<span>No Plans!</span>--}}
                        {{--</li>--}}
                    {{--@endif--}}
                {{--</ul>--}}
            {{--</div>--}}
            {{--<div class="col s12 m6 l6">--}}
                {{--<div>--}}
                    {{--<ul class="collection">--}}
                        {{--<li class="collection-item light-green lighten-1 white-text">--}}
                            {{--<div class="collection-header">Pending Orders</div>--}}
                        {{--</li>--}}
                        {{--@if($orders->count()>0)--}}
                            {{--@foreach($orderArray as $order)--}}

                                {{--<li class="collection-item">--}}
                                    {{--<a href="{{route('order.show',$order['id'])}}">--}}
                                        {{--<p>Order Address:--}}
                                            {{--@if($order['address']!='')--}}
                                            {{--{{$order['address']}}--}}
                                            {{--@else--}}
                                                {{--<a href="{{route('foodie.profile')}}">--}}
                                                    {{--<span>No Address Available. Please add one so we can deliver to you!</span>--}}
                                                {{--</a>--}}
                                            {{--@endif--}}
                                        {{--</p>--}}
                                        {{--<div class="divider"></div>--}}
                                        {{--<p>Number of Items: {{$order['quantity']}}</p>--}}
                                        {{--<div class="divider"></div>--}}
                                        {{--<p>Week: {{$order['week']}}</p>--}}
                                        {{--<div class="divider"></div>--}}
                                        {{--<p>Total: {{$order['total']}}</p>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--@endforeach--}}
                        {{--@else--}}
                            {{--<li class="collection-item">--}}
                                {{--<span>No Pending Orders</span>--}}
                            {{--</li>--}}
                        {{--@endif--}}
                    {{--</ul>--}}
                {{--</div>--}}
                {{--<div class="col s12 m6 l6" style="padding: 0;">--}}
                    {{--<ul class="collection">--}}
                        {{--<li class="collection-item light-green lighten-1 white-text">--}}
                            {{--<div class="collection-header">Pending Ratings</div>--}}
                        {{--</li>--}}
                        {{--@if(count($ordersRatingPlans)>0)--}}
                                {{--@foreach($ordersRatingPlans as $rating)--}}
                                    {{--<li class="collection-item">--}}
                                        {{--<a href="{{route('chef.rating')}}">--}}
                                            {{--<i class="material-icons">stars</i>--}}
                                            {{--{{$rating['plan_name'].'-'.$rating['type']}}<br>--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                {{--@endforeach--}}
                            {{--@else--}}
                            {{--<li class="collection-item">--}}
                                {{--<span>No Pending Ratings!</span>--}}
                            {{--</li>--}}
                        {{--@endif--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div id="addCover" class="modal">
        <div class="modal-content">
            <form id="coverPhoto" method="post" action="{{route('foodie.profile.coverPhoto')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="file-field input-field">
                        <label for="planPic" class="active">Picture Upload:</label>
                        <div style="padding-top: 10px;">
                            <div class="btn orange darken-2">
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
                    <input type="submit" value="Submit" class="btn orange darken-2 btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection
