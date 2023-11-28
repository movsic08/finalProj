<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    //index
    public function index(Request $request){
        
        $sizes = Size::select('sizes.*');

        if($request->get('keyword')){
            $sizes = $sizes->where('size','like','%'.$request->get('keyword').'%');
        }



        $sizes = $sizes->orderBy('size','ASC')
            ->paginate(10);

        return view('admin.sizes.list',compact('sizes'));

    }

    //create
    public function create(){

        return view('admin.sizes.create');
    }

    //store
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'size' => 'required|unique:sizes'
        ]);

        if($validator->passes()){
            $size = new Size;
            $size->size = $request->size;
            $size->save();

            $message = 'Size added successfully';
            //return a success session
            session()->flash('success',$message);

            return response()->json([
                'status' => true,
                'message' => $message
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
    public function edit($id){

        $size = Size::find($id);

        if(empty($size)){

            session()->flash('error','Size not found');

            return redirect()->route('sizes.index');
        }

        return view('admin.sizes.edit',compact('size'));


    }

    //update
    public function update(Request $request,$id){

        $size = Size::find($id);

        if(empty($size)){

            session()->flash('error','Size not found');

            return response()->json([
                'status' => true,
            ]);
        }


        $validator = Validator::make($request->all(),[
            'size' => 'required|unique:sizes,size,'.$id.',id',
        ]);

        if($validator->passes()){

            $size->size = $request->size;
            $size->save();

            $message = 'Size updated successfully';
            //return a success session
            session()->flash('success',$message);

            return response()->json([
                'status' => true,
                'message' => $message
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
    public function destroy(){

    }
}
