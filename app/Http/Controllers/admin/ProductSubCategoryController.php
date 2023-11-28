<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductSubCategoryController extends Controller
{
    //get sub_category based on the category selected
    public function index(Request $request){

        //if category is not empty  -> selected
        if(!empty($request->category_id)){
            //get sub_categories
            $subCategories = SubCategory::where('category_id',$request->category_id)
            ->orderBy('name','ASC')
            ->get();

            //return in json response
            return response()->json([
                'status' => true,
                'subCategories' => $subCategories,
            ]);
        }else{//return nothing
            return response()->json([
                'status' => true,
                'subCategories' => []
            ]);
        }
        

    }
}
