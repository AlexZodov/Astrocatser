<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create('ru_RU');
        foreach (range(1,6) as $index) {
            Service::create([
                'service_name' => $faker->realText(50),
                'description' => $faker->realText(500)
            ]);
        }
    }
}
