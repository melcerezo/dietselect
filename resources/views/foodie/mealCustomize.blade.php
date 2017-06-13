@extends('foodie.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/foodie/foodieMealCustomize.css">
    <script src="/js/foodie/foodieIngredientAutocomplete.js"></script>
    <script src="/js/foodie/mealPlanValidate.js"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click','.data-trigger',function () {
                var $this=$(this);
                var mealDataID= $this.attr('data-meal-active');
                $('.plSlMlInf').hide();
                $('.plSlMlInfDef').hide();
                $(mealDataID).show();
            });
            $('.updateIngredSelect').on('change', function () {
                var $type = $(this).val();
                var $ingredsID = $(this).parents().eq(1).find('.input-field').find('.autocomplete').attr("id");
                var prevUpdateComplete=$(this).parents().eq(1).find('.input-field').attr('id');
                $.ajax({
                    url: '/foodie/' + $type + '/getIngredJson',
                    success: function (response) {
                        $('#'+prevUpdateComplete).find('.autocomplete-content').remove();
                        var $ingredsData = response;
                        $(function () {
                            $('#' + $ingredsID + '.autocomplete').autocomplete(JSON.parse($ingredsData));
                        })
                        // console.log(JSON.parse($ingredsData));
                    }
                });
            });
        });
    </script>

@endsection

@section('page_content')
    @if($mealPlansCount==0)
        <div>
            <h2>This Meal Plan is Empty!</h2>
        </div>
    @else

        <div class="container plSlCstCnt">
            <div class="row">
                <div class="col s12 light-green lighten-1 white-text plSlCstPlnNm valign-wrapper">
                    <span>Customize {{$plan->plan_name}}</span>
                </div>
            </div>
            <div class="row">
                <div class="card-panel" style="padding: 0;">
                    <table class="striped centered">
                        <thead class="light-green lighten-1 white-text" style="border: none;">
                        <th></th>
                        <th>Breakfast</th>
                        <th>Morning Snack</th>
                        <th>Lunch</th>
                        <th>Afternoon Snack</th>
                        <th>Dinner</th>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="light-green lighten-1 white-text" style="font-weight: bold;">Monday</td>
                            <td id="MOBreakfast" data-day="MO" data-meal-type="Breakfast" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Breakfast')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="MOMorningSnack" data-day="MO" data-meal-type="MorningSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'MorningSnack')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="MOLunch" data-day="MO" data-meal-type="Lunch" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Lunch')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="MOAfternoonSnack" data-day="MO" data-meal-type="AfternoonSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'AfternoonSnack')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="MODinner" data-day="MO" data-meal-type="Dinner" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'MO' && $mealPlan->meal_type == 'Dinner')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td class="light-green lighten-1 white-text" style="font-weight: bold;">Tuesday</td>
                            <td id="TUBreakfast" data-day="TU" data-meal-type="Breakfast" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Breakfast')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="TUMorningSnack" data-day="TU" data-meal-type="MorningSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'MorningSnack')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="TULunch" data-day="TU" data-meal-type="Lunch" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Lunch')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="TUAfternoonSnack" data-day="TU" data-meal-type="AfternoonSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'AfternoonSnack')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="TUDinner" data-day="TU" data-meal-type="Dinner" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'TU' && $mealPlan->meal_type == 'Dinner')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td class="light-green lighten-1 white-text" style="font-weight: bold;">Wednesday</td>
                            <td id="WEBreakfast" data-day="WE" data-meal-type="Breakfast" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Breakfast')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="WEMorningSnack" data-day="WE" data-meal-type="MorningSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'MorningSnack')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="WELunch" data-day="WE" data-meal-type="Lunch" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Lunch')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="WEAfternoonSnack" data-day="WE" data-meal-type="AfternoonSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'AfternoonSnack')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="WEDinner" data-day="WE" data-meal-type="Dinner" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'WE' && $mealPlan->meal_type == 'Dinner')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td class="light-green lighten-1 white-text" style="font-weight: bold;">Thursday</td>
                            <td id="THBreakfast" data-day="TH" data-meal-type="Breakfast" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Breakfast')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="THMorningSnack" data-day="TH" data-meal-type="MorningSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'MorningSnack')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="THLunch" data-day="TH" data-meal-type="Lunch" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Lunch')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="THAfternoonSnack" data-day="TH" data-meal-type="AfternoonSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'AfternoonSnack')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="THDinner" data-day="TH" data-meal-type="Dinner" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'TH' && $mealPlan->meal_type == 'Dinner')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td class="light-green lighten-1 white-text" style="font-weight: bold;">Friday</td>
                            <td id="FRBreakfast" data-day="FR" data-meal-type="Breakfast" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Breakfast')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="FRMorningSnack" data-day="FR" data-meal-type="MorningSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'MorningSnack')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="FRLunch" data-day="FR" data-meal-type="Lunch" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Lunch')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="FRAfternoonSnack" data-day="FR" data-meal-type="AfternoonSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'AfternoonSnack')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="FRDinner" data-day="FR" data-meal-type="Dinner" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'FR' && $mealPlan->meal_type == 'Dinner')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <td class="light-green lighten-1 white-text" style="font-weight: bold;">Saturday</td>
                            <td id="SABreakfast" data-day="SA" data-meal-type="Breakfast" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Breakfast')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="SAMorningSnack" data-day="SA" data-meal-type="MorningSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'MorningSnack')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="SALunch" data-day="SA" data-meal-type="Lunch" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Lunch')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="SAAfternoonSnack" data-day="SA" data-meal-type="AfternoonSnack" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'AfternoonSnack')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                            <td id="SADinner" data-day="SA" data-meal-type="Dinner" class="tdCell">
                                @foreach($mealPlans as $id =>$mealPlan)
                                    @if($mealPlan->day == 'SA' && $mealPlan->meal_type == 'Dinner')
                                        @foreach($customize as $cust)
                                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                                                <a data-meal-active="#viewMeal-{{$id}}"
                                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$cust->description}}</a>
                                                <br /><span id="cu{{$id}}"></span>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col s12 m6 plSlCstMlBtn">
                    <button type="button" data-target="orderReview" class="modal-trigger btn">Order</button>
                </div>
                <div class="col s12 m6 plSlCstMlInfCnt">
                    <div class="card-panel plSlMlInfDef plSlCstMlInf">
                        <span>Please click on a Meal to customize it!</span>
                    </div>
                    @foreach($mealPlans as $id=>$mealPlan)
                        @foreach($customize as $cust)
                            @if($cust->meal_id == $mealPlan->chefcustomize->id)
                            <div id="viewMeal-{{$id}}" class="plSlMlInf card-panel">
                                <ul class="collection plSlMlInfCtnt">
                                    <li class="collection-item light-green lighten-1 white-text">
                                        <span class="collection-header">{{$mealPlan->chefcustomize->description}}</span>
                                    </li>
                                    <li class="collection-item">
                                        <span>Day: </span>
                                        @if($mealPlan->day=='MO')
                                            <span>Monday</span>
                                        @elseif($mealPlan->day=='TU')
                                            <span>Tuesday</span>
                                        @elseif($mealPlan->day=='WE')
                                            <span>Wednesday</span>
                                        @elseif($mealPlan->day=='TH')
                                            <span>Thursday</span>
                                        @elseif($mealPlan->day=='FR')
                                            <span>Friday</span>
                                        @elseif($mealPlan->day=='SA')
                                            <span>Saturday</span>
                                        @endif
                                    </li>
                                    <li class="collection-item">
                                        <span>Meal: </span>
                                        <span>
                                        @if($mealPlan->meal_type=='MorningSnack')
                                                Morning Snack
                                            @elseif($mealPlan->meal_type=='AfternoonSnack')
                                                Afternoon Snack
                                            @else
                                                {{$mealPlan->meal_type}}
                                            @endif
                                    </span>
                                    </li>
                                    <li class="collection-item">
                                        <span>Main Ingredient: </span><span>{{ucwords($cust->main_ingredient)}}</span>
                                    </li>
                                    <li class="collection-item">
                                        <span>Calories: </span><span>{{$cust->calories}}</span>
                                    </li>
                                </ul>
                                <div class="editButton">
                                    <span>
                                        <button data-target="editMeal-{{$id}}" class="btn waves-effect waves-light modal-trigger">Edit</button>
                                    </span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>

        <div id="orderReview" class="modal" >
            <nav class="light-green lighten-1 white-text">
                <div class="left col s12 m5 l5">
                    <ul>
                        <li>
                            <span class="edtMlTtl" style="margin-left:20px; font-size: 20px;">Review Order of {{$plan->plan_name}}</span>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="modal-content">
                <ul class="collection">
                    {{--<li class="collection-item light-green lighten-1 white-text"><span class="collection-header">Order Review</span></li>--}}
                    <li class="collection-item">Chef Name: {{$viewPlan->chef->name}}</li>
                    <li class="collection-item">Plan Name:{{$viewPlan->plan_name}}</li>
                    <li class="collection-item">Plan Price:{{$viewPlan->price}}</li>
                </ul>
                <form action="{{route('foodie.custOrder.create', ['plan'=>$viewPlan->id,'id'=>$customId])}}" method="post">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-danger">Order</button>
                </form>
            </div>
        </div>
        @unless($mealPlansCount==0)
            @for($i=0;$i<$mealPlansCount;$i++)
                @foreach($customize as $cust)
                    @if($cust->meal_id == $mealPlans[$i]->chefcustomize->id)
                    <div id="editMeal-{{$i}}" class="modal">
                        <nav class="light-green lighten-1 white-text">
                            <div class="left col s12 m5 l5">
                                <ul>
                                    <li>
                                        <span class="edtMlTtl" style="font-size: 20px; margin-left: 20px;">Customize {{$cust->description}}</span>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <div class="modal-content">
                        <form id="editMeal{{$i}}"
    {{--                          action="{{route('foodie.meal.custom',array($mealPlans[$i]->meal->id, $mealPlans[$i]->customized_meal))}}"--}}
                              action="{{route('foodie.meal.custom',$cust->id)}}"
                              method="post" autocomplete="off" class="editMeal">
                            {{csrf_field()}}
                                {{--<h6>Customize Meal</h6>--}}
                                {{--<h4>{{$cust->description}}</h4>--}}
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

                            <p><label for="main_ingredient">Main Ingredient</label></p>
                            <div id="ingredUpdateSelectContent{{$i}}" class="addSelectIngred">
                                <select id='main_ingredient{{$i}}' class="selectRequired" name="main_ingredient">
                                    {{--<option disabled selected value="{{$mealPlans[$i]->meal->main_ingredient}}">{{$mealPlans[$i]->meal->main_ingredient}}</option>--}}
                                    <option value="chicken">Chicken</option>
                                    <option value="beef">Beef</option>
                                    <option value="pork">Pork</option>
                                    <option value="carbohydrates">Carbohydrates</option>
                                    <option value="vegetables">Vegetables</option>
                                    <option value="fruits">Fruits</option>
                                </select>
                            </div>
                            <script>
                                $(document).ready(function () {
                                    var mainIngred='{{ $cust->main_ingredient}}';
                                    $('select#main_ingredient{{$i}}').val(mainIngred.toLowerCase());
                                });
                            </script>

                                {{--{{$cust->id}}--}}
                                <div id="ingredSelect" class="ingredSelect">
                                    @for($j=0;$j<count($ingredientsMeal);$j++)
                                        @for($c=0;$c<$mealPlans[$i]->chefcustomize->customized_ingredient_meal->count();$c++)
                                            @if($ingredientsMeal[$j]['meal']==$cust->id && $c<1)
                                                <div id="ingredSelect{{$mealPlans[$i]->chefcustomize->id}}{{$j}}"
                                                     data-ing-type="{{$ingredientsMeal[$j]['ingredient_group']}}"
                                                     class="ingredSelectContainer">
                                                    <select id="ingredSelectOption{{$cust->id}}{{$j}}"
                                                            name="ingredient_select[]" class="updateIngredSelect"
                                                            data-ing-type="{{$ingredientsMeal[$j]['ingredient_group']}}">
                                                        <option disabled
                                                                selected value="{{$ingredientsMeal[$j]['ingredient_group']}}">{{$ingredientsMeal[$j]['ingredient_group']}}</option>
                                                        <option value="chicken">Chicken</option>
                                                        <option value="beef">Beef</option>
                                                        <option value="pork">Pork</option>
                                                        <option value="carbohydrates(baked)">Carbohydrates(Baked)</option>
                                                        <option value="carbohydrates(grains,pasta)">Carbohydrates(Grains,Pasta)</option>
                                                        <option value="dairy,eggs">Dairy, Eggs</option>
                                                        <option value="soups,sauces,gravy">Soups, Sauces, Gravy</option>
                                                        <option value="fruits">Fruits, Fruit Juices</option>
                                                        <option value="vegetables">Vegetables</option>
                                                    </select>
                                                    <div id="updateIngredText{{$cust->id}}{{$j}}" class="ingredSelectAdd input-field">
                                                        <div class="ingredLabel"><label for="ingredients[]" class="active" style="color: #9e9e9e;">Ingredient</label></div>
                                                        <input type="text" value="{{$ingredientsMeal[$j]['ingredient']}}"
                                                               id="ingredient{{$mealPlans[$i]->meal->id}}{{$j}}"
                                                               data-ing-type="{{$ingredientsMeal[$j]['ingredient_group']}}"
                                                               name="ingredients[{{$j}}]" data-error=".error-foodieIngred{{$j}}" class="required autocomplete inputBehind">
                                                    </div>
                                                    <div class="error-foodieIngred{{$j}} err"></div>
                                                    <div class="ingredGramsAdd">
                                                        <div class="gramLabel"><label for="grams[]">Grams</label></div>
                                                        <input type="number" value="{{$ingredientsMeal[$j]['grams']}}"
                                                               name="grams[{{$j}}]"
                                                               id="grams{{$mealPlans[$i]->meal->id}}{{$j}}" data-error=".error-foodieGram{{$j}}"
                                                               class="required inputBehind">
                                                    </div>
                                                    <div class="error-foodieGram{{$j}} err"></div>
                                                </div>
                                            @endif
                                        @endfor
                                    @endfor
                                <div><button id="u{{$i}}" data-form-id="editMeal{{$i}}" class="updateB btn" type="submit" form="editMeal{{$i}}">Update</button></div>
                                </div>
                            <div style="clear: both"></div>
                        </form>
                    </div>
                    </div>
                    @endif
                @endforeach
            @endfor
        @endunless
@endsection