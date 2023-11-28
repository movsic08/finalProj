<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class ReviewController extends Controller
{
    
    //index
    public function index(Request $request){

        // $reviews = Review::all();

        $reviews = Review::select('reviews.*','users.name as reviewer_name','products.title as product_title')
            ->latest()
            ->join('users','users.id','=','reviews.created_by')
            ->join('products','products.id','=','reviews.product_id');

        //check if the search filter is not null
        if(!empty($request->get('keyword'))){
            $reviews = $reviews->where('users.name','like','%'.$request->get('keyword').'%')
                ->orWhere('products.title','like','%'.$request->get('keyword').'%');
        }

        $reviews = $reviews->paginate(10);

        $data['reviews'] = $reviews;

        //returns the list
        return view('admin.reviews.list',compact('reviews'));

    }

    //add review
    public function add(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'order_id' => 'required',
            'product_id' => 'required',
            'rating' => 'required',

        ],[
            'rating.required' => 'Please enter your ratings for the product'
        ]);

        if($validator->passes()){
            // dd($request->all());
            $review = new Review();
            $review->order_id = $request->order_id;
            $review->product_id = $request->product_id;
            $review->rating = $request->rating;
            $review->review = $request->review;
            $review->created_by = Auth::user()->id;
            $review->save();

            session()->flash('success','Thank you for you review :)');

            return response()->json([
                'status' => true,
                'orderId' => $review->order_id
            ]);

        }else{

            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);

        }

    }

    //update
    public function update(Request $request,$review_id){
        // dd($request->all());

        $review = Review::find($request->review_id);

        $review->showOnReviews = $request->show;
        $review->save();

        session()->flash('success','Review Updated Successfully');

        return response()->json([
            'status' => true,
        ]);

    }

    //reply
    public function reply(Request $request){
        // dd($request->all());

        $review = Review::find($request->review_id);

        $review->review_reply = $request->review_reply;
        $review->save();

        session()->flash('success','Reply Sent Successfully');

        return response()->json([
            'status' => true,
        ]);

    }


    //ajax to get review
    public function get_review(Request $request){

        $review = $review = Review::find($request->review_id);
        
        
        return response()->json([
            "status" => true,
            "success" => view('admin.reviews._product_review_modal',[ 
                "review" => $review,

            ])->render(),
        ],200);

    }
    

}
