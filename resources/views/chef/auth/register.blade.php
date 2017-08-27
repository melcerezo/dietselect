@extends('layouts.app')

@section('head')
<title>Apply as Partner - Diet Select PH | Making the world a healthier place with one meal plan at a time!</title>
<meta name="description" content="">
<link rel="stylesheet" href="/css/chef/register.css">
<script src="/js/chef/registration.validate.js" defer></script>
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
<!-- Registration Card -->
<div id="registration" class="card">
    <form id="registration" role="form" method="POST" action="{{ route('chef.register') }}">
        {{ csrf_field() }}
        <div class="card-content">
            <h3 class="mustard-text">Become a Chef Partner</h3>
            <p>Planning to make the world a healthier place with one meal plan at a time?</p>
            <p>Let us help you get your healthy food services to broader markets.</p>
            <p>We'd like to get to know your business more before you can get started on our awesome platform!</p>
            <div class="row tooltipped" data-position="bottom" data-delay="50" data-tooltip="This will be the name that will be displayed on your partner profile! Just make sure that the name you put here matches the one on your business permit or company registration documents.">
                <div class="input-field col s12">
                    <input id="n-reg-name" name="name" type="text" data-error=".error-msg-name" value="{{ old('name') }}">
                    <label for="n-reg-name">Business/Company Name</label>
                    <div class="error-msg-name">
                        @if ($errors->has('name'))
                            {{ $errors->first('name') }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="row tooltipped" data-position="bottom" data-delay="50" data-tooltip="You'll be using your email to log into your account. We will also be sending you tips and offerings to help you with your services!">
                <div class="input-field col s12">
                    <input id="n-reg-email" name="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" data-error=".error-msg-email" value="{{ old('email') }}"/>
                    <label for="n-reg-email">Email</label>
                    <div class="error-msg-email">
                        @if ($errors->has('email'))
                            {{ $errors->first('email') }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="row tooltipped" data-position="bottom" data-delay="50" data-tooltip="We'll be sending you important notifications via SMS. You will also receive a text message with a verification code after the registration to verify your account.">
                <div class="input-field col s12">
                    <div class="col s1 light-green lighten-1 valign-wrapper center" style="height: 2rem; margin-top: 10px;">
                        <span>+63</span>
                    </div>
                    <div class="col s11">
                        <label for="n-reg-mobile-num">Mobile Number</label>
                        <input id="n-reg-mobile-num" name="mobile_number" type="text" placeholder="i.e. 9159876543" data-error=".error-msg-mobile-num" value="{{ old('mobile_number') }}"/>
                        <div class="error-msg-mobile-num">
                            @if ($errors->has('mobile_number'))
                                {{ $errors->first('mobile_number') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row tooltipped" data-position="bottom" data-delay="50" data-tooltip="Already have a website? Enter the link here, so we can display it on your profile! If you don't have a website yet, just leave this field blank, please.">
                <div class="input-field col s12">
                    <input id="n-reg-website" name="website" type="text" data-error=".error-msg-website" value="{{ old('website') }}" placeholder="http://">
                    <label for="n-reg-website">Website</label>
                    <div class="error-msg-website">
                        @if ($errors->has('website'))
                            {{ $errors->first('website') }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="row tooltipped" data-position="bottom" data-delay="50" data-tooltip="Think of this as your username! Foodies will be able to view your profile via your URL Name. (i.e. dietselect.ph/partners/YourUrlName) Only alphanumeric characters, a  will be allowed.">
                <div class="input-field col s12">
                    <input id="n-reg-url" name="url_name" type="text" data-error=".error-msg-url" value="{{ old('url_name') }}">
                    <label for="n-reg-url">URL Name</label>
                    <div class="error-msg-url">
                        @if ($errors->has('url_name'))
                            {{ $errors->first('url_name') }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="row tooltipped" data-position="bottom" data-delay="50" data-tooltip="Keep your account secured! Set a password that can't be easily guessed. Try using a combination of letters, numbers, and symbols.">
                <div class="input-field col s9">
                    <input id="n-reg-pass" name="password" type="password" data-error=".error-msg-pass"/>
                    <label for="n-reg-pass">Password</label>
                    <div class="error-msg-pass">
                        @if ($errors->has('password'))
                            {{ $errors->first('password') }}
                        @endif
                    </div>
                </div>
                <div class="col s3 valign-wrapper">
                    <span id="result" style="margin-top:43px;"></span>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="n-reg-confirm-password" name="password_confirmation" type="password" data-error=".error-msg-confirm-pass"/>
                    <label for="n-reg-confirm-password">Confirm Password</label>
                    <div class="error-msg-confirm-pass">
                        @if ($errors->has('password_confirmation'))
                            {{ $errors->first('password_confirmation') }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="n-reg-read-partner-agrmnt" class="filled-in" name="partner_agreement" type="checkbox" value="true" data-error=".error-msg-read-partner-agrmnt" required/>
                    <label for="n-reg-read-partner-agrmnt"><small>I have read the <a href="#">Partner Agreement & Privacy Statement</a>, I give my consent to Diet Select Inc. to use these information, and I agree to the terms of the agreement.</small></label>
                    <div class="error-msg-read-partner-agrmnt">
                        @if ($errors->has('partner_agreement'))
                            {{ $errors->first('partner_agreement') }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                {!! app('captcha')->display(); !!}
            </div>
        </div>
        <div class="card-action">
            <input type="submit" class="hidden"/>
            <a href="javascript:void(0)" class="btn-flat n-btn-link n-submit-btn right"><i class="fa fa-paper-plane-o"></i><span class="hide-on-small-only n-form-btn-text"> Submit</span></a>
            <a href="{{ route('welcome') }}" class="btn-flat n-btn-link"><i class="fa fa-home"></i><span class="hide-on-small-only n-form-btn-text"> Home</span></a>
            {{--<a href="{{ route('chef.login.show') }}" class="btn-flat n-btn-link"><i class="fa fa-sign-in"></i><span class="hide-on-small-only n-form-btn-text"> Partner Login</span></a>--}}
        </div>
    </form>
</div>
<!-- End of registration-card -->
@endsection