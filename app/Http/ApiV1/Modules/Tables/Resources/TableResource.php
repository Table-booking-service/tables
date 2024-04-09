<?php

namespace App\Http\ApiV1\Modules\Tables\Resources;

use App\Domain\Tables\Models\Table;
use App\Http\ApiV1\Support\Resources\BaseJsonResource;

/**
 * @mixin Table
 */
class TableResource extends BaseJsonResource
{
    public function toArray($request): array
    {
        // todo
        return [
            'id' => $this->id,
            'seats' => $this->seats,
            'location' => $this->location,
        ];
    }
}
