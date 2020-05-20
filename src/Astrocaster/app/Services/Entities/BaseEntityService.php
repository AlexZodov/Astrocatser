<?php


namespace App\Services\Entities;


use App\Services\Entities\IBaseEntityService;
use App\Repositories\IBaseRepository;
use Illuminate\Database\Eloquent\Model;

abstract class BaseEntityService implements IBaseEntityService
{
    //Abstract class that implements IBaseService interface/
    //Handles basic service-common logic
    //Actually it is an wrapper-layer over repositories, so system can be scaled to work with different repositories for one Entity

    public IBaseRepository $repository; //repository instance

    //wrapper over repository method
    public function parametrizedResult(array $whereConditions = [], array $orderConditions = [], $start = null, $length = null){

        return $this->repository->parametrizedResult($whereConditions,$orderConditions, $start, $length);
    }

    //wrapper over repository method
    public function find($id = null): Model
    {

        return $this->repository->find($id);
    }

    //wrapper over repository method
    public function getCount():int {

        return $this->repository->getCount();
    }

    //wrapper over repository method
    public function setInstance(Model $instance):void {

        if(isset($instance)){
            $this->repository->setInstance($instance);
        }
    }
}
