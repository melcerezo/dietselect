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

Route::get('/testDash', 'DashController@loadInfo')->name('testDash');

Route::get('/testMessage', 'DashController@loadMessage')->name('testMessage');

Route::get('/testMealPlanner', 'DashController@loadMealPlanner')->name('testMealPlanner');

Route::get('/', 'PagesController@welcome')->name('welcome');

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
    Route::post('profile/address/update/{id}', 'Foodie\FoodieController@updateProfileAddress')->name('foodie.address.update');
    Route::post('profile/address/delete/{id}', 'Foodie\FoodieController@deleteProfileAddress')->name('foodie.address.delete');
    Route::post('profile/allergies', 'Foodie\FoodieController@saveProfileAllergies')->name('foodie.profile.allergies');
    Route::post('profile/preferences', 'Foodie\FoodieController@saveProfilePreferences')->name('foodie.profile.preferences');
    Route::get('/countPreferences', 'Foodie\FoodieController@countPreferences');


    Route::get('register', 'Foodie\Auth\RegisterController@showRegistrationForm')->name('foodie.register.show');
    Route::post('register', 'Foodie\Auth\RegisterController@register')->name('foodie.register');

    Route::post('verify', 'Foodie\Auth\VerificationController@verifySms')->name('foodie.verify');
    Route::post('verify/send', 'Foodie\Auth\VerificationController@sendNewVerificationCode')->name('foodie.verify.send');

    Route::get('chefs', 'Foodie\FoodieMealPlanController@viewChefs')->name('foodie.chef.show');
    Route::get('chefs/plan/{id}', 'Foodie\FoodieMealPlanController@viewChefsPlans')->name('foodie.chef.plan');
    Route::get('chefs/meal/{plan}', 'Foodie\FoodieMealPlanController@viewChefsMeals')->name('foodie.chef.meal');
    Route::get('chef/meal/{plan}/{id}', 'Foodie\FoodieMealPlanController@viewMeal')->name('foodie.meal');
    Route::post('chefs/customize/{customize}', 'Foodie\FoodieMealPlanController@customizeChefsMeals')->name('foodie.meal.custom');
    Route::get('{type}/getIngredJson', 'Foodie\FoodieMealPlanController@getIngredJson')->name('foodie.meal.autocomplete');
    Route::get('{type}/validateIngredJson', 'Foodie\FoodieMealPlanController@validateIngredJson')->name('foodie.meal.validate');

    Route::get('order/plan/{plan}', 'Foodie\FoodieOrderPlanController@index')->name('foodie.order.review');
    Route::post('order/plan/{plan}', 'Foodie\FoodieOrderPlanController@store')->name('foodie.order.create');
    Route::post('order/custPlan/{plan}/{id}', 'Foodie\FoodieOrderPlanController@custStore')->name('foodie.custOrder.create');
    Route::get('order/view', 'Foodie\FoodieOrderPlanController@getAllOrdersView')->name('foodie.order.view');
    Route::get('order/viewSingle/{order}', 'Foodie\FoodieOrderPlanController@getOneOrderDetails')->name('foodie.order.single');

    // Route after ordering
    Route::get('get/order/{order}', 'Foodie\FoodieOrderPlanController@show')->name('order.show');

    // Get MESSAGING view
    Route::get('message/index', 'Foodie\FoodieMessageController@index')->name('foodie.message.index');
    Route::post('message/send', 'Foodie\FoodieMessageController@send')->name('foodie.message.send');
    Route::post('message/reply/{id}', 'Foodie\FoodieMessageController@reply')->name('foodie.message.reply');
    Route::post('message/delete/{message}', 'Foodie\FoodieMessageController@delete')->name('foodie.message.delete');


    Route::get('paywithpaypal/{order}', array('as' => 'addmoney.paywithpaypal', 'uses' => 'AddMoneyController@payWithPaypal',));
    Route::post('paypal/{order}', array('as' => 'addmoney.paypal', 'uses' => 'AddMoneyController@postPaymentWithpaypal',));
    Route::get('paypal/{order}', array('as' => 'payment.status', 'uses' => 'AddMoneyController@getPaymentStatus',));

    // Bank Deposit
    Route::post('bank/deposit/order/{order}', 'DepositController@deposit')->name('deposit.order');

    // Rating
    Route::get('foodie/rating', 'RatingsController@getRatingPage')->name('chef.rating');
    Route::post('rate/chef/{order}', 'RatingsController@rateChef')->name('rate.chef');
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


    Route::get('profile', 'Chef\ChefController@profile')->name('chef.profile');
    Route::post('profile/save', 'Chef\ChefController@saveProfileBasic')->name('chef.profile.basic');

    Route::get('verify', 'Chef\Auth\VerificationController@verifyEmail')->name('chef.verify');
    Route::get('verify/{token}', 'Chef\Auth\VerificationController@verifyEmail')->name('chef.verify.email');
    Route::post('verify/email', 'Chef\Auth\VerificationController@sendNewVerificationToken')->name('chef.verify.email.send');

    Route::post('verify/sms', 'Chef\Auth\VerificationController@verifySms')->name('chef.verify.sms');
    Route::post('verify/sms/send', 'Chef\Auth\VerificationController@sendNewVerificationCode')->name('chef.verify.sms.send');

    Route::get('plan', 'Chef\MealPlanController@getMealPlanPage')->name('chef.plan');
    Route::post('plan/create', 'Chef\MealPlanController@createPlan')->name('chef.plan.create');
    Route::post('plan/delete/{plan}', 'Chef\MealPlanController@deletePlan')->name('chef.plan.delete');
    Route::get('plan/{plan}/mealsTable', 'Chef\MealPlanController@prepareMealsPage')->name('chef.plan.table');
    Route::get('{type}/getIngredJson', 'Chef\MealPlanController@getIngredJson')->name('chef.plan.autocomplete');
    Route::get('{type}/validateIngredJson', 'Chef\MealPlanController@validateIngredJson')->name('chef.plan.validate');
    Route::post('plan/{plan}/createMeal', 'Chef\MealPlanController@setMeal')->name('chef.meal.create');
    Route::post('plan/update/{meal}', 'Chef\MealPlanController@updateMeal')->name('chef.meal.update');
    Route::post('plan/deleteMeal/{meal}', 'Chef\MealPlanController@deleteMeal')->name('chef.meal.delete');

    // Get MESSAGING view
    Route::get('message/index', 'Chef\ChefMessageController@index')->name('chef.message.index');
    Route::post('message/send', 'Chef\ChefMessageController@send')->name('chef.message.send');
    Route::post('message/reply/{id}', 'Chef\ChefMessageController@reply')->name('chef.message.reply');
    Route::post('message/delete/{message}', 'Chef\ChefMessageController@delete')->name('chef.message.delete');
    Route::post('message/readMessage/{message}', 'Chef\ChefMessageController@readMessage')->name('chef.message.read');

    //ordering
    Route::get('order/view', 'Chef\ChefOrderController@getAllOrdersView')->name('chef.order.view');
    Route::get('order/viewSingle/{order}', 'Chef\ChefOrderController@getOneOrderDetails')->name('chef.order.single');

    // Chef Rating
    Route::get('chef/rating', 'ChefRatingsController@viewRatings')->name('ratings');
});
