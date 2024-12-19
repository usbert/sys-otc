@extends('backend.layouts.master')

@section('section')

@include('backend.includes.datatables')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>{{ __('messages.Add New')}} {{ __('messages.Supplyers')}}</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('supplyer-list') }}">{{ __('messages.Supplyers')}}</a></li>
              <li class="breadcrumb-item active">{{ __('messages.Button.Add New')}} {{ __('messages.Supplyers')}}</li>
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


                                    @foreach ($result['supplyer'] as $row => $r)

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
                                                                <label>{{__('messages.Name')}}</label>
                                                                <input type="text" name="name" id="name" class="form-control form-control-sm" maxlength="80" value="{{ $r->name }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Fantasy Name')}}</label>
                                                                <input type="text" name="fantasy_name" id="fantasy_name" class="form-control form-control-sm" maxlength="80" value="{{ $r->fantasy_name }}">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Document Number')}}</label>
                                                                <input type="text" name="document_number" id="document_number" class="form-control form-control-sm" maxlength="18" value="{{ $r->document_number }}">
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
                url: "{{ url('supplyer/update/') }}",
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
                    console.log('Update Now');
                },
                error: function(errors) {

                    // var message_erro = '{{ __('messages.Error.Required field not filled') }}: ';
                    // console.log('TODOS', errors.responseJSON);
                    // console.log('PARCIAL', errors.responseJSON.errors);

                    if(errors.responseJSON.errors.name) {
                        message_erro_aux = errors.responseJSON.errors.name[0];
                        message_erro = message_erro_aux.replace("name", "<b>{{ __('messages.Name') }}</b>")

                    } else if(errors.responseJSON.errors.fantasy_name) {
                        message_erro_aux = errors.responseJSON.errors.fantasy_name[0];
                        message_erro = message_erro_aux.replace("fantasy name", "<b>{{ __('messages.Fantasy Name') }}</b>")

                    } else if(errors.responseJSON.errors.document_number) {
                        message_erro_aux = errors.responseJSON.errors.document_number[0];
                        message_erro = message_erro_aux.replace("document number", "<b>{{ __('messages.Document Number') }}</b>")



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

</script>


  @endsection
