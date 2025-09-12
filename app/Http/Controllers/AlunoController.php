<?php

namespace App\Http\Controllers;
use App\Models\Aluno;
use Illuminate\Http\Request;
use App\Models\CategoriaAluno;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {                                                                                            $dados = Aluno::All();

          //dd($alunos);//php artisan migrate
          //php artisan serve

      return view('aluno.list',['dados'=> $dados]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = CategoriaAluno::orderBy('nome')->get();
        return view('aluno.form' , ['categorias'=> $categorias]);
    }


    private function validadeRequest(Request $request)
    {
        $request->validate([
            'nome'=>'required',
            'cpf'=>'required',
            'categoria_id'=>'required',
            'imagem'=>'nullable|image|mimes:png,jpg,jpeg',
        ],[
            'nome.required' => 'O :attribute é obrigatório',
            'cpf.required' => 'O :attribute é obrigatório',
            'categoria_id.required' => 'O :attribute é obrigatório',
            'imagem.image' => 'O :attribute deve ser enviado',
            'imagem.mimes' => 'O :attribute ddeve ser das extensões PNG, JPG e JPEG',
        ]);

    }

    public function store(Request $request)
    {
        //dd($request->all());

        $this->validadeRequest( $request);
        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem){
            $nome_imagem = date('YmdHis'). ".".$imagem->getClientOriginalExtension();
            $diretorio = "imagem/aluno/";
            $imagem->storeAs(
                $diretorio,
                $nome_imagem,
                'public'
            );
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        Aluno::create($data);

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
        $categorias = CategoriaAluno::orderBy('nome')->get();

        return view('aluno.form',
        [
            'dado' => $dado,
            'categorias' => $categorias
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //dd($request->all(), $id);
         $this->validadeRequest( $request);
        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem){
            $nome_imagem = date('YmdHis'). ".".$imagem->getClientOriginalExtension();
            $diretorio = "imagem/aluno/";
            $imagem->storeAs(
                $diretorio,
                $nome_imagem,
                'public'
            );
            $data['imagem'] = $diretorio . $nome_imagem;
        }

        Aluno::updateOrCreate(['id' => $id], $data);

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
