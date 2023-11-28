<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\TempImage;
use App\Models\SubCategory;
use App\Models\Size;
use App\Models\Color;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariation;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Image;
use DB;


class ProductController extends Controller
{
    //index
    public function index(Request $request){
        //the product_images is a relation Product model function that fetches the connected ProductImage instances to the id of the Product
        $products = Product::latest('id');
        
        if(!empty($request->get('keyword'))){
            $products = $products->where('title','like','%'.$request->keyword.'%')
                ->orWhere('slug','like','%'.$request->keyword.'%');
        }
        
        $products = $products->with('product_images')->paginate();
        //dd($products);

        $data['products'] = $products;

       

        return view('admin.products.list',$data);
    }


    //create
    public function create(){

        $data = [];
        
        //get categories
        $categories = Category::orderBy('name','ASC')->get();
        $brands = Brand::orderBy('name','ASC')->get();
        //get colors
        $colors = Color::orderBy('id')->get();
        //get sizes
        $sizes = Size::orderBy('size','ASC')->get();
        

        //insert into the data array
        $data['categories'] = $categories;
        $data['brands'] = $brands;
        $data['colors'] = $colors;  //dd($colors);
        $data['sizes'] = $sizes;

        return view('admin.products.create',$data);
    }

    //store
    public function store(Request $request){
        //check $request
        //dd($request->image_array);
        //dd($request->colors);
        //dd($request->sizes);
        // exit();

        //validate the request
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:products',
            'price' => 'required|numeric',
            'sku' => 'required|unique:products',
            // 'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
            // 'colors' => 'required|array|min:1',
            // 'sizes' => 'required|array|min:1',
        ];

        // if track_qty is yes, qty will be required and must be numeric
        // if( !empty($request->track_qty) && $request->track_qty == 'Yes' ){
        //     $rules['qty'] = 'required|numeric';
        // }

        //check in the validator
        $validator = Validator::make($request->all(),$rules);


        if($validator->passes()){ //if request is valid

            $product = new Product();
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->short_description = $request->short_description;
            $product->description = $request->description;
            $product->shipping_returns = $request->shipping_returns;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            // $product->track_qty = $request->track_qty;
            // $product->qty = $request->qty;
            $product->status = $request->status;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->is_featured = $request->is_featured;
            $product->related_products = (!empty($request->related_products)) ? implode(',',$request->related_products) : '';
            $product->save();


            //Save gallery pics
            if(!empty($request->image_array)){
                foreach ($request->image_array as $temp_image_id) {

                    $tempImageInfo = TempImage::find($temp_image_id);
                    $extArray = explode('.',$tempImageInfo->name);
                    $ext = last($extArray); // like jpg, gif, png, etc

                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image = 'NULL';
                    $productImage->save();

                    $imageName = $product->id.'-'.$productImage->id.'-'.time().'.'.$ext;
                    // product_id => 4 ; product_image_id => 1
                    // imageName = 4-1-123123124.jpg

                    $productImage->image = $imageName;
                    $productImage->save();

                    //Generate product Image thumbnails

                        //Large Image
                        $sourcePath = public_path().'/temp/'.$tempImageInfo->name;
                        //$destPath = public_path().'/uploads/product/large/'.$tempImageInfo->name;
                        $destPath = public_path().'/uploads/product/large/'.$imageName;
                        $image = Image::make($sourcePath);
                        $image->resize(1400, null, function($constraint){
                            $constraint->aspectRatio();
                        });
                        $image->save($destPath);

                        //Small Image
                        //$sourcePath = public_path().'/temp/'.$tempImageInfo->name;
                        //$destPath = public_path().'/uploads/product/small/'.$tempImageInfo->name;
                        $destPath = public_path().'/uploads/product/small/'.$imageName;
                        $image = Image::make($sourcePath);
                        $image->fit(300,300);
                        $image->save($destPath);



                    //emd of Generate product Image thumbnails


                }
            }

            //return success session
            $request->session()->flash('success','Product added successfully');

            //return a json response
            return response()->json([
                'status' => true,
                'message' => 'Product added successfully',
            ]);


        }else{ // if invalid, return the json error response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]); 
        }

    }


    //edit
    public function edit($id,Request $request){

        $product = Product::find($id);

        //check if product exist
        if(empty($product)){
            $request->session()->flash('error','Product not found');
            return redirect()->route('products.index')->with('error','Product not found');
        }

        //fetch product images
        $productImages = ProductImage::where('product_id',$product->id)->get();

        $relatedProducts = []; //temp con

        //fetch related products
        if($product->related_products != ''){
            $productArray = explode(',',$product->related_products); //fetch the ids of related products imploded
            //get the products
            $relatedProducts = Product::whereIn('id',$productArray)->get();
        }


        $data = [];
        $data['product'] = $product;
        $categories = Category::orderBy('name','ASC')->get();
        $brands = Brand::orderBy('name','ASC')->get();
        //get subCategories 
        $subCategories = SubCategory::where('category_id',$product->category_id)->get();
        //get colors
        $colors = Color::orderBy('id')->get();
        //get sizes
        $sizes = Size::orderBy('size','ASC')->get();
        //get product colros
        

        


        $data['categories'] = $categories;
        $data['brands'] = $brands;
        $data['subCategories'] = $subCategories;
        $data['productImages'] = $productImages;
        $data['relatedProducts'] = $relatedProducts;
        $data['colors'] = $colors;  //dd($colors);
        $data['sizes'] = $sizes;

        return view('admin.products.edit',$data);
    }

    //update - post edit
    public function update($id,Request $request){
        //check $request
        // dd($request->image_array);
        //dd($request->colors);

        // exit();
        // return false;

        $product = Product::find($id);

        //validate the request
        $rules = [
            'title' => 'required',
            'slug' => 'required|unique:products,slug,'.$product->id.',id',
            'price' => 'required|numeric',
            'sku' => 'required|unique:products,sku,'.$product->id.',id',
            // 'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
            
            // 'colors' => 'required|array|min:1',
            // 'sizes' => 'required|array|min:1',
        ];

        // // if track_qty is yes, qty will be required and must be numeric
        // if( !empty($request->track_qty) && $request->track_qty == 'Yes' ){
        //     $rules['qty'] = 'required|numeric';
        // }

        //check in the validator
        $validator = Validator::make($request->all(),$rules);

        if($validator->passes()){ //if request is valid

            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->short_description = $request->short_description;
            $product->description = $request->description;
            $product->shipping_returns = $request->shipping_returns;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            // $product->track_qty = $request->track_qty;
            // $product->qty = $request->qty;
            $product->status = $request->status;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->is_featured = $request->is_featured;
            $product->related_products = (!empty($request->related_products)) ? implode(',',$request->related_products) : '';
            $product->save();


            
            //return success session
            $request->session()->flash('success','Product updated successfully');

            //return a json response
            return response()->json([
                'status' => true,
                'message' => 'Product updated successfully',
            ]);


        }else{ // if invalid, return the json error response
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]); 
        }

    }

    //delete
    public function destroy($id,Request $request){
        $product = Product::find($id);

        //check if product does not exist
        if(empty($product)){
            return response()->json([
                'status' => false,
                'notFound' => true,
            ]);
        }

        //get all product images and also delete records
        $productImages = ProductImage::where('product_id',$id)->get();
        //check if product images exists
        if(!empty($productImages)){
            foreach($productImages as $productImage){
                //delete records from the folder source file
                File::delete(public_path('uploads/product/large/'.$productImage->image));
                File::delete(public_path('uploads/product/small/'.$productImage->image));
            }

            //delete product images records
            ProductImage::where('product_id',$id)->delete();
        }

        $product->delete();//delete the product

        //return a success session
        $request->session()->flash('success','Product deleted successfully');

        //return a deletion success json response
        return response()->json([
            'status' => true,
            'message' => 'Product deleted successfully'
        ]);
    }

    //ajax function to get products for the select2
    public function getProducts(Request $request){

        $tempProduct = []; // container of products

        if($request->term != ""){
            $products = Product::where('title','like','%'.$request->term.'%')->get(); //check for products with the term 

            if($products != null){ //if there are records found
                foreach($products as $product){
                    $tempProduct[] = array('id' => $product->id,'text' => $product->title);
                }
            }

        }

        //return the json response
        return response()->json([
            'tags' => $tempProduct,
            'status' => true
        ]); 


    }


    //ajax function to get colors for the select2
    public function getColors(Request $request){

        $tempColor = []; // container of colors

        if($request->term != ""){
            $colors = Color::where('name','like','%'.$request->term.'%')->orderBy('name','ASC')->get(); //check for colors with the term 

            if($colors != null){ //if there are records found
                foreach($colors as $color){
                    $tempColor[] = array('id' => $color->id,'text' => $color->name);
                }
            }

        }else{
            $colors = Color::orderBy('name','ASC')->get(); //check for colors with the term 

            if($colors != null){ //if there are records found
                foreach($colors as $color){
                    $tempColor[] = array('id' => $color->id,'text' => $color->name);
                }
            }
        }

        //return the json response
        return response()->json([
            'tags' => $tempColor,
            'status' => true
        ]); 


    }


    //ajax to get product details
    public function get_product_details(Request $request){
        //dd($request->all());

        $product = Product::select('products.*')->with('product_images')->where('id',$request->id)->first();

        // $product_colors = ProductVariation::select('product_variations.*','colors.name','colors.color','colors.id as color_id')
        //     ->leftJoin('colors','colors.id','=','product_variations.color_id')
        //     ->where('product_id',$product->id)
        //     ->get();

        /**get the colors with available stocks */
            $resultColors = array();

            //
            $colorsWithStock = ProductVariation::select('color_id',DB::raw('SUM(stock_quantity) as total_stock'))
            ->where('stock_quantity' ,'>',0)
            ->groupBy('color_id')
            ->get();

            //dd($colorsWithStock);

            foreach($colorsWithStock as $color_stock){
                //get color
                $color = Color::find($color_stock->color_id);

                $color_r = array(); //result placeholder
                $color_r['id'] = $color->id;
                $color_r['color'] = $color->color;
                $color_r['color_name'] = $color->name;
                $color_r['color_stock'] = $color_stock->total_stock;

                $resultColors[] = $color_r;

            }

            //dd($resultColors);
        /**end of get the colors */


        /**get the sizes with available stocks */
            $resultSizes = array();

            $sizesWithStock = ProductVariation::select('size_id',DB::raw('SUM(stock_quantity) as total_stock'))
                ->where('stock_quantity','>',0)
                ->groupBy('size_id')
                ->get();

            foreach($sizesWithStock as $size_stock){
                //get Size
                $size = Size::find($size_stock->size_id);

                $size_r = array(); //result placeholder
                $size_r['id'] = $size->id;
                $size_r['size'] = $size->size;
                $size_r['size_stock'] = $size_stock->total_stock;

                $resultSizes[] = $size_r;
            }
            
        /**end of get the sizes */


        
        return response()->json([
            "status" => true,
            "product_id" => $product->id,
            "success" => view('front._product_modal',[ 
                "product" => $product,
                "product_colors" => $resultColors,
                "product_sizes" => $resultSizes,

            ])->render(),
        ],200);
    }


    public function get_size(Request $request){
        dd($request->all());
    }


    public function get_product_details_for_review(Request $request){
        //  dd($request->all());

        $product = Product::select('products.*')->with('product_images')->where('id',$request->product_id)->first();
        $orderItem = OrderItem::find($request->order_item_id);
        // dd($product);

        return response()->json([
            "status" => true,
            "product_id" => $product->id,
            "success" => view('front._product_review_modal',[ 
                "product" => $product,
                "item" => $orderItem
                
            ])->render(),
        ],200);

    }



}














/**Backup Files */

/*

$total_qty = 0;

            /**Product Colors */
               
                //dd($request->colors);

                // foreach($request->colors as $color => $key){

                    
                //     $track_qty = 'No';
                //     $qty = null;

                //     if(!empty($key['track_qty']) && $key['track_qty'] === 'Yes'){
                //         $track_qty = 'Yes';
                //     }

                //     if(!empty($key['qty'])){
                //         $qty = $key['qty'];
                //         $total_qty += $qty;
                //     }


                    
                //     ProductColor::updateOrCreate(
                //         [
                //             'product_id' => $product->id,
                //             'color_id' => $key['color_id'],
                //         ],
                //         [
                //             'product_id' => $product->id,
                //             'color_id' => $key['color_id'],
                //             'track_qty' => $track_qty,
                //             'qty' => $qty,
                //         ],
                //     );



                // }



            /**end of Product Colors */

            /**Product Sizes */
                // foreach($request->sizes as $size => $key){

                //     $track_qty = 'No';
                //     $qty = null;

                //     if(!empty($key['track_qty']) && $key['track_qty'] === 'Yes'){
                //         $track_qty = 'Yes';
                //     }

                //     if(!empty($key['qty'])){
                //         $qty = $key['qty'];
                //         $total_qty += $qty;
                //     }
                    
                //     ProductSize::updateOrCreate(
                //         [
                //             'product_id' => $product->id,
                //             'size_id' => $key['size_id'],
                //         ],
                //         [
                //             'product_id' => $product->id,
                //             'size_id' => $key['size_id'],
                //             'track_qty' => $track_qty,
                //             'qty' => $qty,
                //         ],
                //     );
                // }
            /**end of Product sizes */
            

            //update the product
            // if($total_qty > 0){
            //     $product->track_qty = 'Yes';
            //     $product->qty = $total_qty;
            //     $product->save();
            // }



//delete all existing records of ProductSize and ProductColor
/*
            ProductColor::where('product_id',$product->id)->delete();

            ProductSize::where('product_id',$product->id)->delete();
            
            $total_qty = 0;

            /**Product Colors *//*
               
                //dd($request->colors);

                foreach($request->colors as $color => $key){

                    
                    $track_qty = 'No';
                    $qty = null;

                    if(!empty($key['track_qty']) && $key['track_qty'] === 'Yes'){
                        $track_qty = 'Yes';
                    }

                    if(!empty($key['qty'])){
                        $qty = $key['qty'];
                        $total_qty += $qty;

                    }


                    
                    ProductColor::updateOrCreate(
                        [
                            'product_id' => $product->id,
                            'color_id' => $key['color_id'],
                        ],
                        [
                            'product_id' => $product->id,
                            'color_id' => $key['color_id'],
                            'track_qty' => $track_qty,
                            'qty' => $qty,
                            // 'track_qty' => 'Yes',
                            // 'qty' => $qty,
                        ],
                    );



                }



            /**end of Product Colors */

            /**Product Sizes *//*
                foreach($request->sizes as $size => $key){

                    $track_qty = 'No';
                    $qty = null;

                    if(!empty($key['track_qty']) && $key['track_qty'] === 'Yes'){
                        $track_qty = 'Yes';
                    }

                    if(!empty($key['qty'])){
                        $qty = $key['qty'];
                        $total_qty += $qty;
                    }
                    
                    ProductSize::updateOrCreate(
                        [
                            'product_id' => $product->id,
                            'size_id' => $key['size_id'],
                        ],
                        [
                            'product_id' => $product->id,
                            'size_id' => $key['size_id'],
                            'track_qty' => $track_qty,
                            'qty' => $qty,
                        ],
                    );
                }
            /**end of Product sizes *//*


            //update the product
            if($total_qty > 0){
                $product->track_qty = 'Yes';
                $product->qty = $total_qty;
                $product->save();
            }
            


//check $request
            // dd($request->image_array);
            // exit();
            // return false;

            //Save gallery pics
            
            /*
            // if(!empty($request->image_array)){
            //     foreach ($request->image_array as $temp_image_id) {

            //         $tempImageInfo = TempImage::find($temp_image_id);
            //         $extArray = explode('.',$tempImageInfo->name);
            //         $ext = last($extArray); // like jpg, gif, png, etc

            //         $productImage = new ProductImage();
            //         $productImage->product_id = $product->id;
            //         $productImage->image = 'NULL';
            //         $productImage->save();

            //         $imageName = $product->id.'-'.$productImage->id.'-'.time().'.'.$ext;
            //         // product_id => 4 ; product_image_id => 1
            //         // imageName = 4-1-123123124.jpg

            //         $productImage->image = $imageName;
            //         $productImage->save();

            //         //Generate product Image thumbnails

            //             //Large Image
            //             $sourcePath = public_path().'/temp/'.$tempImageInfo->name;
            //             //$destPath = public_path().'/uploads/product/large/'.$tempImageInfo->name;
            //             $destPath = public_path().'/uploads/product/large/'.$imageName;
            //             $image = Image::make($sourcePath);
            //             $image->resize(1400, null, function($constraint){
            //                 $constraint->aspectRatio();
            //             });
            //             $image->save($destPath);

            //             //Small Image
            //             //$sourcePath = public_path().'/temp/'.$tempImageInfo->name;
            //             //$destPath = public_path().'/uploads/product/small/'.$tempImageInfo->name;
            //             $destPath = public_path().'/uploads/product/small/'.$imageName;
            //             $image = Image::make($sourcePath);
            //             $image->fit(300,300);
            //             $image->save($destPath);



            //         //emd of Generate product Image thumbnails


            //     }
            // }
            



*/
/**end of Backup Files */
