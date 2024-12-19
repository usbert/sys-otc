@extends('backend.layouts.master')

@section('section')

    @include('backend.includes.datatables')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h4>{{ __('messages.Edit')}} {{ __('messages.Contacts')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('contact-list') }}">{{ __('messages.Contacts')}}</a></li>
                <li class="breadcrumb-item active">{{ __('messages.Button.Add New')}} {{ __('messages.Contacts')}}</li>
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


                                        @foreach ($result['contact'] as $row => $rec)

                                            <div class="col-sm-12">

                                                <div class="card card-secondary">

                                                    <div class="card-header">
                                                        <h3 class="card-title">{{ __('messages.Description')}} </h3>
                                                    </div>

                                                    <div class="card-body">

                                                        <input type="hidden" name="id" value="{{ $rec->id }}">

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label>{{__('messages.Name')}}</label>
                                                                    <input type="text" name="name" id="name" class="form-control form-control-sm" maxlength="80" value="{{ $rec->name }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label>{{ __('messages.Client') }}</label>
                                                                    <select class="form-control form-control-sm" name="client_id" id="client_id">
                                                                        <option value="">{{__('messages.Select')}}</option>
                                                                        @foreach ($result['clientCombo'] as $row => $r)
                                                                            <option value="{{ $r['id'] }}"
                                                                            {{ $r->id == $rec->client_id ? 'selected' : '' }}
                                                                            >
                                                                            {{ $r['name'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label>{{ __('messages.Function') }}</label>
                                                                    <select class="form-control form-control-sm" name="employee_role_id" id="employee_role_id">
                                                                        <option value="">{{__('messages.Select')}}</option>
                                                                        @foreach ($result['employeeRoleCombo'] as $row => $r)
                                                                            <option value="{{ $r['id'] }}"
                                                                            {{ $r->id == $rec->employee_role_id ? 'selected' : '' }}
                                                                            >
                                                                            {{ $r['name'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="row">
                                                            <div class="col-sm-2">
                                                                <div class="form-group">
                                                                    <label>{{__('messages.Phone')}}</label>
                                                                    <input type="text" name="phone" id="phone" class="form-control form-control-sm" maxlength="20" value="{{ $rec->phone }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label>{{__('messages.Email')}}</label>
                                                                    <input type="text" name="email" id="email" class="form-control form-control-sm" maxlength="80" value="{{ $rec->email }}">
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>



                                                </div>

                                            </div>

                                        @endforeach

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
                    url: "{{ url('contact/update/') }}",
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
                        console.log('Updated');
                    },
                    error: function(errors) {

                        // var message_erro = '{{ __('messages.Error.Required field not filled') }}: ';
                        // console.log('TODOS', errors.responseJSON);
                        // console.log('PARCIAL', errors.responseJSON.errors);

                        if(errors.responseJSON.errors.name) {
                            message_erro_aux = errors.responseJSON.errors.name[0];
                            message_erro = message_erro_aux.replace("name", "<b>{{ __('messages.Name') }}</b>")

                        } else if(errors.responseJSON.errors.phone) {
                            message_erro_aux = errors.responseJSON.errors.phone[0];
                            message_erro = message_erro_aux.replace("phone", "<b>{{ __('messages.Phone') }}</b>")

                        } else if(errors.responseJSON.errors.email) {
                            message_erro_aux = errors.responseJSON.errors.email[0];
                            message_erro = message_erro_aux.replace("email", "<b>{{ __('messages.Email') }}</b>")

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

            setTimeout(function() {
                // MARCAR O LINK NO SIDEBAR
                $('#link-contact').addClass('active');
            }, 100);


            $(function() {
                $('input').keyup(function() {
                    this.value = this.value.toLocaleUpperCase();
                });
            });

    </script>


@endsection
