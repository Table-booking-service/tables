<?php

namespace App\Domain\Tables\Models\Tests\Factories;

use App\Domain\Tables\Models\Table;
use Ensi\LaravelTestFactories\BaseModelFactory;

class TableFactory extends BaseModelFactory
{
    protected $model = Table::class;
    /**
     * @inheritDoc
     */
    public function definition(): array
    {
        return [
            'seats' => $this->faker->numberBetween(1, 10),
            'location' => $this->faker->text(10),
        ];
    }
}
