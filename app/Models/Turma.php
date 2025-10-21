<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    use HasFactory;

    protected $table = 'turmas';

    protected $fillable = [
        'curso_id',
        'nome',
        'codigo',
        'data_inicio',
        'data_fim',
    ];

    protected $casts = [
        'curso_id' => 'integer',
        'data_inicio' => 'date',
        'data_fim' => 'date',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    // relação 1-N: 1 Curso tem N Matriculas
    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }

    //relação N-N: curso tem muitos Alunos através da matricula
    public function alunos()
    {
        return $this->belongsToMany(Aluno::class, 'matriculas', 'curso_id', 'aluno_id')
            ->withPivot('turma_id', 'data_matricula')
            ->withTimestamps();
    }
}
