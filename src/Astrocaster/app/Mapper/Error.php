<?php


namespace App\Mapper;


use Illuminate\Contracts\Support\Arrayable;

class Error implements Arrayable
{
    private ?string $exceptionType;

    private ?string $code;

    private ?string $message;

    private ?array $trace;

    public function __construct(\Throwable $exception = null)
    {

        if(isset($exception)){
            $this->code = $exception->getCode();
            $this->message = $exception->getMessage();
            $this->exceptionType = get_class($exception);
            //add trace info only in next ENVs
            if(in_array(env('APP_ENV'),[/*'development',*/'local'])){
                $this->trace = $exception->getTrace();
            }
        }
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        $result = [];
        if(isset($this->code)){
            $result['code'] = $this->code;
        }
        if(isset($this->message)){
            $result['message'] = $this->message;
        }
        if(isset($this->exceptionType)){
            $result['exceptionType'] = $this->exceptionType;
        }
        if(isset($this->trace)){
            $result['trace'] = $this->trace;
        }
        return $result;
    }
}
