<?php


namespace App\Mapper\Casts;


use App\Mapper\Meta;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ResponseMetaCast implements CastsAttributes
{

    /**
     * @inheritDoc
     * @throws \JsonException
     */
    public function get($model, string $key, $value, array $attributes): ?Meta
    {
        if (! $value) {
            return null;
        }

        return new Meta(json_decode($value, true, 512, JSON_THROW_ON_ERROR));
    }

    /**
     * @inheritDoc
     * @throws \JsonException
     */
    public function set($model, string $key, $value, array $attributes)
    {

        return json_encode(is_array($value) ? $value->toArray() : (new Meta())->toArray(), JSON_THROW_ON_ERROR);
    }
}
