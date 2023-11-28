<?php

namespace App\Http\Controllers\admin;

use App\Models\TempImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;

class TempImagesController extends Controller
{
    //create temp_image
    public function create(Request $request){
        $image = $request->image;

        if(!empty($image)){ //if not empty
            $ext = $image->getClientOriginalExtension();
            $newName = time().'.'.$ext;

            //insert into a new TempImage Class
            $tempImage = new TempImage();
            $tempImage->name = $newName;
            $tempImage->save();

            //Move the uplaoded file to the new upload location
            $image->move(public_path().'/temp',$newName);

            //Generate thumbnail
            $sourcePath = public_path().'/temp/'.$newName;
            $destPath = public_path().'/temp/thumb/'.$newName;
            $image = Image::make($sourcePath);
            $image->fit(300,275);
            $image->save($destPath);

            //return a json response
            return response()->json([
                'status' => true,
                'image_id' => $tempImage->id,
                'ImagePath' => asset('/temp/thumb/'.$newName),
                'message' => 'Image uploaded successfully'
            ]);

        }
    }



    //create_setting_image temp_image -> for setting logo and favicon
    public function create_setting_image(Request $request){
        $image = $request->image;

        if(!empty($image)){ //if not empty
            $ext = $image->getClientOriginalExtension();
            $newName = time().'.'.$ext;

            //insert into a new TempImage Class
            $tempImage = new TempImage();
            $tempImage->name = $newName;
            $tempImage->save();

            //Move the uplaoded file to the new upload location
            $image->move(public_path().'/temp',$newName);

            //Generate thumbnail
            $sourcePath = public_path().'/temp/'.$newName;
            $destPath = public_path().'/temp/thumb/'.$newName;
            $image = Image::make($sourcePath);
            $image->fit(300,300);
            $image->save($destPath);

            //return a json response
            return response()->json([
                'status' => true,
                'image_id' => $tempImage->id,
                'ImagePath' => asset('/temp/thumb/'.$newName),
                'message' => 'Image uploaded successfully'
            ]);

        }
    }


    //gcash_receipt
    public function gcash_receipt(Request $request){
        $image = $request->image;

        if(!empty($image)){ //if not empty
            $ext = $image->getClientOriginalExtension();
            $newName = time().'.'.$ext;

            //insert into a new TempImage Class
            $tempImage = new TempImage();
            $tempImage->name = $newName;
            $tempImage->save();

            //Move the uplaoded file to the new upload location
            $image->move(public_path().'/temp',$newName);

            //Generate thumbnail
            $sourcePath = public_path().'/temp/'.$newName;
            $destPath = public_path().'/temp/thumb/'.$newName;
            $image = Image::make($sourcePath);
            //$image->fit(300,300);
            $image->save($destPath);

            //return a json response
            return response()->json([
                'status' => true,
                'image_id' => $tempImage->id,
                'ImagePath' => asset('/temp/thumb/'.$newName),
                'message' => 'Image uploaded successfully'
            ]);

        }
    }

}
