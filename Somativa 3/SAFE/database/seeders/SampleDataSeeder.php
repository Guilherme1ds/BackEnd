<?php

namespace Database\Seeders;

use App\Models\Turma;
use App\Models\Aluno;
use App\Models\Autorizacao;
use App\Models\User;
use Illuminate\Database\Seeder;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Criar turmas
        $turmas = Turma::factory(5)->create([
            'nome' => function () {
                static $counter = 0;
                $names = ['1º Ano A', '1º Ano B', '2º Ano A', '2º Ano B', '3º Ano A'];
                return $names[$counter++] ?? '3º Ano B';
            },
        ]);

        // Criar alunos por turma
        foreach ($turmas as $turma) {
            Aluno::factory(8)->create([
                'turma_id' => $turma->id,
                'nome_responsavel' => function () {
                    $names = ['João Silva', 'Maria Santos', 'Carlos Oliveira', 'Ana Costa', 'Pedro Ferreira'];
                    return $names[array_rand($names)];
                },
                'telefone_responsavel' => function () {
                    return '(' . rand(11, 99) . ') 9' . rand(8000, 9999) . '-' . rand(1000, 9999);
                },
            ]);
        }

        // Criar usuários para diferentes papéis
        $professor = User::factory()->create([
            'name' => 'Prof. João',
            'email' => 'professor@escola.com',
            'password' => bcrypt('password'),
        ]);
        $professor->assignRole('professor');

        $portaria = User::factory()->create([
            'name' => 'João Portaria',
            'email' => 'portaria@escola.com',
            'password' => bcrypt('password'),
        ]);
        $portaria->assignRole('portaria');

        $admin = User::first();
        if ($admin) {
            $admin->assignRole('admin');
        }

        // Criar autorizações de exemplo
        $alunos = Aluno::all();
        $tipos = ['entrar', 'sair'];
        $status_options = ['pendente', 'autorizado_professor', 'concluido_portaria'];

        foreach ($alunos->random(15) as $aluno) {
            Autorizacao::create([
                'aluno_id' => $aluno->id,
                'turma_id' => $aluno->turma_id,
                'tipo' => $tipos[array_rand($tipos)],
                'horario' => now()->addHours(rand(0, 8))->format('H:i'),
                'conta_falta' => rand(0, 1),
                'aulas_afetadas' => ['1ª', '2ª', '3ª'],
                'status' => $status_options[array_rand($status_options)],
                'criado_por_id' => $professor->id,
                'aprovado_por_id' => rand(0, 1) ? $professor->id : null,
                'validado_por_id' => rand(0, 1) ? $portaria->id : null,
                'observacao' => 'Autorização de teste criada pelo seeder',
            ]);
        }
    }
}
