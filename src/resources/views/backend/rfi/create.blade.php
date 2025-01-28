@extends('backend.layouts.master')

@section('section')

    @include('backend.includes.datatables')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h4>{{ __('messages.Request For Information') }} (RFI)</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('rfi-list') }}">RFI</a></li>
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

                                        <div class="col-sm-12">

                                            <div class="card card-secondary">

                                                <div class="card-header">
                                                    <h3 class="card-title">{{ __('messages.Project Description')}} </h3>
                                                </div>

                                                <div class="card-body">

                                                    <input type="hidden" name="client_id" id="client_id">

                                                    <div class="row">

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Project')}}</label>
                                                                <select class="form-control form-control-sm" name="project_id" id="project_id" onclick="fillAddress()">
                                                                    <option value="">{{__('messages.Select')}}</option>
                                                                    @foreach ($result['projectCombo'] as $prj)
                                                                        <option value="{{ $prj->id }}"> {{ $prj->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Address')}}</label>
                                                                <input type="text" name="address" id="address" class="form-control form-control-sm" value="" readonly="readonly">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Client (GC)</label>
                                                                <input type="text" name="client_name" id="client_name" class="form-control form-control-sm" value="" readonly="readonly">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>{{__('messages.City')}}</label>
                                                                <input type="text" name="city" id="city" class="form-control form-control-sm" value="" readonly="readonly">
                                                            </div>
                                                        </div>

                                                    </div>


                                                    <div class="row">

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Contract')}}</label>
                                                                <input type="text" name="contract_number" id="contract_number" class="form-control form-control-sm" value="" readonly="readonly">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Responsible')}}</label>
                                                                <input type="text" name="project_manager" id="project_manager" class="form-control form-control-sm" value="" @readonly(true)>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>{{__('messages.State')}}</label>
                                                                <input type="text" name="state" id="state" class="form-control form-control-sm" value="" readonly="readonly">
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
                                                    <h3 class="card-title">{{__('messages.General Information')}}</h3>
                                                </div>

                                                <div class="card-body">

                                                    <div class="row">

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Received From')}}</label>
                                                                <input type="text" name="user_name" id="user_name" class="form-control form-control-sm" value="{{ strtoupper(Auth::user()->name) }}" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Date')}}</label>
                                                                <input type="date" name="rfi_date" id="rfi_date" class="form-control form-control-sm">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-sm-10">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Reference')}}</label>
                                                                <textarea class="form-control" name="reference" id="reference" rows="2"
                                                                style="border-bottom-color: black;"
                                                                ></textarea>
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
                                                    <h3 class="card-title">{{__('messages.RFI Overview')}}</h3>
                                                </div>

                                                <div class="card-body">

                                                     <div class="row">

                                                        <div class="col-sm-12">
                                                            <div class="form-group">

                                                                <table style="font-size: 14px;" class="table table-striped table-sm" id="ajax-datatable-rfi-overview">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">{{ __('messages.Question') }}</th>
                                                                            <th scope="col">{{ __('messages.Sugestion') }}</th>
                                                                            <th scope="col">{{ __('messages.From') }}</th>
                                                                            <th scope="col">{{ __('messages.Client Answear') }}</th>
                                                                            <th scope="col">{{ __('messages.Cost Impact') }}</th>
                                                                            <th scope="col">{{ __('messages.Schedule Impact') }}</th>
                                                                            <th scope="col">{{ __('messages.Deadline') }}</th>
                                                                            <th scope="col">{{ __('messages.Status') }}</th>
                                                                            <th>
                                                                                <a class="btn btn-sm btn-primary" href="javascript:openModalOverview()">
                                                                                    <i class="fas fa-plus"></i>
                                                                                </a>
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




        <div class="modal fade" id="myModalOverview" tabindex="-1" role="dialog" aria-labelledby="myModalAttachLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header" style="background-color: #6c757d; color: white;">
                    <h5 class="modal-title" id="myModalOverviewLabel">{{__('messages.RFI Overview')}}</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModalAttach()"></button> --}}
                </div>
                <div class="modal-body">

                    {{-- start form modal --}}
                    <form name="formRfiOverview" id="formRfiOverview" class="form-horizontal" method="POST">

                        @csrf

                        <input type="hidden" name="rfi_overview" id="rfi_overview" value="">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card-secondary">
                                        <div class="card-body">


                                            <div class="row">

                                                <div class="col-sm-10">
                                                    <div class="form-group">
                                                        <label>{{__('messages.Question')}}</label>
                                                        <textarea class="form-control" name="question" id="question" rows="2"
                                                        style="border-bottom-color: black;"
                                                        ></textarea>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-sm-10">
                                                    <div class="form-group">
                                                        <label>{{__('messages.Sugestion')}}</label>
                                                        <textarea class="form-control" name="sugestion" id="sugestion" rows="2"
                                                        style="border-bottom-color: black;"
                                                        ></textarea>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row" id="divClientAswear" style="display: none;">

                                                <div class="col-sm-10">
                                                    <div class="form-group">
                                                        <label>{{__('messages.Client Answear')}}</label>
                                                        <textarea class="form-control" name="client_answear" id="client_answear" rows="2"
                                                        style="border-bottom-color: black;"
                                                        ></textarea>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label>{{__('messages.Deadline')}}</label>
                                                        <input type="date" name="deadline" id="deadline" class="form-control form-control-sm">
                                                    </div>
                                                </div>

                                                <div class="col-sm-8" id="divSolved" style="display: none; text-align: right">
                                                    <div class="form-group">
                                                        <label>&nbsp;</label>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" name="solved" id="solved">
                                                            <label class="custom-control-label" for="solved">{{__('messages.Solved')}}</label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" name="cost_impact" id="cost_impact">
                                                            <label class="custom-control-label" for="cost_impact">{{__('messages.Cost Impact')}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" name="schedule_impact" id="schedule_impact">
                                                            <label class="custom-control-label" for="schedule_impact">{{__('messages.Schedule Impact')}}</label>
                                                        </div>
                                                    </div>
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
                    style="padding: 5px; margin: 10px; opacity: 0.8; text-align: center; display: none;">
                    <span id="messageModal"></span>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" onclick="closeModalOverview()">
                        <i class="fa fa-close"></i>&nbsp;
                        {{ __('messages.Button.Close') }}
                    </button>
                    <button class="btn btn-sm btn-primary float-end" id="saveOverview" style="display: none;" onclick="saveModalOverview()">
                        {{ __('messages.Button.Save') }}
                    </button>
                    <button class="btn btn-sm btn-primary float-end" id="updateOverview" style="display: none;" onclick="updateModalOverview()">
                        {{ __('messages.Button.Update') }}
                    </button>
                </div>
                </div>
            </div>
        </div>



        <form name="form_delete_overview" id="form_delete_overview" class="form-horizontal" method="POST">
            @csrf
            <input type="hidden" name="rfi_overview_id" value="">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        </form>

    </section>
    <!-- /.content -->



    <style>
        input, select { margin-bottom: 8px; }

        .modal-content {
            width: 800px;
            margin-left: 15%;
        }
        .model-modal  {
            width: 1000px;
            margin-left: 15%;
        }

        .modal-dialog  {
            width: 1000px;
            margin-left: 15%;
        }

    </style>


    <script>

        function fillAddress() {

            if(document.getElementById("project_id").value > '') {

                var project_id = document.getElementById("project_id").value


                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                });

                $.ajax({

                    url: '/pco/get-address-by-project/'+project_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {

                        console.log(response);

                        document.getElementById("client_id").value =  response.project[0]['client_id'];
                        document.getElementById("client_name").value =  response.project[0]['client_name'];
                        document.getElementById("address").value =  response.project[0]['street'];
                        document.getElementById("city").value =  response.project[0]['city'];
                        document.getElementById("state").value =  response.project[0]['state'];
                        document.getElementById("project_manager").value =  response.project[0]['project_manager'];
                        document.getElementById("contract_number").value =  response.project[0]['contract_number'];

                        // document.getElementById("address").value =  response.project[0]['street'];
                        // document.getElementById("city").value =  response.project[0]['city'];
                        // document.getElementById("state").value =  response.project[0]['state'];
                        // document.getElementById("client_id").value =  response.project[0]['client_id'];
                        // document.getElementById("project_manager").value =  response.project[0]['project_manager'];
                        // document.getElementById("email").value =  response.project[0]['email'];

                        return false;

                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });



            }

        }


        function openModalOverview(id, indx) {


            $('#formRfiOverview')[0].reset();

            document.getElementById("divClientAswear").style.display = "none";
            document.getElementById("divSolved").style.display = "none";
            document.getElementById("saveOverview").style.display = "";
            document.getElementById("updateOverview").style.display = "none";

            $('#myModalOverview').modal({
                backdrop: 'static',
                keyboard: false
            });

            // setTimeout(function() {
            //     loadLaborAppropriationByUser(id, {{ Auth::user()->id }})
            // }, 300);


        }
        function closeModalOverview() {
            $('#myModalOverview').modal('hide');
            return false;
        }



        function loadRfiOverviewByUser(user_id) {

            $(document).ready( function () {

                $('#ajax-datatable-rfi-overview').DataTable().clear().destroy();

                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                });

                $('#ajax-datatable-rfi-overview').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false,
                    paging: false,
                    info: false,
                    ajax: "{{ url('rfi/get-rfi-overview-by-user/') }}/"+user_id,
                    columns: [
                        { data: 'question',         name: 'question',        orderable: false,  width: '20%' },
                        { data: 'sugestion',        name: 'sugestion',       orderable: false,  width: '20%' },
                        { data: 'from',             name: 'from',            orderable: false,  width: '10%' },
                        { data: 'client_answear',   name: 'client_answear',  orderable: false,  width: '20%' },
                        { data: 'cost_impact',      name: 'cost_impact',     orderable: false,  width: '5%',
                            render: function(data, type, row) {
                                if(data == 1) {
                                    return '<b>{{ __("YES") }}</b>';
                                }else if (data == 0) {
                                    return '{{ __("NO") }}';
                                } else { return '-'; }
                            }
                        },
                        { data: 'schedule_impact',  name: 'schedule_impact', orderable: false,  width: '5%',
                            render: function(data, type, row) {
                                if(data == 1) {
                                    return '<b>{{ __("YES") }}</b>';
                                }else if (data == 0) {
                                    return '{{ __("NO") }}';
                                } else { return '-'; }
                            }
                        },
                        { data: 'deadline',         name: 'deadline',        orderable: false,  width: '10%' },
                        { data: 'status',           name: 'status',          orderable: false,  width: '5%',
                            render: function(data, type, row) {
                                if(data == 1) {
                                    return '<span class="pull-right badge bg-green" style="font-size: 10px;"><span style="font-size: 10px; color: #ffffff;">SOLVED</span></span>';
                                } else if (data == 0) {
                                    return '<span class="pull-right badge bg-red" style="font-size: 10px;">OPENED</span>';
                                } else { return '-'; }
                            }

                            },
                        { data: 'action', name: 'action', orderable: false,  width: '5%', className: "text-right" },
                    ],
                    // dom: 'Bfrtip',
                    order: [[1, 'asc']],
                        columnDefs: [{
                        width: '5%',
                        targets: [0],
                        visible: true
                    },
                ],
                });

            });

        }


        function saveModalOverview() {

            var data = $('#formRfiOverview').serialize();

            $.ajax({
                type: 'post',
                url: "{{ url('rfi/store-rfi-overview-by-user/') }}",
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

                    $('#formRfiOverview')[0].reset();


                    setTimeout(function() {
                        loadRfiOverviewByUser({{ Auth::user()->id }});
                        closeModalOverview();
                    }, 100);

                },
                // complete: function(response){
                //     console.log('Created New');
                // },
                error: function(errors) {

                    // var message_erro = '{{ __('messages.Error.Required field not filled') }}: ';
                    // console.log('TODOS', errors.responseJSON);
                    // console.log('PARCIAL', errors.responseJSON.errors);

                    if(errors.responseJSON.errors.question) {
                        message_erro_aux = errors.responseJSON.errors.question[0];
                        message_erro = message_erro_aux.replace("question", "<b>{{ __('messages.Question') }}</b>")

                    } else if(errors.responseJSON.errors.deadline) {
                        message_erro_aux = errors.responseJSON.errors.deadline[0];
                        message_erro = message_erro_aux.replace("deadline", "<b>{{ __('messages.Deadline') }}</b>")

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

        };



        function updateModalOverview() {

            var data = $('#formRfiOverview').serialize();

            $.ajax({
                type: 'post',
                url: "{{ url('rfi/update-rfi-overview-by-user/') }}",
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

                    $('#formRfiOverview')[0].reset();


                    setTimeout(function() {
                        loadRfiOverviewByUser({{ Auth::user()->id }});
                        closeModalOverview();
                    }, 100);

                },
                // complete: function(response){
                //     console.log('Created New');
                // },
                error: function(errors) {

                    // var message_erro = '{{ __('messages.Error.Required field not filled') }}: ';
                    // console.log('TODOS', errors.responseJSON);
                    // console.log('PARCIAL', errors.responseJSON.errors);

                    if(errors.responseJSON.errors.question) {
                        message_erro_aux = errors.responseJSON.errors.question[0];
                        message_erro = message_erro_aux.replace("question", "<b>{{ __('messages.Question') }}</b>")

                    } else if(errors.responseJSON.errors.deadline) {
                        message_erro_aux = errors.responseJSON.errors.deadline[0];
                        message_erro = message_erro_aux.replace("deadline", "<b>{{ __('messages.Deadline') }}</b>")

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

        };



        function deleteRfiOverview(id) {

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

                    document.form_delete_overview.rfi_overview_id.value = id;

                    var data = $('#form_delete_overview').serialize();

                    $.ajax({
                        type: 'post',
                        url: "{{ '/rfi/delete-rfi-overview' }}",
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
                    setTimeout(function() {
                        loadRfiOverviewByUser({{ Auth::user()->id }});
                    }, 100);

                }
            });

        }



        function fcGetRfiOverviewRow(id) {
            console.log(id);

            $('#myModalOverview').modal({
                backdrop: 'static',
                keyboard: false
            });

            // var rfi_overview_id = id;


            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            });

            $.ajax({

                url: '/rfi/get-rfi-overview/'+id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {

                    console.log(response);

                    document.getElementById("divClientAswear").style.display = "";
                    document.getElementById("divSolved").style.display = "";
                    document.getElementById("saveOverview").style.display = "none";
                    document.getElementById("updateOverview").style.display = "";

                    document.getElementById("rfi_overview").value = id;
                    document.getElementById("question").value = response[0]['question'];
                    document.getElementById("sugestion").value = response[0]['sugestion'];
                    document.getElementById("client_answear").value = response[0]['client_answear'];
                    document.getElementById("deadline").value = response[0]['deadline'];
                    if(response[0]['cost_impact'] == 1) {
                        document.getElementById("cost_impact").checked = true;
                    } else {
                        document.getElementById("cost_impact").checked = false;
                    }
                    if(response[0]['schedule_impact'] == 1) {
                        document.getElementById("schedule_impact").checked = true;
                    } else {
                        document.getElementById("schedule_impact").checked = false;
                    }

                    if(response[0]['status'] == 1) {
                        document.getElementById("solved").checked = true;
                    } else {
                        document.getElementById("solved").checked = false;
                    }

                    return false;

                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });


        }





    // ********* SAVING FORM **********
    $(".submit-form").click(function(e) {

        e.preventDefault();
        var data = $('#form-data').serialize();

        $.ajax({
            type: 'post',
            url: "{{ url('rfi/store/') }}",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            // beforeSend: function(){
            //     console.log('....Please wait');
            // },
            success: function(response){

                console.log(response);

                if(response == 'existing data group') {

                    toastr.options = timeOut = 10000;
                    toastr.options = {
                        "progressBar" : true,
                        "closeButton" : true,
                        "positionClass": "toast-bottom-full-width",
                        "onclick": true,
                        "fadeIn": 300,
                        "fadeOut": 1000,
                    },
                    toastr.error("<b>{{ __('messages.Registration already exists') }}!</b><br>{{ __('messages.Check possible combinations of existing data') }}.", "Oops!");

                } else {

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

                }

            },
            complete: function(response){
                console.log('Created New');
            },
            error: function(errors) {

                // var message_erro = '{{ __('messages.Error.Required field not filled') }}: ';
                // console.log('TODOS', errors.responseJSON);
                // console.log('PARCIAL', errors.responseJSON.errors);

                if(errors.responseJSON.errors.project_id) {
                    message_erro_aux = errors.responseJSON.errors.project_id[0];
                    message_erro = message_erro_aux.replace("project id", " <b>{{__('messages.Project')}}</b>")

                } else if(errors.responseJSON.errors.reference) {
                    message_erro_aux = errors.responseJSON.errors.reference[0];
                    message_erro = message_erro_aux.replace("reference", "<b>{{ __('messages.Reference') }}</b>")

                } else if(errors.responseJSON.errors.rfi_date) {
                    message_erro_aux = errors.responseJSON.errors.rfi_date[0];
                    message_erro = message_erro_aux.replace("rfi date", "<b>{{ __('messages.Date') }}</b>")


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
            $('#link-rfi').addClass('active');
        }, 100);


        $(function() {
            $('input').keyup(function() {
                this.value = this.value.toLocaleUpperCase();
            });
        });



        // Clear all temporary RFI Overviews records
        // setTimeout(function() {

        //     var data = $('#form_delete_overview').serialize();

        //     console.log('data: ', data);

        //     $.ajax({
        //         type: 'post',
        //         url: "{{ 'delete-rfi-overview-by-user' }}",
        //         data: data,
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         success: function(response){
        //             console.log('chegou');
        //         },
        //         error: function(errors) {
        //             console.log('ERRO: ', errors.responseJSON);
        //         },
        //     });

        // }, 350);


    </script>


@endsection
