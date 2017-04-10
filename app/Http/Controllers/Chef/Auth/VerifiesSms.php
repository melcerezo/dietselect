<?php

namespace App\Http\Controllers\Chef\Auth;

use App\Chef;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait VerifiesSms
{
    /**
     * The name of the verification table
     */
    protected $smsVerificationTable = 'sms_verification';

    /**
     * The Auth Guard used for authentication
     * Default: empty
     */
    protected $guard = 'chef';

    /**
     * Creates a new verification code and assigns it to
     * the mobile number.
     */
    public function createsSmsVerification()
    {
        $code = $this->createsNewCode();

        if (!$this->mobileNumberExists()) {
            $this->insertsMobileNumberIntoVerification($code);
        }

        $this->sendsTheSms($code);
    }

    /**
     * Securely creates a random string for verification purposes
     *
     * @param $length - Sets the length of the string to be generated
     * @param string $keyspace - Sets the possible characters to be included in the generated string
     * @return string - The generated verification code
     */
    public function createsNewCode($length = 6, $keyspace = '0123456789')
    {
        $str = '';
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $str .= $keyspace[random_int(0, $max)];
        }

        return $str;
    }

    /**
     * Insert the current mobile number to the verification table
     *
     * @param $code - Verification Code to be assigned to the user
     * @return bool - True if query was successful, otherwise, false.
     */
    public function insertsMobileNumberIntoVerification($code)
    {
        return DB::table($this->smsVerificationTable)->insert([
            'mobile_number' => $this->mobile_number(),
            'code' => $code,
            'created_at' => new DateTime()
        ]);
    }

    /*
     * code for sending sms
     *
     * */

    public function sendsTheSms($code)
    {
//        //code for sms sending ges here
//        $url = 'https://www.itexmo.com/php_api/api.php';
//        $itexmo = array('1' => '09266578810', '2' => $code, '3' => 'ST-MARKK578810_4MXKV');
//        $param = array(
//            'http' => array(
//                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
//                'method' => 'POST',
//                'content' => http_build_query($itexmo),
//            ),
//        );
//        $context = stream_context_create($param);
//        file_get_contents($url, false, $context);

        $url = 'https://www.itexmo.com/php_api/api.php';
        $itexmo = array('1' => '09266578810', '2' => $code, '3' => 'ST-MARKK578810_4MXKV');
        $param = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($itexmo),
            ),
            'ssl' => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );
        $context  = stream_context_create($param);
        file_get_contents($url, false, $context);

    }

    /**
     * Creates a new verification code and updates
     * the mobile number's code in the database.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendNewVerificationCode()
    {
        $code = $this->createsNewCode();

        if ($this->mobileNumberExists()) {
            $this->updateAssignedCode($code);
        }
        else {
            $this->insertsMobileNumberIntoVerification($code);
        }
        //$response = $this->sendSms($foodie);
        $response = "Successfully sent new SMS Code!";
        return back()->with(['status' => $response]);
    }

    /**
     * Checks the verification table if the authenticated
     * user exists in its mobile number column.
     *
     * @return boolean
     */
    public function mobileNumberExists()
    {
        return DB::table($this->smsVerificationTable)->where(
            'mobile_number', $this->mobile_number()
        )->exists();
    }

    /**
     * Updates the verification code assigned to the user
     *
     * @param $code
     * @return integer - number of rows affected
     */
    public function updateAssignedCode($code)
    {
        return DB::table($this->smsVerificationTable)->where('mobile_number', $this->mobile_number())->update([
            'code' => $code,
            'created_at' => new DateTime()
        ]);
    }

    /**
     * Accepts the data from the verification form then
     * verifies the user.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifySms(Request $request)
    {
        $this->validate($request, [
            'verification_code' => 'required',
        ]);

        if ($this->mobileNumberExists()) {
            $code = $this->getAssignedCode();
            if ($code == $request['verification_code']) {
                return back()->with(['status' =>
                    ($this->removeVerificationRecord())?
                        'Mobile number successfully verified!' :
                        'Something went wrong while verifying your mobile number. Please try again in short while!'
                ]);
            }
            return $this->sendFailedVerificationResponse();
        }
        return back()->with(['status' => 'We did not find your account in our records.']);
    }

    public function getAssignedCode()
    {
        return DB::table($this->smsVerificationTable)->where([
            'mobile_number' => $this->mobile_number()
        ])->value('code');
    }

    public function removeVerificationRecord()
    {
        return DB::table($this->smsVerificationTable)->where([
            'mobile_number' => $this->mobile_number()
        ])->delete();
    }

    /**
     * Get the failed verification response instance.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedVerificationResponse()
    {
        return redirect()->back()
            ->withErrors([
                'verification_code' => 'The code did not match our records.',
            ]);
    }


    /**
     * Returns the currently authenticated user
     *
     * @return Chef
     */
    public function mobile_number()
    {
        return Auth::guard($this->guard)->user()->mobile_number;
    }
}