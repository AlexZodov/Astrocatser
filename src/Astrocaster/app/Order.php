<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    protected $fillable = ['customer_id','order_detail','payment_id','payment_status'];

    //many-to-one relation to customer model
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
