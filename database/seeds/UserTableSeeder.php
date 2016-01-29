<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
        [
            [
                'name'     => 'tony'             ,
                'email'    => 'tony@tony.fr'     ,
                'password' => Hash::make('tony') ,
                'role'     => 'administrator'    ,
            ],
            [
                'name'     => 'yni'             ,
                'email'    => 'yni@yni.fr'      ,
                'password' => Hash::make('yni') ,
                'role'     => 'visitor'             ,
            ],
            [
                'name'     => 'antoine'             ,
                'email'    => 'antoine@antoine.fr'  ,
                'password' => Hash::make('antoine') ,
                'role'     => 'visitor'             ,
            ],
            [
                'name'     => 'laurent'             ,
                'email'    => 'laurent@laurent.fr'  ,
                'password' => Hash::make('laurent') ,
                'role'     => 'visitor'             ,
            ],
        ]
        );
    }
}
