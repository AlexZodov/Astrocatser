<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Astrologist extends Model
{
    //

    public function services(){
        return $this->belongsToMany(Service::class)
            ->withPivot('price');
    }

    public function loadServices(){
        $result = [];
        $services = $this->services;

        foreach ($services as $service) {
            $result[] = [
                'name' => $service->service_name,
                'price' => $service->pivot->price/100
            ];
        }

        return collect($result);
    }
}
