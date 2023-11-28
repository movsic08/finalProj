<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'review',
        'rating',
        'created_by',
        'showOnReviews',
        'created_at',
        'updated_at'
    ];  

}
