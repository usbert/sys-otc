<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<div class="container">

    <div class="row">

        <h3>Listagem de Chamados</h3>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Assunto</th>
                    <th scope="col">Descrição</th>
                    <th colspan="3">
                        <button class="btn btn-sm btn-primary" style="width: 100%; align: right" onclick="location.href='{{ route('supports.create') }}'">Novo Chamado</button>
                    </th>
                </tr>
            </thead>
            <tbody>

                 @foreach($supports as $support)

                    <tr>
                        <td scope="row">{{ $support->id }}</td>
                        <td>{{ $support->subject }}</td>
                        <td>{{ $support->body }}</td>
                        <td>
                            <a href="{{ route('supports.show', $support->id ) }}" style="color:green">
                                <span class="glyphicon glyphicon-eye-open"></span>
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('supports.edit', $support->id ) }}" style="color:blue">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>
                        </td>
                    </tr>

                 @endforeach

           </tbody>

        </table>

    </div>

</div>

