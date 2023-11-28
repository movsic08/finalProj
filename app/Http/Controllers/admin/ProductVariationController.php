<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Size;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductVariationController extends Controller
{
   

    //create
    public function create($product_id){

        //check if product exists
        $product = Product::find($product_id);
        if(empty($product)){
            return redirect()->route('products.index')->with('error','Product does not exists');
        }

        $data['product'] = $product;


        $colors = Color::orderBy('name','ASC')->get();
        $sizes = Size::orderBy('size','ASC')->get();

        $data['colors'] = $colors;
        $data['sizes'] = $sizes;

        return view('admin.product-variation.create',$data);
    }

    //store
    public function store(Request $request,$product_id){

        //dd($request->all());

        //check the results and format it
        $results = array();

        foreach ($request->stock_quantity as $key => $quantities) {
            
            $data = array();

            $data['sizes'] = $request->sizes_id[$key];
            $data['colors'] = $request->colors_id[$key];
            $data['stock_quantity'] = $request->stock_quantity[$key];

            $results[] = $data;
        }

        //dd($results);
        //dd($product_id);


        foreach($results as $result){

            //delete the matching records first from the database
            // ProductVariation::where('product_id',$product_id)->where('color_id',$)


            ProductVariation::updateOrCreate(
                [
                    'product_id' => $product_id,
                    'color_id' => $result['colors'],
                    'size_id' => $result['sizes'],
                ],
    
                [
                    'product_id' => $product_id,
                    'color_id' => $result['colors'],
                    'size_id' => $result['sizes'],
                    'stock_quantity' => $result['stock_quantity'],
                ]
            );

            
        }


        //update the quantity of the product
        $product = Product::find($product_id);
        
        $product->qty = $product->variations->sum('stock_quantity');

        $product->save();

        session()->flash('success','Product variation added successfully');
        return response()->json([
            'status' => true,
        ]);

        
        
       


    }


    //ajax to get product variations
    public function getProductVariations(Request $request,$product_id){
        //dd($request->all());

        $product = Product::find($product_id);
        
        $validator = Validator::make($request->all(),[
            'color' => 'required|array|min:1',
            'size' => 'required|array|min:1',
        ]);

        if($validator->passes()){
            
            $colors = Color::whereIn('id',$request->color)->orderBy('name','ASC')->get();
            $sizes = Size::whereIn('id',$request->size)->orderBy('size','ASC')->get();


            return response()->json([
                "status" => true,
                
                "success" => view('admin.product-variation._variation_form',[ 
                    "colors" => $colors,
                    "sizes" => $sizes,
                    "product" => $product,
                ])->render(),
            ],200);

        }else{
            //return a json error response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]); 
        }


    }

    
}
