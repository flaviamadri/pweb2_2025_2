<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $dados = Curso::All();

        return view('curso.list', ['dados' => $dados]);
    }


    public function create()
    {

        return view('curso.form');
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'requisito' => 'nullable|string',
            'carga_horaria' => 'nullable|numeric',
            'valor' => 'nullable|numeric',
        ], [
            'nome.required' => 'O :attribute é obrigatório',
            'requisito.string' => 'O :attribute deve ser caractére ',
            'carga_horaria.numeric' => 'O :attribute deve ser númerico',
            'valor.numeric' => 'O :attribute deve ser númerico',
        ]);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $this->validateRequest($request);
        $data = $request->all();

        Curso::create($data);

        return redirect('curso');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        // dd($dado);
        $dado = Curso::findOrFail($id);

        return view( 'curso.form',
            [
                'dado' => $dado,
            ]
        );
    }


    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $this->validateRequest($request);
        $data = $request->all();

        Curso::updateOrCreate(['id' => $id], $data);

        return redirect('curso');
    }


    public function destroy(string $id)
    {
        $dado = Curso::findOrFail($id);

        $dado->delete();

        return redirect('curso');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Curso::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Curso::All();
        }

        return view('curso.list', ["dados" => $dados]);
    }
}
