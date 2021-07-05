<?php

namespace Database\Factories;

use App\Models\VenueModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class VenueModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VenueModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $locations = ['London','Glasgow','Norwich','Kidderminster'];
        $location = $this->faker->randomElement($locations);
        return [
            'name' => $this->faker->company .  ' ' . $location,
            'location' => $location
        ];
    }
}
