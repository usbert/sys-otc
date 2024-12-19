@extends('backend.layouts.master')

@section('section')

@include('backend.includes.datatables')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>{{ __('messages.Add New')}} {{ __('messages.Contract')}}</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('contract-list') }}">{{ __('messages.Contract')}}</a></li>
              <li class="breadcrumb-item active">{{ __('messages.Button.Add New')}} {{ __('messages.Contract')}}</li>
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

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Supplyer')}}</label>
                                                            <select class="form-control form-control-sm" name="supplyer_id" id="supplyer_id">
                                                                <option value="">{{__('messages.Select')}}</option>
                                                                @foreach ($result['supplyerCombo'] as $row => $r)
                                                                    <option value="{{ $r['id'] }}">{{ $r['name'] }}
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Project')}}</label>
                                                            <select class="form-control form-control-sm" name="project_id" id="project_id">
                                                                <option value="">{{__('messages.Select')}}</option>
                                                                @foreach ($result['projectCombo'] as $row => $r)
                                                                    <option value="{{ $r['id'] }}">{{ $r['short_name'] }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Type')}}</label>
                                                            <select class="form-control form-control-sm" name="type" id="type" onclick="changeField()">
                                                                <option value="1">{{ strtoupper(__('messages.Contract')) }}</option>
                                                                <option value="2">{{ strtoupper(__('messages.Order')) }}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row" id="div_contract">

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Number')}} {{__('messages.Contract')}}</label>
                                                            <input type="text" name="contract_number" id="contract_number" class="form-control form-control-sm" maxlength="30">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Year')}}</label>
                                                            <select class="form-control form-control-sm" name="contract_year" id="contract_year">
                                                                @for ($af=2024; $af>=2020; $af--)
                                                                    <option value="{{ $af }}">{{ $af }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row" id="div_order" style="display: none;">

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Number')}} {{__('messages.Order')}}</label>
                                                            <input type="text" name="order_number" id="order_number" class="form-control form-control-sm" maxlength="30">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Year')}}</label>
                                                            <select class="form-control form-control-sm" name="order_year" id="order_year">
                                                                @for ($af=2024; $af>=2020; $af--)
                                                                    <option value="{{ $af }}">{{ $af }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>


                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.Start Date') }}</label>
                                                            <input type="date" name="contract_start_date" id="contract_start_date" class="form-control form-control-sm">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{ __('messages.End Date') }}</label>
                                                            <input type="date" name="contract_end_date" id="contract_end_date" class="form-control form-control-sm">
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
                url: "{{ url('contract/store/') }}",
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

                    if(errors.responseJSON.errors.supplyer_id) {
                        message_erro_aux = errors.responseJSON.errors.supplyer_id[0];
                        message_erro = message_erro_aux.replace("supplyer id", "<b>{{ __('messages.Supplyer') }}</b>")

                    } else if(errors.responseJSON.errors.project_id) {
                        message_erro_aux = errors.responseJSON.errors.project_id[0];
                        message_erro = message_erro_aux.replace("project id", "<b>{{ __('messages.Project') }}</b>")

                    } else if(errors.responseJSON.errors.contract_number) {
                        message_erro_aux = errors.responseJSON.errors.contract_number[0];
                        message_erro = message_erro_aux.replace("contract number", "<b>{{ __('messages.Number') }} {{ __('messages.Contract') }}</b>")

                    } else if(errors.responseJSON.errors.order_number) {
                        message_erro_aux = errors.responseJSON.errors.order_number[0];
                        message_erro = message_erro_aux.replace("order number", "<b>{{ __('messages.Number') }} {{ __('messages.Order') }}</b>")

                    } else if(errors.responseJSON.errors.contract_start_date) {
                        message_erro_aux = errors.responseJSON.errors.contract_start_date[0];
                        message_erro = message_erro_aux.replace("contract start date", "<b>{{ __('messages.Start Date') }}</b>")

                    } else if(errors.responseJSON.errors.contract_end_date) {
                        message_erro_aux = errors.responseJSON.errors.contract_end_date[0];
                        message_erro = message_erro_aux.replace("contract end date", "<b>{{ __('messages.End Date') }}</b>")

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


        function changeField() {

            console.log(document.getElementById("type").value);

            setTimeout(function() {

                if(document.getElementById("type").value == 1) {
                    document.getElementById("div_contract").style.display = "";
                    document.getElementById("div_order").style.display = "none";
                } else {
                    document.getElementById("div_contract").style.display = "none";
                    document.getElementById("div_order").style.display = "";
                }

            }, 120);


        }

</script>


  @endsection
