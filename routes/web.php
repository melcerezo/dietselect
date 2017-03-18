<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'PagesController@welcome')->name('welcome');
Route::get('meal/planner', function (){
    $plan = \App\Plan::where('chef_id',1)->first();
    $mealPlans=$plan->mealplans()->get();
    return view('chef.meal_planner', compact('mealPlans'));
});

Route::get('compute', function (\Illuminate\Http\Request $request){
    $grams = $request['grams'] * 0.01;
    dd($grams);
});

Route::group(['prefix' => 'foodie'], function () {
    Route::get('/', 'Foodie\FoodieController@index')->name('foodie');
    Route::get('dashboard', 'Foodie\FoodieController@index')->name('foodie.dashboard');

    Route::get('login', 'Foodie\Auth\LoginController@showLoginForm')->name('foodie.login.show');
    Route::post('login', 'Foodie\Auth\LoginController@login')->name('foodie.login');
    Route::post('logout', 'Foodie\Auth\LoginController@logout')->name('foodie.logout');

    Route::post('password/email', 'Foodie\Auth\ForgotPasswordController@sendResetLinkEmail')->name('foodie.reset.send');
    Route::get('password/reset', 'Foodie\Auth\ForgotPasswordController@showLinkRequestForm')->name('foodie.reset.show');

    Route::post('password/reset', 'Foodie\Auth\ResetPasswordController@reset')->name('foodie.reset');
    Route::get('password/reset/{token}', 'Foodie\Auth\ResetPasswordController@showResetForm')->name('foodie.reset.password');

    Route::get('profile', 'Foodie\FoodieController@profile')->name('foodie.profile');
    Route::post('profile/save', 'Foodie\FoodieController@saveProfileBasic')->name('foodie.profile.basic');
    Route::post('profile/address', 'Foodie\FoodieController@saveProfileAddress')->name('foodie.profile.address');
    Route::post('profile/address/update', 'Foodie\FoodieController@updateProfileAddress')->name('foodie.address.update');
    Route::post('profile/address/delete', 'Foodie\FoodieController@deleteProfileAddress')->name('foodie.address.delete');
    Route::post('profile/allergies', 'Foodie\FoodieController@saveProfileAllergies')->name('foodie.profile.allergies');
    Route::post('profile/preferences', 'Foodie\FoodieController@saveProfilePreferences')->name('foodie.profile.preferences');


    Route::get('register', 'Foodie\Auth\RegisterController@showRegistrationForm')->name('foodie.register.show');
    Route::post('register', 'Foodie\Auth\RegisterController@register')->name('foodie.register');

    Route::post('verify', 'Foodie\Auth\VerificationController@verifySms')->name('foodie.verify');
    Route::post('verify/send', 'Foodie\Auth\VerificationController@sendNewVerificationCode')->name('foodie.verify.send');

    Route::get('chefs', 'Foodie\FoodieMealPlanController@viewChefs')->name('foodie.chef.show');
    Route::get('chefs/plan/{id}', 'Foodie\FoodieMealPlanController@viewChefsPlans')->name('foodie.chef.plan');
    Route::get('chefs/meal/{plan}','Foodie\FoodieMealPlanController@viewChefsMeals')->name('foodie.chef.meal');
    Route::post('chefs/customize/{meal}','Foodie\FoodieMealPlanController@customizeChefsMeals')->name('foodie.meal.custom');
    Route::get('{type}/getIngredJson','Foodie\FoodieMealPlanController@getIngredJson')->name('foodie.meal.autocomplete');

    Route::get('order/plan/{plan}', 'Foodie\FoodieOrderPlanController@index')->name('foodie.order.review');
    Route::post('order/plan/{plan}', 'Foodie\FoodieOrderPlanController@store')->name('foodie.order.create');

    // Route after ordering
    Route::get('get/order/{order}', 'Foodie\FoodieOrderPlanController@show')->name('order.show');

});

Route::group(['prefix' => 'chef'], function () {
    Route::get('/', 'Chef\ChefController@index')->name('chef');
    Route::get('dashboard', 'Chef\ChefController@index')->name('chef.dashboard');

    Route::get('login', 'Chef\Auth\LoginController@showLoginForm')->name('chef.login.show');
    Route::post('login', 'Chef\Auth\LoginController@login')->name('chef.login');
    Route::post('logout', 'Chef\Auth\LoginController@logout')->name('chef.logout');

    Route::post('password/email', 'Chef\Auth\ForgotPasswordController@sendResetLinkEmail')->name('chef.reset.send');
    Route::get('password/reset', 'Chef\Auth\ForgotPasswordController@showLinkRequestForm')->name('chef.reset.show');

    Route::post('password/reset', 'Chef\Auth\ResetPasswordController@reset')->name('chef.reset');
    Route::get('password/reset/{token}', 'Chef\Auth\ResetPasswordController@showResetForm')->name('chef.reset.password');

    Route::get('register', 'Chef\Auth\RegisterController@showRegistrationForm')->name('chef.register.show');
    Route::post('register', 'Chef\Auth\RegisterController@register')->name('chef.register');

    Route::get('verify', 'Chef\Auth\VerificationController@verifyEmail')->name('chef.verify');
    Route::get('verify/{token}', 'Chef\Auth\VerificationController@verifyEmail')->name('chef.verify.email');
    Route::post('verify/email', 'Chef\Auth\VerificationController@sendNewVerificationToken')->name('chef.verify.email.send');

    Route::post('verify/sms', 'Chef\Auth\VerificationController@verifySms')->name('chef.verify.sms');
    Route::post('verify/sms/send', 'Chef\Auth\VerificationController@sendNewVerificationCode')->name('chef.verify.sms.send');

    Route::get('plan','Chef\MealPlanController@getMealPlanPage')->name('chef.plan');
    Route::post('plan/create','Chef\MealPlanController@createPlan')->name('chef.plan.create');
    Route::get('plan/{plan}/mealsTable','Chef\MealPlanController@prepareMealsPage')->name('chef.plan.table');
    Route::get('{type}/getIngredJson','Chef\MealPlanController@getIngredJson')->name('chef.plan.autocomplete');
    Route::get('{meal}/getIngredCount','Chef\MealPlanController@getIngredCount')->name('chef.plan.number');
    Route::post('plan/{plan}/createMeal', 'Chef\MealPlanController@setMeal')->name('chef.meal.create');
    Route::post('plan/update/{meal}', 'Chef\MealPlanController@updateMeal')->name('chef.meal.update');
    Route::post('plan/delete/{meal}', 'Chef\MealPlanController@deleteMeal')->name('chef.meal.delete');


});
