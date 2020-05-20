<?php


namespace App\Repositories;


use App\Customer;

class CustomerRepository extends BaseRepository
{

    //model property
    protected Customer $model;

    public function __construct(Customer $model)
    {
        //injecting the proper model
        $this->model = $model;
    }

    /**
     * Create or fetch first existing customer from Customer model
     * @param array $payload
     * @return Customer
     */
    public function createOrUpdate(array $payload):Customer {
        $instance = $this->model->firstOrNew($payload);
        $instance->fill($payload)->save();

        return $instance;
    }
}
