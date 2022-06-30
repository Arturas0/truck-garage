<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class TruckSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        $trucks = [
            [
                'maker' => $faker->unique()->company,
                'plate' => $faker->text(5) . $faker->unique()->numberBetween(001, 999),
                'make_year' => $faker->numberBetween(1990, 2022),
                'mechanic_notices' => $faker->paragraph(5),
                'mechanic_id' => rand(1, 3),
            ],
            [
                'maker' => $faker->unique()->company,
                'plate' => $faker->text(5) . $faker->unique()->numberBetween(001, 999),
                'make_year' => $faker->numberBetween(1990, 2022),
                'mechanic_notices' => $faker->paragraph(5),
                'mechanic_id' => rand(1, 3),
            ],
            [
                'maker' => $faker->unique()->company,
                'plate' => $faker->text(5) . $faker->unique()->numberBetween(001, 999),
                'make_year' => $faker->numberBetween(1990, 2022),
                'mechanic_notices' => $faker->paragraph(5),
                'mechanic_id' => rand(1, 3),
            ],
        ];

        foreach ($trucks as $truck) {
            DB::table('trucks')->insert($truck);
        }
    }
}
