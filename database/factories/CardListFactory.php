<?php

namespace Database\Factories;

use App\Models\Board;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CardList>
 */
class CardListFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'board_id' => Board::factory(),
            'user_id' => User::factory(),
            'name' => $this->faker->name,
        ];
    }
}
