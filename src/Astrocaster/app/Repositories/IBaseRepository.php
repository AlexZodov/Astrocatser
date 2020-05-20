<?php


namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IBaseRepository
{
    //General Interface is to be implemented on any repository


    public function parametrizedResult(array $whereConditions = [], array $orderConditions = [], int $start = null, int $length = null):Collection;

    public function find($id = 0): Model;

    public function getCount():int;

    public function setInstance(Model $instance):Void;

}
