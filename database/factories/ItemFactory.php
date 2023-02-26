<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $goods = ['A商品', 'B商品', 'C商品', 'D商品', 'E商品', 'F商品', 'G商品', 'H商品'];
        return [
            'name' => $this->faker->randomElement($goods),
            'status' => "active",
            'type' => $this->faker->numberBetween(0, 3),
            'detail' => $this->faker->realText(50),
        ];
    }
}
