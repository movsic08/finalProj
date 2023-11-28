<?php

namespace App\Http\Controllers\admin;

use Str;
use Auth;
use Hash;
use Mail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ForgotPasswordMail;
use App\Http\Controllers\Controller;
use App\Rules\PasswordStrengthValidation;
use Illuminate\Support\Facades\Validator;


class AdminLoginController extends Controller
{
    //admin login
    public function index(){
        return view('admin.login');
    }

    //admin auth function
    public function authenticate(Request $request){
        //dd($request->all());

        //validates the passed email and password parameters
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //dd($validator->passes());

        //if passed
        if($validator->passes()){

            //if the input passes the validator, proceed to authentication of the account 
            if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password],$request->get('remember'))){ //attempt to verify cred

                //if auth successfull 
                //get admin
                $admin = Auth::guard('admin')->user();

                //dd($admin->role);

                //check if the acc is an admin acc
                if($admin->role == 2){
                    //move to the admin dashboard
                    return redirect()->route('admin.dashboard');
                }else{
                    
                    //log the user out
                    Auth::guard('admin')->logout();

                    //return an unauthorized message
                    return redirect()->route('admin.login')->with('error','You are not authorized to access the admin panel.');
                     

                }
                
                

            }else{
                //if unsuccessful
                return redirect()->route('admin.login')->with('error','Either Email/Password is incorrect');

            }

        
        }else{// if failed
            return redirect()->route('admin.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

    }

    
    //forgot password
    public function forgotPassword(){
        return view('admin.forgot-password');
    }

    //post : forgot password
    public function postForgotPassword(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            
        ]);

        if($validator->passes()){

            //check if the user is the email of the admin
            $user = User::where('email',$request->email)->first();

            //check if user with the email exists
            if(!empty($user) && $user->role == 2 ){

                //dd($user);

                //remember token
                $user->remember_token = Str::random(30);
                $user->save();

                //create a new mailer
                Mail::to($user->email)->send(new ForgotPasswordMail($user));


                return redirect()->route('admin.forgotPassword')
                    ->withInput($request->only('email'))
                    ->with('success','Please check your email and reset your password');

            }else{
                //if login failed
                //session()->flash('error','Either email/password is incorrect');
                return redirect()->route('admin.forgotPassword')
                    ->withInput($request->only('email'))
                    ->with('error','Your email is invalid');

            }

        }else{
            return redirect()->route('admin.forgotPassword')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

        
    }


    //reset password form
    public function reset($token){
        //check if the passed token matches the code that we used
        $user = User::where('remember_token',$token)->first();
        if(!empty($user)){

            $data['user'] = $user;
            return view('admin.reset',$data);

        }else{
            //if there is token mismatch
            abort(404);
        }


        //dd($token);
    }

    //post : reset password form
    public function postReset(Request $request,$token){
        //check if the passed token matches the code that we used
        $user = User::where('remember_token',$token)->first();
        if(!empty($user)){

            //validate the values
            $validator = Validator::make($request->all(),[
                'new_password' =>  [
                    'required',
                    'min:8',
                    new PasswordStrengthValidation(),
                ],
                'confirm_password' => 'required|same:new_password',
            ]); 

            if($validator->passes()){

                $user->password = Hash::make($request->new_password);
                $user->save();

                //success session
                session()->flash('success','Password Successfully Updated');

                //success json response
                return response()->json([
                    'status' => true,

                ]);
            
            }else{
                //if values are not valid, return the json error response
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ]);
            }





        }else{
            //if there is token mismatch
            abort(404);
        }

    }


}
