@extends('foodie.layout')
@section('page_head')
    <link rel="stylesheet" href="/css/foodie/foodieSimpleCustomize.css">
    <script src="/js/foodie/foodieSimpleCustomize.js" defer></script>
    <script>
        $(document).ready(function () {
            $(document).on('click','.data-trigger',function () {
                var $this=$(this);
                var mealDataID= $this.attr('data-meal-active');
                $('.plSlMlInf').hide();
                $('.plSlMlInfDef').hide();
                $(mealDataID).show();
            });
        });
    </script>
@endsection
@section('page_content')
    <div class="container" style="margin-top: 0.5rem;">
        <div class="row">
            <table class="striped centered responsive-table" style="table-layout: fixed;">
                <thead class="light-green white-text" style="border: none;">
                <tr>
                    <th></th>
                    <th id="Breakfast">Breakfast</th>
                    @if($moSnaMeals>0)
                        <th id="MorningSnack">Snack</th>
                    @endif
                    <th id="Lunch">Lunch</th>
                    @if($aftSnaMeals>0)
                        <th id="AfternoonSnack">Snack</th>
                    @endif
                    <th id="Dinner">Dinner</th>
                </tr>
                </thead>
                <tbody>
                <tr id="Monday">
                    <td class="light-green white-text" style="font-weight: bold;">Monday</td>
                    <td id="MoBre">
                        @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                            @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'MO' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'Breakfast')
                                <a data-meal-active="#viewMeal-{{$id}}"
                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                <br />
                                <div id="cu{{$id}}">
                                    @if($simpleCustomMeal->is_customized==1)
                                        <p>Customized</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </td>
                    @if($moSnaMeals>0)
                        <td id="MoMorSna">
                            @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                                @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'MO' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'MorningSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                    <br />
                                    <div id="cu{{$id}}">
                                        @if($simpleCustomMeal->is_customized==1)
                                            <p>Customized</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </td>
                    @endif
                    <td id="MoLun">
                        @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                            @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'MO' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'Lunch')
                                <a data-meal-active="#viewMeal-{{$id}}"
                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                <br />
                                <div id="cu{{$id}}">
                                    @if($simpleCustomMeal->is_customized==1)
                                        <p>Customized</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </td>
                    @if($aftSnaMeals>0)
                        <td id="MoAftSna">
                            @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                                @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'MO' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                    <br />
                                    <div id="cu{{$id}}">
                                        @if($simpleCustomMeal->is_customized==1)
                                            <p>Customized</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </td>
                    @endif
                    <td id="MoDin">
                        @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                            @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'MO' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'Dinner')
                                <a data-meal-active="#viewMeal-{{$id}}"
                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                <br />
                                <div id="cu{{$id}}">
                                    @if($simpleCustomMeal->is_customized==1)
                                        <p>Customized</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr id="Tuesday">
                    <td class="light-green white-text" style="font-weight: bold;">Tuesday</td>
                    <td id="TuBre">
                        @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                            @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'TU' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'Breakfast')
                                <a data-meal-active="#viewMeal-{{$id}}"
                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                <br />
                                <div id="cu{{$id}}">
                                    @if($simpleCustomMeal->is_customized==1)
                                        <p>Customized</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </td>
                    @if($moSnaMeals>0)
                        <td id="TuMorSna">
                            @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                                @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'TU' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'MorningSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                    <br />
                                    <div id="cu{{$id}}">
                                        @if($simpleCustomMeal->is_customized==1)
                                            <p>Customized</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </td>
                    @endif
                    <td id="TuLun">
                        @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                            @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'TU' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'Lunch')
                                <a data-meal-active="#viewMeal-{{$id}}"
                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                <br />
                                <div id="cu{{$id}}">
                                    @if($simpleCustomMeal->is_customized==1)
                                        <p>Customized</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </td>
                    @if($aftSnaMeals>0)
                        <td id="TuAftSna">
                            @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                                @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'TU' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                    <br />
                                    <div id="cu{{$id}}">
                                        @if($simpleCustomMeal->is_customized==1)
                                            <p>Customized</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </td>
                    @endif
                    <td id="TuDin">
                        @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                            @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'TU' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'Dinner')
                                <a data-meal-active="#viewMeal-{{$id}}"
                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                <br />
                                <div id="cu{{$id}}">
                                    @if($simpleCustomMeal->is_customized==1)
                                        <p>Customized</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr id="Wednesday">
                    <td class="light-green white-text" style="font-weight: bold;">Wednesday</td>
                    <td id="WeBre">
                        @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                            @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'WE' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'Breakfast')
                                <a data-meal-active="#viewMeal-{{$id}}"
                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                <br />
                                <div id="cu{{$id}}">
                                    @if($simpleCustomMeal->is_customized==1)
                                        <p>Customized</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </td>
                    @if($moSnaMeals>0)
                        <td id="WeMorSna">
                            @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                                @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'WE' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'MorningSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                    <br />
                                    <div id="cu{{$id}}">
                                        @if($simpleCustomMeal->is_customized==1)
                                            <p>Customized</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </td>
                    @endif
                    <td id="WeLun">
                        @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                            @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'WE' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'Lunch')
                                <a data-meal-active="#viewMeal-{{$id}}"
                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                <br />
                                <div id="cu{{$id}}">
                                    @if($simpleCustomMeal->is_customized==1)
                                        <p>Customized</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </td>
                    @if($aftSnaMeals>0)
                        <td id="WeAftSna">
                            @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                                @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'WE' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                    <br />
                                    <div id="cu{{$id}}">
                                        @if($simpleCustomMeal->is_customized==1)
                                            <p>Customized</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </td>
                    @endif
                    <td id="WeDin">
                        @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                            @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'WE' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'Dinner')
                                <a data-meal-active="#viewMeal-{{$id}}"
                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                <br />
                                <div id="cu{{$id}}">
                                    @if($simpleCustomMeal->is_customized==1)
                                        <p>Customized</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr id="Thursday">
                    <td class="light-green white-text" style="font-weight: bold;">Thursday</td>
                    <td id="ThBre">
                        @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                            @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'TH' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'Breakfast')
                                <a data-meal-active="#viewMeal-{{$id}}"
                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                <br />
                                <div id="cu{{$id}}">
                                    @if($simpleCustomMeal->is_customized==1)
                                        <p>Customized</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </td>
                    @if($moSnaMeals>0)
                        <td id="ThMorSna">
                            @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                                @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'TH' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'MorningSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                    <br />
                                    <div id="cu{{$id}}">
                                        @if($simpleCustomMeal->is_customized==1)
                                            <p>Customized</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </td>
                    @endif
                    <td id="ThLun">
                        @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                            @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'TH' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'Lunch')
                                <a data-meal-active="#viewMeal-{{$id}}"
                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                <br />
                                <div id="cu{{$id}}">
                                    @if($simpleCustomMeal->is_customized==1)
                                        <p>Customized</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </td>
                    @if($aftSnaMeals>0)
                        <td id="ThAftSna">
                            @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                                @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'TH' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                    <br />
                                    <div id="cu{{$id}}">
                                        @if($simpleCustomMeal->is_customized==1)
                                            <p>Customized</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </td>
                    @endif
                    <td id="ThDin">
                        @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                            @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'TH' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'Dinner')
                                <a data-meal-active="#viewMeal-{{$id}}"
                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                <br />
                                <div id="cu{{$id}}">
                                    @if($simpleCustomMeal->is_customized==1)
                                        <p>Customized</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </td>
                </tr>
                <tr id="Friday">
                    <td class="light-green white-text" style="font-weight: bold;">Friday</td>
                    <td id="FrBre">
                        @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                            @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'FR' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'Breakfast')
                                <a data-meal-active="#viewMeal-{{$id}}"
                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                <br />
                                <div id="cu{{$id}}">
                                    @if($simpleCustomMeal->is_customized==1)
                                        <p>Customized</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </td>
                    @if($moSnaMeals>0)
                        <td id="FrMorSna">
                            @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                                @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'FR' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'MorningSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                    <br />
                                    <div id="cu{{$id}}">
                                        @if($simpleCustomMeal->is_customized==1)
                                            <p>Customized</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </td>
                    @endif
                    <td id="FrLun">
                        @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                            @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'FR' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'Lunch')
                                <a data-meal-active="#viewMeal-{{$id}}"
                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                <br />
                                <div id="cu{{$id}}">
                                    @if($simpleCustomMeal->is_customized==1)
                                        <p>Customized</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </td>
                    @if($aftSnaMeals>0)
                        <td id="FrAftSna">
                            @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                                @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'FR' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                    <br />
                                    <div id="cu{{$id}}">
                                        @if($simpleCustomMeal->is_customized==1)
                                            <p>Customized</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </td>
                    @endif
                    <td id="FrDin">
                        @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                            @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'FR' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'Dinner')
                                <a data-meal-active="#viewMeal-{{$id}}"
                                   class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                <br />
                                <div id="cu{{$id}}">
                                    @if($simpleCustomMeal->is_customized==1)
                                        <p>Customized</p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                    </td>
                </tr>
                @if($saMeals!=0)
                    <tr id="Saturday">
                        <td class="light-green white-text" style="font-weight: bold;">Saturday</td>
                        <td id="SaBre">
                            @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                                @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'SA' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'Breakfast')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                    <br />
                                    <div id="cu{{$id}}">
                                        @if($simpleCustomMeal->is_customized==1)
                                            <p>Customized</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </td>
                        @if($moSnaMeals>0)
                            <td id="SaMorSna">
                                @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                                    @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'SA' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'MorningSnack')
                                        <a data-meal-active="#viewMeal-{{$id}}"
                                           class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                        <br />
                                        <div id="cu{{$id}}">
                                            @if($simpleCustomMeal->is_customized==1)
                                                <p>Customized</p>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </td>
                        @endif
                        <td id="SaLun">
                            @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                                @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'SA' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'Lunch')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                    <br />
                                    <div id="cu{{$id}}">
                                        @if($simpleCustomMeal->is_customized==1)
                                            <p>Customized</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </td>
                        @if($aftSnaMeals>0)
                            <td id="SaAftSna">
                                @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                                    @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'SA' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'AfternoonSnack')
                                        <a data-meal-active="#viewMeal-{{$id}}"
                                           class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                        <br />
                                        <div id="cu{{$id}}">
                                            @if($simpleCustomMeal->is_customized==1)
                                                <p>Customized</p>
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            </td>
                        @endif
                        <td id="SaDin">
                            @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                                @if($simpleCustomMeal->chef_customized_meal->mealplans->day == 'SA' && $simpleCustomMeal->chef_customized_meal->mealplans->meal_type == 'Dinner')
                                    <a data-meal-active="#viewMeal-{{$id}}"
                                       class="waves-effect waves-light data-trigger" data-cId="cu{{$id}}">{{$simpleCustomMeal->chef_customized_meal->description}}</a>
                                    <br />
                                    <div id="cu{{$id}}">
                                        @if($simpleCustomMeal->is_customized==1)
                                            <p>Customized</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col s12 m8 plSlCstMlBtn">
                <div style="margin-bottom: 20px;">
                    <button type="button" data-target="orderReview" class="modal-trigger btn">Order</button>
                </div>
            </div>
            <div class="col s12 m4 plSlCstMlInfCnt">
                <div class="card-panel plSlMlInfDef plSlCstMlInf">
                    <span>Please click on a Meal to customize it!</span>
                </div>
                @foreach($simpleCustomMeals as $id =>$simpleCustomMeal)
                    <div id="viewMeal-{{$id}}" class="plSlMlInf card-panel">
                        <ul class="collection plSlMlInfCtnt">
                            <li class="collection-item light-green lighten-1 white-text">
                                <span class="collection-header">{{$simpleCustomMeal->chef_customized_meal->description}}</span>
                            </li>
                            @if($mealPhotos->count())
                                @foreach($mealPhotos as $mealPhoto)
                                    @if($mealPhoto->id==$simpleCustomMeal->chef_customized_meal->mealplans->id)
                                        <li class="collection-item" style="border-bottom: none;">
                                            <img style="width: 200px; height: auto;" src="/img/meals/{{ $mealPhoto->image }}">
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                            <li class="collection-item">
                                <span>Day: </span>
                                @if($simpleCustomMeal->chef_customized_meal->mealplans->day=='MO')
                                    <span>Monday</span>
                                @elseif($simpleCustomMeal->chef_customized_meal->mealplans->day=='TU')
                                    <span>Tuesday</span>
                                @elseif($simpleCustomMeal->chef_customized_meal->mealplans->day=='WE')
                                    <span>Wednesday</span>
                                @elseif($simpleCustomMeal->chef_customized_meal->mealplans->day=='TH')
                                    <span>Thursday</span>
                                @elseif($simpleCustomMeal->chef_customized_meal->mealplans->day=='FR')
                                    <span>Friday</span>
                                @elseif($simpleCustomMeal->chef_customized_meal->mealplans->day=='SA')
                                    <span>Saturday</span>
                                @endif
                            </li>
                            <li class="collection-item">
                                <span>Meal: </span>
                                <span>
                                @if($simpleCustomMeal->chef_customized_meal->mealplans->meal_type=='MorningSnack')
                                        Morning Snack
                                    @elseif($simpleCustomMeal->chef_customized_meal->mealplans->meal_type=='AfternoonSnack')
                                        Afternoon Snack
                                    @else
                                        {{$simpleCustomMeal->chef_customized_meal->mealplans->meal_type}}
                                    @endif
                            </span>
                            </li>
                            <li class="collection-item">
                                <span>Main Ingredient: </span><span>{{ucwords($simpleCustomMeal->chef_customized_meal->main_ingredient)}}</span>
                            </li>
                            <li class="collection-item">
                                <span>Calories: </span><span>{{round($simpleCustomMeal->chef_customized_meal->calories,2)}}</span>
                            </li>
                        </ul>
                        <div class="editButton">
                            <span>
                                <button data-target="editMeal-{{$id}}" data-id="{{$simpleCustomMeal->chef_customized_meal->id}}" class="mealLink btn waves-effect waves-light modal-trigger">Edit</button>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @foreach($simpleCustomMeals as $id=>$simpleCustomMeal)
        <div id="editMeal-{{$id}}" class="editFoodieCustModal modal">
            <nav class="light-green lighten-1 white-text">
                <div class="left col s12 m5 l5">
                    <ul>
                        <li>
                            <span class="edtMlTtl" style="font-size: 20px; margin-left: 20px;">Customize {{$simpleCustomMeal->chef_customized_meal->description}}</span>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="modal-content">
                <div>
                    <ul class="collection">
                        <li class="collection-item light-green white-text">
                            {{--<span class="collection-header">Meal Stats</span>--}}
                            <span class="collection-header">Meal Calories</span>
                        </li>
                        <li class="collection-item">Calories: {{round($simpleCustomMeal->chef_customized_meal->calories,2)}}</li>
                        {{--<li class="collection-item">Carbohydrates: {{round($simpleCustomMeal->chef_customized_meal->carbohydrates,2)}}g</li>--}}
                        {{--<li class="collection-item">Protein: {{round($simpleCustomMeal->chef_customized_meal->protein,2)}}g</li>--}}
                        {{--<li class="collection-item">Fat: {{round($simpleCustomMeal->chef_customized_meal->fat,2)}}g</li>--}}
                    </ul>
                </div>
                <div>
                    <table style="table-layout: fixed;">
                        <thead>
                        <tr>
                            <th>Ingredient</th>
                            <th>Grams</th>
                        </tr>
                        </thead>
                        <tbody id="h{{$simpleCustomMeal->chef_customized_meal->id}}">
                        </tbody>
                    </table>
                    <form id="editMeal{{$id}}"
                          {{--action="{{route('foodie.meal.custom',$cust->id)}}"--}}
                          method="post" autocomplete="off" class="editMeal">
                        {{csrf_field()}}
                        <div>
                            <span style="font-size: 30px;">Meal Customization</span>
                        </div>
                        <div id="m{{$simpleCustomMeal->chef_customized_meal->id}}">
                            <div class="meatSection">
                            </div>
                            <div class="produceSection">
                            </div>
                            <div class="dairySection">
                            </div>
                        </div>
                        <button class="btn waves-effect waves-light">Customize</button>
                    </form>

                </div>



            </div>
        </div>
    @endforeach
@endsection
        {{--<div class="row">--}}
            {{--<div class="col s12">--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<form action="{{route('foodie.simple.custom', $plan->id)}}" method="post">--}}
            {{--{{ csrf_field() }}--}}
            {{--<div class="row">--}}
                {{--<div class="col s12 m6">--}}
                    {{--<div class="secTtl">--}}
                        {{--<span>Meat and Poultry</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="pork" value="0"/>--}}
                        {{--<input type="checkbox" id="pork" name="pork" value="1"/>--}}
                        {{--<label for="pork">NO Pork</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="beef" value="0"/>--}}
                        {{--<input type="checkbox" id="beef" name="beef" value="1"/>--}}
                        {{--<label for="beef">NO Beef</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="chicken" value="0"/>--}}
                        {{--<input type="checkbox" id="chicken" name="chicken" value="1"/>--}}
                        {{--<label for="chicken">NO Chicken</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="seafood" value="0"/>--}}
                        {{--<input type="checkbox" id="seafood" name="seafood" value="1"/>--}}
                        {{--<label for="seafood">NO Seafood</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="eggs" value="0"/>--}}
                        {{--<input type="checkbox" id="eggs" name="eggs" value="1"/>--}}
                        {{--<label for="eggs">NO Eggs</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="dairy" value="0"/>--}}
                        {{--<input type="checkbox" id="dairy" name="dairy" value="1"/>--}}
                        {{--<label for="dairy">NO Dairy</label>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col s12 m6">--}}
                    {{--<div class="secTtl">--}}
                        {{--<span>Taste</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="dairy" value="0"/>--}}
                        {{--<input type="checkbox" id="sweet" name="sweet" value="1"/>--}}
                        {{--<label for="sweet">NO Sweet Foods</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="salty" value="0"/>--}}
                        {{--<input type="checkbox" id="salty" name="salty" value="1"/>--}}
                        {{--<label for="salty">NO Salty Foods</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="spicy" value="0"/>--}}
                        {{--<input type="checkbox" id="spicy" name="spicy" value="1"/>--}}
                        {{--<label for="spicy">NO Spicy Foods</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="bitter" value="0"/>--}}
                        {{--<input type="checkbox" id="bitter" name="bitter" value="1"/>--}}
                        {{--<label for="bitter">NO Bitter Foods</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="savory" value="0"/>--}}
                        {{--<input type="checkbox" id="savory" name="savory" value="1"/>--}}
                        {{--<label for="savory">NO Savory Foods</label>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
                {{--<div class="col s12 m6">--}}
                    {{--<div class="secTtl">--}}
                        {{--<span>Produce</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="fruit" value="0"/>--}}
                        {{--<input type="checkbox" id="fruit" name="fruit" value="1">--}}
                        {{--<label for="fruit">NO Fruits</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="citrus" value="0"/>--}}
                        {{--<input type="checkbox" id="citrus" name="citrus" value="1">--}}
                        {{--<label for="citrus">NO Citrus Fruits</label>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col s12 m6">--}}
                    {{--<div class="secTtl">--}}
                        {{--<span>Cooking Method</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="fried" value="0"/>--}}
                        {{--<input type="checkbox" id="fried" name="fried" value="1">--}}
                        {{--<label for="fried">NO Fried Foods</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="grilled" value="0"/>--}}
                        {{--<input type="checkbox" id="grilled" name="grilled" value="1">--}}
                        {{--<label for="grilled">NO Grilled Foods</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="steamed" value="0"/>--}}
                        {{--<input type="checkbox" id="steamed" name="steamed" value="1">--}}
                        {{--<label for="steamed">NO Steamed Foods</label>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
                {{--<div class="col s12 m6">--}}
                    {{--<div class="secTtl">--}}
                        {{--<span>Dry Goods/Condiments</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="cumin" value="0"/>--}}
                        {{--<input type="checkbox" id="cumin" name="cumin" value="1">--}}
                        {{--<label for="cumin">NO Cumin</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="curry" value="0"/>--}}
                        {{--<input type="checkbox" id="curry" name="curry" value="1">--}}
                        {{--<label for="curry">NO Curry</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="preservatives" value="0"/>--}}
                        {{--<input type="checkbox" id="preservatives" name="preservatives" value="1">--}}
                        {{--<label for="preservatives">NO Preservatives</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="salt" value="0"/>--}}
                        {{--<input type="checkbox" id="salt" name="salt" value="1">--}}
                        {{--<label for="salt">NO Salt</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="sweeteners" value="0"/>--}}
                        {{--<input type="checkbox" id="sweeteners" name="sweeteners" value="1">--}}
                        {{--<label for="sweeteners">NO Sweeteners</label>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="col s12 m6">--}}
                    {{--<div class="secTtl">--}}
                        {{--<span>Fats and Oils</span>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="coconutOil" value="0"/>--}}
                        {{--<input type="checkbox" id="coconutOil" name="coconutOil" value="1">--}}
                        {{--<label for="coconutOil">NO Coconut Oil</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="oliveOil" value="0"/>--}}
                        {{--<input type="checkbox" id="oliveOil" name="oliveOil" value="1">--}}
                        {{--<label for="oliveOil">NO Olive Oil</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="butter" value="0"/>--}}
                        {{--<input type="checkbox" id="butter" name="butter" value="1">--}}
                        {{--<label for="butter">NO Butter</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="meatFat" value="0"/>--}}
                        {{--<input type="checkbox" id="meatFat" name="meatFat" value="1">--}}
                        {{--<label for="meatFat">NO Visible Meat Fat</label>--}}
                    {{--</div>--}}
                    {{--<div>--}}
                        {{--<input type="hidden" name="baconFat" value="0"/>--}}
                        {{--<input type="checkbox" id="baconFat" name="baconFat" value="1">--}}
                        {{--<label for="baconFat">NO Bacon Fat</label>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
                {{--<button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>--}}
            {{--</div>--}}
        {{--</form>--}}
