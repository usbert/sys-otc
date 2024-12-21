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
                                                            <input type="text" name="street" id="street" class="form-control form-control-sm" maxlength="80">
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


         // ********* SAVING FORM **********
         $(".submit-form").click(function(e) {

            e.preventDefault();
            var data = $('#form-data').serialize();

            $.ajax({
                type: 'post',
                url: "{{ url('project/store/') }}",
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

                    $('#form-data')[0].reset();

                },
                complete: function(response){
                    console.log('Created New');
                },
                error: function(errors) {

                    // var message_erro = '{{ __('messages.Error.Required field not filled') }}: ';
                    // console.log('TODOS', errors.responseJSON);
                    // console.log('PARCIAL', errors.responseJSON.errors);

                    if(errors.responseJSON.errors.code) {
                        message_erro_aux = errors.responseJSON.errors.code[0];
                        message_erro = message_erro_aux.replace("code", "<b>{{ __('messages.Code') }}</b>")

                    } else if(errors.responseJSON.errors.name) {
                        message_erro_aux = errors.responseJSON.errors.name[0];
                        message_erro = message_erro_aux.replace("name", "<b>{{ __('messages.Name') }}</b>")

                    } else if(errors.responseJSON.errors.contract_number) {
                        message_erro_aux = errors.responseJSON.errors.contract_number[0];
                        message_erro = message_erro_aux.replace("contract number", "<b>{{ __('messages.Number') }}</b>")

                    } else if(errors.responseJSON.errors.client_id) {
                        message_erro_aux = errors.responseJSON.errors.client_id[0];
                        message_erro = message_erro_aux.replace("client id", "<b>{{ __('messages.Client') }}</b>")

                    } else if(errors.responseJSON.errors.trade_id) {
                        message_erro_aux = errors.responseJSON.errors.trade_id[0];
                        message_erro = message_erro_aux.replace("trade id", "<b>{{ __('messages.Trade') }}</b>")

                    } else if(errors.responseJSON.errors.project_manager) {
                        message_erro_aux = errors.responseJSON.errors.project_manager[0];
                        message_erro = message_erro_aux.replace("project manager", "<b>{{ __('messages.Project Manager') }}</b>")

                    } else if(errors.responseJSON.errors.signature_date) {
                        message_erro_aux = errors.responseJSON.errors.signature_date[0];
                        message_erro = message_erro_aux.replace("signature date", "<b>{{ __('messages.Signature Date') }}</b>")

                    } else if(errors.responseJSON.errors.start_date) {
                        message_erro_aux = errors.responseJSON.errors.start_date[0];
                        message_erro = message_erro_aux.replace("start date", "<b>{{ __('messages.Start Date') }}</b>")

                    } else if(errors.responseJSON.errors.finish_date) {
                        message_erro_aux = errors.responseJSON.errors.finish_date[0];
                        message_erro = message_erro_aux.replace("finish date", "<b>{{ __('messages.Finish Date') }}</b>")

                    } else if(errors.responseJSON.errors.contract_value) {
                        message_erro_aux = errors.responseJSON.errors.contract_value[0];
                        message_erro = message_erro_aux.replace("contract value", "<b>{{ __('messages.Contract Value') }}</b>")

                    } else if(errors.responseJSON.errors.street) {
                        message_erro_aux = errors.responseJSON.errors.street[0];
                        message_erro = message_erro_aux.replace("street", "<b>{{ __('messages.Street') }}</b>")

                    } else if(errors.responseJSON.errors.city) {
                        message_erro_aux = errors.responseJSON.errors.city[0];
                        message_erro = message_erro_aux.replace("city", "<b>{{ __('messages.City') }}</b>")

                    } else if(errors.responseJSON.errors.state) {
                        message_erro_aux = errors.responseJSON.errors.state[0];
                        message_erro = message_erro_aux.replace("state", "<b>{{ __('messages.State') }}</b>")

                    } else if(errors.responseJSON.errors.country) {
                        message_erro_aux = errors.responseJSON.errors.country[0];
                        message_erro = message_erro_aux.replace("country", "<b>{{ __('messages.Country') }}</b>")

                    } else if(errors.responseJSON.errors.zip_code) {
                        message_erro_aux = errors.responseJSON.errors.zip_code[0];
                        message_erro = message_erro_aux.replace("zip code", "<b>{{ __('messages.Zip Code') }}</b>")

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
