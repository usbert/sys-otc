@extends('backend.layouts.master')

@section('section')

@include('backend.includes.datatables')

<section id="loading">
    <div id="loading-content"></div>
</section>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>{{ __('messages.Type Documents') }}</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ __('messages.Type Documents') }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        {{-- <div class="card-header">
          <h3 class="card-title">List of all Famílies</h3>
          <div class="card-tools">
        </div> --}}

        {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif --}}

        <div class="card-body">

            {{-- @forelse ($supervisor as $row)

                {{ $row->name }}

            @empty

            @endforelse --}}


              <table style="font-size: 14px;" class="table table-striped table-sm" id="ajax-crud-datatable">
                <thead>
                    <tr>
                        <th scope="col">{{ __('messages.Description') }}</th>
                        <th scope="col">{{ __('messages.Code') }}</th>
                        <th>
                            <button class="btn btn-sm btn-primary" onClick="add()">
                                <i class="fas fa-plus"></i>
                                {{-- {{ __('messages.Button.Add New') }} --}}
                            </button>
                        </th>
                    </tr>
                </thead>
              </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->



        <!-- Modal -->
        <div class="modal fade" id="form-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" enctype="multipart/form-data">

            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header" style="background-color: #337ab7; color: #fff; text-align: center; padding: 6px;">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('messages.Button.Add New') }}</h5>
                        {{-- <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>

                    <form class="mt-3" id="form-data" class="form-horizontal" method="POST">

                       <div class="modal-body">

                            @csrf

                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">{{ __('messages.Description') }}</label>
                                <input type="text" class="form-control" name="name" id="name" value="" placeholder="{{ __('messages.Text.Enter The Description') }}">
                            </div>
                            <div class="mb-2">
                                <label for="recipient-name" class="col-form-label">{{ __('messages.Code') }}</label>
                                <input type="text" class="form-control" name="code" id="code" value="" maxlength="4">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" onclick="closeModal()">{{ __('messages.Button.Close') }}</button>
                            <button type="submit" class="btn btn-sm btn-primary submit-form" id="create_new">{{ __('messages.Button.Save') }}</button>
                        </div>

                    </form>


                </div>
            </div>
        </div>

        <form name="form_data_delete" id="form-data-delete" method="POST">
            <input type="hidden" name="id" value="">
            @csrf

        </form>


    </section>
    <!-- /.content -->


    <script type="text/javascript">

        // ********* READ **********

        function loadDatatable() {

            $(document).ready( function () {

                // LIMPAR TUDO ANTES DE CRIAR NOVA DATATABLE
                $('#ajax-crud-datatable').DataTable().clear().destroy();

                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                });

                $('#ajax-crud-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: true,
                    ajax: "{{ url('type-document/') }}",
                    columns: [
                        { data: 'name',   name: 'name', width: '65%', orderable: true },
                        { data: 'code',   name: 'code', width: '25%', orderable: true },
                        { data: 'action', name: 'action', width: '10%', orderable: false },

                    ],
                    dom: 'Bfrtip',
                    retrieve: true,
                    buttons: [
                        {
                            extend: 'pageLength',
                            className: 'btn btn-primary btn-sm'
                        },

                        {
                            extend:    'copyHtml5',
                            text:      '<i class="fas fa-copy" style="font-size: 24px;"></i>',
                            titleAttr: "{{ __('Copy') }}"
                        },
                        {
                            extend:    'excelHtml5',
                            text:      '<i class="fas fa-file-excel" style="font-size: 24px;"></i>',
                            titleAttr: 'Excel'
                        },
                        {
                            extend:    'csvHtml5',
                            text:      '<i class="fas fa-file-csv" style="font-size: 24px;"></i>',
                            titleAttr: 'CSV'
                        },
                        {
                            extend:    'pdfHtml5',
                            text:      '<i class="fas fa-file-pdf" style="font-size: 24px;"></i>',
                            titleAttr: 'PDF'
                        },
                        {
                            "extend": "print",
                            'text':      '<i class="fas fa-print" style="font-size: 24px;"></i>',
                            titleAttr: "{{ __('Print') }}"
                        }
                    ],
                    order: [[0, 'asc']],

                    // DEFINIR SE COLUNA Descrição É VISIVEL (true ou false)
                    columnDefs: [{
                        targets: [1],
                        visible: true
                    }],
                    // QUANTIDADE DE LINHAS NA PÁGINA
                    lengthMenu: [
                        [6, 8, 25, 50, 100, -1],
                        ['6', '8', '25', '50', '100', 'Todos']
                    ],
                    pageLength: '8',

                    language: {
                    url: "backend/{{ __('datatable-en') }}.json"

                    }


                });

                hideLoading();

            });

        }


        // ********* OPEN ADD MODAL **********
        function add() {
            $('#formModal').trigger('reset');
           // $('#form-modal').html('Adicionar');
            $('#form-modal').modal('show');
            $('#id').val('');
        }

        // ********* OPEN ADD MODAL **********

        function showModalEdit(id) {

            $(document).ready(function() {

                console.log('id: '+id);

                $.ajax({
                    type: "get",
                    url: "{{ 'type-document/edit' }}",
                    data: {
                        'form-data': true,
                        id: id
                    },
                    dataType: 'Json',
                    success: function (res) {

                        console.log(res);

                        $('#form-modal').modal('show');
                        // $('#id').res(id);
                        // $('#name').val(res.name);
                        // $('#code').res(res.code);
                    }

                });


            });




            // $(document).ready(function(){

            //     $(document).ready(function (res) {
            //     // $('a').on('click', function(req, res){

            //         console.log('id: '+id);

            //         $.ajax({
            //             type: "get",
            //             url: "{{ 'type-document/edit' }}",
            //             data: {
            //                 'form-data': true,
            //                 id: id
            //             },
            //             dataType: 'Json',
            //             success: function (res) {

            //                 console.log(res);

            //                 $('#form-modal').modal('show');
            //                 $('#id').res(id);
            //                 // $('#name').val(res.name);
            //                 // $('#code').res(res.code);
            //             }

            //         })

            //     });

            // })

        }


        // ********* OPEN MODAL **********
        // function modalEdit() {
        //     $('#formModal').trigger('reset');
        //    // $('#form-modal').html('Adicionar');
        //     $('#form-modal').modal('show');
        //     $('#id').val('');
        // }

        function closeModal() {
            $('#form-modal').modal('hide');
        }


        // ********* SAVING FORM **********
        $(".submit-form").click(function(e) {

            e.preventDefault();
            var data = $('#form-data').serialize();

            $.ajax({
                type: 'post',
                ajax: "{{ url('type-document/') }}",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // beforeSend: function(){
                //     console.log('....Please wait');
                // },
                success: function(response){

                    // SWEETALERT COM MENSAGEM
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        title: "Cadastrado com sucesso!",
                        showConfirmButton: true,
                        timer: 3500
                    });

                },
                complete: function(response){
                    console.log('Created New');
                },
                error: function(errors) {

                    console.log(errors.responseJSON.errors);

                    var error_name = errors.responseJSON.errors.name;
                    var error_code = errors.responseJSON.errors.code;
                    if(error_name) {
                        error_text = error_name;
                    } else if(error_code) {
                        error_text = error_code;
                    }

                    Swal.fire({
                        position: "center",
                        icon: "warning",
                        title: error_text,
                        showConfirmButton: true,
                      //  timer: 3500
                    });
                }

             });

            // CLOSE MODAL
            closeModal();

            // REFRESH DATATABLE
            setTimeout(function() {
               loadDatatable();
            }, 200);

        });



        // ********* SOFT DELETE **********
        function deleteReg(id) {

            Swal.fire({
                title: "Confirma exclusão?",
                text: "Você não poderá reverter isso!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sim, excluir!"
                }).then((result) => {
                if (result.isConfirmed) {

                    document.form_data_delete.id.value = id;

                    var data = $('#form-data-delete').serialize();

                    $.ajax({
                        type: 'post',
                        url: "{{ 'type-document/softdelete/' }}",
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },


                    });

                    Swal.fire({
                    title: "Excluído!",
                    text: "O registro foi excluído",
                    icon: "success"
                    });

                    // REFRESH DATATABLE
                    setTimeout(function() {
                        loadDatatable();
                    }, 200);

                }
            });

        }

    </script>


  </div>

<script>

    function showLoading() {
        document.querySelector('#loading').classList.add('loading');
        document.querySelector('#loading-content').classList.add('loading-content');
    }

    function hideLoading() {
        document.querySelector('#loading').classList.remove('loading');
        document.querySelector('#loading-content').classList.remove('loading-content');
    }

    showLoading();

    setTimeout(function() {

        loadDatatable();

        // MARCAR O LINK NO SIDEBAR
        $('#link31').addClass('active');

    }, 100);


</script>

<style>

    .swal2-popup {
        font-size: 0.70rem !important;
        font-family: inherit;
    }

    .loading {
        z-index: 20;
        position: absolute;
        top: 0;
        left:-5px;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.4);
    }
    .loading-content {
        position: absolute;
        border: 16px solid #f3f3f3; /* Light grey */
        border-top: 16px solid #3498db; /* Blue */
        border-radius: 50%;
        width: 50px;
        height: 50px;
        top: 40%;
        left:35%;
        animation: spin 2s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .content-header {
        padding: 0%;
    }

</style>

@endsection
