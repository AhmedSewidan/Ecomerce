<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    protected static $counter = 5;

    public function definition(): array
    {
        return [
            'title'    => 'Brand_' . self::$counter++,
            'photo'    => 'brand.jbg',
            'web_link' => 'http://brand.com',
            'description' => $this->faker->sentence,
            'status'   => random_int(0, 1),
        ];
    }
}
