<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'emp_id' => rand(2910000,2920000),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'password' => '$2y$10$CT2qYBtinZOycRSxBs83XOlwTFsKUIMiOe25256ENp.B3JjYfWcdC',
        'dept' => $faker->departmentName,
        'email' => $fake->safeEmail
    ];
});
