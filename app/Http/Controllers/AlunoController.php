<?php

namespace App\Http\Controllers;
use App\Models\Aluno;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                                                                                            $dados = Aluno::All();

          //dd($alunos);//php artisan migrate
          //php artisan serve

      return view('aluno.list',['dados'=> $dados]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('aluno.form');
    }


    public function store(Request $request)
    {
        //dd($request->all());

        $request->validate([
            'nome'=>'required',
            'cpf'=>'required',
        ],[
            'nome.required' => 'O :attribute é obrigatório',
            'cpf.required' => 'O :attribute é obrigatório',
        ]);

        Aluno::create($request->all());

        return redirect('aluno');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dado = Aluno::findOrFail($id);
        //dd($dado)
        return view('aluno.form', ['dado' => $dado]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all(), $id);
         $request->validate([
            'nome'=>'required',
            'cpf'=>'required',
        ],[
            'nome.required' => 'O :attribute é obrigatório',
            'cpf.required' => 'O :attribute é obrigatório',
        ]);

        Aluno::updateOrCreate(['id' => $id], $request->all());

        return redirect('aluno');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dado = Aluno::findOrFail($id);
        $dado->delete();
        return redirect('aluno');
    }

    public function search(Request $request)
    {
        if(!empty($request->valor)){
            $dados = Aluno::where(
                $request->tipo,
                'like',
                "%$request->valor%" //filtra no pesquisar
            )->get();
        } else{
            $dados = Aluno::All();
        }
        return view('aluno.list', ["dados" => $dados]);
        }
}
