@extends('backend.layouts.master')

@section('section')

@include('backend.includes.datatables')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>{{ __('messages.Edit')}} {{ __('messages.EquipmentFamily.Family')}}</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('family-list') }}">{{ __('messages.Title.Equipment Families')}}</a></li>
              <li class="breadcrumb-item active">{{ __('messages.Edit')}} {{ __('messages.EquipmentFamily.Family')}}</li>
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

                                    @foreach ($result['equipmentFamily'] as $row => $r)

                                        <div class="col-sm-6">

                                            <div class="card card-secondary">

                                                <div class="card-header">
                                                    <h3 class="card-title">{{ __('messages.Description')}} </h3>
                                                </div>

                                                <div class="card-body">


                                                    <input type="hidden" name="id" value="{{ $r->id }}">


                                                    <div class="row">
                                                        <div class="col-sm-6">

                                                            <div class="form-group">
                                                                <label>{{__('messages.Name')}}</label>
                                                                <input type="text" name="name" id="name" class="form-control form-control-sm" value="{{ $r->name }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>{{__('messages.EquipmentGroup.Group')}}</label>
                                                                <select class="form-control form-control-sm" name="equipment_group_id" id="equipment_group_id">
                                                                    <option value="">{{__('messages.Select')}}</option>

                                                                    @foreach ($result['groupCombo'] as $row => $comb)
                                                                        <option value="{{ $comb['id'] }}"

                                                                            {{ $comb['id'] == $r->equipment_group_id ? 'selected' : '' }}

                                                                            >{{ $comb['name'] }}
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6">

                                                            <div class="form-group">
                                                                <label>{{__('messages.Type')}}</label>
                                                                <select class="form-control form-control-sm" name="type" id="type">
                                                                    <option value="">{{__('messages.Select')}}</option>
                                                                    <option value="1" {{ $r->type == 1 ? 'selected' : '' }}>VEÍCULO</option>
                                                                    <option value="0" {{ $r->type == 0 ? 'selected' : '' }}>EQUIPAMENTO</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>{{__('messages.EquipmentFamily.Conversion Factor')}}</label>
                                                                <input type="text" class="form-control form-control-sm" name="conversion_factor" id="conversion_factor"
                                                                {{-- @if("{{ Config::get('app.locale') }}" == 'pt_BR')
                                                                { --}}
                                                                value="{{ number_format($r->conversion_factor, 2, ',','.') }}"
                                                                onkeypress="return fc_decimal(this, '.', ',', event, 7);"
                                                                {{-- }
                                                                @else {
                                                                    value="{{ number_format($r->conversion_factor, 2) }}"
                                                                }
                                                                @endif --}}
                                                                >
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{__('messages.EquipmentFamily.Maximum Hour')}}</label>
                                                                <input type="text" class="form-control form-control-sm" name="maximum_hour" id="maximum_hour"
                                                                 {{-- @if("{{ Config::get('app.locale') }}" == 'pt_BR')
                                                                { --}}
                                                                value="{{ number_format($r->maximum_hour, 2, ',','.') }}"
                                                                onkeypress="return fc_decimal(this, '.', ',', event, 7);"
                                                                {{-- }
                                                                @else {
                                                                    value="{{ number_format($r->maximum_hour, 2) }}"
                                                                }
                                                                @endif --}}
                                                                >
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>



                                            </div>

                                        </div>

                                    @endforeach


                                    <div class="col-sm-6">

                                        <div class="card card-secondary">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('messages.Information requested when registering') }}</h3>
                                            </div>

                                            <div class="card-body">

                                                <div class="col-sm-12" style="padding: 5px;">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="has_model_year" id="has_model_year" {{ $r->has_model_year == 1 ? 'checked' : '' }} >
                                                        <label class="custom-control-label" for="has_model_year">{{__('messages.Equipment.Has Model Year')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12" style="padding: 5px;">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="has_tag" id="has_tag" {{ $r->has_tag == 1 ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="has_tag">{{__('messages.Equipment.Has Tag')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12" style="padding: 5px;">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="has_implement" id="has_implement" {{ $r->has_implement == 1 ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="has_implement">{{__('messages.Equipment.Has Implement')}}</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12" style="padding: 5px;">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" name="has_vin_number" id="has_vin_number" {{ $r->has_vin_number == 1 ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="has_vin_number">{{__('messages.Equipment.Has Vin Number')}}</label>
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
                                                <h3 class="card-title">{{ __('messages.Units of Measurement') }}</h3>
                                            </div>

                                            <div class="card-body">

                                                <div class="row">

                                                    <div    class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Weight Units') }}</label>
                                                            <select multiple class="filter-multi-select" name="weight_units[]" id="weight_units">
                                                                @foreach ($result['measurementWeight'] as $row => $r)
                                                                    <option value="{{ $r['id'] }}"

                                                                            @foreach ($result['familyMeasureWeight'] as $row => $fm)
                                                                                {{ $fm['measurement_unit_id'] == $r['id'] ? 'selected' : '' }}
                                                                            @endforeach

                                                                            >{{ $r['name'] }}

                                                                    </option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Capacity Units') }}</label>
                                                            <select multiple="" class="filter-multi-select" name="capacity_units[]" id="capacity_units">
                                                                @foreach ($result['measurementCapacity'] as $row => $r)
                                                                    <option value="{{ $r['id'] }}"

                                                                        @foreach ($result['familyMeasureCapacity'] as $row => $fm)
                                                                            {{ $fm['measurement_unit_id'] == $r['id'] ? 'selected' : '' }}
                                                                        @endforeach

                                                                        >{{ $r['name'] }}
                                                                    </option>

                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Power Supply') }}</label><br>
                                                            <select multiple="" class="filter-multi-select" name="power_supply[]" id="power_supply">
                                                                @foreach ($result['measurementPower'] as $row => $r)
                                                                    <option value="{{ $r['id'] }}"

                                                                        @foreach ($result['familyMeasurePower'] as $row => $fm)
                                                                            {{ $fm['measurement_unit_id'] == $r['id'] ? 'selected style="color:blue" ' : '' }}
                                                                        @endforeach
                                                                        >
                                                                        {{ $r['name'] }}
                                                                    </option>
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

                            <button type="submit" class="btn btn-sm btn-primary submit-form" id="create_new">
                                <i class="fa fa-save"></i>&nbsp;
                                {{ __('messages.Button.Update') }}
                            </button>

                            {{-- <button type="submit" class="btn btn-primary align-right" style="float:right;" id="btn-salve">
                                <i class="fa fa-save"></i>&nbsp;
                                {{ __('messages.Button.Save') }}
                            </button> --}}

                        </form>

                    </div>

                </div>

            </div>

      </div>


    </section>
    <!-- /.content -->


    <style>
        input, select { margin-bottom: 8px; }
    </style>


    <script>

        // ********* SAVING FORM **********
        $(".submit-form").click(function(e) {

            e.preventDefault();
            var data = $('#form-data').serialize();

            $.ajax({
                type: 'post',
                url: "{{ url('family/update/') }}",
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
                    toastr.success('O registro foi Atualizado!', "Sucesso!");

                    // SWEETALERT COM MENSAGEM
                    // Swal.fire({
                    //     position: "center",
                    //     icon: "success",
                    //     title: "Cadastrado com sucesso!",
                    //     showConfirmButton: true,
                    //     timer: 3500
                    // });

                },
                complete: function(response){
                    console.log('Updating...');
                },
                error: function(errors) {

                    // var message_erro = '{{ __('messages.Error.Required field not filled') }}: ';
                    // console.log('TODOS', errors.responseJSON);
                    // console.log('PARCIAL', errors.responseJSON.errors);

                    if(errors.responseJSON.errors.name) {
                        message_erro_aux = errors.responseJSON.errors.name[0];
                        message_erro = message_erro_aux.replace("name", "<b>{{ __('messages.Name') }}</b>")

                    } else if(errors.responseJSON.errors.equipment_group_id) {
                        message_erro_aux = errors.responseJSON.errors.equipment_group_id[0];
                        message_erro = message_erro_aux.replace("group", "<b>{{ __('messages.EquipmentGroup.Group') }}</b>")

                    } else if(errors.responseJSON.errors.type) {
                        message_erro_aux = errors.responseJSON.errors.type[0];
                        message_erro = message_erro_aux.replace("type", "<b>{{ __('messages.Type') }}</b>")

                    } else if(errors.responseJSON.errors.conversion_factor) {
                        message_erro_aux = errors.responseJSON.errors.conversion_factor[0];
                        message_erro = message_erro_aux.replace("conversion factor", "<b>{{ __('messages.EquipmentFamily.Conversion Factor') }}</b>")

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

    </script>

    <script src="{{ asset('backend/dist/js/decimal.js') }}"></script>


  @endsection
