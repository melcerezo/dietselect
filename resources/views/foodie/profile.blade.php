@extends('foodie.layout')
@section('page_head')
    <title>Foodie Profile - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="/css/foodie/foodieProfile.css">
    <script>
        var allergies = "{{$allergyJson}}";
    </script>
    <script src="/js/foodie/profile.js" defer></script>
@endsection

@section('page_content')
    <div class="container prfMnCnt">
        <div class="row">
            <div class="col s12 m2">
                <div class="row">
                    <div>
                        EDIT PROFILE
                    </div>
                </div>
                <div class="divider"></div>
                <div class="row">
                    <ul class="collection">
                        <li class="collection-item">
                            <a href="{{route("foodie.order.view", ['id'=> 0])}}">Order History</a>
                        </li>
                        <li class="collection-item">
                            <a href="{{route('foodie.plan.show')}}">Browse Plans</a>
                        </li>
                        <li class="collection-item" style="border: 1px solid #f57c00;">
                            <a href="{{route('foodie.profile')}}" style="color: #f57c00;">Profile</a>
                        </li>
                        <li class="collection-item">
                            <a href="{{route('foodie.message.index')}}">Messages</a>
                            {{--@if($messages->count()>0)--}}
                                {{--<span class="new badge red">{{$messages->count()}}</span>--}}
                            {{--@endif--}}
                        </li>
                        <li class="collection-item">
                            <a href="{{route('chef.rating', ['id'=>1])}}">Ratings</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col s12 m10" style="border: 1px solid #e0e0e0;">
                    <div class="row prfMnCntDv">

                        <div class="col s12 m4 l4">
                            <ul>
                                <li id="basicProfileLinkContainer" class="prfMnLink">
                                    <span id="basicProfileLink" class="prfMnLinkTxt">Basic Profile</span>
                                </li>
                                <li id="addressLinkContainer" class="prfMnLink">
                                    <span id="addressLink" class="prfMnLinkTxt">Addresses</span>
                                </li>
                                <li id="allergiesLinkContainer" class="prfMnLink">
                                    <span id="allergiesLink" class="prfMnLinkTxt">Allergies</span>
                                </li>
                                <li id="preferenceLinkContainer" class="prfMnLink">
                                    <span id="preferenceLink" class="prfMnLinkTxt">Preference</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col s12 m8 l8 prfLfBrd">
                            <div id="basic-profile-container">
                                <div class="prfCntTtl">
                                    <span>
                                        FOODIE PROFILE
                                    </span>
                                </div>
                                <div class="divider"></div>
                                <div class="prfCntInf">
                                    <div class="row prfCntRw">
                                        <div class="col s4 m4 l4">
                                            <span>Name:</span>
                                        </div>
                                        <div class="col s8 m8 l8">
                                            <span>{{ $foodie->first_name . ' ' . $foodie->last_name }} {{ ($foodie->username)? '(' . $foodie->username . ')' : '' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider"></div>
                                <div class="prfCntInf">
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
                                    <div class="row prfCntRw">
                                        <div class="col s4 m4 l4">
                                            <span>Gender:</span>
                                        </div>
                                        <div class="col s8 m8 l8`">
                                            <span id="foodie-gender"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="divider"></div>
                                <div class="prfCntInf">
                                    <div class="row prfCntRw">
                                        <div class="col s4 m4 l4">
                                            <span>Birthday:</span>
                                        </div>
                                        <div class="col s8 m8 l8">
                                            @if($foodie->birthday!=null)
                                                <span>{{ date('F j, Y',strtotime($foodie->birthday)) }}</span>
                                            @else
                                                <span>N/A</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="prfCntBtn">
                                    <button data-target="basic-profile-modal" class="orange darken-2 btn modal-trigger">Edit</button>
                                </div>
                            </div>


                            <div id="addresses-container">
                                <div class="prfCntTtl">
                                    <span id="address-section">DELIVERY ADDRESSES</span>
                                </div>
                                @if($addresses->count()<1)
                                    <div class="divider"></div>
                                    <div class="prfCntInf">
                                        <span>{{'No Addresses Added'}}</span>
                                    </div>
                                @else
                                    @foreach($addresses as $address)
                                        <div class="divider"></div>
                                        <div class="prfCntInf">
                                            <div class="row prfCntRw">
                                                <div class="col s4 m4 l4">
                                                    @if($address->type=='R')
                                                        <span>Residence:</span>
                                                    @else
                                                        <span>Business:</span>
                                                    @endif
                                                </div>
                                                <div class="col s8 m8 l8">
                                                    <div class="col s10 m10 l10">
                                                        <span>{{ $address->unit.' ' }}
                                                            @unless($address->bldg == '')
                                                                {{$address->bldg . ', '}}
                                                            @endunless
                                                            {{ $address->street . ', '}}
                                                            {{ $address->brgy . ', '}}
                                                            {{ $address->city }}
                                                        </span>
                                                    </div>
                                                    <div class="col s2 m2 l2 addressEdit">
                                                        <a class="right modal-trigger" href="#update-address-modal{{$address->id}}"><i class="material-icons">edit</i></a>
                                                        <a class="right modal-trigger" href="#delete-address-modal{{$address->id}}"><i class="material-icons">delete</i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            {{--<button data-target="update-address-modal{{$address->id}}" class="btn modal-trigger">Edit Address</button>--}}
                                            {{--<button data-target="delete-address-modal{{$address->id}}" class="btn modal-trigger">Delete Address</button>--}}
                                        </div>
                                        <div id="update-address-modal{{$address->id}}" class="modal">
                                            <form id="update-address{{$address->id}}" class="updateAddressForm" method="post" action="{{ route('foodie.address.update', $address->id) }}">
                                                {{csrf_field()}}
                                                <div class="modal-content">
                                                    <h4 id="address-section">Address</h4>
                                                    <p>This should be the address where your food will be primarily delivered to.</p>
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <script>
                                                                $(document).ready(function () {
                                                                    $('select#address-city{{$address->id}}').val('{{ $address->city ? $address->city : "" }}');
                                                                    console.log($('select#address-city{{$address->id}}').val());
                                                                    $('select#address-city{{$address->id}}').css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
                                                                });
                                                            </script>
                                                            <select id="address-city{{$address->id}}" name="city" data-error=".error-city{{$address->id}}">
                                                                <option value="" selected>Please choose</option>
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
                                                            <label for="address-city{{$address->id}}">City</label>
                                                            <small class="notes"><span class="flame-text">*</span> Please take note that we only cover Metro Manila as of the moment.</small>
                                                        </div>
                                                        <div class="error-city{{$address->id}} err">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s6">
                                                            <input id="address-unit{{$address->id}}" name="unit" type="text" class="validate" data-error=".error-unit{{$address->id}}" value="{{$address->unit}}">
                                                            <label for="address-unit{{$address->id}}">Unit No.<span class="flame-text">*</span></label>
                                                        </div>
                                                        <div class="error-unit{{$address->id}} err">

                                                        </div>
                                                        <div class="input-field col s6">
                                                            <input id="address-street{{$address->id}}" name="street" type="text" class="validate" data-error=".error-street{{$address->id}}" value="{{$address->street}}">
                                                            <label for="address-street{{$address->id}}">Street<span class="flame-text">*</span></label>
                                                        </div>
                                                        <div class="error-street{{$address->id}} err">

                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s6">
                                                            <input id="address-bldg{{$address->id}}" name="bldg" type="text" class="validate" value="{{$address->bldg}}">
                                                            <label for="address-bldg{{$address->id}}">Building</label>
                                                        </div>
                                                        <div class="input-field col s6">
                                                            <input id="address-brgy{{$address->id}}" data-error=".error-brgy{{$address->id}}" name="brgy" type="text" class="validate" value="{{$address->brgy}}">
                                                            <label for="address-brgy{{$address->id}}">Barangay/Village<span class="flame-text">*</span></label>
                                                            <div class="error-brgy{{$address->id}} err">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s6">
                                                            <script>
                                                                $(document).ready(function () {
                                                                    $('select#address-type{{$address->id}}').val('{{ $address->type ? $address->type : 0 }}');
                                                                    $('select#address-type{{$address->id}}').css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
                                                                });
                                                            </script>
                                                            <select id="address-type{{$address->id}}" name="type" data-error=".error-type{{$address->id}}">
                                                                <option value="" selected>Please choose</option>
                                                                <option value="R">Residential</option>
                                                                <option value="O">Office</option>
                                                            </select>
                                                            <label for="address-type{{$address->id}}">Address Type<span class="flame-text">*</span></label>
                                                            <div class="error-type{{$address->id}} err">

                                                            </div>
                                                        </div>
                                                        <div class="input-field col s6">
                                                            <input id="address-company{{$address->id}}" name="company" type="text" class="validate" value="{{$address->company}}">
                                                            <label for="address-company{{$address->id}}">Company</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <input id="address-landmark{{$address->id}}" name="landmark" type="text" class="validate" value="{{$address->landmark}}">
                                                            <label for="address-landmark{{$address->id}}">Landmark</label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="input-field col s12">
                                                            <textarea id="address-remarks{{$address->id}}" name="remarks" class="materialize-textarea" length="255">{{$address->remarks}}</textarea>
                                                            <label for="address-remarks{{$address->id}}">Address Remarks</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" class="hidden"/>
                                                    <a href="javascript:void(0)" class="prfSvBtn modal-action n-btn-link n-submit-btn profile-save-btn right-aligned right"><i class="fa fa-save" aria-hidden="true"></i> </a>
                                                </div>
                                            </form> <!-- End of update address form -->
                                        </div>
                                        <div id="delete-address-modal{{$address->id}}" class="modal">
                                            <div class="modal-content">
                                                <h4>Are you sure you want to delete?</h4>
                                                delete button
                                                <form action="{{route('foodie.address.delete', $address->id)}}" method="post">
                                                    {{csrf_field()}}
                                                    <input type="submit" class="orange darken-2 btn" value="delete">
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="prfCntBtn">
                                    <button data-target="address-modal" class="orange darken-2 btn modal-trigger">Add</button>
                                </div>
                            </div>


                            <div id="allergies-container">
                                <div class="prfCntTtl">
                                    <span id="allergies-section">ALLERGIES:</span>
                                </div>
                                    <ul>
                                        @foreach($allergies as $allergy)
                                            <li>
                                                <div class="divider"></div>
                                                <div class="prfCntInf">
                                                    <div class="row prfCntRw">
                                                        <div class="col s12">
                                                            @if($allergy->allergy=='shrimp')
                                                                <span>Squid, Shrimp and Crab</span>
                                                            @else
                                                                <span>{{ ucfirst($allergy->allergy) }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                <div>
                                    <button data-target="allergies-modal" class="orange darken-2 btn modal-trigger">Edit Allergies</button>
                                </div>
                            </div>


                            <div id="food-preferences-container">
                                <div class="prfCntTtl">
                                    <span id="food-preferences-section">Food Preference</span>
                                </div>
                                <div class="divider"></div>
                                @if(isset($preference))
                                    <div class="prfCntInf">
                                        <div class="row prfCntRw">
                                            <div class="col s12">
                                                <span>
                                                    {{ ucfirst($preference->ingredient) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="prfCntBtn">
                                    <button data-target="food-preference-modal" class="orange darken-2 btn modal-trigger">Edit</button>
                                </div>
                            </div>


                        </div>
                    </div>
                <div id="basic-profile-modal" class="modal">
                    <form id="basic-profile" method="post" action="{{ route('foodie.profile.basic') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-content">
                            <h3 class="mustard-text">Foodie Profile</h3>
                            <p>We want to get to know you more! Please enter the following personal details:</p>

                            <div class="row">
                                <div class="col s4">
                                    <div>
                                        <img src="/img/{{ $foodie->avatar }}" class="prfFrmImg img img-thumbnail">
                                    </div>
                                    <label for="profile" style="margin-left: 30px;">Update Profile Image</label>
                                    <input type="file" name="avatar">
                                </div>
                                <div class="input-field col s4">
                                    <input id="firstname" name="first_name" type="text" class="validate" value="{{ $foodie->first_name }}">
                                    <label for="firstname" class="active">First Name</label>
                                </div>
                                <div class="input-field col s4">
                                    <input id="lastname" name="last_name" type="text" class="validate" value="{{ $foodie->last_name }}">
                                    <label for="lastname" class="active">Last Name</label>
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
                                    <label for="gender">Gender</label>
                                </div>
                                <div class="input-field col m6 s12">
                                    <input id="birthday" name="birthday" type="text" class="validate datepicker"
                                           value="{{$foodie->birthday}}">
                                    <label for="birthday" class="active">Birthday</label>
                                    <small class="notes"><span class="flame-text">*</span> You must 18 years or older to order meal plans.</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="username" name="username" type="text" class="validate" value="{{ $foodie->username }}">
                                    <label for="username" class="active">Username</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="hidden"/>
                            <a href="javascript:void(0)" class="prfSvBtn modal-action n-btn-link n-submit-btn profile-save-btn right-aligned right"><i class="fa fa-save" aria-hidden="true"></i> </a>
                        </div>
                    </form> <!-- End of basic-profile form -->
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
                                            $('select#address-city').css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
                                        });
                                    </script>
                                    <select id="address-city" name="city" data-error=".error-city">
                                        <option value="" selected>Please choose</option>
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
                                    <label for="address-city" class="active">City</label>
                                    <small class="notes"><span class="flame-text">*</span> Please take note that we only cover Metro Manila as of the moment.</small>
                                    <div class="error-city err">

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input id="address-unit" name="unit" type="text" class="validate" data-error=".error-unit" value="">
                                    <label for="address-unit" class="active">Unit No.<span class="flame-text">*</span></label>
                                    <div class="error-unit err">
                                    </div>
                                </div>
                                <div class="input-field col s6">
                                    <input id="address-street" name="street" type="text" class="validate" data-error=".error-street" value="">
                                    <label for="address-street" class="active">Street<span class="flame-text">*</span></label>
                                    <div class="error-street err">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <input id="address-bldg" name="bldg" type="text" class="validate" value="">
                                    <label for="address-bldg" class="active">Building</label>
                                </div>
                                <div class="input-field col s6">
                                    <input id="address-brgy" name="brgy" type="text" class="validate" data-error=".error-brgy" value="">
                                    <label for="address-brgy" class="active">Barangay/Village<span class="flame-text">*</span></label>
                                    <div class="error-brgy err">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s6">
                                    <script>
                                        $(document).ready(function () {
                                            $('select#address-type').val('');
                                            $('select#address-type').css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});
                                        });
                                    </script>
                                    <select id="address-type" name="type" data-error=".error-type">
                                        <option value="0" disabled selected>Please choose</option>
                                        <option value="R">Residential</option>
                                        <option value="O">Office</option>
                                    </select>
                                    <label for="address-type" class="active">Address Type<span class="flame-text">*</span></label>
                                    <div class="error-type err">
                                    </div>
                                </div>
                                <div class="input-field col s6">
                                    <input id="address-company" name="company" type="text" class="validate" value="">
                                    <label for="address-company" class="active">Company</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="address-landmark" name="landmark" type="text" class="validate" value="">
                                    <label for="address-landmark" class="active">Landmark</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="address-remarks" name="remarks" class="materialize-textarea" length="255" value=""></textarea>
                                    <label for="address-remarks" class="active">Address Remarks</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="hidden"/>
                            <a href="javascript:void(0)" class="prfSvBtn modal-action n-btn-link n-submit-btn profile-save-btn right-aligned right"><i class="fa fa-save" aria-hidden="true"></i> </a>
                        </div>
                    </form> <!-- End of address form -->
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
                                    <input type="checkbox" name="seafood" value="1" class="filled-in  allergyCheckbox" id="allrg-sea"/>
                                    <label for="allrg-sea">Seafood</label><br/>
                                    {{--<input type="hidden" name="squid" value="0"/>--}}
                                    {{--<input type="checkbox" name="squid" value="1" class="filled-in allergyCheckbox" id="allrg-squid"/>--}}
                                    {{--<label for="allrg-squid">Squid, Shrimp, and Crab</label><br/>--}}
                                    {{--<input type="hidden" name="fish" value="0"/>--}}
                                    {{--<input type="checkbox" name="fish" value="1" class="filled-in allergyCheckbox" id="allrg-fish"/>--}}
                                    {{--<label for="allrg-fish">Fish</label><br/>--}}
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
                            <a href="javascript:void(0)" class="prfSvBtn modal-action n-btn-link n-submit-btn profile-save-btn right-aligned right"><i class="fa fa-save" aria-hidden="true"></i> </a>
                        </div>
                    </form> <!-- End of allergies form -->
                </div>

                <div id="food-preference-modal" class="modal">
                    <form id="food-preferences" method="post" action="{{ route('foodie.profile.preferences') }}">
                        {{ csrf_field() }}
                        <div class="modal-content">
                            <h4>Food Preferences</h4>
                            <p>Now let us know the food that you prefer to have in your meals.</p>
                            <div class="row">
                                <div class="input-field col l4 s12">
                                    @if($allergies->where('allergy','=','chicken')->count() && $allergies->where('allergy','=','beef')->count()
                                    && $allergies->where('allergy','=','pork')->count() && $allergies->where('allergy','=','seafood')->count())
                                        <input type="radio" name="foodPref" value="none" class="filled-in" id="pref-none" data-error=".error-pref"/>
                                        <label for="pref-none">No Preference</label><br/>
                                        <input type="radio" name="foodPref" value="vegetable" class="filled-in" id="pref-beef" data-error=".error-pref"/>
                                        <label for="pref-beef">Vegetarian</label><br/>
                                    @else
                                        <input type="radio" name="foodPref" value="none" class="filled-in" id="pref-none" data-error=".error-pref"/>
                                        <label for="pref-none">No Preference</label><br/>
                                        @if($allergies->where('allergy','=','beef')->count())
                                            <input type="radio" name="foodPref" value="beef" class="filled-in" id="pref-beef" data-error=".error-pref"/>
                                            <label for="pref-beef">Beef-based</label><br/>
                                        @endif
                                        @if($allergies->where('allergy','=','pork')->count())
                                            <input type="radio" name="foodPref" value="pork" class="filled-in" id="pref-pork" data-error=".error-pref"/>
                                            <label for="pref-pork">Pork-based</label><br/>
                                        @endif
                                        @if($allergies->where('allergy','=','chicken')->count())
                                            <input type="radio" name="foodPref" value="chicken" class="filled-in" id="pref-chick" data-error=".error-pref"/>
                                            <label for="pref-chick">Chicken-based</label><br/>
                                        @endif
                                        @if($allergies->where('allergy','=','seafood')->count())
                                            <input type="radio" name="foodPref" value="seafood" class="filled-in" id="pref-sea" data-error=".error-pref"/>
                                            <label for="pref-sea">Seafood-based</label><br/>
                                        @endif
                                        <input type="radio" name="foodPref" value="vegetable" class="filled-in" id="pref-beef" data-error=".error-pref"/>
                                        <label for="pref-beef">Vegetarian</label><br/>
                                    @endif

                                </div>
                            </div>
                            <div class="error-pref err"></div>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="hidden"/>
                            <a href="javascript:void(0)" class="prfSvBtn modal-action n-btn-link n-submit-btn profile-save-btn right-aligned right"><i class="fa fa-save" aria-hidden="true"></i> </a>
                        </div>
                    </form> <!-- End of preferences form -->
                </div>
            </div>
        </div>
</div>

@endsection
    {{--<div class="row">--}}
        {{--<div class="col m12">--}}
            {{--<!-- Basic Profile -->--}}
            {{--<div id="basic-profile" class="card-panel">--}}
                {{--<h2 class="mustard-text">Foodie Profile</h2>--}}
                {{--<h4>Name: {{ $foodie->first_name . ' ' . $foodie->last_name }} {{ ($foodie->username)? '(' . $foodie->username . ')' : '' }}</h4>--}}
                {{--<script>--}}
                    {{--$(document).ready(function () {--}}
                        {{--var text;--}}
                        {{--var gender = '{{ $foodie->gender }}';--}}
                        {{--switch (gender) {--}}
                            {{--case 'M': text = 'Male'; break;--}}
                            {{--case 'F': text = 'Female'; break;--}}
                            {{--case 'N': text = 'Prefer not to say.'; break;--}}
                            {{--default: text = 'N/A'; break;--}}
                        {{--}--}}
                        {{--$('#foodie-gender').text(text);--}}
                    {{--});--}}
                {{--</script>--}}
                {{--<h4>Gender: <span id="foodie-gender"></span></h4>--}}
                {{--<h4>Birthday: {{ $foodie->birthday }}</h4>--}}
                {{--<div>--}}
                    {{--<button data-target="basic-profile-modal" class="btn modal-trigger">Edit Basic Profile</button>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<!-- Basic Profile Form Modal -->--}}
            {{--<div id="basic-profile-modal" class="modal">--}}
                {{--<form id="basic-profile" method="post" action="{{ route('foodie.profile.basic') }}" enctype="multipart/form-data">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<div class="modal-content">--}}
                        {{--<h3 class="mustard-text">Foodie Profile</h3>--}}
                        {{--<p>We want to get to know you more! Please enter the following personal details:</p>--}}

                        {{--<div class="row">--}}
                            {{--<div class="col s4">--}}
                                {{--<img src="/img/{{ $foodie->avatar }}"--}}
                                     {{--style="width:200px; height:200px; float:left; margin-right: 25px;"--}}
                                     {{--class="img img-thumbnail">--}}
                                {{--<br>--}}
                                {{--<label for="profile" style="margin-left: 30px;">Update Profile Image</label>--}}
                                {{--<input type="file" name="avatar">--}}
                            {{--</div>--}}
                            {{--<div class="input-field col s4">--}}
                                {{--<input id="firstname" name="first_name" type="text" class="validate" value="{{ $foodie->first_name }}">--}}
                                {{--<label for="firstname">First Name</label>--}}
                            {{--</div>--}}
                            {{--<div class="input-field col s4">--}}
                                {{--<input id="lastname" name="last_name" type="text" class="validate" value="{{ $foodie->last_name }}">--}}
                                {{--<label for="lastname">Last Name</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            {{--<div class="input-field col m6 s12">--}}
                                {{--<script>--}}
                                    {{--$(document).ready(function () {--}}
                                        {{--$('select#gender').val('{{ $foodie->gender ? $foodie->gender : 0 }}');--}}
                                    {{--});--}}
                                {{--</script>--}}
                                {{--<select id="gender" name="gender">--}}
                                    {{--<option value="0" disabled selected>Please choose</option>--}}
                                    {{--<option value="M">Male</option>--}}
                                    {{--<option value="F">Female</option>--}}
                                    {{--<option value="N">Prefer not to say</option>--}}
                                {{--</select>--}}
                                {{--<label>Gender</label>--}}
                            {{--</div>--}}
                            {{--<div class="input-field col m6 s12">--}}
                                {{--<input id="birthday" name="birthday" type="text" class="validate datepicker" value="{{ $foodie->birthday }}">--}}
                                {{--<label for="birthday">Birthday</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            {{--<div class="input-field col s12">--}}
                                {{--<input id="username" name="username" type="text" class="validate" value="{{ $foodie->username }}">--}}
                                {{--<label for="username">Username</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="modal-footer">--}}
                        {{--<input type="submit" class="hidden"/>--}}
                        {{--<a href="javascript:void(0)" class="modal-action n-btn-link n-submit-btn profile-save-btn right-aligned right"><i class="fa fa-save" aria-hidden="true"></i> </a>--}}
                    {{--</div>--}}
                {{--</form> <!-- End of basic-profile form -->--}}
            {{--</div>--}}

            {{--<div id="addresses-container" class="card-panel">--}}
                {{--<h2 id="address-section" class="mustard-text">Delivery Addresses</h2>--}}
                {{--@if($addresses->count()<1)--}}
                    {{--<h4>{{'No Addresses Added'}}</h4>--}}
                {{--@else--}}
                    {{--@foreach($addresses as $address)--}}
                        {{--<div>--}}
                            {{--<h4>{{ $address->unit.' ' }}--}}
                                {{--@unless($address->bldg == '')--}}
                                    {{--{{$address->bldg . ', '}}--}}
                                {{--@endunless--}}
                                 {{--{{ $address->street . ', '}}--}}
                                 {{--{{ $address->brgy . ', '}}--}}
                                 {{--{{ $address->city }}--}}
                            {{--</h4>--}}
                            {{--<button data-target="update-address-modal{{$address->id}}" class="btn modal-trigger">Edit Address</button>--}}
                            {{--<button data-target="delete-address-modal{{$address->id}}" class="btn modal-trigger">Delete Address</button>--}}
                        {{--</div>--}}
                        {{--<div id="update-address-modal{{$address->id}}" class="modal">--}}
                            {{--<form id="address" method="post" action="{{ route('foodie.address.update', $address->id) }}">--}}
                                {{--{{csrf_field()}}--}}
                                {{--<div class="modal-content">--}}
                                    {{--<h4 id="address-section">Address</h4>--}}
                                    {{--<p>This should be the address where your food will be primarily delivered to.</p>--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="input-field col s12">--}}
                                            {{--<script>--}}
                                                {{--$(document).ready(function () {--}}
                                                    {{--$('select#address-city{{$address->id}}').val('{{ $address->city ? $address->city : 0 }}');--}}
                                                    {{--console.log($('select#address-city{{$address->id}}').val());--}}
                                                {{--});--}}
                                            {{--</script>--}}
                                            {{--<select id="address-city{{$address->id}}" name="city">--}}
                                                {{--<option value="0" disabled selected>Please choose</option>--}}
                                                {{--<option value="Caloocan">Caloocan</option>--}}
                                                {{--<option value="Las Piñas">Las Piñas</option>--}}
                                                {{--<option value="Makati">Makati</option>--}}
                                                {{--<option value="Malabon">Malabon</option>--}}
                                                {{--<option value="Mandaluyong">Mandaluyong</option>--}}
                                                {{--<option value="Manila">Manila</option>--}}
                                                {{--<option value="Marikina">Marikina</option>--}}
                                                {{--<option value="Muntinlupa">Muntinlupa</option>--}}
                                                {{--<option value="Navotas">Navotas</option>--}}
                                                {{--<option value="Parañaque">Parañaque</option>--}}
                                                {{--<option value="Pasay">Pasay</option>--}}
                                                {{--<option value="Pasig">Pasig</option>--}}
                                                {{--<option value="Pateros">Pateros</option>--}}
                                                {{--<option value="Quezon">Quezon</option>--}}
                                                {{--<option value="San Juan">San Juan</option>--}}
                                                {{--<option value="Taguig">Taguig</option>--}}
                                                {{--<option value="Valenzuela">Valenzuela</option>--}}
                                            {{--</select>--}}
                                            {{--<label for="address-city{{$address->id}}">City</label>--}}
                                            {{--<small class="notes"><span class="flame-text">*</span> Please take note that we only cover Metro Manila as of the moment.</small>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="input-field col s6">--}}
                                            {{--<input id="address-unit{{$address->id}}" name="unit" type="text" class="validate" value="{{$address->unit}}">--}}
                                            {{--<label for="address-unit{{$address->id}}">Unit No.<span class="flame-text">*</span></label>--}}
                                        {{--</div>--}}
                                        {{--<div class="input-field col s6">--}}
                                            {{--<input id="address-street{{$address->id}}" name="street" type="text" class="validate" value="{{$address->street}}">--}}
                                            {{--<label for="address-street{{$address->id}}">Street<span class="flame-text">*</span></label>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="input-field col s6">--}}
                                            {{--<input id="address-bldg{{$address->id}}" name="bldg" type="text" class="validate" value="{{$address->bldg}}">--}}
                                            {{--<label for="address-bldg{{$address->id}}">Building</label>--}}
                                        {{--</div>--}}
                                        {{--<div class="input-field col s6">--}}
                                            {{--<input id="address-brgy{{$address->id}}" name="brgy" type="text" class="validate" value="{{$address->brgy}}">--}}
                                            {{--<label for="address-brgy{{$address->id}}">Barangay/Village<span class="flame-text">*</span></label>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="input-field col s6">--}}
                                            {{--<script>--}}
                                                {{--$(document).ready(function () {--}}
                                                    {{--$('select#address-type{{$address->id}}').val('{{ $address->type ? $address->type : 0 }}');--}}
                                                {{--});--}}
                                            {{--</script>--}}
                                            {{--<select id="address-type{{$address->id}}" name="type">--}}
                                                {{--<option value="0" disabled selected>Please choose</option>--}}
                                                {{--<option value="R">Residential</option>--}}
                                                {{--<option value="O">Office</option>--}}
                                            {{--</select>--}}
                                            {{--<label for="address-type{{$address->id}}">Address Type<span class="flame-text">*</span></label>--}}
                                        {{--</div>--}}
                                        {{--<div class="input-field col s6">--}}
                                            {{--<input id="address-company{{$address->id}}" name="company" type="text" class="validate" value="{{$address->company}}">--}}
                                            {{--<label for="address-company{{$address->id}}">Company</label>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="input-field col s12">--}}
                                            {{--<input id="address-landmark{{$address->id}}" name="landmark" type="text" class="validate" value="{{$address->landmark}}">--}}
                                            {{--<label for="address-landmark{{$address->id}}">Landmark</label>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="row">--}}
                                        {{--<div class="input-field col s12">--}}
                                            {{--<textarea id="address-remarks{{$address->id}}" name="remarks" class="materialize-textarea" length="255">{{$address->remarks}}</textarea>--}}
                                            {{--<label for="address-remarks{{$address->id}}">Address Remarks</label>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="modal-footer">--}}
                                    {{--<input type="submit" class="hidden"/>--}}
                                    {{--<a href="javascript:void(0)" class="modal-action n-btn-link n-submit-btn profile-save-btn right-aligned right"><i class="fa fa-save" aria-hidden="true"></i> </a>--}}
                                {{--</div>--}}
                            {{--</form> <!-- End of update address form -->--}}
                        {{--</div>--}}
                        {{--<div id="delete-address-modal{{$address->id}}" class="modal">--}}
                            {{--<div class="modal-content">--}}
                                {{--<h4>Are you sure you want to delete?</h4>--}}
                                 {{--delete button --}}
                                {{--<form action="{{route('foodie.address.delete', $address->id)}}" method="post">--}}
                                    {{--{{csrf_field()}}--}}
                                    {{--<input type="submit" class="btn" value="delete">--}}
                                {{--</form>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@endforeach--}}
                {{--@endif--}}
                {{--<div style="margin:10px 0;">--}}
                    {{--<button data-target="address-modal" class="btn modal-trigger">Add Delivery Address</button>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div id="address-modal" class="modal">--}}
                {{--<form id="address" method="post" action="{{ route('foodie.profile.address') }}">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<div class="modal-content">--}}
                        {{--<h4 id="address-section">Address</h4>--}}
                        {{--<p>This should be the address where your food will be primarily delivered to.</p>--}}
                        {{--<div class="row">--}}
                            {{--<div class="input-field col s12">--}}
                                {{--<script>--}}
                                    {{--$(document).ready(function () {--}}
                                        {{--$('select#address-city').val('');--}}
                                    {{--});--}}
                                {{--</script>--}}
                                {{--<select id="address-city" name="city">--}}
                                    {{--<option value="0" disabled selected>Please choose</option>--}}
                                    {{--<option value="Caloocan">Caloocan</option>--}}
                                    {{--<option value="Las Piñas">Las Piñas</option>--}}
                                    {{--<option value="Makati">Makati</option>--}}
                                    {{--<option value="Malabon">Malabon</option>--}}
                                    {{--<option value="Mandaluyong">Mandaluyong</option>--}}
                                    {{--<option value="Manila">Manila</option>--}}
                                    {{--<option value="Marikina">Marikina</option>--}}
                                    {{--<option value="Muntinlupa">Muntinlupa</option>--}}
                                    {{--<option value="Navotas">Navotas</option>--}}
                                    {{--<option value="Parañaque">Parañaque</option>--}}
                                    {{--<option value="Pasay">Pasay</option>--}}
                                    {{--<option value="Pasig">Pasig</option>--}}
                                    {{--<option value="Pateros">Pateros</option>--}}
                                    {{--<option value="Quezon">Quezon</option>--}}
                                    {{--<option value="San Juan">San Juan</option>--}}
                                    {{--<option value="Taguig">Taguig</option>--}}
                                    {{--<option value="Valenzuela">Valenzuela</option>--}}
                                {{--</select>--}}
                                {{--<label for="address-city">City</label>--}}
                                {{--<small class="notes"><span class="flame-text">*</span> Please take note that we only cover Metro Manila as of the moment.</small>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            {{--<div class="input-field col s6">--}}
                                {{--<input id="address-unit" name="unit" type="text" class="validate" value="">--}}
                                {{--<label for="address-unit">Unit No.<span class="flame-text">*</span></label>--}}
                            {{--</div>--}}
                            {{--<div class="input-field col s6">--}}
                                {{--<input id="address-street" name="street" type="text" class="validate" value="">--}}
                                {{--<label for="address-street">Street<span class="flame-text">*</span></label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            {{--<div class="input-field col s6">--}}
                                {{--<input id="address-bldg" name="bldg" type="text" class="validate" value="">--}}
                                {{--<label for="address-bldg">Building</label>--}}
                            {{--</div>--}}
                            {{--<div class="input-field col s6">--}}
                                {{--<input id="address-brgy" name="brgy" type="text" class="validate" value="">--}}
                                {{--<label for="address-brgy">Barangay/Village<span class="flame-text">*</span></label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            {{--<div class="input-field col s6">--}}
                                {{--<script>--}}
                                    {{--$(document).ready(function () {--}}
                                        {{--$('select#address-type').val('');--}}
                                    {{--});--}}
                                {{--</script>--}}
                                {{--<select id="address-type" name="type">--}}
                                    {{--<option value="0" disabled selected>Please choose</option>--}}
                                    {{--<option value="R">Residential</option>--}}
                                    {{--<option value="O">Office</option>--}}
                                {{--</select>--}}
                                {{--<label for="address-type">Address Type<span class="flame-text">*</span></label>--}}
                            {{--</div>--}}
                            {{--<div class="input-field col s6">--}}
                                {{--<input id="address-company" name="company" type="text" class="validate" value="">--}}
                                {{--<label for="address-company">Company</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            {{--<div class="input-field col s12">--}}
                                {{--<input id="address-landmark" name="landmark" type="text" class="validate" value="">--}}
                                {{--<label for="address-landmark">Landmark</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                            {{--<div class="input-field col s12">--}}
                                {{--<textarea id="address-remarks" name="remarks" class="materialize-textarea" length="255" value=""></textarea>--}}
                                {{--<label for="address-remarks">Address Remarks</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="modal-footer">--}}
                        {{--<input type="submit" class="hidden"/>--}}
                        {{--<a href="javascript:void(0)" class="modal-action n-btn-link n-submit-btn profile-save-btn right-aligned right"><i class="fa fa-save" aria-hidden="true"></i> </a>--}}
                    {{--</div>--}}
                {{--</form> <!-- End of address form -->--}}
            {{--</div>--}}


            {{--<div id="allergies-container" class="card-panel">--}}
                {{--<h2 id="allergies-section" class="mustard-text">Allergies :</h2>--}}
                {{--<ul>--}}
                    {{--@foreach($allergies as $allergy)--}}
                        {{--<li><h4>{{ $allergy->allergy }}</h4></li>--}}
                    {{--@endforeach--}}
                {{--</ul>--}}
                {{--<div>--}}
                    {{--<button data-target="allergies-modal" class="btn modal-trigger">Edit Allergies</button>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div id="allergies-modal" class="modal">--}}
                {{--<form id="allergies" method="post" action="{{ route('foodie.profile.allergies') }}">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<div class="modal-content">--}}
                        {{--<h4>Allergies</h4>--}}
                        {{--<p>Tell us what you can't eat, so that we can tailor a better diet experience for you!</p>--}}
                        {{--<div class="row">--}}
                            {{--<div class="input-field col l4 s12">--}}
                                {{--<input type="hidden" name="seafood" value="0"/>--}}
                                {{--<input type="checkbox" name="seafood" value="1" class="filled-in  allergyCheckbox" id="allrg-sea"/>--}}
                                {{--<label for="allrg-sea">Seafood</label><br/>--}}
                                {{--<input type="hidden" name="squid" value="0"/>--}}
                                {{--<input type="checkbox" name="squid" value="1" class="filled-in allergyCheckbox" id="allrg-squid"/>--}}
                                {{--<label for="allrg-squid">Squid, Shrimp, and Crab</label><br/>--}}
                                {{--<input type="hidden" name="fish" value="0"/>--}}
                                {{--<input type="checkbox" name="fish" value="1" class="filled-in allergyCheckbox" id="allrg-fish"/>--}}
                                {{--<label for="allrg-fish">Fish</label><br/>--}}
                            {{--</div>--}}
                            {{--<div class="input-field col l4 s12">--}}
                                {{--<input type="hidden" name="nuts" value="0"/>--}}
                                {{--<input type="checkbox" name="nuts" value="1" class="filled-in allergyCheckbox" id="allrg-nuts"/>--}}
                                {{--<label for="allrg-nuts">Nuts</label><br/>--}}
                                {{--<input type="hidden" name="pork" value="0"/>--}}
                                {{--<input type="checkbox" name="pork" value="1" class="filled-in allergyCheckbox" id="allrg-pork"/>--}}
                                {{--<label for="allrg-pork">Pork</label><br/>--}}
                                {{--<input type="hidden" name="beef" value="0"/>--}}
                                {{--<input type="checkbox" name="beef" value="1" class="filled-in allergyCheckbox" id="allrg-beef"/>--}}
                                {{--<label for="allrg-beef">Beef</label><br/>--}}
                            {{--</div>--}}
                            {{--<div class="input-field col l4 s12">--}}
                                {{--<input type="hidden" name="dairy" value="0"/>--}}
                                {{--<input type="checkbox" name="dairy" value="1" class="filled-in allergyCheckbox" id="allrg-dairy"/>--}}
                                {{--<label for="allrg-dairy">Dairy</label><br/>--}}
                                {{--<input type="hidden" name="chicken" value="0"/>--}}
                                {{--<input type="checkbox" name="chicken" value="1" class="filled-in allergyCheckbox" id="allrg-chick"/>--}}
                                {{--<label for="allrg-chick">Chicken</label><br/>--}}
                                {{--<input type="hidden" name="egg" value="0"/>--}}
                                {{--<input type="checkbox" name="egg" value="1" class="filled-in allergyCheckbox" id="allrg-egg"/>--}}
                                {{--<label for="allrg-egg">Egg</label><br/><br/>--}}
                            {{--</div>--}}
                            {{--<div class="input-field col s12">--}}
                                {{--<input id="allrg-others" name="others" type="text" class="validate">--}}
                                {{--<label for="allrg-others">Other Allergies</label>--}}
                            {{--</div>--}}
                            {{--<small class="notes"><span class="flame-text">*</span> If multiple other food allergies, please separate each allergy with a comma (,).</small>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="modal-footer">--}}
                        {{--<input type="submit" class="hidden"/>--}}
                        {{--<a href="javascript:void(0)" class="modal-action n-btn-link n-submit-btn profile-save-btn right-aligned right"><i class="fa fa-save" aria-hidden="true"></i> </a>--}}
                    {{--</div>--}}
                {{--</form> <!-- End of allergies form -->--}}
            {{--</div>--}}


            {{--<div id="food-preferences-container" class="card-panel">--}}
                {{--<h2 id="food-preferences-section" class="mustard-text">Food Preference</h2>--}}
                {{--@if(isset($preference))--}}
                    {{--<h4>{{ $preference->ingredient }}</h4>--}}
                {{--@endif--}}
                {{--<div>--}}
                    {{--<button data-target="food-preference-modal" class="btn modal-trigger">Edit Food Preferences</button>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div id="food-preference-modal" class="modal">--}}
                {{--<form id="food-preferences" method="post" action="{{ route('foodie.profile.preferences') }}">--}}
                    {{--{{ csrf_field() }}--}}
                    {{--<div class="modal-content">--}}
                        {{--<h4>Food Preferences</h4>--}}
                        {{--<p>Now let us know the food that you prefer to have in your meals. (Leave all of them unchecked if you don't have a preference.)</p>--}}
                        {{--<div class="row">--}}
                            {{--<div class="input-field col l4 s12">--}}
                                {{--<input type="radio" name="foodPref" value="beef" class="filled-in" id="pref-beef"/>--}}
                                {{--<label for="pref-beef">Beef-based</label><br/>--}}
                                {{--<input type="radio" name="foodPref" value="pork" class="filled-in" id="pref-pork"/>--}}
                                {{--<label for="pref-pork">Pork-based</label><br/>--}}
                                {{--<input type="radio" name="foodPref" value="chicken" class="filled-in" id="pref-chick"/>--}}
                                {{--<label for="pref-chick">Chicken-based</label><br/>--}}
                                {{--<input type="radio" name="foodPref" value="seafood" class="filled-in" id="pref-sea"/>--}}
                                {{--<label for="pref-sea">Seafood-based</label><br/>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="modal-footer">--}}
                        {{--<input type="submit" class="hidden"/>--}}
                        {{--<a href="javascript:void(0)" class="modal-action n-btn-link n-submit-btn profile-save-btn right-aligned right"><i class="fa fa-save" aria-hidden="true"></i> </a>--}}
                    {{--</div>--}}
                {{--</form> <!-- End of allergies form -->--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
