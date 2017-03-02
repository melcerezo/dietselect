@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="/css/chef/meal_planner.css">
@endsection

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
                                <td><a href="#editMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                </td>
                        @endif
                    @endforeach
            </tr>
            <tr id="Tuesday">
                <th>Tuesday</th>
                @foreach($mealPlans as $id=>$mealPlan)
                    @if($mealPlan->day == 'TU')
                            <td><a href="#editMeal-{{$id}}"
                                   class=" waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>

                    @endif
                @endforeach
            </tr>
            <tr id="Wednesday">
                <th>Wednesday</th>
                @foreach($mealPlans as $id=>$mealPlan)
                    @if($mealPlan->day == 'WE')
                            <td><a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                    @endif
                @endforeach
            </tr>
            <tr id="Thursday">
                <th>Thursday</th>
                @foreach($mealPlans as $id=>$mealPlan)
                    @if($mealPlan->day == 'TH')
                            <td><a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>
                    @endif
                @endforeach
            </tr>
            <tr id="Friday">
                <th>Friday</th>
                @foreach($mealPlans as $id=>$mealPlan)
                    @if($mealPlan->day == 'FR')
                            <td><a href="#editMeal-{{$id}}"
                                   class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                            </td>

                    @endif
                @endforeach
            </tr>
                    <tr id="Saturday">
                        <th>Saturday</th>
                        @foreach($mealPlans as $id=>$mealPlan)
                            @if($mealPlan->day == 'SA')
                                <td><a href="#editMeal-{{$id}}"
                                       class="waves-effect waves-light modal-trigger">{{$mealPlan->meal->description}}</a><br>
                                </td>
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
                            {{$mealPlans[$i]->meal->id}}
                        </div>
                        <p><label for="description">Description</label></p>
                        <input type="text" name="description" class="form-control" value="{{$mealPlans[$i]->meal->description}}">

                        <p><label for="description">Main Ingredient</label></p>
                        <input type="text" name="main_ingredient" class="form-control" value="{{$mealPlans[$i]->meal->main_ingredient}}">

                        <div class="ingredLabel"><label for="ingredient">Ingredients</label></div>
                        <div class="gramLabel"><label for="grams">Grams</label></div>
                        @for($c=0;$c<$ingredientCount;$c++)
                            @if($ingredientsMeal[$c]->meal_id==$mealPlans[$i]->meal->id)
                                <div class="ingredSelect">
                                    <select name="ingredient">
                                        <option value="" disabled selected>{{$ingredientsMeal[$c]->description}}</option>
                                        @foreach($ingredients as $ingredient)
                                            <option value="{{$ingredient->id}}">{{ $ingredient->description }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="ingredGramsContainer">
                                    <input type="number" name="grams" id="grams" class="form-control" value="{{$ingredientsMeal[$c]->grams}}">
                                </div>
                            @endif
                        @endfor
                        {{--<label for="grams">Grams:</label>--}}

                    </div>
                    <div class="modal-footer">
                        <button type="submit">Update</button>
                        <button>Delete</button>
                        {{--<a href="#!" class="modal-action modal-close waves-effect waves-green -flat">Agree</a>--}}
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

                <div id="ingredientContainer">
                    <a id="ingredAdd" href="#"><span class="addIngred">+Add Ingredients Here</span></a>
                </div>
                <script>
                    var count=0;
                    $(function(){

                        $('#ingredAdd').click(function () {
                            count+=1;
                            $('#ingredientContainer').prepend('<div class="ingredSelect"><select id="ingredient'+count+'" name="ingredients[]">' +
                                    '<option value="" disabled selected>Choose Ingredient</option>'+
                                    ' @foreach($ingredients as $key=>$ingredient)'+
                                    '<option value="{{$ingredient->id}}">{{ $ingredient->description }}</option>'
                                    +'@endforeach'+
                                    '</select></div>'+'<div class="ingredGrams"><input type="number" name="grams[]" id="grams'+(count)+'" class="browser-default"></div>');

                            $('select').material_select();
                            });
                        });
                </script>
                <input type="submit" value="Submit" class="btn btn-primary">
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col s12">
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">textsms</i>
                    <input type="text" id="autocomplete-input" class="autocomplete">
                    <label for="autocomplete-input">Autocomplete</label>
                </div>
            </div>
        </div>
    </div>
        <script>

        $(function () {

            $.fn.autocomplete = function (options) {
                // Defaults
                var defaults = {
                    data: {}
                };

                options = $.extend(defaults, options);

                return this.each(function() {
                    var $input = $(this);
                    var data = options.data,
                            $inputDiv = $input.closest('.input-field'); // Div to append on

                    // Check if data isn't empty
                    if (!$.isEmptyObject(data)) {
                        // Create autocomplete element
                        var $autocomplete = $('<ul class="autocomplete-content dropdown-content"></ul>');

                        // Append autocomplete element
                        if ($inputDiv.length) {
                            $inputDiv.append($autocomplete); // Set ul in body
                        } else {
                            $input.after($autocomplete);
                        }

                        var highlight = function(string, $el) {
                            var img = $el.find('img');
                            var matchStart = $el.text().toLowerCase().indexOf("" + string.toLowerCase() + ""),
                                    matchEnd = matchStart + string.length - 1,
                                    beforeMatch = $el.text().slice(0, matchStart),
                                    matchText = $el.text().slice(matchStart, matchEnd + 1),
                                    afterMatch = $el.text().slice(matchEnd + 1);
                            $el.html("<span>" + beforeMatch + "<span class='highlight'>" + matchText + "</span>" + afterMatch + "</span>");
                            if (img.length) {
                                $el.prepend(img);
                            }
                        };

                        // Perform search
                        $input.on('keyup', function (e) {
                            // Capture Enter
                            if (e.which === 13) {
                                $autocomplete.find('li').first().click();
                                return;
                            }

                            var val = $input.val().toLowerCase();
                            $autocomplete.empty();

                            // Check if the input isn't empty
                            if (val !== '') {
                                for(var key in data) {
                                    if (data.hasOwnProperty(key) &&
                                            key.toLowerCase().indexOf(val) !== -1 &&
                                            key.toLowerCase() !== val) {
                                        var autocompleteOption = $('<li></li>');
                                        if(!!data[key]) {
                                            autocompleteOption.append('<img src="'+ data[key] +'" class="right circle"><span>'+ key +'</span>');
                                        } else {
                                            autocompleteOption.append('<span>'+ key +'</span>');
                                        }
                                        $autocomplete.append(autocompleteOption);

                                        highlight(val, autocompleteOption);
                                    }
                                }
                            }
                        });

                        // Set input value
                        $autocomplete.on('click', 'li', function () {
                            $input.val($(this).text().trim());
                            $autocomplete.empty();
                        });
                    }
                });
            };

            $('input.autocomplete').autocomplete({
                data: {
                    "Apple": null,
                    "Microsoft": null,
                    "Google": 'http://placehold.it/250x250',
                    "suck": null
                },
                limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
            });

//            $.ajax({
//                url:'/chef/getIngredJson',
//                success: function(response){
//                    console.log(response);
//                    $(function(){
//                        $('input.autocomplete').autocomplete(response);
//                    })
//                }
//            });

        });
    </script>
@endsection

