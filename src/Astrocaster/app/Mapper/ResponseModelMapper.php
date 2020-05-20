<?php


namespace App\Mapper;


use App\Mapper\Casts\ResponseDataCast;
use App\Mapper\Casts\ResponseErrorsCast;
use App\Mapper\Casts\ResponseMetaCast;
use Illuminate\Database\Eloquent\Model;

class ResponseModelMapper extends Model
{

    //values of response are to be resolved via Custom Casts
    protected $casts = [
        'data' => ResponseDataCast::class,
        'errors' => ResponseErrorsCast::class,
        'meta' => ResponseMetaCast::class,
    ];

    protected $fillable = [
        'data',
        'errors',
        'meta'
    ];

    public function __construct(array $attributes = [])
    {

        parent::__construct($attributes);

        if((isset($this->data) && is_array($this->data->getValue()) && count($this->data->getValue())>0)){
            //if data exists then set it and calculate Meta from its content
            $this->meta = new Meta($this->data, true);
            $this->errors = new Error();
        }else{
            //else - we have an error/exception given in constructor, in this case - fill empty data and set Meta to success=false
            $this->data = new Data();
            $this->meta = new Meta($this->data,false);
        }
    }

}
