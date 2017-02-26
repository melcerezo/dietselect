@extends('layouts.app')

@section('content')
                @if($mealPlansCount==0)

                    <div class="container">
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
                        </div>
                @else
                    <div class="container">
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
                            {{--@if($mealPlan->day == 'MO')--}}
                                <td><a href="#editMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                </td>
                            {{--@elseif($mealPlan->day == 'TU')--}}
                                {{--<td><a href="#editMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                {{--</td>--}}
                            {{--@elseif($mealPlan->day == 'WE')--}}
                                {{--<td><a href="#editMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                {{--</td>--}}
                            {{--@elseif($mealPlan->day == 'TH')--}}
                                {{--<td><a href="#editMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                {{--</td>--}}
                            {{--@elseif($mealPlan->day == 'FR')--}}
                                {{--<td><a href="#editMeal-{{$id}}"--}}
                                       {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                {{--</td>--}}
                            {{--@endif--}}
                        @endif
                    @endforeach
            </tr>
            <tr id="Tuesday">
                <th>Tuesday</th>
                @foreach($mealPlans as $id=>$mealPlan)
                    @if($mealPlan->day == 'TU')
                        {{--@if($mealPlan->day == 'MO')--}}
                            <td><a href="#editMeal-{{$id}}"
                                   class=" waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                    {{--    @elseif($mealPlan->day == 'TU')
                            <td><a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @elseif($mealPlan->day == 'WE')
                            <td><a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @elseif($mealPlan->day == 'TH')
                            <td><a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @elseif($mealPlan->day == 'FR')
                            <td><a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @endif--}}
                    @endif
                @endforeach
            </tr>
            <tr id="Wednesday">
                <th>Wednesday</th>
                @foreach($mealPlans as $id=>$mealPlan)
                    @if($mealPlan->day == 'WE')
                        {{--@if($mealPlan->day == 'MO')--}}
                            <td><a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        {{--@elseif($mealPlan->day == 'TU')--}}
                            {{--<td><a href="#editMeal-{{$id}}"--}}
                                   {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                            {{--</td>--}}
                        {{--@elseif($mealPlan->day == 'WE')--}}
                            {{--<td><a href="#editMeal-{{$id}}"--}}
                                   {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                            {{--</td>--}}
                        {{--@elseif($mealPlan->day == 'TH')--}}
                            {{--<td><a href="#editMeal-{{$id}}"--}}
                                   {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                            {{--</td>--}}
                        {{--@elseif($mealPlan->day == 'FR')--}}
                            {{--<td><a href="#editMeal-{{$id}}"--}}
                                   {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                            {{--</td>--}}
                        {{--@endif--}}
                    @endif
                @endforeach
            </tr>
            <tr id="Thursday">
                <th>Thursday</th>
                @foreach($mealPlans as $id=>$mealPlan)
                    @if($mealPlan->day == 'TH')
                        {{--@if($mealPlan->day == 'MO')--}}
                            <td><a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        {{--@elseif($mealPlan->day == 'TU')--}}
                            {{--<td><a href="#editMeal-{{$id}}"--}}
                                   {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                            {{--</td>--}}
                        {{--@elseif($mealPlan->day == 'WE')--}}
                            {{--<td><a href="#editMeal-{{$id}}"--}}
                                   {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                            {{--</td>--}}
                        {{--@elseif($mealPlan->day == 'TH')--}}
                            {{--<td><a href="#editMeal-{{$id}}"--}}
                                   {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                            {{--</td>--}}
                        {{--@elseif($mealPlan->day == 'FR')--}}
                            {{--<td><a href="#editMeal-{{$id}}"--}}
                                   {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                            {{--</td>--}}
                        {{--@endif--}}
                    @endif
                @endforeach
            </tr>
            <tr id="Friday">
                <th>Friday</th>
                @foreach($mealPlans as $id=>$mealPlan)
                    @if($mealPlan->day == 'FR')
                        {{--@if($mealPlan->day == 'MO')--}}
                            <td><a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        {{--@elseif($mealPlan->day == 'TU')--}}
                            {{--<td><a href="#editMeal-{{$id}}"--}}
                                   {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                            {{--</td>--}}
                        {{--@elseif($mealPlan->day == 'WE')--}}
                            {{--<td><a href="#editMeal-{{$id}}"--}}
                                   {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                            {{--</td>--}}
                        {{--@elseif($mealPlan->day == 'TH')--}}
                            {{--<td><a href="#editMeal-{{$id}}"--}}
                                   {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                            {{--</td>--}}
                        {{--@elseif($mealPlan->day == 'FR')--}}
                            {{--<td><a href="#editMeal-{{$id}}"--}}
                                   {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                            {{--</td>--}}
                        {{--@endif--}}
                    @endif
                @endforeach
            </tr>
                    <tr id="Saturday">
                        <th>Saturday</th>
                        @foreach($mealPlans as $id=>$mealPlan)
                            @if($mealPlan->day == 'SA')
                                {{--@if($mealPlan->day == 'MO')--}}
                                <td><a href="#editMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                </td>
                                {{--@elseif($mealPlan->day == 'TU')--}}
                                {{--<td><a href="#editMeal-{{$id}}"--}}
                                {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                {{--</td>--}}
                                {{--@elseif($mealPlan->day == 'WE')--}}
                                {{--<td><a href="#editMeal-{{$id}}"--}}
                                {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                {{--</td>--}}
                                {{--@elseif($mealPlan->day == 'TH')--}}
                                {{--<td><a href="#editMeal-{{$id}}"--}}
                                {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                {{--</td>--}}
                                {{--@elseif($mealPlan->day == 'FR')--}}
                                {{--<td><a href="#editMeal-{{$id}}"--}}
                                {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                {{--</td>--}}
                                {{--@endif--}}
                            @endif
                        @endforeach
                    </tr>
            </tbody>
        </table>
        @endif
        <div>
            <button data-target="createMeal" class="btn modal-trigger">Create Meal</button>
        </div>

    </div>

    @unless($mealPlansCount==0)
        @for($i=0;$i<$mealPlansCount;$i++)
            <div id="editMeal-{{$i}}" class="modal">
                <form action="{{route('chef.meal.update', $mealPlans[$i]->id)}}" method="post">
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
                            {{$i}}
                        </div>
                        <p><label for="description">Description</label></p>
                        <input type="text" name="description" class="form-control" value="{{$mealPlans[$i]->meal->description}}">

                        <p><label for="description">Main Ingredient</label></p>
                        <input type="text" name="main_ingredient" class="form-control" value="{{$mealPlans[$i]->meal->main_ingredient}}">

                        <select name="ingredient">
                            @for($j=0;$j<$mealPlans[$i]->meal->ingredient_meal->count();$j++)
                            <option value="" disabled selected>{{$mealPlans[$i]->meal->ingredient_meal[$j]->ingredient->description}}</option>
                            @foreach($ingredients as $ingredient)
                                <option value="{{$ingredient->id}}">{{ $ingredient->description }}</option>
                            @endforeach
                            @endfor
                        </select>
                        <label for="grams">Grams:</label>
                        <input type="number" name="grams" id="grams" class="form-control">

                    </div>
                    <div class="modal-footer">
                        <button type="submit">Update</button>
                        <a href="#!" class="modal-action modal-close waves-effect waves-green -flat">Agree</a>
                    </div>
                </form>

            </div>
        @endfor
    @endunless

    <div id="createMeal" class="modal">
        <div class="modal-content">
            <h4>Create Meal</h4>
            <form action="{{route('chef.meal.create', $plan->id)}}" method="post">
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

                <select name="ingredients">
                    <option value="" disabled selected>Choose Ingredient</option>
                    @foreach($ingredients as $ingredient)
                        <option value="{{$ingredient->id}}">{{ $ingredient->description }}</option>
                    @endforeach
                </select>

                <input type="number" name="grams" id="" class="form-control">


                <input type="submit" value="Submit" class="btn btn-primary">
            </form>
        </div>
    </div>


@endsection

