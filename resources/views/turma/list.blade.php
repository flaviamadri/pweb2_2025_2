@extends('base')
@section('titulo', 'Listagem de Turmas')
@section('conteudo')

    <h3>Listagem de Turmas - Curso {{ $curso->nome ?? '' }}</h3>

    <div class="row">
        <div class="col">
            <form action="{{ route('turma.search') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="nome">Nome</option>
                            <option value="cpf">CPF</option>
                            <option value="telefone">Telefone</option>
                        </select>

                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Valor</label>
                        <input type="text" class="form-control" name="valor" placeholder="Pesquisar...">
                    </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-magnifying-glass"></i> Buscar
                        </button>
                    </div>
                    <div class="col-md-3">
                        <a class="btn btn-success" href="{{ route('curso.turmas.create', $curso->id) }}"> <i
                                class="fa-solid fa-plus"></i>
                            Novo</a>
                    </div>
                    <div class="col-md-3">
                        <a class="btn btn-success" href="{{ route('curso.index') }}">
                            <i class="fa-solid fa-arrow-left"></i>
                            Voltar</a>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="row">

        <table class="table table-hover">
            <thead>
                <tr>
                    <td>#ID</td>
                    <td>Curso</td>
                    <td>Nome</td>
                    <td>Código</td>
                    <td>Data Início</td>
                    <td>Data Fim</td>
                    <td>Ação</td>
                    <td>Ação</td>
                    <td>Ação</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($dados as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->curso->nome }}</td>
                        <td>{{ $item->nome }}</td>
                        <td>{{ $item->codigo }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->data_inicio)) }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->data_fim)) }}</td>

                        <td>
                            <a href="{{ route('turma.edit', $item->id) }}" class="btn btn-outline-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('turma.destroy', $item->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('Deseja Remover o registro?')"> <i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop
