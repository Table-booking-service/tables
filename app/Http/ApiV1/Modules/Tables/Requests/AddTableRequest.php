<?php

namespace App\Http\ApiV1\Modules\Tables\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class AddTableRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'location' => ['required', 'string'],
            'seats' => ['required', 'integer'],
        ];
    }
}
