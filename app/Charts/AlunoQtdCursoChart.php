<?php

namespace App\Charts;

use App\Models\Aluno;
use App\Models\Curso;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class AlunoQtdCursoChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {

        //$alunos = Aluno::All()->count();
        $cursos = Curso::withCount('alunos')
            ->having('alunos_count', '>', 0)
            ->orderBy('alunos_count', 'desc')
            ->get();

        $qtdAlunos = [];
        $nomeCursos = [];

        foreach ($cursos as $curso) {
            $qtdAlunos[] = $curso->alunos_count;
            $nomeCursos[] = $curso->nome;
        }

        return $this->chart->pieChart()
            ->setTitle('Quantidade de Alunos por Curso')
            ->setSubtitle('Season 2021.')
            ->addData($qtdAlunos)
            ->setLabels($nomeCursos);
    }
}
