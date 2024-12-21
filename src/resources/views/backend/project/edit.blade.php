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

                                @foreach ($result['project'] as $row => $r)

                                    <input type="hidden" name="id" value="{{ $r->id }}">

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
                                                                <input type="text" name="code" id="code" class="form-control form-control-sm" value="{{ $r->code }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Project Name')}}</label>
                                                                <input type="text" name="name" id="name" class="form-control form-control-sm" value="{{ $r->name }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Number')}}</label>
                                                                <input type="text" name="contract_number" id="contract_number" class="form-control form-control-sm" value="{{ $r->contract_number }}">
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
                                                                        <option value="{{ $cli->id }}"
                                                                            {{ $cli->id == $r->client_id ? 'selected' : '' }}
                                                                            > {{ $cli->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Project Manager')}}</label>
                                                                <input type="text" name="project_manager" id="project_manager" class="form-control form-control-sm" value="{{ $r->project_manager }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{ __('messages.Trade') }}</label>
                                                                <select class="form-control form-control-sm" name="trade_id" id="trade_id">
                                                                    <option value="">-- {{__('messages.Select')}} --</option>
                                                                    @foreach ($result['tradeCombo'] as $tra)
                                                                        <option value="{{ $tra->id }}"
                                                                            {{ $tra->id == $r->trade_id ? 'selected' : '' }}
                                                                            > {{ $tra->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Signature Date')}}</label>
                                                                <input type="date" name="signature_date" id="signature_date" class="form-control form-control-sm" value="{{ $r->signature_date }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Start Date')}}</label>
                                                                <input type="date" name="start_date" id="start_date" class="form-control form-control-sm" value="{{ $r->start_date }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Finish Date')}}</label>
                                                                <input type="date" name="finish_date" id="finish_date" class="form-control form-control-sm" value="{{ $r->finish_date }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Contract Value')}}</label>
                                                                <input type="text" name="contract_value" id="contract_value" class="form-control form-control-sm"
                                                                {{-- @if("{{ Config::get('app.locale') }}" == 'pt_BR')
                                                                    { --}}
                                                                    onkeypress="return fc_decimal(this,'.',',',event, 10);"
                                                                    value="{{ $r->contract_value }}"
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
                                                                <input type="text" name="street" id="street" class="form-control form-control-sm" maxlength="80" value="{{ $r->street }}">
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
                                                                <input type="text" name="zip_code" id="zip_code" class="form-control form-control-sm" maxlength="20"
                                                                value="{{ $r->zip_code }}"
                                                                onkeypress="return isNumberKey(event)"
                                                                >
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

                        </form>

                        {{-- DATATABLE ARQUIVOS --}}

                        <div class="row" style="margin-top: 20px;">

                            <div class="col-sm-12">

                                <div class="panel-body">
                                    <div class="card card-secondary">
                                        <div class="card-header">
                                            <h3 class="card-title">{{ __('messages.Document Attachment') }}</h3>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="tab-content">
                                                    <table style="font-size: 14px; width: 98%" class="table table-striped table-sm" id="ajax-datatable-files">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">{{ __('messages.Type Documents') }}</th>
                                                                <th scope="col">{{ __('messages.File Name') }}</th>
                                                                <th scope="col">{{ __('messages.Description') }}</th>
                                                                <th scope="col">
                                                                    <button type="button" class="btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#myModalAttach" onclick="openModalAttach()">
                                                                        <i class="fa fa-paperclip"></i>&nbsp;
                                                                        {{-- {{ __('messages.Attach document') }} --}}
                                                                    </button>
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>


                    </div>

                </div>

            </div>

      </div>


        <!-- Modal -->
        <div class="modal fade" id="myModalAttach" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalAttachLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header" style="background-color: #6c757d; color: white;">
                    <h5 class="modal-title" id="myModalAttachLabel">{{ __('messages.Document Attachment')}}</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModalAttach()"></button> --}}
                </div>
                <div class="modal-body">

                    {{-- start form modal --}}
                    <form action="{{ url('file/store/') }}" id="image-form" class="form-horizontal" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-grou1p">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card-secondary">
                                        <div class="card-body">

                                            <div class="row">

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>{{ __('messages.Type Document') }}</label>
                                                        <select class="form-control form-control-sm" name="type_document_id" id="type_document_id">
                                                            <option value="">-- {{__('messages.Select')}} --</option>
                                                            @foreach ($result['typeDocumentCombo'] as $typedoc)
                                                                <option value="{{ $typedoc->id }}"> {{ $typedoc->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>{{__('messages.Description')}}</label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="comment" id="comment" class="form-control form-control-sm" value=''>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <input type="file" name="image" id="original_name" class="form-control form-control-sm">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    {{-- end form modal --}}

                </div>

                <div id="divErrorModal" class="alert alert-danger"
                    style="padding: 5px; margin: 10px; opacity: 0.8; text-align: center;">
                    <span id="messageModal"></span>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" onclick="closeModalAttach()">
                        <i class="fa fa-close"></i>&nbsp;
                        {{ __('messages.Button.Close') }}
                    </button>
                    <button class="btn btn-sm btn-primary float-end" id="image-upload">
                        {{ __('messages.Attach') }}
                    </button>
                </div>
                </div>
            </div>
        </div>


        <form name="form_data_delete" id="form-data-delete" method="POST">
            <input type="hidden" name="id" value="">
            @csrf
       </form>


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


        // Load list files uploaded
        // function loadFiles(id) {

        //     $(document).ready( function () {

        //         // LIMPAR TUDO ANTES DE CRIAR NOVA DATATABLE
        //         $('#ajax-datatable-files').DataTable().clear().destroy();

        //         $.ajaxSetup({
        //             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //         });

        //         $('#ajax-datatable-files').DataTable({
        //             processing: true,
        //             serverSide: true,
        //             searching: false,
        //             ajax: "{{ url('vehicle/get-file/') }}/"+id,
        //             columns: [
        //                 { data: 'type_name',            name: 'type_name',      orderable: false, width: '20%' },
        //                 { data: 'original_name',        name: 'original_name',  orderable: false, width: '45%' },
        //                 { data: 'comment',              name: 'comment',        orderable: false, width: '25%' },
        //                 { data: 'action',               name: 'action',         orderable: false, width: '10%', className: "text-right" },
        //             ],
        //             // dom: 'Bfrtip',
        //             order: [[1, 'asc']],
        //                 columnDefs: [{
        //                 width: '5%',
        //                 targets: [0],
        //                 visible: true
        //             }],
        //             // QUANTIDADE DE LINHAS NA PÁGINA
        //             lengthMenu: [
        //                 [6, 8, 10, 25, 50, 100, -1],
        //                 ['6', '8', 10, '25', '50', '100', 'Todos']
        //             ],
        //             pageLength: '6',
        //         });


        //     });

        //     // Retirar opção combobox com quantidades de linhas na grid
        //     setTimeout(function() {
        //         document.getElementById("ajax-datatable-files_length").style.display = "none";
        //     }, 150);


        // }


        // // File upload
        // $("#image-upload").click(function (e) {

        //     e.preventDefault();

        //     $.ajaxSetup({
        //         headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        //     });

        //     const form = document.getElementById('image-form');

        //     var productImage = $("#original_name").prop("files")[0];
        //     const dados = new FormData(form);

        //     if (typeof(productImage) != 'undefined' && productImage != null) {
        //         dados.append("original_name", productImage['name']);
        //         dados.append("image", productImage);
        //     }

        //     $.ajax({
        //         type: "post",
        //         url: "{{ url('file/store/') }}",
        //         data: dados,
        //         // image: productImage,
        //         processData: false,
        //         contentType: false,
        //         success: function(response){
        //             console.log('SUCESSO', response);
        //             var vehicle_id = document.getElementById("id").value;
        //             closeModalAttach();
        //             loadFiles(vehicle_id);
        //         },
        //         error: function(errors) {

        //             if(errors.responseJSON.errors.type_document_id) {
        //                 message_erro_aux = errors.responseJSON.errors.type_document_id[0];
        //                 message_erro = message_erro_aux.replace("type document id", "{{ __('messages.Type Document') }}")

        //             } else if(errors.responseJSON.errors.comment) {
        //                 message_erro_aux = errors.responseJSON.errors.comment[0];
        //                 message_erro = message_erro_aux.replace("comment", "{{ __('messages.Description') }}")

        //             } else if(errors.responseJSON.errors.image) {
        //                 message_erro_aux = errors.responseJSON.errors.image[0];
        //                 message_erro = message_erro_aux.replace("image", "{{ __('messages.Attach the document') }}")

        //             } else {
        //                 message_erro = errors.responseJSON.errors;
        //             }

        //             document.getElementById("divErrorModal").style.display = "";
        //             document.getElementById("messageModal").textContent = message_erro;
        //             setTimeout(function() {
        //                 document.getElementById("divErrorModal").style.display = "none";
        //             }, 5000);


        //         }
        //     });


        // });


        $(function() {
            $('input').keyup(function() {
                this.value = this.value.toLocaleUpperCase();
            });
        });


        function openModalAttach() {

            console.log('Show open Attachments Modal');

            $('#myModalAttach').modal({
                backdrop: 'static',
                keyboard: false
            });

            // clear modal form when opened
            $('#image-form')[0].reset();

            setTimeout(function() {
                document.getElementById("project_id").value = document.getElementById("projectId").value;
            }, 100);


        }

        function closeModalAttach() {
            $('#myModalAttach').modal('hide');
            return false;
        }


        // Search prefix and vin number with enter key
        $("#prefix").keydown(function (e) {
            if (e.keyCode == 13) {
                fcSerchPrefix();
                return false;
            }
        });
        $("#vin_number").keydown(function (e) {
            if (e.keyCode == 13) {
                fcSerchPrefix();
                return false;
            }
        });



        // ********* DELETE **********
        function deleteReg(id) {

            Swal.fire({
                title: "{{ __('messages.Confirm record deletion') }}",
                text: "{{ __('messages.You wont be able to reverse this') }}!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "{{ __('messages.Yes delete') }}!"
                }).then((result) => {
                if (result.isConfirmed) {

                    document.form_data_delete.id.value = id;

                    var data = $('#form-data-delete').serialize();

                    $.ajax({
                        type: 'post',
                        url: "{{ '/file/delete-file' }}",
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },

                    });

                    Swal.fire({
                        title: "{{ __('messages.Deleted') }}!",
                        text: "{{ __('messages.Successfully deleted record') }}!",
                        icon: "success"
                    });

                    // REFRESH DATATABLE
                    // setTimeout(function() {
                    //     var vehicle_id = document.getElementById("id").value;
                    //     loadFiles(vehicle_id);
                    // }, 200);

                }
            });

        }


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
