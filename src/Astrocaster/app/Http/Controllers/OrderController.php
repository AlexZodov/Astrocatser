<?php

namespace App\Http\Controllers;

use App\Mapper\Data;
use App\Mapper\ResponseModelMapper;
use App\Services\Entities\OrderService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    private OrderService $orderService; //service property

    public function __construct(OrderService $orderService)
    {
        //injecting the proper service
        $this->orderService = $orderService;
    }


    /**
     * Store an order by info provided in request
     *
     * @param \Illuminate\Http\Request
     * @return ResponseModelMapper
     * @throws \JsonException
     */
    public function store(Request $request){

        $result = $this->orderService->createOrder($request->all());

        //wrapping the result into ResponseModelMapper
        return new ResponseModelMapper(['data'=>new Data($result)]);
    }
}
