<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    //get shop settings
    static public function getShopSettings(){
        return Setting::find(1);
    }

}
