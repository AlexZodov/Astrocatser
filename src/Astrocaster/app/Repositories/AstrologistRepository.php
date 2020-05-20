<?php


namespace App\Repositories;


use App\Astrologist;

class AstrologistRepository extends BaseRepository
{

    //model property
    protected Astrologist $model;

    public function __construct(Astrologist $model)
    {
        //injecting the proper model
        $this->model = $model;
    }

}
