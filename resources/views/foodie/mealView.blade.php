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
                <table class="striped centered">
                    <thead class="light-green white-text" style="border: none;">
                    <th></th>
                    <th>Breakfast</th>
                    <th>Morning Snack</th>
                    <th>Lunch</th>
                    <th>Afternoon Snack</th>
                    <th>Dinner</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="light-green white-text" style="font-weight: bold;">Monday</td>
                        <td id="MOBreakfast" data-day="MO" data-meal-type="Breakfast" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Breakfast')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="MOMorningSnack" data-day="MO" data-meal-type="MorningSnack" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'MorningSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="MOLunch" data-day="MO" data-meal-type="Lunch" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Lunch')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="MOAfternoonSnack" data-day="MO" data-meal-type="AfternoonSnack" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'AfternoonSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="MODinner" data-day="MO" data-meal-type="Dinner" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Dinner')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="light-green white-text" style="font-weight: bold;">Tuesday</td>
                        <td id="TUBreakfast" data-day="TU" data-meal-type="Breakfast" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Breakfast')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="TUMorningSnack" data-day="TU" data-meal-type="MorningSnack" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'MorningSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="TULunch" data-day="TU" data-meal-type="Lunch" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Lunch')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="TUAfternoonSnack" data-day="TU" data-meal-type="AfternoonSnack" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'AfternoonSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="TUDinner" data-day="TU" data-meal-type="Dinner" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Dinner')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="light-green white-text" style="font-weight: bold;">Wednesday</td>
                        <td id="WEBreakfast" data-day="WE" data-meal-type="Breakfast" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Breakfast')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="WEMorningSnack" data-day="WE" data-meal-type="MorningSnack" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'MorningSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="WELunch" data-day="WE" data-meal-type="Lunch" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Lunch')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="WEAfternoonSnack" data-day="WE" data-meal-type="AfternoonSnack" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'AfternoonSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="WEDinner" data-day="WE" data-meal-type="Dinner" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Dinner')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="light-green white-text" style="font-weight: bold;">Thursday</td>
                        <td id="THBreakfast" data-day="TH" data-meal-type="Breakfast" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Breakfast')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="THMorningSnack" data-day="TH" data-meal-type="MorningSnack" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'MorningSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="THLunch" data-day="TH" data-meal-type="Lunch" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Lunch')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="THAfternoonSnack" data-day="TH" data-meal-type="AfternoonSnack" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'AfternoonSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="THDinner" data-day="TH" data-meal-type="Dinner" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Dinner')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="light-green white-text" style="font-weight: bold;">Friday</td>
                        <td id="FRBreakfast" data-day="FR" data-meal-type="Breakfast" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Breakfast')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="FRMorningSnack" data-day="FR" data-meal-type="MorningSnack" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'MorningSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="FRLunch" data-day="FR" data-meal-type="Lunch" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Lunch')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="FRAfternoonSnack" data-day="FR" data-meal-type="AfternoonSnack" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'AfternoonSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="FRDinner" data-day="FR" data-meal-type="Dinner" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Dinner')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td class="light-green white-text" style="font-weight: bold;">Saturday</td>
                        <td id="SABreakfast" data-day="SA" data-meal-type="Breakfast" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Breakfast')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="SAMorningSnack" data-day="SA" data-meal-type="MorningSnack" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'MorningSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="SALunch" data-day="SA" data-meal-type="Lunch" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Lunch')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="SAAfternoonSnack" data-day="SA" data-meal-type="AfternoonSnack" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'AfternoonSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="SADinner" data-day="SA" data-meal-type="Dinner" class="tdCell">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Dinner')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6 left plSlMlBtn">
                <div class="col s12 m6">
                    <div style="margin-bottom: 20px;">
                        <button data-target="orderReview" class="btn waves-effect waves-light modal-trigger" style="width: 100%;">Order Plan</button>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <button id="plSlMlCst" class="btn waves-effect waves-light" style="width: 100%;">Customize Plan</button>
                    </div>
                    <div style="margin-bottom: 20px;">
                        <button id="plSlMlBck" class="btn waves-effect waves-light" style="color: white; font-weight:100; width: 100%;">Back to Plans</button>
                    </div>
                </div>
                @if($mealPhotos->count())
                    <div class="col s12 m6">
                        <button id="plSlMlPht" data-target="photoGallery" class="modal-trigger btn waves-effect waves-light">View Gallery</button>
                    </div>
                @endif
            </div>
            <div class="col s12 m6 right plSlMlInfCnt">
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
                                    @if($mealPhoto->id==$mealPlan->id)
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
                                <span>Meal: </span><span>{{$mealPlan->meal_type}}</span>
                            </li>
                            <li class="collection-item">
                                <span>Main Ingredient: </span><span>{{ucwords($mealPlan->chefcustomize->main_ingredient)}}</span>
                            </li>
                            <li class="collection-item">
                                <span>Calories: </span><span>{{$mealPlan->chefcustomize->calories}}</span>
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

        <div id="photoGallery" class="modal">
            <div class="modal-content">
            @if($mealPhotos->count())
                <div class="col s12">
                    @foreach($mealPhotos->chunk(5) as $chunk)
                        <div class="row">
                            @foreach($chunk as $mealPhoto)
                                <div class="col s12 m2" style="margin:0 5px;">
                                    <a class="plIndPht" data-id="#plIndSelPht{{ $mealPhoto->id }}"><img class="circle" style="width: 100px;" src="/img/meals/{{ $mealPhoto->image }}"></a>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col s12">
                        @foreach($mealPhotos as $mealPhoto)
                            <div id="plIndSelPht{{ $mealPhoto->id }}" class="plIndSelCls">
                                <img src="/img/meals/{{ $mealPhoto->image }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div>
                    No Photos Added
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
                <form action="{{route('foodie.order.create', $plan->id)}}" method="post">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-danger">Order</button>
                </form>
            </div>
        </div>



@endsection