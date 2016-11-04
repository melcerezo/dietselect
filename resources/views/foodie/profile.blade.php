@extends('foodie.layout')
@section('page_head')
    <title>Foodie Profile - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="/css/foodie/profile.css">
    <script src="/js/foodie/profile.js" defer></script>
@endsection

@section('page_content')
    <div class="container">
        <div class="row">
            <div class="col m8 offset-m2">
                <div>
                    <h1 class="mustard-text">Foodie Profile</h1>
                    <p>We want to get to know you more! Please enter the following personal details:</p>
                    <form id="basic-profile" method="post" action="{{ route('foodie.profile.basic') }}">

                        {{ csrf_field() }}
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="firstname" name="first_name" type="text" class="validate" value="{{ $foodie->first_name }}">
                                <label for="firstname">First Name</label>

                            </div>
                            <div class="input-field col s6">
                                <input id="lastname" name="last_name" type="text" class="validate" value="{{ $foodie->last_name }}">
                                <label for="lastname">Last Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col m6 s12">
                                <script>
                                    $(document).ready(function () {
                                        $('select#gender').val('{{ $foodie->gender ? $foodie->gender : 0 }}');
                                    });
                                </script>
                                <select id="gender" name="gender">
                                    <option value="0" disabled selected>Please choose</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                    <option value="N">Prefer not to say</option>
                                </select>
                                <label>Gender</label>
                            </div>
                            <div class="input-field col m6 s12">
                                <input id="birthday" name="birthday" type="text" class="datepicker" value="{{ $foodie->birthday }}">
                                <label for="birthday">Birthday</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="username" name="username" type="text" class="validate" value="{{ $foodie->username }}">
                                <label for="username">Username</label>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <input type="submit" class="hidden"/>
                            <a href="javascript:void(0)" class="modal-action n-btn-link n-submit-btn profile-save-btn right-aligned"><i class="fa fa-save" aria-hidden="true"></i> </a>
                        </div>
                    </form> <!-- End of basic-profile form -->
                </div>

                <div>
                    <form id="address" method="post" action="{{ route('foodie.profile.address') }}">
                        <h4 id="address-section">Address</h4>
                        <p>This should be the address where your food will be primarily delivered to.</p>
                        <div class="row">
                            <div class="input-field col s12">
                                <script>
                                    $(document).ready(function () {
                                        $('select#address-city').val('{{ $address['city'] ? $address['city'] : 0 }}');
                                    });
                                </script>
                                <select id="address-city" name="city">
                                    <option value="0" disabled selected>Please choose</option>
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
                                <input id="address-unit" name="unit" type="text" class="validate" value="{{ $address['unit'] }}">
                                <label for="address-unit">Unit No.<span class="flame-text">*</span></label>
                            </div>
                            <div class="input-field col s6">
                                <input id="address-street" name="street" type="text" class="validate" value="{{ $address['street'] }}">
                                <label for="address-street">Street<span class="flame-text">*</span></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="address-bldg" name="bldg" type="text" class="validate" value="{{ $address['bldg'] }}">
                                <label for="address-bldg">Building</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="address-brgy" name="brgy" type="text" class="validate" value="{{ $address['brgy'] }}">
                                <label for="address-brgy">Barangay/Village</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <script>
                                    $(document).ready(function () {
                                        $('select#address-city').val('{{ $address['type'] ? $address['type'] : 0 }}');
                                    });
                                </script>
                                <select id="address-type" name="type">
                                    <option value="0" disabled selected>Please choose</option>
                                    <option value="R">Residential</option>
                                    <option value="O">Office</option>
                                </select>
                                <label for="address-type">Address Type</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="address-company" name="company" type="text" class="validate" value="{{ $address['company'] }}">
                                <label for="address-company">Company</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="address-landmark" name="landmark" type="text" class="validate" value="{{ $address['landmark'] }}">
                                <label for="address-landmark">Landmark</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="address-remarks" name="remarks" class="materialize-textarea" length="255" value="{{ $address['remarks'] }}"></textarea>
                                <label for="address-remarks">Address Remarks</label>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <input type="submit" class="hidden"/>
                            <a href="javascript:void(0)" class="modal-action n-btn-link n-submit-btn profile-save-btn right-aligned"><i class="fa fa-save" aria-hidden="true"></i> </a>
                        </div>
                    </form> <!-- End of address form -->
                </div>

                <div>
                    <h4>Allergies</h4>
                    <p>Tell us what you can't eat, so that we can tailor a better diet experience for you!</p>
                    <form id="allergies" method="post" action="{{ route('foodie.profile.allergies') }}">
                        <div class="row">
                            <div class="input-field col l4 s12">
                                <input type="checkbox" name="allrg['sea']" class="filled-in" id="allrg-sea"/>
                                <label for="allrg-sea">Seafood</label><br/>
                                <input type="checkbox" name="allrg['squid']" class="filled-in" id="allrg-squid"/>
                                <label for="allrg-squid">Squid, Shrimp, and Crab</label><br/>
                                <input type="checkbox" name="allrg['fish']" class="filled-in" id="allrg-fish"/>
                                <label for="allrg-fish">Fish</label><br/>
                            </div>
                            <div class="input-field col l4 s12">
                                <input type="checkbox" name="allrg['nuts']" class="filled-in" id="allrg-nuts"/>
                                <label for="allrg-nuts">Nuts</label><br/>
                                <input type="checkbox" name="allrg['pork']" class="filled-in" id="allrg-pork"/>
                                <label for="allrg-pork">Pork</label><br/>
                                <input type="checkbox" name="allrg['beef']" class="filled-in" id="allrg-beef"/>
                                <label for="allrg-beef">Beef</label><br/>
                            </div>
                            <div class="input-field col l4 s12">
                                <input type="checkbox" name="allrg['dairy']" class="filled-in" id="allrg-dairy"/>
                                <label for="allrg-dairy">Dairy</label><br/>
                                <input type="checkbox" name="allrg['chick']" class="filled-in" id="allrg-chick"/>
                                <label for="allrg-chick">Chicken</label><br/>
                                <input type="checkbox" name="allrg['egg']" class="filled-in" id="allrg-egg"/>
                                <label for="allrg-egg">Egg</label><br/><br/>
                            </div>
                            <div class="input-field col s12">
                                <input id="allrg-others" name="allrg['others']" type="text" class="validate">
                                <label for="allrg-others">Other Allergies</label>
                            </div>
                            <small class="notes"><span class="flame-text">*</span> If multiple other food allergies, please separate each allergy with a comma (,).</small>
                        </div>
                        <div style="text-align: right;">
                            <input type="submit" class="hidden"/>
                            <a href="javascript:void(0)" class="modal-action n-btn-link n-submit-btn profile-save-btn right-aligned"><i class="fa fa-save" aria-hidden="true"></i> </a>
                        </div>
                    </form> <!-- End of allergies form -->
                </div>

                <div>
                    <h4>Food Preferences</h4>
                    <p>Now let us know the food that you prefer to have in your meals. (Leave all of them unchecked if you don't have a preference.)</p>
                    <form id="food-preferences" method="post" action="{{ route('foodie.profile.preferences') }}">
                        <div class="row">
                            <div class="input-field col l4 s12">
                                <input type="checkbox" name="pref['beef']" class="filled-in" id="pref-beef"/>
                                <label for="pref-beef">Beef-based</label><br/>
                                <input type="checkbox" name="pref['pork']" class="filled-in" id="pref-pork"/>
                                <label for="pref-pork">Pork-based</label><br/>
                                <input type="checkbox" name="pref['chick']" class="filled-in" id="pref-chick"/>
                                <label for="pref-chick">Chicken-based</label><br/>
                                <input type="checkbox" name="pref['fish']" class="filled-in" id="pref-fish"/>
                                <label for="pref-fish">Fish-based</label><br/>
                            </div>
                        </div>
                        <div style="text-align: right;">
                            <input type="submit" class="hidden"/>
                            <a href="javascript:void(0)" class="modal-action n-btn-link n-submit-btn profile-save-btn right-aligned"><i class="fa fa-save" aria-hidden="true"></i> </a>
                        </div>
                    </form> <!-- End of food-preferences form -->
                </div>
            </div>
        </div>
    </div>
@endsection
