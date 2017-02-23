@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="highlight">
            <thead>
            <tr>
                <th></th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                @if($mealPlansCount==0)
                    <td>NO MEALS YET!</td>
                @else
                    <td>Breakfast</td>
                    @foreach($mealPlans as $mealPlan)
                        @if($mealPlan->meal_type == 'Breakfast')
                            @if($mealPlan->day == 'MO')
                                <td><a href="#editMeal"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                </td>
                            @elseif($mealPlan->day == 'TU')
                                <td><a href="#editMeal"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                </td>
                            @elseif($mealPlan->day == 'WE')
                                <td><a href="#editMeal"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                </td>
                            @elseif($mealPlan->day == 'TH')
                                <td><a href="#editMeal"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                </td>
                            @elseif($mealPlan->day == 'FR')
                                <td><a href="#editMeal"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                </td>
                            @endif
                        @endif
                    @endforeach
            </tr>

            <tr>
                <td>Snack</td>
                @foreach($mealPlans as $mealPlan)
                    @if($mealPlan->meal_type == 'Snack')
                        @if($mealPlan->day == 'MO')
                            <td><a href="#editMeal"
                                   class=" waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @elseif($mealPlan->day == 'TU')
                            <td><a href="#editMeal"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @elseif($mealPlan->day == 'WE')
                            <td><a href="#editMeal"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @elseif($mealPlan->day == 'TH')
                            <td><a href="#editMeal"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @elseif($mealPlan->day == 'FR')
                            <td><a href="#editMeal"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @endif
                    @endif
                @endforeach
            </tr>

            <tr>
                <td>Lunch</td>
                @foreach($mealPlans as $mealPlan)
                    @if($mealPlan->meal_type == 'Lunch')
                        @if($mealPlan->day == 'MO')
                            <td><a href="#editMeal"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @elseif($mealPlan->day == 'TU')
                            <td><a href="#editMeal"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @elseif($mealPlan->day == 'WE')
                            <td><a href="#editMeal"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @elseif($mealPlan->day == 'TH')
                            <td><a href="#editMeal"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @elseif($mealPlan->day == 'FR')
                            <td><a href="#editMeal"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @endif
                    @endif
                @endforeach
            </tr>
            <tr>
                <td>Snack</td>
                @foreach($mealPlans as $mealPlan)
                    @if($mealPlan->meal_type == 'Snack')
                        @if($mealPlan->day == 'MO')
                            <td><a href="#editMeal"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @elseif($mealPlan->day == 'TU')
                            <td><a href="#editMeal"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @elseif($mealPlan->day == 'WE')
                            <td><a href="#editMeal"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @elseif($mealPlan->day == 'TH')
                            <td><a href="#editMeal"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @elseif($mealPlan->day == 'FR')
                            <td><a href="#editMeal"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @endif
                    @endif
                @endforeach
            </tr>
            <tr>
                <td>Dinner</td>
                @foreach($mealPlans as $mealPlan)
                    @if($mealPlan->meal_type == 'Dinner')
                        @if($mealPlan->day == 'MO')
                            <td><a href="#editMeal"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @elseif($mealPlan->day == 'TU')
                            <td><a href="#editMeal"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @elseif($mealPlan->day == 'WE')
                            <td><a href="#editMeal"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @elseif($mealPlan->day == 'TH')
                            <td><a href="#editMeal"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @elseif($mealPlan->day == 'FR')
                            <td><a href="#editMeal"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                        @endif
                    @endif
                @endforeach
                @endif
            </tr>
            </tbody>
        </table>
        <div>
            <button data-target="createMeal" class="btn modal-trigger">Create Meal</button>
        </div>

    </div>

    @unless($mealPlansCount==0)
        <div id="editMeal" class="modal">
            <form action="{{route('chef.meal.update', $mealPlan->id)}}" method="post">
                {{csrf_field()}}

                <div class="modal-content">
                    <h4>Update Meal</h4>
                    <p><label for="description">Description</label></p>
                    <input type="text" name="description" id="" class="form-control">

                    <p><label for="description">Main Ingredient</label></p>
                    <input type="text" name="main_ingredient" id="" class="form-control">

                    <select name="ingredient">
                        <option value="" disabled selected>Choose your option</option>
                        {{--@foreach($ingredients as $ingredient)--}}
                        {{--<option value="{{$ingredient->id}}">{{ $ingredient->description }}</option>--}}
                        {{--@endforeach--}}
                    </select>
                    <label for="grams">Grams:</label>
                    <input type="number" name="grams" id="grams" class="form-control">

                </div>
                <div class="modal-footer">
                    <button type="submit">Update</button>
                    {{--<a href="#!" class="modal-action modal-close waves-effect waves-green -flat">Agree</a>--}}
                </div>
            </form>

        </div>
    @endunless

    <div id="createMeal" class="modal">
        <div class="modal-content">
            <h4>Create Meal</h4>
            <form action="{{route('chef.meal.create')}}" method="post">
                {{csrf_field()}}
                <label for="description">Meal Name:</label>
                <input type="text" name="description" id="description" class="form-control">
                <select name="day">
                    <option disabled selected>Choose day</option>
                    <option>MO</option>
                    <option>TU</option>
                    <option>WE</option>
                    <option>TH</option>
                    <option>FR</option>
                </select>

                <select name="meal_type">
                    <option disabled selected>Choose Meal Type</option>
                    <option>Breakfast</option>
                    <option>Morning Snack</option>
                    <option>Lunch</option>
                    <option>Afternoon Snack</option>
                    <option>Dinner</option>
                </select>

                <select name="main_ingredient">
                    <option disabled selected>Choose Main Ingredient</option>
                    <option>Chicken</option>
                    <option>Beef</option>
                    <option>Pork</option>
                    <option>Vegetables</option>
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

