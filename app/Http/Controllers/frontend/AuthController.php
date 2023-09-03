<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\CreateVerifyEmailRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\EmailVerifyToken;
use App\Models\PackagePlan;
use App\Models\PasswordReset;
use App\Models\Referral;
use App\Models\User;
use App\Models\Wallet;
use App\Services\MonnifyService;
use App\Traits\Generics;
use App\Traits\Responses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use Generics;
    use Responses;


    //route to login page
    public function login()
    {
        return view('auth.login');
    }


    //perform login action
    public function doLogin(LoginRequest $request)
    {
        $data = $this->validatingRequest($request);
        $user = User::where('username', $data['username'])->first();
        if (!$user || $user->exists() == false) {
            return redirect()->back()->with('errors', 'Incorrect Login Credentials!');
        }

        if (Auth::guard('web')->validate($data) == false) {
            return redirect()->back()->with('errors', 'Incorrect Login Credentials!');
        }

        Auth::guard('web')->attempt($data, $request->remember_me == 'on' ? true : false);

        if ($user->is_admin == 1) {
            return redirect()->intended(route('admin.dashboard'));
        } else {
            return redirect()->route('dashboard')->with('success', 'Welcome <b>' . Auth::guard('web')->user()->username . '</b> <br> <br> Login was successfull');
        }
    }


    //route to register page
    public function register(Request $request)
    {
        if ($request->ref) {
            $referrer = ['ref' => User::where('my_ref_code', $request->ref)->first()];
            if ($referrer['ref'] == null) {
                return redirect()->route('login')->with('errors', "Referral ID does not exists");
            }
            return view('auth.register')->with($referrer);
        } else {
            return view('auth.register');
        }
    }


    //perform register action
    public function doRegister(CreateUserRequest $request, MonnifyService $monnifyService)
    {
        $data = $this->validatingRequest($request);

        $data['password'] = bcrypt($data['password']);
        $data['my_ref_code'] = $this->createUniqueRand('users', 'my_ref_code');
        $defaultPlan = PackagePlan::first();
        $data['plan_id'] = $defaultPlan['id'];

        if ($request->refer_by) {
            $referrer = User::where('my_ref_code', $data['refer_by'])->first();
            $referrer->update(['no_of_referrals' => $referrer['no_of_referrals'] + 1]);
        } else {
           $referrer = User::isASuperAdmin()->first();
           $data['refer_by'] = $referrer['my_ref_code'];
        }

        $user = User::create($data);
        Wallet::create(['user_id' => $user->id]);
        
        Referral::create([
            'referrer' => $referrer->id,
            'ref_code_used' => $referrer->my_ref_code,
            'referred' => $user->id,
        ]);
        
        $this->send_verify_email($data['email'], $data['username']);

        return redirect()->route('verify-email', ['email' => $data['email']])->with('success', "A Verification email has been sent to your email address");
    }


    //route to verify email page
    public function verifyEmail(Request $request)
    {
        return view('auth.verify')->with('email', $request->email);
    }

  	function resendVerificationEmail(Request $request){
      	$data = auth()->user();
      	//dd($data);
		$this->send_verify_email($data['email'], $data['username']);
      	alert()->success("Email Verification code has been resent!");
      	return back();
  	}

    //perform verify email action
    public function doVerify(CreateVerifyEmailRequest $request)
    {
        $data = $this->validatingRequest($request);
        $user = User::where('email', $data['email'])->first();
        $code = EmailVerifyToken::where('code', $data['code'])->first();

        if ($user->hasVerifiedEmail()) {
            return back()->with('errors', 'Email already verified');
        }
        if (!$code) {
            return back()->with('errors', 'Invalid Verifcation Code');
        }
        if ($code->expires_at < now()) {
            return back()->with('errors', 'Verifcation Code Expired');
        }

        $user->update([
            'email_verified_at' => now(),
            'isVerified' => true
        ]);
        $code->delete();
        return redirect()->route('login')->with('success', "Email verified Successfully");
    }


    //route to forgot password page
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }


    //perform request reset password
    public function requestResetPassword(ForgotPasswordRequest $request)
    {
        $data = $this->validatingRequest($request);
        $this->send_reset_code($data['email']);
        return redirect()->route('reset-password')->with('success', "A Password reset code has been sent to your email address");
    }


    //route to reset password
    public function resetPassword()
    {
        return view('auth.reset-password');
    }


    //perform reset password action
    public function doResetPassword(ResetPasswordRequest $request)
    {
        $data = $this->validatingRequest($request);
        $code = PasswordReset::where('code', $data['code'])->first();

        if (!$code) {
            return back()->with('errors', 'Invalid Reset Code');
        }
        if ($code->expires_at < now()) {
            return back()->with('errors', 'Reset Code Expired');
        }

        $user = User::where('email', $code['email'])->first();
        $user->update(['password' => bcrypt($data['password'])]);
        $code->delete();
        return redirect()->route('login')->with('success', "Password has been updated successfully");
    }
}
