@extends ('base')
@section('titulo', 'Formulário Aluno')
@section ('conteudo')

@php
    if(!empty($dado->id)){
        $action = route('aluno.update', $dado->id);
    } else {
        $action = route('aluno.store');
    }
@endphp

<form action="{{ $action }}" method='post' enctype="multipart/form-data">
    @csrf

    @if(!empty($dado->id))
        @method('put')
    @endif

    <input type="hidden" name="id" value="{{ old('id', $dado->id ?? '')}}">
    <div class="row">
        <div class="col"><br>
            <label for="">Nome:</label>
            <input class= "form-control" type="text" name="nome" value="{{old('nome',$dado->nome ?? '')}}">
        </div>
        <div class="col"><br>
            <label for="">CPF:</label>
        <input  class= "form-control" type="text" name="cpf" value="{{old('cpf',$dado->cpf ?? '')}}">
        </div>
        <div class="col"><br>
            <label for="">Telefone:</label>
            <input class= "form-control" type="text" name="telefone" value="{{old('telefone',$dado->telefone ?? '')}}">
        </div>

        <div class="col">
            <label for="">Categoria</label>
            <select class="form-select" name="categoria_id">
                @foreach ($categorias as $item)
                      <option value="{{$item->id}}"
                        {{old('categoria_id',$dado->categoria_id ?? '')
                        == $item->id ?  'selected' : ''}}>
                        {{$item->nome}}
                      </option>
                @endforeach
            </select>
        </div>

        @php
            $nome_imagem = !empty($dado->imagem) ? $dado->imagem :'sem_imagem.png';
        @endphp

        <div class="col"><br>
            <label for="">Imagem:</label>
            <img src="/storage/{{$nome_imagem}}" width="200px" height="200px" alt="img">
            <input class= "form-control" type="file" name="imagem" value="{{old('imagem',$dado->imagem ?? '')}}">
        </div>
    </div>
    <div class="row">
        <div class="col"><br>
            <button type="submit" class="btn btn-success">{{ !empty($dado->id) ? 'Atualizar' : 'Salvar'}}</button>
            <a type="submit" class="btn btn-success" href="{{ url ('aluno') }}">Voltar</a>
        </div>
    </div>
</form>
@stop
