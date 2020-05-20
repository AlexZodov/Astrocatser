<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = ['name','email'];

    //one-to-many relation with order model
    public function orders(){
        return $this->hasMany(Order::class);
    }
}
