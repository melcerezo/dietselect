<?php

namespace App\Http\Controllers\Foodie;


use App\CustomizedMeal;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use App\MealPlan;
use App\Order;
use App\Plan;
use App\Rating;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Validator;
use DateTime;
use App\Allergy;
use App\FoodiePreference;

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
        $orders=0;
        $ordersRating=0;
        $ratingsCount=0;
        $ratings=0;
        $ordersCount=Order::where('foodie_id', '=', Auth::guard('foodie')->user()->id)->where('is_paid','=',0)->get()->count();

        if($ordersCount >0){
            $orders = Order::where('foodie_id', '=', Auth::guard('foodie')->user()->id)->where('is_paid','=',0)->get();
        }
        $messages= Message::where('receiver_id','=',Auth::guard('foodie')->user()->id)
            ->where('receiver_type','=','f')->get();

//      Ratings Stuff
        $ordersRatingCount = Order::where('foodie_id', '=', Auth::guard('foodie')->user()->id)
            ->where('is_paid','=',1)
            ->orderBy('created_at', 'desc')->get()->count();
        if($ordersRatingCount){
            $ordersRating = Order::where('foodie_id', '=', Auth::guard('foodie')->user()->id)
                ->where('is_paid','=',1)
                ->orderBy('created_at', 'desc')->first();
                $ratingsCount= Rating::where('order_id','=',$ordersRating->id)->where('is_rated','=',0)->get()->count();
        }
        if($ratingsCount>0){
            $ratings= Rating::where('order_id','=',$ordersRating->id)->where('is_rated','=',0)->get();
        }

        return view('foodie.dashboard')->with([

            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
            'orders' => $orders,
            'ordersCount' => $ordersCount,
            'messages'=> $messages,
            'successPayment'=> 'false',
            'ordersRating'=>$ordersRating,
            'ratings'=>$ratings,
            'ratingsCount'=>$ratingsCount
        ]);
    }


    /**
     * Show the foodie profile.
     *
     * @return \Illuminate\Contracts\View\View;
     */
    public function profile()
    {
        $addresses = DB::table('foodie_address')->where('foodie_id','=',Auth::guard('foodie')->user()->id)->get();
        $allergies = Allergy::where('foodie_id',Auth::guard('foodie')->user()->id)->select('allergy')->get();
        $preference = FoodiePreference::where('foodie_id',Auth::guard('foodie')->user()->id)->first();
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)->where('receiver_type', '=', 'f')->get();
        $allergyJson = '[';
        $i=0;
        foreach($allergies as $allergy){
            if(++$i<$allergies->count()){
                $allergyJson .= '{"allergy": "'.$allergy->allergy.'"},';
            }else{
                $allergyJson .= '{"allergy": "'.$allergy->allergy.'"}';
            }
        }
        $allergyJson .=']';
//        dd($allergyJson);
        return view('foodie.profile')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
            'addresses' => $addresses,
            'allergies' => $allergies,
            'allergyJson'=>$allergyJson,
            'preference' => $preference,
            'messages'=>$messages
        ]);
    }

    public function getID()
    {
        return Auth::guard($this->guard)->user()->id;
    }

    /**
     * Handle a registration request for the application.
     *
     *
     *
     * @param  \Illuminate\Http\Request  $request
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
            'username' =>'max:20'
        ])->validate();


        $foodie=Auth::guard('foodie')->user();
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

        return redirect($this->redirectTo)->with(['status'=>'Successfully updated the info!']);

    }

    public function saveProfileAddress (Request $request)
    {

        Validator::make($request->all(), [
            'city'=> 'required|max:100',
            'unit' => 'required|max:100',
            'street' => 'required|max:100',
//            'bldg' => 'required|max:100',
            'brgy' => 'required|max:100',
            'type' => 'required|max:100',
           // 'company' => 'required|max:100',
           // 'landmark' => 'required|max:100',
            //'remarks' => 'required|max:100',
        ])->validate();


        $result=  DB::table('foodie_address')->insert([
            'city'=> $request['city'],
            'unit'=> $request['unit'],
            'street'=>$request['street'],
            'bldg'=>$request['bldg'],
            'brgy'=>$request['brgy'],
            'type'=>$request['type'],
            'company'=>$request['company'],
            'landmark'=>$request['landmark'],
            'remarks'=>$request['remarks'],
            'created_at'=>new DateTime(),
            'updated_at'=>new DateTime(),
            'foodie_id'=>Auth::guard('foodie')->user()->id,


        ]);
            return redirect($this->redirectTo)->with(['status' => 'Successfully updated the info!']);
    }

    public function updateProfileAddress(Request $request,$id){
        Validator::make($request->all(), [
            'city'=> 'required|max:100',
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
            ->where('id','=',$id)
            ->update(
                [
                    'city'=>$request['city'],
                    'unit'=> $request['unit'],
                    'street'=>$request['street'],
                    'bldg'=>$request['bldg'],
                    'brgy'=>$request['brgy'],
                    'type'=>$request['type'],
                    'company'=>$request['company'],
                    'landmark'=>$request['landmark'],
                    'remarks'=>$request['remarks'],
                ]
            );

        return redirect($this->redirectTo)->with(['status' => 'Successfully updated the info!']);


    }

    public function deleteProfileAddress($id){
        DB::table('foodie_address')
            ->where('id','=',$id)
            ->delete();
        return redirect($this->redirectTo)->with(['status' => 'Successfully deleted the address!']);

    }

    public function saveProfileAllergies(Request $request)
    {

       // print_r($request['others']);die();
       // print_r($otherAllergiesArray);die();

        $otherAllergiesInput = $request->input('others');
        if($otherAllergiesInput!="") {

            $otherAllergiesArray = explode(',', $otherAllergiesInput);
            $prevAllergies= Allergy::where('foodie_id','=',Auth::guard('foodie')->user()->id)->get();

            foreach($prevAllergies as $prevAllergy){
//               dd($otherAllergiesArray);
                if(!in_array($prevAllergy->allergy,$otherAllergiesArray)){
                    $allergyDelete= $prevAllergy;
                    $allergyDelete->delete();
                }

            }

            foreach ($otherAllergiesArray as $key => $value) {

                /*~~~ eloquent model method for checking existence ~~~*/
                if (Allergy::where([
                        ['foodie_id','=',Auth::guard('foodie')->user()->id],
                        ['allergy','=',$value]
                    ])->count()==0) {

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

            if($value=="1") {

                /*~~~ eloquent model method for checking existence ~~~*/
                if(Allergy::where([
                    ['foodie_id','=',Auth::guard('foodie')->user()->id],
                    ['allergy','=',$key]
                ])->count()==0) {

                   /*~~~ eloquent model method for getting allergies ~~~*/
                    $allergy=new Allergy;
                    $allergy->foodie_id = Auth::guard('foodie')->user()->id ;
                    $allergy->allergy = $key;
                    $allergy->save();

                   //print_r($allergy);die('set the allergy model');
                }
            }else{
                if(Allergy::where([
                        ['foodie_id','=',Auth::guard('foodie')->user()->id],
                        ['allergy','=',$key]
                    ])->count()>0){
                    $allergy= Allergy::where([
                        ['foodie_id','=',Auth::guard('foodie')->user()->id],
                        ['allergy','=',$key]
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

        if(!FoodiePreference::where([
                ['foodie_id','=',Auth::guard('foodie')->user()->id]
            ])->exists()){

            $preference = new FoodiePreference;
            $preference->foodie_id= Auth::guard('foodie')->user()->id;
            $preference->ingredient = $ingredient;
        } else {
            $preference = FoodiePreference::where('foodie_id', Auth::guard('foodie')->user()->id)->first();
            $preference->ingredient = $ingredient;
//            $preference->save();
        }
        $preference->save();

        return redirect($this->redirectTo)->with(['status' => 'Successfully updated the info!']);
    }

    public function countPreferences()
    {
        # Meals
        // GET ALL THE PLANS

        // GET THE MEAL PLAN OF THE PLANS AND GET THE MEAL -> MAIN_INGREDIENT

        // MAIN_INGREDIENT -> COUNT EACH (beef, chicken, pork, vegetables, fruits)

        // MAIN_INGREDIENT COMPARE TO FOODIE_PREFERENCES

        $plans = Plan::all();

        $foodiePreference = FoodiePreference::where('foodie_id', '=', $foodie)->first()->ingredient;
//        dd($foodiePreference);
        foreach ($plans as $plan) {

            $mealPlan = MealPlan::where('plan_id', '=', $plan->id)->get();

            $chicken = $mealPlan[0]->meal->where('main_ingredient', 'chicken')->count();
            $beef = $mealPlan[0]->meal->where('main_ingredient', 'beef')->count();
            $pork = $mealPlan[0]->meal->where('main_ingredient', 'pork')->count();
            $seafood = $mealPlan[0]->meal->where('main_ingredient', 'seafood')->count();

//            dd($foodiePreference->ingredient);
            if ($chicken >= $beef && $chicken >= $pork && $chicken >= $seafood) {
                if ($foodiePreference == 'chicken') {
                    dd('Suggested ingredient: Chicken');
//                    break;
                } else {
                    dd('this is chicken');
                }
            } elseif ($beef >= $chicken && $beef >= $pork && $beef >= $seafood) {
                if ($foodiePreference == 'beef') {
                    dd('Suggested ingredient: Beef');
//                    break;
                } else {
                    dd('this is beef');
                }
            } elseif ($pork >= $chicken && $pork >= $beef && $pork >= $seafood) {
                if ($foodiePreference == 'pork') {
                    dd('Suggested ingredient: Pork');
//                    break;
                }else {
                    dd('this is pork');
                }
            } elseif ($seafood >= $chicken && $seafood >= $pork && $seafood >= $beef) {
                if ($foodiePreference == 'seafood') {
                    dd('Suggested ingredient: Seafood');
//                    break;
                } else {
                    dd('this is seafood');
                }
            }
        }

//            elseif ($mealPlan[0]->meal->where('main_ingredient', 'vegetables')->count() == $foodiePreference->where('ingredient', 'vegetables')->count()) {
//            } elseif ($mealPlan[0]->meal->where('main_ingredient', 'fruits')->count() == $foodiePreference->where('ingredient', 'fruits')->count());

        die('here');

        $dt = \Carbon\Carbon::now()->addDays(5);

        if ($dt->isWeekday()) {
            return 'Monday';
        } else {
            return 'Weekend';
        }
    }

    public function suggested($plans)
    {

    }
}