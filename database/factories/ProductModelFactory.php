<?php

namespace Database\Factories;

use App\Models\ProductModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = [
            'pool-class' => ['Open Swim', 'Lane Swim', 'Ladies Only Swim','Kids Swim'],
            'swimwear' => ['Goggles (Red)', 'Googles (Green)', 'Swim Trunks', 'Earplugs'],
            'gym-class' => ['Boxercise','Fitness Instructor Session','Interval Training'],
        ];

        $type = $this->faker->randomElement(array_keys($types));
        $name = $this->faker->randomElement($types[$type]);
        return [
            'name' => $name,
            'type' => $type,
            'description' => $this->faker->paragraph,
            'pricing_option_id' => \App\Models\PricingOptionModel::inRandomOrder()->select('id')->first()->id
        ];
    }
}
