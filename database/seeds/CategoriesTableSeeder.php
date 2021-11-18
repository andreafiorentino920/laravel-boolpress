<?php

use Illuminate\Database\Seeder;
use App\Category;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ["html","css","js","php","laravel","vuejs","sql","nosql","git"];
        
        foreach($categories as $category){
            $newCategory = new Category();
            $newCategory->name = $category;
            $newCategory->slug = Str::of("$category")->slug("-");
            $newCategory->save();
        }
        

    }
}
