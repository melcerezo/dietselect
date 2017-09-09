@extends('foodie.layout')
@section('page_head')
    <title>Meal Planning - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="/css/foodie/planSelect.css">
    <script src="/js/foodie/planSelect.js" defer></script>
@endsection
@section('page_content')
    @if($sms_unverified && $foodie->birthday==null)
        <div style="margin-top: 10px;">
            Please verify your phone number and birthday before ordering any plans.
        </div>
    @elseif($sms_unverified)
        <div style="margin-top: 10px;">
            Please verify your phone number before ordering any plans.
        </div>
    @elseif($foodie->birthday==null)
        <div style="margin-top: 10px;">
            Please verify your birthday before ordering any plans.
        </div>
    @else
        <div class="container plSlCntr">
            <div class="row">
                {{--<nav class="light-green lighten-1 white-text">--}}
                    <div class="left col s12">
                        <ul>
                            <li>
                                <span style="font-size: 20px;">Plans</span>
                            </li>
                        </ul>
                    </div>
                {{--</nav>--}}
            </div>
            <div class="row">
                <div class="col s12 m4" >
                    <div class="buyCateg" style="max-width: 400px; max-height: 400px;">
                        <img class="responsive-img" src="/img/bg.jpg">
                        <div class="category">
                            <div class="center-align valign-wrapper">
                                <span class="orange-text" style="font-size: 30px;">Weight Loss</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div class="buyCateg" style="max-width: 400px; max-height: 400px;">
                        <img class="responsive-img" src="/img/bg.jpg">
                        <div class="category">
                            <div class="center-align valign-wrapper">
                                <span class="orange-text" style="font-size: 30px;">High Protein</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div class="buyCateg" style="max-width: 400px; max-height: 400px;">
                        <img class="responsive-img" src="/img/bg.jpg">
                        <div class="category">
                            <div class="center-align valign-wrapper">
                                <span class="orange-text" style="font-size: 30px;">Vegetarian</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                @if($plans->count()>0)
                    @foreach($plans->chunk(3) as $chunk)
                        <div class="row">
                            @foreach($chunk as $plan)
                                <a href="{{route('foodie.plan.standard', $plan->id)}}" class="plSlCntA">
                                    <div class="col s12 m4">
                                        <div>
                                           <img src="/img/{{$plan->picture}}" class="img-responsive" style="max-width:200px;"/>
                                        </div>
                                        <div class="plSlCnt">
                                            <div class="plSlCntTtl">
                                                <span>{{$plan->plan_name}}</span>
                                            </div>
                                            <div class="plSlCntChf">
                                                <span>By: </span><span>{{$plan->chef->name}}</span>
                                            </div>
                                            <div class="plSlCntDes">
                                                <p>{{$plan->description}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endforeach
                @else
                    <div>
                        <span>No Plans Yet for the coming Week!</span>
                    </div>
                @endif
            </div>
        </div>
    @endif
@endsection



{{--<div class="col s12 m10 offset-m1">--}}
                {{--<h2 class="center white-text">Diet Meal Planning</h2>--}}
                {{--<span class="center full-width white-text" style="font-size: 1.5em">We're in the mood for improving some diets!</span>--}}
                {{--<div class="card papaya-whip">--}}
                    {{--<div class="card-content">--}}
                        {{--<h4 class="mustard-text">Meal Plans:</h4>--}}
                        {{--@unless($planCount==0)--}}
                            {{--@foreach($plans->chunk(3) as $chunk)--}}
                                {{--<div class="row">--}}
                                    {{--@foreach($chunk as $plan)--}}
                                        {{--<div class="col s12 m6 l4">--}}
                                            {{--<div class="card sticky-action hoverable">--}}
                                                {{--<div class="card-image waves-effect waves-block waves-asparagus">--}}
                                                    {{--<img class="img-responsive activator" src="/img/diet-meal-1.jpg">--}}
                                                {{--</div>--}}
                                                {{--<div class="card-content">--}}
                                                    {{--<span class="card-title activator grey-text text-darken-4 no-pad-bot center">{{$plan->plan_name}}</span>--}}
                                                {{--</div>--}}
                                                {{--<div class="card-reveal center lime lighten-4">--}}
                                                    {{--<div>--}}
                                                        {{--<span class="card-title"><i--}}
                                                                    {{--class="material-icons right">close</i></span>--}}
                                                        {{--<div style="clear:both;"></div>--}}
                                                    {{--</div>--}}
                                                    {{--route will go to the meals table page with id of plan passed--}}
                                                    {{--                                                    <a class="customize-plan-option-btn" href="{{ route('foodie.chef.meal',['plan'=>$plan->id]) }}">--}}
                                                    {{--<div>--}}
                                                        {{--<a class="customize-plan-option-btn"--}}
                                                           {{--href="{{ route('foodie.chef.meal', $plan->id) }}">--}}
                                                            {{--<span class="fa fa-pencil"></span><span--}}
                                                                    {{--style="font-size: 10px;">Customize</span>--}}
                                                        {{--</a>--}}
                                                    {{--</div>--}}
                                                    {{--<div>--}}
                                                        {{--<a class="customize-plan-option-btn"--}}
                                                           {{--href="{{ route('foodie.order.review', $plan->id) }}">--}}
                                                            {{--<span class="fa fa-pencil"></span><span--}}
                                                                    {{--style="font-size: 10px;">Standard</span>--}}
                                                        {{--</a>--}}
                                                    {{--</div>--}}
                                                    {{--<a class="meal-plan-option-btn" href="#"><span class="fa fa-trash"></span></a>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                            {{--@endforeach--}}
                        {{--@endunless--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
