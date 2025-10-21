<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Turma;
use Illuminate\Http\Request;

class TurmaController extends Controller
{
    public function index()
    {
        $dados = Turma::All();

        return view('turma.list', ['dados' => $dados]);
    }

     public function cursoTurmasIndex(Curso $curso)
    {
        $dados = $curso->turmas;

        return view('turma.list', [
            'dados' => $dados,
            'curso' => $curso,
    ]);
    }

    public function create()
    {

        $cursos = Curso::orderBy('nome')->get();

        return view('turma.form', ['cursos' => $cursos]);
    }

    public function createCursoTurma(Curso $curso)
    {

        $cursos = Curso::orderBy('nome')->get();

        return view('turma.form', ['cursos' => $cursos]);
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'nome' => 'required|max:150',
            'codigo' => 'required|max:20',
            'data_inicio' => 'nullable|date',
            'data_fim' => 'nullable|date|after:data_inicio',
        ], [
            'curso_id.required' => 'O :attribute é obrigatório',
            'nome.required' => 'O :attribute é obrigatório',
            'nome.max' => 'O :attribute não pode ser mais que 150 caracteres',
            'codigo.required' => 'O :attribute é obrigatório',
            'codigo.max' => 'O :attribute não pode ser mais que 20 caracteres',
            'data_inicio.date' => 'O :attribute deve ser data ',
            'data_fim.date' => 'O :attribute deve ser data',
            'data_fim.after' => 'A :attribute deve ser posterior a data inicio',
        ]);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $this->validateRequest($request);
        $data = $request->all();

        Turma::create($data);

        return redirect('turma');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        // dd($dado);
        $dado = Turma::findOrFail($id);
        $cursos = Curso::orderBy('nome')->get();

        return view(
            'turma.form',
            [
                'dado' => $dado,
                'cursos' => $cursos,
            ]
        );
    }


    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $this->validateRequest($request);
        $data = $request->all();

        Turma::updateOrCreate(['id' => $id], $data);

        return redirect('turma');
    }


    public function destroy(string $id)
    {
        $dado = Turma::findOrFail($id);

        $dado->delete();

        return redirect('turma');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Turma::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Turma::All();
        }

        return view('turma.list', ["dados" => $dados]);
    }
}
