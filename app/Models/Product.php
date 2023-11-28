<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //return the images connected to the id of the product, from the ProductImage model
    public function product_images(){
        return $this->hasMany(ProductImage::class);
    }

    //return the product_sizes connected to the id of the product
    public function product_sizes(){
        return $this->hasMany(ProductSize::class);
    }

    //return the product_colors connected to the id of the product
    public function product_colors(){
        return $this->hasMany(ProductColor::class);
    }

    //return the ProductVariation instances
    public function variations(){
        return $this->hasMany(ProductVariation::class,'product_id');
    }

}
