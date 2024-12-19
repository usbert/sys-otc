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
            <h4>{{ __('messages.Equipment Contract')}}</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('vehicle-list') }}">{{ __('messages.Equipments') }}</a></li>
              <li class="breadcrumb-item active">{{ __('messages.Equipment Contract')}}</li>
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

                                                <div class="row">

                                                    <div class="col-sm-1">
                                                        <label>{{__('messages.Prefix.Prefix')}}</label>
                                                        <div class="input-group input-group-sm">
                                                            <input type="text" name="prefix" id="prefix" class="form-control form-control-sm" value="PUL003">
                                                            {{-- AMB064 --}}
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

                                                <div class="row">

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

                                                </div>

                                                <div class="row">

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Current Supplier') }}</label>
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

                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Select the supplier to view contracts') }}:</label>
                                                            <select class="form-control form-control-sm" name="supplyer_id" id="supplyer_id">
                                                                @foreach ($result['supplyerCombo'] as $supplyer)
                                                                    <option value="{{ $supplyer->id }}">{{ $supplyer->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>

                        </form>

                        {{-- DATATABLE HISTÓRICO --}}

                        <div class="row" style="display: none;" id="divHist">

                            <div class="col-sm-12">

                                <div class="panel-body">
                                    <div class="card card-secondary">
                                        <div class="card-header">
                                            <h3 class="card-title">{{ __('messages.Select the current contract') }}</h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">

                                                <div class="tab-content">
                                                    <table style="font-size: 14px; width: 98%" class="table table-striped table-sm" id="ajax-datatable-contracts-supplyer">
                                                        <thead>
                                                            <tr>
                                                                <th>{{ __('messages.Active') }}</th>
                                                                <th></th>
                                                                <th scope="col">{{ __('messages.Supplyer') }}</th>
                                                                {{-- <th scope="col">{{ __('messages.Document Number') }}</th> --}}
                                                                <th scope="col">{{ __('messages.Project') }}</th>
                                                                <th scope="col">{{ __('messages.Contract') }}/{{ __('messages.Year') }}</th>
                                                                <th scope="col">{{ __('messages.Start Date') }}</th>
                                                                <th scope="col">{{ __('messages.End Date') }}</th>
                                                                {{-- <th scope="col">{{ __('messages.Order') }}</th> --}}
                                                                <th scope="col">{{ __('messages.Contract Value') }}</th>
                                                                <th scope="col">{{ __('messages.Mobilization Value') }}</th>
                                                                <th scope="col">{{ __('messages.Demobilization Value') }}</th>
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
    <div class="modal fade" id="myModalValuesContract" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalValuesContractLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header" style="background-color: #6c757d; color: white;">
                <h5 class="modal-title" id="myModalValuesContractLabel">{{ __('messages.Contract values')}}</h5>
                {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModalAttach()"></button> --}}
            </div>
            <div class="modal-body">

                {{-- start form modal --}}
                <form action="{{ url('file/store/') }}" id="values-form" class="form-horizontal" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card card-secondary">
                                    <div class="card-body">

                                        <input type="idden" name="id" id="id" value="">

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>{{__('messages.Contract')}}/{{__('messages.Year')}}</label>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="contract_number_and_year" id="contract_number_and_year" class="form-control form-control-sm" value='' @readonly(true)>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>{{__('messages.Contract Value')}}</label>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="contract_value" id="contract_value" class="form-control form-control-sm" value=''
                                                    {{-- @if("{{ Config::get('app.locale') }}" == 'pt_BR')
                                                    { --}}
                                                    onkeypress="return fc_decimal(this, '.', ',', event, 9);"
                                                    {{-- }
                                                    @else {
                                                        onkeypress="return fc_formatar_moeda(this,',','.',event, 7);"
                                                    }
                                                    @endif --}}
                                                    >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>{{__('messages.Mobilization Value')}}</label>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="mobilization_value" id="mobilization_value" class="form-control form-control-sm" value=''
                                                     {{-- @if("{{ Config::get('app.locale') }}" == 'pt_BR')
                                                    { --}}
                                                    onkeypress="return fc_decimal(this, '.', ',', event, 9);"
                                                    {{-- }
                                                    @else {
                                                        onkeypress="return fc_formatar_moeda(this,',','.',event, 7);"
                                                    }
                                                    @endif --}}
                                                    >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>{{__('messages.Demobilization Value')}}</label>
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="demobilization_value" id="demobilization_value" class="form-control form-control-sm" value=''
                                                     {{-- @if("{{ Config::get('app.locale') }}" == 'pt_BR')
                                                    { --}}
                                                    onkeypress="return fc_decimal(this, '.', ',', event, 9);"
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
                <button type="submit" class="btn btn-sm btn-primary submit-form" id="save_value">
                    <i class="fa fa-save"></i>&nbsp;
                    {{ __('messages.Button.Save') }}
                </button>
            </div>
            </div>
        </div>
    </div>

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

                // Passar Status = 1,2 (mobilizado, desmobilizado)
                url: '/vehicle/get-equipment/1,2/'+prefix+'/'+vin_number,
                type: 'GET',
                dataType: 'json',
                success: function(response) {

                    // console.log('/vehicle/get-equipment/1,2/'+prefix+'/'+vin_number);
                    // console.log('aqui', response.vehicles);

                    console.log(response.vehicles[0]);


                   if(response.vehicles[0] == undefined) {

                        alertSwal("{{__('messages.Not Found')}}!", 3500, 'warning');
                        $('#form-data')[0].reset();

                        document.getElementById("divHist").style.display = "none";

                        return false;
                   }

                   document.getElementById("id").value              =  response.vehicles[0]['id'];
                   document.getElementById("prefix").value          =  response.vehicles[0]['prefix'];
                   document.getElementById("vin_number").value      =  response.vehicles[0]['vin_number'];
                   document.getElementById("description").value     =  response.vehicles[0]['model_description'];
                   document.getElementById("brand").value           =  response.vehicles[0]['brand_name'];
                   document.getElementById("model").value           =  response.vehicles[0]['model_name'];
                   document.getElementById("project").value         =  response.vehicles[0]['project_short_name'];
                   document.getElementById("tag").value             =  response.vehicles[0]['tag'];
                   document.getElementById("supplyer").value        =  response.vehicles[0]['supplyer_name'];
                   document.getElementById("supplyer_id").value     =  response.vehicles[0]['supplyer_id'];
                   document.getElementById("status").value          =  response.vehicles[0]['status_name'];

                   // CARREGAR O HISTÓRICO DE MOBILIZAÇÃO
                   loadContractsBySupplyer(response.vehicles[0]['supplyer_id'], response.vehicles[0]['id']);

                   document.getElementById("divHist").style.display = "";

                   return false;

                },
                error: function(xhr, status, error) {

                    console.error(error);
                }
            });

        }

        // Load list historic of mobilizations
        function loadContractsBySupplyer(supplyer_id, vehicle_id) {

            $(document).ready( function () {

                 // LIMPAR TUDO ANTES DE CRIAR NOVA DATATABLE
                $('#ajax-datatable-contracts-supplyer').DataTable().clear().destroy();

                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                });

                $('#ajax-datatable-contracts-supplyer').DataTable({
                    processing: false,
                    serverSide: false,
                    searching: false,
                    paging: false,
                    ajax: "{{ url('/contract/get-contract-by-supplyer') }}/"+supplyer_id+"/"+vehicle_id,
                    columns: [
                        { data: 'id', name: 'id', orderable: false,
                            render: function(data, type, row) {

                                btn = '<div class="custom-control custom-switch">';
                                    btn += '<input type="radio" class="custom-control-input" name="equipment_id" id="equipment_id'+data+'" onclick="saveContractSelected('+data+')" />';
                                btn += '<label class="custom-control-label" for="equipment_id'+data+'"></label>';
                                btn += '</div>';

                                return btn;

                            }
                        },
                        { data: 'id', name: 'id', orderable: false,
                            width: "2%",
                            render: function(data, type, row, meta) {
                                // openX = '<button type="button" onclick="openModalValuesContract('+row['id']+','+meta.row+')" class="btn btn-sm btn-info"><span class="fas fa-dollar-sign" aria-hidden="true"></span></button>';
                                openX = '<a href="#"><span class="fas fa-dollar-sign" aria-hidden="true" onclick="openModalValuesContract('+row['id']+','+meta.row+')"></span></a>';
                                return openX;
                            }
                        },
                        { data: 'supplyer_name', name: 'supplyer_name', orderable: true, width: "30%" },
                        // { data: 'document_number', name: 'document_number', orderable: true, width: "15%" },
                        { data: 'project_short_name', name: 'project_short_name', orderable: true, width: "10%" },
                        { data: 'contract_number_and_year', name: 'contract_number_and_year', orderable: true, width: "10%" },
                        { data: 'contract_start_date', name: 'contract_start_date', orderable: true, width: "10%" },
                        { data: 'contract_end_date', name: 'contract_end_date', orderable: true, width: "10%" },
                        // { data: 'order_and_year', name: 'order_and_year', orderable: true, width: "10%" },
                        { data: 'contract_value', name: 'contract_value', orderable: true, width: "8%", render: $.fn.dataTable.render.number('.', ',', 2, '') },
                        { data: 'mobilization_value', name: 'mobilization_value', orderable: true, width: "8%", render: $.fn.dataTable.render.number('.', ',', 2, '') },
                        { data: 'demobilization_value', name: 'demobilization_value', orderable: true, width: "8%", render: $.fn.dataTable.render.number('.', ',', 2, '') },
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
                url: "{{ url('vehicle/update-contract-values/') }}",
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

                    $('#form-data')[0].reset();
                    document.getElementById("divHist").style.display = "none";

                },
                complete: function(response){
                    console.log('Created New');
                },
                error: function(errors) {

                    // var message_erro = '{{ __('messages.Error.Required field not filled') }}: ';
                    // console.log('TODOS', errors.responseJSON);
                    // console.log('PARCIAL', errors.responseJSON.errors);

                    if(errors.responseJSON.errors.contract_value) {
                        message_erro_aux = errors.responseJSON.errors.contract_value[0];
                        message_erro = message_erro_aux.replace("contract value", "<b>{{ __('messages.Contract Value') }}</b>")

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


        $(function() {
            $('input').keyup(function() {
                this.value = this.value.toLocaleUpperCase();
            });
        });


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


        function saveContractSelected(id) {
            alert('save');
        }


        function openModalValuesContract(id, metaRow) {

            $('#myModalValuesContract').modal({
                backdrop: 'static',
                keyboard: false
            });

            // clear modal form when opened
            // $('#ajax-datatable-contracts-supplyer')[0].reset();

            setTimeout(function() {

                //  IMPLEMENTAR en-US

                document.getElementById("id").value = id;

                document.getElementById("contract_number_and_year").value = parseInt($('#ajax-datatable-contracts-supplyer').DataTable().row(metaRow).data().contract_number_and_year);

                // converter a string com valor para número antes de adicionar o decimal
                let num = parseInt($('#ajax-datatable-contracts-supplyer').DataTable().row(metaRow).data().contract_value);
                var contract_value = num.toLocaleString('pt-br', {minimumFractionDigits: 2});
                document.getElementById("contract_value").value = contract_value;

                // converter a string com valor para número antes de adicionar o decimal
                let num2 = parseInt($('#ajax-datatable-contracts-supplyer').DataTable().row(metaRow).data().mobilization_value);
                var mobilization_value = num2.toLocaleString('pt-br', {minimumFractionDigits: 2});
                document.getElementById("mobilization_value").value = mobilization_value;

                // converter a string com valor para número antes de adicionar o decimal
                let num3 = parseInt($('#ajax-datatable-contracts-supplyer').DataTable().row(metaRow).data().demobilization_value);
                var demobilization_value = num3.toLocaleString('pt-br', {minimumFractionDigits: 2});
                document.getElementById("demobilization_value").value = demobilization_value;

            }, 100);


        }

        function closeModalAttach() {
            $('#myModalValuesContract').modal('hide');
            return false;
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

        #ajax-datatable-contracts-supplyer td:nth-of-type(8) {
            /* color: #007bff; */
            font-weight: bold;
            text-align: right;
        }
        #ajax-datatable-contracts-supplyer td:nth-of-type(9) {
            /* color: #007bff; */
            font-weight: bold;
            text-align: right;
        }
        #ajax-datatable-contracts-supplyer td:nth-of-type(10) {
            /* color: #007bff; */
            font-weight: bold;
            text-align: right;
        }

    </style>

    <script src="{{ asset('backend/dist/js/decimal.js') }}"></script>
    <script src="{{ asset('backend/dist/js/numeric-field.js') }}"></script>

  @endsection
