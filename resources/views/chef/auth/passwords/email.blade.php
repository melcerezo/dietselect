@extends('layouts.app')

@section('head')
    <title>Reset Password - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="/css/chef/reset.pass.css">
    <script src="/js/chef/reset.pass.validate.js" defer></script>
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
<div class="valign-wrapper" style="position: absolute; height: 100%; width: 100%;">
    <!-- Reset Password Request Card -->
    <div id="reset-password" class="card valign">
        <div class="row no-pad-bot">
            <div class="col s12">
                <form id="reset-password-form" role="form" method="POST" action="{{ route('chef.reset.send') }}">
                    {{ csrf_field() }}
                    <div class="card-content">
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
                    <div class="card-action">
                        <input type="submit" class="hidden"/>
                        <a href="javascript:void(0)" class="modal-action btn-flat n-btn-link n-submit-btn right"><i class="fa fa-paper-plane-o"></i><span class="hide-on-small-only n-form-btn-text"> Submit</span></a>
                        <a href="{{ route('welcome') }}" class="modal-action btn-flat n-btn-link"><i class="fa fa-home"></i><span class="hide-on-small-only n-form-btn-text"> Home</span></a>
                        <a href="{{ route('chef.login.show') }}" class="modal-action btn-flat n-btn-link"><i class="fa fa-sign-in"></i><span class="hide-on-small-only n-form-btn-text"> Partner Login</span></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of reset-password-card -->
</div>
@if (session('status'))
    <script defer>
        Materialize.toast("Sent {{ session('status') }}!", 4000);
    </script>
@endif
@endsection