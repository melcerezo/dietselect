@extends('foodie.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/foodie/foodieMealSingleView.css">
    <script src="/js/foodie/foodieIngredientAutocomplete.js"></script>
    <script src="/js/foodie/mealPlanValidate.js"></script>
    <script src="/js/foodie/foodieMealPlanShow.js"></script>

@endsection

@section('page_content')
    @if(count($mealPlans)==0)
        <div>
            <h2>This Meal Plan is Empty!</h2>
        </div>
    @else

        <div class="container" style="width:85%; margin-top: 0.5rem;">
            <div class="row">
                @if($orderItem->order->is_paid==0 && $orderItem->order->is_cancelled==0)
                    <a href="{{route('foodie.order.view', ['from'=>1])}}" class="orange-text text-darken-2">< Back to Order History</a>
                @elseif($orderItem->order->is_paid==1 && $orderItem->order->is_cancelled==0)
                    <a href="{{route('foodie.order.view', ['from'=>2])}}" class="orange-text text-darken-2">< Back to Order History</a>
                @elseif($orderItem->order->is_cancelled==1)
                    <a href="{{route('foodie.order.view', ['from'=>3])}}" class="orange-text text-darken-2">< Back To Order History</a>
                @endif
            </div>
            <div>
                <span style="font-size: 30px;">{{$planName}}</span>
                <span style="font-size: 30px;"> - </span>
                <span style="font-size: 30px;">
                    @if($orderItem->order_type==0)
                        Standard
                    @elseif($orderItem->order_type==1 || $orderItem->order_type==2)
                        Customized
                    @endif
                </span>
            </div>
            <div class="divider">
            </div>
            <div class="row">
                    @if($orderItem->order_type==0)

                    <div class="row mlPlnTtl">
                        <span>Menu</span>
                    </div>
                    <div class="divider"></div>
                    <div class="row mlPlnCnt">
                        <div class="col s12 m4">
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
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'MO' && $mealPlan->mealplans->meal_type == 'Breakfast')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($moSnaMeals>0)
                                    <div id="moMS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Morning Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->mealplans->day == 'MO' && $mealPlan->mealplans->meal_type == 'MorningSnack')
                                                    {{$mealPlan->description}}<br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="moLun" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Lunch</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'MO' && $mealPlan->mealplans->meal_type == 'Lunch')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($aftSnaMeals>0)
                                    <div id="moAS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Afternoon Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->mealplans->day == 'MO' && $mealPlan->mealplans->meal_type == 'AfternoonSnack')
                                                    {{$mealPlan->description}}<br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="moDin" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Dinner</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'MO' && $mealPlan->mealplans->meal_type == 'Dinner')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m4">
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
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'TU' && $mealPlan->mealplans->meal_type == 'Breakfast')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($moSnaMeals>0)
                                    <div id="tuMS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Morning Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->mealplans->day == 'TU' && $mealPlan->mealplans->meal_type == 'MorningSnack')
                                                    {{$mealPlan->description}}<br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="tuLun" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Lunch</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'TU' && $mealPlan->mealplans->meal_type == 'Lunch')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($aftSnaMeals>0)
                                    <div id="tuAS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Afternoon Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->mealplans->day == 'TU' && $mealPlan->mealplans->meal_type == 'AfternoonSnack')
                                                    {{$mealPlan->description}}<br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="tuDin" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Dinner</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'TU' && $mealPlan->mealplans->meal_type == 'Dinner')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m4">
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
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'WE' && $mealPlan->mealplans->meal_type == 'Breakfast')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($moSnaMeals>0)
                                    <div id="weMS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Morning Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->mealplans->day == 'WE' && $mealPlan->mealplans->meal_type == 'MorningSnack')
                                                    {{$mealPlan->description}}<br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="weLun" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Lunch</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'WE' && $mealPlan->mealplans->meal_type == 'Lunch')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($aftSnaMeals>0)
                                    <div id="weAS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Afternoon Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->mealplans->day == 'WE' && $mealPlan->mealplans->meal_type == 'AfternoonSnack')
                                                    {{$mealPlan->description}}<br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="weDin" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Dinner</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'WE' && $mealPlan->mealplans->meal_type == 'Dinner')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mlPlnCnt">
                        <div class="col s12 m4">
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
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'TH' && $mealPlan->mealplans->meal_type == 'Breakfast')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($moSnaMeals>0)
                                    <div id="thMS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Morning Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->mealplans->day == 'TH' && $mealPlan->mealplans->meal_type == 'MorningSnack')
                                                    {{$mealPlan->description}}<br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="thLun" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Lunch</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'TH' && $mealPlan->mealplans->meal_type == 'Lunch')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($aftSnaMeals>0)
                                    <div id="thAS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Afternoon Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->mealplans->day == 'TH' && $mealPlan->mealplans->meal_type == 'AfternoonSnack')
                                                    {{$mealPlan->description}}<br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="thDin" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Dinner</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'TH' && $mealPlan->mealplans->meal_type == 'Dinner')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m4">
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
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'FR' && $mealPlan->mealplans->meal_type == 'Breakfast')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($moSnaMeals>0)
                                    <div id="frMS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Morning Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->mealplans->day == 'FR' && $mealPlan->mealplans->meal_type == 'MorningSnack')
                                                    {{$mealPlan->description}}<br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="frLun" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Lunch</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'FR' && $mealPlan->mealplans->meal_type == 'Lunch')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($aftSnaMeals>0)
                                    <div id="frAS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Afternoon Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->mealplans->day == 'FR' && $mealPlan->mealplans->meal_type == 'AfternoonSnack')
                                                    {{$mealPlan->description}}<br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="frDin" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Dinner</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->mealplans->day == 'FR' && $mealPlan->mealplans->meal_type == 'Dinner')
                                                {{$mealPlan->description}}<br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($saMeals>0)
                            <div class="col s12 m4">
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
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->mealplans->day == 'SA' && $mealPlan->mealplans->meal_type == 'Breakfast')
                                                    {{$mealPlan->description}}<br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @if($moSnaMeals>0)
                                        <div id="saMS" class="mealDay">
                                            <div class="mlTtl">
                                                <span>Morning Snack</span>
                                            </div>
                                            <div class="divider" style="margin: 0 5px;"></div>
                                            <div class="mlCnt">
                                                @foreach($mealPlans as $id =>$mealPlan)
                                                    @if($mealPlan->mealplans->day == 'SA' && $mealPlan->mealplans->meal_type == 'MorningSnack')
                                                        {{$mealPlan->description}}<br>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    <div id="saLun" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Lunch</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->mealplans->day == 'SA' && $mealPlan->mealplans->meal_type == 'Lunch')
                                                    {{$mealPlan->description}}<br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @if($aftSnaMeals>0)
                                        <div id="saAS" class="mealDay">
                                            <div class="mlTtl">
                                                <span>Afternoon Snack</span>
                                            </div>
                                            <div class="divider" style="margin: 0 5px;"></div>
                                            <div class="mlCnt">
                                                @foreach($mealPlans as $id =>$mealPlan)
                                                    @if($mealPlan->mealplans->day == 'SA' && $mealPlan->mealplans->meal_type == 'AfternoonSnack')
                                                        {{$mealPlan->description}}<br>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    <div id="saDin" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Dinner</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->mealplans->day == 'SA' && $mealPlan->mealplans->meal_type == 'Dinner')
                                                    {{$mealPlan->description}}<br>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>


                    @elseif($orderItem->order_type==1)

                    <div class="row mlPlnCnt">
                        <div class="col s12 m4">
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
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'MO' && $mealPlan->chefcustomize->mealplans->meal_type == 'Breakfast')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($moSnaMeals>0)
                                    <div id="moMS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Morning Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chefcustomize->mealplans->day == 'MO' && $mealPlan->chefcustomize->mealplans->meal_type == 'MorningSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->custom_type==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="moLun" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Lunch</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'MO' && $mealPlan->chefcustomize->mealplans->meal_type == 'Lunch')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($aftSnaMeals>0)
                                    <div id="moAS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Afternoon Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chefcustomize->mealplans->day == 'MO' && $mealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->custom_type==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="moDin" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Dinner</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'MO' && $mealPlan->chefcustomize->mealplans->meal_type == 'Dinner')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m4">
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
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'TU' && $mealPlan->chefcustomize->mealplans->meal_type == 'Breakfast')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($moSnaMeals>0)
                                    <div id="tuMS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Morning Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chefcustomize->mealplans->day == 'TU' && $mealPlan->chefcustomize->mealplans->meal_type == 'MorningSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->custom_type==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="tuLun" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Lunch</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'TU' && $mealPlan->chefcustomize->mealplans->meal_type == 'Lunch')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($aftSnaMeals>0)
                                    <div id="tuAS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Afternoon Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chefcustomize->mealplans->day == 'TU' && $mealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->custom_type==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="tuDin" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Dinner</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'TU' && $mealPlan->chefcustomize->mealplans->meal_type == 'Dinner')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m4">
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
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'WE' && $mealPlan->chefcustomize->mealplans->meal_type == 'Breakfast')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($moSnaMeals>0)
                                    <div id="weMS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Morning Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chefcustomize->mealplans->day == 'WE' && $mealPlan->chefcustomize->mealplans->meal_type == 'MorningSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->custom_type==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="weLun" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Lunch</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'WE' && $mealPlan->chefcustomize->mealplans->meal_type == 'Lunch')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($aftSnaMeals>0)
                                    <div id="weAS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Afternoon Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chefcustomize->mealplans->day == 'WE' && $mealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->custom_type==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="weDin" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Dinner</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'WE' && $mealPlan->chefcustomize->mealplans->meal_type == 'Dinner')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<div class="col s12 m3 custAction">--}}
                        {{--<div>--}}
                        {{--<div style="font-size: 20px; margin: 10px 0;">--}}
                        {{--<span>Add to Cart</span>--}}
                        {{--</div>--}}
                        {{--<div>--}}
                        {{--@if($simpleCustomMeals->where('is_customized','=',1)->count() || $simpleCustomPlan->simple_custom_plan_detail->count())--}}
                        {{--<button type="button" data-target="orderReview" class="modal-trigger btn" style="margin:0 10px 10px 0;">Cart</button>--}}
                        {{--@else--}}
                        {{--<button type="button" data-target="orderReview" class="modal-trigger btn disabled" style="margin:0 10px 10px 0;">Cart</button>--}}
                        {{--@endif--}}
                        {{--</div>--}}
                        {{--<div class="divider">--}}
                        {{--</div>--}}
                        {{--<div style="font-size: 20px; margin: 10px 0;">--}}
                        {{--<span>Customize Plan</span>--}}
                        {{--</div>--}}
                        {{--<div>--}}
                        {{--<button type="button" data-target="planCust" class="modal-trigger btn" style="margin:0 10px 10px 0;">Customize</button>--}}
                        {{--</div>--}}

                        {{--@if($simpleCustomPlan->simple_custom_plan_detail->count())--}}
                        {{--<div>--}}
                        {{--<button type="button" data-target="detailCust" class="modal-trigger btn" style="margin:0 10px 10px 0;">View Details</button>--}}
                        {{--</div>--}}
                        {{--@endif--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="row mlPlnCnt">
                        <div class="col s12 m4">
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
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'TH' && $mealPlan->chefcustomize->mealplans->meal_type == 'Breakfast')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($moSnaMeals>0)
                                    <div id="thMS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Morning Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chefcustomize->mealplans->day == 'TH' && $mealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->custom_type==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="thLun" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Lunch</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'TH' && $mealPlan->chefcustomize->mealplans->meal_type == 'Lunch')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($aftSnaMeals>0)
                                    <div id="thAS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Afternoon Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chefcustomize->mealplans->day == 'TH' && $mealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->custom_type==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="thDin" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Dinner</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'TH' && $mealPlan->chefcustomize->mealplans->meal_type == 'Dinner')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m4">
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
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'FR' && $mealPlan->chefcustomize->mealplans->meal_type == 'Breakfast')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($moSnaMeals>0)
                                    <div id="frMS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Morning Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chefcustomize->mealplans->day == 'FR' && $mealPlan->chefcustomize->mealplans->meal_type == 'MorningSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->custom_type==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="frLun" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Lunch</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'FR' && $mealPlan->chefcustomize->mealplans->meal_type == 'Lunch')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($aftSnaMeals>0)
                                    <div id="frAS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Afternoon Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chefcustomize->mealplans->day == 'FR' && $mealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->custom_type==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="frDin" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Dinner</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chefcustomize->mealplans->day == 'FR' && $mealPlan->chefcustomize->mealplans->meal_type == 'Dinner')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->custom_type==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($saMeals>0)
                            <div class="col s12 m4">
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
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chefcustomize->mealplans->day == 'SA' && $mealPlan->chefcustomize->mealplans->meal_type == 'Breakfast')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->custom_type==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @if($moSnaMeals>0)
                                        <div id="saMS" class="mealDay">
                                            <div class="mlTtl">
                                                <span>Morning Snack</span>
                                            </div>
                                            <div class="divider" style="margin: 0 5px;"></div>
                                            <div class="mlCnt">
                                                @foreach($mealPlans as $id =>$mealPlan)
                                                    @if($mealPlan->chefcustomize->mealplans->day == 'SA' && $mealPlan->chefcustomize->mealplans->meal_type == 'MorningSnack')
                                                        <a href="#meal{{$id}}"
                                                           class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                        <br />
                                                        <div id="cu{{$id}}">
                                                            @if($mealPlan->custom_type==1)
                                                                <p class="orange-text text-darken-2">Customized</p>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    <div id="saLun" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Lunch</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chefcustomize->mealplans->day == 'SA' && $mealPlan->chefcustomize->mealplans->meal_type == 'Lunch')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->custom_type==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @if($aftSnaMeals>0)
                                        <div id="saAS" class="mealDay">
                                            <div class="mlTtl">
                                                <span>Afternoon Snack</span>
                                            </div>
                                            <div class="divider" style="margin: 0 5px;"></div>
                                            <div class="mlCnt">
                                                @foreach($mealPlans as $id =>$mealPlan)
                                                    @if($mealPlan->chefcustomize->mealplans->day == 'SA' && $mealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack')
                                                        <a href="#meal{{$id}}"
                                                           class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                        <br />
                                                        <div id="cu{{$id}}">
                                                            @if($mealPlan->custom_type==1)
                                                                <p class="orange-text text-darken-2">Customized</p>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    <div id="saDin" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Dinner</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chefcustomize->mealplans->day == 'SA' && $mealPlan->chefcustomize->mealplans->meal_type == 'Dinner')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->custom_type==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>


                    @elseif($orderItem->order_type==2)

                    <div class="row mlPlnCnt">
                        <div class="col s12 m4">
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
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chef_customized_meal->mealplans->day == 'MO' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Breakfast')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->is_customized==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($moSnaMeals>0)
                                    <div id="moMS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Morning Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chef_customized_meal->mealplans->day == 'MO' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'MorningSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->is_customized==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="moLun" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Lunch</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chef_customized_meal->mealplans->day == 'MO' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Lunch')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->is_customized==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($aftSnaMeals>0)
                                    <div id="moAS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Afternoon Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chef_customized_meal->mealplans->day == 'MO' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->is_customized==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="moDin" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Dinner</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chef_customized_meal->mealplans->day == 'MO' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Dinner')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->is_customized==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m4">
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
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chef_customized_meal->mealplans->day == 'TU' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Breakfast')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->is_customized==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($moSnaMeals>0)
                                    <div id="tuMS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Morning Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chef_customized_meal->mealplans->day == 'TU' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'MorningSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->is_customized==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="tuLun" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Lunch</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chef_customized_meal->mealplans->day == 'TU' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Lunch')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->is_customized==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($aftSnaMeals>0)
                                    <div id="tuAS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Afternoon Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chef_customized_meal->mealplans->day == 'TU' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->is_customized==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="tuDin" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Dinner</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chef_customized_meal->mealplans->day == 'TU' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Dinner')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->is_customized==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m4">
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
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chef_customized_meal->mealplans->day == 'WE' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Breakfast')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->is_customized==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($moSnaMeals>0)
                                    <div id="weMS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Morning Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chef_customized_meal->mealplans->day == 'WE' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'MorningSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->is_customized==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="weLun" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Lunch</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chef_customized_meal->mealplans->day == 'WE' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Lunch')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->is_customized==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($aftSnaMeals>0)
                                    <div id="weAS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Afternoon Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chef_customized_meal->mealplans->day == 'WE' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->is_customized==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="weDin" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Dinner</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chef_customized_meal->mealplans->day == 'WE' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Dinner')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->is_customized==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<div class="col s12 m3 custAction">--}}
                            {{--<div>--}}
                                {{--<div style="font-size: 20px; margin: 10px 0;">--}}
                                    {{--<span>Add to Cart</span>--}}
                                {{--</div>--}}
                                {{--<div>--}}
                                    {{--@if($simpleCustomMeals->where('is_customized','=',1)->count() || $simpleCustomPlan->simple_custom_plan_detail->count())--}}
                                        {{--<button type="button" data-target="orderReview" class="modal-trigger btn" style="margin:0 10px 10px 0;">Cart</button>--}}
                                    {{--@else--}}
                                        {{--<button type="button" data-target="orderReview" class="modal-trigger btn disabled" style="margin:0 10px 10px 0;">Cart</button>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                                {{--<div class="divider">--}}
                                {{--</div>--}}
                                {{--<div style="font-size: 20px; margin: 10px 0;">--}}
                                    {{--<span>Customize Plan</span>--}}
                                {{--</div>--}}
                                {{--<div>--}}
                                    {{--<button type="button" data-target="planCust" class="modal-trigger btn" style="margin:0 10px 10px 0;">Customize</button>--}}
                                {{--</div>--}}

                                {{--@if($simpleCustomPlan->simple_custom_plan_detail->count())--}}
                                    {{--<div>--}}
                                        {{--<button type="button" data-target="detailCust" class="modal-trigger btn" style="margin:0 10px 10px 0;">View Details</button>--}}
                                    {{--</div>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="row mlPlnCnt">
                        <div class="col s12 m4">
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
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chef_customized_meal->mealplans->day == 'TH' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Breakfast')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->is_customized==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($moSnaMeals>0)
                                    <div id="thMS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Morning Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chef_customized_meal->mealplans->day == 'TH' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->is_customized==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="thLun" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Lunch</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chef_customized_meal->mealplans->day == 'TH' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Lunch')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->is_customized==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($aftSnaMeals>0)
                                    <div id="thAS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Afternoon Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chef_customized_meal->mealplans->day == 'TH' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->is_customized==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="thDin" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Dinner</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chef_customized_meal->mealplans->day == 'TH' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Dinner')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->is_customized==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col s12 m4">
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
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chef_customized_meal->mealplans->day == 'FR' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Breakfast')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->is_customized==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($moSnaMeals>0)
                                    <div id="frMS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Morning Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chef_customized_meal->mealplans->day == 'FR' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'MorningSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->is_customized==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="frLun" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Lunch</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chef_customized_meal->mealplans->day == 'FR' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Lunch')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->is_customized==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                @if($aftSnaMeals>0)
                                    <div id="frAS" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Afternoon Snack</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chef_customized_meal->mealplans->day == 'FR' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->is_customized==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                <div id="frDin" class="mealDay">
                                    <div class="mlTtl">
                                        <span>Dinner</span>
                                    </div>
                                    <div class="divider" style="margin: 0 5px;"></div>
                                    <div class="mlCnt">
                                        @foreach($mealPlans as $id =>$mealPlan)
                                            @if($mealPlan->chef_customized_meal->mealplans->day == 'FR' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Dinner')
                                                <a href="#meal{{$id}}"
                                                   class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                <br />
                                                <div id="cu{{$id}}">
                                                    @if($mealPlan->is_customized==1)
                                                        <p class="orange-text text-darken-2">Customized</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($saMeals>0)
                            <div class="col s12 m4">
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
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chef_customized_meal->mealplans->day == 'SA' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Breakfast')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->is_customized==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @if($moSnaMeals>0)
                                        <div id="saMS" class="mealDay">
                                            <div class="mlTtl">
                                                <span>Morning Snack</span>
                                            </div>
                                            <div class="divider" style="margin: 0 5px;"></div>
                                            <div class="mlCnt">
                                                @foreach($mealPlans as $id =>$mealPlan)
                                                    @if($mealPlan->chef_customized_meal->mealplans->day == 'SA' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'MorningSnack')
                                                        <a href="#meal{{$id}}"
                                                           class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                        <br />
                                                        <div id="cu{{$id}}">
                                                            @if($mealPlan->is_customized==1)
                                                                <p class="orange-text text-darken-2">Customized</p>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    <div id="saLun" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Lunch</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chef_customized_meal->mealplans->day == 'SA' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Lunch')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->is_customized==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @if($aftSnaMeals>0)
                                        <div id="saAS" class="mealDay">
                                            <div class="mlTtl">
                                                <span>Afternoon Snack</span>
                                            </div>
                                            <div class="divider" style="margin: 0 5px;"></div>
                                            <div class="mlCnt">
                                                @foreach($mealPlans as $id =>$mealPlan)
                                                    @if($mealPlan->chef_customized_meal->mealplans->day == 'SA' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack')
                                                        <a href="#meal{{$id}}"
                                                           class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                        <br />
                                                        <div id="cu{{$id}}">
                                                            @if($mealPlan->is_customized==1)
                                                                <p class="orange-text text-darken-2">Customized</p>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    <div id="saDin" class="mealDay">
                                        <div class="mlTtl">
                                            <span>Dinner</span>
                                        </div>
                                        <div class="divider" style="margin: 0 5px;"></div>
                                        <div class="mlCnt">
                                            @foreach($mealPlans as $id =>$mealPlan)
                                                @if($mealPlan->chef_customized_meal->mealplans->day == 'SA' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Dinner')
                                                    <a href="#meal{{$id}}"
                                                       class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($mealPlan->is_customized==1)
                                                            <p class="orange-text text-darken-2">Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>


                    @endif
                @endif
                </div>
                <div class="row">
                    @if($orderItem->order_type==2)
                        @if($orderPlan->simple_custom_plan_detail->count())
                            <button data-target="planCustom" class="orange darken-2 btn waves-effect waves-light modal-trigger" style="margin-left: 10px;">See Customizations</button>
                        @endif
                    @endif
                </div>
            </div>

            @if($orderItem->order_type==2)
                @if($orderPlan->simple_custom_plan_detail->count())
                    <div id="planCustom" class="modal">
                        <nav class="light-green lighten-1 white-text">
                            <div class="left col s12 m5 l5">
                                <ul>
                                    <li>
                                        <span>{{$planName}} Customization</span>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <div class="modal-content">
                            @if($tasteCount>0)
                                <ul class="collection">
                                    <li class="collection-item">
                                        <span class="collection-header">Taste</span>
                                    </li>
                                    @foreach($orderPlan->simple_custom_plan_detail as $detail)
                                        @if($detail->detail== 'sweet' || $detail->detail== 'salty' ||  $detail->detail== 'spicy' ||
                                            $detail->detail== 'bitter' || $detail->detail== 'savory')
                                            <li class="collection-item">
                                                <span>{{'NO '.$detail->detail.' food'}}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                            @if($cookCount>0)
                                <ul class="collection">
                                    <li class="collection-item">
                                        <span class="collection-header">Cooking Methods</span>
                                    </li>
                                    @foreach($orderPlan->simple_custom_plan_detail as $detail)
                                        @if($detail->detail== 'fried' || $detail->detail== 'grilled' )
                                            <li class="collection-item">
                                                <span>{{'NO '.$detail->detail.' food'}}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                            @if($driedCount>0)
                                <ul class="collection">
                                    <li class="collection-item">
                                        <span class="collection-header">Dry Goods/Condiments</span>
                                    </li>
                                    @foreach($orderPlan->simple_custom_plan_detail as $detail)
                                        @if($detail->detail== 'preservatives' || $detail->detail== 'salt' ||  $detail->detail== 'sweeteners')
                                            <li class="collection-item">
                                                <span>{{'NO '.$detail->detail}}</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @endif
            @endif

            @unless(count($mealPlans)==0)
                @if($orderItem->order_type==1 || $orderItem->order_type==2)
                    @foreach($mealPlans as $id=>$mealPlan)
                        <div id="meal{{$id}}" class="modal">
                            <div class="orange-text text-darken-2" style="margin: 10px; border-left:4px solid #f57c00;">
                                @if($orderItem->order_type==1)
                                    <span style="font-size: 30px;">{{$mealPlan->description}}</span>
                                @elseif($orderItem->order_type==2)
                                    <span style="font-size: 30px;">{{$mealPlan->chef_customized_meal->description}}</span>
                                @endif
                            </div>
                            <div class="divider" style="margin:0 5px;"></div>
                            <div class="modal-content">
                                <div>
                                    <ul class="collection">
                                        <li class="collection-item">
                                            <span class="collection-header" style="font-size: 20px;">Meal Information</span>
                                        </li>
                                        @if($orderItem->order_type==1)
                                            <li class="collection-item"><span>Calories:</span><span>{{round($mealPlan->calories,2)}}</span></li>
                                        @elseif($orderItem->order_type==2)
                                            <li class="collection-item"><span>Calories:</span><span>{{round($mealPlan->chef_customized_meal->calories,2)}}</span></li>
                                            {{--<li class="collection-item"><span>Carbohydrates:</span><span>{{round($mealPlan->carbohydrates,2)}}</span></li>--}}
                                            {{--<li class="collection-item"><span>Protein:</span><span>{{round($mealPlan->protein,2)}}</span></li>--}}
                                            {{--<li class="collection-item"><span>Fat:</span><span>{{round($mealPlan->fat,2)}}</span></li>--}}
                                        @endif
                                    </ul>
                                </div>
                                <div>
                                    <table>
                                        <thead>
                                        @if($orderItem->order_type==1)
                                            <tr>
                                                <th>Ingredient</th>
                                                <th>Grams</th>
                                                <th>Customized</th>
                                            </tr>
                                        @elseif($orderItem->order_type==2)
                                            <tr>
                                                <th>Ingredient</th>
                                                <th>Grams</th>
                                            </tr>
                                        @endif
                                        </thead>
                                        @if($orderItem->order_type==1)
                                            <tbody id="m{{$mealPlan->id}}">
                                            </tbody>
                                        @elseif($orderItem->order_type==2)
                                            <tbody id="m{{$mealPlan->chef_customized_meal->id}}">
                                            </tbody>
                                        @endif
                                    </table>
                                </div>
                                @if($orderItem->order_type==2)
                                    @if($mealPlan->simple_custom_detail->count())
                                        <ul class="collection">
                                            <li class="collection-item">
                                                <span class="collection-header" style="font-size: 20px;">Customizations</span>
                                            </li>
                                            @foreach($mealPlan->simple_custom_detail()->get() as $detail)
                                                <li class="collection-item">
                                                    @if($detail->detail=='switchChicken')
                                                        <span>Switch to Chicken</span>
                                                    @elseif($detail->detail=='switchBeef')
                                                        <span>Switch to Beef</span>
                                                    @elseif($detail->detail=='switchPork')
                                                        <span>Switch to Pork</span>
                                                    @elseif($detail->detail=='switchSeafood')
                                                        <span>Switch to Seafood</span>
                                                    @elseif($detail->detail=='switchVegetarian')
                                                        <span>Vegetarian</span>
                                                    @elseif($detail->detail=='noEggs')
                                                        <span>No Eggs</span>
                                                    @elseif($detail->detail=='noDairy')
                                                        <span>No Dairy</span>
                                                    @elseif($detail->detail=='noGluten')
                                                        <span>No Gluten</span>
                                                    @elseif($detail->detail=='wheatOnly')
                                                        <span>Wheat Products Only</span>
                                                    @elseif($detail->detail=='whiteRice')
                                                        <span>White Rice</span>
                                                    @elseif($detail->detail=='brownRice')
                                                        <span>Brown Rice</span>
                                                    @elseif($detail->detail=='noNuts')
                                                        <span>No Nuts/Nut Products</span>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            @endunless



        {{--@unless($mealPlansCount==0)--}}


            {{--@for($i=0;$i<$mealPlansCount;$i++)--}}
                {{--@foreach($customize as $cust)--}}
                    {{--@if($cust->meal_id == $mealPlans[$i]->meal_id)--}}
                        {{--<div id="editMeal-{{$i}}" class="modal">--}}
                            {{--<i data-meal-id="{{$mealPlans[$i]->meal->id}}"></i>--}}

                            {{--Hello: {{$custom}} World--}}
                            {{--<div class="modal-content">--}}
                                {{--<form id="editMeal{{$i}}"--}}
                                      {{--                          action="{{route('foodie.meal.custom',array($mealPlans[$i]->meal->id, $mealPlans[$i]->customized_meal))}}"--}}
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
        {{--@endunless--}}

@endsection


{{--<table class="striped centered responsive-table" style="table-layout: fixed;">--}}
{{--<thead class="light-green white-text" style="border: none;">--}}
{{--<tr>--}}
{{--<th></th>--}}
{{--<th>Breakfast</th>--}}
{{--@if($moSnaMeals>0)--}}
{{--<th>Morning Snack</th>--}}
{{--@endif--}}
{{--<th>Lunch</th>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<th>Afternoon Snack</th>--}}
{{--@endif--}}
{{--<th>Dinner</th>--}}
{{--</tr>--}}
{{--</thead>--}}
{{--<tbody>--}}
{{--<tr>--}}
{{--<td class="light-green white-text" style="font-weight: bold;">Monday</td>--}}
{{--<td id="MOBreakfast" data-day="MO" data-meal-type="Breakfast" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'MO' && $mealPlan->mealplans->meal_type == 'Breakfast')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($moSnaMeals>0)--}}
{{--<td id="MOMorningSnack" data-day="MO" data-meal-type="MorningSnack" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'MO' && $mealPlan->mealplans->meal_type == 'MorningSnack')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="MOLunch" data-day="MO" data-meal-type="Lunch" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'MO' && $mealPlan->mealplans->meal_type == 'Lunch')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<td id="MOAfternoonSnack" data-day="MO" data-meal-type="AfternoonSnack" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'MO' && $mealPlan->mealplans->meal_type == 'AfternoonSnack')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="MODinner" data-day="MO" data-meal-type="Dinner" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'MO' && $mealPlan->mealplans->meal_type == 'Dinner')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--</tr>--}}
{{--<tr>--}}
{{--<td class="light-green white-text" style="font-weight: bold;">Tuesday</td>--}}
{{--<td id="TUBreakfast" data-day="TU" data-meal-type="Breakfast" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'TU' && $mealPlan->mealplans->meal_type == 'Breakfast')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($moSnaMeals>0)--}}
{{--<td id="TUMorningSnack" data-day="TU" data-meal-type="MorningSnack" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'TU' && $mealPlan->mealplans->meal_type == 'MorningSnack')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="TULunch" data-day="TU" data-meal-type="Lunch" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'TU' && $mealPlan->mealplans->meal_type == 'Lunch')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<td id="TUAfternoonSnack" data-day="TU" data-meal-type="AfternoonSnack" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'TU' && $mealPlan->mealplans->meal_type == 'AfternoonSnack')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="TUDinner" data-day="TU" data-meal-type="Dinner" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'TU' && $mealPlan->mealplans->meal_type == 'Dinner')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--</tr>--}}
{{--<tr>--}}
{{--<td class="light-green white-text" style="font-weight: bold;">Wednesday</td>--}}
{{--<td id="WEBreakfast" data-day="WE" data-meal-type="Breakfast" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'WE' && $mealPlan->mealplans->meal_type == 'Breakfast')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($moSnaMeals>0)--}}
{{--<td id="WEMorningSnack" data-day="WE" data-meal-type="MorningSnack" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'WE' && $mealPlan->mealplans->meal_type == 'MorningSnack')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="WELunch" data-day="WE" data-meal-type="Lunch" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'WE' && $mealPlan->mealplans->meal_type == 'Lunch')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<td id="WEAfternoonSnack" data-day="WE" data-meal-type="AfternoonSnack" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'WE' && $mealPlan->mealplans->meal_type == 'AfternoonSnack')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="WEDinner" data-day="WE" data-meal-type="Dinner" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'WE' && $mealPlan->mealplans->meal_type == 'Dinner')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--</tr>--}}
{{--<tr>--}}
{{--<td class="light-green white-text" style="font-weight: bold;">Thursday</td>--}}
{{--<td id="THBreakfast" data-day="TH" data-meal-type="Breakfast" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'TH' && $mealPlan->mealplans->meal_type == 'Breakfast')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($moSnaMeals>0)--}}
{{--<td id="THMorningSnack" data-day="TH" data-meal-type="MorningSnack" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'TH' && $mealPlan->mealplans->meal_type == 'MorningSnack')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="THLunch" data-day="TH" data-meal-type="Lunch" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'TH' && $mealPlan->mealplans->meal_type == 'Lunch')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<td id="THAfternoonSnack" data-day="TH" data-meal-type="AfternoonSnack" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'TH' && $mealPlan->mealplans->meal_type == 'AfternoonSnack')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="THDinner" data-day="TH" data-meal-type="Dinner" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'TH' && $mealPlan->mealplans->meal_type == 'Dinner')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--</tr>--}}
{{--<tr>--}}
{{--<td class="light-green white-text" style="font-weight: bold;">Friday</td>--}}
{{--<td id="FRBreakfast" data-day="FR" data-meal-type="Breakfast" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'FR' && $mealPlan->mealplans->meal_type == 'Breakfast')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($moSnaMeals>0)--}}
{{--<td id="FRMorningSnack" data-day="FR" data-meal-type="MorningSnack" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'FR' && $mealPlan->mealplans->meal_type == 'MorningSnack')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="FRLunch" data-day="FR" data-meal-type="Lunch" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'FR' && $mealPlan->mealplans->meal_type == 'Lunch')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--<td id="FRAfternoonSnack" data-day="FR" data-meal-type="AfternoonSnack" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'FR' && $mealPlan->mealplans->meal_type == 'AfternoonSnack')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--<td id="FRDinner" data-day="FR" data-meal-type="Dinner" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'FR' && $mealPlan->mealplans->meal_type == 'Dinner')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--</tr>--}}
{{--@if($saMeals>0)--}}
{{--<tr>--}}
{{--<td class="light-green white-text" style="font-weight: bold;">Saturday</td>--}}
{{--<td id="SABreakfast" data-day="SA" data-meal-type="Breakfast" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'SA' && $mealPlan->mealplans->meal_type == 'Breakfast')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($moSnaMeals>0)--}}
{{--<td id="SAMorningSnack" data-day="SA" data-meal-type="MorningSnack" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'SA' && $mealPlan->mealplans->meal_type == 'MorningSnack')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="SALunch" data-day="SA" data-meal-type="Lunch" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'SA' && $mealPlan->mealplans->meal_type == 'Lunch')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<td id="SAAfternoonSnack" data-day="SA" data-meal-type="AfternoonSnack" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'SA' && $mealPlan->mealplans->meal_type == 'AfternoonSnack')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="SADinner" data-day="SA" data-meal-type="Dinner" class="tdCell">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->mealplans->day == 'SA' && $mealPlan->mealplans->meal_type == 'Dinner')--}}
{{--{{$mealPlan->description}}<br>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--</tr>--}}
{{--@endif--}}
{{--</tbody>--}}
{{--</table>--}}

{{--<table class="striped centered responsive-table" style="table-layout: fixed;">--}}
{{--<thead class="light-green white-text" style="border: none;">--}}
{{--<tr>--}}
{{--<th></th>--}}
{{--<th id="Breakfast">Breakfast</th>--}}
{{--@if($moSnaMeals>0)--}}
{{--<th id="MorningSnack">Snack</th>--}}
{{--@endif--}}
{{--<th id="Lunch">Lunch</th>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<th id="AfternoonSnack">Snack</th>--}}
{{--@endif--}}
{{--<th id="Dinner">Dinner</th>--}}
{{--</tr>--}}
{{--</thead>--}}
{{--<tbody>--}}
{{--<tr id="Monday">--}}
{{--<td class="light-green white-text" style="font-weight: bold;">Monday</td>--}}
{{--<td id="MoBre">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'MO' && $mealPlan->chefcustomize->mealplans->meal_type == 'Breakfast')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($moSnaMeals>0)--}}
{{--<td id="MoMorSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'MO' && $mealPlan->chefcustomize->mealplans->meal_type == 'MorningSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="MoLun">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'MO' && $mealPlan->chefcustomize->mealplans->meal_type == 'Lunch')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<td id="MoAftSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'MO' && $mealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="MoDin">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'MO' && $mealPlan->chefcustomize->mealplans->meal_type == 'Dinner')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--</tr>--}}
{{--<tr id="Tuesday">--}}
{{--<td class="light-green white-text" style="font-weight: bold;">Tuesday</td>--}}
{{--<td id="TuBre">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'TU' && $mealPlan->chefcustomize->mealplans->meal_type == 'Breakfast')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($moSnaMeals>0)--}}
{{--<td id="TuMorSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'TU' && $mealPlan->chefcustomize->mealplans->meal_type == 'MorningSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="TuLun">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'TU' && $mealPlan->chefcustomize->mealplans->meal_type == 'Lunch')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<td id="TuAftSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'TU' && $mealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="TuDin">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'TU' && $mealPlan->chefcustomize->mealplans->meal_type == 'Dinner')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--</tr>--}}
{{--<tr id="Wednesday">--}}
{{--<td class="light-green white-text" style="font-weight: bold;">Wednesday</td>--}}
{{--<td id="WeBre">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'WE' && $mealPlan->chefcustomize->mealplans->meal_type == 'Breakfast')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($moSnaMeals>0)--}}
{{--<td id="WeMorSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'WE' && $mealPlan->chefcustomize->mealplans->meal_type == 'MorningSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="WeLun">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'WE' && $mealPlan->chefcustomize->mealplans->meal_type == 'Lunch')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<td id="WeAftSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'WE' && $mealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="WeDin">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'WE' && $mealPlan->chefcustomize->mealplans->meal_type == 'Dinner')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--</tr>--}}
{{--<tr id="Thursday">--}}
{{--<td class="light-green white-text" style="font-weight: bold;">Thursday</td>--}}
{{--<td id="ThBre">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'TH' && $mealPlan->chefcustomize->mealplans->meal_type == 'Breakfast')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($moSnaMeals>0)--}}
{{--<td id="ThMorSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'TH' && $mealPlan->chefcustomize->mealplans->meal_type == 'MorningSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="ThLun">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'TH' && $mealPlan->chefcustomize->mealplans->meal_type == 'Lunch')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<td id="ThAftSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'TH' && $mealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="ThDin">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'TH' && $mealPlan->chefcustomize->mealplans->meal_type == 'Dinner')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--</tr>--}}
{{--<tr id="Friday">--}}
{{--<td class="light-green white-text" style="font-weight: bold;">Friday</td>--}}
{{--<td id="FrBre">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'FR' && $mealPlan->chefcustomize->mealplans->meal_type == 'Breakfast')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($moSnaMeals>0)--}}
{{--<td id="FrMorSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'FR' && $mealPlan->chefcustomize->mealplans->meal_type == 'MorningSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="FrLun">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'FR' && $mealPlan->chefcustomize->mealplans->meal_type == 'Lunch')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<td id="FrAftSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'FR' && $mealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="FrDin">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'FR' && $mealPlan->chefcustomize->mealplans->meal_type == 'Dinner')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--</tr>--}}
{{--@if($saMeals!=0)--}}
{{--<tr id="Saturday">--}}
{{--<td class="light-green white-text" style="font-weight: bold;">Saturday</td>--}}
{{--<td id="SaBre">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'SA' && $mealPlan->chefcustomize->mealplans->meal_type == 'Breakfast')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($moSnaMeals>0)--}}
{{--<td id="SaMorSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'SA' && $mealPlan->chefcustomize->mealplans->meal_type == 'MorningSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="SaLun">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'SA' && $mealPlan->chefcustomize->mealplans->meal_type == 'Lunch')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<td id="SaAftSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'SA' && $mealPlan->chefcustomize->mealplans->meal_type == 'AfternoonSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="SaDin">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chefcustomize->mealplans->day == 'SA' && $mealPlan->chefcustomize->mealplans->meal_type == 'Dinner')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->custom_type==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--</tr>--}}
{{--@endif--}}
{{--</tbody>--}}
{{--</table>--}}

{{--<table class="striped centered responsive-table" style="table-layout: fixed;">--}}
{{--<thead class="light-green white-text" style="border: none;">--}}
{{--<tr>--}}
{{--<th></th>--}}
{{--<th id="Breakfast">Breakfast</th>--}}
{{--@if($moSnaMeals>0)--}}
{{--<th id="MorningSnack">Snack</th>--}}
{{--@endif--}}
{{--<th id="Lunch">Lunch</th>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<th id="AfternoonSnack">Snack</th>--}}
{{--@endif--}}
{{--<th id="Dinner">Dinner</th>--}}
{{--</tr>--}}
{{--</thead>--}}
{{--<tbody>--}}
{{--<tr id="Monday">--}}
{{--<td class="light-green white-text" style="font-weight: bold;">Monday</td>--}}
{{--<td id="MoBre">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'MO' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Breakfast')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($moSnaMeals>0)--}}
{{--<td id="MoMorSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'MO' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'MorningSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="MoLun">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'MO' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Lunch')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<td id="MoAftSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'MO' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="MoDin">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'MO' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Dinner')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--</tr>--}}
{{--<tr id="Tuesday">--}}
{{--<td class="light-green white-text" style="font-weight: bold;">Tuesday</td>--}}
{{--<td id="TuBre">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'TU' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Breakfast')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($moSnaMeals>0)--}}
{{--<td id="TuMorSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'TU' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'MorningSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="TuLun">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'TU' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Lunch')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<td id="TuAftSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'TU' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="TuDin">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'TU' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Dinner')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--</tr>--}}
{{--<tr id="Wednesday">--}}
{{--<td class="light-green white-text" style="font-weight: bold;">Wednesday</td>--}}
{{--<td id="WeBre">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'WE' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Breakfast')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($moSnaMeals>0)--}}
{{--<td id="WeMorSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'WE' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'MorningSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="WeLun">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'WE' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Lunch')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<td id="WeAftSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'WE' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="WeDin">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'WE' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Dinner')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--</tr>--}}
{{--<tr id="Thursday">--}}
{{--<td class="light-green white-text" style="font-weight: bold;">Thursday</td>--}}
{{--<td id="ThBre">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'TH' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Breakfast')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($moSnaMeals>0)--}}
{{--<td id="ThMorSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'TH' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'MorningSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="ThLun">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'TH' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Lunch')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<td id="ThAftSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'TH' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="ThDin">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'TH' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Dinner')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--</tr>--}}
{{--<tr id="Friday">--}}
{{--<td class="light-green white-text" style="font-weight: bold;">Friday</td>--}}
{{--<td id="FrBre">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'FR' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Breakfast')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($moSnaMeals>0)--}}
{{--<td id="FrMorSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'FR' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'MorningSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="FrLun">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'FR' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Lunch')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<td id="FrAftSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'FR' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="FrDin">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'FR' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Dinner')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--</tr>--}}
{{--@if($saMeals!=0)--}}
{{--<tr id="Saturday">--}}
{{--<td class="light-green white-text" style="font-weight: bold;">Saturday</td>--}}
{{--<td id="SaBre">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'SA' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Breakfast')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($moSnaMeals>0)--}}
{{--<td id="SaMorSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'SA' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'MorningSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="SaLun">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'SA' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Lunch')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@if($aftSnaMeals>0)--}}
{{--<td id="SaAftSna">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'SA' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}" data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--@endif--}}
{{--<td id="SaDin">--}}
{{--@foreach($mealPlans as $id =>$mealPlan)--}}
{{--@if($mealPlan->chef_customized_meal->mealplans->day == 'SA' && $mealPlan->chef_customized_meal->mealplans->meal_type == 'Dinner')--}}
{{--<a href="#meal{{$id}}"--}}
{{--class="waves-effect waves-light mealLink modal-trigger" data-id="{{$mealPlan->chef_customized_meal->id}}" data-cust="{{$orderItem->order_type}}"  data-mId="m{{$id}}" data-iId="i{{$id}}" data-cId="cu{{$id}}">{{$mealPlan->chef_customized_meal->description}}</a>--}}
{{--<br />--}}
{{--<div id="cu{{$id}}">--}}
{{--@if($mealPlan->is_customized==1)--}}
{{--<p>Customized</p>--}}
{{--@endif--}}
{{--</div>--}}
{{--@endif--}}
{{--@endforeach--}}
{{--</td>--}}
{{--</tr>--}}
{{--@endif--}}
{{--</tbody>--}}
{{--</table>--}}