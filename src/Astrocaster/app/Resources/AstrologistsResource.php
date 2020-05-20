<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AstrologistsResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function toArray($request)
    {
        //map the collection of Astrologist models
        return AstrologistResource::collection($this->collection);
    }
}
