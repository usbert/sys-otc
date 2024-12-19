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
            <h4>{{ __('messages.Equipment Transfer')}}</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('vehicle-list') }}">{{ __('messages.Equipments') }}</a></li>
              <li class="breadcrumb-item active">{{ __('messages.Equipment Transfer')}}</li>
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

                            <div class="form-group">

                                <div class="row">

                                    <div class="col-sm-12">

                                        <div class="card card-secondary">

                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('messages.Description')}} </h3>
                                            </div>

                                            <div class="card-body">

                                                <input type="hidden" name="id" id="id">
                                                <input type="hidden" name="projectId" id="projectId">

                                                <div class="row">

                                                    <div class="col-sm-1">
                                                        <label>{{__('messages.Prefix.Prefix')}}</label>
                                                        <div class="input-group input-group-sm">
                                                            <input type="text" name="prefix" id="prefix" class="form-control form-control-sm" value="PUL003">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <label>{{ __('messages.Equipment.Vin Number') }}</label>
                                                        <div class="input-group input-group-sm">
                                                            <input type="text" name="vin_number" id="vin_number" class="form-control form-control-sm" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <label>&nbsp;</label>
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-append">
                                                                <button type="button" class="btn btn-info btn-flat" onclick="fcSerchPrefix()">&nbsp;<span class="fas fa-search"></span></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row" id="session01" style="margin-top: 15px; display: none">

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Description')}}</label>
                                                            <input type="text" name="description" id="description" class="form-control form-control-sm" @readonly(true)>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Brand')}}</label>
                                                            <input type="text" name="brand" id="brand" class="form-control form-control-sm" @readonly(true)>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Equipment.Model')}}</label>
                                                            <input type="text" name="model" id="model" class="form-control form-control-sm" @readonly(true)>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Project')}}</label>
                                                            <input type="text" name="project" id="project" class="form-control form-control-sm" @readonly(true)>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Equipment.Tag') }}</label>
                                                            <input type="text" name="tag" id="tag" class="form-control form-control-sm" maxlength="8" style="width: 100%;" @readonly(true)>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>Renavam</label>
                                                            <input type="text" name="renavam" id="renavam" class="form-control form-control-sm"  maxlength="30" @readonly(true)>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Supplyer') }}</label>
                                                            <input type="text" class="form-control form-control-sm" name="supplyer" id="supplyer" @readonly(true)>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Status') }}</label>
                                                            <div class="form-group">
                                                                <input type="text" name="status" id="status" class="form-control form-control-sm" @readonly(true)>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row" id="session02" style="display: none">

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Equipment.Has Implement') }}?</label>
                                                            <select class="form-control form-control-sm" name="has_implement" id="has_implement"
                                                             onclick="checkHasImplement()"
                                                             >
                                                                <option value="">{{ __('messages.Select') }}</option>
                                                                <option value="1">{{ __('messages.YES') }}</option>
                                                                <option value="0">{{ __('messages.NO') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2" id="div_implement" style="display: none">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Equipment.Implement Value') }}</label>
                                                            <input type="text" name="implement_value" id="implement_value" class="form-control form-control-sm"
                                                                @php
                                                                if($decimal_local == 'pt_BR') {
                                                                    echo "onkeypress=\"return fc_decimal(this,'.',',',event, 9);\" ";
                                                                } else {
                                                                    echo "onkeypress=\"return fc_decimal(this,',','.',event, 9);\" ";
                                                                }
                                                                @endphp
                                                            >
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2" id="div_bodywork_value">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Equipment.Equipment/Bodywork Value') }}</label>
                                                            <input type="text" name="body_value" id="body_value" class="form-control form-control-sm"
                                                                @php
                                                                if($decimal_local == 'pt_BR') {
                                                                    echo "onkeypress=\"return fc_decimal(this,'.',',',event, 9);\" ";
                                                                } else {
                                                                    echo "onkeypress=\"return fc_decimal(this,',','.',event, 9);\" ";
                                                                }
                                                                @endphp
                                                            >
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row" id="session03" style="display: none">

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Transfer Date') }}</label>
                                                            <input type="date" name="mobilization_date" id="mobilization_date" class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Unit Measure') }}</label>
                                                            <select class="form-control form-control-sm" name="unit_measure" id="unit_measure" onclick="checkIncludeMiles()">
                                                                <option value="Km">Km</option>
                                                                <option value="H">H</option>
                                                            </select>

                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2" id="miles_include">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            <br>
                                                            <span class="custom-control custom-switch" style="float: left; display:none;" id="label_has_h">
                                                                <input type="checkbox" class="custom-control-input" name="has_h" id="has_h" onclick="showFieldsKmH('H')">
                                                                <label class="custom-control-label" for="has_h">{{ __('messages.Include Hour Control') }}</label>
                                                            </span>

                                                            <span class="custom-control custom-switch" style="float: left; display:none;" id="label_has_km" onclick="showFieldsKmH('Km')">
                                                                <input type="checkbox" class="custom-control-input" name="has_km" id="has_km">
                                                                <label class="custom-control-label" for="has_km">{{ __('messages.Include Mileage Control') }}</label>
                                                            </span>
                                                        </div>
                                                    </div>

                                                     <div class="col-sm-2" id="div_km_control" style="display: none;">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Transfer Mile') }}</label>
                                                            <input type="text" name="km_control" id="km_control" class="form-control form-control-sm"
                                                                @php
                                                                if($decimal_local == 'pt_BR') {
                                                                    echo "onkeypress=\"return fc_decimal(this,'.',',',event, 8);\" ";
                                                                } else {
                                                                    echo "onkeypress=\"return fc_decimal(this,',','.',event, 8);\" ";
                                                                }
                                                                @endphp
                                                            >
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2" id="div_hour_control" style="display: none;">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Transfer Hour Meter') }}</label>
                                                            <input type="text" name="hour_control" id="hour_control" class="form-control form-control-sm"
                                                                @php
                                                                if($decimal_local == 'pt_BR') {
                                                                    echo "onkeypress=\"return fc_decimal(this,'.',',',event, 8);\" ";
                                                                } else {
                                                                    echo "onkeypress=\"return fc_decimal(this,',','.',event, 8);\" ";
                                                                }
                                                                @endphp
                                                            >
                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="row" id="session04" style="display: none">

                                                    {{-- Projeto Destino / Cliente / Atividade --}}

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Project') }}</label>
                                                            <select class="form-control form-control-sm" name="project_id" id="project_id" onclick="loadRelationships()">
                                                                <option value="">-- {{__('messages.Select')}} --</option>
                                                                @foreach ($result['projectCombo'] as $project)
                                                                    <option value="{{ $project->id }}">{{ $project->short_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Client') }}</label>
                                                            <select class="form-control form-control-sm" name="client_id" id="client_id">
                                                                <option value="">-- {{__('messages.Select')}} --</option>
                                                                {{-- INSERE OS DADOS PELO METODO DO PROJETO --}}
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Activity') }}</label>
                                                            <select class="form-control form-control-sm" name="activity_id" id="activity_id">
                                                                <option value="">-- {{__('messages.Select')}} --</option>
                                                                {{-- INSERE OS DADOS PELO METODO DO PROJETO --}}
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <button type="submit" class="btn btn-sm btn-primary submit-form" id="btnDesmob" style="display: none;">
                                            <i class="fa fa-save"></i>&nbsp;
                                            {{ __('messages.Button.Transfer') }}
                                        </button>

                                    </div>

                                </div>
                            </div>

                        </form>

                        {{-- DATATABLE ARQUIVOS --}}

                        <div class="row" style="margin-top: 20px; display: none;" id="session05">

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
                                                                <th scope="col">{{ __('messages.Project') }}</th>
                                                                <th scope="col">{{ __('messages.Type Documents') }}</th>
                                                                <th scope="col">{{ __('messages.Description') }}</th>
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


                        {{-- DATATABLE HISTÓRICO --}}

                        <div class="row" style="margin-top: 20px; display: none;" id="session06">

                            <div class="col-sm-12">

                                <div class="panel-body">
                                    <div class="card card-secondary">
                                        <div class="card-header">
                                            <h3 class="card-title">{{ __('messages.Mobilization Historic')}}</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">

                                                <div class="tab-content">
                                                    <table style="font-size: 14px; width: 98%" class="table table-striped table-sm" id="ajax-datatable-history">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">{{ __('messages.Project') }}</th>
                                                                <th scope="col">{{ __('messages.Mobilization Date') }}</th>
                                                                <th scope="col">{{ __('messages.Mileage Control') }}</th>
                                                                <th scope="col">{{ __('messages.Hour Meter Control') }}</th>
                                                                <th scope="col">{{ __('messages.Demobilization Date') }}</th>
                                                                <th scope="col">{{ __('messages.Mileage Control Return') }}</th>
                                                                <th scope="col">{{ __('messages.Hour Meter Control Return') }}</th>
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

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card-secondary">
                                        <div class="card-body">

                                            <input type="hidden" name="vehicle_id" id="vehicle_id">

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>{{ __('messages.Project') }}</label>
                                                        <select class="form-control form-control-sm" name="project_id" id="project_id">
                                                            <option value="">-- {{__('messages.Select')}} --</option>
                                                            @foreach ($result['projectCombo'] as $project)
                                                                <option value="{{ $project->id }}">{{ $project->short_name }}</option>
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

                                            <div class="row" style="margin-top: 20px;">
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
                    style="padding: 5px; margin: 10px; opacity: 0.8; text-align: center; display: none;">
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

                        document.getElementById("btnDesmob").style.display = "none";

                        document.getElementById("session01").style.display = "none";
                        document.getElementById("session02").style.display = "none";
                        document.getElementById("session03").style.display = "none";
                        document.getElementById("session04").style.display = "none";
                        document.getElementById("session05").style.display = "none";
                        document.getElementById("session06").style.display = "none";

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

                   document.getElementById("session01").style.display = "";
                   document.getElementById("session02").style.display = "";
                   document.getElementById("session03").style.display = "";
                   document.getElementById("session04").style.display = "";
                   document.getElementById("session05").style.display = "";
                   document.getElementById("session06").style.display = "";


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
                        { data: 'short_name',           name: 'short_name',     orderable: false, width: '15%' },
                        { data: 'type_name',            name: 'type_name',      orderable: false, width: '20%' },
                        { data: 'original_name',        name: 'original_name',  orderable: false, width: '25%' },
                        { data: 'comment',              name: 'comment',        orderable: false, width: '30%' },
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

        // Load list historic of mobilizations
        function loadMobilizationHistoric(id) {

            $(document).ready( function () {

                 // LIMPAR TUDO ANTES DE CRIAR NOVA DATATABLE
                $('#ajax-datatable-history').DataTable().clear().destroy();

                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                });

                $('#ajax-datatable-history').DataTable({
                    processing: false,
                    serverSide: false,
                    searching: false,
                    paging: false,
                    ajax: "{{ url('vehicle/get-mobilization/') }}/"+id,
                    columns: [
                        { data: 'short_name',           name: 'short_name',             orderable: false, width: '25%' },
                        { data: 'mobilization_date',    name: 'mobilization_date',      orderable: false, width: '15%' },
                        { data: 'km_control',           name: 'km_control',             orderable: false, width: '10%', render: $.fn.dataTable.render.number('.', ',', 2, '') },
                        { data: 'hour_control',         name: 'hour_control',           orderable: false, width: '10%', render: $.fn.dataTable.render.number('.', ',', 2, '') },
                        { data: 'demobilization_date',  name: 'demobilization_date',    orderable: false, width: '15%' },
                        { data: 'km_return',            name: 'km_return',              orderable: false, width: '10%', render: $.fn.dataTable.render.number('.', ',', 2, '') },
                        { data: 'hour_control_return',  name: 'hour_control_return',    orderable: false, width: '15%', render: $.fn.dataTable.render.number('.', ',', 2, '') },
                    ],
                    order: [[1, 'asc']],

                });


            });

        }

        // Save demobilization
        $(".submit-form").click(function(e) {

            e.preventDefault();
            var data = $('#form-data').serialize();

            $.ajax({
                type: 'post',
                url: "{{ url('vehicle/update-transfer/') }}",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // beforeSend: function(){
                //     console.log('....Please wait');
                // },
                success: function(response){

                    // TOASTR ALERT
                    toastr.options = timeOut = 10000;
                    toastr.options = {
                        "progressBar" : true,
                        "closeButton" : true,
                        "positionClass": "toast-bottom-full-width",
                        "onclick": true,
                        "fadeIn": 300,
                        "fadeOut": 1000,

                    },
                    toastr.success("<b>{{ __('messages.Updated successfully') }}!</b>", "{{ __('messages.Success') }}!");

                },
                complete: function(response){
                    console.log('Created New');
                },
                error: function(errors) {

                    // var message_erro = '{{ __('messages.Error.Required field not filled') }}: ';
                    // console.log('TODOS', errors.responseJSON);
                    // console.log('PARCIAL', errors.responseJSON.errors);

                    if(errors.responseJSON.errors.has_implement) {
                        message_erro_aux = errors.responseJSON.errors.has_implement[0];
                        message_erro = message_erro_aux.replace("has implement", "<b>{{ __('messages.Equipment.Has Implement') }}</b>")

                    } else if(errors.responseJSON.errors.implement_value) {
                        message_erro_aux = errors.responseJSON.errors.implement_value[0];
                        if(document.getElementById("has_implement").value == 1) {
                            message_erro = message_erro_aux.replace("implement value é obrigatório quando has implement for 1", "<b>{{ __('messages.Equipment.Implement Value') }}</b> é obrigatório")
                        }

                    } else if(errors.responseJSON.errors.mobilization_date) {
                        message_erro_aux = errors.responseJSON.errors.mobilization_date[0];
                        message_erro = message_erro_aux.replace("mobilization date", "<b>{{ __('messages.Transfer Date') }}</b>")

                    } else if(errors.responseJSON.errors.km_control) {
                        message_erro_aux = errors.responseJSON.errors.km_control[0];
                        message_erro = message_erro_aux.replace("km control", "<b>{{ __('messages.Transfer Mile') }}</b>")

                    } else if(errors.responseJSON.errors.hour_control) {
                        message_erro_aux = errors.responseJSON.errors.hour_control[0];
                        message_erro = message_erro_aux.replace("hour control", "<b>{{ __('messages.Transfer Hour Meter') }}</b>")

                    } else if(errors.responseJSON.errors.project_id) {
                        message_erro_aux = errors.responseJSON.errors.project_id[0];
                        message_erro = message_erro_aux.replace("project id", "<b>{{ __('messages.Project') }}</b>")

                    } else if(errors.responseJSON.errors.client_id) {
                        message_erro_aux = errors.responseJSON.errors.client_id[0];
                        message_erro = message_erro_aux.replace("client id", "<b>{{__('messages.Client')}}</b>")

                    } else if(errors.responseJSON.errors.activity_id) {
                        message_erro_aux = errors.responseJSON.errors.activity_id[0];
                        message_erro = message_erro_aux.replace("activity id", "<b>{{__('messages.Activity')}}</b>")

                    } else {
                        message_erro = errors.responseJSON.errors;
                    }

                    toastr.options = timeOut = 10000;
                    toastr.options = {
                        "progressBar" : true,
                        "closeButton" : true,
                        "positionClass": "toast-bottom-full-width",
                        "onclick": true,
                        "fadeIn": 300,
                        "fadeOut": 1000,

                    },
                    toastr.error(message_erro, "Atenção!");
                }

            });

        });


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

                    if(errors.responseJSON.errors.project_id) {
                        message_erro_aux = errors.responseJSON.errors.project_id[0];
                        message_erro = message_erro_aux.replace("project id", "{{ __('messages.Project') }}")

                    } else if(errors.responseJSON.errors.type_document_id) {
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

                document.getElementById("vehicle_id").value = document.getElementById("id").value;
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
                    setTimeout(function() {
                        var vehicle_id = document.getElementById("id").value;
                        loadFiles(vehicle_id);
                    }, 200);

                }
            });

        }


        function checkIncludeMiles() {

            var unit_measure = document.getElementById("unit_measure").value;

            if(unit_measure > '') {

                document.getElementById("miles_include").style.display = "";

                if(unit_measure == 'Km') {

                    document.getElementById("label_has_km").style.display = "none";
                    document.getElementById("label_has_h").style.display = "";
                    document.getElementById("div_km_control").style.display = "";
                    document.getElementById("div_hour_control").style.display = "none";
                    // set CHECKBOX PERGUNTA incluir KM desmarcado
                    // document.getElementById("has_h").checked = false

                } else if(unit_measure == 'H') {

                    document.getElementById("label_has_km").style.display = "";
                    document.getElementById("label_has_h").style.display = "none";
                    document.getElementById("div_km_control").style.display = "none";
                    document.getElementById("div_hour_control").style.display = "";
                    // set CHECKBOX PERGUNTA incluir KM desmarcado
                    // document.getElementById("has_km").checked = false;
                }

            } else {

                // Sem unidade de medida marcada desmarcar o restante e esconder a div
                document.getElementById("div_km_control").style.display = "none";
                document.getElementById("div_hour_control").style.display = "none";
                document.getElementById("label_has_km").style.display = "none";
                document.getElementById("label_has_h").style.display = "none";

            }

        }

        function showFieldsKmH(option) {

            console.log(option);

            if(option == 'H') {

                if(document.getElementById("has_h").checked == true) {
                    document.getElementById("div_hour_control").style.display = "";
                } else {
                    document.getElementById("div_hour_control").style.display = "none";
                }

            } else if(option == 'Km') {

                if(document.getElementById("has_km").checked == true) {
                    document.getElementById("div_km_control").style.display = "";
                } else {
                    document.getElementById("div_km_control").style.display = "none";
                }

            }

        }


        function loadRelationships() {
            var project_id = document.getElementById("project_id").value;

            if(project_id > '') {
                loadClients(project_id);
                loadActivities(project_id);
            } else {
                document.getElementById('activity_id').innerText = "<option value=''>-- {{__('messages.Select')}} --</option>";
                document.getElementById('client_id').innerText = "<select><option value=''>-- {{__('messages.Select')}} --</option></select>";

            }

        }

        // Carregar os Clientes no combox após selecinar o Projeto
        function loadClients(project_id) {

            $('#client_Id').find('option').not(':first').remove();

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            });

            $.ajax({
                url: '/vehicle/get-client/'+project_id,
                type: 'get',
                dataType: 'json',
                success: function(response){

                    var clients = response.original.clients;
                    $('#client_id').empty();

                    if(clients.length == 1) {
                        var option = "";
                        var selected_option = ' selected';
                    } else {
                        var option = "<option value=''>-- Selecione --</option>";
                        var selected_option = '';
                    }
                    $("#client_id").append(option);

                    clients.forEach(function(client) {
                        var option = "<option "+selected_option+" value='"+client.id+"'>"+client.name+"</option>";
                        $("#client_id").append(option);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        }


        // Carregar as Atividades no combox após selecinar o Projeto
        function loadActivities(project_id) {

            $('#activity_Id').find('option').not(':first').remove();

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            });

            $.ajax({
                url: '/vehicle/get-activity/'+project_id,
                type: 'get',
                dataType: 'json',
                success: function(response){

                    var activities = response.original.activities;
                    $('#activity_id').empty();

                    if(activities.length == 1) {
                        var option = "";
                        var selected_option = ' selected';
                    } else {
                        var option = "<option value=''>-- Selecione --</option>";
                        var selected_option = '';
                    }
                    $("#activity_id").append(option);

                    activities.forEach(function(activity) {
                        var option = "<option "+selected_option+" value='"+activity.id+"'>"+activity.name+"</option>";
                        $("#activity_id").append(option);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        }


        function checkHasImplement() {

            var has = document.getElementById("has_implement").value;

            if(has > '') {
                if(has == 1) {
                    document.getElementById("div_implement").style.display = "";
                } else {
                    document.getElementById("div_implement").style.display = "none";
                }
            }

        }

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