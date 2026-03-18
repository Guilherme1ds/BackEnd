<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produtos>
 */
class ProdutosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nomes = [
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
        $descricoes = [
            'T-shirt de algodão confortável para uso diário.',
            'Calça jeans com corte reto e lavagem escura.',
            'Vestido longo elegante para eventos formais.',
            'Blusa feminina com estampa floral vibrante.',
            'Shorts leve e arejado para dias quentes.',
            'Jaqueta acolchoada resistente ao vento.',
            'Legging com tecido elástico para exercícios.',
            'Regata premium em malha suave.',
            'Bermuda casual com bolsos laterais.',
            'Saia midi plissada de tecido leve.',
        ];

        return [
            'nome' => fake()->randomElement($nomes),
            'descricao' => fake()->randomElement($descricoes),
            'preco' => fake()->randomFloat(2, 5, 500),
            'quantidade_estoque' => fake()->numberBetween(0, 200),
        ];
    }
}
