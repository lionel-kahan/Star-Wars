<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Product::class, 15)->create()->each(function($product) {
            $allTags = App\Tag::all();
            $tags = $allTags;

            $nbProductTags = rand(1, $allTags->count());
            while ($nbProductTags != 0) {
                $indiceTags = rand(1, $tags->count()) - 1;
                DB::table('product_tag')->insert([[ 'product_id' => $product->id , 'tag_id' => $tags[$indiceTags]->id ]]);
//              $Product->tags()->attach([$tags[$indiceTags]->id]); // voir la solution du prof
                $tags->splice($indiceTags, 1); //suppression de l'élément dans la collection $tags
                $nbProductTags--;
            }
        });
    }
}

// Correction : Métthode proposée par le prof Antoine avec utilisation d'une fonction anonyme
//    public function run()
//    {
//        $shuffle = function ($tags, $num) {
//            $s = [];
//            shuffle($tags);
//            while ($num >= 0) {
//                $s[] = $tags[$num];
//                $num--;
//            }
//
//            return $s;
//        };
//
//        $max = $this->tag->count();
//        $tags = $this->tag->lists('id')->toArray();  // passé d'une collection à un array
//
//        factory(App\Product::class, 15)->create()->each(function ($product) use ($shuffle, $max, $tags) {
//            $product->tags()->attach($shuffle($tags, rand(1, $max - 1)));
//        });
//    }
