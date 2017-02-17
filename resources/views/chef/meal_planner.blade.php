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
            </tr>
            </tbody>
        </table>
    </div>

    <div id="editMeal" class="modal">
        <form action="{{route('chef.plan.update', $mealPlan->id)}}" method="post">
            {{csrf_field()}}

            <div class="modal-content">
                <h4>Update Meal</h4>
                <p><label for="description">Description</label></p>
                <input type="text" name="description" id="" class="form-control">

                <p><label for="description">Main Ingredient</label></p>
                <input type="text" name="main_ingredient" id="" class="form-control">

                <select name="ingredient">
                    <option value="" disabled selected>Choose your option</option>
                    @foreach($ingredients as $ingredient)
                        <option value="{{$ingredient->id}}">{{ $ingredient->description }}</option>
                    @endforeach
                </select>
                <label for="grams">Grams:</label>
                <input type="number" name="grams" id="grams" class="form-control">

            </div>
            <div class="modal-footer">
                <button type="submit">Agree</button>
                {{--<a href="#!" class="modal-action modal-close waves-effect waves-green -flat">Agree</a>--}}
            </div>
        </form>

    </div>

    <div class="row col-md-5">
        <form action="{{url('chef/plan/create')}}" method="post">
            {{csrf_field()}}
            <input type="text" name="description" id="">
            <input type="submit" value="Submit" class="btn btn-primary">
        </form>
    </div>


@endsection

