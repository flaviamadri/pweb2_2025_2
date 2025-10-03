<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Matricula>
 */
class MatriculaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'curso_id'=> \App\Models\Curso::all()->random()->id,
            'turma_id'=> \App\Models\Turma::all()->random()->id,
            'aluno_id'=> \App\Models\Aluno::all()->random()->id,
            'data_matricula'=> $this->faker->date(),
        ];
    }
}
