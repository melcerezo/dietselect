<?php

namespace App\Http\Controllers\Admin;

use App\Chef;
use DateTime;
use App\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait VerifiesEmailChef
{

    /**
     * The name of the verification table
     */
    protected $emailVerificationTable = 'email_verification';

//    protected $loginRouteName = 'chef.login.show';

    protected $guardName = 'chef';

    /**
     * Creates a new verification token and assigns it to the user.
     * @param $email
     */
    public function createsEmailVerification($email)
    {
        $token = $this->createsNewToken();

        if (! $this->emailExists($email)) {
            $this->insertsEmailIntoVerificationRecord($email, $token);
        }

        $this->sendsTheEmail($token);
    }

    /**
     * Create a new token for the user.
     *
     * @return string
     */
    protected function createsNewToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    /**
     * Insert the current user to the verification table
     *
     * @param $email
     * @param $token - Verification token to be assigned to the user
     * @return bool - True if query was successful, otherwise, false.
     */
    public function insertsEmailIntoVerificationRecord($email, $token)
    {
        return DB::table($this->emailVerificationTable)->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => new DateTime()
        ]);
    }

    /**
     * Send the email notification to the user
     *
     * @param $token - Verification token to be assigned to the user
     * @return bool - True if query was successful, otherwise, false.
     */
    public function sendsTheEmail($token)
    {
        $this->guard()->user()->notify(new VerifyEmail($token));
    }

    /**
     * Creates a new verification token and updates
     * the user's token in the database.
     *
     * @param $email
     * @return \Illuminate\Http\Response
     */
    public function sendNewVerificationToken($email)
    {
        do {
            $token = $this->createsNewToken();
        } while ($this->tokenExists($token));


        if ($this->emailExists($email)) {
            $this->updateAssignedToken($token);
        }
        else {
            $this->insertsEmailIntoVerificationRecord($email, $token);
        }

        $this->sendsTheEmail($token);

        $response = "Successfully sent new email verification!";
        return back()->with(['status' => $response]);
    }

    /**
     * Checks the verification table if the authenticated
     * user exists in its Email column.
     *
     * @param null|string $email
     * @return bool
     */
    public function emailExists($email = '')
    {
        return DB::table($this->emailVerificationTable)
            ->where('email', ($email == '')? $this->email() : $email)
            ->exists();
    }


    /**
     * Checks the verification table if the token is not unique.
     *
     * @param string $token
     * @return boolean
     */
    public function tokenExists($token)
    {
        return DB::table($this->emailVerificationTable)->where('token', $token)->exists();
    }

    /**
     * Updates the verification token assigned to the user
     *
     * @param $token
     * @return integer - number of rows affected
     */
    public function updateAssignedToken($token)
    {
        return DB::table($this->emailVerificationTable)->where('email', $this->email())->update([
            'token' => $token,
            'created_at' => new DateTime()
        ]);
    }

    /**
     * Verifies the user account once the user opens the
     * verification email link.
     *
     * @param $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyEmail($token = '')
    {
        if ($this->tokenExists($token)) {
            return redirect()->route('chef.dashboard')->with(['status' =>
                ($this->removesEmailVerification($token))?
                    'Email address successfully verified!' :
                    'Something went wrong while verifying your email. Please try again in short while!'
            ]);
        }

        return response()->view('errors.404');
    }

    public function getsAssignedEmail($token)
    {
        return DB::table($this->emailVerificationTable)->where([
            'token' => $token
        ])->value('email');
    }

    public function getsAssignedToken($email)
    {
        return DB::table($this->emailVerificationTable)->where([
            'email' => $email
        ])->value('token');
    }

    public function removesEmailVerification($token)
    {
        $email = $this->getsAssignedEmail($token);
        $user = Chef::where('email', $email)->first();

        $this->guard()->login($user);

        return DB::table($this->emailVerificationTable)->where([
            'token' => $token
        ])->delete();
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $response
     * @return \Illuminate\Http\Response
     */
    protected function sendsUnverifiedEmailResponse(Request $request, $response = '')
    {
        $this->guard()->logout();
        return redirect()->route($this->loginRouteName)
            ->withInput($request->only('email', 'remember'))
            ->with([
                'status' => trans($response),
                'email_unverified' => true
            ]);
    }

    /**
     * Returns the currently authenticated user
     *
     * @return Chef
     */
    public function email()
    {
        return Auth::guard($this->guardName)->user()->email;
    }

    /**
     * Get the guard to be used during password reset.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard($this->guardName);
    }
}