@extends('foodie.layout')
@section('page_head')
    <title>Foodie Profile - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="/css/foodie/profile.css">
    <script>
        var allergies='{{$allergies}}';
    </script>
    <script src="/js/foodie/profile.js" defer></script>
@endsection

@section('page_content')
    <div class="row">
        <div class="col m12">
            <!-- Basic Profile -->
            <div id="basic-profile" class="card-panel">
                <h2 class="mustard-text">Foodie Profile</h2>
                <h4>Name: {{ $foodie->first_name . ' ' . $foodie->last_name }} {{ ($foodie->username)? '(' . $foodie->username . ')' : '' }}</h4>
                <script>
                    $(document).ready(function () {
                        var text;
                        var gender = '{{ $foodie->gender }}';
                        switch (gender) {
                            case 'M': text = 'Male'; break;
                            case 'F': text = 'Female'; break;
                            case 'N': text = 'Prefer not to say.'; break;
                            default: text = 'N/A'; break;
                        }
                        $('#foodie-gender').text(text);
                    });
                </script>
                <h4>Gender: <span id="foodie-gender"></span></h4>
                <h4>Birthday: {{ $foodie->birthday }}</h4>
                <div>
                    <button data-target="basic-profile-modal" class="btn modal-trigger">Edit Basic Profile</button>
                </div>
            </div>

            <!-- Basic Profile Form Modal -->
            <div id="basic-profile-modal" class="modal">
                <form id="basic-profile" method="post" action="{{ route('foodie.profile.basic') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <h3 class="mustard-text">Foodie Profile</h3>
                        <p>We want to get to know you more! Please enter the following personal details:</p>

                        <div class="row">
                            <div class="col s4">
                                <img src="/img/{{ $foodie->avatar }}"
                                     style="width:200px; height:200px; float:left; margin-right: 25px;"
                                     class="img img-thumbnail">
                                <br>
                                {{--<label for="profile" style="margin-left: 30px;">Update Profile Image</label>--}}
                                <input type="file" name="avatar">
                            </div>
                            <div class="input-field col s4">
                                <input id="firstname" name="first_name" type="text" class="validate" value="{{ $foodie->first_name }}">
                                <label for="firstname">First Name</label>
                            </div>
                            <div class="input-field col s4">
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
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="hidden"/>
                        <a href="javascript:void(0)" class="modal-action n-btn-link n-submit-btn profile-save-btn right-aligned right"><i class="fa fa-save" aria-hidden="true"></i> </a>
                    </div>
                </form> <!-- End of basic-profile form -->
            </div>

            <div id="addresses-container" class="card-panel">
                <h2 id="address-section" class="mustard-text">Delivery Addresses</h2>
                <ul>
                    @foreach($addresses as $address)
                        <li>
                            <h4>{{ $address->unit . ' ' . $address->bldg . ', ' . $address->street . ', ' . $address->brgy . ', ' . $address->city }}</h4>
                            <button data-target="update-address-modal" class="btn modal-trigger">Edit Address</button>
                            {{--<button data-target="delete-address-modal" class="btn modal-trigger">Delete Address</button>--}}
                        </li>
                    @endforeach
                </ul>
                <div>
                    <button data-target="address-modal" class="btn modal-trigger">Add Delivery Address</button>
                </div>
            </div>

            <div id="address-modal" class="modal">
                <form id="address" method="post" action="{{ route('foodie.profile.address') }}">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <h4 id="address-section">Address</h4>
                        <p>This should be the address where your food will be primarily delivered to.</p>
                        <div class="row">
                            <div class="input-field col s12">
                                <script>
                                    $(document).ready(function () {
                                        $('select#address-city').val('');
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
                                <input id="address-unit" name="unit" type="text" class="validate" value="">
                                <label for="address-unit">Unit No.<span class="flame-text">*</span></label>
                            </div>
                            <div class="input-field col s6">
                                <input id="address-street" name="street" type="text" class="validate" value="">
                                <label for="address-street">Street<span class="flame-text">*</span></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="address-bldg" name="bldg" type="text" class="validate" value="">
                                <label for="address-bldg">Building</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="address-brgy" name="brgy" type="text" class="validate" value="">
                                <label for="address-brgy">Barangay/Village</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <script>
                                    $(document).ready(function () {
                                        $('select#address-type').val('');
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
                                <input id="address-company" name="company" type="text" class="validate" value="">
                                <label for="address-company">Company</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="address-landmark" name="landmark" type="text" class="validate" value="">
                                <label for="address-landmark">Landmark</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="address-remarks" name="remarks" class="materialize-textarea" length="255" value=""></textarea>
                                <label for="address-remarks">Address Remarks</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="hidden"/>
                        <a href="javascript:void(0)" class="modal-action n-btn-link n-submit-btn profile-save-btn right-aligned right"><i class="fa fa-save" aria-hidden="true"></i> </a>
                    </div>
                </form> <!-- End of address form -->
            </div>
            <div id="update-address-modal" class="modal">
                <form id="address" method="post" action="{{ route('foodie.profile.address') }}">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <h4 id="address-section">Address</h4>
                        <p>This should be the address where your food will be primarily delivered to.</p>
                        <div class="row">
                            <div class="input-field col s12">
                                <script>
                                    $(document).ready(function () {
                                        $('select#address-city').val('');
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
                                <input id="address-unit" name="unit" type="text" class="validate" value="">
                                <label for="address-unit">Unit No.<span class="flame-text">*</span></label>
                            </div>
                            <div class="input-field col s6">
                                <input id="address-street" name="street" type="text" class="validate" value="">
                                <label for="address-street">Street<span class="flame-text">*</span></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="address-bldg" name="bldg" type="text" class="validate" value="">
                                <label for="address-bldg">Building</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="address-brgy" name="brgy" type="text" class="validate" value="">
                                <label for="address-brgy">Barangay/Village</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s6">
                                <script>
                                    $(document).ready(function () {
                                        $('select#address-type').val('');
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
                                <input id="address-company" name="company" type="text" class="validate" value="">
                                <label for="address-company">Company</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="address-landmark" name="landmark" type="text" class="validate" value="">
                                <label for="address-landmark">Landmark</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="address-remarks" name="remarks" class="materialize-textarea" length="255" value=""></textarea>
                                <label for="address-remarks">Address Remarks</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="hidden"/>
                        <a href="javascript:void(0)" class="modal-action n-btn-link n-submit-btn profile-save-btn right-aligned right"><i class="fa fa-save" aria-hidden="true"></i> </a>
                    </div>
                </form> <!-- End of address form -->
            </div>

            <div id="delete-address-modal" class="modal">
                <div class="modal-content">
                    <h4>Are you sure you want to delete?</h4>
                    {{-- delete button --}}
                    <a href="#!" class="btn">Delete</a>
                    <a></a>
                </div>
            </div>

            <div id="allergies-container" class="card-panel">
                <h2 id="allergies-section" class="mustard-text">Allergies :</h2>
                <ul>
                    {{--@foreach($allergies as $allergy)--}}
                        {{--<li><h4>{{ $allergy->allergy }}</h4></li>--}}
                    {{--@endforeach--}}
                </ul>
                <div>
                    <button data-target="allergies-modal" class="btn modal-trigger">Edit Allergies</button>
                </div>
            </div>

            <div id="allergies-modal" class="modal">
                <form id="allergies" method="post" action="{{ route('foodie.profile.allergies') }}">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <h4>Allergies</h4>
                        <p>Tell us what you can't eat, so that we can tailor a better diet experience for you!</p>
                        <div class="row">
                            <div class="input-field col l4 s12">
                                <input type="hidden" name="seafood" value="0"/>
                                <input type="checkbox" name="seafood" value="1" class="filled-in allergyCheckbox" id="allrg-sea"/>
                                <label for="allrg-sea">Seafood</label><br/>
                                <input type="hidden" name="squid" value="0"/>
                                <input type="checkbox" name="squid" value="1" class="filled-in allergyCheckbox" id="allrg-squid"/>
                                <label for="allrg-squid">Squid, Shrimp, and Crab</label><br/>
                                <input type="hidden" name="fish" value="0"/>
                                <input type="checkbox" name="fish" value="1" class="filled-in allergyCheckbox" id="allrg-fish"/>
                                <label for="allrg-fish">Fish</label><br/>
                            </div>
                            <div class="input-field col l4 s12">
                                <input type="hidden" name="nuts" value="0"/>
                                <input type="checkbox" name="nuts" value="1" class="filled-in allergyCheckbox" id="allrg-nuts"/>
                                <label for="allrg-nuts">Nuts</label><br/>
                                <input type="hidden" name="pork" value="0"/>
                                <input type="checkbox" name="pork" value="1" class="filled-in allergyCheckbox" id="allrg-pork"/>
                                <label for="allrg-pork">Pork</label><br/>
                                <input type="hidden" name="beef" value="0"/>
                                <input type="checkbox" name="beef" value="1" class="filled-in allergyCheckbox" id="allrg-beef"/>
                                <label for="allrg-beef">Beef</label><br/>
                            </div>
                            <div class="input-field col l4 s12">
                                <input type="hidden" name="dairy" value="0"/>
                                <input type="checkbox" name="dairy" value="1" class="filled-in allergyCheckbox" id="allrg-dairy"/>
                                <label for="allrg-dairy">Dairy</label><br/>
                                <input type="hidden" name="chicken" value="0"/>
                                <input type="checkbox" name="chicken" value="1" class="filled-in allergyCheckbox" id="allrg-chick"/>
                                <label for="allrg-chick">Chicken</label><br/>
                                <input type="hidden" name="egg" value="0"/>
                                <input type="checkbox" name="egg" value="1" class="filled-in allergyCheckbox" id="allrg-egg"/>
                                <label for="allrg-egg">Egg</label><br/><br/>
                            </div>
                            <div class="input-field col s12">
                                <input id="allrg-others" name="others" type="text" class="validate">
                                <label for="allrg-others">Other Allergies</label>
                            </div>
                            <small class="notes"><span class="flame-text">*</span> If multiple other food allergies, please separate each allergy with a comma (,).</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="hidden"/>
                        <a href="javascript:void(0)" class="modal-action n-btn-link n-submit-btn profile-save-btn right-aligned right"><i class="fa fa-save" aria-hidden="true"></i> </a>
                    </div>
                </form> <!-- End of allergies form -->
            </div>


            <div id="food-preferences-container" class="card-panel">
                <h2 id="food-preferences-section" class="mustard-text">Food Preference</h2>
                @if(isset($preference))
                    <h4>{{ $preference->ingredient }}</h4>
                @endif
                <div>
                    <button data-target="food-preference-modal" class="btn modal-trigger">Edit Food Preferences</button>
                </div>
            </div>

            <div id="food-preference-modal" class="modal">
                <form id="food-preferences" method="post" action="{{ route('foodie.profile.preferences') }}">
                    {{ csrf_field() }}
                    <div class="modal-content">
                        <h4>Food Preferences</h4>
                        <p>Now let us know the food that you prefer to have in your meals. (Leave all of them unchecked if you don't have a preference.)</p>
                        <div class="row">
                            <div class="input-field col l4 s12">
                                <input type="radio" name="foodPref" value="beef" class="filled-in" id="pref-beef"/>
                                <label for="pref-beef">Beef-based</label><br/>
                                <input type="radio" name="foodPref" value="pork" class="filled-in" id="pref-pork"/>
                                <label for="pref-pork">Pork-based</label><br/>
                                <input type="radio" name="foodPref" value="chicken" class="filled-in" id="pref-chick"/>
                                <label for="pref-chick">Chicken-based</label><br/>
                                <input type="radio" name="foodPref" value="seafood" class="filled-in" id="pref-sea"/>
                                <label for="pref-sea">Seafood-based</label><br/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="hidden"/>
                        <a href="javascript:void(0)" class="modal-action n-btn-link n-submit-btn profile-save-btn right-aligned right"><i class="fa fa-save" aria-hidden="true"></i> </a>
                    </div>
                </form> <!-- End of allergies form -->
            </div>
        </div>
    </div>
@endsection
