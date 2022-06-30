<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class MechanicSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $mechanics = [
            [
                'firstname' => $faker->firstName(),
                'lastname' => $faker->lastName(),
            ],
            [
                'firstname' => $faker->firstName(),
                'lastname' => $faker->lastName(),
            ],
            [
                'firstname' => $faker->firstName(),
                'lastname' => $faker->lastName(),
            ],
        ];

        foreach ($mechanics as $mechanic) {
            DB::table('mechanics')->insert($mechanic);
        }
    }
}
