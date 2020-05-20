<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AstrologistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //map one Astrologist entity
        //adding services with prices
        //adding avatar photo URLs
        $result = [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'patronymic_name' => $this->patronymic_name,
            'services' => $this->loadServices()->toArray(),
            'photo' => [
                'small' => Storage::disk('images')->url('avatars/small/'.$this->photo_name),
                'medium' => Storage::disk('images')->url('/avatars/medium/'.$this->photo_name),
                'big' => Storage::disk('images')->url('/avatars/big/'.$this->photo_name),
            ]
        ];

        //for complete info
        if(isset($this->email)){
            $result['email'] = $this->email;
        }

        //for complete info
        if(isset($this->bio)){
            $result['bio'] = $this->bio;
        }

        
        return $result;
    }
}
