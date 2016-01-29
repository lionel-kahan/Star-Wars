<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Carbon\Carbon;

function randCard() {
    $rand =  rand(1, 9);
    $i = 0;
    while ($i<15) {
        $rand .= rand(0, 9);
        $i++;
    }
    return $rand;
}

function title(Faker\Generator $faker) {
    $sentence = $faker->sentence(3);

    return substr($sentence, 0, strlen($sentence) - 1);
}



$factory->define(App\Product::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    return [
        'name'         => $name,
        'slug'         => str_slug($name, '-'),
        'category_id'  => rand(1, 2),
        'price'        => $faker->randomFloat(2, 10, 2000),
        'abstract'     => $faker->paragraph(rand(1, 4)),
        'published_at' => $faker->dateTime('now'),
    ];
});


$factory->define(App\Customer::class, function(Faker\Generator $faker) {
    static $userId = 0;
    return [
        'user_id'        => ++$userId,
        'address'        => $faker->address,
        'number_card'    => randCard(),
//        'number_card'    => $faker->creditCardNumber(),
        'number_command' => 0,
    ];
});
