@extends('backend.layouts.master')

@section('section')

@include('backend.includes.datatables')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h4>{{ __('messages.Edit')}} {{ __('messages.Clients')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('client-list') }}">{{ __('messages.Clients')}}</a></li>
            <li class="breadcrumb-item active">{{ __('messages.Edit')}} {{ __('messages.Clients')}}</li>
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

                                @foreach ($result['client'] as $row => $r)


                                    <input type="hidden" name="id" value="{{ $r->id }}">

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card card-secondary">

                                                <div class="card-header">
                                                    <h3 class="card-title">Description</h3>
                                                </div>
                                                <div class="card-body">

                                                    <div class="row">

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Name')}}</label>
                                                                <input type="text" name="name" id="name" class="form-control form-control-sm" maxlength="80" value="{{ $r->name }}">
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
                                                                <input type="text" name="address" id="address" class="form-control form-control-sm" maxlength="80" value="{{ $r->address }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{__('messages.City')}}</label>
                                                                <input type="text" name="city" id="city" class="form-control form-control-sm" maxlength="50" value="{{ $r->city }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{__('messages.State')}}</label>
                                                                <input type="text" name="state" id="state" class="form-control form-control-sm" maxlength="50" value="{{ $r->state }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Country')}}</label>
                                                                <input type="text" name="country" id="country" class="form-control form-control-sm" maxlength="50" value="{{ $r->country }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-1">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Zip Code')}}</label>
                                                                <input type="text" name="zip_code" id="zip_code" class="form-control form-control-sm" maxlength="20" value="{{ $r->zip_code }}"
                                                                onkeypress="return isNumberKey(event)"
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
                                                    <h3 class="card-title">{{__('messages.Contact')}}</h3>
                                                </div>
                                                <div class="card-body">

                                                    <div class="row">

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Phone')}}</label>
                                                                <input type="text" name="phone" id="phone" class="form-control form-control-sm" maxlength="20" value="{{ $r->phone }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Email')}}</label>
                                                                <input type="text" name="email" id="email" class="form-control form-control-sm" maxlength="50" value="{{ $r->email }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Responsible')}}</label>
                                                                <input type="text" name="responsible" id="responsible" class="form-control form-control-sm" maxlength="50" value="{{ $r->responsible }}">
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                @endforeach

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
                url: "{{ url('client/update/') }}",
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

                    toastr.success("{{ __('messages.Successfully recorded') }}!", "{{ __('messages.Success') }}!");

                },
                complete: function(response){
                    console.log('Created New');
                },
                error: function(errors) {

                    // var message_erro = '{{ __('messages.Error.Required field not filled') }}: ';
                    // console.log('TODOS', errors.responseJSON);
                    // console.log('PARCIAL', errors.responseJSON.errors);

                    if(errors.responseJSON.errors.name) {
                        message_erro_aux = errors.responseJSON.errors.name[0];
                        message_erro = message_erro_aux.replace("name", "<b>{{ __('messages.Name') }}</b>")

                    } else if(errors.responseJSON.errors.project_id) {
                        message_erro_aux = errors.responseJSON.errors.project_id[0];
                        message_erro = message_erro_aux.replace("project id", "<b>{{ __('messages.Project') }}</b>")

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
            $('#link-client').addClass('active');

        }, 100);

</script>


  @endsection
