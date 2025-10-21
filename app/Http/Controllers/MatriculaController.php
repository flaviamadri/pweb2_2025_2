<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Matricula;
use App\Models\Turma;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index()
    {
        $dados = Matricula::All();

        return view('matricula.list', ['dados' => $dados]);
    }


    public function create()
    {
        //use App\Models\Curso;
        $cursos = Curso::orderBy('nome')->get();
        $turmas = Turma::orderBy('nome')->get();
        $alunos = Aluno::orderBy('nome')->get();

        return view('matricula.form', [
            'cursos' => $cursos,
            'turmas' => $turmas,
            'alunos' => $alunos,
        ]);
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'turma_id' => 'required|exists:turmas,id',
            'aluno_id' => 'required|exists:alunos,id',
            'data_matricula' => 'nullable|date',
        ], [
            'curso_id.required' => 'O :attribute é obrigatório',
            'turma_id.required' => 'O :attribute é obrigatório',
            'aluno_id.required' => 'O :attribute é obrigatório',
            'data_matricula.date' => 'O :attribute deve ser data ',
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $this->validateRequest($request);
        $data = $request->all();

        $data = Matricula::create($data);

        // dd($turma);
        return redirect()->route('matricula.index', $data);
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        // dd($dado);
        $dado = Matricula::findOrFail($id);
        $cursos = Curso::orderBy('nome')->get();
        $turmas = Turma::orderBy('nome')->get();
        $alunos = Aluno::orderBy('nome')->get();

        return view(
            'matricula.form',
            [
                'dado' => $dado,
                'cursos' => $cursos,
                'turmas' => $turmas,
                'alunos' => $alunos,
            ]
        );
    }


    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $this->validateRequest($request);
        $data = $request->all();

        Matricula::updateOrCreate(['id' => $id], $data);

        return redirect()->route('matricula.index');
    }

    public function destroy(string $id)
    {
        $dado = Matricula::findOrFail($id);

        $dado->delete();

        return redirect('matricula');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $query = Matricula::with(['curso', 'turma', 'aluno']);

            $valor = $request->valor;

            $query->whereHas(
                $request->tipo,
                function ($q) use ($valor) {
                    $q->where('nome', 'like', "%$valor%");
                }
            );
            $dados = $query->get();
        } else {
            $dados = Matricula::All();
        }
        return view('matricula.list', ["dados" => $dados]);
    }
}