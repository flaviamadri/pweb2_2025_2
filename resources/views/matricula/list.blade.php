@extends('base')
@section('titulo', 'Listagem de Matricula')
@section('conteudo')

    <h3>Listagem de Matriculas</h3>

    <div class="row">
        <div class="col">
            <form action="{{ route('matricula.search') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class="form-select">
                            <option value="curso">Curso</option>
                            <option value="turma">Turma</option>
                            <option value="aluno">Aluno</option>
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
                        <a class="btn btn-success" href="{{ route('matricula.create') }}"> <i
                                class="fa-solid fa-plus"></i>
                            Novo</a>
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
                    <td>Turma</td>
                    <td>Aluno</td>
                    <td>Data Matricula</td>
                    <td>Ação</td>
                    <td>Ação</td>
                    <td>Ação</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($dados as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->curso->nome ?? '' }}</td>
                        <td>{{ $item->turma->nome ?? '' }}</td>
                        <td>{{ $item->aluno->nome ?? '' }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->data_matricula)) }}</td>

                        <td>
                            <a href="{{ route('matricula.edit', $item->id) }}" class="btn btn-outline-warning">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('matricula.destroy', $item->id) }}" method="post">
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
