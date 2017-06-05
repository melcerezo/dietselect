<?php

namespace App\Http\Controllers\Foodie;


use App\Chat;
use App\CustomizedMeal;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use App\Chef;
use App\Order;
use App\Rating;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Validator;
use DateTime;
use App\Allergy;
use App\FoodiePreference;
use App\Plan;
use App\MealPlan;

class FoodieController extends Controller
{
    use VerifiesSms;


    protected $foodies = 'foodies';
    protected $redirectTo = '/foodie/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('foodie.auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\View;
     */
    public function index()
    {
//        suggested meal plans

        $foodie = Auth::guard('foodie')->user()->id;
        # Meals
        // GET ALL THE PLANS

        // GET THE MEAL PLAN OF THE PLANS AND GET THE MEAL -> MAIN_INGREDIENT

        // MAIN_INGREDIENT -> COUNT EACH (beef, chicken, pork, vegetables, fruits)

        // MAIN_INGREDIENT COMPARE TO FOODIE_PREFERENCES

        //only plans for the week, not all the plans
        $dt = Carbon::now();
        $currentTime = $dt->format('H:i:A');
        $endTime = Carbon::create($dt->year, $dt->month, $dt->day, 15, 0, 0)->format('H:i:A');

        $startOfTheWeek = $dt->startOfWeek()->format('Y-m-d');
        $endOfTheWeek = $dt->endOfWeek()->format('Y-m-d');

        $plans = Plan::all();
        $suggested = array();
        $foodiePreferenceCount=FoodiePreference::where('foodie_id', '=', $foodie)->count();
        $foodiePreference='';
        if($foodiePreferenceCount>0){
            $foodiePreference = FoodiePreference::where('foodie_id', '=', $foodie)->first()->ingredient;
        }

        foreach ($plans as $plan) {

            if ($plan->created_at >= $startOfTheWeek && $plan->created_at <= $endOfTheWeek) {
                if ($dt->isSaturday() && $currentTime <= $endTime) {
                    $chicken = 0;
                    $beef = 0;
                    $pork = 0;
                    $seafood = 0;

                    $mealPlans = MealPlan::where('plan_id', '=', $plan->id)->get();
                    foreach($mealPlans as $mealPlan){
                        $mainIngredient = Str::lower($mealPlan->meal->main_ingredient);

//                echo $mainIngredient . ' ';

                        switch ($mainIngredient){
                            case 'chicken':
                                $chicken+=1;
                                break;
                            case 'beef':
                                $beef+=1;
                                break;
                            case 'pork':
                                $pork+=1;
                                break;
                            case 'seafood':
                                $seafood+=1;
                                break;
                        }
                    }

                    if($chicken > $beef && $chicken > $pork && $chicken > $seafood){
                        if($foodiePreference=='chicken'){
                            $suggested[]= array('id'=>$plan->id, 'name'=>$plan->plan_name);
                        }
                    }else if($beef > $chicken && $beef > $pork && $beef > $seafood){
                        if($foodiePreference=='beef'){
                            $suggested[]= array('id'=>$plan->id, 'name'=>$plan->plan_name);
                        }
                    }else if($pork > $beef && $pork > $chicken && $pork > $seafood){
                        if($foodiePreference=='$pork'){
                            $suggested[]= array('id'=>$plan->id, 'name'=>$plan->plan_name);
                        }
                    }else if($seafood > $beef && $seafood > $pork && $seafood > $chicken){
                        if($foodiePreference=='$seafood'){
                            $suggested[]= array('id'=>$plan->id, 'name'=>$plan->plan_name);
                        }
                    }
                } // END OF DEADLINE SATURDAY @ 3 PM
            }
        }

//        dd($suggested[1]['id']);
//        die();

//        end suggested meal plans
        $orders = 0;
        $paidOrder=0;
        $mealPlans=0;
        $ordersRating = 0;
        $ratingsCount = 0;
        $ratings = 0;
        $foodieAddress='';
        $paidOrderCount= Order::where('foodie_id', '=', Auth::guard('foodie')->user()->id)->where('is_paid','=',1)->latest()->get()->count();
//        dd($anyOrderCount);
        $ordersCount = Order::where('foodie_id', '=', Auth::guard('foodie')->user()->id)->where('is_paid', '=', 0)->get()->count();
        $addressCount = DB::table('foodie_address')->where('foodie_id', '=', Auth::guard('foodie')->user()->id)->get()->count();
        if ($ordersCount > 0) {
            $orders = Order::where('foodie_id', '=', Auth::guard('foodie')->user()->id)->where('is_paid', '=', 0)->get();
        }
        if ($paidOrderCount > 0){
            $paidOrder=Order::where('foodie_id', '=', Auth::guard('foodie')->user()->id)->where('is_paid','=',1)->latest()->first();
            $mealPlans =$paidOrder->plan->mealplans;
//            dd($mealPlans);
        }
//        dd($paidOrderCount);
//      for message dropdown
        $chefs = Chef::all();
        $chats= Chat::where('foodie_id','=',$foodie)->latest($column = 'updated_at')->get();
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
            ->where('receiver_type', '=', 'f')->where('is_read','=',0)->get();

//      Ratings Stuff
        $ordersRatingCount = Order::where('foodie_id', '=', Auth::guard('foodie')->user()->id)
            ->where('is_paid', '=', 1)
            ->orderBy('created_at', 'desc')->get()->count();
        if ($ordersRatingCount) {
            $ordersRating = Order::where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                ->where('is_paid', '=', 1)
                ->orderBy('created_at', 'desc')->first();
            $ratingsCount = Rating::where('order_id', '=', $ordersRating->id)->where('is_rated', '=', 0)->get()->count();
        }
        if ($ratingsCount > 0) {
            $ratings = Rating::where('order_id', '=', $ordersRating->id)->where('is_rated', '=', 0)->get();
        }

        if($addressCount>0){
            $foodieAddress=  DB::table('foodie_address')->where('foodie_id', '=', Auth::guard('foodie')->user()->id)->get();
//            dd($foodieAddress[0]);
        }
        return view('foodie.dashboard')->with([

            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
            'chefs'=>$chefs,
            'orders' => $orders,
            'mealPlans' => $mealPlans,
            'ordersCount' => $ordersCount,
            'chats' => $chats,
            'messages'=> $messages,
            'successPayment' => 'false',
            'ordersRating' => $ordersRating,
            'ratings' => $ratings,
            'ratingsCount' => $ratingsCount,
            'addressCount' => $addressCount,
            'foodieAddress' => $foodieAddress,
            'suggested' => $suggested,
            'paidOrderCount'=>$paidOrderCount,
            'paidOrder'=>$paidOrder
        ]);
    }


    /**
     * Show the foodie profile.
     *
     * @return \Illuminate\Contracts\View\View;
     */
    public function profile()
    {
        $foodie = Auth::guard('foodie')->user()->id;
        $chats= Chat::where('foodie_id','=',$foodie)->latest($column = 'updated_at')->get();
        $addresses = DB::table('foodie_address')->where('foodie_id', '=', Auth::guard('foodie')->user()->id)->get();
        $allergies = Allergy::where('foodie_id', Auth::guard('foodie')->user()->id)->select('allergy')->get();
        $preference = FoodiePreference::where('foodie_id', Auth::guard('foodie')->user()->id)->first();
        $chefs = Chef::all();
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)->where('receiver_type', '=', 'f')->where('is_read','=',0)->get();
        $allergyJson = '[';
        $i = 0;
        foreach ($allergies as $allergy) {
            if (++$i < $allergies->count()) {
                $allergyJson .= '{"allergy": "' . $allergy->allergy . '"},';
            } else {
                $allergyJson .= '{"allergy": "' . $allergy->allergy . '"}';
            }
        }
        $allergyJson .= ']';
//        dd($allergyJson);
        return view('foodie.profile')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
            'addresses' => $addresses,
            'allergies' => $allergies,
            'allergyJson' => $allergyJson,
            'preference' => $preference,
            'chats' => $chats,
            'messages' => $messages,
            'chefs' => $chefs
        ]);
    }

    public function getID()
    {
        return Auth::guard($this->guard)->user()->id;
    }

    public function saveProfileCoverPhoto(Request $request)
    {
//        dd($request->file('cover'));
//        dd($request->hasFile('cover'));
        Validator::make($request->all(), [
            'cover' => 'required|mimes:jpeg,jpg,png,bmp',
        ])->validate();

        $foodie=Auth::guard('foodie')->user();
        if($request->hasFile('cover')){
            if($request->file('cover')->isValid()){
                $avatar = $request->file('cover');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                // Change Directory HERE
                Image::make($avatar)->resize(500, 500)->save(public_path('img/' . $filename));
                $foodie->cover=$filename;
    //            dd($foodie->cover);
                $foodie->save();

                return back()->with(['status'=>'Successfully updated the cover photo']);
            }else{
                return back()->with(['status'=>'File format is not valid! Please try another photo!']);
            }

        }
    }

    /**
     * Handle a registration request for the application.
     *
     *
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function saveProfileBasic(Request $request)
    {

        // You can use the print_r() function to just print out the data that a variable has.
        // End it with the die(); statement to end the execution of the method.
        // print_r($request->all());die();

        Validator::make($request->all(), [
            'last_name' => 'required|max:100',
            'first_name' => 'required|max:100',
            'username' => 'max:20'
        ])->validate();


        $foodie = Auth::guard('foodie')->user();
        $foodie->first_name = $request['first_name'];
        $foodie->last_name = $request['last_name'];
        $foodie->gender = $request['gender'];

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            // Change Directory HERE
            Image::make($avatar)->resize(500, 500)->save(public_path('img/' . $filename));
            $foodie->avatar = $filename;
        }
        // You should place meaningful end messages, so you could easily
        // know when which part you have reached.
        // die("We just finished setting the gender of the foodie.");


        $foodie->birthday = $request['birthday'];
        $foodie->username = $request['username'];
        $foodie->save();

        return redirect($this->redirectTo)->with(['status' => 'Successfully updated the info!']);

    }

    public function saveProfileAddress(Request $request)
    {

        Validator::make($request->all(), [
            'city' => 'required|max:100',
            'unit' => 'required|max:100',
            'street' => 'required|max:100',
//            'bldg' => 'required|max:100',
            'brgy' => 'required|max:100',
            'type' => 'required|max:100',
            // 'company' => 'required|max:100',
            // 'landmark' => 'required|max:100',
            //'remarks' => 'required|max:100',
        ])->validate();

        $result = DB::table('foodie_address')->insert([
            'city' => $request['city'],
            'unit' => $request['unit'],
            'street' => $request['street'],
            'bldg' => $request['bldg'],
            'brgy' => $request['brgy'],
            'type' => $request['type'],
            'company' => $request['company'],
            'landmark' => $request['landmark'],
            'remarks' => $request['remarks'],
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            'foodie_id' => Auth::guard('foodie')->user()->id,


        ]);
        return redirect($this->redirectTo)->with(['status' => 'Successfully updated the info!']);
    }

    public function updateProfileAddress(Request $request, $id)
    {
        Validator::make($request->all(), [
            'city' => 'required|max:100',
            'unit' => 'required|max:100',
            'street' => 'required|max:100',
            // 'bldg' => 'required|max:100',
            'brgy' => 'required|max:100',
            'type' => 'required|max:100',
            // 'company' => 'required|max:100',
            // 'landmark' => 'required|max:100',
            //'remarks' => 'required|max:100',
        ])->validate();

        DB::table('foodie_address')
            ->where('id', '=', $id)
            ->update(
                [
                    'city' => $request['city'],
                    'unit' => $request['unit'],
                    'street' => $request['street'],
                    'bldg' => $request['bldg'],
                    'brgy' => $request['brgy'],
                    'type' => $request['type'],
                    'company' => $request['company'],
                    'landmark' => $request['landmark'],
                    'remarks' => $request['remarks'],
                ]
            );

        return redirect($this->redirectTo)->with(['status' => 'Successfully updated the info!']);


    }

    public function deleteProfileAddress($id)
    {
        DB::table('foodie_address')
            ->where('id', '=', $id)
            ->delete();
        return redirect($this->redirectTo)->with(['status' => 'Successfully deleted the address!']);

    }

    public function saveProfileAllergies(Request $request)
    {

        // print_r($request['others']);die();
        // print_r($otherAllergiesArray);die();

        $otherAllergiesInput = $request->input('others');
        if ($otherAllergiesInput != "") {

            $otherAllergiesArray = explode(',', $otherAllergiesInput);
            $prevAllergies = Allergy::where('foodie_id', '=', Auth::guard('foodie')->user()->id)->get();

            foreach ($prevAllergies as $prevAllergy) {
//               dd($otherAllergiesArray);
                if (!in_array($prevAllergy->allergy, $otherAllergiesArray)) {
                    $allergyDelete = $prevAllergy;
                    $allergyDelete->delete();
                }

            }

            foreach ($otherAllergiesArray as $key => $value) {

                /*~~~ eloquent model method for checking existence ~~~*/
                if (Allergy::where([
                        ['foodie_id', '=', Auth::guard('foodie')->user()->id],
                        ['allergy', '=', $value]
                    ])->count() == 0
                ) {

                    /*~~~ eloquent model method for getting allergies ~~~*/
                    $allergy = new Allergy;
                    $allergy->foodie_id = Auth::guard('foodie')->user()->id;
                    $allergy->allergy = $value;
                    $allergy->save();

                    //print_r($allergy);die('set the allergy model');
                }
            }
        }

        foreach ($request->except('others') as $key => $value) {

            if ($value == "1") {

                /*~~~ eloquent model method for checking existence ~~~*/
                if (Allergy::where([
                        ['foodie_id', '=', Auth::guard('foodie')->user()->id],
                        ['allergy', '=', $key]
                    ])->count() == 0
                ) {

                    /*~~~ eloquent model method for getting allergies ~~~*/
                    $allergy = new Allergy;
                    $allergy->foodie_id = Auth::guard('foodie')->user()->id;
                    $allergy->allergy = $key;
                    $allergy->save();

                    //print_r($allergy);die('set the allergy model');
                }
            } else {
                if (Allergy::where([
                        ['foodie_id', '=', Auth::guard('foodie')->user()->id],
                        ['allergy', '=', $key]
                    ])->count() > 0
                ) {
                    $allergy = Allergy::where([
                        ['foodie_id', '=', Auth::guard('foodie')->user()->id],
                        ['allergy', '=', $key]
                    ])->first();
                    $allergy->delete();

                }
            }
        }


        return redirect($this->redirectTo)->with(['status' => 'Successfully updated the info!']);
    }

    public function saveProfilePreferences(Request $request)
    {
        $ingredient = $request['foodPref'];

        if (!FoodiePreference::where([
            ['foodie_id', '=', Auth::guard('foodie')->user()->id]
        ])->exists()
        ) {

            $preference = new FoodiePreference;
            $preference->foodie_id = Auth::guard('foodie')->user()->id;
            $preference->ingredient = $ingredient;
        } else {
            $preference = FoodiePreference::where('foodie_id', Auth::guard('foodie')->user()->id)->first();
            $preference->ingredient = $ingredient;
//            $preference->save();
        }
        $preference->save();

        return redirect($this->redirectTo)->with(['status' => 'Successfully updated the info!']);
    }

    /**
     * @return string
     */
    public function countPreferences()
    {
        $foodie = Auth::guard('foodie')->user()->id;
        # Meals
        // GET ALL THE PLANS

        // GET THE MEAL PLAN OF THE PLANS AND GET THE MEAL -> MAIN_INGREDIENT

        // MAIN_INGREDIENT -> COUNT EACH (beef, chicken, pork, vegetables, fruits)

        // MAIN_INGREDIENT COMPARE TO FOODIE_PREFERENCES

        //only plans for the week, not all the plans
        # Get DATE
        $dt = Carbon::now(); # You can use Carbon::now()->addHour(int); to adjust current TIME for testing
        $currentTime = $dt->format('H:i:A');
        $endTime = Carbon::create($dt->year, $dt->month, $dt->day, 15, 0, 0)->format('H:i:A');

        # For Testing
//        dd($currentTime.'|'.$endTime);
//        if ($currentTime <= $endTime){
//            // If $currentTime (15:00 PM) <= $endTime(15:00 PM)
//            return 'True';
//        } else {
//            return 'False';
//        }

        $formattedDate = $dt->format('Y-m-d');
        $startOfTheWeek = $dt->startOfWeek()->format('Y-m-d');
        $endOfTheWeek = $dt->endOfWeek()->format('Y-m-d');

        $plans = Plan::all();
        $suggested = [];
        $foodiePreference = FoodiePreference::where('foodie_id', '=', $foodie)->first()->ingredient;

        echo 'Foodie Preference: ' . $foodiePreference . '<br />';

        foreach ($plans as $plan) {

            if ($plan->created_at >= $startOfTheWeek && $plan->created_at <= $endOfTheWeek) {
                if ($dt->isSaturday() && $currentTime <= $endTime) {
                    dd('this is the scope of the week ' . $plan->created_at);
                    $chicken = 0;
                    $beef = 0;
                    $pork = 0;
                    $seafood = 0;

                    $mealPlans = MealPlan::where('plan_id', '=', $plan->id)->get();
                    foreach ($mealPlans as $mealPlan) {
                        $mainIngredient = Str::lower($mealPlan->meal->main_ingredient);
//                echo $mainIngredient . ' ';
                        switch ($mainIngredient) {
                            case 'chicken':
                                $chicken += 1;
                                break;
                            case 'beef':
                                $beef += 1;
                                break;
                            case 'pork':
                                $pork += 1;
                                break;
                            case 'seafood':
                                $seafood += 1;
                                break;
                        }
                        dd($mealPlan);
                    }

                    if ($chicken > $beef && $chicken > $pork && $chicken > $seafood) {
                        if ($foodiePreference == 'chicken') {
                            $suggested[] = $plan->plan_name;
                        }
                    } else if ($beef > $chicken && $beef > $pork && $beef > $seafood) {
                        if ($foodiePreference == 'beef') {
                            $suggested[] = $plan->plan_name;
                        }
                    } else if ($pork > $beef && $pork > $chicken && $pork > $seafood) {
                        if ($foodiePreference == '$pork') {
                            $suggested[] = $plan->plan_name;
                        }
                    } else if ($seafood > $beef && $seafood > $pork && $seafood > $chicken) {
                        if ($foodiePreference == '$seafood') {
                            $suggested[] = $plan->plan_name;
                        }
                    }
                } else {
                    dd('Already Sunday!');
                }
            } else {
                dd('this is not in the scope of the week');
                return 'End';
            }
        }
        dd($suggested);
        die();
    }
}