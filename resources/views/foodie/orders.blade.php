@extends('foodie.layout')

@section('page_content')

    <div class="container">
        <div class="row">
            <h2 class="center white-text">Orders</h2>
            <span class="center full-width white-text" style="font-size: 1.5em">Review your order before confirming!</span>
            <div class="card papaya-whip">
                <div class="card-content">
                    <h4 class="mustard-text">Order:</h4>
                    <div class="card">
                        <div class="card-panel">
                            <h4>Chef Name: {{$plan->chef->name}}</h4>
                            <h4>Plan Name:{{$plan->plan_name}}</h4>
                            <h4>Plan Price:{{$plan->price}}</h4>
                        </div>
                    </div>
                    <form action="{{route('foodie.order.create', $plan->id)}}" method="post">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-danger">Order !!!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection