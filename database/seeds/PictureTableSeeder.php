<?php

use App\Product;
use App\Picture;
use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\Storage;  inutile du fait qu'il y a un allias dessus

class PictureTableSeeder extends Seeder
{
    protected $faker;
    public function __construct(Faker\Generator $faker) {
        $this->faker = $faker;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Suppression préalable des fichiers de upload par l'utilisation de la variable storage définie à l'aide de l'instruction public_path('upload') du fichier de configuration config\filesystem.php)
        $files = Storage::allFiles(); //retroune un tableau des images de storage
        foreach ($files as $file) Storage::delete($file);

        //Supprimer toutes les lignes de la talble Pictures
//        DB::table('pictures')->


        // Récupération d'un faker opétationnel
        // $faker = Faker\Factory::create();

        $products = Product::all();
        foreach ( $products as $product ) {

            // Stokage de l'image et récupération de l'uri
            $uri = str_random(15) . '_370x235.jpg';
            Storage::put(
                $uri,
                file_get_contents('http://lorempixel.com/people/370/325/')
            );

            Picture::create([
                'product_id'  => $product->id       ,
                'uri'         => $uri                ,
                'title'       => $this->faker->name
            ]);
        }

//        DB::table('pictures')->insert(
//            [
//                [
//                    'product_id'  => '2' ,
//                    'uri'         => $uri
//                ],
//            ]
//        );
    }
}
