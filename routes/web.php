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
    Route::get('notifClearAll','Foodie\FoodieController@clearNotifAll')->name('foodie.clearNotifAll');
    Route::get('notifGet', 'Foodie\FoodieController@getNotif')->name('foodie.getNotif');
    Route::get('login/show', 'Foodie\Auth\LoginController@showLoginForm')->name('foodie.login.show');
    Route::get('login', 'Foodie\Auth\LoginController@getLogin');
    Route::post('login', 'Foodie\Auth\LoginController@login')->name('foodie.login');
    Route::get('logout', 'Foodie\Auth\LoginController@getLogin');
    Route::post('logout', 'Foodie\Auth\LoginController@logout')->name('foodie.logout');
    Route::get('logoutAuto', 'Foodie\Auth\LoginController@logoutAuto')->name('foodie.logoutAuto');

    Route::post('password/email', 'Foodie\Auth\ForgotPasswordController@sendResetLinkEmail')->name('foodie.reset.send');
    Route::get('password/reset', 'Foodie\Auth\ForgotPasswordController@showLinkRequestForm')->name('foodie.reset.show');

    Route::post('password/reset', 'Foodie\Auth\ResetPasswordController@reset')->name('foodie.reset');
    Route::get('password/reset/{token}', 'Foodie\Auth\ResetPasswordController@showResetForm')->name('foodie.reset.password');

    Route::get('dashboard', 'Foodie\FoodieController@index')->name('foodie.dashboard');
    Route::get('profile', 'Foodie\FoodieController@profile')->name('foodie.profile');
    Route::post('profile/coverPhoto', 'Foodie\FoodieController@saveProfileCoverPhoto')->name('foodie.profile.coverPhoto');
    Route::get('profile/save', 'Foodie\FoodieController@notSave');
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
    Route::get('plans/standard/{id}', 'Foodie\FoodieMealPlanController@viewPlanStandard')->name('foodie.plan.standard');
    Route::get('plans/simple/{id}', 'Foodie\FoodieMealPlanController@viewSimpleCustomize')->name('foodie.plan.simple');
    Route::get('plans/simpleView/{id}', 'Foodie\FoodieMealPlanController@simpleCustomView')->name('foodie.plan.simpleView');
    Route::get('plans/simpleView/delete/{simpleCustomPlan}', 'Foodie\FoodieMealPlanController@simpleCustomDelete')->name('foodie.plan.simpleDelete');
    Route::get('ingredMeal/{chefCustomizedMeal}/get', 'Foodie\FoodieMealPlanController@getIngred');
    Route::get('plans/custom/{plan}', 'Foodie\FoodieMealPlanController@viewChefsMeals')->name('foodie.plan.custom');
    Route::get('chefs', 'Foodie\FoodieMealPlanController@viewChefs')->name('foodie.chef.show');
    Route::get('chefs/plan/{id}', 'Foodie\FoodieMealPlanController@viewChefsPlans')->name('foodie.chef.plan');
    Route::get('chefs/meal/{plan}', 'Foodie\FoodieMealPlanController@viewChefsMeals')->name('foodie.chef.meal');
    Route::get('chef/meal/{plan}/{id}/{customPlan}', 'Foodie\FoodieMealPlanController@viewMeal')->name('foodie.meal');
    Route::post('chefs/customize/{customize}', 'Foodie\FoodieMealPlanController@customizeChefsMeals')->name('foodie.meal.custom');
    Route::post('chefs/customize/simple/{id}','Foodie\FoodieMealPlanController@simpleMake')->name('foodie.simple.custom');
    Route::post('chefs/customize/simpleMeal/{id}','Foodie\FoodieMealPlanController@simpleMealMake')->name('foodie.simpleMeal.custom');
    Route::get('chefs/customize/simpleDetailDelete/{simpleCustomMeal}','Foodie\FoodieMealPlanController@simpleCustomDetailDelete')->name('foodie.simpleMeal.delete');
    Route::get('{type}/getIngredJson', 'Foodie\FoodieMealPlanController@getIngredJson')->name('foodie.meal.autocomplete');
    Route::get('{type}/validateIngredJson', 'Foodie\FoodieMealPlanController@validateIngredJson')->name('foodie.meal.validate');
    Route::get('/mobile/{mobile}','Foodie\FoodieController@getMobile');
    Route::get('/username/{name}','Foodie\FoodieController@getUserName');

    Route::get('order/plan/{plan}', 'Foodie\FoodieOrderPlanController@index')->name('foodie.order.review');
    Route::post('order/cancel/{order}', 'Foodie\FoodieOrderPlanController@cancelOrder')->name('foodie.order.cancel');
    Route::post('order/cancelAll', 'Foodie\FoodieOrderPlanController@cancelAllOrder')->name('foodie.orderAll.cancel');
    Route::post('order/address/{id}', 'Foodie\FoodieOrderPlanController@changeOrderAddress')->name('foodie.order.address');
    Route::post('order/plan/{plan}', 'Foodie\FoodieOrderPlanController@store')->name('foodie.order.create');
    Route::get('order', 'Foodie\FoodieOrderPlanController@order')->name('foodie.order');
    Route::post('order/custPlan/{plan}/{id}', 'Foodie\FoodieOrderPlanController@custStore')->name('foodie.custOrder.create');
    Route::get('order/view/{from}', 'Foodie\FoodieOrderPlanController@getAllOrdersView')->name('foodie.order.view');
    Route::get('order/viewSingle/{orderItem}', 'Foodie\FoodieOrderPlanController@getOneOrderDetails')->name('foodie.order.single');
    Route::get('ingred/{id}/get/{cust}', 'Foodie\FoodieOrderPlanController@getIngred');
    Route::get('order/viewSimpCust/{orderItem}', 'Foodie\FoodieOrderPlanController@getSimpCustView')->name('foodie.order.simpCust');
    Route::get('/order/dateChange/{type}/{id}', 'Foodie\FoodieOrderPlanController@dateChange');
    Route::get('/order/refundChange/{type}', 'Foodie\FoodieOrderPlanController@refundChange');
    Route::get('/order/refunds/{id}', 'Foodie\FoodieOrderPlanController@refundPage');
    Route::get('/order/refundReview/{id}', 'Foodie\FoodieOrderPlanController@refundReview');
    Route::post('/order/refundChoose/{id}', 'Foodie\FoodieOrderPlanController@chooseRefund')->name('foodie.refund');
    Route::get('/order/dayChange/{date}/{type}', 'Foodie\FoodieOrderPlanController@dayChange');
    Route::get('/order/selectDay/{type}', 'Foodie\FoodieOrderPlanController@selectDay');


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
    Route::post('paypal/{id}', array('as' => 'addmoney.paypal', 'uses' => 'AddMoneyController@postPaymentWithpaypal',));
    Route::get('paypal/{order}', array('as' => 'payment.status', 'uses' => 'AddMoneyController@getPaymentStatus',));

    // Bank Deposit
    Route::post('bank/deposit/order/{id}', 'DepositController@deposit')->name('deposit.order');
    Route::post('gcash/pay/{id}', 'DepositController@gcash')->name('deposit.gcash');

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
    Route::get('notifClearAll','Chef\ChefController@clearNotifAll')->name('chef.clearNotifAll');
    Route::get('login/show', 'Chef\Auth\LoginController@showLoginForm')->name('chef.login.show');
    Route::get('login', 'Chef\Auth\LoginController@getLogin');
    Route::post('login', 'Chef\Auth\LoginController@login')->name('chef.login');
    Route::get('logout', 'Chef\Auth\LoginController@getLogin');
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
    Route::get('profile/save', 'Chef\ChefController@notSave');
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
    Route::get('order/deliver/{id}', 'Chef\ChefOrderController@updateDelivery')->name('chef.order.deliver');
    Route::post('order/cancel/{id}', 'Chef\ChefOrderController@cancelOrderItem')->name('chef.order.cancel');
    Route::get('/order/dateChange/{type}/{id}', 'Chef\ChefOrderController@dateChange');
    Route::get('/order/dayChange/{date}/{type}', 'Chef\ChefOrderController@dayChange');
    Route::get('/order/selectDay/{type}', 'Chef\ChefOrderController@selectDay');

    // Chef Rating
    Route::get('rating', 'ChefRatingsController@viewRatings')->name('chef.ratings');

    //Chef Commissions
    Route::get('commissions','Chef\ChefOrderController@commissions')->name('chef.getCommissions');
    Route::get('commissions/getYears','Chef\ChefOrderController@getYears');
    Route::get('commissions/getMonths/{val}','Chef\ChefOrderController@getMonths');
    Route::get('commissions/monthChange/{yearType}/{monthType}','Chef\ChefOrderController@monthChange');

});

Route::group(['prefix' => 'admin','middleware'=>'validateBackHistory'], function () {

    Route::get('notifClear','Admin\AdminController@clearNotif')->name('admin.clearNotif');
    Route::get('notifClearAll','Admin\AdminController@clearNotifAll')->name('admin.clearNotifAll');
    Route::get('notifGet', 'Admin\AdminController@getNotif')->name('admin.getNotif');

    Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login');
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
    Route::get('/', 'Admin\AdminController@index')->name('admin');
    Route::get('dashboard', 'Admin\AdminController@index')->name('admin.dashboard');

    Route::get('commissions','Admin\AdminController@commissions')->name('admin.commissions');
    Route::get('commissions/chef','Admin\AdminController@getComChef');
    Route::get('commissions/get/{type}','Admin\AdminController@getCom');
    Route::get('commissions/getYears','Admin\AdminController@getYears');
    Route::get('commissions/getMonths/{val}','Admin\AdminController@getMonths');
    Route::get('commissions/monthChange/{chefId}/{yearType}/{monthType}','Admin\AdminController@monthChange');


    Route::get('refunds','Admin\AdminController@getRefFoodie');
    Route::get('refunds/info/{id}','Admin\AdminController@getRefInfo');
    Route::get('refunds/get','Admin\AdminController@refundPage')->name('admin.adminRefund');
    Route::post('refunds/update','Admin\AdminController@refund')->name('admin.refundUpdate');




    Route::get('/payCommission/{order}','Admin\AdminController@payCommission')->name('admin.pay');
//    Route::post('/payCommission/{order}','Admin\AdminController@payCommission')->name('admin.pay');
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
    Route::get('orders/orderChange/{type}','Admin\AdminController@orderChange');


    Route::get('orders/{order}','Admin\AdminController@order')->name('admin.order');
    Route::post('order/cancel/{order}','Admin\AdminController@orderCancel')->name('admin.order.cancel');
    Route::get('foodie/freeze/{foodie}','Admin\AdminController@foodieFreeze')->name('admin.foodie.freeze');
    Route::get('foodie/unfreeze/{foodie}','Admin\AdminController@foodieUnfreeze')->name('admin.foodie.unfreeze');
    Route::get('chef/freeze/{chef}','Admin\AdminController@chefFreeze')->name('admin.chef.freeze');
    Route::get('chef/unfreeze/{chef}','Admin\AdminController@chefUnfreeze')->name('admin.chef.unfreeze');
    Route::post('foodie/register', 'Admin\AdminUserCreateController@register')->name('admin.foodie.register');
    Route::post('chef/register', 'Admin\AdminVendorCreateController@register')->name('admin.chef.register');

});
