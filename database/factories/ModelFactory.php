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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'email' => $faker->email, 'password' => bcrypt('password'),
        'remember_token' => str_random(10),
        'key_id' => str_random(12),
        'last_seen' => $faker->dateTime,
        'picture_id' => '1', 'balance' => '500.0',
    ];
});

$factory->define(App\Models\Permission::class, function (Faker\Generator $faker) {
    return ['name' => $faker->slug(6), 'description' => 'You may use the ' . $faker->word . ' machine.',
    ];
});


$factory->define(App\Models\TransactionType::class, function (Faker\Generator $faker) {

    return ['name' => $faker->slug(6),
        'description' => 'You purchased a ' . $faker->word,
        'cost' => rand(1, 50),
        'permission_id' => App\Models\Permission::All()->random()->id,
    ];
});

$factory->define(App\Models\Transaction::class, function (Faker\Generator $faker) {
    $transactionType = App\Models\TransactionType::All()->random();
    return [
        'user_id' => App\Models\User::all()->random()->id,
        'amount' => $transactionType->cost,
        'transaction_type_id' => $transactionType->id,
    ];
});

$factory->define(App\Models\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});
