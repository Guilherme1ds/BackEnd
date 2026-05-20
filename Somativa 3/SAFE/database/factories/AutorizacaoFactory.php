<?php

namespace Database\Factories;

use App\Models\Autorizacao;
use App\Models\Aluno;
use App\Models\Turma;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AutorizacaoFactory extends Factory
{
    protected $model = Autorizacao::class;

    public function definition(): array
    {
        return [
            'aluno_id' => Aluno::factory(),
            'turma_id' => Turma::factory(),
            'tipo' => $this->faker->randomElement(['entrar', 'sair']),
            'horario' => $this->faker->time(),
            'conta_falta' => $this->faker->boolean(),
            'aulas_afetadas' => json_encode(['1ª', '2ª', '3ª']),
            'status' => $this->faker->randomElement(['pendente', 'autorizado_professor', 'concluido_portaria', 'recusado']),
            'criado_por_id' => User::factory(),
            'aprovado_por_id' => User::factory(),
            'validado_por_id' => User::factory(),
            'observacao' => $this->faker->text(200),
        ];
    }
}
