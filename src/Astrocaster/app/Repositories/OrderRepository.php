<?php


namespace App\Repositories;


use App\Order;
use Mockery\Exception;

class OrderRepository extends BaseRepository
{

    //model property
    protected Order $model;

    public function __construct(Order $model)
    {
        //injecting the proper model
        $this->model = $model;
    }

    /**
     * Create an order with given data
     * but check for its presence firstly
     * @param array $payload
     * @return Order
     * @throws \JsonException
     */
    public function create(array $payload):Order{

        //if there is already an order from this customer and with given by him order params
        // than throw an exception
        $previuos =$this->model->where('customer_id','=',$payload['customer_id'])
            ->whereJsonContains('order_detail->astrologist_id', $payload['order_detail']['astrologist_id'])
            ->whereJsonContains('order_detail->service_id', $payload['order_detail']['service_id'])
            ->whereJsonContains('order_detail->price', $payload['order_detail']['price'])
            ->first();
        if($previuos !== null){
            throw new Exception('Order have already been processed');
        }

        //else - create order with given params
        //encoding into json 'order_detail' property cause DB field is in json format
        $payload['order_detail'] = json_encode($payload['order_detail'], JSON_THROW_ON_ERROR);

        return $this->model->create($payload);
    }

    /**
     * Update existing order
     *
     * @param array $payload
     * @return bool
     */
    public function update(array $payload): bool
    {
        return $this->instance->update($payload);
    }


}
