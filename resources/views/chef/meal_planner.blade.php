@extends('chef.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/chef/meal_planner.css">
    <script src="/js/ingredientAutocomplete.js"></script>
    <script src="/js/chef/mealPlannerValidate.js"></script>

@endsection

@section('page_content')
            <div class="container">
                <div class="row">
                    <h2 class="center white-text">Set Meal Planner</h2>
                    <span class="center full-width white-text" style="font-size: 1.5em">Make your meals for your clients!</span>
                    <div class="card papaya-whip">
                        <div class="card-content">
                @if($mealPlansCount==0)
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
                                </tr>
                                <tr id="Tuesday">
                                    <th>Tuesday</th>
                                </tr>
                                <tr id="Wednesday">
                                    <th>Wednesday</th>
                                </tr>
                                <tr id="Thursday">
                                    <th>Thursday</th>
                                </tr>
                                <tr id="Friday">
                                    <th>Friday</th>
                                </tr>
                                <tr id="Saturday">
                                    <th>Saturday</th>
                                </tr>
                            </tbody>
                        </table>
                @else
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
                        <td id="MOBreakfast" class="mealTd">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Breakfast')
                                    <a href="#editMeal-{{$id}}"
                                           class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                                @endif
                            @endforeach
                        </td>
                        <td id="MOMorningSnack" class="mealTd">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'MorningSnack')
                                    <a href="#editMeal-{{$id}}"
                                           class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                                @endif
                            @endforeach
                        </td>
                        <td id="MOLunch" class="mealTd">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Lunch')
                                    <a href="#editMeal-{{$id}}"
                                           class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="MOAfternoonSnack" class="mealTd">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'AfternoonSnack')
                                    <a href="#editMeal-{{$id}}"
                                           class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="MODinner" class="mealTd">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Dinner')
                                    <a href="#editMeal-{{$id}}"
                                           class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                </tr>
                <tr id="Tuesday">
                    <th>Tuesday</th>
                    <td id="TUBreakfast" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Breakfast')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="TUMorningSnack" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'MorningSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="TULunch" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Lunch')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="TUAfternoonSnack" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'AfternoonSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="TUDinner" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Dinner')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr id="Wednesday">
                    <th>Wednesday</th>
                    <td id="WEBreakfast" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Breakfast')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="WEMorningSnack" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'MorningSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="WELunch" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Lunch')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="WEAfternoonSnack" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'AfternoonSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="WEDinner" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Dinner')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr id="Thursday">
                    <th>Thursday</th>
                    <td id="THBreakfast" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Breakfast')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="THMorningSnack" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'MorningSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="THLunch" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Lunch')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="THAfternoonSnack" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'AfternoonSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="THDinner" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Dinner')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr id="Friday">
                    <th>Friday</th>
                    <td id="FRBreakfast" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Breakfast')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="FRMorningSnack" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'MorningSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="FRLunch" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Lunch')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="FRAfternoonSnack" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'AfternoonSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="FRDinner" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Dinner')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr id="Saturday">
                    <th>Saturday</th>
                    <td id="SABreakfast" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Breakfast')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="SAMorningSnack" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'MorningSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="SALunch" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Lunch')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="SAAfternoonSnack" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'AfternoonSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="SADinner" class="mealTd">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Dinner')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                </tr>
                </tbody>
            </table>
            @endif
            <div>
                <button data-target="createMeal" class="btn modal-trigger">Create Meal</button>
            </div>
        </div>
    </div>
    <div>
        <a href="{{route('chef.dashboard')}}" class="btn" style="color: #ffffff">Finish</a>
    </div>
</div>
</div>

    @unless($mealPlansCount==0)
        @for($i=0;$i<$mealPlansCount;$i++)
            <div id="editMeal-{{$i}}" class="modal">
                <i data-meal-id="{{$mealPlans[$i]->meal->id}}"></i>
                <div class="modal-content">
                <form id="editMeal{{$i}}" class="editMeal" action="{{route('chef.meal.update', $mealPlans[$i]->meal->id)}}" method="post" autocomplete="off">
                    {{csrf_field()}}
                        {{$mealPlans[$i]->meal->description}}
                        <h4>Update Meal</h4>
                        <h5>Meal Stats:</h5>
                        <div>
                            Calories: {{$mealPlans[$i]->meal->calories}}
                        </div>
                        <div>
                            Carbohydrates: {{$mealPlans[$i]->meal->carbohydrates}}g
                        </div>
                        <div>
                            Protein: {{$mealPlans[$i]->meal->protein}}g
                        </div>
                        <div>
                            Fat: {{$mealPlans[$i]->meal->fat}}g
                        </div>
                        <div>
                            {{$mealPlans[$i]->meal->ingredient_meal->count()}}
                        </div>
                        <p><label for="description">Description</label></p>
                        <input type="text" name="description" class="form-control" data-error=".error-desc" value="{{$mealPlans[$i]->meal->description}}">
                        <div class="error-desc err"></div>
                        <p><label for="main_ingredient">Main Ingredient</label></p>
                        <div id="ingredUpdateSelectContent{{$i}}" class="addSelectIngred">
                            <select id='main_ingredient{{$i}}' class="selectRequired" name="main_ingredient">
                                {{--<option disabled selected value="{{$mealPlans[$i]->meal->main_ingredient}}">{{$mealPlans[$i]->meal->main_ingredient}}</option>--}}
                                <option value="chicken">Chicken</option>
                                <option value="beef">Beef</option>
                                <option value="pork">Pork</option>
                                <option value="carbohydrates(baked)">Carbohydrates(Baked)</option>
                                <option value="carbohydrates(grains,pasta)">Carbohydrates(Grains, Pasta)</option>
                                <option value="vegetables">Vegetables</option>
                                </select>
                            </div>
                            <script>
                                $(document).ready(function () {
                                    var mainIngred='{{ $mealPlans[$i]->meal->main_ingredient}}';
                                    $('select#main_ingredient{{$i}}').val(mainIngred.toLowerCase());
                                });
                            </script>
                        <div class="ingredLabel"><label for="ingredient">Ingredients</label></div>
                        <div id="ingredSelect" class="ingredSelect">
                        @for($j=0;$j<$ingredientCount;$j++)
                            @for($c=0;$c<$mealPlans[$i]->meal->ingredient_meal->count();$c++)
                                @if($ingredientsMeal[$j]->meal_id==$mealPlans[$i]->meal->id && $c<1)
                                    <div id="ingredSelect{{$mealPlans[$i]->meal->id}}{{$j}}" class="ingredSelectContainer">
                                        <select id="ingredSelectOption{{$mealPlans[$i]->meal->id}}{{$j}}" name="ingredient_select[{{$j}}]" class="required updateIngredSelect">
                                            <option disabled selected>{{$ingredientsMeal[$j]->FdGrp_Desc}}</option>
                                            <option value="chicken">Chicken</option>
                                            <option value="beef">Beef</option>
                                            <option value="pork">Pork</option>
                                            <option value="carbohydrates(baked)">Carbohydrates(Baked)</option>
                                            <option value="carbohydrates(grains,pasta)">Carbohydrates(Grains, Pasta)</option>
                                            <option value="vegetables">Vegetables</option>
                                        </select>
                                        <div id="updateIngredText{{$mealPlans[$i]->meal->id}}{{$j}}" class="ingredSelectAdd input-field" >
                                            <input type="text" value="{{$ingredientsMeal[$j]->Long_Desc}}" id="ingredient{{$mealPlans[$i]->meal->id}}{{$j}}" name="ingredients[{{$j}}]" data-error=".error-updateIngred" class="required autocomplete ingredAuto inputBehind">
                                        </div>
                                        <div class="error-updateIngred err"></div>
                                        <div class="ingredGramsAdd"><div class="gramLabel"><label for="grams[]">Grams</label></div>
                                            <input type="number" value="{{$ingredientsMeal[$j]->grams}}" name="grams[{{$j}}]" id="grams{{$mealPlans[$i]->meal->id}}{{$j}}" data-error=".error-updateGram" class="required gramsAuto inputBehind"></div>
                                        <div class="error-updateGram err"></div>
                                    </div>
                                @endif
                            @endfor
                        @endfor
                        <button onclick="{{route('chef.meal.delete', $mealPlans[$i]->meal->id)}}">Update</button>
                        {{--<label for="grams">Grams:</label>--}}
                        <button type="submit" >Delete</button>
                        </div>

                </form>



                </div>
            </div>
        @endfor
    @endunless

    <div id="createMeal" class="modal">
        <div class="modal-content">
            <h4>Create Meal</h4>
            <form id="createMealForm" action="{{route('chef.meal.create', $plan->id)}}" method="post" autocomplete="off">
                {{csrf_field()}}
                <label for="description">Meal Name:</label>
                <input type="text" name="description" id="description" class="form-control">
                <div id="errorDescription" class="error"></div>
                <select id="day" name="day" class="selectRequired">
                    <option selected value="">Choose day</option>
                    <option value="MO">MO</option>
                    <option value="TU">TU</option>
                    <option value="WE">WE</option>
                    <option value="TH">TH</option>
                    <option value="FR">FR</option>
                    <option value="SA">SA</option>
                </select>
                <div id="errorDay"></div>
                <select id="meal_type" name="meal_type" class="selectRequired">
                    <option selected value="">Choose Meal Type</option>
                    <option value="Breakfast">Breakfast</option>
                    <option value="MorningSnack">Morning Snack</option>
                    <option value="Lunch">Lunch</option>
                    <option value="AfternoonSnack">Afternoon Snack</option>
                    <option value="Dinner">Dinner</option>
                </select>
                <div id="errorMealType"></div>
                <div id="tdTaken"></div>
                <select id="main_ingredient" name="main_ingredient" class="selectRequired">
                    <option selected value="">Choose Main Ingredient</option>
                    <option value="Chicken">Chicken</option>
                    <option value="Beef">Beef</option>
                    <option value="Pork">Pork</option>
                    <option value="Vegetables">Vegetables</option>
                </select>
                <div id="errorMainIngredient"></div>
                <div id="ingredientContainer" >
                    <div id="addMoreIngred"><a id="ingredAdd" href="#"><span class="addIngred">+Add Ingredients Here</span></a></div>
                    <div class="spacer" style="clear: both;"></div>
                </div>
                <div id="ingredError"></div>
                <div id="formError"></div>
                <div><input type="submit" value="Submit" class="btn btn-primary"></div>
            </form>
        </div>
    </div>

@endsection

