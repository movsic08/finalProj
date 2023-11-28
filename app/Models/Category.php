<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = [
        'name',
        'slug',
        'image',
        'created_at',
        'updated_at',
    ];

    //get subcategories
    public function sub_category(){
        //$this->hasMany is the function to get all sub_categories connected to the category
        return $this->hasMany(SubCategory::class);
    }

}
