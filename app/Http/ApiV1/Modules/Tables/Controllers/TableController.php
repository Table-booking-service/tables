<?php

namespace App\Http\ApiV1\Modules\Tables\Controllers;

use App\Domain\Tables\Models\Table;
use App\Http\ApiV1\Modules\Tables\Requests\AddTableRequest;
use App\Http\ApiV1\Modules\Tables\Requests\DeleteTableRequest;
use App\Http\ApiV1\Modules\Tables\Requests\EditTableRequest;
use App\Http\ApiV1\Modules\Tables\Resources\TableResource;

class TableController
{
    public function getTables(): array
    {
        //Возвращает список столиков
        $tables = Table::all();
        return TableResource::collection($tables)->toArray(request());
    }

    public function addTable(AddTableRequest $request): TableResource
    {
        //Добавляет столик
        $table = new Table();
        $table->seats = $request->get('seats');
        $table->location = $request->get('location');
        $table->save();

        return new TableResource($table);
    }

    public function getTable(int $id): TableResource
    {
        //Возвращает столик
        return new TableResource(Table::query()->findOrFail($id));
    }

    public function editTable(int $id, EditTableRequest $request): TableResource
    {
        //Изменяет столик
        $table = Table::query()->findOrFail($id);
        $table->seats = $request->get('seats');
        $table->location = $request->get('location');
        $table->save();

        return new TableResource($table);
    }

    public function deleteTable(int $id, DeleteTableRequest $request): TableResource
    {
        //Удаляет столик
        $table = Table::query()->findOrFail($id);
        $table->delete();

        return new TableResource($table);
    }
}
