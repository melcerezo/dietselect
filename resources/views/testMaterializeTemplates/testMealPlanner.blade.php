@extends('layouts.app')
@section('head')
        {{--/*.container{*/--}}
            {{--/*width:85%;*/--}}
        {{--/*}*/--}}
        {{--/*#testCreateModal.modal{*/--}}
            {{--/*width: 50% !important;*/--}}
            {{--/*max-height: 100% !important;*/--}}
            {{--/*border-radius: 5px;*/--}}
        {{--/*}*/--}}
        {{--/*.modal-header{*/--}}
            {{--/*width:100%;*/--}}
            {{--/*height:100%;*/--}}
            {{--/*min-height:80px;*/--}}
        {{--/*}*/--}}
    {{--<script>--}}
        {{--$(document).ready(function () {--}}
{{--//            $("select.selectRequired").css({display: "block", height: 0, padding: 0, width: 0, position: 'absolute'});--}}


            {{--$('.tdCell').each(function () {--}}
                {{--var day=$(this).attr('data-day');--}}
                {{--var mealType=$(this).attr('data-meal-type');--}}
                {{--if($(this).text().trim()==""){--}}
                    {{--$(this).append('<a href="#testCreateModal" data-day="'+day+'" data-meal-type="'+mealType+'" class="createMealLink modal-trigger">+Add Meal</a>');--}}
                {{--}--}}
            {{--});--}}
            {{--$('.createMealLink').on('click',function () {--}}
                {{--var mealDay = $(this).attr('data-day');--}}
                {{--var mealType=$(this).attr('data-meal-type');--}}
{{--//                $('option:selected','select[name="day"]').removeAttr('selected');--}}
                {{--switch(mealDay){--}}
                    {{--case 'MO':--}}
                        {{--$('#day').val("MO");--}}
                        {{--$('#dayName').empty();--}}
                        {{--$('#dayName').append("Monday");--}}
                        {{--break;--}}
                    {{--case 'TU':--}}
                        {{--$('#day').val("TU");--}}
                        {{--$('#dayName').empty();--}}
                        {{--$('#dayName').append("Tuesday");--}}
                        {{--console.log($('#day').val());--}}
                        {{--break;--}}
                    {{--case 'WE':--}}
                        {{--$('#day').val("WE");--}}
                        {{--$('#dayName').empty();--}}
                        {{--$('#dayName').append("Wednesday");--}}
                            {{--console.log($('#day').val());--}}
                        {{--break;--}}
                    {{--case 'TH':--}}
                        {{--$('#day').val("TH");--}}
                        {{--$('#dayName').empty();--}}
                        {{--$('#dayName').append("Thursday");--}}
                            {{--console.log($('#day').val());--}}
                        {{--break;--}}
                    {{--case 'FR':--}}
                        {{--$('#day').val("FR");--}}
                        {{--$('#dayName').empty();--}}
                        {{--$('#dayName').append("Friday");--}}
                            {{--console.log($('#day').val());--}}
                        {{--break;--}}
                    {{--case 'SA':--}}
                        {{--$('#day').val("SA");--}}
                        {{--$('#dayName').empty();--}}
                        {{--$('#dayName').append("Saturday");--}}
                            {{--console.log($('#day').val());--}}
                        {{--break;--}}
                {{--}--}}

                {{--switch(mealType){--}}
                    {{--case 'Breakfast':--}}
                        {{--$('#meal_type').val("Breakfast");--}}
                        {{--$('#mealType').empty();--}}
                        {{--$('#mealType').append("Breakfast");--}}
                        {{--break;--}}
                    {{--case 'MorningSnack':--}}
                        {{--$('#meal_type').val("MorningSnack");--}}
                        {{--$('#mealType').empty();--}}
                        {{--$('#mealType').append("Morning Snack");--}}
                        {{--console.log($('#meal_type').val());--}}
                        {{--break;--}}
                    {{--case 'Lunch':--}}
                        {{--$('#meal_type').val("Lunch");--}}
                        {{--$('#mealType').empty();--}}
                        {{--$('#mealType').append("Lunch");--}}
                            {{--console.log($('#meal_type').val());--}}
                        {{--break;--}}
                    {{--case 'AfternoonSnack':--}}
                        {{--$('#meal_type').val("AfternoonSnack");--}}
                        {{--$('#mealType').empty();--}}
                        {{--$('#mealType').append("Afternoon Snack");--}}
                            {{--console.log($('#meal_type').val());--}}
                        {{--break;--}}
                    {{--case 'Dinner':--}}
                        {{--$('#meal_type').val("Dinner");--}}
                        {{--$('#mealType').empty();--}}
                        {{--$('#mealType').append("Dinner");--}}
                            {{--console.log($('#meal_type').val());--}}
                        {{--break;--}}
                {{--}--}}
            {{--});--}}

            {{--$('#addMealButton').on('click',function () {--}}
                {{--$('#description').val($('#mealName').val());--}}
                {{--console.log($('#mealName').val());--}}
            {{--});--}}
        {{--});--}}
    {{--</script>--}}
        <style>
            table { border: none; border-collapse: collapse; table-layout: fixed;}
            /*table td { border-left: 1px solid #000; }*/
            th.dayTD { width: 50px;}
            td.dayTD div { border-radius: 100%; font-size: 20px}
            /*div.dayz { width: 100%; padding: 0 0; border-radius: 100%;}*/
            /*td.headZ { border: none; width:123px}*/

            table td:first-child { border-left: none; }
        </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">

            <table class="centered striped">
                <thead style="width: 50px;">
                    <tr class="light-green white-text">
                        <th class="dayTD"></th>
                        <th class="light-green white-text">
                            Bre
                        </th>
                        <th class="headZ">
                            Sna
                        </th>
                        <th class="headZ">
                            Lun
                        </th>
                        <th class="headZ">
                            Sna
                        </th>
                        <th class="headZ">
                            Din
                        </th>
                    </tr>
                </thead>
                <tr>
                    <td class="dayTD">
                        <div class="light-green white-text">M</div>
                    </td>
                    <td><div class="truncate">Meal 1</div><i class="material-icons">done</i></td>
                    <td><div class="truncate">Meal 2</div><i class="material-icons">done</i></td>
                    <td><div class="truncate">Meal 3</div><i class="material-icons">done</i></td>
                    <td><div class="truncate">Meal 4</div></td>
                    <td><div class="truncate">Meal 5</div></td>
                </tr>
                <tr>
                    <td class="dayTD">
                        <div class="light-green white-text">T</div>
                    </td>
                    <td><div class="truncate">Meal 6</div></td>
                    <td><div class="truncate">Meal 7</div></td>
                    <td><div class="truncate">Meal 8</div></td>
                    <td><div class="truncate">Meal 9</div></td>
                    <td><div class="truncate">Meal 10</div></td>
                </tr>
                <tr>
                    <td class="dayTD">
                        <div class="light-green white-text">W</div>
                    </td>
                    <td><div class="truncate">Meal 11</div></td>
                    <td><div class="truncate">Meal 12</div></td>
                    <td><div class="truncate">Meal 13</div></td>
                    <td><div class="truncate">Meal 14</div></td>
                    <td><div class="truncate">Meal 15</div></td>
                </tr>
                <tr>
                    <td class="dayTD">
                        <div class="light-green white-text">Th</div>
                    </td>
                    <td><div class="truncate">Meal 16</div></td>
                    <td><div class="truncate">Meal 17</div></td>
                    <td><div class="truncate">Meal 18</div></td>
                    <td><div class="truncate">Meal 19</div></td>
                    <td><div class="truncate">Meal 20</div></td>
                </tr>
                <tr>
                    <td class="dayTD">
                        <div class="light-green white-text">F</div>
                    </td>
                    <td><div class="truncate">Meal 21</div></td>
                    <td><div class="truncate">Meal 22</div></td>
                    <td><div class="truncate">Meal 23</div></td>
                    <td><div class="truncate">Meal 24</div></td>
                    <td><div class="truncate">Meal 25</div></td>
                </tr>
                <tr>
                    <td class="dayTD">
                        <div class="light-green white-text">S</div>
                    </td>
                    <td><div class="truncate"></div></td>
                    <td><div class="truncate"></div></td>
                    <td><div class="truncate"></div></td>
                    <td><div class="truncate"></div></td>
                    <td><div class="truncate"></div></td>
                </tr>
            </table>
        </div>
    </div>

    {{--<nav>--}}
        {{--<div class="nav-wrapper light-green">--}}
            {{--<a href="#" class="brand-logo">Diet Select</a>--}}
            {{--<ul id="nav-mobile" class="right hide-on-med-and-down">--}}
                {{--<li>--}}
                    {{--<a>--}}
                        {{--<span class="valign-wrapper" style="position: relative;">--}}
                            {{--<i class="material-icons" style="display: inline">email</i>--}}
                            {{--<span style="margin-left: 2px;">--}}
                                {{--Messages--}}
                                {{--<span class="new badge red">4</span>--}}
                            {{--</span>--}}
                        {{--</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a>--}}
                        {{--<span class="valign-wrapper">--}}
                            {{--<i class="material-icons" style="display: inline">announcement</i>--}}
                            {{--<span style="margin-left: 2px;">--}}
                                {{--Notifications--}}
                                {{--<span class="new badge red">2</span>--}}
                            {{--</span>--}}
                        {{--</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<li>--}}
                    {{--<a>--}}
                        {{--<img class="circle" src="/img/user.jpg" style="width: 40px; height: 40px; position: relative;">--}}
                        {{--<span style="margin-left: 2px;">Profile</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</div>--}}
    {{--</nav>--}}
        {{--<div class="row">--}}
            {{--<div class="col s12 card-panel light-green" style="margin-top: 1rem; padding:5px 10px; position: relative;">--}}
                {{--<div class="col s12 m6 l4">--}}
                    {{--<span class="white-text small">New Meal Name</span>--}}
                    {{--<input id="mealName" type="text" style="border-bottom: 1px solid #ffffff">--}}
                    {{--<button id="addMealButton" data-target="testCreateModal" class="modal-trigger btn orange waves-effect waves-light" style="position: absolute; top:37px; left:415px;">Add Meal</button>--}}
                {{--</div>--}}
                {{--<div class="col s12 m6 l6 white-text right right-align" style="margin-top:24px;">--}}
                    {{--<h5>Plan 1</h5>--}}
                {{--</div>--}}
                {{--<div style="clear: both;"></div>--}}
            {{--</div>--}}

        {{--</div>--}}

                {{--<table class="striped centered">--}}
                    {{--<thead class="light-green white-text" style="border: none;">--}}
                        {{--<th></th>--}}
                        {{--<th>Breakfast</th>--}}
                        {{--<th>Morning Snack</th>--}}
                        {{--<th>Lunch</th>--}}
                        {{--<th>Afternoon Snack</th>--}}
                        {{--<th>Dinner</th>--}}
                    {{--</thead>--}}
                    {{--<tbody>--}}
                        {{--<tr>--}}
                            {{--<td class="light-green white-text" style="font-weight: bold;">Monday</td>--}}
                            {{--<td id="MOBreakfast" data-day="MO" data-meal-type="Breakfast" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Breakfast')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="MOMorningSnack" data-day="MO" data-meal-type="MorningSnack" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'MorningSnack')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="MOLunch" data-day="MO" data-meal-type="Lunch" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Lunch')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="MOAfternoonSnack" data-day="MO" data-meal-type="AfternoonSnack" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="MODinner" data-day="MO" data-meal-type="Dinner" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Dinner')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td class="light-green white-text" style="font-weight: bold;">Tuesday</td>--}}
                            {{--<td id="TUBreakfast" data-day="TU" data-meal-type="Breakfast" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Breakfast')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="TUMorningSnack" data-day="TU" data-meal-type="MorningSnack" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'MorningSnack')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="TULunch" data-day="TU" data-meal-type="Lunch" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Lunch')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="TUAfternoonSnack" data-day="TU" data-meal-type="AfternoonSnack" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="TUDinner" data-day="TU" data-meal-type="Dinner" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Dinner')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td class="light-green white-text" style="font-weight: bold;">Wednesday</td>--}}
                            {{--<td id="WEBreakfast" data-day="WE" data-meal-type="Breakfast" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Breakfast')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="WEMorningSnack" data-day="WE" data-meal-type="MorningSnack" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'MorningSnack')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="WELunch" data-day="WE" data-meal-type="Lunch" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Lunch')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="WEAfternoonSnack" data-day="WE" data-meal-type="AfternoonSnack" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="WEDinner" data-day="WE" data-meal-type="Dinner" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Dinner')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td class="light-green white-text" style="font-weight: bold;">Thursday</td>--}}
                            {{--<td id="THBreakfast" data-day="TH" data-meal-type="Breakfast" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Breakfast')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="THMorningSnack" data-day="TH" data-meal-type="MorningSnack" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'MorningSnack')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="THLunch" data-day="TH" data-meal-type="Lunch" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Lunch')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="THAfternoonSnack" data-day="TH" data-meal-type="AfternoonSnack" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="THDinner" data-day="TH" data-meal-type="Dinner" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Dinner')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td class="light-green white-text" style="font-weight: bold;">Friday</td>--}}
                            {{--<td id="FRBreakfast" data-day="FR" data-meal-type="Breakfast" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Breakfast')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="FRMorningSnack" data-day="FR" data-meal-type="MorningSnack" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'MorningSnack')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="FRLunch" data-day="FR" data-meal-type="Lunch" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Lunch')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="FRAfternoonSnack" data-day="FR" data-meal-type="AfternoonSnack" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="FRDinner" data-day="FR" data-meal-type="Dinner" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Dinner')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td class="light-green white-text" style="font-weight: bold;">Saturday</td>--}}
                            {{--<td id="SABreakfast" data-day="SA" data-meal-type="Breakfast" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Breakfast')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="SAMorningSnack" data-day="SA" data-meal-type="MorningSnack" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'MorningSnack')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="SALunch" data-day="SA" data-meal-type="Lunch" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Lunch')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="SAAfternoonSnack" data-day="SA" data-meal-type="AfternoonSnack" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'AfternoonSnack')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                            {{--<td id="SADinner" data-day="SA" data-meal-type="Dinner" class="tdCell">--}}
                                {{--@foreach($mealPlans as $id =>$mealPlan)--}}
                                    {{--@if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Dinner')--}}
                                        {{--<a href="#editMeal-{{$id}}"--}}
                                           {{--class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>--}}
                                    {{--@endif--}}
                                {{--@endforeach--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                    {{--</tbody>--}}
                {{--</table>--}}
        {{--</div>--}}
    {{--</div>--}}

    {{--<div id="testCreateModal" class="modal" >--}}
        {{--<div class="modal-header light-green valign-wrapper">--}}
            {{--<span class="white-text" style="font-size: 40px; margin-left: 15px;">Create Meal</span>--}}
        {{--</div>--}}
            {{--<div>--}}
                {{--<span id="dayName"></span>--}}
            {{--</div>--}}
            {{--<div>--}}
                {{--<span id="mealType"></span>--}}
            {{--</div>--}}
            {{--<form id="createMealForm" action="" method="post" autocomplete="off">--}}
                {{--{{csrf_field()}}--}}
                {{--<div class="modal-content" style="position: relative;">--}}
                {{--<label for="description">Meal Name:</label>--}}
                {{--<input type="text" name="description" id="description" class="form-control">--}}
                {{--<div id="errorDescription"></div>--}}
                {{--<input type="hidden" id="day" name="day" value="">--}}
                {{--<input type="hidden" id="meal_type" name="meal_type" value="">--}}
                {{--<select id="main_ingredient" name="main_ingredient" class="selectRequired">--}}
                    {{--<option selected value="">Choose Main Ingredient</option>--}}
                    {{--<option value="Chicken">Chicken</option>--}}
                    {{--<option value="Beef">Beef</option>--}}
                    {{--<option value="Pork">Pork</option>--}}
                    {{--<option value="Vegetables">Vegetables</option>--}}
                    {{--<option value="Carbohydrates">Carbohydrates</option>--}}
                    {{--<option value="fruits">Fruits</option>--}}
                {{--</select>--}}
                {{--<div id="errorMainIngredient"></div>--}}
                {{--<div id="ingredientContainer" >--}}
                    {{--<div id="addMoreIngred"><a id="ingredAdd" class="orange-text" href="#!"><span class="addIngred">+Add Ingredients Here</span></a></div>--}}
                    {{--<div class="spacer" style="clear: both;"></div>--}}
                {{--</div>--}}
                {{--<div id="ingredError"></div>--}}
                {{--<div id="formError"></div>--}}
                {{--</div>--}}
                {{--<div class="modal-footer light-green" ><input type="submit" value="Submit" class="btn btn-primary orange"></div>--}}
            {{--</form>--}}
    {{--</div>--}}

@endsection