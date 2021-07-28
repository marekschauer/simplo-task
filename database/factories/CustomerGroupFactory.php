<?php

namespace Database\Factories;

use App\Models\CustomerGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerGroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerGroup::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'discount' => $this->faker->numberBetween(0,100),
            'active' => $this->faker->numberBetween(0,1)
        ];
    }
}
