<?php


namespace App\Services;


use App\Customer;
use Exception;

class PaymentService implements IPaymentService
{

    //Demo Payment Service

    /**
     * Demo function to verify customer data
     * Randomly returns false result
     * @param Customer $customer
     * @return bool
     * @throws Exception
     */
    public function verifyCustomerData(Customer $customer): bool
    {
        $result = false;
        if(random_int(1,100) > 3){
            $result = true;
        }

        return $result;
    }


    /**
     * Demo function to execute the payment
     * Randomly returns error result
     * @param Customer $customer
     * @param int $price
     * @return array
     * @throws Exception
     */
    public function processPayment(Customer $customer, int $price): array
    {
        $result = [
            'payment_id'=>'',
            'status' => '',
            'success' => false
        ];

        if(random_int(1,10) === 4){
            $result['payment_id'] = null;
            $result['status'] = 'Error occurred during payment';
            $result['success'] = false;
        }else{
            $result['payment_id'] = substr(bin2hex(random_bytes(20)),0,20);
            $result['status'] = 'Processed';
            $result['success'] = true;
        }


        return $result;
    }
}
