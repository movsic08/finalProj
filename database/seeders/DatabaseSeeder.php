<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserTableSeeder::class,
            // CategorySeeder::class,
            // SubCategorySeeder::class,
            // BrandsSeeder::class,
            // ProductSeeder::class,
            // CountrySeeder::class,
            // SettingsSeeder::class,
            // ProductImageFactory::class,   //product_images seeder
            // CustomerAddressesSeeder::class,
            // DiscountCouponsSeeder::class,
            // ShippingChargeSeeder::class,
            // ColorSeeder::class,
            // SizeSeeder::class,
            // ProductVariationSeeder::class

            // PhilippineRegionsTableSeeder::class,
            // PhilippineProvincesTableSeeder::class,
            // PhilippineCitiesTableSeeder::class,
            // PhilippineBarangaysTableSeeder::class,

            //OrderSeeder::class,
            // OrderItemsSeeder::class,
        ]);

        //Category factory
        //\App\Models\Category::factory(30)->create();

        //Product factory
        //\App\Models\Product::factory(30)->create();

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
