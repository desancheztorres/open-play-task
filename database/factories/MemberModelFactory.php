<?php

namespace Database\Factories;

use App\Models\MemberModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MemberModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'membership_type' => $this->faker->randomElement(['bronze','silver','gold','platinum']),
            'date_of_birth' => $this->faker->dateTimeBetween('-90 years', '-16 years')
        ];
    }
}
