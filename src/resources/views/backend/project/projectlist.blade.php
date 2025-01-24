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
            <h4>{{ __('messages.Projects') }}</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ __('messages.Projects') }}</li>
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

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif

        <div class="card-body">

            <table style="font-size: 14px;" class="table table-striped table-sm" id="ajax-crud-datatable">
                <thead>
                    <tr>
                        <th scope="col">{{ __('messages.Code') }}</th>
                        <th scope="col">{{ __('messages.Name') }}</th>
                        <th scope="col">{{ __('messages.Number') }}</th>
                        <th scope="col">{{ __('messages.Client') }}</th>
                        <th scope="col">{{ __('messages.Project Manager') }}</th>
                        <th scope="col">{{ __('messages.Trade') }}</th>
                        <th scope="col">{{ __('messages.Signature Date') }}</th>
                        <th scope="col">{{ __('messages.Start Date') }}</th>
                        <th scope="col">{{ __('messages.Finish Date') }}</th>
                        <th scope="col">{{ __('messages.Contract Value') }}</th>
                        <th scope="col">{{ __('messages.Address') }}</th>
                        <th>
                            <a class="btn btn-sm btn-primary" href="{{ url('project/create') }}">
                                <i class="fas fa-plus"></i>
                            </a>
                        </th>
                    </tr>
                </thead>
              </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

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
                    processing: false,
                    serverSide: true,
                    searching: true,
                    ajax: "{{ url('project/') }}",
                    columns: [
                        { data: 'code',             name: 'code',               orderable: true, width: "5%" },
                        { data: 'name',             name: 'name',               orderable: true, width: "10%" },
                        { data: 'contract_number',  name: 'contract_number',    orderable: true, width: "5%" },
                        { data: 'client_name',      name: 'client_name',        orderable: true, width: "15%" },
                        { data: 'project_manager',  name: 'project_manager',    orderable: true, width: "10%" },
                        { data: 'trade_name',       name: 'trade_name',         orderable: true, width: "10%" },
                        { data: 'signature_date',   name: 'signature_date',     orderable: true, width: "10%" },
                        { data: 'start_date',       name: 'start_date',         orderable: true, width: "5%" },
                        { data: 'finish_date',      name: 'finish_date',        orderable: true, width: "5%" },
                        { data: 'contract_value',   name: 'contract_value',     orderable: true, width: "5%" },
                        { data: 'address',          name: 'address',            orderable: true, width: "15%" },
                        { data: 'action',           name: 'action',             orderable: false, width: "5%" },
                    ],
                    dom: 'Bfrtip',
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
                        targets: [0],
                        visible: true
                    }],
                    // QUANTIDADE DE LINHAS NA PÁGINA
                    lengthMenu: [
                        [6, 8, 10, 25, 50, 100, -1],
                        ['6', '8', 10, '25', '50', '100', 'Todos']
                    ],
                    pageLength: '10',

                    // Traduzir Mostrar 10 registros (traduzir padrões de textos do datatable)
                    // language: {
                    //     url: "backend/{{ __('datatable-en') }}.json"

                    // },
                });

                hideLoading();

            });

        }

        // ********* SOFT DELETE **********
        function deleteReg(id) {

            Swal.fire({
                title: "{{ __('messages.Confirm record deletion') }}",
                text: "{{ __('messages.You wont be able to reverse this') }}!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "{{ __('messages.Yes delete') }}!"
                }).then((result) => {
                if (result.isConfirmed) {

                    document.form_data_delete.id.value = id;

                    var data = $('#form-data-delete').serialize();

                    $.ajax({
                        type: 'post',
                        url: "{{ 'project/softdelete' }}",
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                    });

                    Swal.fire({
                        title: "{{ __('messages.Deleted') }}!",
                        text: "{{ __('messages.Successfully deleted record') }}!",
                        icon: "success"
                    });

                    // REFRESH DATATABLE
                    setTimeout(function() {
                        loadDatatable();
                    }, 200);

                }
            });

        }


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
            $('#link-project').addClass('active');

        }, 100);


    </script>


  </div>


   <form name="form_data_delete" id="form-data-delete" method="POST">
       <input type="hidden" name="id" value="">
       @csrf
   </form>


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

        #ajax-crud-datatable td:nth-of-type(1), td:nth-of-type(2) {
            /* color: #007bff; */
            font-weight: bold;
            /* text-align: left; */
        }

    </style>


@endsection
