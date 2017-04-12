@extends('chef.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/chef/meal_planner.css">
    <script src="/js/ingredientAutocomplete.js"></script>
    <script src="/js/chef/mealPlannerValidate.js"></script>

@endsection

@section('page_content')
            <div class="container">
                <div class="row">
                    <h2 class="center white-text">Customize Meal Plan</h2>
                    <span class="center full-width white-text" style="font-size: 1.5em">Customize your Meals to suit you!</span>
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
                        <td id="MoBre">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Breakfast')
                                    <a href="#editMeal-{{$id}}"
                                           class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                                @endif
                            @endforeach
                        </td>
                        <td id="MoMorSna">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'MorningSnack')
                                    <a href="#editMeal-{{$id}}"
                                           class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                                @endif
                            @endforeach
                        </td>
                        <td id="MoLun">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Lunch')
                                    <a href="#editMeal-{{$id}}"
                                           class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="MoAftSna">
                            @foreach($mealPlans as $id =>$mealPlan)
                                @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'AfternoonSnack')
                                    <a href="#editMeal-{{$id}}"
                                           class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                @endif
                            @endforeach
                        </td>
                        <td id="MoDin">
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
                    <td id="TuBre">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Breakfast')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="TuMorSna">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'MorningSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="TuLun">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Lunch')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="TuAftSna">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'AfternoonSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="TuDin">
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
                    <td id="WeBre">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Breakfast')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="WeMorSna">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'MorningSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="WeLun">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Lunch')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="WeAftSna">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'AfternoonSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="WeDin">
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
                    <td id="ThBre">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Breakfast')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="ThMorSna">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'MorningSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="ThLun">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Lunch')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="ThAftSna">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'AfternoonSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="ThDin">
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
                    <td id="FrBre">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Breakfast')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="FrMorSna">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'MorningSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="FrLun">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Lunch')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="FrAftSna">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'AfternoonSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="FrDin">
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
                    <td id="SaBre">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Breakfast')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="SaMorSna">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'MorningSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>

                            @endif
                        @endforeach
                    </td>
                    <td id="SaLun">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Lunch')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="SaAftSna">
                        @foreach($mealPlans as $id =>$mealPlan)
                            @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'AfternoonSnack')
                                <a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            @endif
                        @endforeach
                    </td>
                    <td id="SaDin">
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
                <form id="editMeal{{$i}}" class="editMeal" action="{{route('chef.meal.update', $mealPlans[$i]->meal->id)}}" method="post" autocomplete="off">
                    {{csrf_field()}}
                    <div class="modal-content">
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
                        <input type="text" name="description" class="form-control" value="{{$mealPlans[$i]->meal->description}}">

                        <p><label for="description">Main Ingredient</label></p>
                        <input type="text" name="main_ingredient" class="form-control" value="{{$mealPlans[$i]->meal->main_ingredient}}">

                        <div class="ingredLabel"><label for="ingredient">Ingredients</label></div>
                        <div class="gramLabel"><label for="grams">Grams</label></div>
                        <div id="ingredSelect" class="ingredSelect">
                        @for($j=0;$j<$ingredientCount;$j++)
                            @for($c=0;$c<$mealPlans[$i]->meal->ingredient_meal->count();$c++)
                                @if($ingredientsMeal[$j]->meal_id==$mealPlans[$i]->meal->id && $c<1)
                                    <div id="ingredSelect{{$mealPlans[$i]->meal->id}}{{$j}}" class="ingredSelectContainer">
                                        <select id="ingredSelectOption{{$mealPlans[$i]->meal->id}}{{$j}}" name="ingredient_select[]" class="updateIngredSelect">
                                            <option disabled selected>{{$ingredientsMeal[$j]->FdGrp_Desc}}</option>
                                            <option value="chicken">Chicken</option>
                                            <option value="beef">Beef</option>
                                            <option value="pork">Pork</option>
                                            <option value="carbohydrates(baked)">Carbohydrates(Baked)</option>
                                            <option value="carbohydrates(grains,pasta)">Carbohydrates(Grains, Pasta)</option>
                                            <option value="vegetables">Vegetables</option>
                                        </select>
                                        <div id="updateIngredText{{$mealPlans[$i]->meal->id}}{{$j}}" class="ingredSelectAdd input-field" >
                                            <input type="text" value="{{$ingredientsMeal[$j]->Long_Desc}}" id="ingredient{{$mealPlans[$i]->meal->id}}{{$j}}" name="ingredients[]" class="autocomplete inputBehind">
                                        </div>
                                        <div class="ingredGramsAdd"><div class="gramLabel"><label for="grams[]">Grams</label></div><input type="number" value="{{$ingredientsMeal[$j]->grams}}" name="grams[]" id="grams{{$mealPlans[$i]->meal->id}}{{$j}}" class="inputBehind"></div>
                                    </div>
                                @endif
                            @endfor
                        @endfor
                        </div>
                        {{--<label for="grams">Grams:</label>--}}

                    </div>
                    <button type="submit" form="editMeal{{$i}}">Update</button>
                </form>
                <div class="modal-footer">
                    <form action="{{route('chef.meal.delete', $mealPlans[$i]->meal->id)}}" method="post">
                        {{csrf_field()}}
                        <button type="submit">Delete</button>
                    </form>
                    {{--<a href="#!" class="modal-action modal-close waves-effect waves-green -flat">Agree</a>--}}
                </div>

            </div>
        @endfor
    @endunless

    <div id="createMeal" class="modal">
        <div class="modal-content">
            <h4>Create Meal</h4>
            <form action="{{route('chef.meal.create', $plan->id)}}" method="post" autocomplete="off">
                {{csrf_field()}}
                <label for="description">Meal Name:</label>
                <input type="text" name="description" id="description" class="form-control">
                <select name="day">
                    <option disabled selected>Choose day</option>
                    <option value="MO">MO</option>
                    <option value="TU">TU</option>
                    <option value="WE">WE</option>
                    <option value="TH">TH</option>
                    <option value="FR">FR</option>
                </select>

                <select name="meal_type">
                    <option disabled selected>Choose Meal Type</option>
                    <option value="Breakfast">Breakfast</option>
                    <option value="MorningSnack">Morning Snack</option>
                    <option value="Lunch">Lunch</option>
                    <option value="AfternoonSnack">Afternoon Snack</option>
                    <option value="Dinner">Dinner</option>
                </select>

                <select name="main_ingredient">
                    <option disabled selected>Choose Main Ingredient</option>
                    <option value="Chicken">Chicken</option>
                    <option value="Beef">Beef</option>
                    <option value="Pork">Pork</option>
                    <option value="Vegetables">Vegetables</option>
                </select>

                <div id="ingredientContainer" >
                    <div id="addMoreIngred"><a id="ingredAdd" href="#"><span class="addIngred">+Add Ingredients Here</span></a></div>
                    <div class="spacer" style="clear: both;"></div>
                </div>
                {{--<script>--}}
                    {{--var count=0;--}}
                    {{--$(function(){--}}
                        {{--$('#ingredAdd').click(function () {--}}
                            {{--count+=1;--}}
                            {{--$('#ingredientContainer').prepend('<div class="ingredLabel"><label for="ingredients[]">Ingredients</label></div>'+'<div class="ingredSelectAdd input-field" ><input type="text" id="ingredient'+count+'" name="ingredients[]" class="autocomplete inputBehind"></div>'+--}}
                                    {{--'<div class="ingredGramsAdd">'+'<div class="gramLabel"><label for="grams[]">Grams</label></div>'+'<input type="number" name="grams[]" id="grams'+(count)+'" class="inputBehind"></div>');--}}
                            {{--});--}}
                        {{----}}
                        {{----}}
                        {{--});--}}
                {{--</script>--}}

                <div><input type="submit" value="Submit" class="btn btn-primary"></div>
            </form>
        </div>
    </div>

@endsection

