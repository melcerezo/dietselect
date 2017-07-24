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
            <div class="col s12 m6 l4">
                <div class="card">
                    <div class="card-image dshPrfCrdCnt">
                        @if($chef->cover==null)
                            <a href="#addCover" class="modal-trigger">
                                <span class="fa fa-camera grey-text lighten-3" style="position: absolute; top:12px; left: 0; display: block; font-size: 8em; margin: 0.15em auto; width: 100%; text-align: center;"></span>
                                <div id="addCoverPhotoLink" style="position: absolute; left:10px; bottom:9px;">
                                </div>
                            </a>
                        @else
                            <a href="#addCover" class="modal-trigger">
                                <img class="dshPrfCrdImgBan" src="/img/{{ $chef->cover }}">
                                <div id="addCoverPhotoLink" style="position: absolute; left:10px; bottom:9px;">
                                </div>
                            </a>
                        @endif
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
                    @if($plans->count()>0)
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
                    @else
                        <li class="collection-item">
                            <a href="#!">
                                <span>No Plans Yet!</span>
                            </a>
                        </li>
                    @endif
                </ul>
                <ul class="collection">
                    <li class="collection-item light-green lighten-1 white-text">
                        <span class="collection-header">Messages From Foodie</span>
                    </li>
                    @if($messages->count()>0)
                        @foreach($chats->take(3) as $chat)
                            @if($chat->message->where('is_read',0)->where('receiver_type','c')->count()>0)
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
                            @endif
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
                        @if(count($orderItems)>0)
                            @foreach($orderItems as $orderItem)
                                @if($orderItem->is_paid==0)
                                <li class="collection-item">
                                    <a href="{{route('chef.order.single',$orderItem->id)}}">
                                        <p>Plan Name: <span>{{$orderItem->plan_name}}</span></p>
                                        <div class="divider"></div>
                                        <p>Foodie:
                                            @foreach($foodies as $foodie)
                                                @if($foodie->id == $orderItem->foodie_id)
                                                    <span>{{$foodie->first_name.' '.$foodie->last_name}}</span>
                                                @endif
                                            @endforeach
                                        </p>
                                        <div class="divider"></div>
                                        <p>Type:
                                            @if($orderItem->order_type==0)
                                                <span>Standard</span>
                                            @elseif($orderItem->order_type==1)
                                                <span>Customized</span>
                                            @endif
                                        </p>
                                    </a>
                                </li>
                                @elseif($orderItem->is_paid==1)
                                    <li class="collection-item">
                                        <span>No Pending Orders</span>
                                    </li>
                                @endif
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

    <div id="addCover" class="modal">
        <div class="modal-content">
            <form id="coverPhoto" method="post" action="{{route('chef.profile.coverPhoto')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="file-field input-field">
                        <label for="planPic" class="active">Picture Upload:</label>
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
