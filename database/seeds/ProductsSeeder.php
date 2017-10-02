<?php

use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        delete_loaded_images('app/public/products');

        $categories = \App\Models\Category::all();

        $tags = \App\Models\Tag::all();

        $users = \App\Models\User::all();

        for($i = 0; $i < 100; $i++) {
            factory(\App\Models\Product::class)->create([
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
            ]);
        }

        \App\Models\Product::all()->each(function(\App\Models\Product $product) use ($tags) {
            $product->tags()->attach($tags->random(3)->pluck('id'));
        });
    }
}
