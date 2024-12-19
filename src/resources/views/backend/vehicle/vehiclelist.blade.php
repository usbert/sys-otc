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
           <h4>{{ __('messages.Equipments') }}</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ __('messages.Equipments') }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">

        <div class="card-body">

            <table style="font-size: 14px;" class="table table-striped table-sm" id="ajax-crud-datatable">
                <thead>
                    <tr>
                        <th scope="col">{{ __('messages.Prefix.Prefix') }}</th>
                        <th scope="col">{{ __('messages.Prefix.Prefix') }}</th>
                        <th scope="col">{{ __('messages.Description') }}</th>
                        <th scope="col">{{ __('messages.EquipmentFamily.Family') }}</th>
                        <th scope="col">{{ __('messages.Brand') }}</th>
                        <th scope="col">{{ __('messages.Equipment.Tag') }}</th>
                        <th scope="col">{{ __('messages.Equipment.Vin Number') }}</th>
                        <th scope="col">Und</th>
                        <th scope="col">{{ __('messages.Project') }}</th>
                        <th scope="col">{{ __('messages.Status') }}</th>
                        <th>
                            <a class="btn btn-sm btn-primary" href="{{ url('vehicle/create') }}">
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

        $(document).ready( function () {

            // $.noConflict();

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            });

            $('#ajax-crud-datatable').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ajax: "{{ url('vehicle/') }}",
                columns: [
                    { data: 'prefix', name: 'prefix', orderable: true },
                    { data: 'model_name', name: 'model_name', orderable: true },
                    { data: 'model_description', name: 'model_description', orderable: true },
                    { data: 'family_name', name: 'family_name', orderable: true },
                    { data: 'brand_name', name: 'brand_name', orderable: true },
                    { data: 'tag', name: 'tag', orderable: true },
                    { data: 'vin_number', name: 'vin_number', orderable: true },
                    { data: 'unit_measure', name: 'unit_measure', orderable: true },
                    { data: 'project_short_name', name: 'project_short_name', orderable: true },
                    { data: 'status_name', name: 'status_name', orderable: true },
                    { data: 'action', name: 'action', orderable: false },
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
                    width: '5%',
                    targets: [0],
                    visible: true
                }],
                // QUANTIDADE DE LINHAS NA PÁGINA
                lengthMenu: [
                    [6, 8, 10, 25, 50, 100, -1],
                    ['6', '8', 10, '25', '50', '100', 'Todos']
                ],
                pageLength: '10',

                language: {
                    url: "backend/{{ __('datatable-en') }}.json"
                }


            });

            hideLoading();

        });

    </script>


  </div>

<style>

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

</script>


@endsection
