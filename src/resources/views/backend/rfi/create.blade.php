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

                                                        <div class="col-sm-10">
                                                            <div class="form-group">

                                                                <table style="font-size: 14px;" class="table table-striped table-sm" id="ajax-crud-datatable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">{{ __('messages.Question') }}</th>
                                                                            <th scope="col">{{ __('messages.Sugestion') }}</th>
                                                                            <th scope="col">{{ __('messages.From') }}</th>
                                                                            <th scope="col">{{ __('messages.Customer Response') }}</th>
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
                    <form name="formLaborAppropriation" id="formLaborAppropriation" class="form-horizontal" method="POST">

                        @csrf

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card-secondary">
                                        <div class="card-body">


                                            <div class="row">

                                                <div class="col-sm-10">
                                                    <div class="form-group">
                                                        <label>{{__('messages.Question')}}</label>
                                                        <textarea class="form-control" name="reference" id="reference" rows="2"
                                                        style="border-bottom-color: black;"
                                                        ></textarea>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-sm-10">
                                                    <div class="form-group">
                                                        <label>{{__('messages.Sugestion')}}</label>
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
                    <button class="btn btn-sm btn-primary float-end" id="image-upload">
                        {{ __('messages.Button.Save') }}
                    </button>
                </div>
                </div>
            </div>
        </div>



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

                // document.getElementById("service_item_labor").value = id;
                // document.getElementById('itemModalTxt').value = document.getElementById("colSI-A-"+indx+"").innerText+'. '+document.getElementById("colSI-B-"+indx+"").innerText;
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



            // ********* SAVING FORM **********
            $(".submit-form").click(function(e) {

                e.preventDefault();
                var data = $('#form-data').serialize();

                $.ajax({
                    type: 'post',
                    url: "{{ url('contact/store/') }}",
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
                $('#link-rfi').addClass('active');
            }, 100);


            $(function() {
                $('input').keyup(function() {
                    this.value = this.value.toLocaleUpperCase();
                });
            });

    </script>


@endsection
