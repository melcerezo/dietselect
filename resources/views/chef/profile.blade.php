@extends('chef.layout')
@section('page_head')
    <title>Chef Profile - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="/css/chef/profile.css">
    <script src="/js/chef/profile.js" defer></script>
@endsection

@section('page_content')
    <div class="row">
        <div class="col m12">
            <!-- Basic Profile -->
            <div id="basic-profile" class="card-panel">
                <h2 class="mustard-text">Chef Profile</h2>
                <h4>Company Name: {{ $chef->name  }}</h4>
                <h4>Email: {{$chef->email}}</h4>
                <h4>Number: {{ $chef->mobile_number }}</h4>
                <h4>Website: {{ $chef->website }}</h4>
            <div>
                    <button data-target="basic-profile-modal" class="btn modal-trigger">Edit Company Profile</button>
                </div>
            </div>
    </div>
    <!-- Basic Profile Form Modal -->
    <div id="basic-profile-modal" class="modal">
        <form id="basic-profile" method="post" action="{{ route('chef.profile.basic') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="modal-content">
                <h3 class="mustard-text">Chef Profile</h3>
                <p>Edit your Company Profile to let your foodies get to know you!</p>

                <div class="row">
                    <div class="col s4">
                        <img src="/img/{{ $chef->avatar }}"
                             style="width:200px; height:200px; float:left; margin-right: 25px;"
                             class="img img-thumbnail">
                        <br>
                        {{--<label for="profile" style="margin-left: 30px;">Update Profile Image</label>--}}
                        <input type="file" name="avatar">
                    </div>
                    <div class="input-field col s12">
                        <input id="company_name" name="company_name" type="text" class="validate" value="{{ $chef->name }}">
                        <label for="company_name" class="active">Company Name</label>
                    </div>
                </div>
                <div class="row">
                       <div class="input-field col s12">
                        <input id="mobile_number" name="mobile_number" type="text" class="validate" value="{{ $chef->mobile_number }}">
                        <label for="mobile_number" class="active">Company Number</label>
                    </div>
                </div>
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
            </div>
            <div class="modal-footer">
                <input type="submit" class="hidden"/>
                <a href="javascript:void(0)" class="modal-action n-btn-link n-submit-btn profile-save-btn right-aligned right"><i class="fa fa-save" aria-hidden="true"></i> </a>
            </div>
        </form> <!-- End of basic-profile form -->
    </div>
@endsection