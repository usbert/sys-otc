<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<div class="container">

    <h3>Chamado {{ $support->id }}</h3>

    <b>Assunto:</b><br/>
    {{ $support->subject }}
    <br/><br/>

    <b>Descrição:</b><br/>
    {{ $support->body }}

    <br/><br/>

    <form action="{{ route('supports.destroy', $support->id ) }}" method="post">
        @csrf
        @method('DELETE')
        <a class="btn btn-sm btn-primary" onclick="location.href='{{ route('supports.index') }}'">Voltar</a>
        <button type="submit" class="btn btn-sm btn-primary">Deletar</button>
    </form>

</div>

