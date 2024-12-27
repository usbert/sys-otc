@extends('backend.layouts.master')

@section('section')

@include('backend.includes.datatables')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>{{ __('messages.Button.Add New')}} PCO</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('pco-list') }}">PCO</a></li>
              <li class="breadcrumb-item active">{{ __('messages.Button.Add New')}} PCO</li>
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
                                                <h3 class="card-title">PCO</h3>
                                            </div>

                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Project')}}</label>
                                                            <select class="form-control form-control-sm" name="" id="" onclick="fillPrefix()">
                                                                @foreach ($result['projectCombo'] as $prj)
                                                                    <option value="{{ $prj->id }}"> {{ $prj->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Address')}}</label>
                                                            <input type="text" name="" id="" class="form-control form-control-sm" value="44-56 Soldiers Field Place" readonly="readonly">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>GC</label>
                                                            <input type="text" name="" id="" class="form-control form-control-sm" value="Reynolds Construction Services, Inc" readonly="readonly">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>{{__('messages.City')}}</label>
                                                            <input type="text" name="" id="" class="form-control form-control-sm" value="Boston" readonly="readonly">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Responsible')}}</label>
                                                            <input type="text" name="" id="" class="form-control form-control-sm" value="Amy Boehcke" readonly="readonly">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>{{__('messages.State')}}</label>
                                                            <input type="text" name="" id="" class="form-control form-control-sm" value="MA, 02135" readonly="readonly">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>ATTN</label>
                                                            <input type="text" name="" id="" class="form-control form-control-sm" value="Amy Boehcke<amyboehcke@xxxx.com>" readonly="readonly">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>Date</label>
                                                            <input type="date" name="" id="" class="form-control form-control-sm">
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
                                                <h3 class="card-title">Labor Breakdown</h3>
                                            </div>

                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-sm-10">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Description')}}</label>
                                                            <textarea class="form-control" rows="3">Provide all necessary skilled labor and materials to execute the modifications outlined in ASI #40. This includes extending Wall B10 on the electrical closet and adjusting the exterior perimeter wall to extend the DensGlass sheathing and rigid insulation down past the top of the concrete foundation, securing it to the 1" Z-furring attached to the concrete wall. All work must comply with the project specifications and standards.</textarea>
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
                                                <h3 class="card-title">Service Item</h3>
                                            </div>

                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            {{-- <input type="text" name="" id="" class="form-control form-control-sm" value=""> --}}
                                                            <select class="form-control form-control-sm" name="" id="">
                                                                <option value="">{{__('messages.Select')}}</option>
                                                                @for($x=1; $x<100; $x++)
                                                                    <option value="">{{ $x }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            {{-- <input type="text" name="" id="" class="form-control form-control-sm" value=""> --}}
                                                            <select class="form-control form-control-sm" name="" id="">
                                                                <option value="">{{__('messages.Select')}}</option>
                                                                @for($x=1; $x<100; $x++)
                                                                    <option value="">{{ $x }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            {{-- <input type="text" name="" id="" class="form-control form-control-sm" value=""> --}}
                                                            <select class="form-control form-control-sm" name="" id="">
                                                                <option value="">{{__('messages.Select')}}</option>
                                                                @for($x=1; $x<100; $x++)
                                                                    <option value="">{{ $x }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Item Description</label>
                                                            <input type="text" name="" id="" class="form-control form-control-sm" value="">
                                                            {{-- <select class="form-control form-control-sm" name="" id="" onclick="fillPrefix()">
                                                                <option value="">{{__('messages.Select')}}</option>
                                                            </select> --}}
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>Item Cost</label>
                                                            <input type="text" name="item_cost" id="item_cost   " class="form-control form-control-sm"
                                                            maxlength="6"
                                                            {{-- @if("{{ Config::get('app.locale') }}" == 'pt_BR')
                                                            { --}}
                                                            onkeypress="return fc_decimal(this, '.', ',', event, 7);"
                                                            {{-- }
                                                            @else {
                                                                onkeypress="return fc_formatar_moeda(this,',','.',event, 7);"
                                                            }
                                                            @endif --}}
                                                            >
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-1">
                                                        <label>&nbsp;</label>
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-append">
                                                                <button type="button" class="btn btn-info btn-flat" onclick="fcSerchItem()">&nbsp;<span class="fas fa-plus"></span></button>
                                                            </span>
                                                        </div>
                                                    </div>


                                                </div>


                                                <div class="row">

                                                    <div class="col-sm-12">
                                                        <table style="font-size: 14px;" class="table table-striped table-sm no-footer dataTable" id="ajax-crud-datatable" aria-describedby="ajax-crud-datatable_info">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 1%;" aria-sort="ascending"></th>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 88%;" aria-sort="ascending">Service Item</th>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 10%; text-align: right;">Item Cost</th>
                                                                    {{-- <th scope="col" aria-controls="ajax-crud-datatable" style="width: 10%; text-align: right;">Avanço</th>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 10%; text-align: right;">Status</th> --}}
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 1%;" aria-sort="ascending"></th>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 1%;" aria-sort="ascending"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 1%;" aria-sort="ascending"><b>1</b></th>
                                                                    <td class="sorting_1"><b>EXTENDING THE WALL OF ELECTRICAL CLOSET B10</b></td>
                                                                    <td style="text-align: right;"><b>935,00</b></td>
                                                                    {{-- <td style="text-align: right;"><b>29%</b></td>
                                                                    <td><span class="pull-right badge bg-yellow" style="font-size: 12px;">In Progress</span></td> --}}
                                                                    <td><a href="#" data-toggle="tooltip" onclick="" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="" data-id="18" class="delete"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 1%;" aria-sort="ascending"><b>1.1</b></th>
                                                                    <td class="sorting_2">Material Procurement and layout.</td>
                                                                    <td style="text-align: right;">150,00</td>
                                                                    {{-- <td style="text-align: right;">100%</td>
                                                                    <td><span class="pull-right badge bg-green" style="font-size: 12px;">Completed</span></td> --}}
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                    <td><a href="javascript:openModalCost()" data-toggle="tooltip" data-id="18" class="delete"><span class="fas fa-hard-hat"></span></a><td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 1%;" aria-sort="ascending"><b>1.2</b></th>
                                                                    <td class="sorting_3">Extending the wall frame in the B10 electrical closet - Wall Type 5D</td>
                                                                    <td style="text-align: right;">225,00</td>
                                                                    {{-- <td style="text-align: right;">35%</td>
                                                                    <td><span class="pull-right badge bg-yellow" style="font-size: 12px;">In Progress</span></td> --}}
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="" data-id="18" class="delete"><span class="fas fa-hard-hat"></span></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 1%;" aria-sort="ascending"><b>1.3</b></th>
                                                                    <td class="sorting_3">Installation of Drywall.</td>
                                                                    <td style="text-align: right;">150,00</td>
                                                                    {{-- <td style="text-align: right;">10%</td>
                                                                    <td><span class="pull-right badge bg-yellow" style="font-size: 12px;">In Progress</span></td> --}}
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="" data-id="18" class="delete"><span class="fas fa-hard-hat"></span></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 1%;" aria-sort="ascending"><b>1.4</b></th>
                                                                    <td class="sorting_3">Finish and tape level 4.</td>
                                                                    <td style="text-align: right;">300,00</td>
                                                                    {{-- <td style="text-align: right;">0%</td>
                                                                    <td><span class="pull-right badge bg-red" style="font-size: 12px;">Pending</span></td> --}}
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="" data-id="18" class="delete"><span class="fas fa-hard-hat"></span></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 1%;" aria-sort="ascending"><b>1.5</b></th>
                                                                    <td class="sorting_3">Clean up.</td>
                                                                    <td style="text-align: right;">110,00</td>
                                                                    {{-- <td style="text-align: right;">0%</td>
                                                                    <td><span class="pull-right badge bg-red" style="font-size: 12px;">Pending</span></td> --}}
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="" data-id="18" class="delete"><span class="fas fa-hard-hat"></span></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 1%;" aria-sort="ascending"><b>2</b></th>
                                                                    <td class="sorting_1"><b>PERIMETER WALL CHANGES</b></td>
                                                                    <td style="text-align: right;"><b>24,500.00</b></td>
                                                                    {{-- <td style="text-align: right;"><b>100%</b></td>
                                                                    <td><span class="pull-right badge bg-green" style="font-size: 12px;">Completed</span></td> --}}
                                                                    <td><a href="#" data-toggle="tooltip" onclick="" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="" data-id="18" class="delete"></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 1%;" aria-sort="ascending"><b>2.1</b></th>
                                                                    <td class="sorting_2">Material Procurement</td>
                                                                    <td style="text-align: right;">18,000.00</td>
                                                                    {{-- <td style="text-align: right;">100%</td>
                                                                    <td><span class="pull-right badge bg-green" style="font-size: 12px;">Completed</span></td> --}}
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="" data-id="18" class="delete"><span class="fas fa-hard-hat"></span></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 1%;" aria-sort="ascending"><b>2.2</b></th>
                                                                    <td class="sorting_2">Layout and proper installation of Shimming correct uneven surface of foundation ensuring smooth transition;</td>
                                                                    <td style="text-align: right;">2,600.00</td>
                                                                    {{-- <td style="text-align: right;">100%</td>
                                                                    <td><span class="pull-right badge bg-green" style="font-size: 12px;">Completed</span></td> --}}
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="" data-id="18" class="delete"><span class="fas fa-hard-hat"></span></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 1%;" aria-sort="ascending"><b>2.3</b></th>
                                                                    <td class="sorting_2">Installation of new Z-girt to secure the 1" Rigid Insulation;</td>
                                                                    <td style="text-align: right;">2,600.00</td>
                                                                    {{-- <td style="text-align: right;">100%</td>
                                                                    <td><span class="pull-right badge bg-green" style="font-size: 12px;">Completed</span></td> --}}
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="" data-id="18" class="delete"><span class="fas fa-hard-hat"></span></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 1%;" aria-sort="ascending"><b>2.4</b></th>
                                                                    <td class="sorting_2">installation of new 1" Rigid Insulation;</td>
                                                                    <td style="text-align: right;">1,300.00</td>
                                                                    {{-- <td style="text-align: right;">100%</td>
                                                                    <td><span class="pull-right badge bg-green" style="font-size: 12px;">Completed</span></td> --}}
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="" data-id="18" class="delete"><span class="fas fa-hard-hat"></span></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td style="text-align: right; font-weight: bold;" class="sorting_3">Total Labor</td>
                                                                    <td style="text-align: right; font-weight: bold;" style="text-align: left; font-weight: bold;">25,435.00</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>


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
                                                <h3 class="card-title">Material Item</h3>
                                            </div>

                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <select class="form-control form-control-sm" name="" id="">
                                                                {{-- <option value="">{{__('messages.Select')}}</option> --}}
                                                                <option>xxxxxx</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>Quantity</label>
                                                            <input type="text" name="item_cost" id="" class="form-control form-control-sm" maxlength="6" onkeypress="return fc_formatar_moeda(this,',','.',event, 7);">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>Unit</label>
                                                            <input type="text" name="" id="" class="form-control form-control-sm" maxlength="6">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>Cost</label>
                                                            <input type="text" name="" id="" class="form-control form-control-sm" maxlength="6" onkeypress="return fc_formatar_moeda(this,',','.',event, 7);">
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-1">
                                                        <label>&nbsp;</label>
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-append">
                                                                <button type="button" class="btn btn-info btn-flat">&nbsp;<span class="fas fa-plus"></span></button>
                                                            </span>
                                                        </div>
                                                    </div>


                                                </div>


                                                <div class="row">

                                                    <div class="col-sm-12">
                                                        <table style="font-size: 14px;" class="table table-striped table-sm no-footer dataTable" id="ajax-crud-datatable" aria-describedby="ajax-crud-datatable_info">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 49%;" aria-sort="ascending">Description</th>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 10%;">Quantity</th>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 10%;">Unit</th>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 10%;">Cost</th>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 20%; text-align: right;">Total +15%</th>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 1%;" aria-sort="ascending"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <tr>
                                                                    <td>20 GA 3-5/8" Stud</td>
                                                                    <td>3</td>
                                                                    <td>ea</td>
                                                                    <td>16.00</td>
                                                                    <td style="text-align: right;">55.20</td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>20 GA 3-5/8" Track</td>
                                                                    <td>2</td>
                                                                    <td>ea</td>
                                                                    <td>12.00</td>
                                                                    <td style="text-align: right;">27.60</td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>4' x 8' x 5/8" Type X Drywall</td>
                                                                    <td>2</td>
                                                                    <td>ea</td>
                                                                    <td>23.00</td>
                                                                    <td style="text-align: right;">52.90</td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>4' x 8' x 5/8" Type X Drywall</td>
                                                                    <td>1</td>
                                                                    <td>ea</td>
                                                                    <td>150.00</td>
                                                                    <td style="text-align: right;">172.50</td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>1" Z-FURRING</td>
                                                                    <td>1</td>
                                                                    <td>ea</td>
                                                                    <td>900.00</td>
                                                                    <td style="text-align: right;">1,035.00</td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>1" Rigid Insulation</td>
                                                                    <td>1</td>
                                                                    <td>ea</td>
                                                                    <td>720.00</td>
                                                                    <td style="text-align: right;">828.00</td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Sheathing Mis. Items</td>
                                                                    <td>1</td>
                                                                    <td>ea</td>
                                                                    <td>250.00</td>
                                                                    <td style="text-align: right;">287.00</td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                </tr>


                                                                <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="text-align: right; font-weight: bold;" class="sorting_3">Total Material Costs</td>
                                                                    <td style="text-align: right; font-weight: bold;" style="text-align: left; font-weight: bold;">2,996.90</td>
                                                                    <td></td>
                                                                </tr>

                                                            </tbody>
                                                        </table>


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
                                                <h3 class="card-title">PCO General Notes</h3>
                                            </div>

                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>Type</label>
                                                            <select class="form-control form-control-sm" name="" id="">
                                                                {{-- <option value="">{{__('messages.Select')}}</option> --}}
                                                                <option>Assumptions</option>
                                                                <option>Exclusions</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <input type="text" name="item_cost" id="" class="form-control form-control-sm" maxlength="6" onkeypress="return fc_formatar_moeda(this,',','.',event, 7);">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-1">
                                                        <label>&nbsp;</label>
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-append">
                                                                <button type="button" class="btn btn-info btn-flat">&nbsp;<span class="fas fa-plus"></span></button>
                                                            </span>
                                                        </div>
                                                    </div>


                                                </div>


                                                <div class="row">

                                                    <div class="col-sm-12">
                                                        <table style="font-size: 14px;" class="table table-striped table-sm no-footer dataTable" id="ajax-crud-datatable" aria-describedby="ajax-crud-datatable_info">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 19%;" aria-sort="ascending">Type</th>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 80%;">Description</th>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 1%;" aria-sort="ascending"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <tr>
                                                                    <td>Assumptions</td>
                                                                    <td>Material Cost Price Includes Mark Up. 15%</td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Assumptions</td>
                                                                    <td>Rates are based on regular hours of operation.</td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Exclusions</td>
                                                                    <td>AVB is excluded.</td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                </tr>

                                                            </tbody>
                                                        </table>


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



                                <div class="row" style="margin-top: 20px;">

                                    <div class="col-sm-12">

                                        <div class="card card-secondary">

                                            <div class="card-header">
                                                <h3 class="card-title">Details or Pictures</h3>
                                            </div>

                                            <div class="card-body">

                                                <div class="row" style="margin-top: 20px;" id="session05">

                                                    <div class="col-sm-12">

                                                        <div class="panel-body">


                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <div class="tab-content">
                                                                            <table style="font-size: 14px; width: 98%" class="table table-striped table-sm" id="ajax-datatable-files">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th scope="col">Description</th>
                                                                                        <th scope="col">Picture</th>
                                                                                        <th>Show</th>
                                                                                        <th scope="col">
                                                                                            <button type="button" class="btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#myModalAttach" onclick="openModalAttach()">
                                                                                                <i class="fa fa-paperclip"></i>&nbsp;
                                                                                                {{-- {{ __('messages.Attach document') }} --}}
                                                                                            </button>
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>ASI#40 - A 1.0</td>
                                                                                        <td><img src="{{ URL('images/1.png') }}" class="img-fluid img-thumbnail" class="img-fluid img-thumbnail" alt="San Fran" style="width:204px;height:auto;"></td>
                                                                                        <td>
                                                                                            <div class="custom-control custom-switch">
                                                                                                <input type="checkbox" class="custom-control-input" name="a1" id="a1" checked>
                                                                                                <label class="custom-control-label" for="a1">&nbsp;</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>ASI#40 - A 1.0</td>
                                                                                        <td><img src="{{ URL('images/2.png') }}" class="img-fluid img-thumbnail" class="img-fluid img-thumbnail" alt="San Fran" style="width:204px;height:auto;"></td>
                                                                                        <td>
                                                                                            <div class="custom-control custom-switch">
                                                                                                <input type="checkbox" class="custom-control-input" name="a2" id="a2" checked>
                                                                                                <label class="custom-control-label" for="a2">&nbsp;</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                                    </tr>

                                                                                    <tr>
                                                                                        <td>ASI#40 - A-1.1E</td>
                                                                                        <td>
                                                                                            <img src="{{ URL('images/3.png') }}" class="img-fluid img-thumbnail" class="img-fluid img-thumbnail" alt="San Fran" style="width:204px;height:auto;">
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="custom-control custom-switch">
                                                                                                <input type="checkbox" class="custom-control-input" name="a3" id="a3">
                                                                                                <label class="custom-control-label" for="a3">&nbsp;</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>ASI#40 - A-1.1E</td>
                                                                                        <td>
                                                                                            <img src="{{ URL('images/4.png') }}" class="img-fluid img-thumbnail" class="img-fluid img-thumbnail" alt="San Fran" style="width:204px;height:auto;">
                                                                                            {{-- <img src="{{ Storage::url('app/public/4.png') }}" class="img-fluid img-thumbnail" />
                                                                                            <img src="{{ asset('/storage/app/public/4.jpg') }}" /> --}}
                                                                                        </td>
                                                                                        <td>
                                                                                            <div class="custom-control custom-switch">
                                                                                                <input type="checkbox" class="custom-control-input" name="a4" id="a4" checked>
                                                                                                <label class="custom-control-label" for="a4">&nbsp;</label>
                                                                                            </div>
                                                                                        </td>
                                                                                        <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>

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



                            </div>

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
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal" onclick="closeModalCost()">
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


            $('#link31').addClass('active');

    </script>

    <script src="{{ asset('backend/dist/js/decimal.js') }}"></script>

@endsection
