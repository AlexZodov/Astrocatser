<?php


namespace App\Services;


use App\Customer;

interface IPaymentService
{

    //Some non-real interface are to implemented as DemoPaymentinterface

    public function verifyCustomerData(Customer $customer):bool;

    public function processPayment(Customer $customer, int $price):array;

}
