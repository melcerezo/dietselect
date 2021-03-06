<?php

namespace App\Http\Controllers\Foodie;


use App\Chat;
use App\CustomizedMeal;
use App\CustomPlan;
use App\Foodie;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use App\Chef;
use App\Notification;
use App\Order;
use App\OrderItem;
use App\Rating;
use App\Message;
use App\SimpleCustomPlan;
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
        $dt = Carbon::now();
//        dd($dt);
        $isSaturday = Carbon::parse("this saturday 15:00:00")->format('Y-m-d H:i:s');
        $thisSunday = Carbon::now()->endOfWeek()->format('Y-m-d H:i:s');

        if ($dt->format('Y-m-d H:i:s') == Carbon::SUNDAY) {
//            dd("hi");
            $isSaturday = Carbon::parse("last saturday 15:00:00")->format('Y-m-d H:i:s');
        } else if ($dt->dayOfWeek == Carbon::MONDAY) {
//            dd('hey');
            $isSaturday = Carbon::parse("this saturday 15:00:00")->format('Y-m-d H:i:s');
        }

//        if ($dt->format('Y-m-d H:i:s') >= $isSaturday && $dt->format('Y-m-d H:i:s')<= $thisSunday) {
//            dd($isSaturday);
//        }

//        dd($dt);


        $foodie = Auth::guard('foodie')->user()->id;
        # Meals
        // GET ALL THE PLANS

        // GET THE MEAL PLAN OF THE PLANS AND GET THE MEAL -> MAIN_INGREDIENT

        // MAIN_INGREDIENT -> COUNT EACH (beef, chicken, pork, vegetables, fruits)

        // MAIN_INGREDIENT COMPARE TO FOODIE_PREFERENCES

        //only plans for the week, not all the plans
        $lastSaturday = Carbon::parse("last saturday 15:01:00")->format('Y-m-d H:i:s');
        $dt = Carbon::now();
        $currentTime = $dt->format('H:i:A');
        $endTime = Carbon::create($dt->year, $dt->month, $dt->day, 15, 0, 0)->format('H:i:A');
//        dd($lastSaturday);
        $startOfTheWeek = $dt->startOfWeek()->format('F d');
        $endOfTheWeek = $dt->endOfWeek()->format('Y-m-d');

        // THIS SATURDAY
        $endOfWeek = Carbon::parse("this saturday 15:00:00")->format('Y-m-d H:i:s');
//        $thisMonday = Carbon::parse("monday this week")->addDays(7);

//        dd($thisMonday);

//        echo 'Monday: ' .$thisMonday .'<br>';
//        echo 'Start of the week: '. $lastSaturday .'<br>'; // Start of the week
//        echo 'End of the week: '. $endOfWeek .'<br>';
//        dd('here');


        $plans = Plan::where('created_at', '>=', $lastSaturday)
            ->get();
//        dd($plans[0]->created_at);
        $suggested = array();
        $foodiePreferenceCount = FoodiePreference::where('foodie_id', '=', $foodie)->count();
        $foodiePreference = '';
        if ($foodiePreferenceCount > 0) {
            $foodiePreference = FoodiePreference::where('foodie_id', '=', $foodie)->first()->ingredient;
        }

        foreach ($plans as $plan) {
            $chicken = 0;
            $beef = 0;
            $pork = 0;
            $seafood = 0;

            $mealPlans = MealPlan::where('plan_id', '=', $plan->id)->get();
            foreach ($mealPlans as $mealPlan) {
                $mainIngredient = Str::lower($mealPlan->chefcustomize->main_ingredient);

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
            }

            if ($chicken > $beef && $chicken > $pork && $chicken > $seafood) {
                if ($foodiePreference == 'chicken') {
                    $suggested[] = array('id' => $plan->id, 'name' => $plan->plan_name);
                }
            } else if ($beef > $chicken && $beef > $pork && $beef > $seafood) {
                if ($foodiePreference == 'beef') {
                    $suggested[] = array('id' => $plan->id, 'name' => $plan->plan_name);
                }
            } else if ($pork > $beef && $pork > $chicken && $pork > $seafood) {
                if ($foodiePreference == '$pork') {
                    $suggested[] = array('id' => $plan->id, 'name' => $plan->plan_name);
                }
            } else if ($seafood > $beef && $seafood > $pork && $seafood > $chicken) {
                if ($foodiePreference == '$seafood') {
                    $suggested[] = array('id' => $plan->id, 'name' => $plan->plan_name);
                }
            }
        } // END OF DEADLINE SATURDAY @ 3 PM

//        dd($suggested[1]['id']);
//        die();

//        end suggested meal plans
//        $orders = 0;
//        $paidOrder=0;
        $mealPlans = 0;
        $mealPlansUpcoming = 0;
//        $ordersRating = 0;
//        $ratingsCount = 0;
//        $ratings = 0;
        //time

        $lastTwoWeeks = Carbon::parse("previous week Saturday 15:00:00")->subDays(7)->format('Y-m-d H:i:s');
//        $thisWeek = Carbon::parse("last monday")->format('F d');
        $nextWeek = Carbon::parse("this monday")->format('F d');
//        dd($thisWeek);
        $foodieAddress = '';
//        $paidOrderCount= Order::where('foodie_id', '=', Auth::guard('foodie')->user()->id)->where('is_paid','=',1)->latest()->get()->count();
//        dd($anyOrderCount);
//        $ordersCount = Order::where('foodie_id', '=', Auth::guard('foodie')->user()->id)->where('is_paid', '=', 0)->get()->count();
        $addressCount = DB::table('foodie_address')->where('foodie_id', '=', Auth::guard('foodie')->user()->id)->get()->count();
        $orders = Order::where('foodie_id', '=', Auth::guard('foodie')->user()->id)->where('is_paid', '=', 0)->where('is_cancelled', '=', 0)
            ->where('created_at', '>', $lastSaturday)->latest($column = 'updated_at')->take(5)->get();

//        dd($orders);
        $orderArray = [];
        foreach ($orders as $order) {
            $dt = new Carbon($order->created_at);
            $startOfWeek = $dt->startOfWeek()->addDay(7)->format('F d');
            $orderAddress = DB::table('foodie_address')->where('id', '=', $order->address_id)->select('id', 'city', 'unit', 'street', 'brgy', 'bldg', 'type')->first();
            $orderQuantity = $order->order_item()->count();
            if($orderAddress!=null){
                $oAdd = $orderAddress->unit;
                if ($orderAddress->bldg != '') {
                    $oAdd .= ' ' . $orderAddress->bldg . ', ';
                }
                $oAdd .= ' ' . $orderAddress->street;
                $oAdd .= ', ' . $orderAddress->brgy;
                $oAdd .= ' ' . $orderAddress->city;
            }else{
                $oAdd='';
            }

            $orderArray[] = array('id' => $order->id, 'address' => $oAdd, 'quantity' => $orderQuantity, 'total' => 'PHP '.number_format($order->total,2,'.',','),
                'week' => $startOfWeek);
        }

//        if ($paidOrderCount > 0){
        $paidOrder = Order::where('foodie_id', '=', Auth::guard('foodie')->user()->id)->where('is_paid', '=', 1)
            ->where('created_at', '>=', $lastTwoWeeks)
            ->where('created_at', '<=', $lastSaturday)
            ->latest()->first();
//            dd($paidOrder);
        $orderItemArray = [];
        if ($paidOrder != null) {
            $orderItems = $paidOrder->order_item()->get();
            foreach ($orderItems as $orderItem) {
                $orderPlan = "";
                $planName = "";
                $chefName = "";
                $orderType = "";
                if ($orderItem->order_type == 0) {
                    $orderPlan = Plan::where('id', '=', $orderItem->plan_id)->first();
                    $planName = $orderPlan->plan_name;
                    $chefName = $orderPlan->chef->name;
                    $orderType = "Standard";
                } elseif ($orderItem->order_type == 1) {
                    $orderPlan = CustomPlan::where('id', '=', $orderItem->plan_id)->first();
                    $planName = $orderPlan->plan->plan_name;
                    $chefName = $orderPlan->plan->chef->name;
                    $orderType = "Customized";
                } elseif($orderItem->order_type == 2){
                    $orderPlan = SimpleCustomPlan::where('id', '=', $orderItem->plan_id)->first();
                    $planName = $orderPlan->plan->plan_name;
                    $chefName = $orderPlan->plan->chef->name;
                    $orderType = "Customized";
                }
                $orderItemArray[] = array('id' => $orderItem->id, 'order_id' => $orderItem->order_id, 'plan_id' => $orderItem->plan_id,
                    'plan' => $planName, 'chef' => $chefName, 'type' => $orderType, 'quantity' => $orderItem->quantity, 'price' => 'PHP' . number_format($orderItem->price,2,'.',','));
            }
        }
            $paidOrderUpcoming = Order::where('foodie_id', '=', Auth::guard('foodie')->user()->id)->where('is_paid', '=', 1)
                ->where('created_at', '>', $lastSaturday)
                ->latest()->first();
//        }

            $orderItemsUp = [];
//        dd($lastSaturday);
            $orderItemArrayUpcoming = [];
            if ($paidOrderUpcoming != null) {
                $orderItemsUpcoming = $paidOrderUpcoming->order_item()->get();
                foreach ($orderItemsUpcoming as $orderItem) {
                    $orderPlan = "";
                    $planName = "";
                    $chefName = "";
                    $orderType = "";
                    if ($orderItem->order_type == 0) {
                        $orderPlan = Plan::where('id', '=', $orderItem->plan_id)->first();
                        $planName = $orderPlan->plan_name;
                        $chefName = $orderPlan->chef->name;
                        $orderType = "Standard";
                    } elseif ($orderItem->order_type == 1) {
                        $orderPlan = CustomPlan::where('id', '=', $orderItem->plan_id)->first();
                        $planName = $orderPlan->plan->plan_name;
                        $chefName = $orderPlan->plan->chef->name;
                        $orderType = "Customized";
                    }elseif ($orderItem->order_type == 2) {
                        $orderPlan = SimpleCustomPlan::where('id', '=', $orderItem->plan_id)->first();
                        $planName = $orderPlan->plan->plan_name;
                        $chefName = $orderPlan->plan->chef->name;
                        $orderType = "Customized";
                    }

                    $orderItemArrayUpcoming[] = array('id' => $orderItem->id, 'order_id' => $orderItem->order_id, 'plan_id' => $orderItem->plan_id,
                        'plan' => $planName, 'chef' => $chefName, 'type' => $orderType, 'quantity' => $orderItem->quantity, 'price' => 'PHP' . number_format($orderItem->price,2,'.',','));
                }
            }
//        dd($paidOrderCount);
//      for message dropdown
            $chefs = Chef::all();
            $chats = Chat::where('foodie_id', '=', $foodie)->where('foodie_can_see','=',1)->latest($column = 'updated_at')->get();
            $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
                ->where('receiver_type', '=', 'f')
                ->where('foodie_can_see','=',1)->where('is_read', '=', 0)->get();
//        dd($messages);
//      Ratings Stuff

            $ordersRating = Order::where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                ->where('is_paid', '=', 1)
                ->where('is_cancelled', '=', 0)
                ->where('created_at', '<', $lastTwoWeeks)
//                ->where('created_at', '>=', $lastTwoWeeks)
//                ->where('created_at', '<', $lastSaturday)
                ->latest($column = 'created_at')->take(3)
                ->get();

//            dd($ordersRating);

            $ordersRatingPlans= [];
            foreach($ordersRating as $order){
                $orderItems = $order->order_item()->get();
                foreach($orderItems as $orderItem){
                    if(!is_null($orderItem->rating)){
                        if($orderItem->rating->is_rated==0){
                            $orderPlan = "";
                            $type="";
                            $planName = "";
                            if ($orderItem->order_type == 0) {
                                $orderPlan = Plan::where('id', '=', $orderItem->plan_id)->first();
                                $planName = $orderPlan->plan_name;
                                $type="Standard";
                            } elseif ($orderItem->order_type == 1) {
                                $orderPlan = CustomPlan::where('id', '=', $orderItem->plan_id)->first();
                                $planName = $orderPlan->plan->plan_name;
                                $type="Customized";
                            } elseif ($orderItem->order_type == 2) {
                                $orderPlan = SimpleCustomPlan::where('id', '=', $orderItem->plan_id)->first();
//                                dd($orderItem);
                                $planName = $orderPlan->plan->plan_name;
                                $type="Customized";
                            }
                            $ordersRatingPlans[] = array('plan_name'=>$planName,'type'=>$type);
                        }
                    }
                }
            }


//        dd($ordersRating);
//        if ($ratingsCount > 0) {
//            $ratings = Rating::where('order_id', '=', $ordersRating->id)->where('is_rated', '=', 0)->get();
//        }

            if ($addressCount > 0) {
                $foodieAddress = DB::table('foodie_address')->where('foodie_id', '=', Auth::guard('foodie')->user()->id)->get();
//            dd($foodieAddress[0]);
            }

//           Notifications

            $notifications = Notification::where('receiver_id', '=', $foodie)->where('receiver_type', '=', 'f')->get();
            $unreadNotifications = Notification::where('receiver_id', '=', $foodie)->where('receiver_type', '=', 'f')->where('is_read', '=', 0)->count();

            $incomplete=SimpleCustomPlan::where('foodie_id','=',$foodie)->where('created_at','>',$lastSaturday)->latest()->take(3)->get();
            $orders = Order::where('foodie_id','=',$foodie)->latest()->take(3)->get();


            $incompArray = [];

            foreach($incomplete as $item){
                $orderItemsCount=0;
                foreach($orders as $order){
                    $orderItemsCount=$order->order_item()
                    ->where('plan_id','=',$item->id)
                    ->where('order_type','=',2)->count();
                    if($orderItemsCount){
                        break;
                    }
                }
                if($orderItemsCount){
//                        break;
                }else{
                    $incompArray[]= [
                        'id'=>$item->id,
                        'name'=>$item->plan->plan_name,
                    ];
//                        break;
                }
            }

//            dd($incompArray);

            return view('foodie.dashboard')->with([

                'sms_unverified' => $this->smsIsUnverified(),
                'foodie' => Auth::guard('foodie')->user(),
                'chefs' => $chefs,
                'orders' => $orders,
                'orderArray' => $orderArray,
                'orderItemArray' => $orderItemArray,
                'orderItemArrayUpcoming' => $orderItemArrayUpcoming,
                'ordersRatingPlans'=>$ordersRatingPlans,
                'mealPlans' => $mealPlans,
                'mealPlansUpcoming' => $mealPlansUpcoming,
                'chats' => $chats,
                'messages' => $messages,
                'notifications' => $notifications,
                'unreadNotifications' => $unreadNotifications,
                'successPayment' => 'false',
                'ordersRating' => $ordersRating,
                'thisWeek' => $startOfTheWeek,
                'nextWeek' => $nextWeek,
                'addressCount' => $addressCount,
                'foodieAddress' => $foodieAddress,
                'suggested' => $suggested,
                'paidOrder' => $paidOrder,
                'paidOrderUpcoming' => $paidOrderUpcoming,
                'incompArray'=>$incompArray
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
        $chats= Chat::where('foodie_id','=',$foodie)->where('foodie_can_see','=',1)->latest($column = 'updated_at')->get();
        $addresses = DB::table('foodie_address')->where('foodie_id', '=', Auth::guard('foodie')->user()->id)->get();
        $allergies = Allergy::where('foodie_id', Auth::guard('foodie')->user()->id)->select('allergy')->get();
//        dd($allergies->where('allergy','=','chicken')->count() && $allergies->where('allergy','=','beef')->count()
//            && $allergies->where('allergy','=','pork')->count() && $allergies->where('allergy','=','seafood')->count());
        $preference = FoodiePreference::where('foodie_id', Auth::guard('foodie')->user()->id)->first();
        $chefs = Chef::all();
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)
            ->where('receiver_type', '=', 'f')
            ->where('foodie_can_see','=',1)->where('is_read','=',0)->get();
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

        //           Notifications

        $notifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->get();
        $unreadNotifications=Notification::where('receiver_id','=',$foodie)->where('receiver_type','=','f')->where('is_read','=',0)->count();
        return view('foodie.profile')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
            'addresses' => $addresses,
            'allergies' => $allergies,
            'allergyJson' => $allergyJson,
            'preference' => $preference,
            'chats' => $chats,
            'notifications'=>$notifications,
            'unreadNotifications'=>$unreadNotifications,
            'messages' => $messages,
            'chefs' => $chefs
        ]);
    }

    public function getID()
    {
        return Auth::guard($this->guard)->user()->id;
    }

    public function getMobile($mobile)
    {
        $mobileNum=Foodie::select('mobile_number')->where('mobile_number','=',$mobile)->count();
        if($mobileNum){
            return "true";
        }
        return "false";
    }
    
    public function saveProfileCoverPhoto(Request $request)
    {
//        dd($request->file('cover')->isValid());
        $validator = Validator::make($request->all(), [
            'cover' => 'required|image|mimes:jpeg,jpg,png,bmp',
        ]);
        $validator->validate();


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
            'avatar' => 'image|mimes:jpeg,jpg,png,bmp',
//            'username' => 'max:20|unique:foodies',
//            'mobile' => 'required|digits:10|unique:foodies',
        ])->validate();

//        dd($request['mobile']);

        $foodie = Auth::guard('foodie')->user();
        $foodie->first_name = $request['first_name'];
        $foodie->last_name = $request['last_name'];
        $foodie->gender = $request['gender'];
        if($request['mobile']!=null){
        $foodie->mobile_number=$request['mobile'];
        }
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
        $foodieCount=Foodie::where('username','=',$foodie->username)->count();

        $foodie->birthday = $request['birthday'];
        if($request['username']==""){
            $foodie->username = null;
        }else if($request['username']!=$foodie->username){
            $foodie->username = $request['username'];
        }
        $foodie->save();

        return redirect()->route('foodie.profile')->with(['status' => 'Successfully updated the info!']);

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
            'remarks' => 'max:255',
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
        return redirect()->route('foodie.profile')->with(['status' => 'Successfully updated the info!']);
    }

    public function getUserName($name)
    {
        if($name=='n'){
            return "false";
        }
        $foodieCount=Foodie::select('username')->where('username','=',$name)->count();
        if($foodieCount){
            return "true";
        }
        return "false";
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

        return redirect()->route('foodie.profile')->with(['status' => 'Successfully updated the info!']);


    }

    public function deleteProfileAddress($id)
    {
        DB::table('foodie_address')
            ->where('id', '=', $id)
            ->delete();
        return redirect()->route('foodie.profile')->with(['status' => 'Successfully deleted the address!']);

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

                $allrgVal=strtolower($value);
                if($allrgVal=='eggs'){
                    $allrgVal='egg';
                }
//                dd($allrgVal);
                /*~~~ eloquent model method for checking existence ~~~*/
                if (Allergy::where([
                        ['foodie_id', '=', Auth::guard('foodie')->user()->id],
                        ['allergy', '=', $allrgVal]
                    ])->count() == 0
                ) {

                    /*~~~ eloquent model method for getting allergies ~~~*/
                    $allergy = new Allergy;
                    $allergy->foodie_id = Auth::guard('foodie')->user()->id;
                    $allergy->allergy = $allrgVal;
                    $allergy->save();

//                    $pref = FoodiePreference::where('foodie_id','=', Auth::guard('foodie')->user()->id)->first();
//
//                    if($pref->count()){
//                        if($allrgVal=='chicken' && $pref=='chicken'){
//                            $pref->delete();
//                        }else if($allrgVal=='beef' && $pref=='beef'){
//                            $pref->delete();
//                        }else if($allrgVal=='pork' && $pref=='pork'){
//                            $pref->delete();
//                        }else if($allrgVal=='seafood' && $pref=='seafood'){
//                            $pref->delete();
//                        }
//                    }


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

                    $pref = FoodiePreference::where('foodie_id','=', Auth::guard('foodie')->user()->id)->first();
//                    dd($pref);
                    if($pref!= null && ($pref->ingredient!=null || $pref->ingredient!="")){
                        if($key=='chicken' && $pref->ingredient=='chicken'){
                            $pref->delete();
                        }else if($key=='beef' && $pref->ingredient=='beef'){
//                            dd('beef');
                            $pref->delete();
                        }else if($key=='pork' && $pref->ingredient=='pork'){
                            $pref->delete();
                        }else if($key=='seafood' && $pref->ingredient=='seafood'){
                            $pref->delete();
                        }
                    }


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


        return redirect()->route('foodie.profile')->with(['status' => 'Successfully updated the info!']);
    }

    public function saveProfilePreferences(Request $request)
    {

        Validator::make($request->all(), [
            'foodPref' => 'required',
        ])->validate();

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

        return redirect()->route('foodie.profile')->with(['status' => 'Successfully updated the info!']);
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
//                        dd($mealPlan);
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

    public function getNotif()
    {
        $i=0;
        $foodie = Auth::guard('foodie')->user()->id;
        $notification = Notification::where('receiver_id','=', $foodie)->where('receiver_type','=','f')->latest($column='created_at')->take(5)->get();
        $notifJson = '[';
        foreach($notification as $note){
            if(++$i<$notification->count()){
                $notifJson.='{ "id":"'.$note->id.'", "notification":"'.$note->notification.'", "is_read":"'.$note->is_read.'", "notification_type":"'.$note->notification_type.'", "created_at":"'.$note->created_at->format('d F,  H:ia').'"},';
            }else{
                $notifJson.='{ "id":"'.$note->id.'", "notification":"'.$note->notification.'", "is_read":"'.$note->is_read.'", "notification_type":"'.$note->notification_type.'", "created_at":"'.$note->created_at->format('d F,  H:ia').'"} ';
            }
        }
        $notifJson .= ']';

        return $notifJson;
    }

    public function clearNotifAll()
    {
        $foodie = Auth::guard('foodie')->user()->id;
        $notifications = Notification::where('receiver_id','=', $foodie)->where('receiver_type','=','f')->latest($column='created_at')->take(5)->get();
        foreach($notifications as $notification){
            $notification->is_read=1;
            $notification->save();
        }
        return null;
    }

    public function clearNotif()
    {
        $clearId = $_GET['id'];
        $clearNotif= Notification::where('id','=',$clearId)->first();
        $clearNotif->is_read=1;
        $clearNotif->save();

        return null;
    }

    public function notSave()
    {
        return redirect()->route('foodie.profile');
    }
}

