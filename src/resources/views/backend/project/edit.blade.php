@extends('backend.layouts.master')

@section('section')

@include('backend.includes.datatables')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>{{ __('messages.Edit')}} {{ __('messages.Project')}}</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('project-list') }}">{{ __('messages.Projects')}}</a></li>
              <li class="breadcrumb-item active">{{ __('messages.Edit')}} {{ __('messages.Project')}}</li>

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

                                    @foreach ($result['project'] as $row => $r)

                                    <div class="col-sm-12">

                                        <div class="card card-secondary">

                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('messages.Description')}} </h3>
                                            </div>

                                            <div class="card-body">

                                                <input type="hidden" name="id" value="{{ $r->id }}">

                                                <div class="row">





                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Project Description')}}</label>
                                                            <input type="text" name="name" id="name" class="form-control form-control-sm" maxlength="120" value="{{ $r->name }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Prefix.Prefix')}}</label>
                                                            <input type="text" name="prefix_code" id="prefix_code" class="form-control form-control-sm" maxlength="5" value="{{ $r->prefix_code }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Cost Center')}}</label>
                                                            <input type="text" name="cost_center" id="cost_center" class="form-control form-control-sm" maxlength="15" value="{{ $r->cost_center }}">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    </div>

                                    @endforeach

                                </div>

                            </div>


                            <div class="row">

                                <div class="col-sm-12">

                                    <div class="card card-secondary">

                                        <div class="card-header">
                                            <h3 class="card-title">{{ __('messages.Activities') }} {{ __('messages.and') }} {{ __('messages.Prefix.Prefixes') }}</h3>
                                        </div>

                                        <div class="card-body">

                                            <div class="row">

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>{{ __('messages.Project Activities') }}</label>
                                                        <select multiple class="filter-multi-select" name="field_activity[]" id="field_activity">
                                                            @foreach ($result['fieldActivity'] as $row => $r)

                                                                <option value="{{ $r['id'] }}"

                                                                    @foreach ($result['projectActivities'] as $row => $fm)
                                                                        {{ $fm['field_activity_id'] == $r['id'] ? 'selected' : '' }}
                                                                    @endforeach

                                                                    >{{ $r['code'] }} - {{ $r['name'] }}

                                                                </option>


                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>{{ __('messages.Supervisors') }}</label>
                                                        <select multiple="" class="filter-multi-select" name="supervisor[]" id="supervisor">
                                                            @foreach ($result['supervisor'] as $row => $r)
                                                            <option value="{{ $r['id'] }}"

                                                            @foreach ($result['project_supervisors'] as $row => $fm)
                                                                {{ $fm['supervisor_id'] == $r['id'] ? 'selected' : '' }}
                                                            @endforeach

                                                            >{{ $r['name'] }}

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
                url: "{{ url('project/update/') }}",
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

                    if(errors.responseJSON.errors.short_name) {
                        message_erro_aux = errors.responseJSON.errors.short_name[0];
                        message_erro = message_erro_aux.replace("short name", "<b>{{ __('messages.Project') }}</b>")

                    } else if(errors.responseJSON.errors.name) {
                        message_erro_aux = errors.responseJSON.errors.name[0];
                        message_erro = message_erro_aux.replace("nome", "<b>{{ __('messages.Project Description') }}</b>")

                    } else if(errors.responseJSON.errors.prefix_code) {
                        message_erro_aux = errors.responseJSON.errors.prefix_code[0];
                        message_erro = message_erro_aux.replace("prefix code", "<b>{{ __('messages.Prefix.Prefix') }}</b>")

                    } else if(errors.responseJSON.errors.cost_center) {
                        message_erro_aux = errors.responseJSON.errors.cost_center[0];
                        message_erro = message_erro_aux.replace("cost center", "<b>{{ __('messages.Cost Center') }}</b>")
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

    </script>


@endsection
