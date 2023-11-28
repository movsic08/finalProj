<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    //index
    public function index(Request $request){
        $pages = Page::latest();
        if($request->keyword != ''){
            $pages = $pages->where('name','like','%'.$request->keyword.'%');
        }

        $pages = $pages->paginate(10);        

        return view('admin.pages.list',[
            'pages' => $pages
        ]);
    }

    //create
    public function create(){
        return view('admin.pages.create');
    }

    //store : post create
    public function store(Request $request){
        //dd($request->all());

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required',

        ]);

        if($validator->fails()){//if the input is invalid
            //return a json error response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]); 

        }

        //if no errors happen, create the page
        $page = new Page;
        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->content = $request->content;
        $page->save();

        $message = "Page added successfully";

        session()->flash('success',$message);

        //return a json success response
        return response()->json([
            'status' => true,
            'message' => $message
        ]);

    }

    //edit
    public function edit($id){

        $page = Page::find($id);

        if($page == null){ //if the page record is not found
            session()->flash('error','Page not found');
            return redirect()->route('pages.index');
        }

        return view('admin.pages.edit',[
            'page' => $page
        ]);

    }
    
    //update
    public function update(Request $request,$id){

        $page = Page::find($id);

        if($page == null){ //if the page record is not found
            session()->flash('error','Page not found');
            return response()->json([
                'status' => true
            ]);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required',

        ]);

        if($validator->fails()){//if the input is invalid
            //return a json error response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]); 

        }

        //if no errors happen, create the page
        $page->name = $request->name;
        $page->slug = $request->slug;
        $page->content = $request->content;
        $page->save();

        $message = "Page updated successfully";

        session()->flash('success',$message);

        //return a json success response
        return response()->json([
            'status' => true,
            'message' => $message
        ]);

    }

    //delete
    public function destroy($id){
        $page = Page::find($id);

        if($page == null){ //if the page record is not found
            session()->flash('error','Page not found');
            return response()->json([
                'status' => true
            ]);
        }

        $page->delete(); //if no errors found, delete the page

        $message = "Page deleted successfully";

        session()->flash('success',$message);
        return response()->json([
            'status' => true,
            'message' => $message
        ]);

    }




}
