<?php


namespace App\Services\Entities;


use Illuminate\Database\Eloquent\Model;

interface IBaseEntityService
{

    //General Interface is to be implemented on any entity-service

    public function parametrizedResult(array $whereConditions = [], array $orderConditions = [], $start = null, $length = null);

    public function find($id = 0): Model;

    public function getCount():int;

    public function setInstance(Model $instance):Void;

}
