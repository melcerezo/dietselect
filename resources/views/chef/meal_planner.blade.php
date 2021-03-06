@extends('chef.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/chef/meal_planner.css">
    <script>
        lockPlan='{{$plan->lockPlan}}';
    </script>
    <script src="/js/chef/meal_planner.js"></script>
    <script src="/js/ingredientAutocomplete.js"></script>
    <script src="/js/chef/mealPlannerValidate.js"></script>
@endsection


@section('page_content')
    <div class="container" style="margin-top: 0.5rem;">
        <div class="row">
            <a class="orange-text text-darken-2" href="{{route('chef.plan')}}">< Back to Plans</a>
        </div>
        <div class="row mlPlnTtl">
            <span>{{$plan->plan_name}}</span>
            @if($plan->lockPlan==1)
                <span><i class="material-icons" style="display: inline; color: #f57c00;">lock_outline</i></span>
            @else
                <span><i class="material-icons" style="display: inline; color: #f57c00;">lock_open</i></span>
            @endif
        </div>
        <div class="divider"></div>
        <div class="row mlPlnCnt">
            <div class="col s12 m3">
                <div id="monday" class="calDay">
                    <div class="dayTtl">
                        <span>Monday</span>
                    </div>
                    <div class="divider"></div>
                    <div id="moBre" class="mealDay brekk">
                        <div class="mlTtl">
                            <span>Breakfast</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="MO" data-meal-type="Breakfast">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Breakfast')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="moMS" class="mealDay">
                        <div class="mlTtl">
                            <span>Morning Snack</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="MO" data-meal-type="MorningSnack">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'MorningSnack')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="moLun" class="mealDay">
                        <div class="mlTtl">
                            <span>Lunch</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="MO" data-meal-type="Lunch">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Lunch')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="moAS" class="mealDay">
                        <div class="mlTtl">
                            <span>Afternoon Snack</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="MO" data-meal-type="AfternoonSnack">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'AfternoonSnack')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="moDin" class="mealDay">
                        <div class="mlTtl">
                            <span>Dinner</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="MO" data-meal-type="Dinner">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Dinner')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div id="tuesday" class="calDay">
                    <div class="dayTtl">
                        <span>Tuesday</span>
                    </div>
                    <div class="divider"></div>
                    <div id="tuBre" class="mealDay brekk">
                        <div class="mlTtl">
                            <span>Breakfast</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="TU" data-meal-type="Breakfast">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Breakfast')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="tuMS" class="mealDay">
                        <div class="mlTtl">
                            <span>Morning Snack</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="TU" data-meal-type="MorningSnack">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'MorningSnack')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="tuLun" class="mealDay">
                        <div class="mlTtl">
                            <span>Lunch</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="TU" data-meal-type="Lunch">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Lunch')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="tuAS" class="mealDay">
                        <div class="mlTtl">
                            <span>Afternoon Snack</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="TU" data-meal-type="AfternoonSnack">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'AfternoonSnack')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="tuDin" class="mealDay">
                        <div class="mlTtl">
                            <span>Dinner</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="TU" data-meal-type="Dinner">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Dinner')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div id="wednesday" class="calDay">
                    <div class="dayTtl">
                        <span>Wednesday</span>
                    </div>
                    <div class="divider"></div>
                    <div id="weBre" class="mealDay brekk">
                        <div class="mlTtl">
                            <span>Breakfast</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="WE" data-meal-type="Breakfast">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Breakfast')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="weMS" class="mealDay">
                        <div class="mlTtl">
                            <span>Morning Snack</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="WE" data-meal-type="MorningSnack">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'MorningSnack')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="weLun" class="mealDay">
                        <div class="mlTtl">
                            <span>Lunch</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="WE" data-meal-type="Lunch">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Lunch')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="weAS" class="mealDay">
                        <div class="mlTtl">
                            <span>Afternoon Snack</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="WE" data-meal-type="AfternoonSnack">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'AfternoonSnack')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="weDin" class="mealDay">
                        <div class="mlTtl">
                            <span>Dinner</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="WE" data-meal-type="Dinner">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Dinner')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m3 custAction">
                <div>
                    @if($plan->lockPlan==0)
                        <div style="font-size: 20px; margin: 10px 0;">
                            <button id="fnshEdt" data-target="finishEdit" class="orange darken-2 btn waves-effect waves-light modal-trigger">Finish</button>
                        </div>
                    @else
                        <div style="font-size: 20px; margin: 10px 0;">
                            <button id="unlckPln" data-target="unlckPlnMdl" class="orange darken-2 btn waves-effect waves-light modal-trigger">Unlock</button>
                        </div>
                        <div class="divider">
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row mlPlnCnt">
            <div class="col s12 m3">
                <div id="thursday" class="calDay">
                    <div class="dayTtl">
                        <span>Thursday</span>
                    </div>
                    <div class="divider"></div>
                    <div id="thBre" class="mealDay brekk">
                        <div class="mlTtl">
                            <span>Breakfast</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="TH" data-meal-type="Breakfast">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Breakfast')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="thMS" class="mealDay">
                        <div class="mlTtl">
                            <span>Morning Snack</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="TH" data-meal-type="MorningSnack">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'MorningSnack')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="thLun" class="mealDay">
                        <div class="mlTtl">
                            <span>Lunch</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="TH" data-meal-type="Lunch">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Lunch')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="thAS" class="mealDay">
                        <div class="mlTtl">
                            <span>Afternoon Snack</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="TH" data-meal-type="AfternoonSnack">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'AfternoonSnack')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="thDin" class="mealDay">
                        <div class="mlTtl">
                            <span>Dinner</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="TH" data-meal-type="Dinner">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Dinner')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div id="friday" class="calDay">
                    <div class="dayTtl">
                        <span>Friday</span>
                    </div>
                    <div class="divider"></div>
                    <div id="frBre" class="mealDay brekk">
                        <div class="mlTtl">
                            <span>Breakfast</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="FR" data-meal-type="Breakfast">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Breakfast')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="frMS" class="mealDay">
                        <div class="mlTtl">
                            <span>Morning Snack</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="FR" data-meal-type="MorningSnack">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'MorningSnack')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="frLun" class="mealDay">
                        <div class="mlTtl">
                            <span>Lunch</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="FR" data-meal-type="Lunch">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Lunch')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="frAS" class="mealDay">
                        <div class="mlTtl">
                            <span>Afternoon Snack</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="FR" data-meal-type="AfternoonSnack">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'AfternoonSnack')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="frDin" class="mealDay">
                        <div class="mlTtl">
                            <span>Dinner</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="FR" data-meal-type="Dinner">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Dinner')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div id="saturday" class="calDay">
                    <div class="dayTtl">
                        <span>Saturday</span>
                    </div>
                    <div class="divider"></div>
                    <div id="saBre" class="mealDay brekk">
                        <div class="mlTtl">
                            <span>Breakfast</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="SA" data-meal-type="Breakfast">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Breakfast')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="saMS" class="mealDay">
                        <div class="mlTtl">
                            <span>Morning Snack</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="SA" data-meal-type="MorningSnack">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'MorningSnack')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="saLun" class="mealDay">
                        <div class="mlTtl">
                            <span>Lunch</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="SA" data-meal-type="Lunch">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Lunch')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="saAS" class="mealDay">
                        <div class="mlTtl">
                            <span>Afternoon Snack</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="SA" data-meal-type="AfternoonSnack">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'AfternoonSnack')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="saDin" class="mealDay">
                        <div class="mlTtl">
                            <span>Dinner</span>
                        </div>
                        <div class="divider" style="margin: 0 5px;"></div>
                        <div class="mlCnt" data-day="SA" data-meal-type="Dinner">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Dinner')
                                    <a href="#editMeal-{{$id}}" data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        {{--<div class="row">--}}
            {{--<nav class="light-green lighten-1">--}}
                {{--<div class="nav-wrapper">--}}
                    {{--<div class="left col s12 m5 l5">--}}
                        {{--<ul>--}}
                            {{--<li>--}}
                                {{--<span style="font-size: 20px;">{{$plan->plan_name}}</span>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                    {{--<div class="left col s12 m7 l7 hide-on-med-and-down">--}}
                        {{--<ul class="right">--}}
                            {{--<li>--}}
                                {{--@if($plan->lockPlan==1)--}}
                                    {{--<span><i class="material-icons" style="display: inline;">lock_outline</i></span>--}}
                                {{--@else--}}
                                    {{--<span><i class="material-icons" style="display: inline;">lock_open</i></span>--}}
                                {{--@endif--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</nav>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="card-panel" style="padding: 0;">--}}
                {{--<table class="striped centered responsive-table" style="table-layout: fixed;">--}}
                    {{--<thead class="light-green white-text" style="border: none;">--}}
                        {{--<tr>--}}
                            {{--<th></th>--}}
                            {{--<th>Breakfast</th>--}}
                            {{--<th>Morning Snack</th>--}}
                            {{--<th>Lunch</th>--}}
                            {{--<th>Afternoon Snack</th>--}}
                            {{--<th>Dinner</th>--}}
                        {{--</tr>--}}
                    {{--</thead>--}}
                    {{--<tbody>--}}
                    {{--<tr>--}}
                        {{--<td class="light-green white-text" style="font-weight: bold;">Monday</td>--}}
                        {{--<td id="MOBreakfast" data-day="MO" data-meal-type="Breakfast" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Breakfast')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="MOMorningSnack" data-day="MO" data-meal-type="MorningSnack" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'MorningSnack')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="MOLunch" data-day="MO" data-meal-type="Lunch" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Lunch')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="MOAfternoonSnack" data-day="MO" data-meal-type="AfternoonSnack" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="MODinner" data-day="MO" data-meal-type="Dinner" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Dinner')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td class="light-green white-text" style="font-weight: bold;">Tuesday</td>--}}
                        {{--<td id="TUBreakfast" data-day="TU" data-meal-type="Breakfast" class="">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Breakfast')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="TUMorningSnack" data-day="TU" data-meal-type="MorningSnack" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'MorningSnack')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="TULunch" data-day="TU" data-meal-type="Lunch" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Lunch')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="TUAfternoonSnack" data-day="TU" data-meal-type="AfternoonSnack" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="TUDinner" data-day="TU" data-meal-type="Dinner" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Dinner')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td class="light-green white-text" style="font-weight: bold;">Wednesday</td>--}}
                        {{--<td id="WEBreakfast" data-day="WE" data-meal-type="Breakfast" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Breakfast')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="WEMorningSnack" data-day="WE" data-meal-type="MorningSnack" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'MorningSnack')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="WELunch" data-day="WE" data-meal-type="Lunch" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Lunch')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="WEAfternoonSnack" data-day="WE" data-meal-type="AfternoonSnack" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="WEDinner" data-day="WE" data-meal-type="Dinner" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Dinner')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td class="light-green white-text" style="font-weight: bold;">Thursday</td>--}}
                        {{--<td id="THBreakfast" data-day="TH" data-meal-type="Breakfast" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Breakfast')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="THMorningSnack" data-day="TH" data-meal-type="MorningSnack" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'MorningSnack')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="THLunch" data-day="TH" data-meal-type="Lunch" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Lunch')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="THAfternoonSnack" data-day="TH" data-meal-type="AfternoonSnack" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="THDinner" data-day="TH" data-meal-type="Dinner" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Dinner')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td class="light-green white-text" style="font-weight: bold;">Friday</td>--}}
                        {{--<td id="FRBreakfast" data-day="FR" data-meal-type="Breakfast" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Breakfast')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="FRMorningSnack" data-day="FR" data-meal-type="MorningSnack" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'MorningSnack')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="FRLunch" data-day="FR" data-meal-type="Lunch" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Lunch')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="FRAfternoonSnack" data-day="FR" data-meal-type="AfternoonSnack" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="FRDinner" data-day="FR" data-meal-type="Dinner" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Dinner')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td class="light-green white-text" style="font-weight: bold;">Saturday</td>--}}
                        {{--<td id="SABreakfast" data-day="SA" data-meal-type="Breakfast" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Breakfast')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="SAMorningSnack" data-day="SA" data-meal-type="MorningSnack" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'MorningSnack')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="SALunch" data-day="SA" data-meal-type="Lunch" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Lunch')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="SAAfternoonSnack" data-day="SA" data-meal-type="AfternoonSnack" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                        {{--<td id="SADinner" data-day="SA" data-meal-type="Dinner" class="tdCell">--}}
                            {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Dinner')--}}
                                    {{--<a data-meal-active="#viewMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    {{--</tbody>--}}
                {{--</table>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col s12 m6 left plSlMlBtn">--}}
                {{--@if($plan->lockPlan==0)--}}
                    {{--<button id="fnshEdt" data-target="finishEdit" class="btn waves-effect waves-light modal-trigger">Finish</button>--}}
                {{--@else--}}
                    {{--<button id="unlckPln" data-target="unlckPlnMdl" class="btn waves-effect waves-light modal-trigger">Unlock</button>--}}
                    {{--<button id="backPln" data-target="bckPlnMdl" class="btn waves-effect waves-light modal-trigger">Back to Plans</button>--}}
                {{--@endif--}}
            {{--</div>--}}
            {{--<div class="col s12 m6 right plSlMlInfCnt">--}}
                {{--<div class="plSlMlInfDef card-panel">--}}
                    {{--<span>Please click on a meal for more info or add a meal by clicking on "+Add Meal"!</span>--}}
                {{--</div>--}}
                {{--@foreach($mealPlans as $id => $mealPlan)--}}
                    {{--<div id="viewMeal-{{$id}}" class="plSlMlInf card-panel">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col s12">--}}
                                {{--<ul class="collection plSlMlInfCtnt">--}}
                                    {{--<li class="collection-item light-green lighten-1 white-text">--}}
                                        {{--<span class="collection-header">{{$mealPlan->chefcustomize->description}}</span>--}}
                                    {{--</li>--}}
                                    {{--@if($mealPhotos->count())--}}
                                        {{--@foreach($mealPhotos as $mealPhoto)--}}
                                            {{--@if($mealPhoto->id==$mealPlan->chefcustomize->meal->id)--}}
                                                {{--<li class="collection-item" style="border-bottom: none;">--}}
                                                    {{--<img style="width: 200px; height: auto;" src="/img/meals/{{ $mealPhoto->image }}">--}}
                                                {{--</li>--}}
                                            {{--@endif--}}
                                        {{--@endforeach--}}
                                    {{--@endif--}}
                                    {{--<li class="collection-item">--}}
                                        {{--<span>Day: </span>--}}
                                        {{--@if($mealPlan->day=='MO')--}}
                                            {{--<span>Monday</span>--}}
                                        {{--@elseif($mealPlan->day=='TU')--}}
                                            {{--<span>Tuesday</span>--}}
                                        {{--@elseif($mealPlan->day=='WE')--}}
                                            {{--<span>Wednesday</span>--}}
                                        {{--@elseif($mealPlan->day=='TH')--}}
                                            {{--<span>Thursday</span>--}}
                                        {{--@elseif($mealPlan->day=='FR')--}}
                                            {{--<span>Friday</span>--}}
                                        {{--@elseif($mealPlan->day=='SA')--}}
                                            {{--<span>Saturday</span>--}}
                                        {{--@endif--}}
                                    {{--</li>--}}
                                    {{--<li class="collection-item">--}}
                                        {{--<span>Meal: </span>--}}
                                        {{--<span>--}}
                                            {{--@if($mealPlan->meal_type=='MorningSnack')--}}
                                                {{--Morning Snack--}}
                                            {{--@elseif($mealPlan->meal_type=='AfternoonSnack')--}}
                                                {{--Afternoon Snack--}}
                                            {{--@else--}}
                                                {{--{{$mealPlan->meal_type}}--}}
                                            {{--@endif--}}
                                        {{--</span>--}}
                                    {{--</li>--}}
                                    {{--<li class="collection-item">--}}
                                        {{--<span>Main Ingredient: </span><span>{{ucwords($mealPlan->chefcustomize->main_ingredient)}}</span>--}}
                                    {{--</li>--}}
                                    {{--<li class="collection-item">--}}
                                        {{--<span>Calories: </span><span>{{$mealPlan->chefcustomize->calories}}</span>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--@if($plan->lockPlan==0)--}}
                            {{--<div class="row">--}}
                                {{--<div class="editButton">--}}
                                    {{--<span>--}}
                                        {{--<button data-target="editMeal-{{$id}}" class="btn waves-effect waves-light modal-trigger">Edit</button>--}}
                                    {{--</span>--}}
                                    {{--<span>--}}
                                        {{--<button data-target="deleteMealPlan" data-mealplan-id="{{$mealPlan->id}}" data-day="{{$mealPlan->day}}" data-meal-type="{{$mealPlan->meal_type}}" class="deleteMealPlanButton btn waves-effect waves-light modal-trigger">Delete Planned Meal</button>--}}
                                    {{--</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--@endif--}}
                    {{--</div>--}}
                {{--@endforeach--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    <div id="unlckPlnMdl" class="modal">
        <nav class="light-green lighten-1 white-text">
            <div class="left col s12 m5 l5">
                <ul>
                    <li>
                        <span class="edtMlTtl">Unlock {{$plan->plan_name}}?</span>
                    </li>
                </ul>
            </div>
        </nav>
            <div class="modal-content">
                <a href="{{route('chef.plan.unlock',$plan->id)}}" class="orange darken-2 btn waves-effect waves-light" style="color: white; font-weight:100;">Unlock</a>
            </div>
    </div>

    <div id="bckPlnMdl" class="modal">
        <nav class="light-green lighten-1 white-text">
            <div class="left col s12 m5 l5">
                <ul>
                    <li>
                        <span class="edtMlTtl">Back to Plans?</span>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="modal-content">
            <a href="{{route('chef.plan')}}" class="orange darken-2 btn waves-effect waves-light" style="color: white; font-weight:100;">Back</a>
        </div>
    </div>

    <div id="finishEdit" class="modal">
        <nav class="light-green lighten-1 white-text">
            <div class="left col s12 m5 l5">
                <ul>
                    <li>
                        <span class="edtMlTtl">Finished editing {{$plan->plan_name}}?</span>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="modal-content">
            <a href="{{route('chef.plan.final',$plan->id)}}" class="btn waves-effect waves-light orange darken-2" style="color: white; font-weight:100;">Lock Plan</a>
            {{--<a href="{{route('chef.plan')}}" class="btn waves-effect waves-light orange darken-2" style="color: white; font-weight:100;">Exit</a>--}}
        </div>
    </div>

    <div id="deleteMealPlan" class="modal">
        <nav class="light-green lighten-1 white-text">
            <div class="left col s12 m5 l5">
                <ul>
                    <li>
                        <span class="edtMlTtl">Deleting Meal for: <span id="mealTypeDelete"></span> <span id="dayDelete"></span></span>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="modal-content">
            <span>Are you sure you want to delete <span id="formMealType"></span> for <span id="formDay"></span>?</span>
            <form id="deleteMealPlanForm" action="{{route('chef.mealPlan.delete')}}" method="post" autocomplete="off">
                {{csrf_field()}}
                <input id="deleteMealPlanId" name="deleteMealPlanId" type="hidden" value="">

                <button type="submit" class="orange darken-2 btn waves-effect waves-light">Delete Planned Meal</button>
            </form>

        </div>
    </div>

    @unless(count($mealPlans)==0)
        @for($i=0;$i<count($mealPlans);$i++)
            <div id="editMeal-{{$i}}" class="modal editFormModal">
                <i data-meal-id="{{$mealPlans[$i]->chefcustomize->id}}"></i>
                    <div class="orange-text text-darken-2" style="margin-top: 10px">
                        <span class="edtMlTtl" style="font-size: 30px;">Update Meal: {{$mealPlans[$i]->chefcustomize->description}}</span>
                    </div>
                    <div class="divider" style="margin: 10px;">
                    </div>
                <div class="modal-content">
                    <div class="row">
                        <div class="col s4">
                            <div class="edtMlSts">
                                <span>Meal Stats:</span>
                            </div>

                            <div>
                                <span>Calories: {{round($mealPlans[$i]->chefcustomize->calories,2)}}</span>
                            </div>

                            <div>
                                <span>Carbohydrates: {{round($mealPlans[$i]->chefcustomize->carbohydrates,2)}}g</span>
                            </div>

                            <div>
                                <span>Protein: {{round($mealPlans[$i]->chefcustomize->protein,2)}}g</span>
                            </div>

                            <div>
                                <span>Fat: {{round($mealPlans[$i]->chefcustomize->fat,2)}}g</span>
                            </div>
                        </div>
                    </div>
                <form id="editMeal{{$i}}" class="editMeal" action="{{route('chef.meal.update', $mealPlans[$i]->chefcustomize->id)}}" method="post" autocomplete="off">
                    {{csrf_field()}}
                        <p><label for="description">Description</label></p>
                        <input type="text" name="description" class="form-control" data-error=".error-desc" value="{{$mealPlans[$i]->chefcustomize->description}}">
                        <div class="error-desc err"></div>
                        <p><label for="main_ingredient">Main Ingredient</label></p>
                        <div id="ingredUpdateSelectContent{{$i}}" class="addSelectIngred">
                            <select id='main_ingredient{{$i}}' class="selectRequired" name="main_ingredient">
                                <option value="Chicken">Chicken</option>
                                <option value="Beef">Beef</option>
                                <option value="Pork">Pork</option>
                                <option value="Seafood">Seafood</option>
                                <option value="Dairy/Egg">Dairy/Egg</option>
                                <option value="Vegetables">Vegetables</option>
                                <option value="Carbohydrates">Carbohydrates</option>
                                <option value="Fruits">Fruits</option>
                            </select>
                            </div>
                            <script>
                                $(document).ready(function () {
                                    var mainIngred='{{ $mealPlans[$i]->chefcustomize->main_ingredient}}';
                                    $('select#main_ingredient{{$i}}').val(mainIngred);
                                });
                            </script>
                        <div class="ingredLabel"><label for="ingredient">Ingredients</label></div>
                        <div id="ingredSelect" class="ingredSelect">
                        @for($j=0;$j<$ingredientsMeal->count();$j++)
                            @for($c=0;$c<$mealPlans[$i]->chefcustomize->customized_ingredient_meal->count();$c++)
                                @if($ingredientsMeal[$j]->meal_id==$mealPlans[$i]->chefcustomize->id && $c<1)
                                    <div id="ingredSelect{{$mealPlans[$i]->chefcustomize->id}}{{$j}}" class="ingredSelectContainer">
                                        <select id="ingredSelectOption{{$mealPlans[$i]->chefcustomize->id}}{{$j}}" name="ingredient_select[{{$j}}]" class="required updateIngredSelect">
                                            {{--<option value="{{strtolower($ingredientsMeal[$j]->FdGrp_Desc)}}" selected>{{'Original: '.$ingredientsMeal[$j]->FdGrp_Desc}}</option>--}}
                                            <option value="chicken">Chicken</option>
                                            <option value="beef">Beef</option>
                                            <option value="pork">Pork</option>
                                            <option value="fish">Fish</option>
                                            <option value="carbohydrates(baked)">Carbohydrates(Baked)</option>
                                            <option value="carbohydrates(grains,pasta)">Carbohydrates(Grains, Pasta)</option>
                                            <option value="dairy,eggs">Dairy, Eggs</option>
                                            <option value="fat,oils">Dressings, Oil</option>
                                            <option value="beans,peanuts">Beans, Peanuts</option>
                                            <option value="soups,sauces,gravy">Soups, Sauces, Gravy</option>
                                            <option value="fruits">Fruits, Fruit Juices</option>
                                            <option value="vegetables">Vegetables</option>
                                        </select>
                                        <script>
                                            $(document).ready(function () {
                                                {{--console.log('{{strtolower($ingredientsMeal[$j]->FdGrp_Desc)}}');--}}
                                                var $valz = '{{strtolower($ingredientsMeal[$j]->FdGrp_Desc)}}';
                                                if($valz=="fruits/fruit juices"){
                                                    $valz='fruits';
                                                }else if($valz=='carbohydrates(grains, pasta)'){
                                                    $valz='carbohydrates(grains,pasta)';
                                                }else if($valz=='fish/shellfish'){
                                                    $valz='fish';
                                                }else if($valz=='dairy,egg'){
                                                    $valz='dairy,eggs';
                                                }else if($valz=='soups,sauces,gravies'){
                                                    $valz='soups,sauces,gravy';
                                                }
                                                var id='{{$mealPlans[$i]->chefcustomize->id}}{{$j}}';
                                                $('#ingredSelectOption'+id+' option').each(function () {
                                                    if($(this).val()==$valz){
                                                        $(this).attr("selected", true);
                                                    }
                                                });


                                                $.ajax({
                                                    url:'/chef/'+$valz+'/getIngredJson',
                                                    success: function(response) {
                                                        // console.log($('#'+prevAutoComplete).find('.autocomplete-content').attr('class'));
//                                                        $('#'+prevAutoComplete).find('.autocomplete-content').remove();
                                                        var $ingredsData = response;
                                                        // console.log($ingredsData);
                                                        $(function(){
                                                            $('#ingredient'+id+'.autocomplete').autocomplete(JSON.parse($ingredsData));
                                                        })
                                                    }
                                                });

                                            });
                                        </script>
                                        <div id="updateIngredText{{$mealPlans[$i]->chefcustomize->id}}{{$j}}" class="ingredSelectAdd input-field" >
                                            <input type="text" value="{{$ingredientsMeal[$j]->Long_Desc}}" id="ingredient{{$mealPlans[$i]->chefcustomize->id}}{{$j}}" name="ingredients[{{$j}}]" data-error=".error-updateIngred{{$j}}" class="required autocomplete ingredAuto inputBehind">
                                        </div>
                                        <div class="error-updateIngred{{$j}} err"></div>
                                        <div class="ingredGramsAdd"><div class="gramLabel"><label for="grams[]">Grams</label></div>
                                            <input type="number" value="{{$ingredientsMeal[$j]->grams}}" name="grams[{{$j}}]" id="grams{{$mealPlans[$i]->chefcustomize->id}}{{$j}}" data-error=".error-updateGram{{$j}}" class="required gramsAuto inputBehind"></div>
                                        <div class="error-updateGram{{$j}} err"></div>
                                        <script>
                                            $(document).ready(function () {

                                                $('#grams{{$mealPlans[$i]->chefcustomize->id}}{{$j}}').rules('add', {
                                                    min:1,
                                                    messages: {
                                                        min: "Number must be a positive integer"
                                                    }
                                                });
                                            })
                                        </script>
                                    </div>
                                @endif
                            @endfor
                        @endfor
                            <span>
                                @if($plan->lockPlan==0)
                                    <button class="btn orange darken-2" type="submit">Update</button>
                                @elseif($plan->lockPlan==1)
                                    <button class="btn orange darken-2 disabled" onclick="return false;" type="submit">Update</button>
                                @endif
                            </span>
                            <span>
                                @if($plan->lockPlan==0)
                                    <button data-target="deleteMealPlan" data-mealplan-id="{{$mealPlans[$i]->id}}" data-day="{{$mealPlans[$i]->day}}" data-meal-type="{{$mealPlans[$i]->meal_type}}" class="orange darken-2 deleteMealPlanButton btn waves-effect waves-light modal-trigger">Delete</button>
                                @elseif($plan->lockPlan==1)
                                    <button data-target="deleteMealPlan" data-mealplan-id="{{$mealPlans[$i]->id}}" data-day="{{$mealPlans[$i]->day}}" onclick="return false;" data-meal-type="{{$mealPlans[$i]->meal_type}}" class="orange darken-2 deleteMealPlanButton btn disabled">Delete</button>
                                @endif
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div id="deleteMeal{{$i}}" class="modal">
                <div class="modal-content">
                    <form action="{{route('chef.meal.delete', ['meal'=>$mealPlans[$i]->chefcustomize->id])}}" method="post">
                        {{csrf_field()}}
                        <h4>Are you sure you want to delete?</h4>
                        <button type="submit">Delete</button>
                    </form>
                </div>
            </div>
        @endfor
    @endunless


    <div id="chooseMeal" class="modal chooseMdlTbl">
        <div class="orange-text text-darken-2" style="margin-top: 10px">
            <span class="edtMlTtl" style="font-size: 30px;">Choose Meal For <span id="dayNameChoose"></span> on <span id="mealTypeChoose"></span></span>
        </div>
        <div class="divider" style="margin: 10px;">
        </div>
        {{--<nav class="light-green lighten-1 white-text">--}}
            {{--<div class="nav-wrapper">--}}
                {{--<div class="left col s12">--}}
                    {{--<ul>--}}
                        {{--<li>--}}
                            {{--<span style="font-size: 20px; margin-left: 20px;">Choose Meal For <span id="dayNameChoose"></span> on <span id="mealTypeChoose"></span></span>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</nav>--}}
        <div class="modal-content">
            <div>
                <table id="mealsContainer" class="centered">
                    <thead class="light-green lighten-1 white-text">
                        <tr>
                            <th>Description</th>
                            <th>Main Ingredient</th>
                            <th>Calories</th>
                            <th>Carbohydrates</th>
                            <th>Protein</th>
                            <th>Fat</th>
                        </tr>
                    </thead>
                    <tbody id="mealsTableBody">
                        @unless($meals->count()>0)
                            <tr>
                                <td>No Meals Created Yet</td>
                                {{--<td><a href="#createMeal" class="createChooseMealLink modal-trigger">Create a Meal Now!</a></td>--}}
                            </tr>
                        @endunless
                    </tbody>
                </table>
            </div>
                <form id="chooseMealForm" action="{{route('chef.meal.choose', $plan->id)}}" method="post" autocomplete="off">
                    {{csrf_field()}}
                    <input type="hidden" id="dayChoose" name="dayChoose" value="">
                    <input type="hidden" id="meal_typeChoose" name="meal_typeChoose" value="">
                    <input type="hidden" id="meal_idChoose" name="meal_idChoose" value="">
            @if($meals->count()>0)
                    <button type="submit" class="orange darken-2 btn waves-effect waves-light">Choose</button>
            @endif
                </form>
        </div>
    </div>

    <div id="createMeal" class="modal">
        <div class="orange-text text-darken-2" style="margin-top: 10px">
            <span class="edtMlTtl" style="font-size: 30px;">Create <span id="createMealTypeName"></span> for <span id="dayName"></span></span>
        </div>
        <div class="divider" style="margin: 10px;">
        </div>
        {{--<nav class="light-green lighten-1 white-text">--}}
            {{--<div class="nav-wrapper">--}}
                {{--<div class="left col s12">--}}
                    {{--<ul>--}}
                        {{--<li>--}}
                            {{--<span style="font-size: 20px; margin-left: 20px;">Create <span id="createMealTypeName"></span> for <span id="dayName"></span></span>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</nav>--}}
        <div class="modal-content">
            {{--<h4>Create <span id="createMealTypeName"></span> for <span id="dayName"></span></h4>--}}
            <form id="createMealForm" action="{{route('chef.meal.create', $plan->id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
                {{csrf_field()}}
                <label for="description">Meal Name:</label>
                <input type="text" name="description" data-error=".errorDescription" id="description" class="form-control">
                <div class="errorDescription err"></div>
                <input type="hidden" id="dayCreate" name="dayCreate" value="">
                <input type="hidden" id="meal_typeCreate" name="meal_typeCreate" value="">
                <select id="main_ingredient" data-error=".errorMainIngredient" name="main_ingredient">
                    <option selected value="">Choose Main Ingredient</option>
                    <option value="Chicken">Chicken</option>
                    <option value="Beef">Beef</option>
                    <option value="Pork">Pork</option>
                    <option value="Seafood">Seafood</option>
                    <option value="Dairy/Egg">Dairy/Egg</option>
                    <option value="Vegetables">Vegetables</option>
                    <option value="Carbohydrates">Carbohydrates</option>
                    <option value="Fruits">Fruits</option>
                </select>
                <div class="errorMainIngredient err"></div>
                <div id="imgContainer">
                </div>
                <div class="file-field input-field">
                    <label for="mealPic" class="active">Picture Upload:</label>
                    <div style="padding-top: 10px;">
                        <div class="btn orange darken-2">
                            <span>File</span>
                            <input type="file" data-error=".error-pic" id="mealPic" name="mealPic">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" >
                        </div>
                        <div class="error-pic err"></div>
                    </div>
                </div>
                <div id="ingredientContainer">
                    <div id="addMoreIngred"><a id="ingredAdd" href="#"><span class="addIngred">+Add Ingredients Here</span></a></div>
                    <div class="spacer" style="clear: both;"></div>
                </div>
                <div id="ingredError"></div>
                <div id="formError"></div>
                <div><button class="orange darken-2 createB btn" type="submit">Create</button></div>
            </form>
        </div>
    </div>

    <div id="loadWait" class="valign-wrapper">
        <div id="loadStatus" class="preloader-wrapper active valign">
            <div class="spinner-layer spinner-red-only">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div><div class="gap-patch">
                    <div class="circle"></div>
                </div><div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
    </div>

@endsection

