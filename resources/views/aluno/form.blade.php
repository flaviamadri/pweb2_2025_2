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

<form action="{{ $action }}" method='post'>
    @csrf

    @if(!empty($dado->id))
        @method('put')
    @endif

    <input type="hidden" name="id" value="{{ old('id', $dado->id ?? '')}}">
    <div class="row">
        <div class="col"><br>
            <label for="">Nome:</label>
            <input type="text" name="nome" value="{{old('nome',$dado->nome ?? '')}}">
        </div>
        <div class="col"><br>
            <label for="">CPF:</label>
        <input type="text" name="cpf" value="{{old('cpf',$dado->cpf ?? '')}}">
        </div>
        <div class="col"><br>
            <label for="">Telefone:</label>
            <input type="text" name="telefone" value="{{old('telefone',$dado->telefone ?? ''}}">
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
