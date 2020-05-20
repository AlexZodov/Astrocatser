<?php


namespace App\Mapper;


use Illuminate\Contracts\Support\Arrayable;

class Data implements Arrayable
{
    private $value;

    public function __construct(array $data = [])
    {
        $this->value = $data;
    }

    /**
     * @return mixed
     */
    public function getValue() : ?array
    {
        return $this->value;
    }

    public function getCount():int{

        //additional logic is to be implemented to handle different data payload structure (associative, flat array, nested, etc)
        if(is_array($this->value)){
            if($this->isValueAssoc()){
                if(count(array_keys($this->value))===1){
                    $result = 0;
                    if(is_countable($this->value[array_key_first($this->value)])){
                        $result = count($this->value[array_key_first($this->value)]);
                    }else{
                        $result = 1;
                    }
                    return $result;
                }
                return 1;
            }
            return count($this->value);
        }

        return 0;
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return $this->value;
    }

    private function isValueAssoc():bool
    {
        if (array() === $this->value) return false;
        return array_keys($this->value) !== range(0, count($this->value) - 1);
    }
}
