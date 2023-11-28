<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\DiscountCoupon;
use Illuminate\Support\Carbon;

class DiscountCodeController extends Controller
{
    //index
    public function index(Request $request){
        $discountCoupons = DiscountCoupon::latest();

        if(!empty($request->get('keyword'))){
            $discountCoupons = $discountCoupons->where('name','like','%'.$request->get('keyword').'%');
        }

        $discountCoupons = $discountCoupons->paginate(10);
        return view('admin.coupon.list',compact('discountCoupons'));
    }

    //create    
    public function create(){
        return view('admin.coupon.create');
    }

    //store
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'code' => 'required',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'status' => 'required',
        ]);

        if($validator->passes()){ //if validators succeeds

            //starting date must be greater than current date
            if(!empty($request->starts_at)){
                $now = Carbon::now();
                //convert the request starts_at time into carbon
                $startsAt = Carbon::createFromFormat('Y-m-d H:i:s',$request->starts_at);

                //check if starts_at is greater the now
                if($startsAt->lte($now) == true){ // if true, returns a error response
                    return response()->json([
                        'status' => false,
                        'errors' => ['starts_at' => 'Start date can not be less than current date time']
                    ]);
                }
            }


            //expiry date must be greater than start date
            if(!empty($request->starts_at) && !empty($request->expires_at)){
                $now = Carbon::now();
                //convert the request expires_at time into carbon
                $expiresAt = Carbon::createFromFormat('Y-m-d H:i:s',$request->expires_at);

                //check if expires at is greater the start date
                if($expiresAt->gt($now) == false){ // if false, returns a error response
                    return response()->json([
                        'status' => false,
                        'errors' => ['expires_at' => 'Expiry date must be greater than start date']
                    ]);
                }
            }


            $discountCode = new DiscountCoupon;
            $discountCode->code = $request->code;
            $discountCode->name = $request->name;
            $discountCode->description = $request->description;
            $discountCode->max_uses = $request->max_uses;
            $discountCode->max_uses_user = $request->max_uses_user;
            $discountCode->type = $request->type;
            $discountCode->discount_amount = $request->discount_amount;
            $discountCode->min_amount = $request->min_amount;
            $discountCode->status = $request->status;
            $discountCode->starts_at = $request->starts_at;
            $discountCode->expires_at = $request->expires_at;
            $discountCode->save();

            $message = 'Discount coupon added successfully';
            session()->flash('success',$message);

            return response()->json([
                'status' => true,
                'message' => 'Discount coupon added successfully'
            ]);


        }else{//if validator fails
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    //edit
    public function edit(Request $request,$id){

        $coupon = DiscountCoupon::find($id);

        if($coupon == null){
            session()->flash('error','Record not found');
            return redirect()->route('coupons.index');
        }

        $data['coupon'] = $coupon;

        return view('admin.coupon.edit',$data);
    }

    //update
    public function update(Request $request,$id){

        $discountCode = DiscountCoupon::find($id);

        //if record not found, return a json error response
        if($discountCode == null){
            session()->flash('error','Record not found');
            return response()->json([
                'status' => true
            ]);
        }


        $validator = Validator::make($request->all(),[
            'code' => 'required',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'status' => 'required',
        ]);

        if($validator->passes()){ //if validators succeeds

            //starting date must be greater than current date
            if(!empty($request->starts_at)){
                $now = Carbon::now();
                //convert the request starts_at time into carbon
                $startsAt = Carbon::createFromFormat('Y-m-d H:i:s',$request->starts_at);

                //check if starts_at is greater the now
                if($startsAt->lte($now) == true){ // if true, returns a error response
                    return response()->json([
                        'status' => false,
                        'errors' => ['starts_at' => 'Start date can not be less than current date time']
                    ]);
                }
            }


            //expiry date must be greater than start date
            if(!empty($request->starts_at) && !empty($request->expires_at)){
                $now = Carbon::now();
                //convert the request expires_at time into carbon
                $expiresAt = Carbon::createFromFormat('Y-m-d H:i:s',$request->expires_at);

                //check if expires at is greater the start date
                if($expiresAt->gt($now) == false){ // if false, returns a error response
                    return response()->json([
                        'status' => false,
                        'errors' => ['expires_at' => 'Expiry date must be greater than start date']
                    ]);
                }
            }


            
            $discountCode->code = $request->code;
            $discountCode->name = $request->name;
            $discountCode->description = $request->description;
            $discountCode->max_uses = $request->max_uses;
            $discountCode->max_uses_user = $request->max_uses_user;
            $discountCode->type = $request->type;
            $discountCode->discount_amount = $request->discount_amount;
            $discountCode->min_amount = $request->min_amount;
            $discountCode->status = $request->status;
            $discountCode->starts_at = $request->starts_at;
            $discountCode->expires_at = $request->expires_at;
            $discountCode->save();

            $message = 'Discount coupon added successfully';
            session()->flash('success',$message);

            return response()->json([
                'status' => true,
                'message' => 'Discount coupon updated successfully'
            ]);


        }else{//if validator fails
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    //delete
    public function destroy(Request $request,$id){
        $discountCode = DiscountCoupon::find($id);
        
        if($discountCode == null){
            session()->flash('error','Record not found');
            return response()->json([
                'status' => true
            ]);
        }


        $discountCode->delete();

        session()->flash('success','Discount Coupon deleted Successfully');
        return response()->json([
            'status' => true,
        ]);
    }

    

}
