<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Governorate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Governorate>
 */
class GovernorateFactory extends Factory
{
    
    protected static $counter = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'country_id' => Country::inRandomOrder()->first()->id,
            'title' => 'Governrate-' . self::$counter++,
        ];
    }
}
