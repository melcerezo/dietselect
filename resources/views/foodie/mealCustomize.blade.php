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
                <span class="center full-width white-text"
                      style="font-size: 1.5em">Customize your Meals to suit you!</span>
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
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'MO')
                                        @foreach($customize as $cust )
                                            @if($cust->meal_id == $mealPlan->meal_id)
                                                <td><a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger">{{$cust->description}}</a><br>
                                                </td>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
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
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'MO')--}}
                                {{--<td><a href="#editMeal-{{$id}}"--}}
                                {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                {{--</td>--}}
                                {{--@endif--}}
                                {{--@endforeach--}}
                            </tr>
                            <tr id="Tuesday">
                                <th>Tuesday</th>
                                @foreach($mealPlans as $id=>$mealPlan)
                                    @if($mealPlan->day == 'TU')
                                        @foreach($customize as $cust )
                                            @if($cust->meal_id == $mealPlan->meal_id)
                                                <td><a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger">{{$cust->description}}</a><br>
                                                </td>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
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
                                {{--@foreach($mealPlans as $id=>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'TU')--}}
                                {{--<td><a href="#editMeal-{{$id}}"--}}
                                {{--class=" waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                {{--</td>--}}

                                {{--@endif--}}
                                {{--@endforeach--}}
                            </tr>
                            <tr id="Wednesday">
                                <th>Wednesday</th>
                                @foreach($mealPlans as $id=>$mealPlan)
                                    @if($mealPlan->day == 'WE')
                                        @foreach($customize as $cust )
                                            @if($cust->meal_id == $mealPlan->meal_id)
                                                <td><a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger">{{$cust->description}}</a><br>
                                                </td>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
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
                                {{--@foreach($mealPlans as $id=>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'WE')--}}
                                {{--<td><a href="#editMeal-{{$id}}"--}}
                                {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                {{--</td>--}}
                                {{--@endif--}}
                                {{--@endforeach--}}
                            </tr>
                            <tr id="Thursday">
                                <th>Thursday</th>
                                @foreach($mealPlans as $id=>$mealPlan)
                                    @if($mealPlan->day == 'TH')
                                        @foreach($customize as $cust )
                                            @if($cust->meal_id == $mealPlan->meal_id)
                                                <td><a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger">{{$cust->description}}</a><br>
                                                </td>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
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
                                {{--@foreach($mealPlans as $id=>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'TH')--}}
                                {{--<td><a href="#editMeal-{{$id}}"--}}
                                {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                {{--</td>--}}
                                {{--@endif--}}
                                {{--@endforeach--}}
                            </tr>
                            <tr id="Friday">
                                <th>Friday</th>
                                @foreach($mealPlans as $id=>$mealPlan)
                                    @if($mealPlan->day == 'FR')
                                        @foreach($customize as $cust )
                                            @if($cust->meal_id == $mealPlan->meal_id)
                                                <td><a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger">{{$cust->description}}</a><br>
                                                </td>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
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
                                {{--@foreach($mealPlans as $id=>$mealPlan)--}}
                                {{--@if($mealPlan->day == 'FR')--}}
                                {{--<td><a href="#editMeal-{{$id}}"--}}
                                {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                {{--</td>--}}

                                {{--@endif--}}
                                {{--@endforeach--}}
                            </tr>
                            <tr id="Saturday">
                                <th>Saturday</th>
                                @foreach($mealPlans as $id=>$mealPlan)
                                    @if($mealPlan->day == 'SA')
                                        @foreach($customize as $cust )
                                            @if($cust->meal_id == $mealPlan->meal_id)
                                                <td><a href="#editMeal-{{$id}}"
                                                       class="waves-effect waves-light modal-trigger">{{$cust->description}}</a><br>
                                                </td>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
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
                        <div>
                            <form action="{{route('foodie.order.review', $plan->id)}}">
                                {{csrf_field()}}
                                <input type="submit" class="btn" value="Order">
                            </form>

                        </div>
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
                        <form id="editMeal{{$i}}"
    {{--                          action="{{route('foodie.meal.custom',array($mealPlans[$i]->meal->id, $mealPlans[$i]->customized_meal))}}"--}}
                              action="{{route('foodie.meal.custom',array($mealPlans[$i]->meal->id))}}"
                              method="post" autocomplete="off">
                            {{csrf_field()}}
                            <div class="modal-content">
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

                                <p><label for="description">Main Ingredient</label></p>
                                <input type="text" name="main_ingredient" class="form-control"
                                       value="{{$cust->main_ingredient}}">

                                <div class="ingredLabel"><label for="ingredient">Ingredients</label></div>
                                <div class="gramLabel"><label for="grams">Grams</label></div>
                                <div id="ingredSelect" class="ingredSelect">
                                    @for($j=0;$j<$ingredientCount;$j++)
                                        @for($c=0;$c<$mealPlans[$i]->meal->ingredient_meal->count();$c++)
                                            @if($ingredientsMeal[$j]->meal_id==$cust->id && $c<1)
                                                <div id="ingredSelect{{$mealPlans[$i]->meal->id}}{{$j}}"
                                                     class="ingredSelectContainer">
                                                    <select id="ingredSelectOption{{$cust->id}}{{$j}}"
                                                            name="ingredient_select[]" class="updateIngredSelect">
                                                        <option disabled
                                                                selected>{{$ingredientsMeal[$j]->FdGrp_Desc}}</option>
                                                        <option value="chicken">Chicken</option>
                                                        <option value="beef">Beef</option>
                                                        <option value="pork">Pork</option>
                                                        <option value="carbohydrates(baked)">Carbohydrates(Baked)
                                                        </option>
                                                        <option value="carbohydrates(grains,pasta)">
                                                            Carbohydrates(Grains,
                                                            Pasta)
                                                        </option>
                                                        <option value="vegetables">Vegetables</option>
                                                    </select>
                                                    <div class="ingredSelectAdd input-field">
                                                        <input type="text" value="{{$ingredientsMeal[$j]->Long_Desc}}"
                                                               id="ingredient{{$mealPlans[$i]->meal->id}}{{$j}}"
                                                               name="ingredients[]" class="autocomplete inputBehind">
                                                    </div>
                                                    <div class="ingredGramsAdd">
                                                        <div class="gramLabel"><label for="grams[]">Grams</label></div>
                                                        <input type="number" value="{{$ingredientsMeal[$j]->grams}}"
                                                               name="grams[]"
                                                               id="grams{{$mealPlans[$i]->meal->id}}{{$j}}"
                                                               class="inputBehind"></div>
                                                </div>
                                            @endif
                                        @endfor
                                    @endfor
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" form="editMeal{{$i}}">Update</button>
                            </div>
                        </form>
                    </div>
                    @endif
                @endforeach
            @endfor
        @endunless
@endsection