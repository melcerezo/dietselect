@extends('foodie.layout')

@section('page_content')

    <div class="container">
        <div class="row">
            <h2 class="center white-text">Orders</h2>
            <span class="center full-width white-text" style="font-size: 1.5em">Review your order before confirming!</span>
            <div class="card papaya-whip">
                <div class="card-content">
                    <h4 class="mustard-text">Orders:</h4>

                    {{$plan->id}}
                    <br>

                    {{$plan->plan_name}}
                    <br>
                    {{$plan->price}}

                    <form action="{{route('foodie.order.create', $plan->id)}}" method="post">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-danger">Order !!!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection