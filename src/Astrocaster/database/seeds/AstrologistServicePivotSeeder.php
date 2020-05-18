<?php

use App\Service;
use Illuminate\Database\Seeder;

class AstrologistServicePivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $astrologists = \App\Astrologist::all();
        //$services = \App\Service::all();

        foreach ($astrologists as $astrologist) {
            $services = Service::inRandomOrder()
                ->limit(mt_rand(2, Service::count()))
                ->get();
            foreach ($services as $service){
                $astrologist->services()->attach($service->id, ['price'=>mt_rand(100,50000)]);
            }
        }
    }
}
