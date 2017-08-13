@extends('foodie.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/foodie/foodieMealView.css">
    <script>
        $orderRoute='{{route('foodie.order.review', $plan->id)}}';
        $customizeRoute='{{route('foodie.plan.custom', $plan->id)}}';
        $backRoute='{{route('foodie.plan.show')}}';
    </script>
    <script src="/js/foodie/foodieMealView.js" defer></script>
@endsection

@section('page_content')
    <div class="container vwMlCntr">
        <div class="row">
            <div class="col s12 light-green white-text plSlPlnNm valign-wrapper">
                <span>{{$plan->plan_name}}</span>
            </div>
        </div>
        <div class="row">
            <div class="card-panel" style="padding: 0;">
                <table id="mealTable" class="striped centered">
                    <thead class="light-green white-text" style="border: none;">
                        <tr>
                            <th class="dayTD"></th>
                            <th>Breakfast</th>
                            @if($moSnaMeals>0)
                                <th>Morning Snack</th>
                            @endif
                            <th>Lunch</th>
                            @if($aftSnaMeals>0)
                                <th>Afternoon Snack</th>
                            @endif
                            <th>Dinner</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="dayTD light-green white-text" style="font-weight: bold;">Monday</td>
                        <td id="MOBreakfast" data-day="MO" data-meal-type="Breakfast" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Breakfast')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        @if($moSnaMeals>0)
                            <td id="MOMorningSnack" data-day="MO" data-meal-type="MorningSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'MorningSnack')
                                        <a data-meal-active="#viewMeal-{{$id}}"
                                           class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                    @endif
                                @endforeach
                            </td>
                        @endif
                        <td id="MOLunch" data-day="MO" data-meal-type="Lunch" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Lunch')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        @if($aftSnaMeals>0)
                            <td id="MOAfternoonSnack" data-day="MO" data-meal-type="AfternoonSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'AfternoonSnack')
                                        <a data-meal-active="#viewMeal-{{$id}}"
                                           class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                    @endif
                                @endforeach
                            </td>
                        @endif
                        <td id="MODinner" data-day="MO" data-meal-type="Dinner" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Dinner')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="dayTD light-green white-text" style="font-weight: bold;">Tuesday</td>
                        <td id="TUBreakfast" data-day="TU" data-meal-type="Breakfast" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Breakfast')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        @if($moSnaMeals>0)
                            <td id="TUMorningSnack" data-day="TU" data-meal-type="MorningSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'MorningSnack')
                                        <a data-meal-active="#viewMeal-{{$id}}"
                                           class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                    @endif
                                @endforeach
                            </td>
                        @endif
                        <td id="TULunch" data-day="TU" data-meal-type="Lunch" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Lunch')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        @if($aftSnaMeals>0)
                            <td id="TUAfternoonSnack" data-day="TU" data-meal-type="AfternoonSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'AfternoonSnack')
                                        <a data-meal-active="#viewMeal-{{$id}}"
                                           class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                    @endif
                                @endforeach
                            </td>
                        @endif
                        <td id="TUDinner" data-day="TU" data-meal-type="Dinner" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Dinner')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="dayTD light-green white-text" style="font-weight: bold;">Wednesday</td>
                        <td id="WEBreakfast" data-day="WE" data-meal-type="Breakfast" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Breakfast')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        @if($moSnaMeals>0)
                            <td id="WEMorningSnack" data-day="WE" data-meal-type="MorningSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'MorningSnack')
                                        <a data-meal-active="#viewMeal-{{$id}}"
                                           class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                    @endif
                                @endforeach
                            </td>
                        @endif
                        <td id="WELunch" data-day="WE" data-meal-type="Lunch" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Lunch')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        @if($aftSnaMeals>0)
                            <td id="WEAfternoonSnack" data-day="WE" data-meal-type="AfternoonSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'AfternoonSnack')
                                        <a data-meal-active="#viewMeal-{{$id}}"
                                           class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                    @endif
                                @endforeach
                            </td>
                        @endif
                        <td id="WEDinner" data-day="WE" data-meal-type="Dinner" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Dinner')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="dayTD light-green white-text" style="font-weight: bold;">Thursday</td>
                        <td id="THBreakfast" data-day="TH" data-meal-type="Breakfast" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Breakfast')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        @if($moSnaMeals>0)
                            <td id="THMorningSnack" data-day="TH" data-meal-type="MorningSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'MorningSnack')
                                        <a data-meal-active="#viewMeal-{{$id}}"
                                           class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                    @endif
                                @endforeach
                            </td>
                        @endif
                        <td id="THLunch" data-day="TH" data-meal-type="Lunch" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Lunch')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        @if($aftSnaMeals>0)
                            <td id="THAfternoonSnack" data-day="TH" data-meal-type="AfternoonSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'AfternoonSnack')
                                        <a data-meal-active="#viewMeal-{{$id}}"
                                           class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                    @endif
                                @endforeach
                            </td>
                        @endif
                        <td id="THDinner" data-day="TH" data-meal-type="Dinner" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Dinner')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="dayTD light-green white-text" style="font-weight: bold;">Friday</td>
                        <td id="FRBreakfast" data-day="FR" data-meal-type="Breakfast" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Breakfast')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        @if($moSnaMeals>0)
                            <td id="FRMorningSnack" data-day="FR" data-meal-type="MorningSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'MorningSnack')
                                        <a data-meal-active="#viewMeal-{{$id}}"
                                           class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                    @endif
                                @endforeach
                            </td>
                        @endif
                        <td id="FRLunch" data-day="FR" data-meal-type="Lunch" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Lunch')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        @if($aftSnaMeals>0)
                            <td id="FRAfternoonSnack" data-day="FR" data-meal-type="AfternoonSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'AfternoonSnack')
                                        <a data-meal-active="#viewMeal-{{$id}}"
                                           class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                    @endif
                                @endforeach
                            </td>
                        @endif
                        <td id="FRDinner" data-day="FR" data-meal-type="Dinner" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Dinner')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    @if($saMeals>0)
                        <tr>
                            <td class="dayTD light-green white-text" style="font-weight: bold;">Saturday</td>
                            <td id="SABreakfast" data-day="SA" data-meal-type="Breakfast" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Breakfast')
                                        <a data-meal-active="#viewMeal-{{$id}}"
                                           class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                    @endif
                                @endforeach
                            </td>
                            @if($moSnaMeals>0)
                                <td id="SAMorningSnack" data-day="SA" data-meal-type="MorningSnack" class="tdCell">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'MorningSnack')
                                            <a data-meal-active="#viewMeal-{{$id}}"
                                               class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                        @endif
                                    @endforeach
                                </td>
                            @endif
                            <td id="SALunch" data-day="SA" data-meal-type="Lunch" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Lunch')
                                        <a data-meal-active="#viewMeal-{{$id}}"
                                           class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                    @endif
                                @endforeach
                            </td>
                            @if($aftSnaMeals>0)
                                <td id="SAAfternoonSnack" data-day="SA" data-meal-type="AfternoonSnack" class="tdCell">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'AfternoonSnack')
                                            <a data-meal-active="#viewMeal-{{$id}}"
                                               class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                        @endif
                                    @endforeach
                                </td>
                            @endif
                            <td id="SADinner" data-day="SA" data-meal-type="Dinner" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Dinner')
                                        <a data-meal-active="#viewMeal-{{$id}}"
                                           class="waves-effect waves-light data-trigger">{{$mealPlan->chefcustomize->description}}</a><br>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m8 left plSlMlBtn">
                <div class="col s12 m4">
                    <button data-target="orderReview" class="btn waves-effect waves-light modal-trigger" style="width: 100%;">Order Plan</button>
                </div>
                <div class="col s12 m4">
                    <button data-target="orderCustom" class="btn waves-effect waves-light modal-trigger" style="width: 100%;">Customize Plan</button>
                </div>
                @if($mealPhotos->count())
                    <div class="col s12 m4">
                        <button style="width:100%;" id="plSlMlPht" data-target="photoGallery" class="modal-trigger btn waves-effect waves-light">View Gallery</button>
                    </div>
                @endif
            </div>
            <div class="col s12 m4 right plSlMlInfCnt">
                <div class="plSlMlInfDef card-panel">
                    <span>Please click on a Meal for more info!</span>
                </div>
                @foreach($mealPlans as $id => $mealPlan)
                    <div id="viewMeal-{{$id}}" class="plSlMlInf card-panel">
                        <ul class="collection plSlMlInfCtnt">
                            <li class="collection-item light-green lighten-1 white-text">
                                <span class="collection-header">{{$mealPlan->chefcustomize->description}}</span>
                            </li>
                            @if($mealPhotos->count())
                                @foreach($mealPhotos as $mealPhoto)
                                    @if($mealPhoto->meal_id==$mealPlan->chefcustomize->meal->id)
                                        <li class="collection-item" style="border-bottom: none;">
                                            <img style="width: 200px; height: auto;" src="/img/meals/{{ $mealPhoto->image }}">
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                            <li class="collection-item">
                                <span>Day: </span>
                                @if($mealPlan->day=='MO')
                                    <span>Monday</span>
                                @elseif($mealPlan->day=='TU')
                                    <span>Tuesday</span>
                                @elseif($mealPlan->day=='WE')
                                    <span>Wednesday</span>
                                @elseif($mealPlan->day=='TH')
                                    <span>Thursday</span>
                                @elseif($mealPlan->day=='FR')
                                    <span>Friday</span>
                                @elseif($mealPlan->day=='SA')
                                    <span>Saturday</span>
                                @endif
                            </li>
                            <li class="collection-item">
                                <span>Meal: </span>
                                @if($mealPlan->meal_type=='MorningSnack')
                                    <span>Morning Snack</span>
                                @elseif($mealPlan->meal_type=='AfternoonSnack')
                                    <span>Afternoon Snack</span>
                                @else
                                    <span>{{$mealPlan->meal_type}}</span>
                                @endif
                            </li>
                            <li class="collection-item">
                                <span>Main Ingredient: </span><span>{{ucwords($mealPlan->chefcustomize->main_ingredient)}}</span>
                            </li>
                            <li class="collection-item">
                                <span>Calories: </span><span>{{round($mealPlan->chefcustomize->calories,2)}}</span>
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
                {{--<div class="row">--}}
                    {{--@foreach($mealPhotos->chunk(4) as $chunk)--}}
                            {{--@foreach($chunk as $mealPhoto)--}}
                                {{--@if($mealPhoto->plan_id==$plan->id)--}}
                                    {{--<div class="col s12 m3" style="margin-bottom: 10px;">--}}
                                        {{--<a class="plIndPht" data-id="#plIndSelPht{{ $mealPhoto->id }}"><img  style="width: 100%;" src="/img/meals/{{ $mealPhoto->image }}"></a>--}}
                                    {{--</div>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                    {{--@endforeach--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                    {{--<div class="col s12">--}}
                        {{--@foreach($mealPhotos as $mealPhoto)--}}
                            {{--<div id="plIndSelPht{{ $mealPhoto->id }}" class="plIndSelCls">--}}
                            {{--<div class="light-green lighten-1 white-text" style="width:500px;"><span>{{$mealPhoto->description}}</span></div>--}}
                                {{--<img src="/img/meals/{{ $mealPhoto->image }}">--}}
                            {{--</div>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@else--}}
                {{--<div>--}}
                    {{--No Photos Added--}}
                {{--</div>--}}

        <div id="photoGallery" class="modal gallery">
            <nav class="light-green lighten-1 white-text">
                <div class="left col s12 m5 l5">
                    <ul>
                        <li>
                            <span class="edtMlTtl" style="margin-left:20px; font-size: 20px;">Photo Gallery of {{$plan->plan_name}}</span>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="modal-content">
            @if($mealPhotos->count())
                    <div class="slider">
                        <ul class="slides">
                            @foreach($mealPhotos as $mealPhoto)
                                @if($mealPhoto->plan_id==$plan->id)
                                    <li>
                                        <div class="light-green lighten-1 white-text"><span>{{$mealPhoto->description}}</span></div>
                                        <img style="width:100%;" src="/img/meals/{{ $mealPhoto->image }}">
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
            @endif
            </div>
        </div>
    

        <div id="orderReview" class="modal" >
            <nav class="light-green lighten-1 white-text">
                <div class="left col s12 m5 l5">
                    <ul>
                        <li>
                            <span class="edtMlTtl" style="margin-left:20px; font-size: 20px;">Review Order of {{$plan->plan_name}}</span>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="modal-content">
                <ul class="collection">
                    {{--<li class="collection-item light-green lighten-1 white-text"><span class="collection-header">Order Review</span></li>--}}
                    <li class="collection-item">Chef Name: {{$plan->chef->name}}</li>
                    <li class="collection-item">Plan Name: {{$plan->plan_name}}</li>
                    <li class="collection-item">Plan Price: {{$plan->price}}</li>
                </ul>
                <a href="{{route('cart.add', ['id' => $plan->id,'cust' => 0])}}" class="btn btn-primary waves-effect waves-light">Add to Cart</a>
            </div>
        </div>

        <div id="orderCustom" class="modal">
            <nav class="light-green lighten-1 white-text">
                <div class="left col s12 m5 l5">
                    <ul>
                        <li>
                            <span class="edtMlTtl" style="margin-left:20px; font-size: 20px;">Customize Plan</span>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="modal-content">
                <div class="row">
                    <div class="col s12 m6">
                        <span>For those who want to customize their plan:</span>
                    </div>
                    <div class="col s12 m6">
                        <span>For those who are more experienced with dieting, and want more customization over their plan: </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12 m6">
                        <a href="{{route('foodie.plan.simple', $plan->id)}}">
                            <div id="plSmpCst" class="light-green lighten-1" style="border-radius: 10px;">
                                <div class="white-text valign-wrapper" style="width: 100%; height: 100px;">
                                    <div class="white-text center-block">
                                        <i class="fa fa-check-square-o" style="font-size: 80px;"></i>
                                    </div>
                                </div>
                                <div class="white-text center">
                                    <span>Simple</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col s12 m6">
                        <a href="{{route('foodie.plan.custom', $plan->id)}}">
                            <div id="plSlMlCst" class="light-green lighten-1" style="border-radius: 10px;">
                                <div class="white-text valign-wrapper" style="width: 100%; height: 100px;">
                                    <div class="white-text center-block">
                                        <i class="fa fa-cubes" style="font-size: 80px;"></i>
                                    </div>
                                </div>
                                <div class="white-text center">
                                    <span>In-Depth</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

@endsection