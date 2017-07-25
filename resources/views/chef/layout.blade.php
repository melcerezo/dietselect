@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="/css/chef/chefMain.css">
    {{--<link rel="stylesheet" href="/css/foodie/app.css">--}}
    <script>
        {{--var profileRoute="{{route('foodie.profile')}}";--}}
                {{--var chefRoute="{{route('foodie.chef.show')}}";--}}
        orderAllRoute ='{{route('chef.order.view')}}';
        logoutRoute='{{route('chef.logoutAuto')}}';
    </script>

    <script src="/js/chef/app.js" defer></script>


    @if ($sms_unverified)
        <link rel="stylesheet" href="/css/chef/verify.css">
        <script src="/js/chef/verification.validate.js" defer></script>
    @endif

    @if (session('after_registration'))
        <script>
            jQuery(window).load(function () {
                var delay = 1500;
                setTimeout(function () {
                    Materialize.toast("This is a toast notification!", 5000, 'rounded');
                }, delay);

                delay = 3000;
                setTimeout(function () {
                    Materialize.toast("This will display various important messages and notifications", 5000, 'rounded');
                }, delay);

                delay = 4500;
                setTimeout(function () {
                    Materialize.toast("You can swipe this to dismiss it.", 5000, 'rounded');
                }, delay);
            });
        </script>
    @endif
    @yield('page_head')
@endsection

@section('content')
    {{-- new navigation bar --}}
    <header>
        <nav>
            <div class="nav-wrapper light-green lighten-1">
                <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>
                <div class="dsBrLo">
                    <a href="{{route('chef.dashboard')}}" class="brand-logo">Diet Select</a>
                </div>
                <ul id="nav-mobile" class="right">
                    <li class="hide-on-med-and-down">
                        <a href="{{route('chef.plan')}}">
                                <span class="valign-wrapper">
                                <i class="nvIc material-icons">dashboard</i>
                                <span class="nvItTx">
                                    View Plans
                                </span>
                            </span>
                        </a>
                    </li>
                    <li class="hide-on-med-and-down">
                        <a class="dropdown-button" href="#" data-activates='chefMessageDropdown' data-beloworigin="true" data-constrainwidth="false">
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
                        <a id="notifLink" class="dropdown-button" href="#" data-activates='chefNotificationDropdown' data-beloworigin="true" data-constrainwidth="false">
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
                        <a class="dropdown-button" href="#" data-activates='chef-dropdown' data-beloworigin="true" data-constrainwidth="true">
                            <img class="circle nvUsPrPc" src="/img/{{ $chef->avatar }}">
                            <span class="nvItTx hide-on-med-and-down">{{$chef->name}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        {{-- Foodie Notification Dropdown --}}
        <ul id="chefNotificationDropdown" class="notifCol dropdown-content collection" style="max-width: 300px;">
            @unless($notifications->count()>0)
                <li class="collection-item">
                    <span>No notifications</span>
                </li>
            @endunless
        </ul>

        {{-- Chef Message Dropdown --}}
        <ul id="chefMessageDropdown" class="dropdown-content collection msgCollct">
            @if($chats->count())
                @foreach($chats->take(5) as $chat)
                    @if($chat->message->where('is_read',0)->where('receiver_type','c')->count()==0)
                        <li class="collection-item msgCol">
                            @foreach($foodies as $foodie)
                                @if($foodie->id == $chat->foodie_id)
                                    <a class="msgLink" href="{{route('chef.message.message', $chat->id)}}">
                                        <div class="row msCntr">
                                            <div class="col s2">
                                                <img class="msImg circle nvUsPrPc" src="/img/{{ $foodie->avatar }}">
                                            </div>
                                            <div class="msMsCnt col s10">
                                                <span>{{$foodie->first_name.' '.$foodie->last_name}}</span>
                                                <div><span>{{$chat->message()->latest()->first()->subject}}</span></div>
                                                <div style="margin-top: 5px; color:cornflowerblue;">
                                                    <span>{{$chat->message()->latest()->first()->created_at->format('d F, H:ia')}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </li>
                    @else
                        <li class="collection-item" style="background-color: #00e5ff">
                            @foreach($foodies as $foodie)
                                @if($foodie->id == $chat->foodie_id)
                                    <a class="msgLink" href="{{route('chef.message.message', $chat->id)}}">
                                        <div class="row msCntr">
                                            <div class="col s2">
                                                <img class="msImg circle nvUsPrPc" src="/img/{{ $foodie->avatar }}">
                                            </div>
                                            <div class="msMsCnt col s10">
                                                <span>{{$foodie->first_name.' '.$foodie->last_name}}</span>
                                                <div>
                                                    <span>{{$chat->message()->latest()->first()->subject}}</span>
                                                </div>
                                                <div style="margin-top: 5px; color:cornflowerblue;">
                                                    <span>{{$chat->message()->latest()->first()->created_at->format('d F, H:ia')}}</span>
                                                </div>
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
                    <a href="{{route('chef.message.index')}}">
                        <span>No Messages</span>
                    </a>
                </li>
            @endif
        </ul>
        {{--<!-- Chef Dropdown Menu -->--}}
        <ul id='chef-dropdown' class='dropdown-content collection'>
            <li class="collection-item">
                <a href="{{ route("chef.profile") }}" class="nvItLnk">
                    {{--<i class="fa fa-user" aria-hidden="true"></i>--}}
                    <span class="hide-on-med-and-down">Profile</span>
                </a>
            </li>
            {{--<li class="collection-item">--}}
                {{--<a href="#!" class="nvItLnk">--}}
                    {{--<i class="fa fa-cogs" aria-hidden="true"></i>--}}
                    {{--<span class="hide-on-med-and-down">Settings</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            <li class="divider"></li>
            <li class="collection-item">
                <form id="logout" method="post" action="{{ route('chef.logout') }}">
                    {{ csrf_field() }}
                    <a id="logout-link" class="nvItLnk" href="#">
                        {{--<i class="fa fa-sign-out" aria-hidden="true"></i>--}}
                        <span class="hide-on-med-and-down">Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </header>
    <main>
        <!-- Start of Side-nav -->
        <ul id="slide-out" class="side-nav collection">
            <li class="collection-item light-green lighten-3 sdNvPr">
                <div class="row">
                    <div class="col s4 m4 l4">
                        <img class="circle sdNvPrPc" src="/img/{{ $chef->avatar }}">
                    </div>
                    <div class="col s8 m8 l8">
                        <p>{{$chef->name}}</p>
                        <p>Chef</p>
                    </div>
                </div>
                {{--<a id="foodieProfile" href="#!">Profile</a>--}}
            </li>
            <li class="collection-item"><a id="chefDashboard" href="{{route('chef.dashboard')}}">Dashboard</a></li>
            {{--<li class="collection-item"><a id="viewChefs" href="#!">View Chefs</a></li>--}}
            <li class="collection-item">
                <a href="{{url('chef/message/index')}}">
                    Messages @if($chats->count()>0)
                        <span class="new badge red">{{$chats->count()}}</span>
                    @endif
                </a>
            </li>
            <li class="collection-item"><a href="{{url('foodie/order/view')}}">Order History</a></li>
            <li class="collection-item"><a href="{{route('chef.rating')}}">Rating</a></li>
            {{--<li class="collection-item"><a id="viewChefs" href="#!">View Chefs</a></li>--}}
        </ul>

    @yield('page_content')

    @if ($sms_unverified)
        <!-- Verification Modal -->
            <div id="verification-modal" class="modal modal-fixed-footer">
                <div class="modal-content">
                    <h4 class="mustard-text">Verify your Account</h4>
                    <p>We sent you an SMS message with a verification code. Please enter it here, so you can start
                        picking your diet meal plans!</p>
                    <div class="row">
                        <div class="input-field col s12">
                            <form id="verification" role="form" method="post" action="{{ route('chef.verify.sms') }}">
                                {{ csrf_field() }}
                                <input id="n-verification-code" name="verification_code" type="text"
                                       data-error=".error-msg-verification-code"
                                       value="{{ old('verification_code') }}"/>
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
                            <p></p>Didn't receive your code? <span id="n-timer-msg">Please wait <span id="n-timer"
                                                                                                      class="asparagus-text">60 secs.</span> before requesting to resend a new SMS code.</span></p>
                            <form id="send-code" method="post" action="{{ route('chef.verify.sms.send') }}">
                                {{ csrf_field()}}
                                <a id="n-request-code" class="n-submit-btn" href="#"></a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript:void(0)" class="modal-action modal-close btn-flat right-align n-btn-link"><i
                                class="fa fa-times-circle"></i> <span class="hide-on-small-only n-modal-form-btn-text">Close</span></a>
                    <a href="javascript:void(0)" id="submit" class="modal-action btn-flat n-btn-link"><i
                                class="fa fa-paper-plane-o"></i><span class="hide-on-small-only n-modal-form-btn-text"> Submit</span></a>
                </div>
            </div>
            <!-- End of verification-modal -->
        @endif
    </main>
    <footer>

    </footer>
@endsection