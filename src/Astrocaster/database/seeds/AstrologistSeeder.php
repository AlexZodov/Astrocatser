<?php

use Illuminate\Database\Seeder;
use App\Astrologist;

class AstrologistSeeder extends Seeder
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
        foreach (range(1,10) as $index) {
            Astrologist::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'patronymic_name' => $faker->firstNameMale,
                'email' => $faker->email,
                'bio' => $faker->realText(300)
            ]);
        }
    }
}
