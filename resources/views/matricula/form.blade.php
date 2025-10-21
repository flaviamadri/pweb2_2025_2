@extends('base')
@section('titulo', 'Formulário Matricula')
@section('conteudo')

    @php
        if (!empty($dado->id)) {
            $action = route('matricula.update', $dado->id);

            $data_matricula = date('d/m/Y', strtotime($dado->data_matricula));
        } else {
            $action = route('matricula.store');
        }
    @endphp

    <h3>Formulário de Matricula</h3>

    <form action="{{ $action }}" method="post" enctype="multipart/form-data">
        @csrf

        @if (!empty($dado->id))
            @method('put')
        @endif

        <input type="hidden" name="id" value="{{ old('id', $dado->id ?? '') }}">

        @if (!empty($cursos))

            <div class="col">
                <label for="">Curso</label>
                <select name="curso_id">
                    @foreach ($cursos as $item)
                        <option value="{{ $item->id }}"
                            {{ old('curso_id', $dado->curso_id ?? '') == $item->id ? 'selected' : '' }}>
                            {{ $item->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
        @else
            <div class="col">
                <input type="hidden" name="curso_id" value="{{ old('curso_id', $curso->id) }}">
                <h5>Curso: {{ $curso->nome }}</h5>
            </div>

        @endif


        @if (!empty($turmas))

            <div class="col">
                <label for="">Turma</label>
                <select name="turma_id">
                    @foreach ($turmas as $item)
                        <option value="{{ $item->id }}"
                            {{ old('turma_id', $dado->turma_id ?? '') == $item->id ? 'selected' : '' }}>
                            {{ $item->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
        @else
            <div class="col">
                <input type="hidden" name="turma_id" value="{{ old('turma_id', $turma->id) }}">
                <h5>Turma: {{ $turma->nome }}</h5>
            </div>

        @endif

        @if (!empty($alunos))

            <div class="col">
                <label for="">Aluno</label>
                <select name="aluno_id">
                    @foreach ($alunos as $item)
                        <option value="{{ $item->id }}"
                            {{ old('aluno_id', $dado->aluno_id ?? '') == $item->id ? 'selected' : '' }}>
                            {{ $item->nome }}
                        </option>
                    @endforeach
                </select>
            </div>
        @else
            <div class="col">
                <input type="hidden" name="aluno_id" value="{{ old('aluno_id', $aluno->id) }}">
                <h5>Aluno: {{ $aluno->nome }}</h5>
            </div>

        @endif

        <div class="row">
            <div class="col">
                <label for="">Data Matricula</label>
                <input type="date" name="data_matricula" value="{{ old('data_matricula', $data_matricula ?? '') }}">
            </div>

        </div>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-success">{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}</button>
                <a href="{{ url('matricula') }}" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
@stop
