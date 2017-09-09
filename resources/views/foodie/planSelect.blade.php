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
                <div class="row">
                    {{--<nav class="light-green lighten-1 white-text">--}}
                    <div class="left col s12">
                        <ul>
                            <li class="orange-text" style="border-left: 4px solid orange; padding-left: 5px;">
                                <span style="font-size: 20px;">PLANS BY CATEGORY</span>
                            </li>
                        </ul>
                    </div>
                    {{--</nav>--}}
                </div>
                <div class="col s12 m4" >
                    <div class="buyCateg light-green white-text">
                        <img class="lossPlan" src="/img/loss.png">
                        <div id="loss" data-categ="weightCateg" class="category" style="border-radius: 10px;">
                            <div style="position: relative;">
                                <span class="orange-text" style="position: absolute; top: 128px; left: 62px; font-size: 30px;">Weight Loss</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div class="buyCateg light-green white-text">
                        <img class="responsive-img" src="/img/protein.png">
                        <div id="protein" data-categ="protCateg" class="category" style="border-radius: 10px;">
                            <div style="position: relative; border-radius: 10px;">
                                <span class="orange-text" style="position: absolute; top: 128px; left: 62px; font-size: 30px;">High Protein</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col s12 m4">
                    <div class="buyCateg light-green white-text">
                        <img class="vegePlan" src="/img/vege.png">
                        <div id="vege" data-categ="vegeCateg" class="category" style="border-radius: 10px;">
                            <div style="position: relative; border-radius: 10px;">
                                <span class="orange-text" style="position: absolute; top: 128px; left: 62px; font-size: 30px;">Vegetarian</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m3">
                    <div class="orange-text" style="border-left: 4px solid orange; padding-left: 5px;">
                        <span style="font-size: 20px;">PLANS BY CHEF</span>
                    </div>
                    <ul>
                        @foreach($chefCurrent as $chef)
                            <li class="chef valign-wrapper"><div class="chefName" href="#" data-chef="{{$chef->id}}">{{$chef->name}}</div></li>
                        @endforeach
                        <li class="chef valign-wrapper"><div class="allName" href="#">All</div></li>
                    </ul>
                </div>
                <div id="planContainer" class="col s9">
                    <div id="allContainer">
                        <div class="orange-text" style="border-left: 4px solid orange; padding-left: 5px;">
                            <span style="font-size: 20px;">ALL PLANS</span>
                        </div>
                        @if($plans->count()>0)
                            @foreach($plans->chunk(3) as $chunk)
                                <div class="row">
                                    @foreach($chunk as $plan)
                                            <div class="col s12 m4">
                                                <div class="card buyCard">
                                                    <div class="card-image">
                                                        <img src="/img/{{$plan->picture}}">
                                                        <div class="orange white-text" style="position: absolute; left: 5px; top: 5px;">
                                                            PHP 1,800.00
                                                        </div>
                                                    </div>
                                                    <div class="card-content">
                                                        <div>
                                                            <div class="truncate"><span>{{$plan->plan_name}}</span></div>
                                                            <div style="font-size: 12px;">
                                                                <span>By: </span><span>{{$plan->chef->name}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="buyBtn center-align">
                                                            <a href="{{route('foodie.plan.standard', $plan->id)}}"
                                                               class="orange btn btn-primary waves-effect waves-light" style="font-weight: 100;">Buy Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                </div>
                            @endforeach
                        @else
                            <div>
                                <span>No Plans Yet for the coming Week!</span>
                            </div>
                        @endif
                    </div>
                    @foreach($chefCurrent as $chef)
                        <div id="{{$chef->id}}Container" class="chefContainer">
                            <div class="orange-text" style="border-left: 4px solid orange; padding-left: 5px;">
                                <span style="font-size: 20px;">{{strtoupper($chef->name)}} PLANS</span>
                            </div>
                            @if($plans->count()>0)
                                @foreach($plans->chunk(3) as $chunk)
                                    <div class="row">
                                        @foreach($chunk as $plan)
                                            @if($plan->chef_id==$chef->id)
                                                <div class="col s12 m4">
                                                    <div class="card buyCard">
                                                        <div class="card-image">
                                                            <img src="/img/{{$plan->picture}}">
                                                            <div class="orange white-text" style="position: absolute; left: 5px; top: 5px;">
                                                                PHP 1,800.00
                                                            </div>
                                                        </div>
                                                        <div class="card-content">
                                                            <div>
                                                                <div class="truncate"><span>{{$plan->plan_name}}</span></div>
                                                                <div style="font-size: 12px;">
                                                                    <span>By: </span><span>{{$plan->chef->name}}</span>
                                                                </div>
                                                            </div>
                                                            <div class="buyBtn center-align">
                                                                <a href="{{route('foodie.plan.standard', $plan->id)}}"
                                                                   class="orange btn btn-primary waves-effect waves-light" style="font-weight: 100;">Buy Now</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            @else
                                <div>
                                    <span>No Plans for this Chef!</span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <div id="lossContainer" class="categoryContainer">
                        <div class="orange-text" style="border-left: 4px solid orange; padding-left: 5px;">
                            <span style="font-size: 20px;">WEIGHT LOSS PLANS</span>
                        </div>
                        @if($plans->count()>0)
                            @foreach($plans->chunk(3) as $chunk)
                                <div class="row">
                                    @foreach($chunk as $plan)
                                        @if($plan->category==1)
                                            <div class="col s12 m4">
                                                <div class="card buyCard">
                                                    <div class="card-image">
                                                        <img src="/img/{{$plan->picture}}">
                                                        <div class="orange white-text" style="position: absolute; left: 5px; top: 5px;">
                                                            PHP 1,800.00
                                                        </div>
                                                    </div>
                                                    <div class="card-content">
                                                        <div>
                                                            <div class="truncate"><span>{{$plan->plan_name}}</span></div>
                                                            <div style="font-size: 12px;">
                                                                <span>By: </span><span>{{$plan->chef->name}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="buyBtn center-align">
                                                            <a href="{{route('foodie.plan.standard', $plan->id)}}"
                                                               class="orange btn btn-primary waves-effect waves-light" style="font-weight: 100;">Buy Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach
                        @else
                            <div>
                                <span>No Plans for this Category!</span>
                            </div>
                        @endif
                    </div>
                    <div id="protContainer" class="categoryContainer">
                        <div class="orange-text" style="border-left: 4px solid orange; padding-left: 5px;">
                            <span style="font-size: 20px;">HIGH PROTEIN PLANS</span>
                        </div>
                        @if($plans->count()>0)
                            @foreach($plans->chunk(3) as $chunk)
                                <div class="row">
                                    @foreach($chunk as $plan)
                                        @if($plan->category==2)
                                            <div class="col s12 m4">
                                                <div class="card buyCard">
                                                    <div class="card-image">
                                                        <img src="/img/{{$plan->picture}}">
                                                        <div class="orange white-text" style="position: absolute; left: 5px; top: 5px;">
                                                            PHP 1,800.00
                                                        </div>
                                                    </div>
                                                    <div class="card-content">
                                                        <div>
                                                            <div class="truncate"><span>{{$plan->plan_name}}</span></div>
                                                            <div style="font-size: 12px;">
                                                                <span>By: </span><span>{{$plan->chef->name}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="buyBtn center-align">
                                                            <a href="{{route('foodie.plan.standard', $plan->id)}}"
                                                               class="orange btn btn-primary waves-effect waves-light" style="font-weight: 100;">Buy Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach
                        @else
                            <div>
                                <span>No Plans for this Category!</span>
                            </div>
                        @endif
                    </div>
                    <div id="vegeContainer" class="categoryContainer">
                        <div class="orange-text" style="border-left: 4px solid orange; padding-left: 5px;">
                            <span style="font-size: 20px;">VEGETARIAN PLANS</span>
                        </div>
                        @if($plans->count()>0)
                            @foreach($plans->chunk(3) as $chunk)
                                <div class="row">
                                    @foreach($chunk as $plan)
                                        @if($plan->category==3)
                                            <div class="col s12 m4">
                                                <div class="card buyCard">
                                                    <div class="card-image">
                                                        <img src="/img/{{$plan->picture}}">
                                                        <div class="orange white-text" style="position: absolute; left: 5px; top: 5px;">
                                                            PHP 1,800.00
                                                        </div>
                                                    </div>
                                                    <div class="card-content">
                                                        <div>
                                                            <div class="truncate"><span>{{$plan->plan_name}}</span></div>
                                                            <div style="font-size: 12px;">
                                                                <span>By: </span><span>{{$plan->chef->name}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="buyBtn center-align">
                                                            <a href="{{route('foodie.plan.standard', $plan->id)}}"
                                                               class="orange btn btn-primary waves-effect waves-light" style="font-weight: 100;">Buy Now</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endforeach
                        @else
                            <div>
                                <span>No Plans for this Category!</span>
                            </div>
                        @endif
                    </div>

                </div>
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
