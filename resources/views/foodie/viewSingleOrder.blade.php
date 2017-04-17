@extends('foodie.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/foodie/foodieMealCustomize.css">
    <script src="/js/foodie/foodieIngredientAutocomplete.js"></script>
    <script src="/js/foodie/mealPlanValidate.js"></script>

@endsection

@section('page_content')
    @if($mealPlansCount==0)
        <div>
            <h2>This Meal Plan is Empty!</h2>
        </div>
    @else
        <div class="container">
            <div class="row">
                <h2 class="center white-text">Customized Orders</h2>
                <span class="center full-width white-text"
                      style="font-size: 1.5em">See which meals were customized!</span>
                <div class="card papaya-whip">
                    <div class="card-content">
                        <h4 class="mustard-text">Meal Plans:</h4>
                        <table class="highlight">
                            <thead>
                            <tr>
                                <th></th>
                                <th id="Breakfast">Breakfast</th>
                                <th id="MorningSnack">Snack</th>
                                <th id="Lunch">Lunch</th>
                                <th id="AfternoonSnack">Snack</th>
                                <th id="Dinner">Dinner</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr id="Monday">
                                <th>Monday</th>
                                <td id="MoBre">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Breakfast')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="MoMorSna">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'MorningSnack')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="MoLun">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Lunch')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="MoAftSna">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'AfternoonSnack')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="MoDin">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Dinner')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr id="Tuesday">
                                <th>Tuesday</th>
                                <td id="TuBre">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Breakfast')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="TuMorSna">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'MorningSnack')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="TuLun">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Lunch')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="TuAftSna">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'AfternoonSnack')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="TuDin">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Dinner')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr id="Wednesday">
                                <th>Wednesday</th>
                                <td id="WeBre">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Breakfast')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="WeMorSna">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'MorningSnack')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="WeLun">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Lunch')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="WeAftSna">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'AfternoonSnack')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="WeDin">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Dinner')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr id="Thursday">
                                <th>Thursday</th>
                                <td id="ThBre">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Breakfast')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="ThMorSna">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'MorningSnack')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="ThLun">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Lunch')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="ThAftSna">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'AfternoonSnack')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="ThDin">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Dinner')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr id="Friday">
                                <th>Friday</th>
                                <td id="FrBre">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Breakfast')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="FrMorSna">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'MorningSnack')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="FrLun">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Lunch')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="FrAftSna">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'AfternoonSnack')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="FrDin">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Dinner')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr id="Saturday">
                                <th>Saturday</th>
                                <td id="SaBre">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Breakfast')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="SaMorSna">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'MorningSnack')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="SaLun">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Lunch')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="SaAftSna">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'AfternoonSnack')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <td id="SaDin">
                                    @foreach($mealPlans as $id =>$mealPlan)
                                        @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Dinner')
                                            @foreach($customize as $cust)
                                                @if($cust->meal_id == $mealPlan->meal_id)
                                                    <a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger">{{$cust->description}}</a>
                                                    <br />
                                                    <div id="cu{{$id}}">
                                                        @if($cust->custom_type=='c')
                                                            <p>Customized</p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                {{--@foreach($mealPlans as $id=>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'SA')--}}
                                {{--<td><a href="#editMeal-{{$id}}"--}}
                                {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                {{--</td>--}}
                                {{--@endif--}}
                                {{--@endforeach--}}
                            </tr>
                            </tbody>
                        </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        @unless($mealPlansCount==0)


            @for($i=0;$i<$mealPlansCount;$i++)
                @foreach($customize as $cust)
                    @if($cust->meal_id == $mealPlans[$i]->meal_id)
                        <div id="editMeal-{{$i}}" class="modal">
                            {{--<i data-meal-id="{{$mealPlans[$i]->meal->id}}"></i>--}}

                            {{--Hello: {{$custom}} World--}}
                            <div class="modal-content">
                                <form id="editMeal{{$i}}"
                                      {{--                          action="{{route('foodie.meal.custom',array($mealPlans[$i]->meal->id, $mealPlans[$i]->customized_meal))}}"--}}
                                      action="{{route('foodie.meal.custom',$cust->id)}}"
                                      method="post" autocomplete="off" class="editMeal">
                                    {{csrf_field()}}
                                    <h6>Customize Meal</h6>
                                    <h4>{{$cust->description}}</h4>
                                    <h5>Meal Stats:</h5>
                                    <div>
                                        Calories: {{$cust->calories}}
                                    </div>
                                    <div>
                                        Carbohydrates: {{$cust->carbohydrates}}g
                                    </div>
                                    <div>
                                        Protein: {{$cust->protein}}g
                                    </div>
                                    <div>
                                        Fat: {{$cust->fat}}g
                                    </div>

                                    <p><label for="main_ingredient">Main Ingredient</label></p>
                                    <div id="ingredUpdateSelectContent{{$i}}" class="addSelectIngred">
                                        <select id='main_ingredient{{$i}}' class="selectRequired" name="main_ingredient" disabled>
                                            {{--<option disabled selected value="{{$mealPlans[$i]->meal->main_ingredient}}">{{$mealPlans[$i]->meal->main_ingredient}}</option>--}}
                                            <option value="chicken">Chicken</option>
                                            <option value="beef">Beef</option>
                                            <option value="pork">Pork</option>
                                            <option value="carbohydrates">Carbohydrates</option>
                                            <option value="vegetables">Vegetables</option>
                                            <option value="fruits">Fruits</option>
                                        </select>
                                    </div>
                                    <script>
                                        $(document).ready(function () {
                                            var mainIngred='{{ $cust->main_ingredient}}';
                                            $('select#main_ingredient{{$i}}').val(mainIngred.toLowerCase());
                                        });
                                    </script>

                                    {{--{{$cust->id}}--}}
                                    <div id="ingredSelect" class="ingredSelect">
                                        @for($j=0;$j<count($ingredientsMeal);$j++)
                                            @for($c=0;$c<$mealPlans[$i]->meal->ingredient_meal->count();$c++)
                                                @if($ingredientsMeal[$j]['meal']==$cust->id && $c<1)
                                                    <div id="ingredSelect{{$mealPlans[$i]->meal->id}}{{$j}}"
                                                         class="ingredSelectContainer">
                                                        <select id="ingredSelectOption{{$cust->id}}{{$j}}"
                                                                name="ingredient_select[]" class="updateIngredSelect" disabled>
                                                            <option disabled
                                                                    selected>{{$ingredientsMeal[$j]['ingredient_group']}}</option>
                                                            <option value="chicken">Chicken</option>
                                                            <option value="beef">Beef</option>
                                                            <option value="pork">Pork</option>
                                                            <option value="carbohydrates(baked)">Carbohydrates(Baked)</option>
                                                            <option value="carbohydrates(grains,pasta)">
                                                                Carbohydrates(Grains,
                                                                Pasta)
                                                            </option>
                                                            <option value="dairy,eggs">Dairy, Eggs</option>
                                                            <option value="soups,sauces,gravy">Soups, Sauces, Gravy</option>
                                                            <option value="fruits">Fruits, Fruit Juices</option>
                                                            <option value="vegetables">Vegetables</option>
                                                        </select>
                                                        <div id="updateIngredText{{$cust->id}}{{$j}}" class="ingredSelectAdd input-field">
                                                            <div class="ingredLabel"><label for="ingredients[]" class="active" style="color: #9e9e9e;">Ingredient</label></div>
                                                            <input type="text" value="{{$ingredientsMeal[$j]['ingredient']}}"
                                                                   id="ingredient{{$mealPlans[$i]->meal->id}}{{$j}}"
                                                                   name="ingredients[{{$j}}]" data-error=".error-foodieIngred{{$j}}" class="required autocomplete inputBehind" readonly>
                                                        </div>
                                                        <div class="error-foodieIngred{{$j}} err"></div>
                                                        <div class="ingredGramsAdd">
                                                            <div class="gramLabel"><label for="grams[]">Grams</label></div>
                                                            <input type="number" value="{{$ingredientsMeal[$j]['grams']}}"
                                                                   name="grams[{{$j}}]"
                                                                   id="grams{{$mealPlans[$i]->meal->id}}{{$j}}" data-error=".error-foodieGram{{$j}}"
                                                                   class="required inputBehind" readonly>
                                                        </div>
                                                        <div class="error-foodieGram{{$j}} err"></div>
                                                    </div>
                                                @endif
                                            @endfor
                                        @endfor
                                        {{--<div><button id="u{{$i}}" data-form-id="editMeal{{$i}}" class="updateB btn" type="submit" form="editMeal{{$i}}">Update</button></div>--}}
                                    </div>
                                    <div style="clear: both"></div>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endfor
        @endunless

@endsection