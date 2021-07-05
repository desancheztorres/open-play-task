<?php

namespace Database\Factories;

use App\Models\PricingModifierModel;
use App\Models\PricingOptionModel;
use App\Models\PricingOptionPricingModifierPivot;
use Illuminate\Database\Eloquent\Factories\Factory;

class PricingOptionPricingModifierPivotFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PricingOptionPricingModifierPivot::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pricing_modifier_id' => PricingModifierModel::factory()->create(),
            'pricing_option_id' => PricingOptionModel::factory()->create(),
            'valid_from' => $this->faker->dateTime,
            'active' => $this->faker->numberBetween(0, 1)
        ];
    }
}
