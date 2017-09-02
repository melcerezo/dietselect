@extends('chef.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/foodie/foodieMealCustomize.css">
    <script src="/js/foodie/foodieIngredientAutocomplete.js"></script>
    <script src="/js/foodie/mealPlanValidate.js"></script>
    <script src="/js/chef/mealPlanShow.js"></script>

@endsection

@section('page_content')
    @if(count($mealPlans)==0)
        <div>
            <h2>This Meal Plan is Empty!</h2>
        </div>
    @else
        <div class="container" style="width:85%; margin-top: 0.5rem;">
            <div class="row">
                <nav class="light-green lighten-1 white-text">
                    <div class="left col s12">
                        <ul>
                            <li>
                                <span style="font-size: 20px;">{{$planName}}</span>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="row">
                <div class="card-panel" style="padding: 0;">
                    @if($orderItem->order_type==0)
                        <table class="striped centered responsive-table" style="table-layout: fixed;">
                            <thead class="light-green white-text" style="border: none;">
                            <tr>
                                <th></th>
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
                                <td class="light-green white-text" style="font-weight: bold;">Monday</td>
                                <td id="MOBreakfast" data-day="MO" data-meal-type="Breakfast" class="tdCell">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->mealplans->day == 'MO' && $mealPlan->mealplans->meal_type == 'Breakfast')
                                            {{$mealPlan->description}}<br>
                                        @endif
                                    @endforeach
                                </td>
                                @if($moSnaMeals>0)
                                    <td id="MOMorningSnack" data-day="MO" data-meal-type="MorningSnack" class="tdCell">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'MO' && $mealPlan->mealplans->meal_type == 'MorningSnack')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td id="MOLunch" data-day="MO" data-meal-type="Lunch" class="tdCell">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->mealplans->day == 'MO' && $mealPlan->mealplans->meal_type == 'Lunch')
                                            {{$mealPlan->description}}<br>
                                        @endif
                                    @endforeach
                                </td>
                                @if($aftSnaMeals>0)
                                    <td id="MOAfternoonSnack" data-day="MO" data-meal-type="AfternoonSnack" class="tdCell">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'MO' && $mealPlan->mealplans->meal_type == 'AfternoonSnack')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td id="MODinner" data-day="MO" data-meal-type="Dinner" class="tdCell">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->mealplans->day == 'MO' && $mealPlan->mealplans->meal_type == 'Dinner')
                                            {{$mealPlan->description}}<br>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="light-green white-text" style="font-weight: bold;">Tuesday</td>
                                <td id="TUBreakfast" data-day="TU" data-meal-type="Breakfast" class="tdCell">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->mealplans->day == 'TU' && $mealPlan->mealplans->meal_type == 'Breakfast')
                                            {{$mealPlan->description}}<br>
                                        @endif
                                    @endforeach
                                </td>
                                @if($moSnaMeals>0)
                                    <td id="TUMorningSnack" data-day="TU" data-meal-type="MorningSnack" class="tdCell">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'TU' && $mealPlan->mealplans->meal_type == 'MorningSnack')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td id="TULunch" data-day="TU" data-meal-type="Lunch" class="tdCell">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->mealplans->day == 'TU' && $mealPlan->mealplans->meal_type == 'Lunch')
                                            {{$mealPlan->description}}<br>
                                        @endif
                                    @endforeach
                                </td>
                                @if($aftSnaMeals>0)
                                    <td id="TUAfternoonSnack" data-day="TU" data-meal-type="AfternoonSnack" class="tdCell">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'TU' && $mealPlan->mealplans->meal_type == 'AfternoonSnack')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td id="TUDinner" data-day="TU" data-meal-type="Dinner" class="tdCell">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->mealplans->day == 'TU' && $mealPlan->mealplans->meal_type == 'Dinner')
                                            {{$mealPlan->description}}<br>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="light-green white-text" style="font-weight: bold;">Wednesday</td>
                                <td id="WEBreakfast" data-day="WE" data-meal-type="Breakfast" class="tdCell">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->mealplans->day == 'WE' && $mealPlan->mealplans->meal_type == 'Breakfast')
                                            {{$mealPlan->description}}<br>
                                        @endif
                                    @endforeach
                                </td>
                                @if($moSnaMeals>0)
                                    <td id="WEMorningSnack" data-day="WE" data-meal-type="MorningSnack" class="tdCell">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'WE' && $mealPlan->mealplans->meal_type == 'MorningSnack')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td id="WELunch" data-day="WE" data-meal-type="Lunch" class="tdCell">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->mealplans->day == 'WE' && $mealPlan->mealplans->meal_type == 'Lunch')
                                            {{$mealPlan->description}}<br>
                                        @endif
                                    @endforeach
                                </td>
                                @if($aftSnaMeals>0)
                                    <td id="WEAfternoonSnack" data-day="WE" data-meal-type="AfternoonSnack" class="tdCell">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'WE' && $mealPlan->mealplans->meal_type == 'AfternoonSnack')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td id="WEDinner" data-day="WE" data-meal-type="Dinner" class="tdCell">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->mealplans->day == 'WE' && $mealPlan->mealplans->meal_type == 'Dinner')
                                            {{$mealPlan->description}}<br>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="light-green white-text" style="font-weight: bold;">Thursday</td>
                                <td id="THBreakfast" data-day="TH" data-meal-type="Breakfast" class="tdCell">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->mealplans->day == 'TH' && $mealPlan->mealplans->meal_type == 'Breakfast')
                                            {{$mealPlan->description}}<br>
                                        @endif
                                    @endforeach
                                </td>
                                @if($moSnaMeals>0)
                                    <td id="THMorningSnack" data-day="TH" data-meal-type="MorningSnack" class="tdCell">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'TH' && $mealPlan->mealplans->meal_type == 'MorningSnack')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td id="THLunch" data-day="TH" data-meal-type="Lunch" class="tdCell">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->mealplans->day == 'TH' && $mealPlan->mealplans->meal_type == 'Lunch')
                                            {{$mealPlan->description}}<br>
                                        @endif
                                    @endforeach
                                </td>
                                @if($aftSnaMeals>0)
                                    <td id="THAfternoonSnack" data-day="TH" data-meal-type="AfternoonSnack" class="tdCell">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'TH' && $mealPlan->mealplans->meal_type == 'AfternoonSnack')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td id="THDinner" data-day="TH" data-meal-type="Dinner" class="tdCell">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->mealplans->day == 'TH' && $mealPlan->mealplans->meal_type == 'Dinner')
                                            {{$mealPlan->description}}<br>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td class="light-green white-text" style="font-weight: bold;">Friday</td>
                                <td id="FRBreakfast" data-day="FR" data-meal-type="Breakfast" class="tdCell">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->mealplans->day == 'FR' && $mealPlan->mealplans->meal_type == 'Breakfast')
                                            {{$mealPlan->description}}<br>
                                        @endif
                                    @endforeach
                                </td>
                                @if($moSnaMeals>0)
                                    <td id="FRMorningSnack" data-day="FR" data-meal-type="MorningSnack" class="tdCell">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'FR' && $mealPlan->mealplans->meal_type == 'MorningSnack')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td id="FRLunch" data-day="FR" data-meal-type="Lunch" class="tdCell">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->mealplans->day == 'FR' && $mealPlan->mealplans->meal_type == 'Lunch')
                                            {{$mealPlan->description}}<br>
                                        @endif
                                    @endforeach
                                </td>
                                <td id="FRAfternoonSnack" data-day="FR" data-meal-type="AfternoonSnack" class="tdCell">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->mealplans->day == 'FR' && $mealPlan->mealplans->meal_type == 'AfternoonSnack')
                                            {{$mealPlan->description}}<br>
                                        @endif
                                    @endforeach
                                </td>
                                <td id="FRDinner" data-day="FR" data-meal-type="Dinner" class="tdCell">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->mealplans->day == 'FR' && $mealPlan->mealplans->meal_type == 'Dinner')
                                            {{$mealPlan->description}}<br>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            @if($saMeals>0)
                                <tr>
                                    <td class="light-green white-text" style="font-weight: bold;">Saturday</td>
                                    <td id="SABreakfast" data-day="SA" data-meal-type="Breakfast" class="tdCell">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'SA' && $mealPlan->mealplans->meal_type == 'Breakfast')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </td>
                                    @if($moSnaMeals>0)
                                        <td id="SAMorningSnack" data-day="SA" data-meal-type="MorningSnack" class="tdCell">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->mealplans->day == 'SA' && $mealPlan->mealplans->meal_type == 'MorningSnack')
                                                    {{$mealPlan->description}}<br>
                                                @endif
                                            @endforeach
                                        </td>
                                    @endif
                                    <td id="SALunch" data-day="SA" data-meal-type="Lunch" class="tdCell">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'SA' && $mealPlan->mealplans->meal_type == 'Lunch')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </td>
                                    @if($aftSnaMeals>0)
                                        <td id="SAAfternoonSnack" data-day="SA" data-meal-type="AfternoonSnack" class="tdCell">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->mealplans->day == 'SA' && $mealPlan->mealplans->meal_type == 'AfternoonSnack')
                                                    {{$mealPlan->description}}<br>
                                                @endif
                                            @endforeach
                                        </td>
                                    @endif
                                    <td id="SADinner" data-day="SA" data-meal-type="Dinner" class="tdCell">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'SA' && $mealPlan->mealplans->meal_type == 'Dinner')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    @elseif($orderItem->order_type==1)
                        <table class="striped centered responsive-table" style="table-layout: fixed;">
                            <thead class="light-green white-text" style="border: none;">
                            <tr>
                                <th></th>
                                <th id="Breakfast">Breakfast</th>
                                @if($moSnaMeals>0)
                                    <th id="MorningSnack">Snack</th>
                                @endif
                                <th id="Lunch">Lunch</th>
                                @if($aftSnaMeals>0)
                                    <th id="AfternoonSnack">Snack</th>
                                @endif
                                <th id="Dinner">Dinner</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr id="Monday">
                                <td class="light-green white-text" style="font-weight: bold;">Monday</td>
                                <td id="MoBre">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->chefcustomize->mealplans->day == 'MO' && $mealPlan->chefcustomize->mealplans->meal_type == 'Breakfast')
                                            <a href="#meal{{$id}}"
                                               class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                            <br />
                                            <div id="cu{{$id}}">
                                                @if($mealPlan->custom_type==1)
                                                    <p>Customized</p>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                                @if($moSnaMeals>0)
                                    <td id="MoMorSna">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'MO' && $mealPlan->chefcustomize->mealplans->meal_type == 'MorningSnack')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p>Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td id="MoLun">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->chefcustomize->mealplans->day == 'MO' && $mealPlan->chefcustomize->mealplans->meal_type == 'Lunch')
                                            <a href="#meal{{$id}}"
                                               class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                            <br />
                                            <div id="cu{{$id}}">
                                                @if($mealPlan->custom_type==1)
                                                    <p>Customized</p>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                                @if($aftSnaMeals>0)
                                    <td id="MoAftSna">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'MO' && $mealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p>Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td id="MoDin">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->chefcustomize->mealplans->day == 'MO' && $mealPlan->chefcustomize->mealplans->meal_type == 'Dinner')
                                            <a href="#meal{{$id}}"
                                               class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                            <br />
                                            <div id="cu{{$id}}">
                                                @if($mealPlan->custom_type==1)
                                                    <p>Customized</p>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr id="Tuesday">
                                <td class="light-green white-text" style="font-weight: bold;">Tuesday</td>
                                <td id="TuBre">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->chefcustomize->mealplans->day == 'TU' && $mealPlan->chefcustomize->mealplans->meal_type == 'Breakfast')
                                            <a href="#meal{{$id}}"
                                               class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                            <br />
                                            <div id="cu{{$id}}">
                                                @if($mealPlan->custom_type==1)
                                                    <p>Customized</p>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                                @if($moSnaMeals>0)
                                    <td id="TuMorSna">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'TU' && $mealPlan->chefcustomize->mealplans->meal_type == 'MorningSnack')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p>Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td id="TuLun">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->chefcustomize->mealplans->day == 'TU' && $mealPlan->chefcustomize->mealplans->meal_type == 'Lunch')
                                            <a href="#meal{{$id}}"
                                               class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                            <br />
                                            <div id="cu{{$id}}">
                                                @if($mealPlan->custom_type==1)
                                                    <p>Customized</p>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                                @if($aftSnaMeals>0)
                                    <td id="TuAftSna">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'TU' && $mealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p>Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td id="TuDin">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->chefcustomize->mealplans->day == 'TU' && $mealPlan->chefcustomize->mealplans->meal_type == 'Dinner')
                                            <a href="#meal{{$id}}"
                                               class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                            <br />
                                            <div id="cu{{$id}}">
                                                @if($mealPlan->custom_type==1)
                                                    <p>Customized</p>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr id="Wednesday">
                                <td class="light-green white-text" style="font-weight: bold;">Wednesday</td>
                                <td id="WeBre">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->chefcustomize->mealplans->day == 'WE' && $mealPlan->chefcustomize->mealplans->meal_type == 'Breakfast')
                                            <a href="#meal{{$id}}"
                                               class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                            <br />
                                            <div id="cu{{$id}}">
                                                @if($mealPlan->custom_type==1)
                                                    <p>Customized</p>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                                @if($moSnaMeals>0)
                                    <td id="WeMorSna">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'WE' && $mealPlan->chefcustomize->mealplans->meal_type == 'MorningSnack')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p>Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td id="WeLun">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->chefcustomize->mealplans->day == 'WE' && $mealPlan->chefcustomize->mealplans->meal_type == 'Lunch')
                                            <a href="#meal{{$id}}"
                                               class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                            <br />
                                            <div id="cu{{$id}}">
                                                @if($mealPlan->custom_type==1)
                                                    <p>Customized</p>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                                @if($aftSnaMeals>0)
                                    <td id="WeAftSna">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'WE' && $mealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p>Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td id="WeDin">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->chefcustomize->mealplans->day == 'WE' && $mealPlan->chefcustomize->mealplans->meal_type == 'Dinner')
                                            <a href="#meal{{$id}}"
                                               class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                            <br />
                                            <div id="cu{{$id}}">
                                                @if($mealPlan->custom_type==1)
                                                    <p>Customized</p>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr id="Thursday">
                                <td class="light-green white-text" style="font-weight: bold;">Thursday</td>
                                <td id="ThBre">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->chefcustomize->mealplans->day == 'TH' && $mealPlan->chefcustomize->mealplans->meal_type == 'Breakfast')
                                            <a href="#meal{{$id}}"
                                               class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                            <br />
                                            <div id="cu{{$id}}">
                                                @if($mealPlan->custom_type==1)
                                                    <p>Customized</p>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                                @if($moSnaMeals>0)
                                    <td id="ThMorSna">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'TH' && $mealPlan->chefcustomize->mealplans->meal_type == 'MorningSnack')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p>Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td id="ThLun">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->chefcustomize->mealplans->day == 'TH' && $mealPlan->chefcustomize->mealplans->meal_type == 'Lunch')
                                            <a href="#meal{{$id}}"
                                               class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                            <br />
                                            <div id="cu{{$id}}">
                                                @if($mealPlan->custom_type==1)
                                                    <p>Customized</p>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                                @if($aftSnaMeals>0)
                                    <td id="ThAftSna">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'TH' && $mealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p>Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td id="ThDin">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->chefcustomize->mealplans->day == 'TH' && $mealPlan->chefcustomize->mealplans->meal_type == 'Dinner')
                                            <a href="#meal{{$id}}"
                                               class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                            <br />
                                            <div id="cu{{$id}}">
                                                @if($mealPlan->custom_type==1)
                                                    <p>Customized</p>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr id="Friday">
                                <td class="light-green white-text" style="font-weight: bold;">Friday</td>
                                <td id="FrBre">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->chefcustomize->mealplans->day == 'FR' && $mealPlan->chefcustomize->mealplans->meal_type == 'Breakfast')
                                            <a href="#meal{{$id}}"
                                               class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                            <br />
                                            <div id="cu{{$id}}">
                                                @if($mealPlan->custom_type==1)
                                                    <p>Customized</p>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                                @if($moSnaMeals>0)
                                    <td id="FrMorSna">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'FR' && $mealPlan->chefcustomize->mealplans->meal_type == 'MorningSnack')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p>Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td id="FrLun">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->chefcustomize->mealplans->day == 'FR' && $mealPlan->chefcustomize->mealplans->meal_type == 'Lunch')
                                            <a href="#meal{{$id}}"
                                               class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                            <br />
                                            <div id="cu{{$id}}">
                                                @if($mealPlan->custom_type==1)
                                                    <p>Customized</p>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                                @if($aftSnaMeals>0)
                                    <td id="FrAftSna">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'FR' && $mealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p>Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                @endif
                                <td id="FrDin">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->chefcustomize->mealplans->day == 'FR' && $mealPlan->chefcustomize->mealplans->meal_type == 'Dinner')
                                            <a href="#meal{{$id}}"
                                               class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                            <br />
                                            <div id="cu{{$id}}">
                                                @if($mealPlan->custom_type==1)
                                                    <p>Customized</p>
                                                @endif
                                            </div>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            @if($saMeals!=0)
                                <tr id="Saturday">
                                    <td class="light-green white-text" style="font-weight: bold;">Saturday</td>
                                    <td id="SaBre">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'SA' && $mealPlan->chefcustomize->mealplans->meal_type == 'Breakfast')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p>Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                    @if($moSnaMeals>0)
                                        <td id="SaMorSna">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chefcustomize->mealplans->day == 'SA' && $mealPlan->chefcustomize->mealplans->meal_type == 'MorningSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->custom_type==1)
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </td>
                                    @endif
                                    <td id="SaLun">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'SA' && $mealPlan->chefcustomize->mealplans->meal_type == 'Lunch')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p>Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                    @if($aftSnaMeals>0)
                                        <td id="SaAftSna">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chefcustomize->mealplans->day == 'SA' && $mealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->custom_type==1)
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </td>
                                    @endif
                                    <td id="SaDin">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'SA' && $mealPlan->chefcustomize->mealplans->meal_type == 'Dinner')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p>Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    @elseif($orderItem->order_type==2)
                        <ul class="collection">
                            <li class="collection-item"></li>
                            @foreach($orderPlan->simple_custom_detail->get() as $detail)
                                <li class="collection-item">{{'NO '.$detail->detail}}</li>
                            @endforeach
                        </ul>
                    @endif
                @endif
                </div>
            </div>
            @unless(count($mealPlans)==0)
                @if($orderItem->order_type==1)
                    @foreach($mealPlans as $id=>$mealPlan)
                        <div id="meal{{$id}}" class="modal">
                            <nav class="light-green lighten-1 white-text">
                                <div class="left col s12 m5 l5">
                                    <ul>
                                        <li>
                                            <span>{{$mealPlan->description}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                            <div class="modal-content">
                                <div>
                                    <ul class="collection">
                                        <li class="collection-item light-green lighten-1 white-text">
                                            <span class="collection-header">Meal Information</span>
                                        </li>
                                        <li class="collection-item"><span>Calories:</span><span>{{$mealPlan->calories}}</span></li>
                                        <li class="collection-item"><span>Carbohydrates:</span><span>{{$mealPlan->carbohydrates}}</span></li>
                                        <li class="collection-item"><span>Protein:</span><span>{{$mealPlan->protein}}</span></li>
                                        <li class="collection-item"><span>Fat:</span><span>{{$mealPlan->fat}}</span></li>
                                    </ul>
                                </div>
                                <div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Ingredient</th>
                                                <th>Grams</th>
                                                <th>Customized</th>
                                            </tr>
                                        </thead>
                                        <tbody id="m{{$mealPlan->id}}">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            @endunless

        </div>


            {{--@for($i=0;$i<$mealPlans->count();$i++)--}}
                {{--@foreach($mealPlans as $cust)--}}
                    {{--@if($cust->meal_id == $mealPlans[$i]->meal_id)--}}
                        {{--<div id="editMeal-{{$i}}" class="modal">--}}
                            {{--<i data-meal-id="{{$mealPlans[$i]->meal->id}}"></i>--}}

                            {{--Hello: {{$custom}} World--}}
                            {{--<div class="modal-content">--}}
                                {{--<form id="editMeal{{$i}}"--}}
                                                                {{--action="{{route('foodie.meal.custom',array($mealPlans[$i]->meal->id, $mealPlans[$i]->customized_meal))}}"--}}
                                      {{--action="{{route('foodie.meal.custom',$cust->id)}}"--}}
                                      {{--method="post" autocomplete="off" class="editMeal">--}}
                                    {{--{{csrf_field()}}--}}
                                    {{--<h6>Customize Meal</h6>--}}
                                    {{--<h4>{{$cust->description}}</h4>--}}
                                    {{--<h5>Meal Stats:</h5>--}}
                                    {{--<div>--}}
                                        {{--Calories: {{$cust->calories}}--}}
                                    {{--</div>--}}
                                    {{--<div>--}}
                                        {{--Carbohydrates: {{$cust->carbohydrates}}g--}}
                                    {{--</div>--}}
                                    {{--<div>--}}
                                        {{--Protein: {{$cust->protein}}g--}}
                                    {{--</div>--}}
                                    {{--<div>--}}
                                        {{--Fat: {{$cust->fat}}g--}}
                                    {{--</div>--}}

                                    {{--<p><label for="main_ingredient">Main Ingredient</label></p>--}}
                                    {{--<div id="ingredUpdateSelectContent{{$i}}" class="addSelectIngred">--}}
                                        {{--<select id='main_ingredient{{$i}}' class="selectRequired" name="main_ingredient" disabled>--}}
                                            {{--<option disabled selected value="{{$mealPlans[$i]->meal->main_ingredient}}">{{$mealPlans[$i]->meal->main_ingredient}}</option>--}}
                                            {{--<option value="chicken">Chicken</option>--}}
                                            {{--<option value="beef">Beef</option>--}}
                                            {{--<option value="pork">Pork</option>--}}
                                            {{--<option value="carbohydrates">Carbohydrates</option>--}}
                                            {{--<option value="vegetables">Vegetables</option>--}}
                                            {{--<option value="fruits">Fruits</option>--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                    {{--<script>--}}
                                        {{--$(document).ready(function () {--}}
                                            {{--var mainIngred='{{ $cust->main_ingredient}}';--}}
                                            {{--$('select#main_ingredient{{$i}}').val(mainIngred.toLowerCase());--}}
                                        {{--});--}}
                                    {{--</script>--}}

                                    {{--{{$cust->id}}--}}
                                    {{--<div id="ingredSelect" class="ingredSelect">--}}
                                        {{--@for($j=0;$j<count($ingredientsMeal);$j++)--}}
                                            {{--@for($c=0;$c<$mealPlans[$i]->meal->ingredient_meal->count();$c++)--}}
                                                {{--@if($ingredientsMeal[$j]['meal']==$cust->id && $c<1)--}}
                                                    {{--<div id="ingredSelect{{$mealPlans[$i]->meal->id}}{{$j}}"--}}
                                                         {{--class="ingredSelectContainer">--}}
                                                        {{--<select id="ingredSelectOption{{$cust->id}}{{$j}}"--}}
                                                                {{--name="ingredient_select[]" class="updateIngredSelect" disabled>--}}
                                                            {{--<option disabled--}}
                                                                    {{--selected>{{$ingredientsMeal[$j]['ingredient_group']}}</option>--}}
                                                            {{--<option value="chicken">Chicken</option>--}}
                                                            {{--<option value="beef">Beef</option>--}}
                                                            {{--<option value="pork">Pork</option>--}}
                                                            {{--<option value="carbohydrates(baked)">Carbohydrates(Baked)</option>--}}
                                                            {{--<option value="carbohydrates(grains,pasta)">--}}
                                                                {{--Carbohydrates(Grains,--}}
                                                                {{--Pasta)--}}
                                                            {{--</option>--}}
                                                            {{--<option value="dairy,eggs">Dairy, Eggs</option>--}}
                                                            {{--<option value="soups,sauces,gravy">Soups, Sauces, Gravy</option>--}}
                                                            {{--<option value="fruits">Fruits, Fruit Juices</option>--}}
                                                            {{--<option value="vegetables">Vegetables</option>--}}
                                                        {{--</select>--}}
                                                        {{--<div id="updateIngredText{{$cust->id}}{{$j}}" class="ingredSelectAdd input-field">--}}
                                                            {{--<div class="ingredLabel"><label for="ingredients[]" class="active" style="color: #9e9e9e;">Ingredient</label></div>--}}
                                                            {{--<input type="text" value="{{$ingredientsMeal[$j]['ingredient']}}"--}}
                                                                   {{--id="ingredient{{$mealPlans[$i]->meal->id}}{{$j}}"--}}
                                                                   {{--name="ingredients[{{$j}}]" data-error=".error-foodieIngred{{$j}}" class="required autocomplete inputBehind" readonly>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="error-foodieIngred{{$j}} err"></div>--}}
                                                        {{--<div class="ingredGramsAdd">--}}
                                                            {{--<div class="gramLabel"><label for="grams[]">Grams</label></div>--}}
                                                            {{--<input type="number" value="{{$ingredientsMeal[$j]['grams']}}"--}}
                                                                   {{--name="grams[{{$j}}]"--}}
                                                                   {{--id="grams{{$mealPlans[$i]->meal->id}}{{$j}}" data-error=".error-foodieGram{{$j}}"--}}
                                                                   {{--class="required inputBehind" readonly>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="error-foodieGram{{$j}} err"></div>--}}
                                                    {{--</div>--}}
                                                {{--@endif--}}
                                            {{--@endfor--}}
                                        {{--@endfor--}}
                                        {{--<div><button id="u{{$i}}" data-form-id="editMeal{{$i}}" class="updateB btn" type="submit" form="editMeal{{$i}}">Update</button></div>--}}
                                    {{--</div>--}}
                                    {{--<div style="clear: both"></div>--}}
                                {{--</form>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--@endif--}}
                {{--@endforeach--}}
            {{--@endfor--}}

@endsection