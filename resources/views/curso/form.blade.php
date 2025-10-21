@extends('base')
@section('titulo', 'Formulário Curso')
@section('conteudo')

    @php
        if (!empty($dado->id)) {
            $action = route('curso.update', $dado->id);
        } else {
            $action = route('curso.store');
        }
    @endphp

    <h3>Formulário Curso</h3>

    <form action="{{ $action }}" method="post" enctype="multipart/form-data">
        @csrf

        @if (!empty($dado->id))
            @method('put')
        @endif

        <input type="hidden" name="id" value="{{ old('id', $dado->id ?? '') }}">

        <div class="row">
            <div class="col">
                <label for="">Nome</label>
                <input type="text" name="nome" value="{{ old('nome', $dado->nome ?? '') }}">
            </div>
            <div class="col">
                <label for="">Requisito</label>
                <input type="text" name="requisito" value="{{ old('requisito', $dado->requisito ?? '') }}">
            </div>
            <div class="col">
                <label for="">Carga Horária</label>
                <input type="text" name="carga_horaria" value="{{ old('carga_horaria', $dado->carga_horaria ?? '') }}">
            </div>
            <div class="col">
                <label for="">Valor</label>
                <input type="text" name="valor" value="{{ old('valor', $dado->valor ?? '') }}">
            </div>
        </div>

        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success">{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}</button>
                <a href="{{ url('curso') }}" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
@stop
