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
                            <a href="{{route("foodie.order.view", ['id'=> 0])}}">Orders</a>
                        </li>
                        <li class="collection-item">
                            <a href="{{route('foodie.plan.show')}}">Browse Plans</a>
                        </li>
                        <li class="collection-item">
                            <a href="{{route('foodie.profile')}}">Profile</a>
                        </li>
                        <li class="collection-item">
                            <a href="{{route('foodie.message.index')}}">Messages</a>
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
                            <p class="truncate" style="margin: 0 0 10px 0;">{{date('F j, Y',strtotime($foodie->birthday))}}</p>
                            <p>Email:</p>
                            <p class="truncate">{{$foodie->email}}</p>
                        </div>
                        <div>
                            <a href="{{route('foodie.profile')}}">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div>
                    <ul class="collection">
                        <li class="collection-item">
                            <div class="collection-header">Pending Orders</div>
                        </li>
                        @if(count($orderArray)>0)
                            @foreach($orderArray as $order)

                                <li class="collection-item pendingItem">
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
                    @if(count($orderArray)>0)
                        <div>
                            <a href="{{route('foodie.order.view', 2)}}">See All</a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col s12 m3">
                <ul class="collection">
                    <li class="collection-item">
                        <div class="collection-header">Pending Ratings</div>
                    </li>
                    @if(count($ordersRatingPlans)>0)
                        @foreach($ordersRatingPlans as $rating)
                            <li class="collection-item ratingItem">
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
                @if(count($ordersRatingPlans)>0)
                    <div>
                        <a href="{{route('chef.rating', ['id'=>0])}}">See All</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            @if(count($incompArray)>0)
                <div class="col s12 m4 offset-m5">
                    <ul class="collection">
                        <li class="collection-item">Finish Customizations</li>
                        @foreach($incompArray as $item)
                            <li class="collection-item simpleLink">
                                <a href="{{route('foodie.plan.simpleView',$item['id'])}}">{{$item['name']}}</a>
                                <a href="{{route('foodie.plan.simpleDelete', $item['id'])}}" class="right deleteSimpleLink"><i class="fa fa-times" aria-hidden="true"></i></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>



    <div id="addCover" class="modal">
        <div class="modal-content">
            <form id="coverPhoto" method="post" action="{{route('foodie.profile.coverPhoto')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="file-field input-field">
                        <label for="planPic" class="active">Picture Upload:</label>
                        <div id="imgContainer">
                        </div>
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
