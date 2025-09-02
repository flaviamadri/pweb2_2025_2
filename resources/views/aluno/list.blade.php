@extends ('base')
@section('titulo', 'Formulário Aluno')
@section('conteudo')
    <h3 class='mt-5 mb-5'>Listagem de aluno</h3>
    <div class='row'>
        <div class='col'>
            <form action="{{ route('aluno.search') }}" method='post'>
                @csrf
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Tipo</label>
                        <select name="tipo" class='form-select'>
                            <option value="nome">Nome</option>
                            <option value="cpf">CPF</option>
                            <option value="telefone">Telefone</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Valor</label>
                        <input type="text" class="form-control" name="valor" placeholder='Pesquisar...'>
                    </div>
                        <div class='col-md-3'>
                             <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                    <div class="col-md-3">
                        <a class="btn btn-success" href="{{ url('/aluno/create') }}">Novo</a>
                     </div>
                </div>

            </form>


    </div>

    <div class='container'>

        <table class="table table-striped">
            <thead>
                <tr>
                    <td>#ID</td>
                    <td>Nome</td>
                    <td>CPF</td>
                    <td>Telefone</td>
                    <td>Ação</td>
                    <td>Ação</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($dados as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nome }}</td>
                        <td>{{ $item->cpf }}</td>
                        <td>{{ $item->telefone }}</td>
                        <td>Editar</td>
                        <td>
                            <form action="{{route('aluno.destroy',$item->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Deseja deletar o resgistro?')"> <i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    </body>

    </html>
