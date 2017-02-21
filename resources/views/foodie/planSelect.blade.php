@extends('layouts.app')
@section('head')
    <title>Meal Planning - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="/css/foodie/app.css">
    <script src="/js/foodie/app.js" defer></script>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m10 offset-m1">
                <h2 class="center white-text">Diet Meal Planning</h2>
                <span class="center full-width white-text" style="font-size: 1.5em">We're in the mood for improving some diets!</span>
                <div class="card papaya-whip">
                    <div class="card-content">
                        <h4 class="mustard-text">Meal Plans:</h4>
                        @unless($planCount==0)
                            @foreach($plans->chunk(3) as $chunk)
                                <div class="row">
                                    @foreach($chunk as $plan)
                                        <div class="col s12 m6 l4">
                                            <div class="card sticky-action hoverable">
                                                <div class="card-image waves-effect waves-block waves-asparagus">
                                                    <img class="img-responsive activator" src="/img/diet-meal-1.jpg">
                                                </div>
                                                <div class="card-content">
                                                    <span class="card-title activator grey-text text-darken-4 no-pad-bot center">The Holiday Belly Buster Plan</span>
                                                </div>
                                                <div class="card-reveal center lime lighten-4">
                                                    <span class="card-title"><i class="material-icons right">close</i></span>
                                                    {{--route will go to the meals table page with id of plan passed--}}
                                                    <a class="customize-plan-option-btn" href="{{ route('foodie.chef.meal',['plan'=>$plan->id]) }}">
                                                        <span class="fa fa-pencil"></span>Customize
                                                    </a>
                                                    {{--<a class="meal-plan-option-btn" href="#"><span class="fa fa-trash"></span></a>--}}
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        @endunless
                    </div>
                </div>
            </div>
        </div>

        {{--<div id="createPlan" class="modal">--}}
            {{--<form action="{{route('chef.plan.create')}}" method="post">--}}
                {{--{{csrf_field()}}--}}
                {{--<div class="modal-content">--}}
                    {{--<label for="plan_name">Plan Name:</label>--}}
                    {{--<input type="text" name="plan_name" id="plan_name" class="form-control">--}}
                    {{--<label for="calories">Total Calories:</label>--}}
                    {{--<input type="text" name="calories" id="calories" class="form-control">--}}
                    {{--<label for="price">Price:</label>--}}
                    {{--<input type="text" name="price" id="price" class="form-control">--}}
                {{--</div>--}}
                {{--<div class="modal-footer">--}}
                    {{--<input type="submit" value="Submit" class="btn btn-primary">--}}
                {{--</div>--}}
            {{--</form>--}}
        {{--</div>--}}
    </div>
@endsection