<?php

namespace App\Http\Controllers\Foodie;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Foodie\Auth\VerifiesSms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use DateTime;
use App\Allergy;
use App\Foodie_Preference;

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
        return view('foodie.dashboard')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
        ]);
    }


    /**
     * Show the foodie profile.
     *
     * @return \Illuminate\Contracts\View\View;
     */
    public function profile()
    {
        $address= DB::table('foodie_address')->where('foodie_id','=',Auth::guard('foodie')->user()->id)->get();
        //print_r used to see the array $address
       // print_r($address);die('finished setting the address array');
        $addressArray= json_decode(json_encode($address),true);
        /*~~~ eloquent query for allergies ~~~*/
        $allergies = Allergy::where('foodie_id',Auth::guard('foodie')->user()->id)->get();
        /*~~~ eloquent query for food preferences ~~~*/
        $preferences = Foodie_Preference::where('foodie_id',Auth::guard('foodie')->user()->id)->get();
        /*
         * used to check out what $allergies array holds
         * print_r($allergies);die('set the allergies model query');
         * used to check out what $preferences array holds
         * print_r($preferences);die('set the preferences model query');
         *
         */

        /*
         * old method of getting allergies and food preferences
         * $allergyResultArray= DB::table('allergies')->where('foodie_id','=',Auth::guard('foodie')->user()->id)->get();
         * old method of getting food preference
         * $foodPrefResultArray= DB::table('foodie_preferences')->where('foodie_id','=',Auth::guard('foodie')->user()->id)->get();
         *
         */
        return view('foodie.profile')->with([
            'sms_unverified' => $this->smsIsUnverified(),
            'foodie' => Auth::guard('foodie')->user(),
            'address' => array(
                'city' => $addressArray[0]['city'],
                'unit' => $addressArray[0]['unit'],
                'street' => $addressArray[0]['street'],
                'bldg' => $addressArray[0]['bldg'],
                'brgy' => $addressArray[0]['brgy'],
                'type' => $addressArray[0]['type'],
                'company' => $addressArray[0]['company'],
                'landmark' => $addressArray[0]['landmark'],
                'remarks' => $addressArray[0]['remarks'],
            ),

        ]);
        //Past attempt which resolves into undefined index
        //->with('address',$resultArray);

    }

    public function getID()
    {
        return Auth::guard($this->guard)->user()->id;
    }
    /**
     * Handle a registration request for the application.
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
        ])->validate();


        $foodie=Auth::guard('foodie')->user();
        $foodie->first_name = $request['first_name'];
        $foodie->last_name = $request['last_name'];
        $foodie->gender = $request['gender'];


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

    public function saveProfileAllergies(Request $request)
    {

       // print_r($request['others']);die();


       // print_r($otherAllergiesArray);die();

       foreach ($request->except('others') as $key => $value)
       {

            if($value=="1") {

                //$ingred = DB::table('ingredients')->where('description', $key)->value('id');
                $ingred=$key;
                //print_r($ingred);die();

                /*~~~ old method for checking existence ~~~*/
//                $alreadyExists = DB::table('allergies')
//                    ->where('foodie_id','=',Auth::guard('foodie')->user()->id)
//                    ->where('ingredient_id','=',$ingred)->first();

                /*~~~ eloquent model method for checking existence ~~~*/
                if(Allergy::where([
                    ['foodie_id','=',Auth::guard('foodie')->user()->id],
                    ['ingredient_id','=',$ingred]
                ])->count()==0) {

                   /*~~~ eloquent model method for getting allergies ~~~*/
                    $allergy=new Allergy;
                    $allergy->foodie_id= Auth::guard('foodie')->user()->id ;
                    $allergy->ingredient_id= $ingred;
                    $allergy->save();

                   //print_r($allergy);die('set the allergy model');

                   /*~~~ old method for getting allergy ~~~*/
//                    $result = DB::table('allergies')->insert([
//
//                        'foodie_id' => Auth::guard('foodie')->user()->id,
//                        'ingredient_id' => $ingred,
//                        'created_at' => new DateTime(),
//                        'updated_at' => new DateTime(),
//
//                    ]);
                }
//                else {
//                    die('already exists');
//                }

            }
       }

        $otherAllergiesInput = $request->input('others');
       if($otherAllergiesInput!="") {



           $otherAllergiesArray = explode(',', $otherAllergiesInput);

           foreach ($otherAllergiesArray as $key => $value) {
               $ingred = $value;

               /*~~~ old method for checking existence ~~~*/

//               $otherAlreadyExists = DB::table('allergies')
//                   ->where('foodie_id', '=', Auth::guard('foodie')->user()->id)
//                   ->where('ingredient_id', '=', $ingred)->first();


               //if there is no record of the user checking the ingredient checkbox as an allergy, save the record
               /*~~~ eloquent model method for checking existence ~~~*/
               if (Allergy::where([
                       ['foodie_id','=',Auth::guard('foodie')->user()->id],
                       ['ingredient_id','=',$ingred]
                   ])->count()==0) {

                   /*~~~ eloquent model method for getting allergies ~~~*/

                   $allergy=new Allergy;
                   $allergy->foodie_id= Auth::guard('foodie')->user()->id ;
                   $allergy->ingredient_id= $ingred;
                   $allergy->save();



                   /*~~~ old method for getting allergy ~~~*/

//                   $result = DB::table('allergies')->insert([
//                       'foodie_id' => Auth::guard('foodie')->user()->id,
//                       'ingredient_id' => $ingred,
//                       'created_at' => new DateTime(),
//                       'updated_at' => new DateTime(),
//
//                   ]);
               }

           }
       }

        return redirect($this->redirectTo)->with(['status' => 'Successfully updated the info!']);
    }

    public function saveProfilePreferences(Request $request)
    {
        foreach ($request->all() as $key => $value)
        {

            if($value=="1") {

                $ingred=$key;

                /*~~~ old method for checking if exists ~~~*/
//                $alreadyExists = DB::table('foodie_preferences')
//                    ->where('foodie_id','=',Auth::guard('foodie')->user()->id)
//                    ->where('ingredient','=',$ingred)->first();


                /*~~~ eloquent model method for checking existence ~~~*/

                if(Foodie_Preference::where([
                        ['foodie_id','=',Auth::guard('foodie')->user()->id],
                        ['ingredient','=',$ingred]
                    ])->count()==0){

                    $preference= new Foodie_Preference;
                    $preference->foodie_id= Auth::guard('foodie')->user()->id;
                    $preference->ingredient= $ingred;
                    $preference->save();



                    /*~~~ old method for insert into foodie_preference table ~~~*/
//                    $result = DB::table('foodie_preferences')->insert([
//                         'foodie_id' => Auth::guard('foodie')->user()->id,
//                         'ingredient' => $ingred,
//                         'created_at' => new DateTime(),
//                         'updated_at' => new DateTime(),
//
//                     ]);

                }

            }
        }

        return redirect($this->redirectTo)->with(['status' => 'Successfully updated the info!']);
    }


    //intended for arrays of allergies and foodie_preferences
    //->with(array('allergies',$allergyResultArray))->with(array('foodie_preferences',$foodPrefResultArray));
}