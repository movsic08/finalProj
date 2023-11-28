<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    protected $fillable = [
        'product_id',
        'size_id',
        'color_id',
        'stock_quantity'
    ];

    static public function getProductStocks($product_id){
        return self::where('product_id',$product_id)->sum('stock_quantity');
    }

    use HasFactory;
}
