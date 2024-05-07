<?php

namespace App\Http\ApiV1\Modules\Tables\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class TablesResource extends BaseJsonResource
{
    public function toArray($request): array
    {
        return [
            'data' => TableResource::collection($this->resource),
        ];
    }
}