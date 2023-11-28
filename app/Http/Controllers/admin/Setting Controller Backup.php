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

            // dd($request->all());

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
                // 'order_confirm_open_time_1' => 'sometimes|required',
                
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

            

            //check if order_confirm_open_time_1 is filled to require the order_confirm_close_time_1
            // if($request->filled('order_confirm_open_time_1')){

            //     $validator->validate('order_confirm_close_time_1','required',function($input){
            //         return true;
            //     });
            // }

            // if($request->filled('order_confirm_close_time_1')){
            //     $validator->validate('order_confirm_open_time_1','required',function($input){
            //         return true;
            //     });
            // }

    
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
                $setting->facebook = $request->facebook;
                $setting->twitter = $request->twitter;
                $setting->youtube = $request->youtube;
                $setting->instagram = $request->instagram;

                //starting date must be greater than current date
                if(!empty($request->open_time) || !empty($request->close_time)){

                    //validate that both are given
                    $time_validator = Validator::make($request->all(),[
                        'open_time' => 'required',
                        'close_time' => 'required',
                    ]);
                    
                    if($time_validator->passes()){
                        //convert the request starts_at time into carbon
                        $open_time = date('H:i s', strtotime($request->open_time));
                        $close_time = date('H:i s', strtotime($request->close_time));

                        //check if starts_at is greater the now
                        if($open_time >= $close_time){ // if true, returns a error response
                            return response()->json([
                                'status' => false,
                                'errors' => ['open_time' => 'Open time must be a time before close time']
                            ]);
                        }

                        if($close_time <= $open_time ){ // if true, returns a error response
                            return response()->json([
                                'status' => false,
                                'errors' => ['close_time' => 'Close time must be a time after open time']
                            ]);
                        }

                        $setting->open_time = $open_time;
                        $setting->close_time = $close_time;

                        $setting->save();

                    }else{
                        //return errors

                        return response()->json([
                            'status' => false,
                            'errors' => $time_validator->errors()
                        ]);
                    }
                        
                }


                /**Order Confirmation Start and End Time */
                    //[1st]
                    
                        if(!empty($request->order_confirm_open_time_1) || !empty($request->order_confirm_close_time_1)){

                            $rules = [
                                'order_confirm_open_time_1' => 'required',
                                'order_confirm_close_time_1' => 'required',
                            ];

                            $customMessages = [
                                'order_confirm_open_time_1.required' => 'The [1st] confirmation start time is required',
                                'order_confirm_close_time_1.required' => 'The [1st] confirmation end time is required',
                            ];
                            

                            //validate that both are given
                            $time_validator = Validator::make($request->all(),$rules,$customMessages);
                            
                            
                            if($time_validator->passes()){
                                //convert the request starts_at time into carbon
                                $open_time = date('H:i s', strtotime($request->order_confirm_open_time_1));
                                $close_time = date('H:i s', strtotime($request->order_confirm_close_time_1));

                                //check if starts_at is greater the now
                                if($open_time >= $close_time){ // if true, returns a error response
                                    return response()->json([
                                        'status' => false,
                                        'errors' => ['order_confirm_open_time_1' => 'Confirmation Start time must be a time before End time']
                                    ]);
                                }

                                if($close_time <= $open_time ){ // if true, returns a error response
                                    return response()->json([
                                        'status' => false,
                                        'errors' => ['order_confirm_close_time_1' => 'Confirmation End time must be a time after Start time']
                                    ]);
                                }

                                $setting->order_confirm_open_time_1 = $open_time;
                                $setting->order_confirm_close_time_1 = $close_time;

                                $setting->save();

                            }else{
                                //return errors

                                return response()->json([
                                    'status' => false,
                                    'errors' => $time_validator->errors()
                                ]);
                            }
                                
                        }
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
