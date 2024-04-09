<?php

namespace App\Http\ApiV1\Modules\Tables\Requests;

use App\Http\ApiV1\Support\Requests\BaseFormRequest;

class EditTableRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer'],
            'seats' => ['required', 'integer'],
            'location' => ['required', 'string'],
        ];
    }
}