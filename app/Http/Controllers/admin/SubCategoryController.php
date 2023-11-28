<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    //index
    public function index(Request $request){

        //left join sub_categories and categories
        $subCategories = SubCategory::select('sub_categories.*','categories.name as categoryName')
            ->latest('sub_categories.id')
            ->leftJoin('categories','categories.id','sub_categories.category_id');

        if(!empty($request->get('keyword'))){
            //search for sub_categories name
            $subCategories = $subCategories->where('sub_categories.name','like','%'.$request->get('keyword').'%');

            //or search for categories name
            $subCategories = $subCategories->orWhere('categories.name','like','%'.$request->get('keyword').'%');
        }

        $subCategories = $subCategories->paginate(10);

        return view('admin.sub_category.list',compact('subCategories'));

    }

    //create
    public function create(){
        //get categories
        $categories = Category::orderBy('name','ASC')->get();

        $data['categories'] = $categories;

        return view('admin.sub_category.create',$data);
    }

    //store 
    public function store(Request $request){

        //validate request
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:sub_categories',
            'category' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            
            //insert the data into the model
            $subCategory = new SubCategory();
            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;
            $subCategory->status = $request->status;
            $subCategory->category_id = $request->category;
            $subCategory->showHome = $request->showHome;
            $subCategory->save();

            //create a success session
            $request->session()->flash('success','Sub Category Added Successfully');

            //return a json success response
            return response()->json([
                'status' => true,
                'message' => 'Sub Category Added Successfully',
            ]);


        }else{
            //return a json error response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    //edit
    public function edit($id,Request $request){
        //find and check if category exist
        $subCategory = SubCategory::find($id);
        if(empty($subCategory)){    
            //return error session
            $request->session()->flash('error','Record not found');
            return redirect()->route('sub-categories.index');
        }


        $categories = Category::orderBy('name','ASC')->get();
        $data['subCategory'] = $subCategory;
        $data['categories'] = $categories;

        return view('admin.sub_category.edit',$data);
    }

    //post edit -> update
    public function update($id, Request $request){

        //find and check if the subCategory exist
        $subCategory = SubCategory::find($id);
        if(empty($subCategory)){
            $request->session()->flash('error','Record not found');
            // return redirect()->route('sub-categories.index');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Record not found',
            ]);
        }
        
        //validate request
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:sub_categories,slug,'.$subCategory->id.',id',
            'category' => 'required',
            'status' => 'required',
        ]);

        if($validator->passes()){
            
            //update the data into the model
            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;
            $subCategory->status = $request->status;
            $subCategory->category_id = $request->category;
            $subCategory->showHome = $request->showHome;
            $subCategory->save();

            //create a success session
            $request->session()->flash('success','Sub Category updated Successfully');

            //return a json success response
            return response()->json([
                'status' => true,
                'message' => 'Sub Category updated Successfully',
            ]);


        }else{
            //return a json error response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

    }

    //delete
    public function destroy($id, Request $request){
        $subCategory = SubCategory::find($id);
        if(empty($subCategory)){
            $request->session()->flash('error','Record not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Record not found'
            ]);
        }

        $subCategory->delete();

        $request->session()->flash('success','SubCategory Deleted Successfully');
        return response()->json([
            'status' => true,
            'message' => 'SubCategory Deleted Successfully'
        ]);


    }


}
