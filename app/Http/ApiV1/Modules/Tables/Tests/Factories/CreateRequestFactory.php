<?php

namespace App\Http\ApiV1\Modules\Tables\Tests\Factories;

use Ensi\LaravelTestFactories\BaseApiFactory;

class CreateRequestFactory extends BaseApiFactory
{
    protected function definition(): array
    {
        return [
            'seats' => $this->faker->numberBetween(1, 10),
            'location' => $this->faker->text(10),
        ];
    }

    public function make(array $extra = []): array
    {
        return $this->definition();
    }
}
