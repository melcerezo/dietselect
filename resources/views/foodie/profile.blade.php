@extends('layouts.app')
@section('head')
    <title>Foodie Profile - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="/css/foodie/app.css">
    <link rel="stylesheet" href="/css/foodie/profile.css">
    <script src="/js/foodie/app.js" defer></script>
    <script src="/js/foodie/profile.js" defer></script>

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
@endsection

@section('content')
    <header>

    </header>
    <ul id="slide-out" class="side-nav fixed">
        <li><div class="userView">
                <img class="background" src="/img/bg.jpg">
                <a href="#!user"><img class="circle" src="/img/user.jpg"></a>
                <a href="#!name"><span class="white-text name">{{ $foodie->first_name . ' ' . $foodie->last_name }}</span></a>
                <a href="#!email"><span class="white-text email">{{ $foodie->email }}</span></a>
            </div></li>
        <li><a href="#!">First Sidebar Link</a></li>
        <li><a href="#!">Second Sidebar Link</a></li>
    </ul>
    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
    <main>
        <div class="container">
            <div class="row">
                <div class="col m8 offset-m2">
                    <h1 class="mustard-text">Foodie Profile</h1>
                    <p>We want to get to know you more! Please enter the following personal details:</p>
                    <form role="form" method="post" action="{{ route('foodie.profile.save') }}">
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="firstname" type="text" class="validate" value="{{ $foodie->first_name }}">
                                <label for="firstname">First Name</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="lastname" type="text" class="validate" value="{{ $foodie->last_name }}">
                                <label for="lastname">Last Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m6 s12">
                                <script>
                                    $(document).ready(function () {
                                        $('select#gender').val('{{ $foodie->gender ? $foodie->gender : 0 }}')
                                    });
                                </script>
                                <select id="gender">
                                    <option value="0" disabled selected>Please choose</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                    <option value="N">Prefer not to say</option>
                                </select>
                                <label>Gender</label>
                            </div>
                            <div class="input-field col m6 s12">
                                <input id="birthday" type="text" class="datepicker" value="{{ $foodie->birthday }}">
                                <label for="birthday">Birthday</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="username" type="text" class="validate" value="{{ $foodie->username }}">
                                <label for="username">Username</label>
                            </div>
                        </div>
                        <br/><hr/><br/>
                        <h4 id="address-section">Address</h4>
                        <p>This should be the address where your food will be primarily delivered to.</p>
                        <div class="row">
                            <div class="input-field col s12">
                                <script>
                                    $(document).ready(function () {
                                        $('select#gender').val('{{ $foodie->gender ? $foodie->gender : 0 }}')
                                    });
                                </script>
                                <select id="address-city">
                                    <option value="0" disabled="" selected="">Please choose</option>
                                    <option value="Caloocan">Caloocan</option>
                                    <option value="Las Piñas">Las Piñas</option>
                                    <option value="Makati">Makati</option>
                                    <option value="Malabon">Malabon</option>
                                    <option value="Mandaluyong">Mandaluyong</option>
                                    <option value="Manila">Manila</option>
                                    <option value="Marikina">Marikina</option>
                                    <option value="Muntinlupa">Muntinlupa</option>
                                    <option value="Navotas">Navotas</option>
                                    <option value="Parañaque">Parañaque</option>
                                    <option value="Pasay">Pasay</option>
                                    <option value="Pasig">Pasig</option>
                                    <option value="Pateros">Pateros</option>
                                    <option value="Quezon">Quezon</option>
                                    <option value="San Juan">San Juan</option>
                                    <option value="Taguig">Taguig</option>
                                    <option value="Valenzuela">Valenzuela</option>
                                </select>
                                <label for="address-city">City</label>
                                <small class="notes"><span class="flame-text">*</span> Please take note that we only cover Metro Manila as of the moment.</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="address-unit" type="text" class="validate">
                                <label for="address-unit">Unit No.<span class="flame-text">*</span></label>
                            </div>
                            <div class="input-field col s6">
                                <input id="address-street" type="text" class="validate">
                                <label for="address-street">Street<span class="flame-text">*</span></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="address-brgy" type="text" class="validate">
                                <label for="address-brgy">Barangay/Village</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="address-bldg" type="text" class="validate">
                                <label for="address-bldg">Building</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <select id="address-type">
                                    <option value="" disabled="" selected="">Please choose</option>
                                    <option value="1">Residential</option>
                                    <option value="2">Office</option>
                                </select>
                                <label for="address-type">Address Type</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="address-company" type="text" class="validate">
                                <label for="address-company">Company</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="address-landmark" type="text" class="validate">
                                <label for="address-landmark">Landmark</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="address-remarks" class="materialize-textarea" length="255"></textarea>
                                <label for="address-remarks">Address Remarks</label>
                            </div>
                        </div>
                        <br/>
                        <hr/>
                        <br/>
                        <h4>Allergies</h4>
                        <p>Tell us what you can't eat, so that we can tailor a better diet experience for you!</p>
                        <div class="row">
                            <div class="input-field col l4 s12">
                                <input type="checkbox" class="filled-in" id="allrg-sea"/>
                                <label for="allrg-sea">Seafood</label><br/>
                                <input type="checkbox" class="filled-in" id="allrg-squid"/>
                                <label for="allrg-squid">Squid, Shrimp, and Crab</label><br/>
                                <input type="checkbox" class="filled-in" id="allrg-fish"/>
                                <label for="allrg-fish">Fish</label><br/>
                            </div>
                            <div class="input-field col l4 s12">
                                <input type="checkbox" class="filled-in" id="allrg-nuts"/>
                                <label for="allrg-nuts">Nuts</label><br/>
                                <input type="checkbox" class="filled-in" id="allrg-pork"/>
                                <label for="allrg-pork">Pork</label><br/>
                                <input type="checkbox" class="filled-in" id="allrg-beef"/>
                                <label for="allrg-beef">Beef</label><br/>
                            </div>
                            <div class="input-field col l4 s12">
                                <input type="checkbox" class="filled-in" id="allrg-dairy"/>
                                <label for="allrg-dairy">Dairy</label><br/>
                                <input type="checkbox" class="filled-in" id="allrg-chick"/>
                                <label for="allrg-chick">Chicken</label><br/>
                                <input type="checkbox" class="filled-in" id="allrg-egg"/>
                                <label for="allrg-egg">Egg</label><br/><br/>
                            </div>
                            <div class="input-field col s12">
                                <input id="allrg-others" type="text" class="validate">
                                <label for="allrg-others">Other Allergies</label>
                            </div>
                        </div>
                        <br/>
                        <hr/>
                        <br/>
                        <h4>Food Preferences</h4>
                        <p>Now let us know the food that you prefer to have in your meals. (Leave all of them unchecked if you don't have a preference.)</p>
                        <div class="row">
                            <div class="input-field col l4 s12">
                                <input type="checkbox" class="filled-in" id="pref-beef"/>
                                <label for="pref-beef">Beef-based</label><br/>
                                <input type="checkbox" class="filled-in" id="pref-pork"/>
                                <label for="pref-pork">Pork-based</label><br/>
                                <input type="checkbox" class="filled-in" id="pref-chick"/>
                                <label for="pref-chick">Chicken-based</label><br/>
                                <input type="checkbox" class="filled-in" id="pref-fish"/>
                                <label for="pref-fish">Fish-based</label><br/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 right-align">
                                <button class="btn btn-large waves-effect waves-light mustard black-text" type="button" name="action" onclick="window.location.replace('verify.html')">Submit
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
