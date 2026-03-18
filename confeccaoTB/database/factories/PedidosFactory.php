<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedidos>
 */
class PedidosFactory extends Factory
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

        return [
            'nome_cliente' => fake()->name(),
            'produto_pedido' => fake()->randomElement($produtos),
            'quantidade_pedido' => fake()->numberBetween(1, 50),
            'data' => fake()->dateTimeBetween('-3 months', 'now')->format('Y-m-d'),
            'preco_pedido' => fake()->randomFloat(2, 25, 250),
        ];
    }
}
