@extends('backend.layouts.master')

@section('section')

@include('backend.includes.datatables')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>{{ __('messages.Edit')}} {{ __('messages.Equipment.Model')}}</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('model-list') }}">{{ __('messages.Title.Equipment Models')}}</a></li>
              <li class="breadcrumb-item active">{{ __('messages.Edit')}} {{ __('messages.Equipment.Model')}}</li>
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

                                    @foreach ($result['equipmentModel'] as $row => $r)

                                        <div class="col-sm-12">

                                            <div class="card card-secondary">

                                                <div class="card-header">
                                                    <h3 class="card-title">{{ __('messages.Description')}} </h3>
                                                </div>

                                                <div class="card-body">

                                                    <input type="hidden" name="id" value="{{ $r->id }}">

                                                    <div class="row">

                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Equipment.Model')}}</label>
                                                                <select class="form-control form-control-sm" name="equipment_prefix_id" id="equipment_prefix_id" onclick="fillPrefix()">
                                                                    <option value="">{{__('messages.Select')}}</option>
                                                                    @foreach ($result['equipmentPrefixCombo'] as $row)
                                                                        <option value="{{ $row->id }}"
                                                                            {{ $row->id == $r->equipment_prefix_id ? 'selected' : '' }}
                                                                            >
                                                                            {{ $row->prefix }} - {{ $row->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-1">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Prefix.Prefix')}}</label>
                                                                <input type="text" name="prefix" id="prefix" class="form-control form-control-sm" readonly="readonly" value="{{ $r->prefix }}">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Brand')}}</label>
                                                                <select class="form-control form-control-sm" name="equipment_brand_id" id="equipment_brand_id">
                                                                    <option value="">{{__('messages.Select')}}</option>
                                                                    @foreach ($result['equipmentBrandCombo'] as $row)
                                                                        <option value="{{ $row->id }}"
                                                                            {{ $row->id == $r->equipment_brand_id ? 'selected' : '' }}
                                                                        >{{ $row->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>{{__('messages.EquipmentFamily.Family')}}</label>
                                                                <select class="form-control form-control-sm" name="equipment_family_id" id="equipment_family_id">
                                                                    <option value="">{{__('messages.Select')}}</option>
                                                                    @foreach ($result['equipmentFamilyCombo'] as $row)
                                                                        <option value="{{ $row->id }}"
                                                                            {{ $row->id == $r->equipment_family_id ? 'selected' : '' }}
                                                                            >{{ $row->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Equipment.Model Description')}}</label>
                                                                <input type="text" name="name" id="name" class="form-control form-control-sm" value="{{ $r->name }}">
                                                            </div>
                                                        </div>

                                                    </div>


                                                </div>

                                            </div>

                                        </div>


                                     @endforeach

                                </div>


                                <div class="row">

                                    <div class="col-sm-12">

                                        <div class="card card-secondary">

                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('messages.Units of Measurement') }}</h3>
                                            </div>

                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-sm-1">

                                                        <div class="form-group">
                                                            <label>{{__('messages.Weight')}}</label>
                                                            <input type="text" name="weight_measurment" id="weight_measurment" class="form-control form-control-sm"
                                                            value="{{ number_format($r->weight_measurment, 2, ',','.') }}"
                                                            maxlength="6"
                                                            {{-- @if("{{ Config::get('app.locale') }}" == 'pt_BR')
                                                            { --}}
                                                            onkeypress="return fc_decimal(this, '.', ',', event, 7);"
                                                            {{-- }
                                                            @else {
                                                                onkeypress="return fc_formatar_moeda(this,',','.',event, 7);"
                                                            }
                                                            @endif --}}
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            <select class="form-control form-control-sm" name="unit1" id="unit1">
                                                                <option value=""></option>
                                                                @foreach ($result['measurementUnit1'] as $row)
                                                                    <option value="{{ $row->name }}"
                                                                        {{ $row->name == $r->unit1 ? 'selected' : '' }}
                                                                        >{{ $row->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Capacity')}}</label>
                                                            <input type="text" name="capacity_measurment" id="capacity_measurment" class="form-control form-control-sm"
                                                            value="{{ number_format($r->capacity_measurment, 2, ',','.') }}"
                                                            {{-- @if("{{ Config::get('app.locale') }}" == 'pt_BR')
                                                            { --}}
                                                            onkeypress="return fc_decimal(this, '.', ',', event, 7);"
                                                            {{-- }
                                                            @else {
                                                                onkeypress="return fc_formatar_moeda(this,',','.',event, 7);"
                                                            }
                                                            @endif --}}
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            <select class="form-control form-control-sm" name="unit2" id="unit2">
                                                                <option value=""></option>
                                                                @foreach ($result['measurementUnit2'] as $row)
                                                                    <option value="{{ $row->name }}"
                                                                        {{ $row->name == $r->unit2 ? 'selected' : '' }}
                                                                        >{{ $row->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Power')}}</label>
                                                            <input type="text" name="power_measurment" id="power_measurment" class="form-control form-control-sm"
                                                            value="{{ number_format($r->power_measurment, 2, ',','.') }}"
                                                            {{-- @if("{{ Config::get('app.locale') }}" == 'pt_BR')
                                                            { --}}
                                                            onkeypress="return fc_decimal(this, '.', ',', event, 7);"
                                                            {{-- }
                                                            @else {
                                                                onkeypress="return fc_formatar_moeda(this,',','.',event, 7);"
                                                            }
                                                            @endif --}}
                                                            >
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            <select class="form-control form-control-sm" name="unit3" id="unit3">
                                                                <option value=""></option>
                                                                @foreach ($result['measurementUnit3'] as $row)
                                                                    <option value="{{ $row->name }}"
                                                                        {{ $row->name == $r->unit3 ? 'selected' : '' }}
                                                                        >{{ $row->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Tank Capacity')}}</label>
                                                            <input type="text" name="tank_capacity" id="tank_capacity" class="form-control form-control-sm"
                                                            value="{{ number_format($r->tank_capacity, 2, ',','.') }}"
                                                            onkeypress="return fc_decimal(this, '.', ',', event, 7);"
                                                            >
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
                url: "{{ url('model/update/') }}",
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

                    toastr.success("<b>{{ __('messages.Successfully recorded') }}!</b>", "{{ __('messages.Success') }}!");

                },
                complete: function(response){
                    console.log('Created New');
                },
                error: function(errors) {

                    // var message_erro = '{{ __('messages.Error.Required field not filled') }}: ';
                    // console.log('TODOS', errors.responseJSON);
                    // console.log('PARCIAL', errors.responseJSON.errors);

                    if(errors.responseJSON.errors.equipment_prefix_id) {
                        message_erro_aux = errors.responseJSON.errors.equipment_prefix_id[0];
                        message_erro = message_erro_aux.replace("equipment prefix id", " <b>{{__('messages.Equipment.Model')}}</b>")


                    } else if(errors.responseJSON.errors.prefix) {
                        message_erro_aux = errors.responseJSON.errors.prefix[0];
                        message_erro = message_erro_aux.replace("prefix", " <b>{{__('messages.Prefix.Prefix')}}</b>")

                    } else if(errors.responseJSON.errors.equipment_brand_id) {
                        message_erro_aux = errors.responseJSON.errors.equipment_brand_id[0];
                        message_erro = message_erro_aux.replace("equipment brand id", " <b>{{__('messages.Brand')}}</b>")

                    } else if(errors.responseJSON.errors.equipment_family_id) {
                        message_erro_aux = errors.responseJSON.errors.equipment_family_id[0];
                        message_erro = message_erro_aux.replace("equipment family id", " <b>{{__('messages.EquipmentFamily.Family')}}</b>")

                    } else if(errors.responseJSON.errors.name) {
                        message_erro_aux = errors.responseJSON.errors.name[0];
                        message_erro = message_erro_aux.replace("nome", "<b>{{ __('messages.Equipment.Model Description') }}</b>")

                    } else if(errors.responseJSON.errors.weight_measurment) {
                        message_erro_aux = errors.responseJSON.errors.weight_measurment[0];
                        message_erro = message_erro_aux.replace("weight measurment", "<b>{{ __('messages.Weight') }}</b>")

                    } else if(errors.responseJSON.errors.unit1) {
                        message_erro_aux = errors.responseJSON.errors.unit1[0];
                        message_erro = message_erro_aux.replace("unit1", "<b>{{ __('messages.Weight') }}</b>")

                    } else if(errors.responseJSON.errors.capacity_measurment) {
                        message_erro_aux = errors.responseJSON.errors.capacity_measurment[0];
                        message_erro = message_erro_aux.replace("capacity measurment", "<b>{{ __('messages.Capacity') }}</b>")

                    } else if(errors.responseJSON.errors.unit2) {
                        message_erro_aux = errors.responseJSON.errors.unit2[0];
                        message_erro = message_erro_aux.replace("unit2", "<b>{{ __('messages.Capacity') }}</b>")

                    } else if(errors.responseJSON.errors.power_measurment) {
                        message_erro_aux = errors.responseJSON.errors.power_measurment[0];
                        message_erro = message_erro_aux.replace("power measurment", "<b>{{ __('messages.Power') }}</b>")

                    } else if(errors.responseJSON.errors.unit3) {
                        message_erro_aux = errors.responseJSON.errors.unit3[0];
                        message_erro = message_erro_aux.replace("unit3", "<b>{{ __('messages.Power') }}</b>")

                    } else if(errors.responseJSON.errors.tank_capacity) {
                        message_erro_aux = errors.responseJSON.errors.tank_capacity[0];
                        message_erro = message_erro_aux.replace("tank capacity", "<b>{{ __('messages.Tank Capacity') }}</b>")

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

        function fillPrefix() {
            if(document.getElementById("equipment_prefix_id").value > '') {
                var tri = $("#equipment_prefix_id option:selected").text();
                document.getElementById("prefix").value = tri.substr(0,3);
            }

        }

    </script>

    <script src="{{ asset('backend/dist/js/decimal.js') }}"></script>

@endsection
