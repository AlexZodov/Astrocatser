<?php


namespace App\Services\Entities;


use App\Repositories\CustomerRepository;
use App\Customer;
use App\Services\Entities\BaseEntityService;

class CustomerService extends BaseEntityService
{

    public function __construct(CustomerRepository $repository)
    {
        $this->repository = $repository;
    }

    //wrapper over repository method
    public function createOrUpdate(array $payload): Customer{
        return $this->repository->createOrUpdate($payload);
    }

}
