<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categories')->insert(
            [
                [
                    'title'       => 'Laser',
                    'slug'        => 'Laser',
                    'description' => 'Arme à énergie laser'
                ],
                [
                    'title'       => 'Casque de protection contre les armes laser',
                    'slug'        => 'Casque-de-protection-contre-les-armes-laser',
                    'description' => 'Type de casque'
                ],
            ]
        );
    }
}
