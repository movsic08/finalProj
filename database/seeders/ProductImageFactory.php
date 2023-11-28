<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use DB;

class ProductImageFactory extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //id 36 - 65
        $images = [
            '1-1-1694920183.jpg',
            '1-2-1694920183.jpg',
            '1-109-1694926287.jpg',
            '2-110-1694926334.png',
            '6-19-1693711477.jpeg',
            '8-8-1693645417.jpg',
            '8-9-1693645418.jpg',
            '9-10-1693704615.jpg',
            '9-11-1693704616.jpg',
            '10-12-1693705036.jpg',
            '10-13-1693705037.jpg',
            '11-14-1693705146.jpg',
            '11-15-1693705146.jpg',
            '12-25-1693720543.jpg',
            '12-51-1693723736.jpg',
            '13-53-1693797413.jpg',
            '14-54-1693797472.jpg',
            '15-55-1693797536.jpg',
            '18-58-1693805089.jpg',
            '20-60-1693805198.jpg',
            '21-61-1693805264.jpg',
            '22-62-1693805310.jpg',
            '23-63-1693805356.jpg',
            '24-64-1693805418.jpg',
            '25-65-1693805485.jpg',
            '26-66-1693805542.jpg',
            '27-67-1693805590.jpg',
            '28-68-1693805635.jpg',
            '29-69-1693805680.jpg',
            '30-70-1693805727.jpg',
            '31-71-1693805800.jpg',
            '32-72-1693805855.jpg',
        ];

        $products = Product::all();

        foreach($products as $product){
            for($i = 0;$i < 3; $i++){
                DB::table('product_images')->insert([
                    [
                        'product_id' => $product->id,
                        'image' => fake()->randomElement($images),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                ]);
            }
        }

        
        


    }
}
