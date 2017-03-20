@extends('foodie.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/foodie/foodieMealCustomize.css">
    <script src="/js/foodie/foodieIngredientAutocomplete.js"></script>

@endsection

@section('page_content')
    @if($mealPlansCount==0)
        <div>
            <h2>This Meal Plan is Empty!</h2>
        </div>
    @else
        <div class="container">
            <div class="row">
                <h2 class="center white-text">Customize Meal Plan</h2>
                <span class="center full-width white-text" style="font-size: 1.5em">Customize your Meals to suit you!</span>
                <div class="card papaya-whip">
                    <div class="card-content">
                        <h4 class="mustard-text">Meal Plans:</h4>
                        <table {{--class="highlight"--}}>
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
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'MO')
                                        <td><a href="#editMeal-{{$id}}"
                                               class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr id="Tuesday">
                                <th>Tuesday</th>
                                @foreach($mealPlans as $id=>$mealPlan)
                                    @if($mealPlan->day == 'TU')
                                        <td><a href="#editMeal-{{$id}}"
                                               class=" waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                        </td>

                                    @endif
                                @endforeach
                            </tr>
                            <tr id="Wednesday">
                                <th>Wednesday</th>
                                @foreach($mealPlans as $id=>$mealPlan)
                                    @if($mealPlan->day == 'WE')
                                        <td><a href="#editMeal-{{$id}}"
                                               class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr id="Thursday">
                                <th>Thursday</th>
                                @foreach($mealPlans as $id=>$mealPlan)
                                    @if($mealPlan->day == 'TH')
                                        <td><a href="#editMeal-{{$id}}"
                                               class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                        </td>
                                    @endif
                                @endforeach
                            </tr>
                            <tr id="Friday">
                                <th>Friday</th>
                                @foreach($mealPlans as $id=>$mealPlan)
                                    @if($mealPlan->day == 'FR')
                                        <td><a href="#editMeal-{{$id}}"
                                               class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                        </td>

                                    @endif
                                @endforeach
                            </tr>
                            <tr id="Saturday">
                                <th>Saturday</th>
                                @foreach($mealPlans as $id=>$mealPlan)
                                    @if($mealPlan->day == 'SA')
                                        <td><a href="#editMeal-{{$id}}"
                                               class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                        </td>
                                    @endif
                                @endforeach
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
                <div id="editMeal-{{$i}}" class="modal">
                    <i data-meal-id="{{$mealPlans[$i]->meal->id}}"></i>
                    <form id="editMeal{{$i}}" action="{{route('foodie.meal.custom',$mealPlans[$i]->meal->id)}}" method="post" autocomplete="off">
                        {{csrf_field()}}
                        {{$mealPlans[$i]->id}}
                        <div class="modal-content">
                            <h6>Customize Meal</h6>
                            <h4>{{$mealPlans[$i]->meal->description}}</h4>
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
                                                <div class="ingredSelectAdd input-field" >
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
                        <div class="modal-footer">
                            <button type="submit" form="editMeal{{$i}}">Update</button>
                        </div>
                    </form>
                </div>
            @endfor
        @endunless


</div>
@endsection