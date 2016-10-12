@extends('layouts.app')

@section('head')
<title>Partner Login - Diet Select PH | Making the world a healthier place with one meal plan at a time!</title>
<meta name="description" content="">
<link rel="stylesheet" href="/css/chef/login.css">
<script src="/js/chef/login.validate.js" defer></script>
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
@endsection

@section('content')
<div id="n-site-preloader" class="valign-wrapper">
    <div id="n-site-status" class="preloader-wrapper active valign">
        <div class="spinner-layer spinner-red-only">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div><div class="gap-patch">
            <div class="circle"></div>
          </div><div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
    </div>
</div>
<!-- Login Card -->
<div id="login" class="card">
    <form id="login" role="form" method="POST" action="{{ route('chef.login') }}">
        {{ csrf_field() }}
        <div class="card-content">
            <h3 class="mustard-text">Partner Login</h3>
            <h5>Hello! Good to see you here.</h5>

            @if(session('email_unverified'))
            <div id="verification-msg" class="card-panel flame papaya-whip-text">
                <div class="row no-margin-bot">
                    <div class="col s11">
                        <p>Your email has not been verified yet.</p>
                        <p>Please check your email for a link we sent that completes verification!</p>
                    </div>
                    <div class="col s1" style="display: block; height: 100%;">
                        <a id="close" class="right-align" href="#"><i class="fa fa-times-circle"></i></a>
                    </div>
                </div>
            </div>
            @endif

            <div class="row">
                <div class="input-field col s12">
                    <input id="n-login-email" name="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" data-error=".error-msg-email" value="{{ old('email') }}"/>
                    <label for="n-login-email">Email</label>
                    <div class="error-msg-email">
                        @if ($errors->has('email'))
                            {{ $errors->first('email') }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="n-login-pass" name="password" type="password" data-error=".error-msg-pass"/>
                    <label for="n-login-pass">Password</label>
                    <div class="error-msg-pass">
                        @if ($errors->has('password'))
                            {{ $errors->first('password') }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field s12 center">
                    <input id="n-login-remember" class="filled-in" name="remember" type="checkbox" data-error=".error-msg-login-remember"/>
                    <label for="n-login-remember">Remember me next time, please!</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 center">
                    <a href="{{ route('chef.reset.show') }}">Forgot Your Password?</a>
                </div>
            </div>
        </div>
        <div class="card-action">
            <input type="submit" class="hidden"/>
            <a href="javascript:void(0)" class="btn-flat n-btn-link n-submit-btn right"><i class="fa fa-paper-plane-o"></i><span class="hide-on-small-only n-form-btn-text"> Submit</span></a>
            <a href="{{ route('welcome') }}" class="btn-flat n-btn-link"><i class="fa fa-home"></i><span class="hide-on-small-only n-form-btn-text"> Home</span></a>
            <a href="{{ route('chef.register.show') }}" class="modal-action btn-flat n-btn-link"><i class="fa fa-user-plus"></i><span class="hide-on-small-only n-form-btn-text"> Apply as Partner</span></a>
        </div>
    </form>
</div>
<!-- End of registration-card -->
@endsection