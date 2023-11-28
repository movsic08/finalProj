<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $title = fake()->unique()->name();
        $slug = Str::slug($title); //generates a slug for the title

        $subCategories = [7,8,9];
        $subCatRandKey = array_rand($subCategories);

        $brands = [1,4,5,6];
        $brandRandKey = array_rand($brands);


        return [
            'title' => $title,
            'slug' => $slug,
            'category_id' => 42,
            'sub_category_id' => $subCategories[$subCatRandKey],
            'brand_id' => $brands[$brandRandKey],
            'price' => rand(10,10000),
            'sku' => rand(1000,9999),
            'track_qty' => 'Yes',
            'qty' => 10,
            'is_featured' => 'Yes',
        ];
    }
}
