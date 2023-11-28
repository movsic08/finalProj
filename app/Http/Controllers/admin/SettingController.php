<?php

namespace App\Http\Controllers\admin;

use Auth;
use Hash;
use Image;
use App\Models\User;
use App\Models\Setting;
use App\Models\TempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Rules\PasswordStrengthValidation;
use Illuminate\Support\Facades\Validator;
use App\Rules\ValidPhillippinesPhoneNumber;


class SettingController extends Controller
{
    //Admin Acccount Settings
        //showChangePasswordForm
        public function showChangePasswordForm(){
            return view('admin.change-password');
        }

        //post : showChangePasswordForm
        public function processChangePassword(Request $request){
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

            //get the admin details
            $admin = User::where('id',Auth::guard('admin')->user()->id)->first();

            //check if valid 
            if($validator->passes()){

                //check if it is the wrong old password
                if(!Hash::check($request->old_password,$admin->password)){ 
                    session()->flash('error','Your old password is incorrect, please try again');
                    return response()->json([
                        'status' => true,

                    ]);
                }

                //if no error happens, proceed to the update and success messages
                User::where('id',Auth::guard('admin')->user()->id)->update([
                    'password' => Hash::make($request->new_password)
                ]);

                //success session
                session()->flash('success','You have successfully changed your password');
                //success json message
                return response()->json([
                    'status' => true
                ]);


            }else{
                //if not, return a json error response
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ]);

            }


        }
    //end of Admin Account Settings


    //Store Settings
        //show settings
        public function index(){

            $setting = Setting::getShopSettings();

            $data['setting'] = $setting;

            return view('admin.settings.index',$data);
        }


        //update store settings
        public function update(Request $request){

            //  dd($request->all());

            $setting = Setting::getShopSettings();
            
            if(empty($setting)){//check if category is not empty
    
                //create new Setting
                $setting = new Setting();
                
            }
    
    
            //verify the passed parameters
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'location' => 'required',
                'mobile_number' => [
                    'required',
                    new ValidPhillippinesPhoneNumber(), //this is a custom validation rule that we created
                ],
                
                'email' => 'required|email',
                'acc_1_gcash_name' => 'required',
                'acc_1_gcash_number' => 'required|size:11',
                'acc_2_gcash_name' => 'required_unless:acc_2_gcash_number,null',
                'acc_2_gcash_number' => 'required_unless:acc_2_gcash_name,null',
                'acc_3_gcash_name' => 'required_unless:acc_3_gcash_number,null',
                'acc_3_gcash_number' => 'required_unless:acc_3_gcash_name,null',
                'twilio_sid' => 'required',
                'twilio_token' => 'required',
                'twilio_from' => 'required',
                
                // 'order_confirm_open_time_1' => 'sometimes|required',
                
            ],[ //error messages
                'acc_1_gcash_name.required' => 'Gcash Name for Account 1 is required',
                'acc_1_gcash_number.required' => 'Gcash Number for Account 1 is required',
                'acc_1_gcash_number.integer' => 'Gcash Number for Account 1 must be a valid integer',
                'acc_1_gcash_number.size:11' => 'Gcash Number for Account 1 must be minimum of 11 characters',

                'acc_2_gcash_name.required_unless' => 'Gcash Name for Account 2 is required',
                'acc_2_gcash_number.required_unless' => 'Gcash Number for Account 2 is required',

                'acc_3_gcash_name.required_unless' => 'Gcash Name for Account 3 is required',
                'acc_3_gcash_number.required_unless' => 'Gcash Number for Account 3 is required',

                'twilio_sid.required' => 'Twilio SID is required',
                'twilio_token.required' => 'Twilio Token is required',
                'twilio_from.required' => 'Twilio FROM is required',

            ]);

            if($request->filled('mobile_number_2')){
                $validator->sometimes('mobile_number_2',new ValidPhillippinesPhoneNumber(),function($input){
                    return true;
                });
            }

            if($request->filled('mobile_number_3')){
                $validator->sometimes('mobile_number_3',new ValidPhillippinesPhoneNumber(),function($input){
                    return true;
                });
            }

            if($request->filled('mobile_number_4')){
                $validator->sometimes('mobile_number_4',new ValidPhillippinesPhoneNumber(),function($input){
                    return true;
                });
            }

            

            

    
            //if the parameters are valid
            if($validator->passes()){
    
                //update the category
                $setting->name = $request->name;
                $setting->location = $request->location;
                $setting->mobile_number = $request->mobile_number;
                $setting->mobile_number_2 = $request->mobile_number_2;
                $setting->mobile_number_3 = $request->mobile_number_3;
                $setting->mobile_number_4 = $request->mobile_number_4;
                $setting->email = $request->email;

                //update the Auth guard email
                $admin = Auth::guard('admin')->user();
                
                $admin->email = $request->email;
                $admin->phone = $request->mobile_number;
                $admin->save();

                $setting->facebook = $request->facebook;
                $setting->twitter = $request->twitter;
                $setting->youtube = $request->youtube;
                $setting->instagram = $request->instagram;

                
                //update gcash data
                $setting->acc_1_gcash_name = $request->acc_1_gcash_name;
                $setting->acc_1_gcash_number = $request->acc_1_gcash_number;
                $setting->acc_2_gcash_name = $request->acc_2_gcash_name;
                $setting->acc_2_gcash_number = $request->acc_2_gcash_number;
                $setting->acc_3_gcash_name = $request->acc_3_gcash_name;
                $setting->acc_3_gcash_number = $request->acc_3_gcash_number;

                $setting->twilio_sid = $request->twilio_sid;
                $setting->twilio_token = $request->twilio_token;
                $setting->twilio_from = $request->twilio_from;



                $open_time = '';
                $close_time = '';
                $order_confirm_open_time_1 = '';
                $order_confirm_close_time_1 = '';
                $order_confirm_open_time_2 = '';
                $order_confirm_close_time_2 = '';
                $order_confirm_open_time_3 = '';
                $order_confirm_close_time_3 = '';

                $rules = [];
                $customMessages = [];

                //Shop Open Time and End Time
                    if(!empty($request->open_time) || !empty($request->close_time)){

                        $rules = [
                            'open_time' => 'required|date_format:h:i A|before:close_time',
                            'close_time' => 'required|date_format:h:i A|after:open_time',
                        ];

                        $customMessages = [
                            
                            'open_time.required' => 'Shop Open Time is required',
                            'close_time.required' => 'Shop Close Time is required',

                            'open_time.date_format' => 'Shop Open Time must be a valid time',
                            'close_time.date_format' => 'Shop Close Time must be a valid time',

                            'open_time.before' => 'Shop Open Time must be before Close Time',
                            'close_time.after' => 'Shop Close Time must be after Open time',
                            
                        ];

                        //convert the request starts_at time into carbon
                        $open_time = date('H:i s', strtotime($request->open_time));
                        $close_time = date('H:i s', strtotime($request->close_time));
                            
                    }
                //end of Shop Open Time and End Time


                //[ 1st ] Confirm Order  Start (Open) Time and End (Close) Time
                    if(!empty($request->order_confirm_open_time_1) || !empty($request->order_confirm_close_time_1)){

                        $newRules = [

                            'order_confirm_open_time_1' => 'required|date_format:h:i A|before:order_confirm_close_time_1',
                            'order_confirm_close_time_1' => 'required|date_format:h:i A|after:order_confirm_open_time_1',

                            
                        ];

                        $newCustomMessages = [
                            'order_confirm_open_time_1.required' => '[1st] Confirm Order Start Time is required',
                            'order_confirm_close_time_1.required' => '[1st] Confirm Order End Time is required',
                            
                            'order_confirm_open_time_1.before' => '[1st] Confirm Order Start Time must be before End Time',
                            'order_confirm_close_time_1.after' => '[1st] Confirm Order End Time must be after Start time',

                            'order_confirm_open_time_1.date_format' => '[1st] Confirm Order Start Time must be a valid time',
                            'order_confirm_close_time_1.date_format' => '[1st] Confirm Order End Time must be a valid time',
                        ];

                        $rules = array_merge($rules,$newRules);
                        $customMessages = array_merge($customMessages,$newCustomMessages);

                        //convert the request starts_at time into carbon
                        $order_confirm_open_time_1 = date('H:i s', strtotime($request->order_confirm_open_time_1));
                        $order_confirm_close_time_1 = date('H:i s', strtotime($request->order_confirm_close_time_1));
                            
                    }
                //end of [ 1st ] Confirm Order  Start (Open) Time and End (Close) Time

                

                //[ 2nd ] Confirm Order  Start (Open) Time and End (Close) Time
                    if(!empty($request->order_confirm_open_time_2) || !empty($request->order_confirm_close_time_2)){

                    

                        $newRules = [

                            'order_confirm_open_time_2' => 'required|date_format:h:i A|before:order_confirm_close_time_2|after:order_confirm_close_time_1',
                            'order_confirm_close_time_2' => 'required|date_format:h:i A|after:order_confirm_open_time_2',

                            
                        ];

                        $newCustomMessages = [
                            'order_confirm_open_time_2.required' => '[2nd] Confirm Order Start Time is required',
                            'order_confirm_close_time_2.required' => '[2nd] Confirm Order End Time is required',
                            
                            'order_confirm_open_time_2.before' => '[2nd] Confirm Order Start Time must be before End Time',
                            'order_confirm_close_time_2.after' => '[2nd] Confirm Order End Time must be after Start time',

                            'order_confirm_open_time_2.date_format' => '[2nd] Confirm Order Start Time must be a valid time',
                            'order_confirm_close_time_2.date_format' => '[2nd] Confirm Order End Time must be a valid time',

                            'order_confirm_open_time_2.after' => '[2nd] Confirm Order End Time must be after [1st] Confirm Order End Time',
                        ];

                        $rules = array_merge($rules,$newRules);
                        $customMessages = array_merge($customMessages,$newCustomMessages);

                        //convert the request starts_at time into carbon
                        $order_confirm_open_time_2 = date('H:i s', strtotime($request->order_confirm_open_time_2));
                        $order_confirm_close_time_2 = date('H:i s', strtotime($request->order_confirm_close_time_2));
                            
                    }
                //end of [ 2nd ] Confirm Order  Start (Open) Time and End (Close) Time


                //[ 3rd ] Confirm Order  Start (Open) Time and End (Close) Time
                    if(!empty($request->order_confirm_open_time_3) || !empty($request->order_confirm_close_time_3)){

                        $newRules = [

                            'order_confirm_open_time_3' => 'required|date_format:h:i A|before:order_confirm_close_time_3|after:order_confirm_close_time_1|after:order_confirm_close_time_2',
                            'order_confirm_close_time_3' => 'required|date_format:h:i A|after:order_confirm_open_time_3',

                            
                        ];

                        $newCustomMessages = [
                            'order_confirm_open_time_3.required' => '[3rd] Confirm Order Start Time is required',
                            'order_confirm_close_time_3.required' => '[3rd] Confirm Order End Time is required',
                            
                            'order_confirm_open_time_3.before' => '[3rd] Confirm Order Start Time must be before End Time',
                            'order_confirm_close_time_3.after' => '[3rd] Confirm Order End Time must be after Start time',

                            'order_confirm_open_time_3.date_format' => '[3rd] Confirm Order Start Time must be a valid time',
                            'order_confirm_close_time_3.date_format' => '[3rd] Confirm Order End Time must be a valid time',

                            'order_confirm_open_time_3.after' => '[3rd] Confirm Order End Time must be after [1st] Confirm Order End Time',
                            'order_confirm_open_time_3.after' => '[3rd] Confirm Order End Time must be after [2nd] Confirm Order End Time',


                        ];


                        $rules = array_merge($rules,$newRules);
                        $customMessages = array_merge($customMessages,$newCustomMessages);

                        //convert the request starts_at time into carbon
                        $order_confirm_open_time_3 = date('H:i s', strtotime($request->order_confirm_open_time_3));
                        $order_confirm_close_time_3 = date('H:i s', strtotime($request->order_confirm_close_time_3));
                            
                    }
                //end of [ 3rd ] Confirm Order  Start (Open) Time and End (Close) Time



                //validate that both are given
                $time_validator = Validator::make($request->all() ,$rules,$customMessages);

                if($time_validator->passes()){
                    

                    $setting->open_time = $open_time;
                    $setting->close_time = $close_time;

                    $setting->order_confirm_open_time_1 = $order_confirm_open_time_1;
                    $setting->order_confirm_close_time_1 = $order_confirm_close_time_1;

                    $setting->order_confirm_open_time_2 = $order_confirm_open_time_2;
                    $setting->order_confirm_close_time_2 = $order_confirm_close_time_2;

                    $setting->order_confirm_open_time_3 = $order_confirm_open_time_3;
                    $setting->order_confirm_close_time_3 = $order_confirm_close_time_3;

                    $setting->save();

                }else{
                    //return errors

                    return response()->json([
                        'status' => false,
                        'errors' => $time_validator->errors()
                    ]);
                }


                /**Order Confirmation Start and End Time */
                    //[1st]
                    
                        // if(!empty($request->order_confirm_open_time_1) || !empty($request->order_confirm_close_time_1)){

                        //     $rules = [
                        //         'order_confirm_open_time_1' => 'required',
                        //         'order_confirm_close_time_1' => 'required',
                        //     ];

                        //     $customMessages = [
                        //         'order_confirm_open_time_1.required' => 'The [1st] confirmation start time is required',
                        //         'order_confirm_close_time_1.required' => 'The [1st] confirmation end time is required',
                        //     ];
                            

                        //     //validate that both are given
                        //     $time_validator = Validator::make($request->all(),$rules,$customMessages);
                            
                            
                        //     if($time_validator->passes()){
                        //         //convert the request starts_at time into carbon
                        //         $open_time = date('H:i s', strtotime($request->order_confirm_open_time_1));
                        //         $close_time = date('H:i s', strtotime($request->order_confirm_close_time_1));

                        //         //check if starts_at is greater the now
                        //         if($open_time >= $close_time){ // if true, returns a error response
                        //             return response()->json([
                        //                 'status' => false,
                        //                 'errors' => ['order_confirm_open_time_1' => 'Confirmation Start time must be a time before End time']
                        //             ]);
                        //         }

                        //         if($close_time <= $open_time ){ // if true, returns a error response
                        //             return response()->json([
                        //                 'status' => false,
                        //                 'errors' => ['order_confirm_close_time_1' => 'Confirmation End time must be a time after Start time']
                        //             ]);
                        //         }

                        //         $setting->order_confirm_open_time_1 = $open_time;
                        //         $setting->order_confirm_close_time_1 = $close_time;

                        //         $setting->save();

                        //     }else{
                        //         //return errors

                        //         return response()->json([
                        //             'status' => false,
                        //             'errors' => $time_validator->errors()
                        //         ]);
                        //     }
                                
                        // }
                    //end of [1st]

                /**end of Order Confirmation Start and End Time */


                $setting->save();
    
                $oldLogoImage = $setting->logo;
    
    
                //Save logo image here
                if(!empty($request->logo_image_id)){
                    $tempImage = TempImage::find($request->logo_image_id);   //find the logo_image_id from the TempImag model database
                    $extArray = explode('.',$tempImage->name);  //get the extension array
                    $ext = last($extArray);     //the last . occcurence is the extension -> get the extension
    
                    $newLogoImageName = $setting->id.'-'.time().'.'.$ext; //create a new name
                    $sPath = public_path().'/temp/'.$tempImage->name; //get the source path
                    $dPath = public_path().'/uploads/setting/'.$newLogoImageName;  //get the destination path
                    File::copy($sPath,$dPath); //copy
    
                    //Generate Image Thumbnail
                    $dPath = public_path().'/uploads/setting/thumb/'.$newLogoImageName;
                    $img = Image::make($sPath);
                    //$img->resize(450,600);
                    $img->fit(450,450,function($constraint){
                        $constraint->upsize();
                    });
    
                    $img->save($dPath);
    
                    $setting->logo = $newLogoImageName;
                    $setting->save();
    
                    //Delete old image
                    File::delete(public_path().'/uploads/category/thumb/'.$oldLogoImage);
                    File::delete(public_path().'/uploads/category/'.$oldLogoImage);
    
                }


                $oldFaviconImage = $setting->favicon;
                //Save favicon image here
                if(!empty($request->favicon_image_id)){
                    $tempImage = TempImage::find($request->favicon_image_id);   //find the favicon_image_id from the TempImag model database
                    $extArray = explode('.',$tempImage->name);  //get the extension array
                    $ext = last($extArray);     //the last . occcurence is the extension -> get the extension
    
                    $newFaviconImageName = $setting->id.'-'.time().'.'.$ext; //create a new name
                    $sPath = public_path().'/temp/'.$tempImage->name; //get the source path
                    $dPath = public_path().'/uploads/setting/'.$newFaviconImageName;  //get the destination path
                    File::copy($sPath,$dPath); //copy
    
                    //Generate Image Thumbnail
                    $dPath = public_path().'/uploads/setting/thumb/'.$newFaviconImageName;
                    $img = Image::make($sPath);
                    //$img->resize(450,600);
                    $img->fit(450,450,function($constraint){
                        $constraint->upsize();
                    });
    
                    $img->save($dPath);
    
                    $setting->favicon = $newFaviconImageName;
                    $setting->save();
    
                    //Delete old image
                    File::delete(public_path().'/uploads/category/thumb/'.$oldFaviconImage);
                    File::delete(public_path().'/uploads/category/'.$oldFaviconImage);
    
                }
    
    
                $request->session()->flash('success','Settings updated successfully');
    
                return response()->json([
                    'status' => true,
                    'message' => 'Setting Updated successfully',
                ]);
    
    
    
            }else{//return the json error response
    
                return response()->json([
                    'status' => false,
                    'errors' => $validator->errors()
                ]);
                
    
            }
    
        }



    //end of Store Settings




}
