<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MechanicSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('lt_LT');

        $mechanics = [
            [
                'firstname' => $faker->firstNameMale(),
                'lastname' => $faker->lastName(),
            ],
            [
                'firstname' => $faker->firstNameMale(),
                'lastname' => $faker->lastName(),
            ],
            [
                'firstname' => $faker->firstNameFemale(),
                'lastname' => $faker->lastName(),
            ],
        ];

        foreach ($mechanics as $mechanic) {
            DB::table('mechanics')->insert($mechanic);
        }
    }
}
