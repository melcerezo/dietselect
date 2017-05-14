@extends('foodie.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/foodie/foodieDash.css">
    <title>App - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
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
                        <img src="/img/{{ $foodie->avatar }}" class="circle dshPrfCrdImgUs">
                        <span class="card-title">{{$foodie->first_name.' '.$foodie->last_name}}</span>
                        <div class="divider dshPrfCrdDvd"></div>
                        <div class="dshPrfCrdInf">
                            <p>Birthday: {{$foodie->birthday}}</p>
                            <p>Email: {{$foodie->email}}</p>
                            <p>Phone Number: {{$foodie->mobile_number}}</p>
                        </div>
                        <div>
                            <a href="#!">Edit Profile</a>
                        </div>
                        {{--<p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>--}}
                    </div>
                </div>
                <div class="card">
                    <div class="light-green lighten-1 white-text activator" style="line-height: 1.5rem;
                                padding: 10px 20px;
                                margin: 0;">
                            <span>
                                Plan for Week of: April 1-7
                            </span>
                    </div>
                    <table style="table-layout: fixed;">
                        <tr>
                            <th></th>
                            <th>Bre</th>
                            <th>Sna</th>
                            <th>Lun</th>
                            <th>Sna</th>
                            <th>Din</th>
                        </tr>
                        <tr>
                            <th>Mo</th>
                            <td><div class="truncate">Meal 1</div><i class="material-icons">done</i></td>
                            <td><div class="truncate">Meal 2</div><i class="material-icons">done</i></td>
                            <td><div class="truncate">Meal 3</div><i class="material-icons">done</i></td>
                            <td><div class="truncate">Meal 4</div></td>
                            <td><div class="truncate">Meal 5</div></td>
                        </tr>
                        <tr>
                            <th>Tu</th>
                            <td><div class="truncate">Meal 6</div></td>
                            <td><div class="truncate">Meal 7</div></td>
                            <td><div class="truncate">Meal 8</div></td>
                            <td><div class="truncate">Meal 9</div></td>
                            <td><div class="truncate">Meal 10</div></td>
                        </tr>
                        <tr>
                            <th>We</th>
                            <td><div class="truncate">Meal 11</div></td>
                            <td><div class="truncate">Meal 12</div></td>
                            <td><div class="truncate">Meal 13</div></td>
                            <td><div class="truncate">Meal 14</div></td>
                            <td><div class="truncate">Meal 15</div></td>
                        </tr>
                        <tr>
                            <th>Th</th>
                            <td><div class="truncate">Meal 16</div></td>
                            <td><div class="truncate">Meal 17</div></td>
                            <td><div class="truncate">Meal 18</div></td>
                            <td><div class="truncate">Meal 19</div></td>
                            <td><div class="truncate">Meal 20</div></td>
                        </tr>
                        <tr>
                            <th>Fr</th>
                            <td><div class="truncate">Meal 21</div></td>
                            <td><div class="truncate">Meal 22</div></td>
                            <td><div class="truncate">Meal 23</div></td>
                            <td><div class="truncate">Meal 24</div></td>
                            <td><div class="truncate">Meal 25</div></td>
                        </tr>
                        <tr>
                            <th>Sa</th>
                            <td><div class="truncate"></div></td>
                            <td><div class="truncate"></div></td>
                            <td><div class="truncate"></div></td>
                            <td><div class="truncate"></div></td>
                            <td><div class="truncate"></div></td>
                        </tr>
                    </table>
                    <p style="margin-left: 10px;">*Please click calendar title to see meal legend</p>

                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>
                        <ul class="collection">
                            <li class="collection-item light-green lighten-1 white-text">
                                <span class="collection-header">Meal Legend</span>
                            </li>
                            <li class="collection-item" style="margin-left: 10px;">
                                Bre: Breakfast
                            </li>
                            <li class="collection-item" style="margin-left: 10px;">
                                Sna: Snack
                            </li>
                            <li class="collection-item" style="margin-left: 10px;">
                                Lun: Lunch
                            </li>
                            <li class="collection-item" style="margin-left: 10px;">
                                Din: Dinner
                            </li>
                        </ul>
                    </div>
                </div>
                <ul class="collection">
                    <li class="collection-item light-green lighten-1 white-text">
                        <span class="collection-header">Messages From Chef</span>
                    </li>
                    @if($messages->count()>0)
                        @foreach($messages as $message)
                            <li class="collection-item">
                                @foreach($chefs as $chef)
                                    @if($chef->id == $message->sender_id)
                                            <i class="material-icons">message</i>
                                            Message From: {{$chef->name}}<br>
                                            
                                            <a href="#!"><h6>Message:</h6>
                                            <p class="truncate">{{$message->message}}</p></a>
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
                <ul class="collection">
                    <li class="collection-item light-green lighten-1 white-text">
                        <span class="collection-header">Suggested Meal Plans</span>
                    </li>
                    @if(count($suggested)>0)
                        @foreach($suggested as $sug)
                            <li class="collection-item">
                                <a>{{$sug}}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
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
                                    <p>Plan Name: {{$order->plan->plan_name}}</p>
                                    <div class="divider"></div>
                                    <p>Chef: {{$order->chef->name}}</p>
                                    <div class="divider"></div>
                                    <p>Price: {{$order->plan->price}}</p>
                                </li>
                            @endforeach
                        @else
                            <li class="collection-item">
                                <span>No Pending Orders</span>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="col s12 m6 l6" style="padding: 0;">
                    <ul class="collection">
                        <li class="collection-item light-green lighten-1 white-text">
                            <div class="collection-header">Pending Ratings</div>
                        </li>
                        @if($ratingsCount>0)
                            <li class="collection-item">
                                <i class="material-icons">stars</i>
                                {{$ordersRating->chef->name}}<br>
                            </li>
                            @else
                            <li class="collection-item">
                                <span>No Pending Ratings!</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col m8 offset-m2">--}}
                {{--<h1 class="center white-text">Dashboard</h1>--}}
                {{--<h3 class="center full-width white-text" style="font-size: 1.5em">You are logged in! Welcome--}}
                    {{--back, {{ $foodie->first_name }}!</h3>--}}
                {{--<div class="card papaya-whip">--}}
                    {{--<div class="card-content">--}}
                        {{--<h4 class="mustard-text">Pending Orders:</h4>--}}
                        {{--<div>--}}
                            {{--@if($ordersCount>0)--}}
                                {{--@foreach($orders as $order)--}}
                                    {{--<a href="{{route('order.show',$order->id)}}">--}}
                                        {{--<div>--}}
                                            {{--<div>Chef: {{$order->chef->name}}</div>--}}
                                            {{--<div>Plan Name: {{$order->plan->plan_name}}</div>--}}
                                            {{--<div>Plan Price: {{$order->plan->price}}</div>--}}
                                        {{--</div>--}}
                                    {{--</a>--}}
                                    {{--<hr>--}}
                                {{--@endforeach--}}
                            {{--@else--}}
                                {{--<div>--}}
                                    {{--<h5>No Pending Orders!</h5>--}}
                                {{--</div>--}}

                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
            {{--<div class="row">--}}
                {{--<div class="col m8 offset-m2">--}}
                    {{--<div class="card papaya-whip">--}}
                        {{--<div class="card-content">--}}
                            {{--<h4 class="mustard-text">Pending Ratings:</h4>--}}
                            {{--<div>--}}
                                {{--@if($ratingsCount>0)--}}
                                    {{--<div>--}}
                                        {{--<div><a href="{{route('chef.rating')}}">Chef Name: {{$ordersRating->chef->name}}</a></div>--}}
                                    {{--</div>--}}
                                {{--@else--}}
                                    {{--<div>--}}
                                        {{--<h5>No Pending Ratings!</h5>--}}
                                    {{--</div>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
                {{--<div class="card papaya-whip">--}}
                    {{--<div class="card-content">--}}
                        {{--<h4 class="mustard-text">Suggested Meal Plans:</h4>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="card papaya-whip">--}}
                {{--<div class="card-content">--}}
                {{--<h4 class="mustard-text">Meal Plans:</h4>--}}
                {{--</div>--}}
                {{--</div>--}}

                {{--<form id="logout" method="post" action="{{ route('foodie.logout') }}">--}}
                {{--{{ csrf_field() }}--}}
                {{--<a id="logout-link" href="#">--}}
                {{--Logout--}}
                {{--</a>--}}
                {{--</form>--}}
