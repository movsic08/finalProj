<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Product;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingCharge;
use App\Models\DiscountCoupon;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Rules\ValidPhillippinesPhoneNumber;
use App\Rules\ValidGcashNumber;
use Illuminate\Support\Carbon;
use App\Models\UserOtp;
use Image;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;

class CartController extends Controller
{
    //add to cart 
    public function addToCart(Request $request){
        //dd($request->all());

        //Cart::add('234ad','Product1',1,9,9.99); //sample

        //find product
        $product = Product::with('product_images')->find($request->id);

        if($product == null){// if null 

            //return a json error response
            return response()->json([
                'status' == false,
                'message' => 'Record not found',

            ]);
        }

        //modify the product_id
        //$product_id = $product->id.$request->color.$request->size;

        //check if the product selected has remaining stocks
        $product_variation = ProductVariation::where('product_id',$request->id)->where('color_id',$request->color_id)->where('size_id',$request->size_id)->first();

        //dd($product_variation->stock_quantity);

        if($product_variation->stock_quantity <= 0){// if null 

            //return a json error response
            return response()->json([
                'status' == false,
                'message' => 'No Stocks available',

            ]);
        }


        if(Cart::count() > 0){
            // echo "Product Already on Cart";
            // Products found in cart
            // Check if this product already in the cart
            // Return as message that the product is already added in your cart
            // if product not found in the cart, then add product in cart

            $cartContent = Cart::content();
            $productAlreadyExists = false;
            
            foreach ($cartContent as $item) { //check for id, color and size
                if($item->id == $product->id && $item->color == $request->color_id && $item->size == $request->size_id){
                    $productAlreadyExists = true;
                }
            }

            //if product does not exists in the cart
            if($productAlreadyExists == false){
                Cart::add($product->id,$product->title,1 ,$product->price,['productImage' => (!empty($product->product_images->first())) ? $product->product_images->first() : '','color' => $request->color_id,'size' => $request->size_id]);

                $status = true;
                $message = $product->title.' added in your cart successfully';
                session()->flash('success',$message);

            }else{ //product already in cart
                $status = false;
                $message = $product->title.' already added in cart';
            }


        }else{// if cart is totaly empty
            echo "Cart is empty, now adding a product in cart";
            //Cart is empty
            Cart::add($product->id,$product->title,1 ,$product->price,['productImage' => (!empty($product->product_images->first())) ? $product->product_images->first() : '','color' => $request->color_id,'size' => $request->size_id]);

            
            $status = true;
            $message = $product->title.' added in cart';
            session()->flash('success',$message);
        }

        //return a json response
        return response([
            'status' => $status,
            'message' => $message
        ]); 

    }

    //cart
    public function cart(){
        //dd(Cart::content());

        $cartContent = Cart::content();


        $data['cartContent'] = $cartContent;
        return view('front.cart',$data);
    }

    //update cart
    public function updateCart(Request $request){
        //get values
        $rowId = $request->rowId;
        $qty = $request->qty;

        $itemInfo = Cart::get($rowId);

        
        $product_variation = ProductVariation::where('product_id',$itemInfo->id)->where('color_id',$itemInfo->options->color)->where('size_id',$itemInfo->options->size)->first();


        $product_qty = $product_variation->stock_quantity;

        if($qty <= $product_qty){//if the qty requested is less than or equal to the stock of the product

            Cart::update($rowId,$qty);
            $message = 'Cart updated successfully';
            $status = true;
            session()->flash('success',$message);

        }else{

            $message = 'Request qty('.$qty.') is not available in stock';
            $status = false;
            session()->flash('error',$message);
        }



        //return the json response
        return response()->json([
            'status' => $status,
            'message' => $message
        ]);


    }

    //delete cart item
    public function deleteItem(Request $request){
        $itemInfo = Cart::get($request->rowId);


        //check if cart item exists
        if($itemInfo == null){

            //error meessage and session
            $errorMessage = 'Item not found in cart';
            session()->flash('error',$errorMessage);

            return response()->json([
                'status' => false,
                'message' => $errorMessage
            ]);
        }

        Cart::remove($request->rowId);

        //success meessage and session
        $message = 'Item removed from cart successfully ';
        session()->flash('success',$message);

        return response()->json([
            'status' => true,
            'message' => $message
        ]);

        

    }

    //checkout
    public function checkout(){

        $discount = 0;

        //--if cart is empty redirect to cart page
        if(Cart::count() == 0){
            return redirect()->route('front.cart');
        }

        //if user is not logged in then redirect to login page
        if(Auth::check() == false){

            if(!session()->has('url.intended')){
                session(['url.intended' => url()->current()]);
            }

            return redirect()->route('account.login');
        }

        //if the user email is not verified
        if( Auth::user()->phone_verified_at == null && Auth::user()->email_verified_at == null){
            return redirect()->route('account.profile')->with('error','Sorry, Email and Phone number must be verified first before you can proceed to your checkout');
        }

        //if the user email is not verified
        if( Auth::user()->email_verified_at == null){
            return redirect()->route('account.profile')->with('error','Sorry, Email must be verified first before you can proceed to your checkout');
        }

        //if the user email is not verified
        if( Auth::user()->phone_verified_at == null){
            return redirect()->route('account.profile')->with('error','Sorry, Phone number must be verified first before you can proceed to your checkout');
        }

        

        $customerAddress = CustomerAddress::where('user_id',Auth::user()->id)->first(); //find the Customer Address by the first occurence matching user_id
        //dd($customerAddress);

        //forget the session url
        session()->forget('url.intended');

        //get countries
        $countries = Country::orderBy('name','ASC')->get();

        $subTotal = Cart::subtotal(2,'.','');

        //Apply Discount here -> check the method applyDiscount to see how the session code has been added and validated
        if(session()->has('code')){
            $code = session()->get('code');
            if($code->type == 'percent'){ //if discount is percent
                $discount = ($code->discount_amount / 100) * $subTotal;
            }else{  //if discount is fixed
                $discount = $code->discount_amount;
            }
        }
        

        if(!empty($customerAddress)){
            //Calculate Shipping here
            // $userCountry = $customerAddress->country_id; //modify the value
            $userCountry = '170';
            $region_code = $customerAddress->region_code;
            $province_code = $customerAddress->province_code;
            $city_municipality_code = $customerAddress->city_municipality_code;
            $barangay_code = $customerAddress->barangay_code;

            
            $shippingInfo = ShippingCharge::where('country_id',$userCountry)
                ->where('region_code',$region_code)
                ->where('province_code',$province_code)
                ->where('city_municipality_code',$city_municipality_code)
                ->where('barangay_code',$barangay_code)
                ->first();
            //dd($shippingInfo);

            

            $totalQty = 0;  //total count of all cart items
            $totalShippingCharge = 0; //total shipping charge
            foreach(Cart::content() as $item){
                $totalQty += $item->qty;
            }

            //if the shipping is not empty
            if(!empty($shippingInfo)){
                //calculate for the total shipping charge
                $totalShippingCharge = $totalQty  * $shippingInfo->amount;
            }
            

            //grand total
            $grandTotal = ($subTotal - $discount) + $totalShippingCharge;
            

        }else{ //if there is no record CustomerAddress
            $grandTotal = ($subTotal - $discount);
            $totalShippingCharge = 0; //total shipping charge
        }


        
        
        return view('front.checkout',[
            'countries' => $countries,
            'customerAddress' => $customerAddress,
            'totalShippingCharge' => $totalShippingCharge,
            'discount' => $discount,
            'grandTotal' => $grandTotal 
        ]);
    }

    //post : checkout
    public function processCheckout(Request $request){
        // step - 1 Apply Validation
        $validator = Validator::make($request->all(),[
            'first_name' => 'required|min:1',
            'last_name' => 'required',
            'email' => 'required|email',
            // 'country' => 'required',
            'region_code' => 'required',
            'province_code' => 'required',
            'city_municipality_code' => 'required',
            'barangay_code' => 'required',
            'address' => 'required|min:10',
            // 'city' => 'required',
            // 'state' => 'required',
            'zip' => 'required',
            'payment_method' => 'required',
            'mobile' => [
                'required',
                new ValidPhillippinesPhoneNumber(), //this is a custom validation rule that we created
            ],

            
            
        ]);

    
        //validation
        if($validator->fails()){
            return response()->json([
                'message' =>' Please fix the errors',
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }   

        //step 2 : save user address
        //$customerAddress = CustomerAddress::find();

        $user = Auth::user();

        CustomerAddress::updateOrCreate(
            ['user_id' => $user->id],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'country_id' => 170,
                'address' => $request->address,
                'apartment' => $request->apartment,
                'region_code' => $request->region_code,
                'province_code' => $request->province_code,
                'city_municipality_code' => $request->city_municipality_code,
                'barangay_code' => $request->barangay_code,
                'zip' => $request->zip
            ]
        );


        //step 3 : store data in orders table
        if($request->payment_method == 'cod'){

            //for testing
            // dd("cod is working");

            //default values
            $shipping = 0;
            $discountCodeId = NULL;
            $promoCode = '';
            $discount = 0;
            $subtotal = Cart::subtotal(2,'.','');
            $grandTotal = $subtotal + $shipping;

            //Apply Discount here -> check the method applyDiscount to see how the session code has been added and validated
            if(session()->has('code')){
                $code = session()->get('code');
                if($code->type == 'percent'){ //if discount is percent
                    $discount = ($code->discount_amount / 100) * $subtotal;
                }else{  //if discount is fixed
                    $discount = $code->discount_amount;
                }

                $discountCodeId = $code->id;
                $promoCode = $code->code;
            }

            //Calculate Shipping
                //get shipping info
                $shippingInfo = ShippingCharge::where('country_id','170') //default for PH
                    ->where('region_code',$request->region_code)
                    ->where('province_code',$request->province_code)
                    ->where('city_municipality_code',$request->city_municipality_code)
                    ->where('barangay_code',$request->barangay_code)
                    ->first();

                    
                //get total cart items
                $totalQty = 0;
                foreach(Cart::content() as $item){
                    $totalQty += $item->qty;
                }

                if($shippingInfo != null){
                    $shipping = $totalQty * $shippingInfo->amount; // get shipping fee 
                    $grandTotal = ($subtotal - $discount) + $shipping;

                }else{
                    $shippingInfo = ShippingCharge::where('country_id','rest_of_world')->first();
                    
                    if($shippingInfo != null){
                        $shipping = $totalQty * $shippingInfo->amount; // get shipping fee 
                    }
                    
                    $grandTotal = ($subtotal - $discount) + $shipping;

                }

                
            //end of Shipping Calculation 

           

            $order =  new Order;
            $order->subtotal = $subtotal;
            $order->shipping = $shipping;
            $order->grandtotal = $grandTotal;

            $order->discount = $discount;
            $order->coupon_code_id = $discountCodeId;
            $order->coupon_code = $promoCode;

            $order->payment_status = 'not paid';
            $order->status = 'pending';

            $order->user_id = $user->id;
            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->email = $request->email;
            $order->mobile = $request->mobile;
            $order->region_code = $request->region_code;
            $order->province_code = $request->province_code;
            $order->city_municipality_code = $request->city_municipality_code;
            $order->barangay_code = $request->barangay_code;
            $order->address = $request->address;
            $order->apartment = $request->apartment;
            // $order->state = $request->state;
            // $order->city = $request->city;
            $order->zip = $request->zip;
            $order->notes = $request->order_notes;
            $order->country_id = 170;
            $order->save();

            // step 4 : store order items in order items table

            //save new Order Items in each cart item
            foreach(Cart::content() as $item){
                $orderItem = new OrderItem;
                $orderItem->product_id = $item->id;
                $orderItem->size_id = $item->options->size;
                $orderItem->color_id = $item->options->color;
                $orderItem->order_id = $order->id;
                $orderItem->name = $item->name;
                $orderItem->qty = $item->qty;
                $orderItem->price = $item->price;
                $orderItem->total = $item->price * $item->qty;
                $orderItem->save();

                //Update product stock on ProductVariations
                    $productData = ProductVariation::where('product_id',$item->id)->where('color_id',$item->options->color)->where('size_id',$item->options->size)->first();
                    
                    $currentQty = $productData->stock_quantity; //current product stocks
                    $updatedQty = $currentQty - $item->qty; //updated product qty
                    $productData->stock_quantity = $updatedQty; // save into the product record the updated qty
                    $productData->save(); 

                //end of ProductVariation update

                //Update Product
                    //update the quantity of the product
                    $product = Product::find($item->id);
                    
                    $product->qty = $product->variations->sum('stock_quantity');

                    $product->save();   

                //end of Update Product
                



            }

            //Send Order Email
            orderEmail($order->id,'customer');

            //Send Order SMS confirmation
            UserOtp::sendOrderSuccessMessage($order->mobile,$order);

            session()->flash('success','You have successfully placed your order');

            //destroy the cart 
            Cart::destroy();

            //forget the code is there is a code on the session
            session()->forget('code');

            //return a json success response
            return response()->json([
                'message' => 'Order saved successfully',
                'orderId' => $order->id,
                'status' => true,
            ]);


        }else if($request->payment_method == 'gcash'){

            //temporary for testing
            // dd("Gcash is working");


            $gcash_validator = Validator::make($request->all(),[
                'gcash_name' => 'required|min:1',
                'gcash_number' => [
                        'required',
                        new ValidGcashNumber(),
                ],
                'gcash_photo_reciept' => 'required',
                'gcash_ref_number' => 'required',
                'gcash_sent_to' => 'required',
            ]);


            if($gcash_validator->passes()){ //gcash inputted credentials  is valid





                
            //default values
            $shipping = 0;
            $discountCodeId = NULL;
            $promoCode = '';
            $discount = 0;
            $subtotal = Cart::subtotal(2,'.','');
            $grandTotal = $subtotal + $shipping;

            //Apply Discount here -> check the method applyDiscount to see how the session code has been added and validated
            if(session()->has('code')){
                $code = session()->get('code');
                if($code->type == 'percent'){ //if discount is percent
                    $discount = ($code->discount_amount / 100) * $subtotal;
                }else{  //if discount is fixed
                    $discount = $code->discount_amount;
                }

                $discountCodeId = $code->id;
                $promoCode = $code->code;
            }

            //Calculate Shipping
                //get shipping info
                $shippingInfo = ShippingCharge::where('country_id','170') //default for PH
                    ->where('region_code',$request->region_code)
                    ->where('province_code',$request->province_code)
                    ->where('city_municipality_code',$request->city_municipality_code)
                    ->where('barangay_code',$request->barangay_code)
                    ->first();

                    
                //get total cart items
                $totalQty = 0;
                foreach(Cart::content() as $item){
                    $totalQty += $item->qty;
                }

                if($shippingInfo != null){
                    $shipping = $totalQty * $shippingInfo->amount; // get shipping fee 
                    $grandTotal = ($subtotal - $discount) + $shipping;

                }else{
                    $shippingInfo = ShippingCharge::where('country_id','rest_of_world')->first();
                    
                    if($shippingInfo != null){
                        $shipping = $totalQty * $shippingInfo->amount; // get shipping fee 
                    }
                    
                    $grandTotal = ($subtotal - $discount) + $shipping;

                }

                
            //end of Shipping Calculation 

           

            $order =  new Order;
            $order->subtotal = $subtotal;
            $order->shipping = $shipping;
            $order->grandtotal = $grandTotal;

            $order->discount = $discount;
            $order->coupon_code_id = $discountCodeId;
            $order->coupon_code = $promoCode;

            $order->payment_status = 'not paid';
            $order->status = 'pending';

            $order->user_id = $user->id;
            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->email = $request->email;
            $order->mobile = $request->mobile;
            $order->region_code = $request->region_code;
            $order->province_code = $request->province_code;
            $order->city_municipality_code = $request->city_municipality_code;
            $order->barangay_code = $request->barangay_code;
            $order->address = $request->address;
            $order->apartment = $request->apartment;
            // $order->state = $request->state;
            // $order->city = $request->city;
            $order->zip = $request->zip;
            $order->notes = $request->order_notes;
            $order->country_id = 170;

            $order->gcash_name = $request->gcash_name;
            $order->gcash_number = $request->gcash_number;
            $order->gcash_ref_number = $request->gcash_ref_number;
            $order->gcash_sent_to = $request->gcash_sent_to;
            


            //Save image here
            if(!empty($request->gcash_photo_reciept)){
                $tempImage = TempImage::find($request->gcash_photo_reciept);   //find the image_id from the TempImag model database
                $extArray = explode('.',$tempImage->name);  //get the extension array
                $ext = last($extArray);     //the last . occcurence is the extension -> get the extension

                $newImageName = $order->id.'.'.$ext; //create a new name
                $sPath = public_path().'/temp/'.$tempImage->name; //get the source path
                $dPath = public_path().'/uploads/gcash/'.$newImageName;  //get the destination path
                File::copy($sPath,$dPath); //copy

                //Generate Image Thumbnail
                $dPath = public_path().'/uploads/gcash/thumb/'.$newImageName;
                $img = Image::make($sPath);
                //$img->resize(450,600);
                // $img->fit(450,600,function($constraint){
                //     $constraint->upsize();
                // });
                $img->save($dPath);

                $order->gcash_photo_reciept = $newImageName;
               
            }
            
            
                        

            $order->save();

            // step 4 : store order items in order items table

            //save new Order Items in each cart item
            foreach(Cart::content() as $item){
                $orderItem = new OrderItem;
                $orderItem->product_id = $item->id;
                $orderItem->size_id = $item->options->size;
                $orderItem->color_id = $item->options->color;
                $orderItem->order_id = $order->id;
                $orderItem->name = $item->name;
                $orderItem->qty = $item->qty;
                $orderItem->price = $item->price;
                $orderItem->total = $item->price * $item->qty;
                $orderItem->save();

                //Update product stock on ProductVariations
                    $productData = ProductVariation::where('product_id',$item->id)->where('color_id',$item->options->color)->where('size_id',$item->options->size)->first();
                    
                    $currentQty = $productData->stock_quantity; //current product stocks
                    $updatedQty = $currentQty - $item->qty; //updated product qty
                    $productData->stock_quantity = $updatedQty; // save into the product record the updated qty
                    $productData->save(); 

                //end of ProductVariation update

                //Update Product
                    //update the quantity of the product
                    $product = Product::find($item->id);
                    
                    $product->qty = $product->variations->sum('stock_quantity');

                    $product->save();   

                //end of Update Product
                



            }

            //Send Order Email
            orderEmail($order->id,'customer');

            //Send Order SMS confirmation
            UserOtp::sendOrderSuccessMessage($order->mobile,$order);

            session()->flash('success','You have successfully placed your order');

            //destroy the cart 
            Cart::destroy();

            //forget the code is there is a code on the session
            session()->forget('code');

            //return a json success response
            return response()->json([
                'message' => 'Order saved successfully',
                'orderId' => $order->id,
                'status' => true,
            ]);






            }else{ //gcash credentials is invalid

                return response()->json([
                    'status' => false,
                    'errors' => $gcash_validator->errors()
                ]);
            }
            

        }else{

        }


    }

    //thank you
    public function thankyou($id){
        return view('front.thanks',[
            'id' => $id
        ]);
    }

    //get Order summery
    public function getOrderSummery(Request $request){
        //dd($request->all());

        $shippingCharge = 0;
        $subTotal = Cart::subtotal(2,'.','');
        $discount = 0;
        $discountString = "";

        //Apply Discount here -> check the method applyDiscount to see how the session code has been added and validated
        if(session()->has('code')){
            $code = session()->get('code');
            if($code->type == 'percent'){ //if discount is percent
                $discount = ($code->discount_amount / 100) * $subTotal;
            }else{  //if discount is fixed
                $discount = $code->discount_amount;
            }

            $discountString = '<div class=" mt-4" id="discount-row">
                <strong >
                '.session()->get('code')->code.'
                </strong>
                <a class=" btn btn-sm btn-danger" id="remove-discount"><i class="fa fa-times"></i></a>
            </div>';
        }

        //check if there is a passed country_id
        if(!empty($request->region_code) && !empty($request->province_code) && !empty($request->city_municipality_code) && !empty($request->barangay_code) ){

            
            //check shipping info with all the parameters
            $shippingInfo = ShippingCharge::where('country_id','170') //default for PH
                ->where('region_code',$request->region_code)
                ->where('province_code',$request->province_code)
                ->where('city_municipality_code',$request->city_municipality_code)
                ->where('barangay_code',$request->barangay_code)
                ->first();


            //get total of cart items
            $totalQty = 0;
            foreach(Cart::content() as $item){
                $totalQty += $item->qty;
            }


            if($shippingInfo != null){
                $shippingCharge = $totalQty * $shippingInfo->amount; // get shipping fee 

                $grandTotal = ($subTotal - $discount) + $shippingCharge;

                return response()->json([
                    'status' => true,
                    'grandTotal' => number_format($grandTotal,2),
                    'discount' => number_format($discount,2),
                    'discountString' => $discountString,
                    'shippingCharge' => number_format($shippingCharge,2) ,

                ]);

            }else{
                $shippingInfo = ShippingCharge::where('country_id','rest_of_world')->first();
                
                if($shippingInfo != null){
                    $shippingCharge = $totalQty * $shippingInfo->amount; // get shipping fee 
                }
                
                $grandTotal = ($subTotal - $discount) + $shippingCharge;

                return response()->json([
                    'status' => true,
                    'grandTotal' => number_format($grandTotal,2),
                    'discount' => number_format($discount,2),
                    'discountString' => $discountString,
                    'shippingCharge' => number_format($shippingCharge,2) ,

                ]);

            }



        }else{
            return response()->json([
                'status' => true,
                'grandTotal' => number_format(($subTotal - $discount),2),
                'shippingCharge' => number_format(0,2),
                'discount' =>  number_format($discount,2),
                'discountString' => $discountString,
            ]);
        }
    }

    //apply discount
    public function applyDiscount(Request $request){
        // dd($request->code);

        $code = DiscountCoupon::where('code',$request->code)->first();

        if($code == null){  //if the code is not found on the records of discount coupons
            //return a json error response
            return response()->json([
                'status' => false,
                'message' => 'Invalid discount coupon',
            ]);
        }

        //check if coupon start date is valid or not
        $now = Carbon::now();

        //for testing
        //echo $now->format('Y-m-d H:i:s');

        //check the date of start of the coupon code
        if($code->starts_at != ""){
            $startDate = Carbon::createFromFormat('Y-m-d H:i:s',$code->starts_at);

            //lt = less than : if today is less than the start date --> meaning the coupon had not yet been started to be active
            if($now->lt($startDate)){
                //return a error json response
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid discount coupon - start date had not began yet',
                ]);
            }

        }

        //check the expiry date of the coupon
        if($code->expires_at != ""){
            $endDate = Carbon::createFromFormat('Y-m-d H:i:s',$code->expires_at);

            //lt = less than : if today is more than the end date/expiry date --> meaning the coupon had exceeded the time it is active
            if($now->gt($endDate)){
                //return a error json response
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid discount coupon - expiry date had been reached',
                ]);
            }

        }

        //Max Uses Check
        //check if there is a limit to the max uses
        if($code->max_uses > 0){
            //check the number of times the coupon is used
            $couponUsed = Order::where('coupon_code_id',$code->id)->count();
            if($couponUsed >= $code->max_uses){ // if coupon is used exceeding the limit it can be used
                //return error json response 
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid discount coupon - coupon had exceed the max uses limit'
                ]);
            }
        }
        

        //Max Uses User Check
        //check if there is a limit on the max uses per user
        if($code->max_uses_user > 0){
            //check the number of times the user had used this coupon
            $couponUsedByUser = Order::where(['coupon_code_id' => $code->id, 'user_id' => Auth::user()->id])->count(); //nice code to enter two parameters on the where clause
            if($couponUsedByUser >= $code->max_uses_user){
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid discount coupon - You have already used this coupon and exceeded the limit.'
                ]);
            }
        }
        
        //Min amount condition check
        //get subtotal
        $subTotal = Cart::subtotal(2,'.','');
        //check if there is minimum amount
        if($code->min_amount > 0){
            //check it the subTotal is more than the minimum amount
            if($subTotal < $code->min_amount){
                //return a json error response
                return response()->json([
                    'status' => false,
                    'message' => 'Your min amount must be &#8369; '.$code->min_amount,
                ]);
            }
        }



        //if no errors happen
        //add a new session variable
        session()->put('code',$code);   //code to put something with a key and value on the session
        return $this->getOrderSummery($request);
        //this code redirects us with the request to the method above, and also adds a session for the coupon code validated

    }

    //remove coupon
    public function removeCoupon(Request $request){
        session()->forget('code'); //code to forget/remove something with the key from the session
        return $this->getOrderSummery($request);
        //this code redirects us with the request to the method (getOrderSummery) with the request, and also removes the session of coupon code
    }

    //cancel order
    public function cancelOrder($id){
        // dd($id);

        $order = Order::find($id);

        if(!empty($order)){

            $order->delete();
            

            return redirect()->route('account.orders')->with('success','Order cancelled');
        }else{
            return redirect()->route('account.orders')->with('error','Order does not exist');
        }


       
    }

}

