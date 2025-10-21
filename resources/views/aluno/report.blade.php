<!DOCTYPE html>

<html>

<head>

    <title>Hi</title>

</head>

<body>

    <h1>{{ $titulo }}</h1>

    <table>
        <thead>
            <tr>
                <td>Imagem</td>
                <td>#ID</td>
                <td>Nome</td>
                <td>CPF</td>
                <td>Telefone</td>
                <td>Categoria</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($dados as $item)
                @php
                    $nome_imagem = !empty($item->imagem) ? $item->imagem : 'sem_imagem.png';
                    //ou public_path('storage/' . $nome_imagem);
                    $imagemPath = storage_path('app/public/' . $nome_imagem);
                @endphp
                <tr>
                    <td><img src="{{ $imagemPath }}" width="100px" height="100px" alt="img"></td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nome }}</td>
                    <td>{{ $item->cpf }}</td>
                    <td>{{ $item->telefone }}</td>
                    <td>{{ $item->categoria->nome }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
