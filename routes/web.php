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

Route::get('/faq', 'PagesController@faq')->name('faq');

Route::get('/about', 'PagesController@about')->name('about');

Route::get('/disclaimer', 'PagesController@disclaimer')->name('disclaimer');

Route::group(['prefix' => 'foodie','middleware'=>'validateBackHistory'], function () {
    Route::get('/', 'Foodie\FoodieController@index')->name('foodie');
    Route::get('notifClear','Foodie\FoodieController@clearNotif')->name('foodie.clearNotif');
    Route::get('notifGet', 'Foodie\FoodieController@getNotif')->name('foodie.getNotif');
    Route::get('login/show', 'Foodie\Auth\LoginController@showLoginForm')->name('foodie.login.show');
    Route::post('login', 'Foodie\Auth\LoginController@login')->name('foodie.login');
    Route::post('logout', 'Foodie\Auth\LoginController@logout')->name('foodie.logout');
    Route::get('logoutAuto', 'Foodie\Auth\LoginController@logoutAuto')->name('foodie.logoutAuto');

    Route::post('password/email', 'Foodie\Auth\ForgotPasswordController@sendResetLinkEmail')->name('foodie.reset.send');
    Route::get('password/reset', 'Foodie\Auth\ForgotPasswordController@showLinkRequestForm')->name('foodie.reset.show');

    Route::post('password/reset', 'Foodie\Auth\ResetPasswordController@reset')->name('foodie.reset');
    Route::get('password/reset/{token}', 'Foodie\Auth\ResetPasswordController@showResetForm')->name('foodie.reset.password');

    Route::get('dashboard', 'Foodie\FoodieController@index')->name('foodie.dashboard');
    Route::get('profile', 'Foodie\FoodieController@profile')->name('foodie.profile');
    Route::post('profile/coverPhoto', 'Foodie\FoodieController@saveProfileCoverPhoto')->name('foodie.profile.coverPhoto');
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

    Route::get('plans','Foodie\FoodieMealPlanController@viewPlans')->name('foodie.plan.show');
    Route::get('plans/standard/{plan}', 'Foodie\FoodieMealPlanController@viewPlanStandard')->name('foodie.plan.standard');
    Route::get('plans/simple/{plan}', 'Foodie\FoodieMealPlanController@viewSimpleCustomize')->name('foodie.plan.simple');
    Route::get('plans/simpleView/{simpleCustomPlan}', 'Foodie\FoodieMealPlanController@simpleCustomView')->name('foodie.plan.simpleView');
    Route::get('plans/simpleView/delete/{simpleCustomPlan}', 'Foodie\FoodieMealPlanController@simpleCustomDelete')->name('foodie.plan.simpleDelete');
    Route::get('ingredMeal/{chefCustomizedMeal}/get', 'Foodie\FoodieMealPlanController@getIngred');
    Route::get('plans/custom/{plan}', 'Foodie\FoodieMealPlanController@viewChefsMeals')->name('foodie.plan.custom');
    Route::get('chefs', 'Foodie\FoodieMealPlanController@viewChefs')->name('foodie.chef.show');
    Route::get('chefs/plan/{id}', 'Foodie\FoodieMealPlanController@viewChefsPlans')->name('foodie.chef.plan');
    Route::get('chefs/meal/{plan}', 'Foodie\FoodieMealPlanController@viewChefsMeals')->name('foodie.chef.meal');
    Route::get('chef/meal/{plan}/{id}/{customPlan}', 'Foodie\FoodieMealPlanController@viewMeal')->name('foodie.meal');
    Route::post('chefs/customize/{customize}', 'Foodie\FoodieMealPlanController@customizeChefsMeals')->name('foodie.meal.custom');
    Route::post('chefs/customize/simple/{simpleCustomPlan}','Foodie\FoodieMealPlanController@simpleMake')->name('foodie.simple.custom');
    Route::post('chefs/customize/simpleMeal/{simpleCustomMeal}','Foodie\FoodieMealPlanController@simpleMealMake')->name('foodie.simpleMeal.custom');
    Route::get('chefs/customize/simpleDetailDelete/{simpleCustomMeal}','Foodie\FoodieMealPlanController@simpleCustomDetailDelete')->name('foodie.simpleMeal.delete');
    Route::get('{type}/getIngredJson', 'Foodie\FoodieMealPlanController@getIngredJson')->name('foodie.meal.autocomplete');
    Route::get('{type}/validateIngredJson', 'Foodie\FoodieMealPlanController@validateIngredJson')->name('foodie.meal.validate');
    Route::get('/mobile/{mobile}','Foodie\FoodieController@getMobile');
    Route::get('/username/{name}','Foodie\FoodieController@getUserName');

    Route::get('order/plan/{plan}', 'Foodie\FoodieOrderPlanController@index')->name('foodie.order.review');
    Route::post('order/cancel/{order}', 'Foodie\FoodieOrderPlanController@cancelOrder')->name('foodie.order.cancel');
    Route::post('order/cancelAll/{order}', 'Foodie\FoodieOrderPlanController@cancelAllOrder')->name('foodie.orderAll.cancel');
    Route::post('order/address/{id}', 'Foodie\FoodieOrderPlanController@changeOrderAddress')->name('foodie.order.address');
    Route::post('order/plan/{plan}', 'Foodie\FoodieOrderPlanController@store')->name('foodie.order.create');
    Route::get('order', 'Foodie\FoodieOrderPlanController@order')->name('foodie.order');
    Route::post('order/custPlan/{plan}/{id}', 'Foodie\FoodieOrderPlanController@custStore')->name('foodie.custOrder.create');
    Route::get('order/view/{from}', 'Foodie\FoodieOrderPlanController@getAllOrdersView')->name('foodie.order.view');
    Route::get('order/viewSingle/{orderItem}', 'Foodie\FoodieOrderPlanController@getOneOrderDetails')->name('foodie.order.single');
    Route::get('ingred/{id}/get/{cust}', 'Foodie\FoodieOrderPlanController@getIngred');
    Route::get('order/viewSimpCust/{orderItem}', 'Foodie\FoodieOrderPlanController@getSimpCustView')->name('foodie.order.simpCust');

    // Route after ordering
    Route::get('get/order/{order}', 'Foodie\FoodieOrderPlanController@show')->name('order.show');

    // Get MESSAGING view
    Route::get('message/index', 'Foodie\FoodieMessageController@index')->name('foodie.message.index');
    Route::get('message/index/{id}', 'Foodie\FoodieMessageController@message')->name('foodie.message.message');
    Route::post('message/send', 'Foodie\FoodieMessageController@send')->name('foodie.message.send');
    Route::post('message/reply', 'Foodie\FoodieMessageController@reply')->name('foodie.message.reply');
    Route::post('message/delete/{message}', 'Foodie\FoodieMessageController@delete')->name('foodie.message.delete');
    Route::post('message/deleteChat/{id}', 'Foodie\FoodieMessageController@deleteChat')->name('foodie.chat.delete');


    Route::get('paywithpaypal/{order}', array('as' => 'addmoney.paywithpaypal', 'uses' => 'AddMoneyController@payWithPaypal',));
    Route::post('paypal/{order}', array('as' => 'addmoney.paypal', 'uses' => 'AddMoneyController@postPaymentWithpaypal',));
    Route::get('paypal/{order}', array('as' => 'payment.status', 'uses' => 'AddMoneyController@getPaymentStatus',));

    // Bank Deposit
    Route::post('bank/deposit/order/{order}', 'DepositController@deposit')->name('deposit.order');
    Route::post('gcash/pay/{order}', 'DepositController@gcash')->name('deposit.gcash');

    // Rating
    Route::get('/rating/{id}', 'RatingsController@getRatingPage')->name('chef.rating');
    Route::post('rate/chef/{orderItem}/{id}', 'RatingsController@rateChef')->name('rate.chef');

    // Cart
    Route::get('cart', 'CartController@index')->name('cart.index');
    Route::post('cart/update/{id}','CartController@update')->name('cart.update');
    Route::get('cart/{plan}/{cust}','CartController@add')->name('cart.add');
    Route::get('cart/{id}','CartController@remove')->name('cart.remove');
});

Route::group(['prefix' => 'chef','middleware'=>'validateBackHistory'], function () {

    Route::get('/', 'Chef\ChefController@index')->name('chef');
    Route::get('dashboard', 'Chef\ChefController@index')->name('chef.dashboard');

    Route::get('notifClear','Chef\ChefController@clearNotif')->name('chef.clearNotif');
    Route::get('notifGet', 'Chef\ChefController@getNotif')->name('chef.getNotif');
    Route::get('login/show', 'Chef\Auth\LoginController@showLoginForm')->name('chef.login.show');
    Route::post('login', 'Chef\Auth\LoginController@login')->name('chef.login');
    Route::post('logout', 'Chef\Auth\LoginController@logout')->name('chef.logout');
    Route::get('logoutAuto', 'Chef\Auth\LoginController@logoutAuto')->name('chef.logoutAuto');


    Route::post('password/email', 'Chef\Auth\ForgotPasswordController@sendResetLinkEmail')->name('chef.reset.send');
    Route::get('password/reset', 'Chef\Auth\ForgotPasswordController@showLinkRequestForm')->name('chef.reset.show');

    Route::post('password/reset', 'Chef\Auth\ResetPasswordController@reset')->name('chef.reset');
    Route::get('password/reset/{token}', 'Chef\Auth\ResetPasswordController@showResetForm')->name('chef.reset.password');

    Route::get('register', 'Chef\Auth\RegisterController@showRegistrationForm')->name('chef.register.show');
    Route::post('register', 'Chef\Auth\RegisterController@register')->name('chef.register');


    Route::get('profile', 'Chef\ChefController@profile')->name('chef.profile');
    Route::post('profile/coverPhoto', 'Chef\ChefController@saveProfileCoverPhoto')->name('chef.profile.coverPhoto');
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
    Route::get('plan/getMealJson','Chef\MealPlanController@getMeals')->name('chef.plan.jsonMeal');
    Route::get('{type}/getIngredJson', 'Chef\MealPlanController@getIngredJson')->name('chef.plan.autocomplete');
    Route::get('{type}/validateIngredJson', 'Chef\MealPlanController@validateIngredJson')->name('chef.plan.validate');
    Route::post('plan/{plan}/createMeal', 'Chef\MealPlanController@setMeal')->name('chef.meal.create');
    Route::post('plan/{plan}/chooseMeal', 'Chef\MealPlanController@chooseMeal')->name('chef.meal.choose');
    Route::post('plan/update/{chefCustomizedMeal}', 'Chef\MealPlanController@updateMeal')->name('chef.meal.update');
    Route::post('plan/deleteMealPlan/', 'Chef\MealPlanController@deleteMealPlan')->name('chef.mealPlan.delete');
    Route::post('plan/deleteMeal/{chefCustomizedMeal}', 'Chef\MealPlanController@deleteMeal')->name('chef.meal.delete');
    Route::get('plan/final/{plan}', 'Chef\MealPlanController@finalPlan')->name('chef.plan.final');
    Route::get('plan/unlock/{plan}', 'Chef\MealPlanController@unlockPlan')->name('chef.plan.unlock');

    // Get MESSAGING view
    Route::get('message/index', 'Chef\ChefMessageController@index')->name('chef.message.index');
    Route::get('message/index/{id}', 'Chef\ChefMessageController@message')->name('chef.message.message');
    Route::post('message/send', 'Chef\ChefMessageController@send')->name('chef.message.send');
    Route::post('message/reply', 'Chef\ChefMessageController@reply')->name('chef.message.reply');
    Route::post('message/delete/{message}', 'Chef\ChefMessageController@delete')->name('chef.message.delete');
    Route::post('message/readMessage/{message}', 'Chef\ChefMessageController@readMessage')->name('chef.message.read');
    Route::post('message/deleteChat/{id}', 'Chef\ChefMessageController@deleteChat')->name('chef.chat.delete');


    //ordering
    Route::get('order/view/{from}', 'Chef\ChefOrderController@getAllOrdersView')->name('chef.order.view');
    Route::get('ingred/{id}/get/{cust}', 'Chef\ChefOrderController@getIngred');
    Route::get('order/viewSingle/{orderItem}', 'Chef\ChefOrderController@getOneOrderDetails')->name('chef.order.single');

    // Chef Rating
    Route::get('rating', 'ChefRatingsController@viewRatings')->name('chef.ratings');
});

Route::group(['prefix' => 'admin'], function () {
    Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login');
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
    Route::get('/', 'Admin\AdminController@index')->name('admin');
    Route::get('dashboard', 'Admin\AdminController@index')->name('admin.dashboard');
    Route::get('commissions','Admin\AdminController@commissions')->name('admin.commissions');
    Route::post('/payCommission/{commission}','Admin\AdminController@payCommission')->name('admin.pay');
    Route::post('/payCommissionAll','Admin\AdminController@payCommissionAll')->name('admin.payAll');
    Route::get('chefs','Admin\AdminController@chefs')->name('admin.chefs');
    Route::get('chefs/{chef}','Admin\AdminController@chef')->name('admin.chef');
    Route::get('foodies','Admin\AdminController@foodies')->name('admin.foodies');
    Route::get('foodies/{foodie}','Admin\AdminController@foodie')->name('admin.foodie');
    Route::get('plans','Admin\AdminController@plans')->name('admin.plans');
    Route::get('plans/{plan}','Admin\AdminController@plan')->name('admin.plan');
    Route::get('plan/ban/{plan}','Admin\AdminController@planBan')->name('admin.plan.ban');
    Route::get('plan/unban/{plan}','Admin\AdminController@planUnban')->name('admin.plan.unban');
    Route::get('orders','Admin\AdminController@orders')->name('admin.orders');
    Route::get('orders/{order}','Admin\AdminController@order')->name('admin.order');
    Route::get('order/cancel/{order}','Admin\AdminController@orderCancel')->name('admin.order.cancel');
    Route::get('foodie/freeze/{foodie}','Admin\AdminController@foodieFreeze')->name('admin.foodie.freeze');
    Route::get('foodie/unfreeze/{foodie}','Admin\AdminController@foodieUnfreeze')->name('admin.foodie.unfreeze');
    Route::get('chef/freeze/{chef}','Admin\AdminController@chefFreeze')->name('admin.chef.freeze');
    Route::get('chef/unfreeze/{chef}','Admin\AdminController@chefUnfreeze')->name('admin.chef.unfreeze');
    Route::post('foodie/register', 'Admin\AdminUserCreateController@register')->name('admin.foodie.register');
    Route::post('chef/register', 'Admin\AdminVendorCreateController@register')->name('admin.chef.register');

});
