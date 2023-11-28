<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Rules\ValidPhillippinesPhoneNumber;
use App\Rules\PasswordStrengthValidation;
use Hash;


class UserController extends Controller
{
    //index
    public function index(Request $request){
        $users = User::latest(); //get users

        if(!empty($request->get('keyword'))){
            $users = $users->where('name','like','%'.$request->keyword.'%');
            $users = $users->orWhere('email','like','%'.$request->keyword.'%');
        }

        $users = $users->paginate(10);

        return view('admin.users.list',[
            'users' => $users
        ]);
    }

    //create 
    public function create(){
        //for password generations purposes
        //
        
        return view('admin.users.create');
    }

    //store : post create
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'min:8',
                new PasswordStrengthValidation(),
            ],
            'phone' => [
                'required',
                new ValidPhillippinesPhoneNumber(),
            ]
        ]);

        if($validator->passes()){ //check if the input request given is valid 
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->email_verified_at = now();
            $user->phone = $request->phone;
            $user->phone_verified_at = now();
            $user->password = Hash::make($request->password);
            $user->save();

            $message = "User added successfully";

            session()->flash('success',$message);

            return response()->json([
                'status' => true,
                'message' => $message
            ]);


        }else{ //if the request is not valid

            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);

        }

    }

    //edit
    public function edit(Request $request,$id){
        $user = User::find($id);

        if($user == null){
            $message = 'User not found';
            session()->flash('error',$message);
            return redirect()->route('users.index');
        }

        return view('admin.users.edit',[
            'user' => $user
        ]);

    }

    //update : post edit
    public function update(Request $request,$id){

        $user = User::find($id);

        if($user == null){
            $message = 'User not found';
            session()->flash('error',$message);
            return redirect()->route('users.index');
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id.',id',
            'phone' => [
                'required',
                new ValidPhillippinesPhoneNumber(),
            ]
        ]);

        if($request->password != ''){
            $psw_validator = Validator::make($request->all(),[
                'password' => [
                    'min:8',
                    new PasswordStrengthValidation(),
                ],
            ]);
        }


        if($validator->passes()){ //check if the input request given is valid 
            
            $user->name = $request->name;
            $user->email = $request->email;
            $user->email_verified_at = now();
            $user->phone = $request->phone;
            $user->phone_verified_at = now();

            //check password is filled and to be change
            if($request->password != ''){

                //psw validator
                if($psw_validator->passes()){
                    $user->password = Hash::make($request->password);
                }else{
                    return response()->json([
                        'status' => false,
                        'errors' => $psw_validator->errors()
                    ]);
                }             

                
            }
            
            $user->save();

            $message = "User updated successfully";

            session()->flash('success',$message);

            return response()->json([
                'status' => true,
                'message' => $message
            ]);


        }else{ //if the request is not valid

            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);

        }

    }

    //delete user
    public function destroy(Request $request,$id){
        $user = User::find($id);

        if($user == null){ //if user is not found
            $message = 'User not found';
            session()->flash('error',$message);
            return redirect()->route('users.index');
        }

        //if found, delete user
        $user->delete();

        $message = 'User deleted successfully';

        session()->flash('success',$message);

        return response()->json([
            'status' => true,
            'message' => $message
        ]);
        
    }

}
