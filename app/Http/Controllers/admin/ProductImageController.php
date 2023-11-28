<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Image;

class ProductImageController extends Controller
{
    //update
    public function update(Request $request){
        // dd($request->all());
        // exit();
        // return false;


        //check if there is an image passed
        if($request->image){

            

            $image = $request->image;

            // dd($image->getImagePath());
            // exit();
            // return false;

            $ext = $image->getClientOriginalExtension();
            $sourcePath = $image->getPathName();
            //$sourcePath = public_path().'/temp/'.$image;

            $productImage = new ProductImage();
            $productImage->product_id = $request->product_id;
            $productImage->image = 'NULL';
            $productImage->save();

            $imageName = $request->product_id.'-'.$productImage->id.'-'.time().'.'.$ext;
            $productImage->image = $imageName;
            $productImage->save();

            //Generate product Image thumbnails

                //Large Image
                
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


            //return an ajax success response
            return response()->json([
                'status' => true,
                'image_id' => $productImage->id,
                'ImagePath' => asset('uploads/product/small/'.$productImage->image),
                'message' => 'Image saved successfully'
            ]);

        }

    
    }

    //delete product images
    public function destroy(Request $request){
        // dd($request->all());
        // exit();
        // return false;

        $productImage = ProductImage::find($request->id);

        //check if productImage does not exist and returns a json error response
        if(empty($productImage)){
            return response()->json([
                'status' => false,
                'message' => 'Image deleted successfully'
            ]);
        }

        //Delete images from folder
        File::delete(public_path('uploads/product/large/'.$productImage->image));
        File::delete(public_path('uploads/product/small/'.$productImage->image));

        $productImage->delete();

        //return a deletion success json response
        return response()->json([
            'status' => true,
            'message' => 'Image deleted successfully'
        ]);


    }



}
