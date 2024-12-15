<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word, 
            'description' => $this->faker->sentence, // Descrição fictícia
            'price' => $this->faker->randomFloat(2, 10, 5000), // Preço entre 10 e 5000 com 2 casas decimais
            'quantity' => $this->faker->numberBetween(1, 100), // Quantidade entre 1 e 100
            'active' => $this->faker->boolean, // Status ativo (true ou false)
        ];
    }
}
