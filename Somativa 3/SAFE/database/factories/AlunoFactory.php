<?php

namespace Database\Factories;

use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlunoFactory extends Factory
{
    protected $model = Aluno::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'turma_id' => Turma::factory(),
            'nome_responsavel' => $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'telefone_responsavel' => '(' . rand(11, 99) . ') 9' . rand(8000, 9999) . '-' . rand(1000, 9999),
        ];
    }
}
