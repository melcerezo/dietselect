@extends('chef.layout')
@section('page_head')
    <title>App - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">

@endsection

@section('page_content')
<div class="container">
    <div class="row">
        <div class="col m8 offset-m2">
            <h1>Dashboard</h1>
            You are logged in! Welcome back, {{ $chef->name }}!
            <div class="card papaya-whip">
                <div class="card-content">
                    <h4 class="mustard-text">Pending Orders:</h4>
                    <div><h5>You have {{$ordersCount}} pending orders!</h5></div>
                    <div>
                        @if($ordersCount>0)
                            @foreach($orders as $order)
                                <div>
                                    <div>Foodie Name: {{$order->foodie->first_name}} {{$order->foodie->last_name}}</div>
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
            <form id="logout" method="post" action="{{ route('chef.logout') }}">
                {{ csrf_field() }}
                <a id="logout-link" href="#">
                    Logout
                </a>
            </form>
    </div>
</div>

@endsection
