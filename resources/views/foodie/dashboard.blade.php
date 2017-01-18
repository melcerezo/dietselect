@extends('foodie.layout')
@section('page_head')
    <title>App - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="/css/foodie/app.css">
    <script src="/js/foodie/app.js" defer></script>

    @if ($sms_unverified)
        <link rel="stylesheet" href="/css/foodie/verify.css">
        <script src="/js/foodie/verification.validate.js" defer></script>
    @endif

    @if (session('after_registration'))
        <script>
            jQuery(window).load(function () {
                var delay = 1500;
                setTimeout(function () {
                    Materialize.toast("This is a toast notification!", 5000, 'rounded');
                }, delay);

                delay = 3000;
                setTimeout(function () {
                    Materialize.toast("This will display various important messages and notifications", 5000, 'rounded');
                }, delay);

                delay = 4500;
                setTimeout(function () {
                    Materialize.toast("You can swipe this to dismiss it.", 5000, 'rounded');
                }, delay);
            });
        </script>
    @endif
@endsection

@section('page_content')
<div class="container">
    <div class="row">
        <div class="col m8 offset-m2">
            <h1>Dashboard</h1>
            <p>
                You are logged in! Welcome back, {{ $foodie->first_name }}!
            <form id="logout" method="post" action="{{ route('foodie.logout') }}">
                {{ csrf_field() }}
                <a id="logout-link" href="#">
                    Logout
                </a>
            </form>
            </p>
        </div>
    </div>
</div>
@endsection
