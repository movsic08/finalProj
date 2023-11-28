<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    //returns the OrderItems instances that the order is connected to from the OrderItem model (order_items table )
    public function items(){
        return $this->hasMany(OrderItem::class);
    }

}
