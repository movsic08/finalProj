<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Product;

class ShopController extends Controller
{
    //index : Shop
    public function index(Request $request,$categorySlug = null,$subCategorySlug = null){

        $categorySelected = '';
        $subCategorySelected = '';
        $brandsArray = [];

        if(!empty($request->get('brand'))){
            $brandsArray =  explode(',',$request->get('brand')); //gets all the brands from the request url
        }

        

        //get categories, brands, products
        $categories = Category::orderBy('name','ASC')->with('sub_category')->where('status',1)->get();
        $brands = Brand::orderBy('name','ASC')->where('status',1)->get();

        /**Apply Filters on Products*/
            $products = Product::where('status',1);

            //apply categorySlug
            if(!empty($categorySlug)){
                $category = Category::where('slug',$categorySlug)->first();
                $products = $products->where('category_id',$category->id);
                $categorySelected = $category->id;
            }

            //apply subCategorySlug
            if(!empty($subCategorySlug)){
                $subCategory = SubCategory::where('slug',$subCategorySlug)->first();
                $products = $products->where('sub_category_id',$subCategory->id);
                $subCategorySelected = $subCategory->id;
            }

            //apply brand filter
            if(!empty($request->get('brand'))){
                $brandsArray =  explode(',',$request->get('brand')); //gets all the brands from the request url
                $products = $products->whereIn('brand_id',$brandsArray);
            }

            //apply price filter
            if($request->get('price_max') != '' && $request->get('price_min') != ''){
                //checks the product price if it is in between range    
                //intval is a function that converts all string into numeric

                if($request->get('price_max') == 10000){ //if price max == 1000 [  1000+ in the range  ]
                    $products = $products->whereBetween('price',[ intval($request->get('price_min')) , 100000000 ]);
                }else{
                    $products = $products->whereBetween('price',[ intval($request->get('price_min')) , intval($request->get('price_max')) ]);
                }
                
            }

            //apply search input filter
            if($request->get('search')){
                $products = $products->where('title','like','%'.$request->get('search').'%');
            }

            if(!empty($request->get('discount'))){
                $products = $products->where('price','>',0)->where('compare_price' ,'>',0);
            }

            //apply sort filter
            if($request->get('sort') != ''){
                if($request->get('sort') == 'latest'){
                    $products = $products->orderBy('id','DESC');
                }else if($request->get('sort') == 'price_asc'){
                    $products = $products->orderBy('price','ASC');
                }else{
                    $products = $products->orderBy('price','DESC');
                }
            }else{
                $products = $products->orderBy('id','DESC');
            }


            

            $products = $products->paginate(6);

        /**end of Apply Filter on Products */

        $data['categories'] = $categories;
        $data['brands'] = $brands;
        $data['products'] = $products;
        $data['categorySelected'] = $categorySelected;
        $data['subCategorySelected'] = $subCategorySelected;
        $data['brandsArray'] = $brandsArray;
        $data['priceMax'] = ( intval($request->get('price_max')) == 0) ? 10000 : $request->get('price_max');
        $data['priceMin'] = intval($request->get('price_min'));
        $data['sort'] = $request->get('sort');

        return view('front.shop',$data);
    }


    //product : Product
    public function product($slug){
        //echo $slug;

        //->with('product_images') is a Product Method that fetches all ProductImages connected to the Product
        $product = Product::where('slug',$slug)->with('product_images')->first();// find the product by slug
        //dd($product);

        if($product == null){ // if product is not found 
            abort(404);
        }

        $relatedProducts = [];
        //fetch related product
        if($product->related_products != ''){
            $productArray = explode(',',$product->related_products); //get the product ids
            $relatedProducts = Product::whereIn('id',$productArray)->with('product_images')->where('status',1)->get(); //fetch the products based on ids
        }

        $data['product'] = $product;
        $data['relatedProducts'] = $relatedProducts;

        return view('front.product',$data);

    }

}
