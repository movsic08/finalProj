<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    //index
    public function index(Request $request){

        $colors = Color::latest();

        //check if the search filter is not null
        if(!empty($request->get('keyword'))){
            $colors = $colors->where('name','like','%'.$request->get('keyword').'%');
        }

        $colors = $colors->paginate(10);

        $data['colors'] = $colors;

        return view('admin.color.list',$data);
    }

    //create
    public function create(){

        return view('admin.color.create');
    }   

    //store
    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:colors',
            'color' => 'required|unique:colors'
        ]);

        if($validator->passes()){ //save the color

            $color = new Color;
            $color->name = $request->name;
            $color->slug = $request->slug;
            $color->color = $request->color;
            $color->save();

            $message = 'Color added Successfully';

            //return a session success reponse
            session()->flash('success',$message);

            //return a json response
            return response()->json([
                'status' => true,
                'message' => $message
            ]);


        }else{ //return a json error response

            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);

        }


    }

    //edit
    public function edit($id){
        $color  = Color::find($id);

        if(empty($color)){
            session()->flash('error','Color not found');
            return redirect()->route('colors.index');
        }

        return view('admin.color.edit',compact('color'));

    }

    //update
    public function update(Request $request,$id){

        $color  = Color::find($id);

        if(empty($color)){
            session()->flash('error','Color not found');
            return redirect()->route('colors.index');
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:colors,slug,'.$color->id.',id',
            'color' => 'required|unique:colors,color,'.$color->id.',id',
        ]);

        if($validator->passes()){ //save the color

            $color->name = $request->name;
            $color->slug = $request->slug;
            $color->color = $request->color;
            $color->save();

            $message = 'Color updated Successfully';

            //return a session success reponse
            session()->flash('success',$message);

            //return a json response
            return response()->json([
                'status' => true,
                'message' => $message
            ]);


        }else{ //return a json error response

            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);

        }

    }

    //delete
    public function destroy($id){
        $color  = Color::find($id);

        if(empty($color)){
            session()->flash('error','Color not found');
        
            return response()->json([
                'status' => true
            ]);

        }

        $color->delete();

        session()->flash('success','Color deleted successfully');
        
        return response()->json([
            'status' => true
        ]);


    }

}
