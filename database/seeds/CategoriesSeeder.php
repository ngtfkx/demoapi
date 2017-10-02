<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Category::class, 3)->create()->each(function(\App\Models\Category $category) {
            factory(\App\Models\Category::class, 2)->create([
                'parent_id' => $category->id,
            ]);
        });
    }
}
