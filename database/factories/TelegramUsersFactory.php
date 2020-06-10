<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TelegramUser;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(TelegramUser::class, function (Faker $faker) {
    return [
        'telegram_user_id' => $faker->numberBetween($min = 1000, $max = 9000),
        'username' => 'admin',
        'password' => Hash::make('admin'), // password
        'first_name' => $faker->firstNameMale,
        'last_name' => $faker->lastName,
    ];
});