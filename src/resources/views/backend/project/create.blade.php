@extends('backend.layouts.master')

@section('section')

@include('backend.includes.datatables')

@php
    $decimal_local = Config::get('app.locale');
@endphp

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>{{ __('messages.Button.Add New')}} {{ __('messages.Project')}}</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('project-list') }}">{{ __('messages.Projects') }}</a></li>
              <li class="breadcrumb-item active">{{ __('messages.Button.Add New')}} {{ __('messages.Project')}}</li>
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

                <div class="row">

                    <div class="col-sm-12">

                        <form id="form-data" class="form-horizontal" method="POST">

                            @csrf

                            <div class="form-grou1p">

                                <div class="row">

                                    <div class="col-sm-12">

                                        <div class="card card-secondary">

                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('messages.Description')}} </h3>
                                            </div>

                                            <div class="card-body">

                                                <input type="hidden" name="id" id="id">

                                                <div class="row">

                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Code')}}</label>
                                                            <input type="text" name="code" id="code" class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Project Name')}}</label>
                                                            <input type="text" name="name" id="name" class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Number')}}</label>
                                                            <input type="text" name="contract_number" id="contract_number" class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">


                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Client') }}</label>
                                                            <select class="form-control form-control-sm" name="client_id" id="client_id">
                                                                <option value="">-- {{__('messages.Select')}} --</option>
                                                                @foreach ($result['clientCombo'] as $cli)
                                                                    <option value="{{ $cli->id }}"> {{ $cli->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Project Manager')}}</label>
                                                            <input type="text" name="project_manager" id="project_manager" class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Trade') }}</label>
                                                            <select class="form-control form-control-sm" name="trade_id" id="trade_id">
                                                                <option value="">-- {{__('messages.Select')}} --</option>
                                                                @foreach ($result['tradeCombo'] as $tra)
                                                                    <option value="{{ $tra->id }}"> {{ $tra->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Signature Date')}}</label>
                                                            <input type="date" name="signature_date" id="signature_date" class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Start Date')}}</label>
                                                            <input type="date" name="start_date" id="start_date" class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Finish Date')}}</label>
                                                            <input type="date" name="finish_date" id="finish_date" class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Contract Value')}}</label>
                                                            <input type="text" name="contract_value" id="contract_value" class="form-control form-control-sm"
                                                              {{-- @if("{{ Config::get('app.locale') }}" == 'pt_BR')
                                                                { --}}
                                                                onkeypress="return fc_decimal(this,'.',',',event, 10);"
                                                                {{-- }
                                                                @else {
                                                                    onkeypress="return fc_formatar_moeda(this,',','.',event, 7);"
                                                                }
                                                                @endif --}}
                                                            >
                                                        </div>
                                                    </div>




                                                </div>

                                            </div>

                                        </div>

                                    </div>


                                </div>


                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card card-secondary">
                                            <div class="card-header">
                                                <h3 class="card-title">{{__('messages.Address')}}</h3>
                                            </div>
                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Address')}}</label>
                                                            <input type="text" name="address" id="address" class="form-control form-control-sm" maxlength="80">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.City')}}</label>
                                                            <input type="text" name="city" id="city" class="form-control form-control-sm" maxlength="50">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.State')}}</label>
                                                            <input type="text" name="state" id="state" class="form-control form-control-sm" maxlength="50">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Country')}}</label>
                                                            <input type="text" name="country" id="country" class="form-control form-control-sm" maxlength="50">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Zip Code')}}</label>
                                                            <input type="text" name="zip_code" id="zip_code" class="form-control form-control-sm" maxlength="20"
                                                            onkeypress="return isNumberKey(event)"
                                                            >
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </form>

                        {{-- DATATABLE ARQUIVOS --}}

                        <div class="row">

                            <div class="col-sm-12">

                                <div class="panel-body">
                                    <div class="card card-secondary">
                                        <div class="card-header">
                                            <h3 class="card-title">{{ __('messages.Document Attachment') }}</h3>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="tab-content">
                                                    <table style="font-size: 14px; width: 98%" class="table table-striped table-sm" id="ajax-datatable-files">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">{{ __('messages.Type Documents') }}</th>
                                                                <th scope="col">{{ __('messages.File Name') }}</th>
                                                                <th scope="col">{{ __('messages.Description') }}</th>
                                                                <th scope="col">
                                                                    <button type="button" class="btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#myModalAttach" onclick="openModalAttach()">
                                                                        <i class="fa fa-paperclip"></i>&nbsp;
                                                                        {{-- {{ __('messages.Attach document') }} --}}
                                                                    </button>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>


                    </div>

                </div>

            </div>

      </div>


        <!-- Modal -->
        <div class="modal fade" id="myModalAttach" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalAttachLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header" style="background-color: #6c757d; color: white;">
                    <h5 class="modal-title" id="myModalAttachLabel">{{ __('messages.Document Attachment')}}</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModalAttach()"></button> --}}
                </div>
                <div class="modal-body">

                    {{-- start form modal --}}
                    <form action="{{ url('file/store/') }}" id="image-form" class="form-horizontal" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-grou1p">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card-secondary">
                                        <div class="card-body">

                                            <input type="hidden" name="vehicle_id" id="vehicle_id">

                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>{{ __('messages.Type Document') }}</label>
                                                        <select class="form-control form-control-sm" name="type_document_id" id="type_document_id">
                                                            <option value="">-- {{__('messages.Select')}} --</option>
                                                            @foreach ($result['typeDocumentCombo'] as $typedoc)
                                                                <option value="{{ $typedoc->id }}"> {{ $typedoc->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>{{__('messages.Description')}}</label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="comment" id="comment" class="form-control form-control-sm" value=''>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="file" name="image" id="original_name" class="form-control form-control-sm">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- end form modal --}}

                </div>

                <div id="divErrorModal" class="alert alert-danger"
                    style="padding: 5px; margin: 10px; opacity: 0.8; text-align: center;">
                    <span id="messageModal"></span>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" onclick="closeModalAttach()">
                        <i class="fa fa-close"></i>&nbsp;
                        {{ __('messages.Button.Close') }}
                    </button>
                    <button class="btn btn-sm btn-primary float-end" id="image-upload">
                        {{ __('messages.Attach') }}
                    </button>
                </div>
                </div>
            </div>
        </div>


        <form name="form_data_delete" id="form-data-delete" method="POST">
            <input type="hidden" name="id" value="">
            @csrf
       </form>


    </section>
    <!-- /.content -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

        // Search equipment data by id
        function fcSerchPrefix() {

            if(document.getElementById("prefix").value == '' && document.getElementById("vin_number").value == '') {
                alertSwal("{{__('messages.Enter the prefix or Serial/Chassis')}}!", 3500, 'warning');
                $('#form-data')[0].reset();
                return false;
            }

            if(!document.getElementById("prefix").value == '') {
                var prefix = document.getElementById("prefix").value;
            } else {
                var prefix = 'prefix';
            }
            if(!document.getElementById("vin_number").value == '') {
                var vin_number = document.getElementById("vin_number").value;
            } else {
                var vin_number = 'vin_number';
            }

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            });

            $.ajax({

                // Passar Status = 2 (desmobilizado)

                url: '/vehicle/get-equipment/2/'+prefix+'/'+vin_number,
                type: 'GET',
                dataType: 'json',
                success: function(response) {

                    if(response.vehicles[0] == undefined) {

                        alertSwal("{{__('messages.Not Found')}}!", 3500, 'warning');
                        $('#form-data')[0].reset();

                        return false;
                    }

                   document.getElementById("id").value              =  response.vehicles[0]['id'];
                //    document.getElementById("has_km").value          =  response.vehicles[0]['has_km'];
                //    document.getElementById("has_h").value           =  response.vehicles[0]['has_h'];
                   document.getElementById("prefix").value          =  response.vehicles[0]['prefix'];
                   document.getElementById("vin_number").value      =  response.vehicles[0]['vin_number'];
                   document.getElementById("description").value     =  response.vehicles[0]['model_description'];
                   document.getElementById("brand").value           =  response.vehicles[0]['brand_name'];
                   document.getElementById("model").value           =  response.vehicles[0]['model_name'];
                   document.getElementById("projectId").value       =  response.vehicles[0]['project_id'];
                   document.getElementById("project").value         =  response.vehicles[0]['project_short_name'];
                   document.getElementById("tag").value             =  response.vehicles[0]['tag'];
                   document.getElementById("renavam").value         =  response.vehicles[0]['renavam'];
                   document.getElementById("supplyer").value        =  response.vehicles[0]['supplyer_name'];
                   document.getElementById("unit_measure").value    =  response.vehicles[0]['unit_measure'];
                   document.getElementById("status").value          =  response.vehicles[0]['status_name'];

                   if(document.getElementById("has_km").value == 1) {
                        document.getElementById("div_km_control").style.display = "";
                   } else if(document.getElementById("has_km").value == 0) {
                        document.getElementById("div_km_control").style.display = "none";
                   }

                   if(document.getElementById("has_h").value == 1) {
                        document.getElementById("div_hour_control").style.display = "";
                   } else if(document.getElementById("has_h").value == 0) {
                        document.getElementById("div_hour_control").style.display = "none";
                   }


                   // CARREGAR O HISTÓRICO DE MOBILIZAÇÃO
                   loadMobilizationHistoric(response.vehicles[0]['id']);
                   loadFiles(response.vehicles[0]['id']);

                   document.getElementById("btnDesmob").style.display = "";


                   setTimeout(function() {

                        // Abrir div incluir Km ou incluir Horímetro
                        checkIncludeMiles();

                        if(response.vehicles[0]['unit_measure'] == 'Km') {
                            if(response.vehicles[0]['has_h'] == 1) {
                                // Marcar se for Km e incluir horímetro do banco = 1
                                document.getElementById("has_h").checked = true;
                                // Abrir o campo de valor para Horímetro
                                document.getElementById("div_hour_control").style.display = "";
                            } else {
                                document.getElementById("div_hour_control").style.display = "none";
                            }
                        } else  if(response.vehicles[0]['unit_measure'] == 'H') {
                            if(response.vehicles[0]['has_km'] == 1) {
                                // Marcar se for H e incluir Km do banco = 1
                                document.getElementById("has_km").checked = true;
                                // Abrir o campo de valor para Km
                                document.getElementById("div_km_control").style.display = "";
                            } else {
                                document.getElementById("div_km_control").style.display = "none";
                            }
                        }

                   }, 120);


                   return false;

                },
                error: function(xhr, status, error) {

                    console.error(error);
                    document.getElementById("btnDesmob").style.display = "none";
                }
            });

        }

        // Load list files uploaded
        function loadFiles(id) {

            $(document).ready( function () {

                // LIMPAR TUDO ANTES DE CRIAR NOVA DATATABLE
                $('#ajax-datatable-files').DataTable().clear().destroy();

                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                });

                $('#ajax-datatable-files').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false,
                    ajax: "{{ url('vehicle/get-file/') }}/"+id,
                    columns: [
                        { data: 'type_name',            name: 'type_name',      orderable: false, width: '20%' },
                        { data: 'original_name',        name: 'original_name',  orderable: false, width: '45%' },
                        { data: 'comment',              name: 'comment',        orderable: false, width: '25%' },
                        { data: 'action',               name: 'action',         orderable: false, width: '10%', className: "text-right" },
                    ],
                    // dom: 'Bfrtip',
                    order: [[1, 'asc']],
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
                    pageLength: '6',
                });


            });

            // Retirar opção combobox com quantidades de linhas na grid
            setTimeout(function() {
                document.getElementById("ajax-datatable-files_length").style.display = "none";
            }, 150);


        }


        // File upload
        $("#image-upload").click(function (e) {

            e.preventDefault();

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            });

            const form = document.getElementById('image-form');

            var productImage = $("#original_name").prop("files")[0];
            const dados = new FormData(form);

            if (typeof(productImage) != 'undefined' && productImage != null) {
                dados.append("original_name", productImage['name']);
                dados.append("image", productImage);
            }

            $.ajax({
                type: "post",
                url: "{{ url('file/store/') }}",
                data: dados,
                // image: productImage,
                processData: false,
                contentType: false,
                success: function(response){
                    console.log('SUCESSO', response);
                    var vehicle_id = document.getElementById("id").value;
                    closeModalAttach();
                    loadFiles(vehicle_id);
                },
                error: function(errors) {

                    if(errors.responseJSON.errors.type_document_id) {
                        message_erro_aux = errors.responseJSON.errors.type_document_id[0];
                        message_erro = message_erro_aux.replace("type document id", "{{ __('messages.Type Document') }}")

                    } else if(errors.responseJSON.errors.comment) {
                        message_erro_aux = errors.responseJSON.errors.comment[0];
                        message_erro = message_erro_aux.replace("comment", "{{ __('messages.Description') }}")

                    } else if(errors.responseJSON.errors.image) {
                        message_erro_aux = errors.responseJSON.errors.image[0];
                        message_erro = message_erro_aux.replace("image", "{{ __('messages.Attach the document') }}")

                    } else {
                        message_erro = errors.responseJSON.errors;
                    }

                    document.getElementById("divErrorModal").style.display = "";
                    document.getElementById("messageModal").textContent = message_erro;
                    setTimeout(function() {
                        document.getElementById("divErrorModal").style.display = "none";
                    }, 5000);


                }
            });


        });


        $(function() {
            $('input').keyup(function() {
                this.value = this.value.toLocaleUpperCase();
            });
        });


        function openModalAttach() {

            console.log('Show open Attachments Modal');

            $('#myModalAttach').modal({
                backdrop: 'static',
                keyboard: false
            });

            // clear modal form when opened
            $('#image-form')[0].reset();

            setTimeout(function() {
                document.getElementById("project_id").value = document.getElementById("projectId").value;
            }, 100);


        }

        function closeModalAttach() {
            $('#myModalAttach').modal('hide');
            return false;
        }


        // Search prefix and vin number with enter key
        $("#prefix").keydown(function (e) {
            if (e.keyCode == 13) {
                fcSerchPrefix();
                return false;
            }
        });
        $("#vin_number").keydown(function (e) {
            if (e.keyCode == 13) {
                fcSerchPrefix();
                return false;
            }
        });



        // ********* DELETE **********
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
                        url: "{{ '/file/delete-file' }}",
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
                    // setTimeout(function() {
                    //     var vehicle_id = document.getElementById("id").value;
                    //     loadFiles(vehicle_id);
                    // }, 200);

                }
            });

        }


        setTimeout(function() {
            // MARCAR O LINK NO SIDEBAR
            $('#link-project').addClass('active');

        }, 100);

    </script>


    <style>
        .modal-content {
            width: 600px;
            margin-left: 25%;
        }
        .model-modal  {
            width: 600px;
            margin-left: 25%;
        }
        .modal-dialog  {
            width: 600px;
            margin-left: 25%;
        }
    </style>

    <script src="{{ asset('backend/dist/js/decimal.js') }}"></script>
    <script src="{{ asset('backend/dist/js/numeric-field.js') }}"></script>

  @endsection
