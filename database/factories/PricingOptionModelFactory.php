<?php

namespace Database\Factories;

use App\Models\PricingOptionModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class PricingOptionModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PricingOptionModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = $this->faker->randomElement(['elite','premium','basic']);
        return [
            'name' => $this->faker->colorName . ' ' . ucfirst($type),
            'type' => $type,
            'price' => $this->faker->randomFloat(2,5.00,200.00)
        ];
    }
}
