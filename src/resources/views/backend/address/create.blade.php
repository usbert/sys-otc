@extends('backend.layouts.master')

@section('section')

@include('backend.includes.datatables')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>{{ __('messages.Button.Add New')}} Address</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('address-list') }}">Address</a></li>
              <li class="breadcrumb-item active">{{ __('messages.Button.Add New')}} Address</li>
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
                                                <h3 class="card-title">Addresses</h3>
                                            </div>

                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>Zip Code</label>
                                                            <div class="input-group input-group-sm">
                                                                <input type="text" name="prefix" id="prefix" class="form-control form-control-sm" value="">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <label>&nbsp;</label>
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-append">
                                                                <button type="button" class="btn btn-info btn-flat" onclick="fcSerchPrefix()">&nbsp;<span class="fas fa-search"></span></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            {{-- <label>{{__('messages.Address')}}</label> --}}
                                                            <label>Street</label>
                                                            <input type="text" name="street" id="street" class="form-control form-control-sm" value="">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>City</label>
                                                            {{-- <label>{{__('messages.Brand')}}</label> --}}
                                                            <select class="form-control form-control-sm" name="" id="">
                                                                <option value="">{{__('messages.Select')}}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>State</label>
                                                            {{-- <label>{{__('messages.Brand')}}</label> --}}
                                                            <select class="form-control form-control-sm" name="" id="" onclick="fillPrefix()">
                                                                <option value="">{{__('messages.Select')}}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>


                                                <div class="row">

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Complement</label>
                                                            {{-- <label>{{__('messages.Brand')}}</label> --}}
                                                            <input type="text" name="" id="" class="form-control form-control-sm" value="">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>Phone</label>
                                                            {{-- <label>{{__('messages.Brand')}}</label> --}}
                                                            <input type="text" name="" id="" class="form-control form-control-sm" value="">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            {{-- <label>{{__('messages.Brand')}}</label> --}}
                                                            <input type="text" name="" id="" class="form-control form-control-sm" value="">
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






        <!-- Modal -->
        <div class="modal fade" id="myModalCost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalAttachLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header" style="background-color: #6c757d; color: white;">
                    <h5 class="modal-title" id="myModalCostLabel">Labor</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModalAttach()"></button> --}}
                </div>
                <div class="modal-body">

                    {{-- start form modal --}}
                    <form action="{{ url('file/store/') }}" id="image-form" class="form-horizontal" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card-secondary">
                                        <div class="card-body">

                                            <input type="hidden" name="" id="">

                                            <div class="row">


                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Function</label>
                                                        <select class="form-control form-control-sm" name="" id="">
                                                            <option value="">-- {{__('messages.Select')}} --</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-2">
                                                    <label>Hours</label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="hours" id="hours" class="form-control form-control-sm" value=''>
                                                    </div>
                                                </div>

                                                <div class="col-sm-2">
                                                    <label>Rate</label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="hours" id="hours" class="form-control form-control-sm" value=''>
                                                    </div>
                                                </div>

                                                <div class="col-sm-2">
                                                    <label>&nbsp;</label>
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-append">
                                                            <button type="button" class="btn btn-info btn-flat" onclick="fcSerchItem()">&nbsp;<span class="fas fa-plus"></span></button>
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>

                                            <row>
                                                <table style="font-size: 14px;" class="table table-striped table-sm no-footer dataTable" id="ajax-crud-datatable" aria-describedby="ajax-crud-datatable_info">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" aria-controls="ajax-crud-datatable" style="width: 88%;" aria-sort="ascending">Function</th>
                                                            <th scope="col" aria-controls="ajax-crud-datatable" style="width: 10%; text-align: right;">Hour</th>
                                                            <th scope="col" aria-controls="ajax-crud-datatable" style="width: 10%; text-align: right;">Rate</th>
                                                            <th scope="col" aria-controls="ajax-crud-datatable" style="width: 10%; text-align: right;">Total $</th>
                                                            <th scope="col" aria-controls="ajax-crud-datatable" style="width: 1%;" aria-sort="ascending"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="sorting_1"><b>Assist. Project Manager</b></td>
                                                            <td style="text-align: right;"><b>2</b></td>
                                                            <td style="text-align: right;"><b>75,00</b></td>
                                                            <td style="text-align: right;"><b>150,00</b></td>
                                                            <td><a href="#" data-toggle="tooltip" onclick="" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                        </tr>

                                                    </tbody>
                                                </table>

                                            </row>

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
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" onclick="closeModalLaborAppropriation()">
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

         <!-- Modal -->
         <div class="modal fade" id="myModalAttach" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalAttachLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header" style="background-color: #6c757d; color: white;">
                    <h5 class="modal-title" id="myModalAttachLabel">Attach Photo</h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closeModalAttach()"></button> --}}
                </div>
                <div class="modal-body">

                    {{-- start form modal --}}
                    <form action="{{ url('file/store/') }}" id="image-form" class="form-horizontal" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card card-secondary">
                                        <div class="card-body">

                                            {{-- <input type="hidden" name="vehicle_id" id="vehicle_id"> --}}

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Description</label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="comment" id="comment" class="form-control form-control-sm" value=''>
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
                        {{-- {{ __('messages.Button.Close') }} --}}
                        Close
                    </button>
                    <button class="btn btn-sm btn-primary float-end" id="image-upload">
                        {{-- {{ __('messages.Attach') }} --}}
                        Attach
                    </button>
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
                url: "{{ url('model/store/') }}",
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
                    console.log('PARCIAL', errors.responseJSON.errors);

                    if(errors.responseJSON.errors.equipment_prefix_id) {
                        message_erro_aux = errors.responseJSON.errors.equipment_prefix_id[0];
                        message_erro = message_erro_aux.replace("equipment prefix id", " <b>{{__('messages.Equipment.Model')}}</b>")

                    } else if(errors.responseJSON.errors.prefix) {
                        message_erro_aux = errors.responseJSON.errors.prefix[0];
                        message_erro = message_erro_aux.replace("prefix", " <b>{{__('messages.Prefix.Prefix')}}</b>")

                    } else if(errors.responseJSON.errors.equipment_brand_id) {
                        message_erro_aux = errors.responseJSON.errors.equipment_brand_id[0];
                        message_erro = message_erro_aux.replace("equipment brand id", " <b>{{__('messages.Brand')}}</b>")

                    } else if(errors.responseJSON.errors.equipment_family_id) {
                        message_erro_aux = errors.responseJSON.errors.equipment_family_id[0];
                        message_erro = message_erro_aux.replace("equipment family id", " <b>{{__('messages.EquipmentFamily.Family')}}</b>")

                    } else if(errors.responseJSON.errors.name) {
                        message_erro_aux = errors.responseJSON.errors.name[0];
                        message_erro = message_erro_aux.replace("nome", "<b>{{ __('messages.Equipment.Model Description') }}</b>")

                    } else if(errors.responseJSON.errors.weight_measurment) {
                        message_erro_aux = errors.responseJSON.errors.weight_measurment[0];
                        message_erro = message_erro_aux.replace("weight measurment", "<b>{{ __('messages.Weight') }}</b>")

                    } else if(errors.responseJSON.errors.unit1) {
                        message_erro_aux = errors.responseJSON.errors.unit1[0];
                        message_erro = message_erro_aux.replace("unit1", "<b>{{ __('messages.Weight') }}</b>")

                    } else if(errors.responseJSON.errors.capacity_measurment) {
                        message_erro_aux = errors.responseJSON.errors.capacity_measurment[0];
                        message_erro = message_erro_aux.replace("capacity measurment", "<b>{{ __('messages.Capacity') }}</b>")

                    } else if(errors.responseJSON.errors.unit2) {
                        message_erro_aux = errors.responseJSON.errors.unit2[0];
                        message_erro = message_erro_aux.replace("unit2", "<b>{{ __('messages.Capacity') }}</b>")

                    } else if(errors.responseJSON.errors.power_measurment) {
                        message_erro_aux = errors.responseJSON.errors.power_measurment[0];
                        message_erro = message_erro_aux.replace("power measurment", "<b>{{ __('messages.Power') }}</b>")

                    } else if(errors.responseJSON.errors.unit3) {
                        message_erro_aux = errors.responseJSON.errors.unit3[0];
                        message_erro = message_erro_aux.replace("unit3", "<b>{{ __('messages.Power') }}</b>")

                    } else if(errors.responseJSON.errors.tank_capacity) {
                        message_erro_aux = errors.responseJSON.errors.tank_capacity[0];
                        message_erro = message_erro_aux.replace("tank capacity", "<b>{{ __('messages.Tank Capacity') }}</b>")

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


        // $(function() {
        //     $('input').keyup(function() {
        //         this.value = this.value.toLocaleUpperCase();
        //     });
        // });

        function fillPrefix() {
            if(document.getElementById("equipment_prefix_id").value > '') {
                var tri = $("#equipment_prefix_id option:selected").text();
                document.getElementById("prefix").value = tri.substr(0,3);
            }

        }




        function openModalCost() {
            $('#myModalCost').modal({
                backdrop: 'static',
                keyboard: false
            });
        }
        function closeModalCost() {
            $('#myModalCost').modal('hide');
            return false;
        }



        function openModalAttach() {

            $('#myModalAttach').modal({
                backdrop: 'static',
                keyboard: false
            });

            // clear modal form when opened
            $('#image-form')[0].reset();

            // setTimeout(function() {

            //     document.getElementById("vehicle_id").value = document.getElementById("id").value;
            //     document.getElementById("project_id").value = document.getElementById("projectId").value;
            // }, 100);


            }

            function closeModalAttach() {
                $('#myModalAttach').modal('hide');
                return false;
            }


            setTimeout(function() {

                // MARCAR O LINK NO SIDEBAR
                $('#link4').addClass('active');

            }, 100);


    </script>

    <script src="{{ asset('backend/dist/js/decimal.js') }}"></script>

@endsection
