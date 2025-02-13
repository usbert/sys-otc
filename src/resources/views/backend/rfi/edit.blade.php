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

                                    @foreach ($result['rfis'] as $row => $r)

                                        <div class="row">

                                            <div class="col-sm-12">

                                                <div class="card card-secondary">

                                                    <div class="card-header">
                                                        <h3 class="card-title">{{ __('messages.Project Description')}} </h3>
                                                    </div>

                                                    <div class="card-body">

                                                        <input type="hidden" name="id" id="id" value="{{ $r->id }}">
                                                        <input type="hidden" name="client_id" id="client_id">

                                                        <div class="row">

                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <label>{{__('messages.Project')}}</label>
                                                                    <select class="form-control form-control-sm" name="project_id" id="project_id" onclick="fillAddress()">
                                                                        <option value="">{{__('messages.Select')}}</option>
                                                                        @foreach ($result['projectCombo'] as $prj)
                                                                            <option value="{{ $prj->id }}"
                                                                                {{ $prj->id == $r->project_id ? 'selected' : '' }}
                                                                                > {{ $prj->name }}</option>
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

                                        {{-- REQUEST FOR INFORMATION --}}
                                    <div class="row">

                                        <div class="col-sm-12">

                                            <div class="card card-secondary">

                                                <div class="card-header">
                                                    <h3 class="card-title">{{__('messages.Request For Information')}}</h3>
                                                </div>

                                                <div class="card-body">

                                                    <div class="row">

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Name')}}</label>
                                                                <input type="text" name="name" id="name" class="form-control form-control-sm" maxlength="120" value="{{ $r->name }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Assignee')}}</label>
                                                                <input type="text" name="assignee" id="assignee" class="form-control form-control-sm" maxlength="80" value="{{ $r->assignee }}">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Date')}}</label>
                                                                <input type="date" name="rfi_date" id="rfi_date" class="form-control form-control-sm" value="{{ $r->rfi_date }}">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- GENERAL INFORMATION --}}
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

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-sm-10">
                                                            <div class="form-group">
                                                                <label>{{__('messages.Reference')}}</label>
                                                                <textarea class="form-control" name="reference" id="reference" rows="2"
                                                                style="border-bottom-color: black;"
                                                                >{{ $r->reference }}</textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @endforeach

                                    {{-- RFI OVERVIEW --}}
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
                                                                            <th scope="col">{{ __('messages.Code') }}</th>
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


                                    {{-- ATTACHMENT FILES --}}
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
                                                                            <th scope="col">{{ __('messages.File Name') }}</th>
                                                                            <th scope="col">{{ __('messages.Comment') }}</th>
                                                                            <th scope="col">Overview Ref.</th>
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



        {{-- Modal Overview --}}
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

                        <input type="hidden" name="rfi_id" id="rfi_id" value="">
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


        <!-- Attachment Modal -->
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

                        <input type="idden" name="rfi_id_file" id="rfi_id_file" value="">

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card-secondary">
                                        <div class="card-body">


                                            <div class="row">

                                                <div class="col-sm-2">
                                                    <div class="form-group">
                                                        <label>Overview Ref.</label>
                                                        <select class="form-control form-control-sm" name="rfi_overview_id" id="rfi_overview_id">
                                                            <option value="">-- {{__('messages.Select')}} --</option>
                                                            {{-- INSERE OS DADOS PELO METODO DO PROJETO --}}
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>{{__('messages.Description')}}</label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="file_comment" id="file_comment" class="form-control form-control-sm" value=''>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" style="margin-top: 20px;">
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
                    style="padding: 5px; margin: 10px; opacity: 0.8; text-align: center; display: none;">
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



        <form name="form_delete_overview" id="form_delete_overview" class="form-horizontal" method="POST">
            @csrf
            <input type="hidden" name="rfi_overview_id" value="">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
        </form>

        <form name="form_file_delete" id="form_file_delete" method="POST">
            <input type="hidden" name="id" value="">
            @csrf
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

        #ajax-datatable-rfi-overview td:nth-of-type(1) {
            font-weight: bold;
        }

        #ajax-datatable-files td:nth-of-type(1) {
            font-weight: bold;
        }
        #ajax-datatable-files td:nth-of-type(3) {
            font-weight: bold;
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

            setTimeout(function() {
                document.getElementById("rfi_id").value = document.getElementById("id").value;
            }, 200);


        }
        function closeModalOverview() {
            $('#myModalOverview').modal('hide');
            return false;
        }



        function openModalAttach() {


            setTimeout(function() {
                document.getElementById("rfi_id_file").value = document.getElementById("id").value;
            }, 200);

            $('#myModalAttach').modal({
                backdrop: 'static',
                keyboard: false
            });

            // clear modal form when opened
            $('#image-form')[0].reset();

            fillComboOverviews();

        }

        function closeModalAttach() {
            $('#myModalAttach').modal('hide');
            return false;
        }


        function fillComboOverviews() {

            $.ajaxSetup({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            });

            $.ajax({
                url: '/rfi/get-combo-overview/',
                type: 'get',
                dataType: 'json',
                success: function(response){

                    var overviews = response.original.rfiOverviewCombo;
                    console.log(overviews);

                    $('#rfi_overview_id').empty();

                     var option = "<option value=''>-- Selecione --</option>";

                    $("#rfi_overview_id").append(option);

                    overviews.forEach(function(overviews) {
                        var option = "<option value='"+overviews.id+"'>"+overviews.code+"</option>";
                        $("#rfi_overview_id").append(option);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        }


        function loadRfiOverviewById() {

            var id = document.getElementById("id").value;

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
                    ajax: "{{ url('rfi/get-rfi-overview-by-id/') }}/"+id,
                    columns: [
                        { data: 'code',             name: 'code',        orderable: false,  width: '4%' },
                        { data: 'question',         name: 'question',        orderable: false,  width: '18%' },
                        { data: 'sugestion',        name: 'sugestion',       orderable: false,  width: '18%' },
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



        function loadFilesById(id) {

            var id = document.getElementById("id").value;

            $(document).ready( function () {

                // LIMPAR TUDO ANTES DE CRIAR NOVA DATATABLE
                $('#ajax-datatable-files').DataTable().clear().destroy();

                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                });

                $('#ajax-datatable-files').DataTable({
                    processing: true,
                    serverSide: true,
                    searching: false,
                    paging: false,
                    info: false,
                    ajax: "{{ url('rfi/get-file-by-id/') }}/"+id,
                    columns: [
                        { data: 'original_name',    name: 'original_name', orderable: false, width: '35%' },
                        { data: 'file_comment',     name: 'file_comment',  orderable: false, width: '35%' },
                        { data: 'rfi_overview',     name: 'rfi_overview',  orderable: false, width: '20%' },
                        { data: 'action',           name: 'action',        orderable: false, width: '10%', className: "text-right" },
                    ],
                    // dom: 'Bfrtip',
                    order: [[1, 'asc']],
                        columnDefs: [{
                        width: '5%',
                        targets: [0],
                        visible: true
                    }],
                    // QUANTIDADE DE LINHAS NA PÁGINA
                    lengthMenu: [
                        [6, 8, 10, 25, 50, 100, -1],
                        ['6', '8', 10, '25', '50', '100', 'Todos']
                    ],
                    pageLength: '6',
                });


            });

            // Retirar opção combobox com quantidades de linhas na grid
            // setTimeout(function() {
            //     document.getElementById("ajax-datatable-files_length").style.display = "none";
            // }, 360);


        }

        function saveModalOverview() {

            var data = $('#formRfiOverview').serialize();

            $.ajax({
                type: 'post',
                url: "{{ url('rfi/store-rfi-overview-by-rfiid/') }}",
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
                        loadRfiOverviewById({{ Auth::user()->id }});
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
                        loadRfiOverviewById({{ Auth::user()->id }});
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
                        loadRfiOverviewById({{ Auth::user()->id }});
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

                    setTimeout(function() {
                        window.location.href = "/rfi";
                    }, 3500);

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


    // File upload
    $("#image-upload").click(function (e) {

        e.preventDefault();

        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        });

        const form = document.getElementById('image-form');

        var productImage = $("#original_name").prop("files")[0];
        const dados = new FormData(form);

        if (typeof(productImage) != 'undefined' && productImage != null) {
            dados.append("original_name", productImage['name']);
            dados.append("image", productImage);
        }

        $.ajax({
            type: "post",
            url: "{{ url('rfi/store-file-byrfi/') }}",
            data: dados,
            // image: productImage,
            processData: false,
            contentType: false,
            success: function(response){
                console.log('SUCESSO', response);
                closeModalAttach();
                loadFilesById({{ Auth::user()->id }});

                $('#image-form')[0].reset();
            },
            error: function(errors) {

                if(errors.responseJSON.errors.comment) {
                    message_erro_aux = errors.responseJSON.errors.comment[0];
                    message_erro = message_erro_aux.replace("comment", "{{ __('messages.Description') }}")

                } else if(errors.responseJSON.errors.image) {
                    message_erro_aux = errors.responseJSON.errors.image[0];
                    message_erro = message_erro_aux.replace("image", "{{ __('messages.Attach the document') }}")

                } else {
                    message_erro = errors.responseJSON.errors;
                }

                document.getElementById("divErrorModal").style.display = "";
                document.getElementById("messageModal").textContent = message_erro;
                setTimeout(function() {
                    document.getElementById("divErrorModal").style.display = "none";
                }, 5000);


            }
        });


    });


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

                document.form_file_delete.id.value = id;

                var data = $('#form_file_delete').serialize();

                $.ajax({
                    type: 'post',
                    url: "{{ '/rfi/delete-file' }}",
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
                    loadFilesById({{ Auth::user()->id }})
                }, 200);

            }
        });

    }


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

                document.form_file_delete.id.value = id;

                var data = $('#form_file_delete').serialize();

                $.ajax({
                    type: 'post',
                    url: "{{ '/rfi/delete-file' }}",
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
                    loadFilesById();
                }, 200);

            }
        });

    }



    setTimeout(function() {
        // MARCAR O LINK NO SIDEBAR
        $('#link-rfi').addClass('active');

        fillAddress();
        loadRfiOverviewById();
        loadFilesById();

    }, 200);


    $(function() {
        $('input').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    });


</script>


@endsection
