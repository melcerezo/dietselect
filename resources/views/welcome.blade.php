@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="/css/welcome.css">

    @if ($from == 'register')
    <script src="/js/foodie/registration.validate.js" defer></script>
    <script>
        jQuery(window).load(function() {
            $('#foodie-reg-form-modal').openModal({
                dismissible: false
            });
        });
    </script>
    <title>Register - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    @elseif ($from == 'login')
    <script src="/js/foodie/login.validate.js" defer></script>
    <script>
        jQuery(window).load(function() {
            $('#login-modal').openModal();
        });
    </script>
    <title>Login - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    @elseif ($from == 'reset')
    <script src="/js/foodie/reset.pass.validate.js" defer></script>
    <script>
        jQuery(window).load(function() {
            $('#reset-password-modal').openModal({
                dismissible: false
            });
        });
    </script>
    <title>Reset Password Request - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    @elseif ($from == 'welcome')
    <title>Welcome - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    @endif
@endsection

@section('content')
    <header>
        <!-- Menu for Register & Login -->
        <div id="n-menu" class="right-align">
            <a id="n-menu-btn-reg" class="n-btn-link n-menu-btn modal-trigger" href="#client-type-modal"><i class="fa fa-user-plus"></i><span class="hide-on-small-only"> Register</span></a>
            <a id="n-menu-btn-login" class="n-btn-link n-menu-btn" href="{{ route('foodie.login.show') }}"><i class="fa fa-sign-in"></i><span class="hide-on-small-only"> Log In</span></a>
        </div>
    </header>
    <main>
        <!-- Welcome Page Content -->
        <div id="welcome-content">
            <div class="row no-padding">
                <div class="col s12 l8 offset-l2">
                    <div class="container center-align">
                        <div id="welcome-msg" class="card-panel">
                            <span class="asparagus-text">It's about time you started choosing what's best for YOU.</span>
                            <a id="n-btn-link" class="modal-trigger" href="#client-type-modal">SIGN UP NOW!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of welcome-content -->

        <!-- Client Type Modal -->
        <div id="client-type-modal" class="modal">
            <div class="modal-content">
                <h3>Are you..</h3>
                <div class="row">
                    <div class="col s12 m6">
                        <!-- Foodie Client -->
                        <div class="card sticky-action hoverable">
                            <div class="card-image waves-effect waves-block waves-asparagus">
                                <img class="activator n-client-type-icon" src="/img/user_icon.svg">
                            </div>
                            <div class="card-content">
                                <h2 class="card-title activator grey-text text-darken-4 no-pad-bot">...going on a diet?</h2>
                            </div>
                            <div class="card-action flame center">
                                <a id="foodie-card-select" class=" n-select-btn" href="{{ route('foodie.register.show') }}">SELECT</a>
                            </div>
                            <div class="card-reveal mindaro">
                                <span class="card-title grey-text text-darken-4">Foodie on a Diet<i class="material-icons right">close</i></span>
                                <p>You've recently just decided to start going on a diet, or you're looking around for better selections for your diet. And good for you! Register here to get started on our awesome services to find you the diet meal plan that best fits you!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6">
                        <!-- Chef Client -->
                        <div class="card sticky-action hoverable">
                            <div class="card-image waves-effect waves-block waves-asparagus">
                                <img class="activator n-client-type-icon" src="/img/vendor_icon.svg">
                            </div>
                            <div class="card-content">
                                <h2 class="card-title activator grey-text text-darken-4 no-pad-bot">...offering diet services?</h2>
                            </div>
                            <div class="card-action flame center">
                                <a id="diet-prvdr-card-select" class="papaya-whip-text n-select-btn" href="{{ route('chef.register.show') }}">SELECT</a>
                            </div>
                            <div class="card-reveal mindaro">
                                <span class="card-title grey-text text-darken-4">Chef for Health<i class="material-icons right">close</i></span>
                                <p>Your advocacy is to help people out with their diet plans, and it has reached the point of wanting to prepare and plan out the delivery of their meal plans yourself. And for that, we think you're awesome! Let us help you get the clientelle that your advocacy needs!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of client-type-modal -->

        {{-- admin-modal --}}
        <div id="admin-modal" class="modal" style="max-width: 40%;">
            <form id="login" role="form" method="POST" action="{{ route('admin.login') }}">
                {{ csrf_field() }}
                <div class="modal-content">
                    <h3 class="mustard-text">Admin Login</h3>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="username" name="email" type="text" />
                            <label for="username">User</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="n-login-pass" name="password" type="password" data-error=".error-msg-login-pass"/>
                            <label for="n-login-pass">Password</label>
                            <div class="error-msg-login-pass">
                                @if ($errors->has('password'))
                                    {{ $errors->first('password') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="hidden"/>
                    {{--<a href="javascript:void(0)" class="modal-action modal-close btn-flat right-align n-btn-link"><i class="fa fa-times-circle"></i> <span class="hide-on-small-only n-modal-form-btn-text">Close</span></a>--}}
                    <a href="javascript:void(0)" class="modal-action btn-flat n-btn-link n-submit-btn"><i class="fa fa-paper-plane-o"></i><span class="hide-on-small-only n-modal-form-btn-text"> Submit</span></a>
                </div>
            </form>
        </div>
        {{-- end admin-modal --}}

    @if ($from == 'register')
        <!-- Foodie Registration Form Modal -->
        <div id="foodie-reg-form-modal" class="modal modal-fixed-footer">
            <form id="registration" role="form" method="POST" action="{{ route('foodie.register') }}">
                {{ csrf_field() }}
                <div class="modal-content">
                    <h3 class="mustard-text">Sign Up</h3>
                    <h5>Get started on your journey to a healthier you!</h5>
                    <div class="row tooltipped" data-position="bottom" data-delay="50" data-tooltip="We'd like to know you on a personal note! Please tell us your name.">
                        <div class="input-field col s6">
                            <input id="n-reg-fname" name="first_name" type="text" data-error=".error-msg-fname" value="{{ old('first_name') }}"/>
                            <label for="n-reg-fname">First Name</label>
                            <div class="error-msg-fname">
                                @if ($errors->has('first_name'))
                                    {{ $errors->first('first_name') }}
                                @endif
                            </div>
                        </div>
                        <div class="input-field col s6">
                            <input id="n-reg-lname" name="last_name" type="text" data-error=".error-msg-lname" value="{{ old('last_name') }}">
                            <label for="n-reg-lname">Last Name</label>
                            <div class="error-msg-lname">
                                @if ($errors->has('last_name'))
                                    {{ $errors->first('last_name') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row tooltipped" data-position="bottom" data-delay="50" data-tooltip="We'll be sending you important notifications via SMS. You will also receive a text message with verification code after the registration to verify your account.">
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
                    <div class="row tooltipped" data-position="bottom" data-delay="50" data-tooltip="You'll be using your email to log into your account. And if you would allow us, we can send you updates on our services, offerings, and promos!">
                        <div class="input-field col s12">
                            <input id="n-reg-email" name="registration_email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" data-error=".error-msg-email" value="{{ old('registration_email') }}"/>
                            <label for="n-reg-email">Email</label>
                            <div class="error-msg-email">
                                @if ($errors->has('registration_email'))
                                    {{ $errors->first('registration_email') }}
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
                            <input id="n-reg-read-user-agrmnt" class="filled-in" name="user_agreement" type="checkbox" value="true" data-error=".error-msg-read-user-agrmnt" required/>
                            <label for="n-reg-read-user-agrmnt"><small>I have read the <a href="#">User Agreement & Privacy Statement</a>, I give my consent to Diet Select Inc. to use these information, and I agree to the terms of the agreement.</small></label>
                            <div class="error-msg-read-user-agrmnt">
                                @if ($errors->has('user_agreement'))
                                    {{ $errors->first('user_agreement') }}
                                @endif
                            </div>
                            <input name="joined_newsletter" class="hidden" value="0"/>
                            <input id="n-reg-newsletter" class="filled-in" name="joined_newsletter" type="checkbox" value="1" data-error=".error-msg-newsletter"/>
                            <label for="n-reg-newsletter"><small>I want to join the official newsletter of Diet Select Inc. so that I can be updated with their services and offerings.</small></label>
                        </div>
                    </div>
                    <div class="row">
                        {!! app('captcha')->display(); !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="hidden"/>
                    <a href="javascript:void(0)" class="modal-action modal-close btn-flat right-align n-btn-link"><i class="fa fa-times-circle"></i> <span class="hide-on-small-only n-modal-form-btn-text">Close</span></a>
                    <a href="javascript:void(0)" class="modal-action btn-flat n-btn-link n-submit-btn"><i class="fa fa-paper-plane-o"></i><span class="hide-on-small-only n-modal-form-btn-text"> Submit</span></a>
                </div>
            </form>
        </div>
        <!-- End of foodie-reg-form-modal -->
    @endif

    @if ($from == 'login')
        <!-- Login Modal -->
        <div id="login-modal" class="modal modal-fixed-footer">
            <form id="login" role="form" method="POST" action="{{ route('foodie.login') }}">
                {{ csrf_field() }}
                <div class="modal-content">
                    <h3 class="mustard-text">Login</h3>
                    <h5>Hello! Good to see you here.</h5>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="n-login-email" name="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" data-error=".error-msg-login-email" value="{{ old('email') }}"/>
                            <label for="n-login-email">Email</label>
                            <div class="error-msg-login-email">
                            @if ($errors->has('email'))
                                {{ $errors->first('email') }}
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="n-login-pass" name="password" type="password" data-error=".error-msg-login-pass"/>
                            <label for="n-login-pass">Password</label>
                            <div class="error-msg-login-pass">
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
                            <a href="{{ route('foodie.reset.show') }}">Forgot Your Password?</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="hidden"/>
                    <a href="{{route('chef.login.show')}}" class="modal-action modal-close btn-flat right-align n-btn-link"><i class="fa fa-cutlery"></i> <span class="hide-on-small-only n-modal-form-btn-text">Chef Login</span></a>
                    <a href="javascript:void(0)" class="modal-action modal-close btn-flat right-align n-btn-link"><i class="fa fa-times-circle"></i> <span class="hide-on-small-only n-modal-form-btn-text">Close</span></a>
                    <a href="javascript:void(0)" class="modal-action btn-flat n-btn-link n-submit-btn"><i class="fa fa-paper-plane-o"></i><span class="hide-on-small-only n-modal-form-btn-text"> Submit</span></a>
                </div>
            </form>
        </div>
        <!-- End of login-modal -->
    @endif

    @if ($from == 'reset')
        <!-- Reset Password Modal -->
        <div id="reset-password-modal" class="modal modal-fixed-footer">
            <form id="reset-password" role="form" method="POST" action="{{ route('foodie.reset.send') }}">
                {{ csrf_field() }}
                <div class="modal-content">
                    <h3 class="mustard-text">Reset Password Request</h3>
                    <p>Forgot your password?</p>
                    <p>No worries! Just give us the email you registered with, and we'll send you a link to reset your password in no time.</p>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="n-reset-pass-email" name="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" data-error=".error-msg-email" value="{{ old('email') }}"/>
                            <label for="n-reset-pass-email">Email</label>
                            <div class="error-msg-email">
                            @if ($errors->has('email'))
                                {{ $errors->first('email') }}
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="hidden"/>
                    <a href="javascript:void(0)" class="modal-action modal-close btn-flat right-align n-btn-link"><i class="fa fa-times-circle"></i> <span class="hide-on-small-only n-modal-form-btn-text">Close</span></a>
                    <a href="javascript:void(0)" class="modal-action btn-flat n-btn-link n-submit-btn"><i class="fa fa-paper-plane-o"></i><span class="hide-on-small-only n-modal-form-btn-text"> Submit</span></a>
                </div>
            </form>
        </div>
        <!-- End of reset-password-modal -->
    @endif
    </main>
    <footer>
        <div class="container center">
            <button class="home" type="button" onclick="window.location='{{ route('welcome') }}'"><i class="fa fa-home"></i></button>
            <button class="fb" type="button"><i class="fa fa-facebook-f"></i></button>
            <button class="email" type="button"><i class="fa fa-envelope fb"></i></button>
            <button class="partner modal-trigger" type="button" data-target="admin-modal"><i class="fa fa-apple"></i></button>
        </div>
    </footer>
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
@endsection