<?php


namespace App\Services\Entities;


use App\Customer;
use App\Jobs\WriteDataToGoogleSheet;
use App\Repositories\OrderRepository;
use App\Services\Entities\CustomerService;
use App\Services\IPaymentService;
use App\Services\PaymentService;
use Exception;
use Revolution\Google\Sheets\Facades\Sheets;

class OrderService extends BaseEntityService
{

    private CustomerService $customerService; //customer service property

    private IPaymentService $paymentService; //demo payment service property

    private AstrologistService $astrologistService; //astrologist service property

    public function __construct(OrderRepository $repository,
                                CustomerService $customerService,
                                PaymentService $paymentService,
                                AstrologistService $astrologistService)
    {
        //injecting all required repositories and services

        $this->repository = $repository;

        $this->customerService = $customerService;

        $this->paymentService = $paymentService;

        $this->astrologistService = $astrologistService;

    }

    /**
     * 1. Create or fetch customer
     * 2. Fetch astrologist and its selected service with price
     * 3. Create order entry
     * 4. Try to make a payment
     * 5. Prepare data for the Job
     * 5. Dispatch the Job to make a record into Google Sheet
     * 6. Return result of Order creation
     * @param array $data
     * @return array
     * @throws \JsonException
     * @throws Exception
     */
    public function createOrder(array $data): array
    {
        $customer = $this->customerService->createOrUpdate([
            'name' => $data['name'],
            'email' => $data['email']
        ]);

        $astrologist = $this->astrologistService->find($data['astrologist_id']);
        $service = $astrologist->priceAndServiceById($data['service_id']);

        $payloadOrderDetail = [
            'customer_id' => $customer->id,
            'order_detail' => [
                'astrologist_id' => $astrologist->id,
                'service_id' => $service->id,
                'price' => $service->pivot->price/100
            ]

        ];

        $order = $this->repository->create($payloadOrderDetail);

        $this->repository->setInstance($order); //setting instance to just created order entry

        $payment = $this->processPayment($customer, $service->pivot->price);

        $payloadPaymentDetail = [
            'payment_id' => $payment['payment_id'],
            'payment_status' => json_encode($payment, JSON_THROW_ON_ERROR)
        ];

        $this->repository->update($payloadPaymentDetail);

        // PUSH TO GOOGLE SHEETS
        //Columns are to be given below
        //Customer ID||Customer name||Customer email
        //||Order astrologist ID||Order astrologist name
        //||Order service ID||Order service name||
        //Order service price||Payment ID||Payment status
        $payloadSheets = [
            $customer->id,
            $customer->name,
            $customer->email,
            $astrologist->id,
            $astrologist->first_name.' '.$astrologist->last_name.' '.$astrologist->patronymic_name,
            $service->id,
            $service->service_name,
            $service->pivot->price/100,
            $payloadPaymentDetail['payment_id'],
            $payloadPaymentDetail['payment_status']
        ];

        WriteDataToGoogleSheet::dispatch($payloadSheets);
        //

        return $payment;

    }

    /**
     * 1. Verify customer payment credentials
     * 2. If they are valid - process the payment
     * @param Customer $customer
     * @param int $priceAndService
     * @return array
     * @throws Exception
     */
    public function processPayment(Customer $customer, int $priceAndService):array {
        if(!$this->paymentService->verifyCustomerData($customer)){
            throw new Exception('Customer data is not valid');
        }

        return $this->paymentService->processPayment($customer,$priceAndService);
    }

}
