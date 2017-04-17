@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="/css/foodie/app.css">
    <script>
        var profileRoute="{{route('foodie.profile')}}";
        var chefRoute="{{route('foodie.chef.show')}}";
        var messageRoute="{{route('foodie.message.index')}}";
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
    <header>
        <div class="navbar-fixed">
            <nav class="asparagus">
                <div class="nav-wrapper">
                    <a href="#" data-activates="slide-out" class="button-collapse hide-on-large-only"><i class="material-icons">menu</i></a>
                    <a href="{{route('foodie.dashboard')}}" class="brand-logo">Diet Select</a>
                    <ul id="foodie-menu-btn" class="right">
                        <li>
                            <a class="dropdown-button" href="#" data-activates='foodie-dropdown' data-beloworigin="true" data-constrainwidth="true">
                                <img class="circle" src="/img/{{ $foodie->avatar }}">
                                <span class="white-text hide-on-med-and-down">{{ $foodie->username ? : $foodie->first_name . ' ' . $foodie->last_name }} <i class="fa fa-caret-down" aria-hidden="true"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- Foodie Dropdown Menu -->
        <ul id='foodie-dropdown' class='dropdown-content'>
            <li>
                <a href="{{ route("foodie.profile") }}" class="foodie-link">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="hide-on-med-and-down">Profile</span>
                </a>
            </li>
            {{--<li>--}}
                {{--<a href="#!" class="foodie-link">--}}
                    {{--<i class="fa fa-cogs" aria-hidden="true"></i>--}}
                    {{--<span class="hide-on-med-and-down">Settings</span>--}}
                {{--</a>--}}
            {{--</li>--}}
            <li class="divider"></li>
            <li>
                <form id="logout" method="post" action="{{ route('foodie.logout') }}">
                    {{ csrf_field() }}
                    <a id="logout-link" class="foodie-link" href="#">
                        <i class="fa fa-sign-out" aria-hidden="true"></i>
                        <span class="hide-on-med-and-down">Logout</span>
                    </a>
                </form>
            </li>
        </ul>
    </header>
    <main>
        <!-- Start of Side-nav -->
        <ul id="slide-out" class="side-nav fixed papaya-whip">
            <li><a id="foodieProfile" href="#!">Profile</a></li>
            <li><a id="viewChefs" href="#!">View Chefs</a></li>
            <li><a href="{{url('foodie/message/index')}}">Messaging({{$messages->count()}})</a></li>
            <li><a href="{{url('foodie/order/view')}}">Order History</a></li>
            <li><a href="{{route('chef.rating')}}">Rating</a></li>
            {{--<li><a id="viewChefs" href="#!">View Chefs</a></li>--}}
        </ul>

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
