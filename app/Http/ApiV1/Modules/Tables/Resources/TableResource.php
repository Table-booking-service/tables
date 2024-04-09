<?php

namespace App\Http\ApiV1\Modules\Tables\Resources;

use App\Http\ApiV1\Support\Resources\BaseJsonResource;

class TableResource extends BaseJsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $request->get('id'),
            'seats' => $request->get('seats'),
            'location' => $request->get('location'),
        ];
    }
}
