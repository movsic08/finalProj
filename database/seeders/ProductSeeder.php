<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use DB;
use Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $brands = Brand::all();
        $categories = Category::all();
        
        foreach($categories as $category){

            $subcategories = SubCategory::where('category_id',$category->id)->get();



            if(!empty($subcategories)){

                foreach($subcategories as $subcategory){
                    

                    


                    foreach($brands as $brand){

                        $title = fake()->company.' '.$brand->name.' '.$category->name.' '.$subcategory->name.' '.fake()->word.'-'.fake()->randomNumber($nbDigits = 4,$strict = false).' '.fake()->word;

                        $slug = Str::slug($title);

                        $compare_price = fake()->randomElement([1000,2000,3000,4000,5000,6000,8000,9000,10000]);
                        $dif = fake()->numberBetween($min = 100, $max = 300);
                        $price = $compare_price - $dif;

                        $qty = 0;
                        $track_qty = fake()->randomElement(['Yes','No']);
                        if($track_qty == 'Yes'){
                            $qty = fake()->numberBetween($min = 10,$max = 50);
                        }

                        DB::table('products')->insert([
                            [
                               'title' => $title,
                               'slug' => $slug,
                               'description' => fake()->paragraph($nbSentences = 3,$variableNbSentences = true),
                               'short_description' => fake()->paragraph($nbSentences = 1,$variableNbSentences = true),
                               'shipping_returns' => fake()->paragraph($nbSentences = 1,$variableNbSentences = true),
                               'related_products' => '',
                               'price' => $price,
                               'compare_price' => $compare_price,
                               'category_id' => $category->id,
                               'sub_category_id' => $subcategory->id,
                               'brand_id' => $brand->id,
                               'is_featured' => fake()->randomElement(['Yes','No']),
                               'sku' => fake()->creditCardNumber,
                               'barcode' => fake()->swiftBicNumber,
                            //    'track_qty' => $track_qty,
                            //    'qty' => $qty,
                               //'status' => '1',
                               'created_at' => now(),
                               'updated_at' => now()
                            ]
                        ]);
                    }

                    
                }
                

            }else{

                foreach($brands as $brand){

                    $title = fake()->company.' '.$brand->name.' '.$category->name.' '.fake()->word.'-'.fake()->randomNumber($nbDigits = 4,$strict = false).' '.fake()->word;

                    $slug = Str::slug($title);

                    $compare_price = fake()->randomElement([1000,2000,3000,4000,5000,6000,8000,9000,10000]);
                    $dif = fake()->numberBetween($min = 100, $max = 300);
                    $price = $compare_price - $dif;

                    $qty = 0;
                    $track_qty = fake()->randomElement(['Yes','No']);
                    if($track_qty == 'Yes'){
                        $qty = fake()->numberBetween($min = 10,$max = 50);
                    }

                    DB::table('products')->insert([
                        [
                           'title' => $title,
                           'slug' => $slug,
                           'description' => fake()->paragraph($nbSentences = 3,$variableNbSentences = true),
                           'short_description' => fake()->paragraph($nbSentences = 1,$variableNbSentences = true),
                           'shipping_returns' => fake()->paragraph($nbSentences = 1,$variableNbSentences = true),
                           'related_products' => '',
                           'price' => $price,
                           'compare_price' => $compare_price,
                           'category_id' => $category->id,
                           'sub_category_id' => '',
                           'brand_id' => $brand->id,
                           'is_featured' => fake()->randomElement(['Yes','No']),
                           'sku' => fake()->creditCardNumber,
                           'barcode' => fake()->swiftBicNumber,
                        //    'track_qty' => $track_qty,
                        //    'qty' => $qty,
                           //'status' => '1',
                           'created_at' => now(),
                           'updated_at' => now()
                        ]
                    ]);
                }
            }
            
        }


        /*
        DB::table('products')->insert([
            [
                'id' => '1','title' => 'Men Nike Fort 123','slug' => 'men-nike-fort-123','description' => '<p>This is simple description</p>','short_description' => '<p>Short description is dummy text</p>','shipping_returns' => '<p>This Shipping and return is for 12 days</p>','related_products' => '','price' => '2000.00','compare_price' => '4000.00','category_id' => '1','sub_category_id' => '1','brand_id' => '1','is_featured' => 'Yes','sku' => '123819824','barcode' => 'kj3b2j42b3','track_qty' => 'Yes','qty' => '12','status' => '1','created_at' => '2023-09-17 03:09:43','updated_at' => '2023-09-17 03:09:43'
            ]
        ]); 
        */
    }
}
