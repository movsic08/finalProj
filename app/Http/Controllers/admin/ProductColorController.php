<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{
    //update or delete
    public function updateProductColor(Request $request){
        dd($request->all());
    }

}
