@extends('chef.layout')
@section('page_head')
    <title>Meal Planning - Diet Select PH | Treating yourself the right way!</title>
    <meta name="description" content="">
    <script src="/js/chef/planValidate.js" defer></script>
@endsection
@section('page_content')
<div class="container">
    <div class="row">
        <div class="col s12 m10 offset-m1">
            <h2 class="center white-text">Diet Meal Planning</h2>
            <span class="center full-width white-text" style="font-size: 1.5em">We're in the mood for improving some diets!</span>
            <div class="card papaya-whip">
                <div class="card-content">
                    <h4 class="mustard-text">Meal Plans:</h4>
                    @if($planCount==0)
                        <div class="row">
                            <div class="col s12 m6 l4">
                                <div class="card sticky-action hoverable">
                                    <div class="card-image waves-effect waves-block waves-asparagus">
                                        <a href="#createPlan" class="modal-trigger">
                                            <span class="fa fa-plus-circle light-green-text" style="display: block; font-size: 8em; margin: 0.15em auto; width: 100%; text-align: center;"></span>
                                        </a>
                                    </div>
                                    <div class="card-content no-pad-top">
                                        <h2 class="card-title activator grey-text center text-darken-4 no-pad-bot">Add New Meal Plan</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row">
                            <div>
                                <h4>Upcomming: </h4>
                            </div>
                            @foreach($futurePlans->chunk(3) as $chunk)
                                @foreach($chunk as $plan)
                                    <div class="col s12 m6 l4">
                                        <div class="card sticky-action hoverable">
                                            <div class="card-image waves-effect waves-block waves-asparagus">
                                                <a href="{{ route('chef.plan.table',['plan'=>$plan->id]) }}">
                                                    <img class="img-responsive" src="/img/diet-meal-1.jpg">
                                                </a>
                                            </div>
                                            <div class="card-content">
                                                <span class="card-title activator grey-text text-darken-4 no-pad-bot center">{{$plan->plan_name}}</span>
                                            </div>
                                            {{--<div class="card-reveal center lime lighten-4">--}}
                                            {{--<span class="card-title"><i class="material-icons right">close</i></span>--}}
                                            {{--route will go to the meals table page with id of plan passed--}}
                                            {{--<a class="meal-plan-option-btn" href="{{ route('chef.plan.table',['plan'=>$plan->id]) }}"><span class="fa fa-pencil"></span></a>--}}
                                            {{--<a class="meal-plan-option-btn modal-trigger" href="#deletePlan"><span class="fa fa-trash"></span></a>--}}
                                            {{--</div>--}}
                                        </div>
                                        <div id="deletePlan" class="modal">
                                            <h4>Are you sure you want to delete {{$plan->plan_name}}</h4>
                                            <div class="modal-content">
                                                <form id="deletePlanForm" action="{{route('chef.plan.delete',['plan'=>$plan->id])}}" method="post">
                                                    {{csrf_field()}}
                                                    <div>
                                                        <input type="submit" value="Submit" class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                            {{--<div class="col s12 m6 l4">--}}
                                {{--<div class="card sticky-action hoverable">--}}

                                    {{--<div class="card-image waves-effect waves-block waves-asparagus">--}}

                                        {{--<a href="#createPlan" class="modal-trigger">--}}
                                            {{--<span class="fa fa-plus-circle light-green-text" style="display: block; font-size: 8em; margin: 0.15em auto; width: 100%; text-align: center;"></span>--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                    {{--<div class="card-content no-pad-top">--}}
                                        {{--<h2 class="card-title activator grey-text center text-darken-4 no-pad-bot">Add New Meal Plan</h2>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        </div>
                        <div class="row">
                        <div>
                            <h4>Current Plans: </h4>
                        </div>

                        @foreach($plans->chunk(3) as $chunk)
                               @foreach($chunk as $plan)
                                    <div class="col s12 m6 l4">
                                        <div class="card sticky-action hoverable">
                                            <div class="card-image waves-effect waves-block waves-asparagus">
                                                <a href="{{ route('chef.plan.table',['plan'=>$plan->id]) }}">
                                                    <img class="img-responsive" src="/img/diet-meal-1.jpg">
                                                </a>
                                            </div>
                                            <div class="card-content">
                                                <span class="card-title activator grey-text text-darken-4 no-pad-bot center">{{$plan->plan_name}}</span>
                                            </div>
                                            {{--<div class="card-reveal center lime lighten-4">--}}
                                                {{--<span class="card-title"><i class="material-icons right">close</i></span>--}}
                                                 {{--route will go to the meals table page with id of plan passed--}}
                                                {{--<a class="meal-plan-option-btn" href="{{ route('chef.plan.table',['plan'=>$plan->id]) }}"><span class="fa fa-pencil"></span></a>--}}
                                                {{--<a class="meal-plan-option-btn modal-trigger" href="#deletePlan"><span class="fa fa-trash"></span></a>--}}
                                            {{--</div>--}}
                                        </div>
                                        <div id="deletePlan" class="modal">
                                            <h4>Are you sure you want to delete {{$plan->plan_name}}</h4>
                                            <div class="modal-content">
                                                <form id="deletePlanForm" action="{{route('chef.plan.delete',['plan'=>$plan->id])}}" method="post">
                                                    {{csrf_field()}}
                                                    <div>
                                                        <input type="submit" value="Submit" class="btn btn-primary">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                               @endforeach
                        @endforeach
                    <div class="col s12 m6 l4">
                       <div class="card sticky-action hoverable">

                           <div class="card-image waves-effect waves-block waves-asparagus">

                              <a href="#createPlan" class="modal-trigger">
                                  <span class="fa fa-plus-circle light-green-text" style="display: block; font-size: 8em; margin: 0.15em auto; width: 100%; text-align: center;"></span>
                              </a>
                           </div>
                           <div class="card-content no-pad-top">
                               <h2 class="card-title activator grey-text center text-darken-4 no-pad-bot">Add New Meal Plan</h2>
                           </div>
                       </div>
                   </div>
                </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div id="createPlan" class="modal">
        <form id="createPlanForm" action="{{route('chef.plan.create')}}" method="post">
            {{csrf_field()}}
            <div class="modal-content">

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
                        <label for="calories">Description:</label>
                        <textarea id="description" name="description" class="materialize-textarea" length="255" value=""></textarea>
                        <div class="error-calories err"></div>
                   </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <label for="price">Price:</label>
                        <input type="text" name="price" id="price" data-error=".error-price" class="form-control">
                        <div class="error-price err"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="submit" value="Submit" class="btn btn-primary">
            </div>
        </form>
    </div>

</div>
@endsection
