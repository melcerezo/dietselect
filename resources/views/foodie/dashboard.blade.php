@extends('foodie.layout')
@section('page_head')
    <title>App - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
@endsection

@section('page_content')
<div class="container">
    <div class="row">
        <div class="col m8 offset-m2">
            <h1 class="center white-text">Dashboard</h1>
                <h3 class="center full-width white-text" style="font-size: 1.5em">You are logged in! Welcome back, {{ $foodie->first_name }}!</h3>
                <div class="card papaya-whip">
                    <div class="card-content">
                        <h4 class="mustard-text">Pending Orders:</h4>
                        <div>
                            @if($ordersCount>0)
                                @foreach($orders as $order)
                                    <div>
                                        <div>Chef: {{$order->chef->name}}</div>
                                        <div>Plan Name: {{$order->plan->plan_name}}</div>
                                        <div>Plan Price: {{$order->plan->price}}</div>
                                    </div>
                                @endforeach
                                @else
                                <div>
                                    <h5>No Pending Orders!</h5>
                                </div>

                            @endif
                        </div>
                    </div>
                </div>
                <div class="card papaya-whip">
                    <div class="card-content">
                        <h4 class="mustard-text">Suggested Meal Plans:</h4>
                    </div>
                </div>
                {{--<div class="card papaya-whip">--}}
                    {{--<div class="card-content">--}}
                        {{--<h4 class="mustard-text">Meal Plans:</h4>--}}
                    {{--</div>--}}
                {{--</div>--}}

            {{--<form id="logout" method="post" action="{{ route('foodie.logout') }}">--}}
                {{--{{ csrf_field() }}--}}
                {{--<a id="logout-link" href="#">--}}
                    {{--Logout--}}
                {{--</a>--}}
            {{--</form>--}}
            </div>
        </div>
    </div>
</div>
@endsection
