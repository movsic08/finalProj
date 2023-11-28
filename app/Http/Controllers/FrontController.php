<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Page;
use App\Models\Product;
use App\Models\Wishlist;
use App\Mail\ContactEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class FrontController extends Controller
{
    //index
    public function index(){

        //get Features products
        $products = Product::where('is_featured','Yes')
            ->orderBy('id','DESC')
            ->where('status',1)
            ->take(8)
            ->get();
        $data['featuredProducts'] = $products;

        //get latest products
        $latestProducts = Product::orderBy('id','DESC')
            ->where('status',1)
            ->take(8)
            ->get();
        $data['latestProducts'] = $latestProducts;
        return view('front.home',$data);
    }


    //add to wishlist
    public function addToWishlist(Request $request){
        //check if user is authenticated
        if(Auth::check() == false){

            //save the url to redirect when login success
            session(['url.intended' => url()->previous()]);

            return response()->json([ //return an error response
                'status' => false,
            ]);
        }

        //check if product exists
        $product = Product::where('id',$request->id)->first();
        
        //if product is not found
        if($product == null){
            return response()->json([
                'status' => true,
                'message' => '<div class="alert alert-danger">Product not found.</div>'
            ]);
        }


        Wishlist::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'product_id' => $request->id,
            ],
            [
                'user_id' => Auth::user()->id,
                'product_id' => $request->id,
            ]
        );



        //create Wishlist record of the user 
        // $wishlist = new Wishlist;
        // $wishlist->user_id = Auth::user()->id; //currently logged in user
        // $wishlist->product_id = $request->id; // product id passed on the requrest 
        // $wishlist->save();

        //return a json success response
        return response()->json([
            'status' => true,
            'message' => '<div class="alert alert-success"><strong>"'.$product->title.'"</strong> added in your wishlist</div>'
        ]);
        
    }


    //display pages
    public function page($slug){
        $page = Page::where('slug',$slug)->first();
        //dd($page);

        $data['page'] = $page;

        return view('front.page',$data);

    }

    //send contact email
    public function sendContactEmail(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required|min:10',

        ]);


        if($validator->passes()){

            //enter the mailData
            $mailData = [
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'mail_subject' => 'You have recieved a contact email'
            ];


            //get admin
            $admin = User::where('id',1)->first();

            Mail::to($admin->email)->send(new ContactEmail($mailData));


            session()->flash('success','Thanks for contacting us, we will get back to you soon');

            return response()->json([
                'status' => true,
            ]);

        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }


    
        
}
