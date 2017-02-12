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
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'TU')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'WE')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'TH')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'FR')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @endif
                    @endif
                @endforeach
            </tr>

            <tr>
                <td>Snack</td>
                @foreach($mealPlans as $mealPlan)
                    @if($mealPlan->meal_type == 'Snack')
                        @if($mealPlan->day == 'MO')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'TU')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'WE')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'TH')
                            <td><a href="#editMeal" >{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'FR')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @endif
                    @endif
                @endforeach
            </tr>

            <tr>
                <td>Lunch</td>
                @foreach($mealPlans as $mealPlan)
                    @if($mealPlan->meal_type == 'Lunch')
                        @if($mealPlan->day == 'MO')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'TU')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'WE')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'TH')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'FR')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @endif
                    @endif
                @endforeach
            </tr>
            <tr>

                <td>Snack</td>
                @foreach($mealPlans as $mealPlan)
                    @if($mealPlan->meal_type == 'Snack')
                        @if($mealPlan->day == 'MO')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'TU')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'WE')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'TH')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'FR')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @endif
                    @endif
                @endforeach
            </tr>
            <tr>
                <td>Dinner</td>
                @foreach($mealPlans as $mealPlan)
                    @if($mealPlan->meal_type == 'Dinner')
                        @if($mealPlan->day == 'MO')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'TU')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'WE')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'TH')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @elseif($mealPlan->day == 'FR')
                            <td><a href="#editMeal" class="waves-effect waves-light ">{{$mealPlan->meal->description}}</a><br></td>
                        @endif
                    @endif
                @endforeach
            </tr>
            </tbody>
        </table>
    </div>

    <div id="editMeal" class="modal">
        <div class="modal-content">
            <h4>Modal Header</h4>
            <p>A bunch of text</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class=" modal-action modal-close waves-effect waves-green -flat">Agree</a>
        </div>
    </div>
@endsection

