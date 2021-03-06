@extends('chef.layout')
@section('page_head')
    <title>Chef Profile - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="/css/chef/chefProfile.css">
    <script src="/js/chef/profile.js" defer></script>
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
                <ul class="collection">
                    <li class="collection-item" >
                        <a href="{{route("chef.order.view", ['id'=> 0])}}"  >Orders</a>
                    </li>
                    <li class="collection-item">
                        <a href="{{route("chef.getCommissions")}}">Commissions</a>
                    </li>
                    <li class="collection-item">
                        <a href="{{route('chef.plan')}}">View Your Plans</a>
                    </li>
                    <li class="collection-item" style="border: 1px solid #f57c00;">
                        <a href="{{route('chef.profile')}}" style="color: #f57c00;">Profile</a>
                    </li>
                    <li class="collection-item">
                        <a href="{{route('chef.message.index')}}">Messages</a>
                        {{--@if($messages->count()>0)--}}
                            {{--<span class="new badge red">{{$messages->count()}}</span>--}}
                        {{--@endif--}}
                    </li>
                    <li class="collection-item" >
                        <a href="{{route('chef.ratings')}}">Ratings</a>
                    </li>
                </ul>
            </div>
            <div class="col s12 m10" style="border: 1px solid #e0e0e0;">

                <div class="row prfMnCntDv">

                    <div class="col s12 m4 l4">
                        <ul>
                            <li id="basicProfileLinkContainer" class="prfMnLink">
                                <span id="basicProfileLink" class="prfMnLinkTxt">Basic Profile</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col s12 m8 l8 prfLfBrd">
                        <div id="basic-profile-container">
                            <div class="prfCntTtl">
                                <span>
                                    CHEF PROFILE
                                </span>
                            </div>
                            <div class="divider"></div>
                            <div class="prfCntInf">
                                <div class="row prfCntRw">
                                    <div class="col s4 m4 l4">
                                        <span>Name:</span>
                                    </div>
                                    <div class="col s8 m8 l8">
                                        <span>{{$chef->name}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="prfCntInf">
                                <div class="row prfCntRw">
                                    <div class="col s4 m4 l4">
                                        <span>Email:</span>
                                    </div>
                                    <div class="col s8 m8 l8">
                                        <span>{{$chef->email}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                                <div class="prfCntInf">
                                    <div class="row prfCntRw">
                                        <div class="col s4 m4 l4">
                                            <span>Website:</span>
                                        </div>
                                        <div class="col s8 m8 l8">
                                            <span>{{ $chef->website}}</span>
                                        </div>
                                    </div>
                                </div>
                            <div class="prfCntTtl" style="margin-top: 15px;">
                                <span>
                                    BANK ACCOUNT
                                </span>
                            </div>
                            <div class="divider"></div>
                            <div class="prfCntInf">
                                <div class="row prfCntRw">
                                    <div class="col s4 m4 l4">
                                        <span>Bank:</span>
                                    </div>
                                    <div class="col s8 m8 l8">
                                        @if($chef->bank_account!=null)
                                            <span>{{$chef->bank_account->bank}}</span>
                                        @else
                                            <span>N/A</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="prfCntInf">
                                <div class="row prfCntRw">
                                    <div class="col s4 m4 l4">
                                        <span>Account Number:</span>
                                    </div>
                                    <div class="col s8 m8 l8">
                                        @if($chef->bank_account!=null)
                                            @if($chef->bank_account->bank=="BDO")
                                                <span>{{'00'.$chef->bank_account->account}}</span>
                                            @else
                                                <span>{{$chef->bank_account->account}}</span>
                                            @endif
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
                    </div>
                </div>
            </div>
        </div>

        <!-- Basic Profile Form Modal -->
        <div id="basic-profile-modal" class="modal">
            <nav class="light-green lighten-1 white-text">
                <div class="nav-wrapper">
                    <div class="left col s12">
                        <ul>
                            <li>
                                <span style="font-size: 20px; margin-left: 20px;">Chef Profile</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <form id="basic-profile" method="post" action="{{ route('chef.profile.basic') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="modal-content">
                {{--<h3 class="mustard-text">Chef Profile</h3>--}}
                <p>Edit your Company Profile to let your foodies get to know you!</p>

                    <div class="row">
                            <div  class="col s4">
                                <div id="avatarBefore">
                                    <img src="/img/{{ $chef->avatar }}"
                                    style="width:200px; height:200px; float:left; margin-right: 25px;"
                                    class="img img-thumbnail">
                                </div>
                                <div id="imgContainer">
                                </div>
                                <label for="profile" style="margin-left: 30px;">Update Profile Image</label>
                                <input type="file" id="avatar" name="avatar">
                            </div>
                        <div class="input-field col s12">
                            <input id="company_name" name="company_name" type="text" class="validate" value="{{ $chef->name }}">
                            <label for="company_name" class="active">Company Name</label>
                        </div>
                    </div>
                    {{--<div class="row">--}}
                        {{--<div class="input-field col s12">--}}
                            {{--<input id="mobile_number" name="mobile_number" type="text" class="validate" value="{{ $chef->mobile_number }}">--}}
                            {{--<label for="mobile_number" class="active">Company Number</label>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" name="email" type="text" class="validate" value="{{ $chef->email }}">
                            <label for="email" class="active">Company Email</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="website" name="website" type="text" class="validate" value="{{ $chef->website }}">
                            <label for="website" class="active">Company Website</label>
                        </div>
                    </div>
                    <div class="divider"></div>

                    <div style="margin:30px 0 30px 0; ">Please enter your bank account number. This is required to receive your payments.</div>

                    @if($chef->bank_account!=null)
                        <div class="row">
                            <div class="input-field col s12">
                                <script>
                                    $(document).ready(function () {
                                        $('select#bank').val('{{ $chef->bank_account->bank ? $chef->bank_account->bank : 0 }}');
                                    });
                                </script>
                                <select id="bank" name="bank">
                                    <option value="0" disabled selected>Please choose</option>
                                    <option value="BDO">BDO</option>
                                    <option value="BPI">BPI</option>
                                </select>
                                <label for="bank" class="active">Bank</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                @if($chef->bank_account->bank=="BDO")
                                    <input id="account" name="account" type="text" class="validate" value="{{ '00'.$chef->bank_account->account }}">
                                @else
                                    <input id="account" name="account" type="text" class="validate" value="{{ $chef->bank_account->account }}">
                                @endif
                                <label for="account" class="active">Bank Account</label>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div class="input-field col s12">
                                <select id="bank" name="bank">
                                    <option value="0" disabled selected>Please choose</option>
                                    <option value="BDO">BDO</option>
                                    <option value="BPI">BPI</option>
                                </select>
                                <label for="bank" class="active">Bank</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="account" name="account" type="text" class="validate" value="">
                                <label for="account" class="active">Bank Account</label>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    {{--<input type="submit" class="hidden"/>--}}
                    <a href="javascript:void(0)" id="prfSvBtn" class="prfSvBtn modal-action n-btn-link n-submit-btn profile-save-btn right-aligned right"><i class="fa fa-save" aria-hidden="true"></i> </a>
                </div>
            </form> <!-- End of basic-profile form -->
        </div>
    </div>
@endsection
    {{--<div class="row">--}}
        {{--<div class="col m12">--}}
            {{--<!-- Basic Profile -->--}}
            {{--<div id="basic-profile" class="card-panel">--}}
                {{--<h2 class="mustard-text">Chef Profile</h2>--}}
                {{--<h4>Company Name: {{ $chef->name  }}</h4>--}}
                {{--<h4>Email: {{$chef->email}}</h4>--}}
                {{--<h4>Number: {{ $chef->mobile_number }}</h4>--}}
                {{--<h4>Website: {{ $chef->website }}</h4>--}}
            {{--<div>--}}
                    {{--<button data-target="basic-profile-modal" class="btn modal-trigger">Edit Company Profile</button>--}}
                {{--</div>--}}
            {{--</div>--}}
    {{--</div>--}}
    {{--<!-- Basic Profile Form Modal -->--}}
    {{--<div id="basic-profile-modal" class="modal">--}}
        {{--<form id="basic-profile" method="post" action="{{ route('chef.profile.basic') }}" enctype="multipart/form-data">--}}
            {{--{{ csrf_field() }}--}}
            {{--<div class="modal-content">--}}
                {{--<h3 class="mustard-text">Chef Profile</h3>--}}
                {{--<p>Edit your Company Profile to let your foodies get to know you!</p>--}}

                {{--<div class="row">--}}
                    {{--<div class="col s4">--}}
                        {{--<img src="/img/{{ $chef->avatar }}"--}}
                             {{--style="width:200px; height:200px; float:left; margin-right: 25px;"--}}
                             {{--class="img img-thumbnail">--}}
                        {{--<br>--}}
                        {{--<label for="profile" style="margin-left: 30px;">Update Profile Image</label>--}}
                        {{--<input type="file" name="avatar">--}}
                    {{--</div>--}}
                    {{--<div class="input-field col s12">--}}
                        {{--<input id="company_name" name="company_name" type="text" class="validate" value="{{ $chef->name }}">--}}
                        {{--<label for="company_name" class="active">Company Name</label>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                       {{--<div class="input-field col s12">--}}
                        {{--<input id="mobile_number" name="mobile_number" type="text" class="validate" value="{{ $chef->mobile_number }}">--}}
                        {{--<label for="mobile_number" class="active">Company Number</label>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                    {{--<div class="input-field col s12">--}}
                        {{--<input id="email" name="email" type="text" class="validate" value="{{ $chef->email }}">--}}
                        {{--<label for="email" class="active">Company Email</label>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                    {{--<div class="input-field col s12">--}}
                        {{--<input id="website" name="website" type="text" class="validate" value="{{ $chef->website }}">--}}
                        {{--<label for="website" class="active">Company Website</label>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="modal-footer">--}}
                {{--<input type="submit" class="hidden"/>--}}
                {{--<a href="javascript:void(0)" class="modal-action n-btn-link n-submit-btn profile-save-btn right-aligned right"><i class="fa fa-save" aria-hidden="true"></i> </a>--}}
            {{--</div>--}}
        {{--</form> <!-- End of basic-profile form -->--}}
    {{--</div>--}}
