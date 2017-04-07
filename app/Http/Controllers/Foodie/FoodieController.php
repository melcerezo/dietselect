<?php

namespace App\Http\Controllers\Foodie;


use App\CustomizedMeal;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use App\Order;
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
        $orders='';
        $ordersCount=Order::where('foodie_id', '=', Auth::guard('foodie')->user()->id)->where('is_paid','=',0)->get()->count();

        if($ordersCount >0){
            $orders = Order::where('foodie_id', '=', Auth::guard('foodie')->user()->id)->where('is_paid','=',0)->get();
        }
        $messages= Message::where('receiver_id','=',Auth::guard('foodie')->user()->id)
            ->where('receiver_type','=','f')->get();

        return view('foodie.dashboard')->with([

            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
            'orders' => $orders,
            'ordersCount' => $ordersCount,
            'messages'=> $messages,
            'successPayment'=> 'false'
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
        $allergies = Allergy::where('foodie_id',Auth::guard('foodie')->user()->id)->get();
        $preference = FoodiePreference::where('foodie_id',Auth::guard('foodie')->user()->id)->first();
        $messages = Message::where('receiver_id', '=', Auth::guard('foodie')->user()->id)->where('receiver_type', '=', 'f')->get();

        return view('foodie.profile')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
            'addresses' => $addresses,
            'allergies' => $allergies,
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
           // 'unit' => 'required|max:100',
            'street' => 'required|max:100',
           // 'bldg' => 'required|max:100',
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

    public function updateAddress(Request $request){
        Validator::make($request->all(), [
            'city'=> 'required|max:100',
            // 'unit' => 'required|max:100',
            'street' => 'required|max:100',
            // 'bldg' => 'required|max:100',
            'brgy' => 'required|max:100',
            'type' => 'required|max:100',
            // 'company' => 'required|max:100',
            // 'landmark' => 'required|max:100',
            //'remarks' => 'required|max:100',
        ])->validate();
    }

    public function deleteAddress(){
        //
    }

    public function saveProfileAllergies(Request $request)
    {

       // print_r($request['others']);die();
       // print_r($otherAllergiesArray);die();

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
            }
       }

       $otherAllergiesInput = $request->input('others');
       if($otherAllergiesInput!="") {

           $otherAllergiesArray = explode(',', $otherAllergiesInput);

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


}