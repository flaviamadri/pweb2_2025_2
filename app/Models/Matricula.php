<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matriculas';

    protected $fillable = [
        'curso_id',
        'turma_id',
        'aluno_id',
        'data_matricula',
    ];

    protected $cats = [
        'curso_id' => 'integer',
        'turma_id' => 'integer',
        'aluno_id' => 'integer',
        'data_matricula' => 'date',
    ];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

}
