<?php

namespace App\Http\Controllers;

use App\Charts\AlunoQtdCursoChart;
use App\Models\Aluno;
use App\Models\CategoriaAluno;
use Illuminate\Http\Request;
use PDF;

class AlunoController extends Controller
{
    public function index()
    {
        $dados = Aluno::All();

        return view('aluno.list', ['dados' => $dados]);
    }


    public function create()
    {
        //use App\Models\CategoriaAluno;
        $categorias = CategoriaAluno::orderBy('nome')->get();

        return view('aluno.form', ['categorias' => $categorias]);
    }

    private function validateRequest(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'cpf' => 'required',
            'categoria_id' => 'required',
            'imagem' => 'nullable|image|mimes:png,jpg,jpeg'
        ], [
            'nome.required' => 'O :attribute é obrigatório',
            'cpf.required' => 'O :attribute é obrigatório',
            'categoria_id.required' => 'O :attribute é obrigatório',
            'imagem.image' => 'O :attribute deve ser enviado',
            'imagem.mimes' => 'O :attribute deve ser das extensões:PNG,JPEG,JPG',
        ]);
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $this->validateRequest($request);
        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem) {
            $nome_imagem = date('YmdiHs') . "." . $imagem->getClientOriginalExtension();
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


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        // dd($dado);
        $dado = Aluno::findOrFail($id);
        $categorias = CategoriaAluno::orderBy('nome')->get();

        return view(
            'aluno.form',
            [
                'dado' => $dado,
                'categorias' => $categorias
            ]
        );
    }


    public function update(Request $request, string $id)
    {
        //dd($request->all());
        $this->validateRequest($request);
        $data = $request->all();
        $imagem = $request->file('imagem');

        if ($imagem) {
            $nome_imagem = date('YmdiHs') . "." . $imagem->getClientOriginalExtension();
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


    public function destroy(string $id)
    {
        $dado = Aluno::findOrFail($id);

        $dado->delete();

        return redirect('aluno');
    }

    public function search(Request $request)
    {
        if (!empty($request->valor)) {
            $dados = Aluno::where(
                $request->tipo,
                'like',
                "%$request->valor%"
            )->get();
        } else {
            $dados = Aluno::All();
        }

        return view('aluno.list', ["dados" => $dados]);
    }
    public function report()
    {

        //select * from Aluno order by nome
        //$dados = Aluno::All()
        $dados = Aluno::orderBy('nome')->get();
        //$dados = Aluno::where('nome', 'like', "a%")->get();

        $data = [
            'titulo' => 'Relatório Listagem de Alunos',
            'dados' =>  $dados,
        ];

        $pdf = PDF::loadView('aluno.report', $data);

        return $pdf->download('relatorio_listagem_alunos.pdf');
    }

    public function chart(AlunoQtdCursoChart $chart){

        return view('aluno.chart', ['chart' => $chart->build()]);
    }
}
