<?php

namespace Database\Factories;

use App\Domain\Tables\Models\Table;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Table>
 */
class TableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'seats' => $this->faker->numberBetween(1, 10),
            'location' => $this->faker->city(),
        ];
    }
}
