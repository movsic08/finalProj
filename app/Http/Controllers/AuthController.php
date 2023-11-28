<?php

namespace App\Http\Controllers;


use Auth;
use Hash;
use App\Models\User;
use App\Models\Order;
use App\Models\Country;
use App\Models\Wishlist;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\CustomerAddress;
use Illuminate\Support\Facades\Validator;
use App\Rules\ValidPhillippinesPhoneNumber;
use App\Rules\PasswordStrengthValidation;
use App\Mail\ForgotPasswordMail; //for the forgot password
use App\Mail\VerifyEmail; //for the email verification
use Mail;
use Str;



class AuthController extends Controller
{
    //login
    public function login(){
        return view('front.account.login');
    }


    //register
    public function register(){
        return view('front.account.register');
    }

    //post : register 
    public function processRegister(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'phone' => [
                'required',
                new ValidPhillippinesPhoneNumber(),
            ],
            'password' => [
                'required',
                'min:8',
                new PasswordStrengthValidation(),
            ],
            'confirm_password' => 'required|same:password',
        ]);

        if($validator->passes()){
            //create the new User
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();

            session()->flash('success','You have been registered successfully');

            return response()->json([
                'status' => true
            ]);

        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }


    }

    //post : login
    public function authenticate(Request $request){
        //validate
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => [
                'required',
                'min:8',
                new PasswordStrengthValidation(),
            ],
            
        ]);

        if($validator->passes()){

            //attempt to login the user
            if(Auth::attempt(['email' => $request->email, 'password' =>  $request->password], $request->get('remember'))){

                //to redirect the user to the intended url if the used is authenticated
                if(session()->has('url.intended')){
                    return redirect(session()->get('url.intended'));
                }

                //if login success
                return redirect()->route('account.profile');

            }else{
                //if login failed
                //session()->flash('error','Either email/password is incorrect');
                return redirect()->route('account.login')
                    ->withInput($request->only('email'))
                    ->with('error','Either email/password is incorrect');

            }

        }else{
            return redirect()->route('account.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }

    //profile
    public function profile(){
        //get countries
        $countries = Country::orderBy('name','ASC')->get();

        //get user
        $user = User::where('id',Auth::user()->id)->first();

        //get customer address
        $customer_address = CustomerAddress::where('user_id',Auth::user()->id)->first();
        //dd($address);

        return view('front.account.profile',[
            'user' => $user,
            'countries' => $countries,
            'customer_address' => $customer_address,
        ]);

    }
    
    //update profile
    public function updateProfile(Request $request){
        // echo "hello";
        $userId = Auth::user()->id;

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$userId.',id',
            'phone' => [
                'required',
                new ValidPhillippinesPhoneNumber(), //this is a custom validation rule that we created
            ]
        ]);

        if($validator->passes()){ // if the validator passes

            $user = User::find($userId);
            $user->name = $request->name;
            
            
            if(!empty($request->email) && !empty($user->email) && $user->email != $request->email){
                $user->email_verified_at = null;
            }
            $user->email = $request->email;

            

            if(!empty($request->phone) && !empty($user->phone) && $user->phone != $request->phone){
                $user->phone_verified_at = null;
            }
            $user->phone = $request->phone;

            $user->save();

            $message = 'Profile Updated Successfully';
            //session success
            session()->flash('success',$message);

            //json success response
            return response()->json([
                'status' => true,
                'message' => $message
            ]);

        }else{ //if not, return a error json response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }


    }


    //update address
    public function updateAddress(Request $request){

        //dd($request->all());

        // echo "hello";
        $userId = Auth::user()->id;

        $validator = Validator::make($request->all(),[
            'first_name' => 'required|min:1',
            'last_name' => 'required',
            'email' => 'required|email',
            // 'country_id' => 'required',
            'region_code' => 'required',
            'province_code' => 'required',
            'city_municipality_code' => 'required',
            'barangay_code' => 'required',
            'address' => 'required|min:10',
            // 'city' => 'required',
            // 'state' => 'required',
            'zip' => 'required',
            'mobile' => [
                'required',
                new ValidPhillippinesPhoneNumber(), //this is a custom validation rule that we created
            ]
            
        ]);

        if($validator->passes()){ // if the validator passes

            // $user = User::find($userId);
            // $user->name = $request->name;
            // $user->email = $request->email;
            // $user->phone = $request->phone;
            // $user->save();

            CustomerAddress::updateOrCreate(
                ['user_id' => $userId],
                [
                    'user_id' => $userId,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'mobile' => $request->mobile,
                    'country_id' => '170', //default for PH
                    'address' => $request->address,
                    'region_code' => $request->region_code,
                    'province_code' => $request->province_code,
                    'city_municipality_code' => $request->city_municipality_code,
                    'barangay_code' => $request->barangay_code,
                    'apartment' => $request->apartment,
                    // 'city' => $request->city,
                    // 'state' => $request->state,
                    'zip' => $request->zip
                ]
            );

            $message = 'Address Updated Successfully';
            //session success
            session()->flash('success',$message);

            //json success response
            return response()->json([
                'status' => true,
                'message' => $message
            ]);

        }else{ //if not, return a error json response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }


    }


    //logout
    public function logout(){
        Auth::logout();
        
        return redirect()->route('account.login')
            ->with('success','You have successfully logged out!');

    }

    //orders
    public function orders(){
        //get user
        $user = Auth::user();

        //get orders
        $orders = Order::where('user_id',$user->id)->orderBy('created_at','DESC')->get();

        $data['orders'] = $orders;
        return view('front.account.order',$data);
    }

    //order detail
    public function orderDetail($id){
        $data = [];

        //get user
        $user = Auth::user();

        //get order
        $order = Order::where('user_id',$user->id)->where('id',$id)->first();
        $data['order'] = $order;

        //get order items
        $orderItems = OrderItem::where('order_id',$order->id)->get();
        $data['orderItems'] = $orderItems;

        
        return view('front.account.order-detail',$data);
    }

    //wishlist
    public function wishlist(){
        $wishlists = Wishlist::where('user_id',Auth::user()->id)->with('product')->get();

        $data = [];
        $data['wishlists'] = $wishlists;
        return view('front.account.wishlist',$data);
    }

    //Remove product on Wishlist
    public function removeProductFromWishlist(Request $request){
        $wishlist = Wishlist::where('user_id',Auth::user()->id)->where('product_id',$request->id)->first();

        //wishlist is null
        if($wishlist == null){
            session()->flash('error','Product already removed');

            //return an invalid json response
            return response()->json([
                'status' => true
            ]);

        }else{ //wishlist item is found, remove it
             Wishlist::where('user_id',Auth::user()->id)->where('product_id',$request->id)->delete(); 

            //success session
            session()->flash('success','Product removed successsfully');
            //return a json success response
            return response()->json([
                'status' => true,
            ]);
        }

    }


    //show change password
    public function showChangePasswordForm(){
        return view('front.account.change-password');
    }

    //change password
    public function changePassword(Request $request){
        $validator = Validator::make($request->all(),[
            'old_password' => [
                'required',
                'min:8',
                new PasswordStrengthValidation(),
            ],
            'new_password' =>  [
                'required',
                'min:8',
                new PasswordStrengthValidation(),
            ],
            'confirm_password' => 'required|same:new_password',
        ]); 

        if($validator->passes()){ //if input is valid

            //update the user password
            $user = User::select('password')->where('id',Auth::user()->id)->first();
            // dd($user);

            if(!Hash::check($request->old_password,$user->password)){ //if old password is not correct

                //return an error response
                session()->flash('error','Your old password is incorrect, Please try again');

                //error response
                return response()->json([
                    'status' => true
                ]);

            }

            //if no errors found update the password
            User::where('id',$user->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            session()->flash('success','You have successfully changed your password');

            return response()->json([
                'status' => true
            ]);

            

        }else{// if input is not valid

            //return a json error response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }


    }

    //forgot password
    public function forgotPassword(){
        return view('front.account.forgot-password');
    }

    //post : forgot password
    public function postForgotPassword(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email',
            
        ]);

        if($validator->passes()){

            $user = User::where('email',$request->email)->first();

            //check if user with the email exists
            if(!empty($user)){

                //dd($user);

                //remember token
                $user->remember_token = Str::random(30);
                $user->save();

                //create a new mailer
                Mail::to($user->email)->send(new ForgotPasswordMail($user));


                return redirect()->route('account.forgotPassword')
                    ->withInput($request->only('email'))
                    ->with('success','Please check your email and reset your password');

            }else{
                //if login failed
                //session()->flash('error','Either email/password is incorrect');
                return redirect()->route('account.forgotPassword')
                    ->withInput($request->only('email'))
                    ->with('error','Email is not registered');

            }

        }else{
            return redirect()->route('account.forgotPassword')
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
            return view('front.account.reset',$data);

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

    //verify email
    public function verifyEmail(){

        //check if the user is really verified 
        if(Auth::check() ){

            $user = Auth::user();

            //set the user remember_token
            $user->remember_token = Str::random(30);
            $user->save();

            //create a new mailer
            Mail::to($user->email)->send(new VerifyEmail($user));

            return redirect()->back()->with('success','Email verification sent. Please check you inbox and click the verification button');

        }else{
            Auth::logout();
            return redirect()->route("front.home");
        }
        
    }

    //email verified
    public function emailVerified($token){

        //check if user is auth
        if(Auth::check()){
            $user = Auth::user();

            if($token == $user->remember_token){

                $user->email_verified_at = now();
                $user->save();

                return redirect()->route("account.profile")->with('success','Email verified');

            }else{

                return redirect()->route("account.profile")->with('error','Token mismatch');
            }


        }else{
            Auth::logout();
            return redirect()->route("front.home");
        }

        

    }


}
