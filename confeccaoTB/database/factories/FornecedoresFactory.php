<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fornecedores>
 */
class FornecedoresFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->company(),
            'cnpj' => fake()->unique()->numerify('##.###.###/0001-##'),
            'email' => fake()->unique()->companyEmail(),
            'telefone' => fake()->phoneNumber(),
            'endereco' => fake()->streetAddress(),
        ];
    }
}
