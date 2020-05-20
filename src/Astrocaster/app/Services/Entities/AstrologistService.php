<?php


namespace App\Services\Entities;


use App\Repositories\AstrologistRepository;
use App\Services\Entities\BaseEntityService;

class AstrologistService extends BaseEntityService
{

    public function __construct(AstrologistRepository $repository)
    {
        $this->repository = $repository;
    }

}
