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
            <h4>{{ __('messages.Edit')}} {{ __('messages.Equipment.Equipment Registration')}} - <span id="prefixTitle"></span></h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('vehicle-list') }}">{{ __('messages.Equipments') }}</a></li>
              <li class="breadcrumb-item active">{{ __('messages.Edit')}} {{ __('messages.Equipment.Equipment Registration')}}</li>
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

                                    @foreach ($result['vehicle'] as $row => $r)

                                        <div class="col-sm-12">

                                            <div class="card card-secondary">

                                                <div class="card-header">
                                                    <h3 class="card-title">{{ __('messages.Model')}} </h3>
                                                </div>

                                                <div class="card-body">
                                                    <input type="hidden" name="id" value="{{ $r->id }}">
                                                    <input type="hidden" name="model_id" id="model_id" value="{{ $r->model_id }}">

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
                                                                        <input type="text" name="type" id="type" class="form-control form-control-sm" @readonly(true) value="{{ $r->type }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-1">
                                                                <div class="form-group">
                                                                    <label>{{ __('messages.Literage') }}</label>
                                                                    <div class="form-group">
                                                                        <input type="text" name="tank_capacity" id="tank_capacity" class="form-control form-control-sm"
                                                                            value="{{ number_format($r->tank_capacity, 2, ',','.') }}"
                                                                            onkeypress="return fc_decimal(this, '.', ',', event, 5);"
                                                                            @cannot('is_admin')
                                                                                @readonly(true)
                                                                            @endcannot
                                                                         >
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>{{ __('messages.Status') }}</label>
                                                                    <div class="form-group">
                                                                        <input type="text" name="status" id="status" class="form-control form-control-sm"
                                                                            @readonly(true) value="{{ $r->status_name }}"
                                                                            @if($r->status_id == 1)
                                                                                style="border-color: blue";
                                                                            @elseif ($r->status_id == 2)
                                                                                style="border-color: red";
                                                                            @endif
                                                                        >
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

                                                            @php $prefixTitle = $r->prefix; @endphp

                                                            <div class="col-sm-1">
                                                                <div class="form-group">
                                                                    <label>{{__('messages.Prefix.Prefix')}}</label>
                                                                    <input type="text" name="prefix" id="prefix" class="form-control form-control-sm" style="color: navy; font-weight: bold;" value="{{ $r->prefix }}" @readonly(true)>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-1">
                                                                <div class="form-group">
                                                                    <label>{{ __('messages.Equipment.Tag') }}</label>
                                                                    <input type="text" name="tag" id="tag" class="form-control form-control-sm" maxlength="8" style="width: 100%;" value="{{ $r->tag }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>Renavam</label>
                                                                    <input type="text" name="renavam" id="renavam" class="form-control form-control-sm"  maxlength="30"
                                                                        value="{{ $r->renavam }}"
                                                                        onkeypress="return isNumberKey(event)"
                                                                    >
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>{{ __('messages.Equipment.Vin Number') }}</label>
                                                                    <input type="text" name="vin_number" id="vin_num" class="form-control form-control-sm"
                                                                    value="{{ $r->vin_number }}"
                                                                    >
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>{{__('messages.Equipment.Manufacture Year')}}</label>
                                                                    <select class="form-control form-control-sm" name="manufacture_year" id="manufacture_year">
                                                                        <option value="">{{__('messages.Select')}}</option>
                                                                        @for ($af=1985; $af<=2024; $af++)
                                                                            <option value="{{ $af }}"
                                                                                {{ $af == $r->manufacture_year ? 'selected' : '' }}
                                                                            >{{ $af }}</option>
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
                                                                            <option value="{{ $am }}"
                                                                                {{ $am == $r->manufacture_year ? 'selected' : '' }}
                                                                            >{{ $am }}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row">

                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>{{ __('messages.Supplyer') }}</label>

                                                                    @if($result['has_contract'] > 0)
                                                                        <input type="text" class="form-control form-control-sm" value="{{ $r->supplyer_name }}" @readonly(true)>
                                                                    @else
                                                                        <select class="form-control form-control-sm" name="supplyer_id" id="supplyer_id">
                                                                            <option value="">-- {{__('messages.Select')}} --</option>
                                                                            @foreach ($result['supplyerCombo'] as $supplyer)
                                                                                <option value="{{ $supplyer->id }}"
                                                                                    {{ $supplyer->id == $r->supplyer_id ? 'selected' : '' }}
                                                                                    >{{ $supplyer->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>{{ __('messages.Fuel') }}</label>
                                                                    <select class="form-control form-control-sm" name="fuel_id" id="fuel_id">
                                                                        <option value="">-- {{__('messages.Select')}} --</option>
                                                                        @foreach ($result['fuelCombo'] as $fuel)
                                                                            <option value="{{ $fuel->id }}"
                                                                                {{ $fuel->id == $r->fuel_id ? 'selected' : '' }}
                                                                            >{{ $fuel->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>{{ __('messages.Project') }}</label>
                                                                    @can('is_admin')
                                                                        <select class="form-control form-control-sm" name="project_id" id="project_id" onclick="fcLoadRelationships()">
                                                                            <option value="">-- {{__('messages.Select')}} --</option>
                                                                            @foreach ($result['projectCombo'] as $project)
                                                                                <option value="{{ $project->id }}"
                                                                                    {{ $project->id == $r->project_id ? 'selected' : '' }}
                                                                                >{{ $project->short_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    @else
                                                                        <input type="hidden" name="project_id" id="project_id" value="{{ $r->project_id }}">
                                                                        <input type="text" class="form-control form-control-sm" value="{{ $r->project_short_name }}" @readonly(true)>
                                                                    @endcan
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
                                                                    <label>{{ __('messages.Unit Measure') }}</label>
                                                                    <input type="text" name="unit_measure" id="unit_measure" class="form-control form-control-sm" value="{{ $r->unit_measure }}" @readonly(true)>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>{{ __('messages.Equipment.Telemetry Number') }}</label>
                                                                    <input type="text" name="telemetry_number" id="telemetry_number" class="form-control form-control-sm"
                                                                        value="{{ $r->telemetry_number }}"
                                                                        onkeypress="return isNumberKey(event)"
                                                                        @cannot('is_admin')
                                                                            @readonly(true)
                                                                        @endcannot
                                                                    >
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>{{ __('messages.Equipment.Telemetry Date') }}</label>
                                                                    <input type="date" name="telemetry_install_date" id="telemetry_install_date" class="form-control form-control-sm"
                                                                        value="{{ substr($r->telemetry_install_date,0,10) }}"
                                                                        @cannot('is_admin')
                                                                            @readonly(true)
                                                                        @endcannot
                                                                    >
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>{{ __('messages.Equipment.Telemetry Uninstall Date') }}</label>
                                                                    <input type="date" name="telemetry_uninstall_date" id="telemetry_uninstall_date" class="form-control form-control-sm"
                                                                        value="{{ substr($r->telemetry_uninstall_date,0,10) }}"
                                                                        @cannot('is_admin')
                                                                            @readonly(true)
                                                                        @endcannot
                                                                    >
                                                                </div>
                                                            </div>

                                                            @can('is_admin')
                                                                <div class="col-sm-2">
                                                                    <div class="form-group">

                                                                        <label>{{ __('messages.Equipment.Has KPI Report') }}</label>
                                                                        <select class="form-control form-control-sm" name="has_kpi_report" id="has_kpi_report">
                                                                            <option value="">{{ __('messages.Select') }}</option>
                                                                            <option value="1"  {{ $r->has_kpi_report == 1 ? 'selected' : '' }} >{{ __('messages.YES') }}</option>
                                                                            <option value="0"  {{ $r->has_kpi_report == 0 ? 'selected' : '' }} >{{ __('messages.NO') }}</option>
                                                                        </select>

                                                                    </div>
                                                                </div>
                                                            @endcan

                                                        </div>


                                                        @can('is_admin')

                                                            <div class="row">

                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                        <label>{{ __('messages.Equipment.Rental Cost') }}</label>
                                                                        <div class="form-group">
                                                                            <input type="text" name="rental_cost" id="rental_cost" class="form-control form-control-sm"
                                                                                value="{{ number_format($r->rental_cost, 2, ',','.') }}"
                                                                                onkeypress="return fc_decimal(this, '.', ',', event, 5);"
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                @php
                                                                    $implement_value = number_format($r->implement_value, 2, ',','.');
                                                                    $body_value = number_format($r->body_value, 2, ',','.');
                                                                    if($r->has_implement == 1) {
                                                                        $noneImpl = '';
                                                                    } else {
                                                                        $noneImpl = 'none';
                                                                    }
                                                                @endphp

                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                        <label>{{ __('messages.Equipment.Has Implement') }}</label>
                                                                        <select class="form-control form-control-sm" name="has_implement" id="has_implement"
                                                                            onclick="fcHasImplement('{{ $implement_value }}', '{{ $body_value }}')">
                                                                            <option value="1"  {{ $r->has_implement == 1 ? 'selected' : '' }} >{{ __('messages.YES') }}</option>
                                                                            <option value="0"  {{ $r->has_implement == 0 ? 'selected' : '' }} >{{ __('messages.NO') }}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-2" id="divImplement" style="display: {{ $noneImpl }};">
                                                                    <div class="form-group">
                                                                        <label>{{ __('messages.Equipment.Implement Value') }}</label>
                                                                        <div class="form-group">
                                                                            <input type="text" name="implement_value" id="implement_value" class="form-control form-control-sm"
                                                                                value="{{ $implement_value }}"
                                                                                onkeypress="return fc_decimal(this, '.', ',', event, 9);"
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2" id="divBodywork">
                                                                    <div class="form-group">
                                                                        <label>{{ __('messages.Equipment.Equipment/Bodywork Value') }}</label>
                                                                        <div class="form-group">
                                                                            <input type="text" name="body_value" id="body_value" class="form-control form-control-sm"
                                                                                value="{{ number_format($r->body_value, 2, ',','.') }}"
                                                                                onkeypress="return fc_decimal(this, '.', ',', event, 9);"
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                        <label>{{ __('messages.Equipment.Has Daily Control') }}</label>
                                                                        <select class="form-control form-control-sm" name="has_daily_control" id="has_daily_control">
                                                                            <option value="">{{ __('messages.Select') }}</option>
                                                                            <option value="1"  {{ $r->has_daily_control == 1 ? 'selected' : '' }} >{{ __('messages.YES') }}</option>
                                                                            <option value="0"  {{ $r->has_daily_control == 0 ? 'selected' : '' }} >{{ __('messages.NO') }}</option>
                                                                        </select>

                                                                    </div>
                                                                </div>

                                                            </div>

                                                        @endcan

                                                        <div class="row">
                                                            <div class="col-sm-8">
                                                                <div class="form-group">
                                                                    <label>{{ __('messages.Additional Information') }}</label>
                                                                    <input type="text" name="comment" id="comment" class="form-control form-control-sm" value="{{ $r->comment }}" maxilengt="255">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <button type="submit" class="btn btn-sm btn-primary submit-form" id="create_new">
                                                    <i class="fa fa-save"></i>&nbsp;
                                                    {{ __('messages.Button.Save') }}
                                                </button>

                                                <div class="panel" style="margin-top: 20px;">
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
                                                                        <div class="col-md-12 tab-pane fade show active" id="tab1">

                                                                            {{-- DATATABLE WIDTH MODELS --}}
                                                                            <table style="font-size: 14px" class="table table-striped table-sm display compact responsive" id="ajax-crud-datatable">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">{{ __('messages.Project') }}</th>
                                                                                        <th scope="col">{{ __('messages.Mobilization Date') }}</th>
                                                                                        <th scope="col">Km {{ __('messages.Arrival') }}</th>
                                                                                        <th scope="col">H. {{ __('messages.Arrival') }}</th>
                                                                                        <th scope="col">Dt. {{ __('messages.Demobilization') }}</th>
                                                                                        <th scope="col">Km {{ __('messages.Devolution') }}</th>
                                                                                        <th scope="col">H. {{ __('messages.Devolution') }}</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>

                                                                                    @foreach ($result['mobilizationHistoric'] as $row => $hist)
                                                                                        <tr>
                                                                                            <td style="width: 20%;">{{ $hist['short_name'] }}</td>
                                                                                            <td style="width: 12%;">
                                                                                                {{ $hist['mobilization_date'] > '' ? str_replace("-","/", $hist['mobilization_date']) : '' }}
                                                                                            </td>
                                                                                            <td style="width: 15%;">
                                                                                                {{ $hist['km_control'] > '' ? number_format($hist['km_control'], 2, ',','.') : '' }}
                                                                                            </td>
                                                                                            <td style="width: 15%;">
                                                                                                {{ $hist['hour_control'] > '' ? number_format($hist['hour_control'], 2, ',','.') : '' }}
                                                                                            </td>
                                                                                            <td style="width: 12%;">
                                                                                                {{ $hist['demobilization_date'] > '' ? str_replace("-","/", $hist['demobilization_date']) : '' }}
                                                                                            </td>
                                                                                            <td style="width: 15%;">
                                                                                                {{ $hist['km_return'] > '' ? number_format($hist['km_return'], 2, ',','.') : '' }}
                                                                                            </td>
                                                                                            <td style="width: 15%;">
                                                                                                {{ $hist['hour_control_return'] > '' ? number_format($hist['hour_control_return'], 2, ',','.') : '' }}
                                                                                            </td>
                                                                                            {{-- <td style="width: 26%; font-weight: bold">{{ strtoupper( $hist['NOME DO PIÃO']) }}</td> --}}
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>

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

                                    @endforeach

                                </div>


                            </div>



                        </form>

                    </div>

                </div>

            </div>

      </div>


    </section>
    <!-- /.content -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>

        // function showCont(i) {
        //     if(i == 1) {

        //         $('[href="#tab1"]').tab('show');

        //         $("#tab1").css("display", "");
        //         document.getElementById("titHead").innerHTML = "{{ __('messages.Select the model of equipment you want to register') }}";

        //     } else if(i == 2) {

        //         $('[href="#tab2"]').tab('show');

        //         if(document.getElementById("model_id").value > '') {
        //             document.getElementById("titHead").innerHTML = "{{ __('messages.Selected Model') }}";
        //         }

        //     }
        // }


        // ENVIAR OS DADOS DO MODELO SELECIONADO PARA O USUÁRIO VISUALIZAR NA TAB2
        function fcCheckModel(id) {

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
                        document.getElementById("description").value = model.equipment_prefix.name;
                        document.getElementById("brand").value = model.brand.name;
                        document.getElementById("model").value = model.name;
                        document.getElementById("family").value = model.equipment_family.name;
                        document.getElementById("weight_measurment").value = model.weight_measurment;
                        document.getElementById("capacity_measurment").value = model.capacity_measurment;
                        document.getElementById("power_measurment").value = model.power_measurment;

                        if(document.getElementById("type").value == 1) {
                            document.getElementById("type").value = 'VEÍCULO';
                        } else {
                            document.getElementById("type").value = 'EQUIPAMENTO';
                        }

                        // showCont(2);

                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        }


        function fcLoadRelationships() {

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

                    if(errors.responseJSON.errors.tag) {
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

        function fcHasImplement(implement_value, body_value) {

            if(document.getElementById("has_implement").value > '') {

                if(document.getElementById("has_implement").value == 1) {
                    document.getElementById("implement_value").value = implement_value;
                    // document.getElementById("body_value").value = body_value;
                    document.getElementById("divImplement").style.display = "";
                    // document.getElementById("divBodywork").style.display = "";

                } else {
                    document.getElementById("implement_value").value = '';
                    // document.getElementById("body_value").value = '';
                    document.getElementById("divImplement").style.display = "none";
                    // document.getElementById("divBodywork").style.display = "none";

                }

            }

        }

        $(function() {
            $('input').keyup(function() {
                this.value = this.value.toLocaleUpperCase();
            });
        });

        setTimeout(function() {
            $model_id = document.getElementById("model_id").value;

            fcCheckModel($model_id);
            fcLoadRelationships();

            document.getElementById("prefixTitle").innerHTML = '{{ $prefixTitle }}';

		}, 120);

    </script>




  </head>


    <style>
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
