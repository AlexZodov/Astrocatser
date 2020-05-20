<?php


namespace App\Mapper;


use Illuminate\Contracts\Support\Arrayable;

class Meta implements Arrayable
{
    private ?int $count;

    private ?bool $success;

    public function __construct(Data $data = null, bool $success = false)
    {
        $this->count = isset($data)? $data->getCount() : 0; // here the count method from Data class is used
        $this->success = $success;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $result = [
            'count' => $this->count,
            'success' => $this->success
        ];


        return $result;
    }
}
