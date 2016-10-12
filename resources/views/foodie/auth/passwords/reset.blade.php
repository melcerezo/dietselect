@extends('layouts.app')

@section('head')
    <title>Reset Password - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="/css/foodie/reset.pass.css">
    <script src="/js/foodie/reset.pass.validate.js" defer></script>

    @if (session('status'))
    <script defer>
        Materialize.toast({{ session('status') }}, 4000);
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
<div class="valign-wrapper" style="position: absolute; height: 100%; width: 100%;">
    <!-- Reset Password Card -->
    <div id="reset-password" class="card valign">
        <form id="reset-password" role="form" method="POST" action="{{ route('foodie.reset') }}">
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="card-content">
                <h3 class="mustard-text">Reset Password</h3>
                <p>Great! Now we know that you really did sent that request. Let's get to resetting that password already!</p>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="n-reset-email" name="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,63}$" data-error=".error-msg-email" value="{{ $email or old('email') }}"/>
                        <label for="n-reset-email">Email</label>
                        <div class="error-msg-email">
                        @if ($errors->has('email'))
                            {{ $errors->first('email') }}
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="n-reset-pass" name="password" type="password" data-error=".error-msg-pass"/>
                        <label for="n-reset-pass">Password</label>
                        <div class="error-msg-pass">
                            @if ($errors->has('password'))
                                {{ $errors->first('password') }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="n-reset-confirm-password" name="password_confirmation" type="password" data-error=".error-msg-confirm-pass"/>
                        <label for="n-reset-confirm-password">Confirm Password</label>
                        <div class="error-msg-confirm-pass">
                            @if ($errors->has('password_confirmation'))
                                {{ $errors->first('password_confirmation') }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-action">
                <input type="submit" class="hidden"/>
                <a href="javascript:void(0)" class="modal-action btn-flat n-btn-link n-submit-btn right"><i class="fa fa-paper-plane-o"></i><span class="hide-on-small-only n-form-btn-text"> Submit</span></a>
                <a href="{{ route('welcome') }}" class="modal-action btn-flat n-btn-link"><i class="fa fa-home"></i><span class="hide-on-small-only n-form-btn-text"> Home</span></a>
            </div>
        </form>
    </div>
    <!-- End of reset-password-card -->
</div>
@endsection