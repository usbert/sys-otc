@extends('backend.layouts.master')

@section('section')

@include('backend.includes.datatables')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>{{ __('messages.Add New')}} {{ __('messages.Title.Field Activies')}}</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('field-activity-list') }}">{{ __('messages.Title.Field Activies')}}</a></li>
              <li class="breadcrumb-item active">{{ __('messages.Button.Add New')}} {{ __('messages.Title.Field Activies')}}</li>
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

                                                        <div class="form-group">
                                                            <label>{{__('messages.Code')}}</label>
                                                            <input type="text" name="code" id="code" class="form-control form-control-sm" maxlength="30">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="row">

                                                    <div class="col-sm-4">

                                                        <div class="form-group">
                                                            <label>{{__('messages.Name')}}</label>
                                                            <input type="text" name="name" id="name" class="form-control form-control-sm" maxlength="80">
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
                url: "{{ url('field-activity/store/') }}",
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
                    toastr.success('O registro cadastrado com sucesso!', "Sucesso!");

                    $('#form-data')[0].reset();

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
                    console.log('Created New');
                },
                error: function(errors) {

                    var eror_display = '{{ __('messages.Error.Required field not filled') }}: ';

                    console.log(errors.responseJSON.errors);

                    if(errors.responseJSON.errors.code) {
                        eror_display += "<b>{{ __('messages.Code')}}</b>";

                    } else if(errors.responseJSON.errors.name) {
                        eror_display += "<b>{{ __('messages.Name')}}</b>";

                    } else {
                        var eror_display = errors.responseJSON.errors;
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
                    toastr.error(eror_display, "Atenção!");
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
