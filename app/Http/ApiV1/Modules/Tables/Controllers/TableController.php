<?php

namespace App\Http\ApiV1\Modules\Tables\Controllers;

use App\Domain\Tables\Models\Table;
use App\Http\ApiV1\Modules\Tables\Requests\AddTableRequest;
use App\Http\ApiV1\Modules\Tables\Requests\DeleteTableRequest;
use App\Http\ApiV1\Modules\Tables\Requests\EditTableRequest;
use App\Http\ApiV1\Modules\Tables\Resources\TableResource;
use App\Http\ApiV1\Modules\Tables\Resources\TablesResource;
use App\Http\ApiV1\Support\Resources\EmptyResource;

class TableController
{
    private function checkHeaders(): void
    {
        $data = env('X_API_SECRET_DATA');
        $algo = env('X_API_SECRET_ALGORITHM');
        $key = env('X_API_SECRET_KEY');
        $iv = str_repeat('0', openssl_cipher_iv_length($algo));
        $value = openssl_encrypt($data, $algo, $key, 0, $iv);           //HDHffpH3pqY64svULpEFhg==
        $headers = request()->header();
        if (!array_key_exists('x-api-secret', $headers) || $headers['x-api-secret'][0] != $value) {
            abort(403, 'Forbidden');
        }
    }

    public function getTables(): TablesResource
    {
        //Возвращает список столиков
        $this->checkHeaders();
        return new TablesResource(Table::query()->get());
    }

    public function addTable(AddTableRequest $request): TableResource
    {
        //Добавляет столик
        $this->checkHeaders();
        $table = new Table();
        $seats = $request->get('seats');
        $location = $request->get('location');
        if ($seats < 1) {
            abort(400, 'Bad Request');
        }
        $table->seats = $seats;
        $table->location = $location;
        $table->save();

        return new TableResource($table);
    }

    public function getTable(int $id): TableResource
    {
        //Возвращает столик
        $this->checkHeaders();
        return new TableResource(Table::query()->findOrFail($id));
    }

    public function editTable(int $id, EditTableRequest $request): TableResource
    {
        //Изменяет столик
        $this->checkHeaders();
        $table = Table::query()->findOrFail($id);
        $seats = $request->get('seats');
        $location = $request->get('location');
        if ($seats < 1) {
            abort(400, 'Bad Request');
        }
        $table->seats = $seats;
        $table->location = $location;
        $table->save();

        return new TableResource($table);
    }

    public function deleteTable(int $id, DeleteTableRequest $request): EmptyResource
    {
        //Удаляет столик
        $this->checkHeaders();
        $table = Table::query()->findOrFail($id);
        $table->delete();

        return new EmptyResource();
    }
}
