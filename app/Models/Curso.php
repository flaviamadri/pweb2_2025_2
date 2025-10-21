<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';

    protected $fillable = [
        'nome',
        'requisito',
        'carga_horaria',
        'valor',
    ];

    // relação 1-N: 1 curso tem N turmas
    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }
     // relação 1-N: 1 Curso tem N Matriculas
     public function matriculas()
     {
         return $this->hasMany(Matricula::class);
     }

    //relação N-N: curso tem muitos Alunos através da matricula
    public function alunos(){
        return $this->belongsToMany(Aluno::class,'matriculas','curso_id','aluno_id')
        ->withPivot('turma_id','data_matricula')
        ->withTimestamps();
    }

}
