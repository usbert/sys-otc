
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<div class="container">

    <div class="row">

        <h3>Editar Chamado {{ $support->id }}</h3>

        <form action="{{ route('supports.update', $support->id ) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card">

                <div class="row padding-5">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="subject" value="{{ $support->subject }}" placeholder="name@example.com">
                        <label for="floatingInput">Assunto</label>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Descrição do assunto" rows="50" name="body">{{ $support->body }}</textarea>
                        <label for="floatingTextarea">Descrição</label>
                    </div>

                    <div class="md-10">
                        <br/>
                        <a class="btn btn-sm btn-primary" onclick="location.href='{{ route('supports.index') }}'">Voltar</a>
                        <button type="submit" class="btn btn-sm align-left btn-primary">Salvar</button>
                    </div>

                </div>

            </div>


        </form>

    </div>

</div>

