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
            <h4>{{ __('messages.Equipment.Equipment Registration')}}</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('vehicle-list') }}">{{ __('messages.Equipments') }}</a></li>
              <li class="breadcrumb-item active">{{ __('messages.Equipment.Equipment Registration')}}</li>
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

                                            {{-- TABS --}}
                                            <nav class="nav nav-pills" style="margin-bottom: 10px;">
                                                <a class="nav-item nav-link active" data-toggle="tab" onclick="showCont(1)" href="#tab1" id="navtab1">
                                                    01 - {{ __('messages.Select') }} {{ __('messages.Equipment.Model') }}
                                                </a>
                                                <a class="nav-item nav-link" data-toggle="tab" onclick="showCont(2)" href="#tab2" id="navtab2"  @disabled(true)>
                                                    02 - {{ __('messages.Equipment.Equipment Description') }}
                                                </a>
                                            </nav>

                                            <div class="card-header">
                                                <h3 class="card-title"><span id="titHead">{{ __('messages.Select the model of equipment you want to register')}}</span></h3>
                                            </div>

                                            <div class="card-body">

                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">

                                                            <div class="tab-content">
                                                                <div class="col-md-12 tab-pane fade show active" id="tab1">

                                                                    {{-- DATATABLE WIDTH MODELS --}}
                                                                    <table style="font-size: 14px" class="table table-striped table-sm display compact responsive" id="ajax-crud-datatable">
                                                                        <thead>
                                                                            <tr>
                                                                                <th></th>
                                                                                <th scope="col">{{ __('Prefix') }}</th>
                                                                                <th scope="col">{{ __('Description') }}</th>
                                                                                <th scope="col">{{ __('messages.Brand') }}</th>
                                                                                <th scope="col">{{ __('messages.Model') }}</th>
                                                                                <th scope="col">{{ __('messages.EquipmentFamily.Family') }}</th>
                                                                                <th scope="col">{{ __('Weight') }}</th>
                                                                                <th scope="col">{{ __('Capacity') }}</th>
                                                                                <th scope="col">{{ __('Power') }}</th>
                                                                                <th scope="col">{{ __('Type') }}</th>
                                                                            </tr>
                                                                        </thead>
                                                                    </table>
                                                                </div>


                                                                <div class="tab-pane fade" id="tab2">

                                                                    <input type="hidden" name="model_id" id="model_id" class="form-control form-control-sm">

                                                                    <div class="panel">
                                                                        <div class="panel-body">

                                                                            <div class="row">
                                                                                <div class="col-sm-1">
                                                                                    <div class="form-group">
                                                                                        <label>{{__('messages.Prefix.Prefix')}}</label>
                                                                                        <input type="text" name="prefix" id="prefix" class="form-control form-control-sm" @readonly(true)>
                                                                                    </div>
                                                                                </div>

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
                                                                                        <label>{{__('messages.EquipmentFamily.Family')}}</label>
                                                                                        <input type="text" name="family" id="family" class="form-control form-control-sm" @readonly(true)>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">

                                                                                <div class="col-sm-1">
                                                                                    <div class="form-group">
                                                                                        <label>{{__('messages.Weight')}}</label>
                                                                                        <input type="text" name="weight_measurment" id="weight_measurment" class="form-control form-control-sm" @readonly(true)>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-1">
                                                                                    <div class="form-group">
                                                                                        <label>{{__('messages.Capacity')}}</label>
                                                                                        <input type="text" name="capacity_measurment" id="capacity_measurment" class="form-control form-control-sm" @readonly(true)>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-1">
                                                                                    <div class="form-group">
                                                                                        <label>{{__('messages.Power')}}</label>
                                                                                        <input type="text" name="power_measurment" id="power_measurment" class="form-control form-control-sm" @readonly(true)>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-2">
                                                                                    <div class="form-group">
                                                                                        <label>{{ __('messages.Type') }}</label>
                                                                                        <div class="form-group">
                                                                                            <input type="text" name="type" id="type" class="form-control form-control-sm" @readonly(true)>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-1">
                                                                                    <div class="form-group">
                                                                                        <label>{{ __('messages.Literage') }}</label>
                                                                                        <div class="form-group">
                                                                                            <input type="text" name="tank_capacity" id="tank_capacity" class="form-control form-control-sm" @readonly(true)>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="panel">
                                                                        <div class="panel-body">

                                                                            <div class="card card-secondary">

                                                                                <div class="card-header">
                                                                                    <h3 class="card-title">{{ __('messages.Description')}}</h3>
                                                                                </div>

                                                                            </div>

                                                                            <div class="row">

                                                                                <div class="col-sm-1">
                                                                                    <div class="form-group">
                                                                                        <label>{{ __('messages.Equipment.Tag') }}</label>
                                                                                        <input type="text" name="tag" id="tag" class="form-control form-control-sm" maxlength="8" style="width: 100%;">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-2">
                                                                                    <div class="form-group">
                                                                                        <label>Renavam</label>
                                                                                        <div class="form-group">
                                                                                            <input type="text" name="renavam" id="renavam" class="form-control form-control-sm"
                                                                                             onkeypress="return isNumberKey(event)"
                                                                                            >
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-4">
                                                                                    <div class="form-group">
                                                                                        <label>{{ __('messages.Equipment.Vin Number') }}</label>
                                                                                        <input type="text" name="vin_number" id="vin_num" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-2">
                                                                                    <div class="form-group">
                                                                                        <label>{{__('messages.Equipment.Manufacture Year')}}</label>
                                                                                        <select class="form-control form-control-sm" name="manufacture_year" id="manufacture_year">
                                                                                            <option value="">{{__('messages.Select')}}</option>
                                                                                            @for ($af=1985; $af<=2024; $af++)
                                                                                                <option value="{{ $af }}">{{ $af }}</option>
                                                                                            @endfor
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-2">
                                                                                    <div class="form-group">
                                                                                        <label>{{__('messages.Equipment.Model Year')}}</label>
                                                                                        <select class="form-control form-control-sm" name="model_year" id="model_year">
                                                                                            <option value="">{{__('messages.Select')}}</option>
                                                                                            @for ($am=1985; $am<=2024; $am++)
                                                                                                <option value="{{ $am }}">{{ $am }}</option>
                                                                                            @endfor
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                            <div class="row">

                                                                                <div class="col-sm-2">
                                                                                    <div class="form-group">
                                                                                        <label>{{ __('messages.Supplyer') }}</label>
                                                                                        <select class="form-control form-control-sm" name="supplyer_id" id="supplyer_id">
                                                                                            <option value="">-- {{__('messages.Select')}} --</option>
                                                                                            @foreach ($result['supplyerCombo'] as $supplyer)
                                                                                                <option value="{{ $supplyer->id }}">{{ $supplyer->name }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-2">
                                                                                    <div class="form-group">
                                                                                        <label>{{ __('messages.Fuel') }}</label>
                                                                                        <select class="form-control form-control-sm" name="fuel_id" id="fuel_id">
                                                                                            <option value="">-- {{__('messages.Select')}} --</option>
                                                                                            @foreach ($result['fuelCombo'] as $fuel)
                                                                                                <option value="{{ $fuel->id }}">{{ $fuel->name }}</option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

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

                                                                                <div class="col-sm-1">
                                                                                    <div class="form-group">
                                                                                        <label>{{ __('messages.Driver') }}</label>
                                                                                        <select class="form-control form-control-sm" name="driver_id" id="driver_id">
                                                                                            <option value="">-- {{__('messages.Select')}} --</option>
                                                                                            {{-- INSERE OS DADOS PELO METODO DO PROJETO --}}
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-1">
                                                                                    <div class="form-group">
                                                                                        <label>{{ __('messages.Activity') }}</label>
                                                                                        <select class="form-control form-control-sm" name="activity_id" id="activity_id">
                                                                                            <option value="">-- {{__('messages.Select')}} --</option>
                                                                                            {{-- INSERE OS DADOS PELO METODO DO PROJETO --}}
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                            <div class="row">

                                                                                <div class="col-sm-2">
                                                                                    <div class="form-group">
                                                                                        <label>{{ __('messages.Mobilization Date') }}</label>
                                                                                        <input type="date" name="mobilization_date" id="mobilization_date" class="form-control form-control-sm">
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-2">
                                                                                    <div class="form-group">
                                                                                        <label>{{ __('messages.Unit Measure') }}</label>
                                                                                        <select class="form-control form-control-sm" name="unit_measure" id="unit_measure" onclick="checkIncludeMiles()">
                                                                                            <option value="">-- {{__('messages.Select')}} --</option>
                                                                                            <option value="Km">Km</option>
                                                                                            <option value="H">H</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-sm-2" id="miles_include"  style="display:none;">
                                                                                    <div class="form-group">
                                                                                        <label>&nbsp;</label>
                                                                                        <br>
                                                                                        <span class="custom-control custom-switch" style="float: left; display:none;" id="label_has_h">
                                                                                            <input type="checkbox" class="custom-control-input" name="has_h" id="has_h" onclick="showFieldsKmH('H')" />
                                                                                            <label class="custom-control-label" for="has_h">{{ __('messages.Include Hour Control') }}</label>
                                                                                        </span>

                                                                                        <span class="custom-control custom-switch" style="float: left; display:none;" id="label_has_km" onclick="showFieldsKmH('Km')">
                                                                                            <input type="checkbox" class="custom-control-input" name="has_km" id="has_km" />
                                                                                            <label class="custom-control-label" for="has_km">{{ __('messages.Include Mileage Control') }}</label>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>

                                                                                 <div class="col-sm-2" id="div_km_control" style="display: none;">
                                                                                    <div class="form-group">
                                                                                        <label>{{ __('messages.Mileage Control') }}</label>
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
                                                                                        <label>{{ __('messages.Hour Meter Control') }}</label>
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

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="tab-pane fade" id="tab3">
                                                                    <div class="panel">
                                                                        <div class="panel-body">

                                                                            <div class="row">
                                                                                documentos
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


                                </div>


                            </div>

                            <button type="submit" class="btn btn-sm btn-primary submit-form" id="create_new">
                                <i class="fa fa-save"></i>&nbsp;
                                {{ __('messages.Button.Save') }}
                            </button>

                        </form>

                    </div>

                </div>

            </div>

      </div>


    </section>
    <!-- /.content -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

        // DATATABLE WIDTH MODELS
        $(document).ready( function () {

            // $.noConflict();

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            });

            $('#ajax-crud-datatable').DataTable({
                processing: false,
                serverSide: true,
                searching: true,
                ajax: "{{ url('model/') }}",
                columns: [
                    { data: 'id', name: 'id', orderable: false,
                        render: function(data, type, row) {

                            btn = '<div class="custom-control custom-switch">';
                            btn += '<input type="radio" class="custom-control-input" name="equipment_id" id="equipment_id'+data+'" onclick="checkModel('+data+')" />';
                            btn += '<label class="custom-control-label" for="equipment_id'+data+'"></label>';
                            btn += '</div>';

                            return btn;

                        }
                    },
                    { data: 'prefix', name: 'prefix', orderable: true, width: '5%',
                        render: function(data, type, row) {
                            return '<span style="color:blue; font-weight: bold;">'+data+'</span>';
                        }
                     },
                    { data: 'prefix_name',          name: 'prefix_name',            orderable: true, width: '20%' },
                    { data: 'brand_name',           name: 'brand_name',             orderable: true, width: '10%' },
                    { data: 'name',                 name: 'name',                   orderable: true, width: '15%' },
                    { data: 'family_name',          name: 'family_name',            orderable: true, width: '20%' },
                    { data: 'weight_measurment',    name: 'weight_measurment',      orderable: true, width: '07%' },
                    { data: 'capacity_measurment',  name: 'capacity_measurment',    orderable: true, width: '08%' },
                    { data: 'power_measurment',     name: 'power_measurment',       orderable: true, width: '07%' },
                    { data: 'type',                 name: 'type',                   orderable: true, width: '08%',
                        render: function(data, type, row) {
                            if(data == 1) {
                                return 'VEÍCULO';
                            }else if (data == 0) {
                                return 'EQUIPAMENTO';
                            } else { return '-'; }
                        }
                    },

                ],
                order: [[0, 'asc']],

                // QUANTIDADE DE LINHAS NA PÁGINA
                lengthMenu: [
                    [6, 8, 10, 25, 50, 100, -1],
                    ['6', '8', 10, '25', '50', '100', 'Todos']
                ],
                pageLength: '10',

                // language: {
                //     url: "backend/{{ __('datatable-en') }}.json"

                // },
            });

        });


        function showCont(i) {
            if(i == 1) {

                $('[href="#tab1"]').tab('show');

                $("#tab1").css("display", "");
                document.getElementById("titHead").innerHTML = "{{ __('messages.Select the model of equipment you want to register') }}";

            } else if(i == 2) {

                $('[href="#tab2"]').tab('show');

                if(document.getElementById("model_id").value > '') {
                    document.getElementById("titHead").innerHTML = "{{ __('messages.Selected Model') }}";
                }

            }
        }


        // ENVIAR OS DADOS DO MODELO SELECIONADO PARA O USUÁRIO VISUALIZAR NA TAB2
        function checkModel(id) {

            $("#navtab2").removeAttr("disabled");

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            });

            $.ajax({
                url: '/vehicle/get-model/'+id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    var models = response.models;
                    var modelList = $('#modelList');
                    modelList.empty();

                    models.forEach(function(model) {
                        modelList.append('<p>' + model.name + '</p>');
                        document.getElementById("model_id").value = id;
                        document.getElementById("prefix").value = model.prefix;
                        document.getElementById("description").value = model.equipment_prefix.name;
                        document.getElementById("brand").value = model.brand.name;
                        document.getElementById("model").value = model.name;
                        document.getElementById("family").value = model.equipment_family.name;
                        document.getElementById("weight_measurment").value = model.weight_measurment;
                        document.getElementById("capacity_measurment").value = model.capacity_measurment;
                        document.getElementById("power_measurment").value = model.power_measurment;
                        document.getElementById("tank_capacity").value = model.tank_capacity;
                        if(model.equipment_family.type == 1) {
                            document.getElementById("type").value = 'VEÍCULO';
                        } else {
                            document.getElementById("type").value = 'EQUIPAMENTO';
                        }

                        showCont(2);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        }


        function loadRelationships() {
            var project_id = document.getElementById("project_id").value;

            if(project_id > '') {
                loadDrivers(project_id);
                loadActivities(project_id);
                loadClients(project_id);
            } else {
                document.getElementById('client_id').innerText = "<select><option value=''>-- {{__('messages.Select')}} --</option></select>";
                document.getElementById('driver_id').innerText = "<option value=''>-- {{__('messages.Select')}} --</option>";
                document.getElementById('activity_id').innerText = "<option value=''>-- {{__('messages.Select')}} --</option>";
            }

        }

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

        function loadDrivers(project_id) {

            $('#driver_id').find('option').not(':first').remove();

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            });

            $.ajax({
                url: '/vehicle/get-driver/'+project_id,
                type: 'get',
                dataType: 'json',
                success: function(response){

                    var drivers = response.original.drivers;
                    $('#driver_id').empty();

                    if(drivers.length == 1) {
                        var option = "";
                        var selected_option = ' selected';
                    } else {
                        var option = "<option value=''>-- Selecione --</option>";
                        var selected_option = '';
                    }
                    $("#driver_id").append(option);

                    drivers.forEach(function(driver) {
                        var option = "<option "+selected_option+" value='"+driver.id+"'>"+driver.name+"</option>";
                        $("#driver_id").append(option);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        }

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
                    document.getElementById("has_h").checked = false

                } else {
                    document.getElementById("label_has_km").style.display = "";
                    document.getElementById("label_has_h").style.display = "none";
                    document.getElementById("div_km_control").style.display = "none";
                    document.getElementById("div_hour_control").style.display = "";
                    // set CHECKBOX PERGUNTA incluir KM desmarcado
                    document.getElementById("has_km").checked = false;
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


        // pt_BR
        // console.log(navigator.language);

        // DATAPICKER


        // $( document ).ready(function() {
        //     $("#mobilization_date").datepicker({
        //         format: 'yyyy-mm-dd'
        //     });
        //     $("#mobilization_date").on("change", function () {
        //         var fromdate = $(this).val();
        //         console.log(fromdate);
        //         document.getElementById('mobilization_date').value = fromdate;
        //     });
        // });


        let mobilization_date = document.getElementById('mobilization_date');

        mobilization_date.addEventListener('change',(e)=>{
            let mobilization_dateVal = e.target.value;
            document.getElementById('mobilization_date').innerText = mobilization_dateVal
        });



        // ********* SAVING FORM **********
        $(".submit-form").click(function(e) {

            e.preventDefault();
            var data = $('#form-data').serialize();

            $.ajax({
                type: 'post',
                url: "{{ url('vehicle/store/') }}",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // beforeSend: function(){
                //     console.log('....Please wait');
                // },
                success: function(response){

                    console.log(response);

                    if(response == 'existing data group') {

                        toastr.options = timeOut = 10000;
                        toastr.options = {
                            "progressBar" : true,
                            "closeButton" : true,
                            "positionClass": "toast-bottom-full-width",
                            "onclick": true,
                            "fadeIn": 300,
                            "fadeOut": 1000,
                        },
                        toastr.error("<b>{{ __('messages.Registration already exists') }}!</b><br>{{ __('messages.Check possible combinations of existing data') }}.", "Oops!");

                    } else {

                        toastr.options = timeOut = 10000;
                        toastr.options = {
                            "progressBar" : true,
                            "closeButton" : true,
                            "positionClass": "toast-bottom-full-width",
                            "onclick": true,
                            "fadeIn": 300,
                            "fadeOut": 1000,
                        },
                        toastr.success("<b>{{ __('messages.Successfully recorded') }}!</b>", "{{ __('messages.Success') }}!");

                        // LIMPAR FORM
                        $('#form-data')[0].reset();

                    }

                },
                complete: function(response){
                    console.log('Created New');
                },
                error: function(errors) {

                    // var message_erro = '{{ __('messages.Error.Required field not filled') }}: ';
                    // console.log('TODOS', errors.responseJSON);
                    // console.log('PARCIAL', errors.responseJSON.errors);

                    if(errors.responseJSON.errors.model_id) {
                        message_erro_aux = errors.responseJSON.errors.model_id[0];
                        message_erro = message_erro_aux.replace("model id", "<b>{{__('messages.Model')}}</b>")

                    } else if(errors.responseJSON.errors.prefix) {
                        message_erro_aux = errors.responseJSON.errors.prefix[0];
                        message_erro = message_erro_aux.replace("prefix", "<b>{{__('messages.Prefix.Prefix')}}</b>")

                    } else if(errors.responseJSON.errors.tag) {
                        message_erro_aux = errors.responseJSON.errors.tag[0];
                        message_erro = message_erro_aux.replace("tag", "<b>{{__('messages.Equipment.Tag')}}</b>")

                    } else if(errors.responseJSON.errors.renavam) {
                        message_erro_aux = errors.responseJSON.errors.renavam[0];
                        message_erro = message_erro_aux.replace("renavam", "<b>Renavam</b>")

                    } else if(errors.responseJSON.errors.vin_number) {
                        message_erro_aux = errors.responseJSON.errors.vin_number[0];
                        message_erro = message_erro_aux.replace("vin number", "<b>{{__('messages.Equipment.Vin Number')}}</b>")

                    } else if(errors.responseJSON.errors.manufacture_year) {
                        message_erro_aux = errors.responseJSON.errors.manufacture_year[0];
                        message_erro = message_erro_aux.replace("manufacture year", "<b>{{__('messages.Equipment.Manufacture Year')}}</b>")

                    } else if(errors.responseJSON.errors.model_year) {
                        message_erro_aux = errors.responseJSON.errors.model_year[0];
                        message_erro = message_erro_aux.replace("model year", "<b>{{__('messages.Equipment.Model Year')}}</b>")

                    } else if(errors.responseJSON.errors.supplyer_id) {
                        message_erro_aux = errors.responseJSON.errors.supplyer_id[0];
                        message_erro = message_erro_aux.replace("supplyer id", "<b>{{__('messages.Supplyer')}}</b>")

                    } else if(errors.responseJSON.errors.fuel_id) {
                        message_erro_aux = errors.responseJSON.errors.fuel_id[0];
                        message_erro = message_erro_aux.replace("fuel id", "<b>{{__('messages.Fuel')}}</b>")

                    } else if(errors.responseJSON.errors.project_id) {
                        message_erro_aux = errors.responseJSON.errors.project_id[0];
                        message_erro = message_erro_aux.replace("project id", "<b>{{__('messages.Project')}}</b>")

                    } else if(errors.responseJSON.errors.client_id) {
                        message_erro_aux = errors.responseJSON.errors.client_id[0];
                        message_erro = message_erro_aux.replace("client id", "<b>{{__('messages.Client')}}</b>")

                    } else if(errors.responseJSON.errors.driver_id) {
                        message_erro_aux = errors.responseJSON.errors.driver_id[0];
                        message_erro = message_erro_aux.replace("driver id", "<b>{{__('messages.Driver')}}</b>")

                    } else if(errors.responseJSON.errors.activity_id) {
                        message_erro_aux = errors.responseJSON.errors.activity_id[0];
                        message_erro = message_erro_aux.replace("activity id", "<b>{{__('messages.Activity')}}</b>")

                    } else if(errors.responseJSON.errors.mobilization_date) {
                        message_erro_aux = errors.responseJSON.errors.mobilization_date[0];
                        message_erro = message_erro_aux.replace("mobilization date", "<b>{{__('messages.Mobilization Date')}}</b>")

                    } else if(errors.responseJSON.errors.unit_measure) {
                        message_erro_aux = errors.responseJSON.errors.unit_measure[0];
                        message_erro = message_erro_aux.replace("unit measure", "<b>{{__('messages.Unit Measure')}}</b>")

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
                    toastr.error(message_erro, "<b>{{ __('messages.Attention') }}</b>!");
                }

            });

        });

        $(function() {
            $('input').keyup(function() {
                this.value = this.value.toLocaleUpperCase();
            });
        });

    </script>




  </head>


    <style>
        input, select { margin-bottom: 8px; }

            .modal-content {
                width: 1200px;
                margin-left: 15%;
            }
            .model-modal  {
                width: 1200px;
                margin-left: 15%;
        }

        .modal-dialog  {
                width: 1200px;
                margin-left: 15%;
        }

    </style>

    <script src="{{ asset('backend/dist/js/decimal.js') }}"></script>
    <script src="{{ asset('backend/dist/js/numeric-field.js') }}"></script>

  @endsection
