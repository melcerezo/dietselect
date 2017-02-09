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
                        <td>{{$mealPlan->meal->description}}<br></td>
                    @endif
                @endforeach
                {{--@foreach($mealPlans as $mealPlan)--}}

                {{--@if($mealPlan->meal_type == 'Breakfast')--}}
                {{--<td>Breakfast</td>--}}
                {{--<td>{{$mealPlan->meal->description}}</td>--}}
                {{--@endif--}}

                {{--@if($mealPlan->meal_type == 'Snack')--}}
                {{--<td>Breakfast</td>--}}
                {{--<td>{{$mealPlan->meal->description}}</td>--}}
                {{--@endif--}}

                {{--@if($mealPlan->meal_type == 'Lunch')--}}
                {{--<td>Breakfast</td>--}}
                {{--<td>{{$mealPlan->meal->description}}</td>--}}
                {{--@endif--}}

                {{--@if($mealPlan->meal_type == 'Dinner')--}}
                {{--<td>Breakfast</td>--}}
                {{--<td>{{$mealPlan->meal->description}}</td>--}}
                {{--@endif--}}

                {{----}}
                {{--@endforeach--}}
            </tr>

            <tr>
                <td>Snack</td>
                @foreach($mealPlans as $mealPlan)
                    @if($mealPlan->meal_type == 'Snack')
                        <td>{{$mealPlan->meal->description}}<br></td>
                    @endif
                @endforeach
            </tr>

            <tr>
                <td>Lunch</td>
                @foreach($mealPlans as $mealPlan)
                    @if($mealPlan->meal_type == 'Lunch')
                        <td>{{$mealPlan->meal->description}}<br></td>
                    @endif
                @endforeach
            </tr>
            <tr>

                <td>Snack</td>
                @foreach($mealPlans as $mealPlan)
                    @if($mealPlan->meal_type == 'Snack')
                        <td>{{$mealPlan->meal->description}}<br></td>
                    @endif
                @endforeach
            </tr>
            <tr>
                <td>Dinner</td>
                @foreach($mealPlans as $mealPlan)
                    @if($mealPlan->meal_type == 'Dinner')
                        <td>{{$mealPlan->meal->description}}<br></td>
                    @endif
                @endforeach
            </tr>
            </tbody>
        </table>
    </div>
@endsection