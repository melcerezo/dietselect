@extends('layouts.app')

@section('content')

    <div class="container">

        {{$plan->id}}
        <br>

        {{$plan->plan_name}}
        <br>
        {{$plan->price}}

        <button class="btn btn-danger">Button</button>
    </div>

@endsection