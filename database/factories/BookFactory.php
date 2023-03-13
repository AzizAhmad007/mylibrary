<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->uuid(),
            'rack_id' => 1,
            'category_id' => 1,
            'book_title' => fake()->title(),
            'book_author' => fake()->name(),
            'publisher_book' => fake()->name(),
            'publisher_year' => '2023-01-01',
            'stock' => 10
        ];
    }
}
