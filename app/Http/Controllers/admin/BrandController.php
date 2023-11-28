<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;

class BrandController extends Controller
{
    //index
    public function index(Request $request){
        $brands = Brand::latest('id');

        if(!empty($request->get('keyword'))){
            $brands = $brands->where('name','like','%'.$request->get('keyword').'%');
        }

        $brands = $brands->paginate(10);
        return view('admin.brands.list',compact('brands'));
    }

    //create
    public function create(){
        return view('admin.brands.create');
    }

    //store
    public function store(Request $request){

        //checks the data passed
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:brands'
        ]);

        if($validator->passes()){//if the data passed are valid
 
            //create the brand
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();

            return response()->json([
                'status' => true,
                'message' => 'Brand added successfully'
            ]);

        }else{ //if invalid
            //return an ajax error response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }


    }

    //edit
    public function edit($id){

        //find and check if brand exists
        $brand = Brand::find($id);
        if(empty($brand)){
            $request->session()->flash('error','Record not found');
            return redirect()->route('brands.index');
        }

        $data['brand'] = $brand;
        return view('admin.brands.edit',$data);
    }

    //update
    public function update($id,Request $request){

        //find and check if brand exists
        $brand = Brand::find($id);
        if(empty($brand)){
            //return error session
            $request->session()->flash('error','Record not found');

            //return error ajax response
            return response()->json([
                'status' => false,
                'notFound' => true,
            ]);

        }


        //checks the data passed
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,'.$brand->id.',id',
        ]);

        if($validator->passes()){//if the data passed are valid
 
            //create the brand
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();

            return response()->json([
                'status' => true,
                'message' => 'Brand added successfully'
            ]);

        }else{ //if invalid
            //return an ajax error response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    //delete brand
    public function destroy($id,Request $request){
        
        //find and check if brand exist
        $brand = Brand::find($id);
        if(empty($brand)){
            $request->session()->flash('error','Record not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Record not found'
            ]);
        }

        $brand->delete();

        $request->session()->flash('success','Brand Successfully deleted');
        return response()->json([
            'status' => true,
            'message' => 'Brand Successfully deleted',
        ]);

        
    }

}
