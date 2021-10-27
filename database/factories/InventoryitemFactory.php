<?php

namespace Database\Factories;

use App\Models\Inventoryitem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryitemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Inventoryitem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->jobTitle(),
            'user_id' => rand(1,3),
            'serial_number' => $this->faker->creditCardNumber(),
            'price' => $this->faker->numerify('##.##'),
        ];
    }
}
