<?php


namespace App\Mapper\Casts;


use App\Mapper\Data;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ResponseDataCast implements CastsAttributes
{

    /**
     * @inheritDoc
     */
    public function get($model, string $key, $value, array $attributes): ?Data
    {
        return new Data(is_array($value)? $value : []);
    }

    /**
     * @inheritDoc
     * @throws \JsonException
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return json_encode(is_array($value) ? [] : $value->toArray(), JSON_THROW_ON_ERROR);
    }
}
