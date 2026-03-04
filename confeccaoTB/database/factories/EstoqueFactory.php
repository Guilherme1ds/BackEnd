<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estoque>
 */
class EstoqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $produtos = [
            'Camiseta Básica',
            'Calça Jeans',
            'Vestido Social',
            'Blusa Estampada',
            'Shorts de Verão',
            'Jaqueta de Frio',
            'Legging Fitness',
            'Regata Premium',
            'Bermuda Casual',
            'Saia Midi',
        ];
        $locais = [
            'Armazém A',
            'Armazém B',
            'Prateleira 1',
            'Prateleira 2',
            'Depósito Sul',
            'Depósito Norte',
            'Estoque Central',
        ];

        return [
            'produto' => fake()->randomElement($produtos),
            'quantidade' => fake()->numberBetween(0, 500),
            'localizacao' => fake()->optional()->randomElement($locais),
            'preco_custo' => fake()->randomFloat(2, 1, 100),
            'preco_venda' => fake()->randomFloat(2, 10, 200),
            'estoque_minimo' => fake()->numberBetween(0, 20),
        ];
    }
}
