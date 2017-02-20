@extends('layouts.app')
@section('head')
    <title>Chef - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="/css/foodie/app.css">
    <script src="/js/foodie/app.js" defer></script>
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col s12 m10 offset-m1">
            <h2 class="center white-text">Available Chefs</h2>
            <span class="center full-width white-text" style="font-size: 1.5em">Choose a chef you like!</span>
            <div class="card papaya-whip">
                <h4 class="mustard-text">Chefs:</h4>
                @foreach($chefs->chunk(3) as $chunk)
                    <div class="row">
                        @foreach($chunk as $chef)
                            <div class="col s12 m6 l4">
                                <div class="card sticky-action hoverable">
                                    <div class="card-image waves-effect waves-block waves-asparagus">
                                        <img class="img-responsive activator" src="/img/diet-meal-1.jpg">
                                    </div>
                                    <div class="card-content">
                                        <span class="card-title activator grey-text text-darken-4 no-pad-bot center">{{$chef->name}}</span>
                                    </div>
                                    <div class="card-reveal center lime lighten-4">
                                        <span class="card-title"><i class="material-icons right">close</i></span>
                                        {{--route will go to the meals table page with id of plan passed--}}
                                        {{--<a class="meal-plan-option-btn" href="{{ route('chef.plan.table',['plan'=>$plan->id]) }}"><span class="fa fa-pencil"></span></a>--}}
                                        {{--<a class="meal-plan-option-btn" href="#"><span class="fa fa-trash"></span></a>--}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection