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
                ->limit(random_int(2, Service::count()))
                ->get();
            foreach ($services as $service){
                $astrologist->services()->attach($service->id, ['price'=>random_int(100,50000)]);
            }
        }
    }
}
