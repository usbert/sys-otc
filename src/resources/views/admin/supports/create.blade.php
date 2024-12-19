<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>


    <div class="container">
        <h3>Novo Chamado</h3>

        @if($errors->any())
            @foreach ( $errors->all() as $error )
                {{ $error }}
            @endforeach

        @endif

        <div id="message" class="primary"></div>

        {{-- <form action="{{ route('supports.store') }}" method="post"> --}}
            <form action="{{url('ajaxupload')}}" method="post" id="addpost">
            @csrf
            <div class="card">

                <div class="row padding-5">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="subject" value="{{ old('subjetc') }}" placeholder="name@example.com">
                        <label for="floatingInput">Assunto</label>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Descrição do assunto" rows="50" name="body"></textarea>
                        <label for="floatingTextarea">Descrição</label>
                    </div>

                    <div class="md-10">
                        <br/>
                        <a class="btn btn-sm btn-primary" onclick="location.href='{{ route('supports.index') }}'">Voltar</a>
                        <button type="submit" class="btn btn-sm align-left btn-primary"><i class='fa fa-save'> </i> Salvar</button>
                    </div>

                </div>

            </div>


        </form>

    </div>


</body>
</html>




<script type="text/Javascript">
    $(document).ready(function() {
        $('#addpost').on('submit', function(event) {

            event.preventDefault();

            jQuery.ajax({
                url: "{{ route('supports.store') }}",
                data: jQuery('#addpost').serialize(),
                type: 'post',
                success: function (result) {

                    $('message').css('display', 'block');
                    jQuery('#message').html(result.message);

                    jQuery('#addpost')[0].reset();


                }
            });

        })
    })
</script>
