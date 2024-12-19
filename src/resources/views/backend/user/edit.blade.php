@extends('backend.layouts.master')

@section('section')

@include('backend.includes.datatables')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>{{ __('messages.Edit')}} {{ __('messages.Users')}}</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('user-list') }}">{{ __('messages.Users')}}</a></li>
              <li class="breadcrumb-item active">{{ __('messages.Edit')}} {{ __('messages.Users')}}</li>
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

                                    @foreach ($result['user'] as $row => $r)

                                    <div class="col-sm-12">

                                        <div class="card card-secondary">

                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('messages.Description') }} </h3>
                                            </div>

                                            <div class="card-body">

                                                <input type="hidden" name="id" value="{{ $r->id }}">

                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Name')}}</label>
                                                            <input type="text" class="form-control form-control-sm" name="name" id="name" maxlength="255" value="{{ $r->name }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Email')}}</label>
                                                            <input type="text" class="form-control form-control-sm" name="email" id="email" maxlength="255" value="{{ $r->email }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    @can('is_admin')

                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" name="is_admin" id="is_admin"
                                                                    {{ $r->access_level == 1 ? 'checked' : '' }}
                                                                    >
                                                                    <label class="custom-control-label" for="is_admin">{{ strtoupper(__('messages.Administrator')) }}</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <div class="custom-control custom-switch">
                                                                    <input type="checkbox" class="custom-control-input" name="is_activated" id="is_activated"
                                                                    {{ $r->is_activated == 1 ? 'checked' : '' }}
                                                                    >
                                                                    <label class="custom-control-label" for="is_activated">{{ strtoupper(__('messages.Active')) }}</label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    @endcan

                                                </div>

                                            </div>



                                        </div>

                                    </div>


                                    <div class="col-sm-12">

                                        <div class="card card-secondary">

                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('messages.Projects visible to the user')}}</h3>
                                            </div>

                                            <div class="card-body">

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <table style="font-size: 16px;" class="table table-striped table-sm" id="table-modules">
                                                            {{-- <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th scope="col">{{ __('messages.Project')}}</th>
                                                                </tr>
                                                            </thead> --}}
                                                            <tbody>
                                                                @foreach ($result['projectCombo'] as $row => $r)
                                                                    <tr>
                                                                        <td style="width: 3%;">
                                                                            <div class="custom-control custom-switch">
                                                                                <input type="checkbox" class="custom-control-input" name="user_projects[]" id="user_projects{{ $row }}"
                                                                                value="{{ $r['id'] }}"

                                                                                @foreach ($result['userProject'] as $rr => $pr)
                                                                                    {{ $pr['project_id'] == $r['id'] ? ' checked' : '' }}
                                                                                @endforeach

                                                                                />

                                                                                <label class="custom-control-label" for="user_projects{{ $row }}"></label>
                                                                            </div>
                                                                        </td>
                                                                        <td style="width: 77%;">{{ $r['short_name'] }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">

                                        <div class="card card-secondary">

                                            <div class="card-header">
                                                <h3 class="card-title">{{ __('messages.Access Permissions')}} </h3>
                                            </div>

                                            <div class="card-body">

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <table style="font-size: 16px;" class="table table-striped table-sm" id="table-modules">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">Module</th>
                                                                    <th scope="col">Menu</th>
                                                                    <th></th>
                                                                    <th scope="col">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                @foreach ($result['permissionCombo'] as $row => $r)

                                                                    <tr>
                                                                        <td style="width: 22%;">{{ strtoupper( $r['module_name']) }}</td>
                                                                        <td style="width: 26%; font-weight: bold">{{ strtoupper( $r['menu_name']) }}</td>
                                                                        <td style="width: 3%;">
                                                                            <div class="custom-control custom-switch">
                                                                                <input type="checkbox" class="custom-control-input" name="page_actions[]" id="page_actions{{ $row }}"
                                                                                value="{{ $r['id'] }}"

                                                                                @foreach ($result['userPermission'] as $rr => $pm)
                                                                                    {{ $pm['page_action_id'] == $r['id'] ? ' checked' : '' }}
                                                                                @endforeach

                                                                                />
                                                                                <label class="custom-control-label" for="page_actions{{ $row }}"></label>
                                                                            </div>
                                                                        </td>
                                                                        <td style="width: 50%;">{{ strtoupper( $r['action_name']) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>

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
                url: "{{ url('user/update/') }}",
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

                    // var message_erro = '{{ __('messages.Error.Required field not filled') }}: ';
                    // console.log('TODOS', errors.responseJSON);
                    //  console.log('PARCIAL', errors.responseJSON.errors);

                    if(errors.responseJSON.errors.name) {
                        message_erro_aux = errors.responseJSON.errors.name[0];
                        message_erro = message_erro_aux.replace("name", "<b>{{ __('messages.Name') }}</b>")

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

        $(function() {
            $('input').keyup(function() {
                this.value = this.value.toLocaleUpperCase();
            });
        });

        setTimeout(function() {

                // MARCAR O LINK NO SIDEBAR
                $('#link0').addClass('active');

        }, 100);

    </script>

    <script src="{{ asset('backend/dist/js/decimal.js') }}"></script>

  @endsection
