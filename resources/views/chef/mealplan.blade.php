@extends('chef.layout')
@section('page_head')
    <title>Meal Planning - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    <link rel="stylesheet" href="/css/chef/planner.css">
    <script src="/js/chef/planValidate.js" defer></script>
@endsection
@section('page_content')
<div class="container" style="width:85%; margin-top: 1rem;">
    @if($chef->bank_account)
            @if($planCount==0)
                <div class="row" style="margin-top:10px;">
                    <div class="col s12 m6 l4">
                        <div class="card sticky-action hoverable">
                            <div class="card-image waves-effect waves-block waves-asparagus">
                                <a href="#createPlan" class="modal-trigger">
                                    <span class="fa fa-plus-circle light-green-text" style="display: block; font-size: 8em; margin: 0.15em auto; width: 100%; text-align: center;"></span>
                                </a>
                            </div>
                            <div class="card-content no-pad-top">
                                <h2 class="card-title activator grey-text center text-darken-4 no-pad-bot">Add New Plan</h2>
                            </div>
                        </div>
                    </div>
                </div>
            @else

            <div class="row">
                <div class="col s12 m2">
                    <div class="row">
                        <div>
                            VIEW PLANS
                        </div>
                    </div>
                    <div class="divider"></div>
                    <ul class="collection">
                        <li class="collection-item" style="border: 1px solid #f57c00;">
                            <a href="{{route("chef.order.view", ['id'=> 0])}}" style="color: #f57c00;" >Orders</a>
                        </li>
                        <li class="collection-item">
                            <a href="{{route('chef.plan')}}">View Your Plans</a>
                        </li>
                        <li class="collection-item">
                            <a href="{{route('chef.profile')}}">Profile</a>
                        </li>
                        <li class="collection-item">
                            <a href="{{route('chef.message.index')}}">Messages</a>
                            @if($messages->count()>0)
                                <span class="new badge red">{{$messages->count()}}</span>
                            @endif
                        </li>
                        <li class="collection-item" >
                            <a href="{{route('chef.ratings')}}">Ratings</a>
                        </li>
                    </ul>
                </div>
                <div class="col s12 m3">
                    <div class="orange-text text-darken-2" style="border-left: 4px solid orange; padding-left: 5px;">
                        <span style="font-size: 20px;">YOUR PLANS</span>
                    </div>
                    <ul>
                        <li class="chef valign-wrapper"><div class="upcomingName" href="#">Upcoming Plans</div></li>
                        <li class="chef valign-wrapper"><div class="currentName" href="#">Current Plans</div></li>
                        <li class="chef valign-wrapper"><div class="allName" href="#">All</div></li>
                    </ul>
                    <div>
                        <button data-target="createPlan" class="btn orange darken-2 waves-effect waves-light modal-trigger">Add Plan</button>
                    </div>

                </div>
                <div id="planContainer" class="col s12 m7">
                    <div id="allContainer">
                        <div class="orange-text text-darken-2" style="border-left: 4px solid orange; padding-left: 5px;">
                            <span style="font-size: 20px;">ALL PLANS</span>
                        </div>
                        @if($plans->count()>0)
                            @foreach($allPlans->chunk(2) as $chunk)
                                <div class="row">
                                    @foreach($chunk as $plan)
                                        <div class="col s12 m4">
                                            <div class="card buyCard">
                                                <div class="card-image">
                                                    <img src="/img/{{$plan->picture}}">
                                                    <div class="orange darken-2 white-text" style="position: absolute; left: 5px; top: 5px;">
                                                        {{'PHP '.number_format($plan->price, 2,'.',',')}}
                                                    </div>
                                                </div>
                                                <div class="card-content">
                                                    <div>
                                                        <div class="truncate" style="font-size: 18px;"><span>{{$plan->plan_name}}</span></div>
                                                        <div style="font-size: 16px;">
                                                            <span>By: </span><span>{{$plan->chef->name}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="buyBtn center-align">
                                                        <a href="{{route('chef.plan.table',['plan'=>$plan->id])}}"
                                                           class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">View</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        @else
                            <div>
                                <span>No Plans!</span>
                            </div>
                        @endif
                    </div>
                    <div id="currentContainer" class="categoryContainer">
                        <div class="orange-text text-darken-2" style="border-left: 4px solid orange; padding-left: 5px;">
                            <span style="font-size: 20px;">CURRENT PLANS</span>
                        </div>
                        @if($plans->count()>0)
                            @foreach($plans->chunk(3) as $chunk)
                                <div class="row">
                                    @foreach($chunk as $plan)
                                            <div class="col s12 m4">
                                                <div class="card buyCard">
                                                    <div class="card-image">
                                                        <img src="/img/{{$plan->picture}}">
                                                        <div class="orange darken-2 white-text" style="position: absolute; left: 5px; top: 5px;">
                                                            {{'PHP '.number_format($plan->price, 2,'.',',')}}
                                                        </div>
                                                    </div>
                                                    <div class="card-content">
                                                        <div>
                                                            <div class="truncate" style="font-size: 18px;"><span>{{$plan->plan_name}}</span></div>
                                                            <div style="font-size: 16px;">
                                                                <span>By: </span><span>{{$plan->chef->name}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="buyBtn center-align">
                                                            <a href="{{route('chef.plan.table',['plan'=>$plan->id])}}"
                                                               class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">View</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach
                                </div>
                            @endforeach
                        @else
                            <div>
                                <span>No Plans for this Category!</span>
                            </div>
                        @endif
                    </div>
                    <div id="upcomingContainer" class="categoryContainer">
                        <div class="orange-text text-darken-2" style="border-left: 4px solid orange; padding-left: 5px;">
                            <span style="font-size: 20px;">UPCOMING PLANS</span>
                        </div>
                        @if($plans->count()>0)
                            @foreach($futurePlans->chunk(3) as $chunk)
                                <div class="row">
                                    @foreach($chunk as $plan)
                                            <div class="col s12 m4">
                                                <div class="card buyCard">
                                                    <div class="card-image">
                                                        <img src="/img/{{$plan->picture}}">
                                                        <div class="orange darken-2 white-text" style="position: absolute; left: 5px; top: 5px;">
                                                            {{'PHP '.number_format($plan->price, 2,'.',',')}}
                                                        </div>
                                                    </div>
                                                    <div class="card-content">
                                                        <div>
                                                            <div class="truncate" style="font-size: 18px;"><span>{{$plan->plan_name}}</span></div>
                                                            <div style="font-size: 16px;">
                                                                <span>By: </span><span>{{$plan->chef->name}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="buyBtn center-align">
                                                            <a href="{{route('chef.plan.table',['plan'=>$plan->id])}}"
                                                               class="orange darken-2 btn btn-primary waves-effect waves-light" style="font-weight: 100;">View</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
        @endif
    @else
        <span>You do not have a recorded bank account. <a href="{{route('chef.profile')}}">Please provide a bank account through your profile page!</a></span>
    @endif
</div>
                {{--<div class="row" style="margin-top:10px;">--}}
                    {{--<nav class="light-green lighten-1 white-text">--}}
                        {{--<div class="left col s12">--}}
                            {{--<ul>--}}
                                {{--<li>--}}
                                    {{--<span style="font-size: 20px;">Upcoming Plans</span>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</nav>--}}
                    {{--@foreach($futurePlans->chunk(3) as $chunk)--}}
                        {{--@foreach($chunk as $plan)--}}
                            {{--<div class="col s12 m6 l4">--}}
                                {{--<div class="card sticky-action hoverable">--}}
                                    {{--<div class="card-image waves-effect waves-block waves-asparagus">--}}
                                        {{--<a href="{{ route('chef.plan.table',['plan'=>$plan->id]) }}">--}}
                                            {{--@if($plan->picture=='')--}}
                                                {{--<img class="img-responsive" style="height: 120px;" src="/img/diet-meal-1.jpg">--}}
                                            {{--@else--}}
                                                {{--image of plan--}}
                                                {{--<img class="img-responsive" style="height: 200px;" src="/img/{{ $plan->picture }}"/>--}}
                                            {{--@endif--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="card-content">--}}
                                        {{--<span class="card-title activator grey-text text-darken-4 no-pad-bot center">{{$plan->plan_name}}</span>--}}
                                        {{--@if($plan->lockPlan==1)--}}
                                            {{--<span><i class="material-icons" style="display: inline;">lock_outline</i></span>--}}
                                        {{--@else--}}
                                            {{--<span><i class="material-icons" style="display: inline;">lock_open</i></span>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div id="deletePlan" class="modal">--}}
                                    {{--<h4>Are you sure you want to delete {{$plan->plan_name}}</h4>--}}
                                    {{--<div class="modal-content">--}}
                                        {{--<form id="deletePlanForm" action="{{route('chef.plan.delete',['plan'=>$plan->id])}}" method="post">--}}
                                            {{--{{csrf_field()}}--}}
                                            {{--<div>--}}
                                                {{--<input type="submit" value="Submit" class="btn btn-primary">--}}
                                            {{--</div>--}}
                                        {{--</form>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--@endforeach--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                    {{--<nav class="light-green lighten-1 white-text">--}}
                        {{--<div class="left col s12">--}}
                            {{--<ul>--}}
                                {{--<li>--}}
                                    {{--<span style="font-size: 20px;">Current Plans</span>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</nav>--}}
                {{--@foreach($plans->chunk(3) as $chunk)--}}
                       {{--@foreach($chunk as $plan)--}}
                            {{--<div class="col s12 m6 l4">--}}
                                {{--<div class="card sticky-action hoverable">--}}
                                    {{--<div class="card-image waves-effect waves-block waves-asparagus">--}}
                                        {{--<a href="{{ route('chef.plan.table',['plan'=>$plan->id]) }}">--}}
                                            {{--@if($plan->picture=='')--}}
                                                {{--<img class="img-responsive" src="/img/diet-meal-1.jpg">--}}
                                            {{--@else--}}
                                                {{--image of plan--}}
                                                {{--<img class="img-responsive" style="height: 200px;" src="/img/{{ $plan->picture }}"/>--}}
                                            {{--@endif--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="card-content">--}}
                                        {{--<span class="card-title activator grey-text text-darken-4 no-pad-bot center">{{$plan->plan_name}}</span>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div id="deletePlan" class="modal">--}}
                                    {{--<h4>Are you sure you want to delete {{$plan->plan_name}}</h4>--}}
                                    {{--<div class="modal-content">--}}
                                        {{--<form id="deletePlanForm" action="{{route('chef.plan.delete',['plan'=>$plan->id])}}" method="post">--}}
                                            {{--{{csrf_field()}}--}}
                                            {{--<div>--}}
                                                {{--<input type="submit" value="Submit" class="btn btn-primary">--}}
                                            {{--</div>--}}
                                        {{--</form>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                       {{--@endforeach--}}
                {{--@endforeach--}}
            {{--<div class="row">--}}
                {{--<div class="col s12">--}}
                    {{--<button data-target="createPlan" class="modal-trigger btn waves-effect waves-light">Add New Plan</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}




    <div id="createPlan" class="modal">
        <div style="font-size: 30px; border-left: 4px solid #f57c00; margin: 24px 0 10px 24px; padding-left: 5px;">
            <span>Create Plan</span>
        </div>
        <div class="divider" style="margin: 0 5px;">
        </div>
            <div class="modal-content">
                <form id="createPlanForm" action="{{route('chef.plan.create')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                        <div class="row">
                            <div class="input-field">
                                <label for="plan_name">Plan Name:</label>
                                <input type="text" name="plan_name" id="plan_name" data-error=".error-plan-name" class="form-control">
                                <div class="error-plan-name err"></div>
                            </div>
                        </div>
                       <div class="row">
                           <div class="input-field">
                                <label for="calories">Total Calories:</label>
                                <input type="text" name="calories" id="calories" data-error=".error-calories" class="form-control">
                                <div class="error-calories err"></div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="input-field">
                                <label for="description">Description:</label>
                                <textarea id="description" name="description" data-error=".error-description" class="materialize-textarea" length="255" value=""></textarea>
                                <div class="error-description err"></div>
                           </div>
                        </div>
                        {{--<div class="row">--}}
                            {{--<div class="input-field">--}}
                                {{--<label for="category" class="active">Category:</label>--}}
                                {{--<select name="category" id="category" data-error=".error-description">--}}
                                    {{--<option value="">Select category</option>--}}
                                    {{--<option value="1">Weight Loss</option>--}}
                                    {{--<option value="2">High Protein</option>--}}
                                    {{--<option value="3">Vegetarian</option>--}}
                                {{--</select>--}}
                                {{--<div class="error-description err"></div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="row">
                           <div class="file-field input-field">
                                <label for="planPic" class="active">Picture Upload:</label>
                               <div style="padding-top: 10px;">
                                   <div class="btn orange darken-2">
                                       <span>File</span>
                                       <input type="file" data-error=".error-pic" id="planPic" name="planPic">
                                   </div>
                                   <div class="file-path-wrapper">
                                       <input class="file-path validate" type="text" >
                                   </div>
                                    <div class="error-pic err"></div>
                               </div>
                           </div>
                        </div>
                        <div class="row">
                            <div class="input-field">
                                <label for="price">Price:</label>
                                <input type="text" name="price" id="price" data-error=".error-price" class="form-control">
                                <div class="error-price err"></div>
                            </div>
                        </div>
                        <input type="submit" value="Submit" class="btn orange darken-2 btn-primary">
                </form>
        </div>


    </div>


@endsection
