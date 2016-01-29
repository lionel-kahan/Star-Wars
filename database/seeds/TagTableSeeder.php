<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert(
            [
                [ 'name' => 'Laser'      , 'slug' => 'Laser']      ,
                [ 'name' => 'Casque'     , 'slug' => 'Casque']     ,
                [ 'name' => 'vaisseaux'  , 'slug' => 'vaisseaux']  ,
                [ 'name' => 'Epée'       , 'slug' => 'Epée']       ,
                [ 'name' => 'Dark Vador' , 'slug' => 'Dark-Vador'] ,
                [ 'name' => 'Shubaka'    , 'slug' => 'Shubaka']    ,
            ]
        );
    }
}
