<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Slider>
 */
class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected static $counter = 1;

    public function definition(): array
    {
        return [
            'image'          => 'brand_' . self::$counter++ . '.jbg',
            'slidable_type'  => "App\\Models\\" . $this->faker->randomElement(['Product', 'Category']),
            'slidable_id'    => 2,
        ];
    }
}
