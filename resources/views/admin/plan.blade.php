@extends("layouts.app")
@section('head')
    <link rel="stylesheet" href="/css/admin/adminPlanView.css">
    <script src="/js/admin/admin.js" defer></script>
    <script src="/js/admin/adminPlanView.js" defer></script>
@endsection

@section('content')
    <nav>
        <div class="nav-wrapper light-green lighten-1">
            <div style="margin-left: 10px;">
                <a href="{{route("admin.dashboard")}}" class="brand-logo">Admin Panel</a>
            </div>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li>
                    <a href="{{route("admin.dashboard")}}">
                        <span class="valign-wrapper" style="position: relative;">
                            <span style="margin-left: 2px;">
                                Dashboard
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{route("admin.commissions")}}">
                        <span class="valign-wrapper" style="position: relative;">
                            <span style="margin-left: 2px;">
                                Commissions
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.foodies')}}">
                        <span class="valign-wrapper">
                            <span style="margin-left: 2px;">
                                Foodies
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.chefs')}}">
                        <span class="valign-wrapper">
                            <span style="margin-left: 2px;">
                                Chefs
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a href="{{route('admin.orders')}}">
                        <span style="margin-left: 2px;">
                            Orders
                        </span>
                    </a>
                </li>
                <li>
                    <form id="logout" method="post" action="{{ route('admin.logout') }}">
                        {{ csrf_field() }}
                        <a id="logout-link" class="nvItLnk" href="#">
                            {{--<i class="fa fa-sign-out" aria-hidden="true"></i>--}}
                            <span class="hide-on-med-and-down">Logout</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" style="width: 85%;">
        <div class="row">
            <div class="col s12 m2">
                <ul class="collection">
                    <li class="collection-item light-green lighten-1 white-text">
                        <span class="collection-header">
                            Admin
                        </span>
                    </li>
                    <li class="collection-item"><a href="{{route('admin.commissions')}}">Commissions</a></li>
                    <li class="collection-item"><a href="{{route('admin.orders')}}">Orders</a></li>
                    <li class="collection-item"><a href="{{route('admin.foodies')}}">Foodies</a></li>
                    <li class="collection-item"><a href="{{route('admin.chefs')}}">Chefs</a></li>
                </ul>
            </div>
            <div class="col s12 m10">
                <div class="card">
                    <div class="grey lighten-3" style="width: 100%; padding: 10px; border-bottom: solid lightgray 1px;">
                        <div>
                            <span>
                                {{$plan->plan_name}}
                            </span>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12">
                                <table class="striped centered responsive-table" style="table-layout: fixed;">
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
                            <div class="col s12 m6">
                                <div>
                                    @if($plan->is_banned==0)
                                        <button data-target="#banPlan" class="modal-trigger btn waves-effect waves-light">Ban</button>
                                    @elseif($plan->is_banned==1)
                                        <button data-target="#banPlan" class="modal-trigger btn waves-effect waves-light disabled">Ban</button>
                                    @endif
                                </div>
                                <div>
                                    @if($plan->is_banned==0)
                                        <button data-target="#unbanPlan" class="modal-trigger btn waves-effect waves-light disabled">Unban</button>
                                    @elseif($plan->is_banned==1)
                                        <button data-target="#unbanPlan" class="modal-trigger btn waves-effect waves-light">Unban</button>
                                    @endif
                                </div>
                            </div>
                            <div class="col s12 m6 plSlMlInfCnt">
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
                </div>
            </div>
        </div>
    </div>
    <div id="banPlan" class="modal">
        <div class="modal-content">
            <a href="{{route('admin.plan.ban', $plan->id)}}" class="btn waves-effect waves-light" style="font-weight: 100">Ban Plan?</a>
        </div>
    </div>
    <div id="unbanPlan" class="modal">
        <div class="modal-content">
            <a href="{{route('admin.plan.unban', $plan->id)}}" class="btn waves-effect waves-light" style="font-weight: 100">Unban Plan?</a>
        </div>
    </div>


@endsection