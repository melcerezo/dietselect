@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-responsive table-bordered">
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
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'TU')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'WE')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'TH')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'FR')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @endif
                    @endif
                @endforeach
            </tr>

            <tr>
                <td>Snack</td>
                @foreach($mealPlans as $mealPlan)
                    @if($mealPlan->meal_type == 'Snack')
                        @if($mealPlan->day == 'MO')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'TU')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'WE')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'TH')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'FR')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @endif
                    @endif
                @endforeach
            </tr>

            <tr>
                <td>Lunch</td>
                @foreach($mealPlans as $mealPlan)
                    @if($mealPlan->meal_type == 'Lunch')
                        @if($mealPlan->day == 'MO')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'TU')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'WE')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'TH')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'FR')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @endif
                    @endif
                @endforeach
            </tr>
            <tr>

                <td>Snack</td>
                @foreach($mealPlans as $mealPlan)
                    @if($mealPlan->meal_type == 'Snack')
                        @if($mealPlan->day == 'MO')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'TU')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'WE')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'TH')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'FR')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @endif
                    @endif
                @endforeach
            </tr>
            <tr>
                <td>Dinner</td>
                @foreach($mealPlans as $mealPlan)
                    @if($mealPlan->meal_type == 'Dinner')
                        @if($mealPlan->day == 'MO')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'TU')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'WE')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'TH')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @elseif($mealPlan->day == 'FR')
                            <td>{{$mealPlan->meal->description}}<br></td>
                        @endif
                    @endif
                @endforeach
            </tr>
            </tbody>
        </table>
    </div>
@endsection