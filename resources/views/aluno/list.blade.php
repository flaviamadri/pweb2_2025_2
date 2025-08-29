<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Olá mundo Laravel</h1>
    <p>Vou ficar fera na programação</p>

    <table>
        <thead>
        <tr>
            <td>#ID</td>            
            <td>Nome</td>            
            <td>CPF</td>
            <td>Telefone</td>
        </tr>
        </thead>
        <tbody>
            @foreach ($dados as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->nome}}</td>
                <td>{{$item->cpf}}</td>
                <td>{{$item->telefone}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>