<?php

namespace App\Http\Controllers\admin;

use App\Models\Category;
use App\Models\TempImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Image;

class CategoryController extends Controller
{
    //index
    public function index(Request $request){

        $categories = Category::latest();

        //check if the search filter is not null
        if(!empty($request->get('keyword'))){
            $categories = $categories->where('name','like','%'.$request->get('keyword').'%');
        }

        $categories = $categories->paginate(10);

        $data['categories'] = $categories;

        //returns the list
        return view('admin.category.list',compact('categories'));
    }

    //create
    public function create(){
        //return "Category create";

        return view('admin.category.create');
    }

    //post create
    public function store(Request $request){

        //verify the passed parameters
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:categories',
        ]);

        //if the parameters are valid
        if($validator->passes()){

            //insert the category
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $category->save();


            //Save image here
            if(!empty($request->image_id)){
                $tempImage = TempImage::find($request->image_id);   //find the image_id from the TempImag model database
                $extArray = explode('.',$tempImage->name);  //get the extension array
                $ext = last($extArray);     //the last . occcurence is the extension -> get the extension

                $newImageName = $category->id.'.'.$ext; //create a new name
                $sPath = public_path().'/temp/'.$tempImage->name; //get the source path
                $dPath = public_path().'/uploads/category/'.$newImageName;  //get the destination path
                File::copy($sPath,$dPath); //copy

                //Generate Image Thumbnail
                $dPath = public_path().'/uploads/category/thumb/'.$newImageName;
                $img = Image::make($sPath);
                //$img->resize(450,600);
                $img->fit(450,600,function($constraint){
                    $constraint->upsize();
                });
                $img->save($dPath);

                $category->image = $newImageName;
                $category->save();
            }


            $request->session()->flash('success','Category added successfully');

            return response()->json([
                'status' => true,
                'message' => 'Category added successfully',
            ]);



        }else{//return the json error response

            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
            

        }
    }

    //edit
    public function edit($categoryId, Request $request){
        $category = Category::find($categoryId);

        //if the category is not found
        if(empty($category)){
            return redirect()->route('categories.index');
        }

        return view('admin.category.edit', compact('category'));
    }

    //post edit -> check route because the method for this one is Route::put()
    public function update($categoryId,Request $request){

        $category = Category::find($categoryId);
        
        if(empty($category)){//check if category is not empty

            //return a error session response
            $request->session()->flash('error','Category not found');

            //ajax error response
            return response->json([
                //return an error response if the category is not found
                'status' => false,
                'notFound' => true,
                'message' => 'Category not found'
            ]);
        }


        //verify the passed parameters
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$category->id.',id',
        ]);

        //if the parameters are valid
        if($validator->passes()){

            //update the category
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $category->save();

            $oldImage = $category->image;


            //Save image here
            if(!empty($request->image_id)){
                $tempImage = TempImage::find($request->image_id);   //find the image_id from the TempImag model database
                $extArray = explode('.',$tempImage->name);  //get the extension array
                $ext = last($extArray);     //the last . occcurence is the extension -> get the extension

                $newImageName = $category->id.'-'.time().'.'.$ext; //create a new name
                $sPath = public_path().'/temp/'.$tempImage->name; //get the source path
                $dPath = public_path().'/uploads/category/'.$newImageName;  //get the destination path
                File::copy($sPath,$dPath); //copy

                //Generate Image Thumbnail
                $dPath = public_path().'/uploads/category/thumb/'.$newImageName;
                $img = Image::make($sPath);
                //$img->resize(450,600);
                $img->fit(450,600,function($constraint){
                    $constraint->upsize();
                });

                $img->save($dPath);

                $category->image = $newImageName;
                $category->save();

                //Delete old image
                File::delete(public_path().'/uploads/category/thumb/'.$oldImage);
                File::delete(public_path().'/uploads/category/'.$oldImage);

            }


            $request->session()->flash('success','Category updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Category added successfully',
            ]);



        }else{//return the json error response

            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
            

        }

    }

    public function destroy($categoryId, Request $request){
        $category = Category::find($categoryId);
        if(empty($category)){
            //return redirect()->route('categories.index');
            //instead of redirecting, we will return a json error response and a error session
            $request->session()->flash('error','Category not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Category not found'
            ]);
        }

        //delete the images for the category
        File::delete(public_path().'/uploads/category/thumb/'.$category->image);
        File::delete(public_path().'/uploads/category/'.$category->image);

        //delete the category
        $category->delete();

        $request->session()->flash('success','Category deleted successfully');

        return response()->json([   
            'status' => true,
            'message' => 'Category deleted successfully'
        ]);

    }
}
