<?php

namespace App;

use App\ModelCasts\AstrologistServiceCast;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Astrologist extends Model
{

    protected $fillable = ['id', 'first_name', 'last_name', 'patronymic_name'];


    //many-to-many relation with service model, additionally handling he price
    public function services(){
        return $this->belongsToMany(Service::class)
            ->withPivot('price');
    }


    /**
     * load service from the list of ones owned by given astrologist
     * else throw an exception
     * @param int $id
     * @return Service
     * @throws \Exception
     */
    public function priceAndServiceById(int $id):Service {
        $service = $this->services()
            ->wherePivot('service_id','=',$id)
            ->withPivot('price')
            ->first();

        if(empty($service)){
            throw new \Exception('Service not exists on this astrologist');
        }

        return $service;
    }

    /**
     * Get all owned services with prices
     *
     * @return \Illuminate\Support\Collection
     */
    public function loadServices(){
        $result = [];
        $services = $this->services;

        foreach ($services as $service) {
            $result[] = [
                'id' => $service->id,
                'name' => $service->service_name,
                'price' => $service->pivot->price/100
            ];
        }

        return collect($result);
    }
}
