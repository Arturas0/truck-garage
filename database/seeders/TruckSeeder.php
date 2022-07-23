<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TruckSeeder extends Seeder
{
    public function run(): void
    {
        $faker = \Faker\Factory::create('lt_LT');
        $faker->addProvider(new \Faker\Provider\Fakecar($faker));

        $trucks = [
            [
                'maker' => $faker->vehicle,
                'plate' => $faker->vehicleRegistration('[A-Z]{3} [0-9]{3}'),
                'make_year' => $faker->numberBetween(1990, 2022),
                'mechanic_notices' => $faker->paragraph(5),
                'mechanic_id' => rand(1, 3),
            ],
            [
                'maker' => $faker->vehicle,
                'plate' => $faker->vehicleRegistration('[A-Z]{3} [0-9]{3}'),
                'make_year' => $faker->numberBetween(1990, 2022),
                'mechanic_notices' => $faker->paragraph(5),
                'mechanic_id' => rand(1, 3),
            ],
            [
                'maker' => $faker->vehicle,
                'plate' => $faker->vehicleRegistration('[A-Z]{3} [0-9]{3}'),
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
