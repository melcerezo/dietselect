@extends('layouts.app')

@section('content')

    <div class="container">

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

@endsection