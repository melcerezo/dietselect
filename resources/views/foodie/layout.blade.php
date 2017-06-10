@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="/css/foodie/foodieMain.css">
    <script>
        {{--var profileRoute="{{route('foodie.profile')}}";--}}
        {{--var chefRoute="{{route('foodie.chef.show')}}";--}}
        orderAllRoute ='{{route('foodie.order.view')}}';
        logoutRoute='{{route('foodie.logoutAuto')}}';
    </script>
    <script src="/js/foodie/app.js" defer></script>


    @if ($sms_unverified)

        <link rel="stylesheet" href="/css/foodie/verify.css">
        <script src="/js/foodie/verification.validate.js" defer></script>
    @endif

    @if (session('after_registration'))
        <script>
            jQuery(window).load(function() {
                var delay = 1500;
                setTimeout(function() {
                    Materialize.toast("This is a toast notification!", 5000, 'rounded');
                }, delay);

                delay = 3000;
                setTimeout(function() {
                    Materialize.toast("This will display various important messages and notifications", 5000, 'rounded');
                }, delay);

                delay = 4500;
                setTimeout(function() {
                    Materialize.toast("You can swipe this to dismiss it.", 5000, 'rounded');
                }, delay);
            });
        </script>
    @endif
    @yield('page_head')
@endsection

@section('content')

    <main>

        {{-- new navigation bar --}}
        <header>
            <nav>
                <div class="nav-wrapper light-green lighten-1">
                    <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>
                    <div class="dsBrLo">
                        <a href="{{route('foodie.dashboard')}}" class="brand-logo">Diet Select</a>
                    </div>
                    <ul id="nav-mobile" class="right">
                        <li class="hide-on-med-and-down">
                            <a href="{{route('foodie.plan.show')}}">
                                <span class="valign-wrapper">
                                <i class="nvIc material-icons">dashboard</i>
                                <span class="nvItTx">
                                    View Plans
                                </span>
                            </span>
                            </a>
                        </li>
                        <li class="hide-on-med-and-down">
                            <a class="dropdown-button" href="#" data-activates='foodieMessageDropdown' data-beloworigin="true" data-constrainwidth="false">
                            <span class="valign-wrapper">
                                <i class="nvIc material-icons">email</i>
                                <span class="nvItTx">
                                    Messages
                                    @if($messages->count()>0)
                                        <span class="new badge red">{{$messages->count()}}</span>
                                    @endif
                                </span>
                            </span>
                            </a>
                        </li>
                        <li class="hide-on-med-and-down">
                            <a id="notifLink" class="dropdown-button" href="#" data-activates='foodieNotificationDropdown' data-beloworigin="true" data-constrainwidth="false">
                                <span class="valign-wrapper">
                                    <i class="nvIc material-icons">announcement</i>
                                    <span class="nvItTx">
                                        Notifications
                                        <span id="notifBadge"></span>
                                    </span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-button" href="#" data-activates='foodie-dropdown' data-beloworigin="true" data-constrainwidth="true">
                                <img class="circle nvUsPrPc" src="/img/{{ $foodie->avatar }}">
                                @unless($foodie->username==null)
                                    <span class="nvItTx hide-on-med-and-down">{{$foodie->username}}</span>
                                @endunless
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            {{-- Foodie Notification Dropdown --}}
            <ul id="foodieNotificationDropdown" class="notifCol dropdown-content collection" style="max-width: 300px;">
                {{--@if($notifications->count()>0)--}}
                    {{--@foreach($notifications->take(5) as $notification)--}}
                        {{--<li class="collection-item">--}}
                            {{--@if($notification->notification_type==1)--}}
                                {{--<a class="msgLink" href="{{route('foodie.order.view')}}">--}}
                                    {{--<div class="row msCntr">--}}
                                        {{--<div class="msMsCnt col s12">--}}
                                            {{--<span>{{$notification->notification}}</span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--@endif--}}
                            {{--@if($notification->notification_type==2)--}}
                                {{--<a class="msgLink" href="{{route('foodie.order.view')}}">--}}
                                {{--<div class="row msCntr">--}}
                                    {{--<div class="msMsCnt col s12">--}}
                                        {{--<span class="truncate">{{$notification->notification}}</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--</a>--}}
                            {{--@endif--}}
                        {{--</li>--}}
                    {{--@endforeach--}}
                {{--@else--}}
                    {{--<li class="collection-item">--}}
                        {{--<span>No notifications</span>--}}
                    {{--</li>--}}
                {{--@endif--}}
            </ul>

            {{-- Foodie Message Dropdown --}}
            <ul id="foodieMessageDropdown" class="msgCollct dropdown-content collection">
                @if($chats->count()>0)
                @foreach($chats->take(5) as $chat)
                    @if($chat->message->where('is_read',0)->where('receiver_type','f')->count()==0)
                        <li class="collection-item msgCol">
                            @foreach($chefs as $chef)
                                    @if($chef->id == $chat->chef_id)
                                        <a class="msgLink" href="{{route('foodie.message.message', $chat->id)}}">
                                            <div class="row msCntr">
                                                <div class="col s2">
                                                    <img class="msImg circle nvUsPrPc" src="/img/{{ $chef->avatar }}">
                                                 </div>
                                                <div class="msMsCnt col s10">
                                                    <div><span>{{$chef->name}}</span></div>
                                                    <span>{{$chat->message()->latest()->first()->subject}}</span>
                                                </div>
                                            </div>
                                        </a>
                                    @endif
                            @endforeach
                        </li>
                    @else
                        <li class="collection-item" style="background-color: #00e5ff">
                            @foreach($chefs as $chef)
                                @if($chef->id == $chat->chef_id)
                                    <a class="msgLink" href="{{route('foodie.message.message', $chat->id)}}">
                                        <div class="row msCntr">
                                            <div class="col s4 m4 l4">
                                                <img class="msImg circle nvUsPrPc" src="/img/{{ $chef->avatar }}">
                                            </div>
                                            <div class="msMsCnt col s8 m8 l8">
                                                <span>{{$chef->name}}</span>
                                                <span class="truncate">{{$chat->message()->latest()->first()->subject}}</span>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </li>
                    @endif
                @endforeach
                @else
                    <li class="collection-item">
                        <a href="{{route('foodie.message.index')}}">
                        <span>No Messages</span>
                        </a>
                    </li>
                @endif
            </ul>
            {{--<!-- Foodie Dropdown Menu -->--}}
            <ul id='foodie-dropdown' class='dropdown-content collection'>
                <li class="collection-item">
                    <a href="{{ route("foodie.profile") }}" class="nvItLnk">
                        {{--<i class="fa fa-user" aria-hidden="true"></i>--}}
                        <span class="hide-on-med-and-down">Profile</span>
                    </a>
                </li>
                <li class="collection-item">
                    <a href="#!" class="nvItLnk">
                        {{--<i class="fa fa-cogs" aria-hidden="true"></i>--}}
                        <span class="hide-on-med-and-down">Settings</span>
                    </a>
                </li>
                <li class="divider"></li>
                <li class="collection-item">
                    <form id="logout" method="post" action="{{ route('foodie.logout') }}">
                    {{ csrf_field() }}
                        <a id="logout-link" class="nvItLnk" href="#">
                            {{--<i class="fa fa-sign-out" aria-hidden="true"></i>--}}
                            <span class="hide-on-med-and-down">Logout</span>
                        </a>
                    </form>
                </li>
            </ul>
        </header>

        {{-- side nav --}}
        <ul id="slide-out" class="side-nav collection">
        <li class="collection-item light-green lighten-3 sdNvPr">
            <div class="row">
                <div class="col s4 m4 l4">
                    <img class="circle sdNvPrPc" src="/img/{{ $foodie->avatar }}">
                </div>
                <div class="col s8 m8 l8">
                    <p>{{$foodie->first_name.' '.$foodie->last_name}}</p>
                    <p>Foodie</p>
                </div>
            </div>
            {{--<a id="foodieProfile" href="#!">Profile</a>--}}
        </li>
        <li class="collection-item"><a id="foodieDashboard" href="{{route('foodie.dashboard')}}">Dashboard</a></li>
        {{--<li class="collection-item"><a id="viewChefs" href="#!">View Chefs</a></li>--}}
        <li class="collection-item">
            <a href="{{url('foodie/message/index')}}">
                Messages @if($chats->count()>0)
                    <span class="new badge red">{{$chats->count()}}</span>
                @endif
            </a>
        </li>
        <li class="collection-item"><a href="{{url('foodie/order/view')}}">Order History</a></li>
        <li class="collection-item"><a href="{{route('chef.rating')}}">Rating</a></li>
        {{--<li class="collection-item"><a id="viewChefs" href="#!">View Chefs</a></li>--}}
        </ul>


        {{-- begin page content --}}
        @yield('page_content')

        @if($sms_unverified)
        <!-- Verification Modal -->
            <div id="verification-modal" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <h4 class="mustard-text">Verify your Account</h4>
                    <p>We sent you an SMS message with a verification code. Please enter it here, so you can start picking your diet meal plans!</p>
                    <div class="row">
                        <div class="input-field col s12">
                            <form id="verification" role="form" method="post" action="{{ route('foodie.verify') }}">
                                {{ csrf_field() }}
                                <input id="n-verification-code" name="verification_code" type="text" data-error=".error-msg-verification-code" value="{{ old('verification_code') }}"/>
                                <label for="n-verification-code">Verification Code</label>
                                <div class="error-msg-verification-code">
                                    @if ($errors->has('verification_code'))
                                        {{ $errors->first('verification_code') }}
                                    @endif
                                </div>
                                <input type="submit" class="hidden"/>
                            </form>
                        </div>
                        <div class="col s12">
                            <p></p>Didn't receive your code? <span id="n-timer-msg">Please wait <span id="n-timer" class="asparagus-text">60 secs.</span> before requesting to resend a new SMS code.</span></p>
                            <form id="send-code" method="post" action="{{ route('foodie.verify.send') }}">
                                {{ csrf_field() }}
                                <a id="n-request-code" class="n-submit-btn" href="#"></a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="modal-action modal-close btn-flat right-align n-btn-link"><i class="fa fa-times-circle"></i> <span class="hide-on-small-only n-modal-form-btn-text">Close</span></a>
                    <a href="javascript:void(0)" id="submit" class="modal-action btn-flat n-btn-link"><i class="fa fa-paper-plane-o"></i><span class="hide-on-small-only n-modal-form-btn-text"> Submit</span></a>
                </div>
            </div>
            <!-- End of verification-modal -->
        @endif
    </main>
    <footer>
    </footer>
@endsection


{{--<header>--}}
{{--<div class="navbar-fixed">--}}
{{--<nav class="asparagus">--}}
{{--<div class="nav-wrapper">--}}
{{--<a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>--}}
{{--<a href="{{route('foodie.dashboard')}}" class="brand-logo">Diet Select</a>--}}
{{--<ul id="foodie-menu-btn" class="right">--}}
{{--<li>--}}
{{--<a class="dropdown-button" href="#" data-activates='foodie-dropdown' data-beloworigin="true" data-constrainwidth="true">--}}
{{--<img class="circle" src="/img/{{ $foodie->avatar }}">--}}
{{--<span class="white-text hide-on-med-and-down">{{ $foodie->username ? : $foodie->first_name . ' ' . $foodie->last_name }} <i class="fa fa-caret-down" aria-hidden="true"></i>--}}
{{--</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</div>--}}
{{--</nav>--}}
{{--</div>--}}
{{--<!-- Foodie Dropdown Menu -->--}}
{{--<ul id='foodie-dropdown' class='dropdown-content'>--}}
{{--<li>--}}
{{--<a href="{{ route("foodie.profile") }}" class="foodie-link">--}}
{{--<i class="fa fa-user" aria-hidden="true"></i>--}}
{{--<span class="hide-on-med-and-down">Profile</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--<li>--}}
{{--<a href="#!" class="foodie-link">--}}
{{--<i class="fa fa-cogs" aria-hidden="true"></i>--}}
{{--<span class="hide-on-med-and-down">Settings</span>--}}
{{--</a>--}}
{{--</li>--}}
{{--<li class="divider"></li>--}}
{{--<li>--}}
{{--<form id="logout" method="post" action="{{ route('foodie.logout') }}">--}}
{{--{{ csrf_field() }}--}}
{{--<a id="logout-link" class="foodie-link" href="#">--}}
{{--<i class="fa fa-sign-out" aria-hidden="true"></i>--}}
{{--<span class="hide-on-med-and-down">Logout</span>--}}
{{--</a>--}}
{{--</form>--}}
{{--</li>--}}
{{--</ul>--}}
{{--</header>--}}


{{--<!-- Start of Side-nav -->--}}
{{--<ul id="slide-out" class="side-nav">--}}
{{--<li><a id="foodieProfile" href="#!">Profile</a></li>--}}
{{--<li><a id="viewChefs" href="#!">View Chefs</a></li>--}}
{{--<li><a href="{{url('foodie/message/index')}}">Messaging({{$messages->count()}})</a></li>--}}
{{--<li><a href="{{url('foodie/order/view')}}">Order History</a></li>--}}
{{--<li><a href="{{route('chef.rating')}}">Rating</a></li>--}}
{{--<li><a id="viewChefs" href="#!">View Chefs</a></li>--}}
{{--</ul>--}}