<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\UserOtp;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Rules\ValidPhillippinesPhoneNumber;
use Auth;

class AuthOtpController extends Controller
{
    //login
    public function login(){
        

        //checking if the env files are not null
        // $account_id = env('TWILIO_SID');
        // $auth_token = env('TWILIO_TOKEN');
        // $accountNumber = env('TWILIO_FROM');

        // $setting = Setting::getShopSettings();
        // $account_id = $setting->twilio_sid;
        // $auth_token = $setting->twilio_token;
        // $twilio_number = $setting->twilio_from;
        // dd($auth_token);

        return view('front.otp.login');


    }
    
    //generate
    public function generate(Request $request){
       
    
        $validator = Validator::make($request->all(),[
            'mobile_no' => [
                'exists:users,phone',
                'required',
                new ValidPhillippinesPhoneNumber(), //this is a custom validation rule that we created
            ]
        ]);

        if($validator->passes()){


            //generate the Otp and get it
            $userOtp = $this->generateOtp($request->mobile_no);
            // dd($userOtp);

            //send it using the UserOtp function to send sms
            $userOtp->sendSMS($request->mobile_no); //send otp

            $message = "OTP has been sent on your mobile number";

            session()->flash('success',$message);

            return response()->json([
                'status' => true,
            ]);
            //return redirect()->route('otp.verification')->with('success',$message);
            

        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }

    //otp generator and sms sender  [ the function for the sms sending is on the UserOtp model function ]
    public function generateOtp($mobile_no){
        //mobile_no is phone on User model

        $user = Auth::user();

        //check if the user used his recorded phone
        if($user->phone == $mobile_no){ //if it match

            //check for user_otps available for the user
            $userOtp = UserOtp::where('user_id',$user->id)->latest()->first();

            // time now
            $now = now();

            
            if($userOtp && $now->isBefore($userOtp->expire_at)){ //check if there is available otp and if it is not expired
                return $userOtp; //return the otp

            }

            //if no otp exists or available, create a new one
            return UserOtp::create([
                'user_id' => $user->id,
                'otp' => rand(123456, 999999),
                'expire_at' => $now->addMinutes(10), //10 minutes expiration time for the otp
            ]);


            

        }else{  //if the Auth::user and the mobile number phone does not match

            return response()->json([
                'status' => false,
                'errors' => [
                    'mobile_no' => 'Mobile Number does not match you recorded account phone number.'
                ],

            ]);

            
        }

    }

    //otp verification page
    public function verification(){
        // $account_id = env('TWILIO_SID');
        // $auth_token = env('TWILIO_TOKEN');
        // $accountNumber = env('TWILIO_FROM');

        // dd($accountNumber);

        return view('front.otp.verify_otp');
    }

    //post : verification
    public function postVerification(Request $request){

        $validator = Validator::make($request->all(),[
            'otp_code' => 'required'
        ]);

        if($validator->passes()){

            $user = Auth::user();

            //fetch the otp_code for the user
            //check for user_otps available for the user
            $userOtp = UserOtp::where('user_id',$user->id)->latest()->first();


            if(empty($userOtp)){ //if otp is empty, return an error json response
                return response()->json([
                    'status' => false,
                    'errors' => [
                        'otp_code' => 'There is no otp code for your account. Please request for another one or click the resend at the bottom of the form'
                    ]
                ]);
            }

            // time now
            $now = now();

            
            if($userOtp && $now->isAfter($userOtp->expire_at)){ //check if there is available otp and if it is expired
                //return a json error response
                return response()->json([
                    'status' => false,
                    'errors' => [
                        'otp_code' => 'The otp code for this account has expired. Please request for another one or click the resend at the bottom of the form'
                    ]
                ]);

            }



            
            //if there are no errors, check if the otp_code is correct
            if($userOtp->otp == $request->otp_code){

                //update the user data
                $user->phone_verified_at = now();
                $user->save();

                //return success session
                session()->flash('success','Your phone number has been verified');

                //return success
                return response()->json([
                    'status' => true
                ]);


            }else{ // if the otp is incorrect
                return response()->json([
                    'status' => false,
                    'errors' => [
                        'otp_code' => 'Wrong OTP code'
                    ]
                ]);


            }




        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()

            ]);
        }


    }


}
