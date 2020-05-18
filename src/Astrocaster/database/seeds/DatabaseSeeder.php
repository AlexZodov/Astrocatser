<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $this->call(AstrologistSeeder::class);
        $this->call(ServicesSeeder::class);
        $this->call(AstrologistServicePivotSeeder::class);
    }
}
