@extends('chef.layout')
@section('page_head')
    <title>App - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="/css/chef/chefDash.css">
@endsection

@section('page_content')
    <div class="container dshMnCnt">
        <div class="row">
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image dshPrfCrdCnt">
                        <img class="dshPrfCrdImgBan" src="/img/diet-meal-1.jpg">
                    </div>
                    <div class="card-content">
                        <img src="/img/{{ $chef->avatar }}" class="circle dshPrfCrdImgUs">
                        <span class="card-title">{{$chef->name}}</span>
                        <div class="divider dshPrfCrdDvd"></div>
                        <div class="dshPrfCrdInf">
                            <p>Email: {{$chef->email}}</p>
                            <p>Phone Number: {{$chef->mobile_number}}</p>
                        </div>
                        <div>
                            <a href="{{route('chef.profile')}}">Edit Profile</a>
                        </div>
                    </div>
                </div>
                <ul class="collection">
                    <li class="collection-item light-green lighten-1 white-text">
                        <span class="collection-header">Current Plans</span>
                    </li>
                    @foreach($plans->take(3) as $plan)
                        <li class="collection-item">
                            <a href="#!">
                                <p>Plan Name: {{$plan->plan_name}}</p>
                                <div class="divider"></div>
                                <p>Calories: {{$plan->calories}}</p>
                                <div class="divider"></div>
                                <p>Price: {{$plan->price}}</p>
                            </a>
                        </li>
                    @endforeach
                </ul>
                <ul class="collection">
                    <li class="collection-item light-green lighten-1 white-text">
                        <span class="collection-header">Messages From Foodie</span>
                    </li>
                    @if($chats->count()>0)
                        @foreach($chats->take(3) as $chat)
                            <li class="collection-item">
                                @foreach($foodies as $foodie)
                                    @if($foodie->id == $chat->foodie_id)
                                        <i class="material-icons">message</i>
                                        <span class="truncate dshMsgName">Message From: {{$foodie->first_name.' '.$foodie->last_name}}</span><br>
                                        <a href="{{route('chef.message.message', $chat->id)}}">
                                            <h6>Message:</h6>
                                            <p class="truncate">{{$chat->message()->latest()->first()->subject}}</p>
                                        </a>
                                    @endif
                                @endforeach
                            </li>
                        @endforeach
                    @else
                        <li class="collection-item">
                            <span>No new messages!</span>
                        </li>
                    @endif
                </ul>
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
            </div>
            <div class="col s12 m6 l6">
                <div>
                    <ul class="collection">
                        <li class="collection-item light-green lighten-1 white-text">
                            <div class="collection-header">Pending Order</div>
                        </li>
                        @if($ordersCount>0)
                            @foreach($orders as $order)
                                <li class="collection-item">
                                    <a href="{{route('order.show',$order->id)}}">
                                        <p>Plan Name: {{$order->plan->plan_name}}</p>
                                        <div class="divider"></div>
                                        <p>Foodie: {{$order->foodie->first_name.' '.$order->foodie->last_name}}</p>
                                        <div class="divider"></div>
                                        <p>Price: {{$order->plan->price}}</p>
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
            {{-- placeholder--}}
        </div>
    </div>
@endsection
