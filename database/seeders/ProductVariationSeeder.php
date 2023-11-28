<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;
use DB;

class ProductVariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();
        $colors = Color::all();
        $sizes = Size::all();

        foreach($products as $product){

            $qty = 0;

            foreach($colors as $color){


                foreach($sizes as $size){

                    $stock = fake()->numberBetween(1,9);
                    DB::table('product_variations')->insert([
                        'product_id' => $product->id,
                        'color_id' => $color->id,
                        'size_id' => $size->id,
                        'stock_quantity' => $stock
                    ]);

                    $qty += $stock;

                }

            }    
            
            $product->track_qty = 'Yes';
            $product->qty = $qty;
            $product->save();



        }
        
    }
}
