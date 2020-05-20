<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //many-to-many relation with astrologist model
    public function astrologists(){
        return $this->belongsToMany(Astrologist::class);
    }
}
