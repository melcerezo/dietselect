@extends('layouts.app')
@section('head')
    <style>
        .container{
            width:85%;
        }
        #testCreateModal.modal{
            width: 50% !important;
            max-height: 100% !important;
            border-radius: 5px;
        }
        .modal-header{
            width:100%;
            height:100%;
            min-height:80px;
        }
    </style>
    <script>
        $(document).ready(function () {
            $('#addMealButton').on('click',function () {
                $('#description').val($('#mealName').val());
                console.log($('#mealName').val());
            });
        });
    </script>
@endsection
@section('content')
    <nav>
        <div class="nav-wrapper light-green">
            <a href="#" class="brand-logo">Diet Select</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li>
                    <a>
                        <span class="valign-wrapper" style="position: relative;">
                            <i class="material-icons" style="display: inline">email</i>
                            <span style="margin-left: 2px;">
                                Messages
                                <span class="new badge red">4</span>
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a>
                        <span class="valign-wrapper">
                            <i class="material-icons" style="display: inline">announcement</i>
                            <span style="margin-left: 2px;">
                                Notifications
                                <span class="new badge red">2</span>
                            </span>
                        </span>
                    </a>
                </li>
                <li>
                    <a>
                        <img class="circle" src="/img/user.jpg" style="width: 40px; height: 40px; position: relative;">
                        <span style="margin-left: 2px;">Profile</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col s12 card-panel light-green" style="margin-top: 1rem; padding:5px 10px; position: relative;">
                <div class="col s12 m6 l4">
                    <span class="white-text small">New Meal Name</span>
                    <input id="mealName" type="text" style="border-bottom: 1px solid #ffffff">
                    <button id="addMealButton" data-target="testCreateModal" class="modal-trigger btn orange waves-effect waves-light" style="position: absolute; top:37px; left:415px;">Add Meal</button>
                </div>
                <div class="col s12 m6 l6 white-text right right-align" style="margin-top:24px;">
                    <h5>Plan 1</h5>
                </div>
                <div style="clear: both;"></div>
            </div>

        </div>
        <div class="row">
            <div class="card-panel" style="padding: 0;">
                <table class="striped centered">
                    <thead class="light-green white-text" style="border: none;">
                        <th></th>
                        <th>Breakfast</th>
                        <th>Morning Snack</th>
                        <th>Lunch</th>
                        <th>Afternoon Snack</th>
                        <th>Dinner</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="light-green white-text" style="font-weight: bold;">Monday</td>
                            <td>Meal 1</td>
                            <td>Meal 2</td>
                            <td>Meal 3</td>
                            <td>Meal 4</td>
                            <td>Meal 5</td>
                        </tr>
                        <tr>
                            <td class="light-green white-text" style="font-weight: bold;">Tuesday</td>
                            <td>Meal 6</td>
                            <td>Meal 7</td>
                            <td>Meal 8</td>
                            <td>Meal 9</td>
                            <td>Meal 10</td>
                        </tr>
                        <tr>
                            <td class="light-green white-text" style="font-weight: bold;">Wednesday</td>
                            <td>Meal 11</td>
                            <td>Meal 12</td>
                            <td>Meal 13</td>
                            <td>Meal 14</td>
                            <td>Meal 15</td>
                        </tr>
                        <tr>
                            <td class="light-green white-text" style="font-weight: bold;">Thursday</td>
                            <td>Meal 16</td>
                            <td>Meal 17</td>
                            <td>Meal 18</td>
                            <td>Meal 19</td>
                            <td>Meal 20</td>
                        </tr>
                        <tr>
                            <td class="light-green white-text" style="font-weight: bold;">Friday</td>
                            <td>Meal 21</td>
                            <td>Meal 22</td>
                            <td>Meal 23</td>
                            <td>Meal 24</td>
                            <td>Meal 25</td>
                        </tr>
                        <tr>
                            <td class="light-green white-text" style="font-weight: bold;">Saturday</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="testCreateModal" class="modal" >
        <div class="modal-header light-green valign-wrapper">
            <span class="white-text" style="font-size: 40px; margin-left: 15px;">Create Meal</span>
        </div>
            <form id="createMealForm" action="" method="post" autocomplete="off">
                {{csrf_field()}}
                <div class="modal-content" style="position: relative;">
                <label for="description">Meal Name:</label>
                <input type="text" name="description" id="description" class="form-control">
                <div id="errorDescription"></div>
                <select id="day" name="day" class="selectRequired">
                    <option selected value="">Choose day</option>
                    <option value="MO">MO</option>
                    <option value="TU">TU</option>
                    <option value="WE">WE</option>
                    <option value="TH">TH</option>
                    <option value="FR">FR</option>
                    <option value="SA">SA</option>
                </select>
                <div id="errorDay"></div>
                <select id="meal_type" name="meal_type" class="selectRequired">
                    <option selected value="">Choose Meal Type</option>
                    <option value="Breakfast">Breakfast</option>
                    <option value="MorningSnack">Morning Snack</option>
                    <option value="Lunch">Lunch</option>
                    <option value="AfternoonSnack">Afternoon Snack</option>
                    <option value="Dinner">Dinner</option>
                </select>
                <div id="errorMealType"></div>
                <div id="tdTaken"></div>
                <select id="main_ingredient" name="main_ingredient" class="selectRequired">
                    <option selected value="">Choose Main Ingredient</option>
                    <option value="Chicken">Chicken</option>
                    <option value="Beef">Beef</option>
                    <option value="Pork">Pork</option>
                    <option value="Vegetables">Vegetables</option>
                    <option value="Carbohydrates">Carbohydrates</option>
                    <option value="fruits">Fruits</option>
                </select>
                <div id="errorMainIngredient"></div>
                <div id="ingredientContainer" >
                    <div id="addMoreIngred"><a id="ingredAdd" class="orange-text" href="#!"><span class="addIngred">+Add Ingredients Here</span></a></div>
                    <div class="spacer" style="clear: both;"></div>
                </div>
                <div id="ingredError"></div>
                <div id="formError"></div>
                </div>
                <div class="modal-footer light-green" ><input type="submit" value="Submit" class="btn btn-primary orange"></div>
            </form>
    </div>

@endsection