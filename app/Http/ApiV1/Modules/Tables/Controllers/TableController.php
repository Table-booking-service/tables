<?php

namespace App\Http\ApiV1\Modules\Tables\Controllers;

use App\Domain\Tables\Models\Table;
use App\Http\ApiV1\Modules\Tables\Requests\AddTableRequest;
use App\Http\ApiV1\Modules\Tables\Requests\EditTableRequest;
use App\Http\ApiV1\Modules\Tables\Resources\TableResource;
use Illuminate\Routing\Controller;
use phpDocumentor\Reflection\Types\Collection;

class TableController extends Controller
{
    public function getTables(): array|\Illuminate\Database\Eloquent\Collection
    {
        return Table::all();
    }

    public function addTable(AddTableRequest $request): TableResource
    {
        $table = new Table();
        $table->seats = $request->get('seats');
        $table->location = $request->get('location');
        $table->save();

        return new TableResource($table);
    }

    public function editTable(EditTableRequest $request): TableResource
    {
        $table = Table::query()->findOrFail($request->get('id'));
        $table->seats = $request->get('seats');
        $table->location = $request->get('location');
        $table->save();

        return new TableResource($table);
    }

    public function deleteTable(int $id): void
    {
        Table::query()->findOrFail($id)->delete();
    }

    public function getTable(int $id): TableResource
    {
        $table = Table::query()->findOrFail($id);

        return new TableResource($table);
    }
}
