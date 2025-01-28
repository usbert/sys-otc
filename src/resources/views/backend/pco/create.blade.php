@extends('backend.layouts.master')

@section('section')

@include('backend.includes.datatables')

{{-- SERVICE ITEMS --}}
@include('backend.includes.pco.function-service-item-add')
@include('backend.includes.pco.function-service-item-get')              {{-- Carrega nos inputs os dados do Itens de Seviço para alteração - fcGetServiceItemRow(id, indx) --}}
@include('backend.includes.pco.function-service-item-cancel')           {{-- Cancela alteração do Itens de Seviço --}}
@include('backend.includes.pco.function-service-item-update')           {{-- Altera o Item de Seviço selecionado - fcUpdateServiceItem --}}
@include('backend.includes.pco.function-service-items-by-user')         {{-- Monta a tabela de Itens de Serviços por usuário --}}
@include('backend.includes.pco.function-service-item-delete')           {{-- Deleta Itens de Serviços --}}
{{-- LABOR APPROPRIATIONS --}}
@include('backend.includes.pco.function-labor-appropriation-add')       {{-- Adicionar Labor Appropriation --}}
@include('backend.includes.pco.function-labor-appropriation-delete')    {{-- Deleta Labor Appropriation --}}
@include('backend.includes.pco.function-labor-appropriation-by-user')   {{-- Monta a DataTable de Labor Appropriation por usuário --}}
@include('backend.includes.pco.function-labor-appropriation-get')       {{-- Carrega nos inputs os dados do Labor Appropriation para alteração - fcGetLaborAppropriationRow(id, indx) --}}
@include('backend.includes.pco.function-labor-appropriation-update')    {{-- fcUpdateLaborAppropriation() --}}


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

                                                <input type="hidden" name="client_id" id="client_id">
                                                <input type="hidden" name="locale" id="locale" value="{{ Config::get('app.locale') }}">


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

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>{{__('messages.Responsible')}}</label>
                                                            <input type="text" name="project_manager" id="project_manager" class="form-control form-control-sm" value="">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>{{__('messages.State')}}</label>
                                                            <input type="text" name="state" id="state" class="form-control form-control-sm" value="" readonly="readonly">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Email (ATTN)</label>
                                                            <input type="text" name="email" id="email" class="form-control form-control-sm" value="" readonly="readonly">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>{{__('messages.PCO Date')}}</label>
                                                            <input type="date" name="pco_date" id="pco_date" class="form-control form-control-sm">
                                                        </div>
                                                    </div>



                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>RFI</label>
                                                            <select class="form-control form-control-sm" name="rfi_id" id="rfi_id">
                                                                <option value="">{{__('messages.Select')}}</option>
                                                                @foreach ($result['rfiCombo'] as $rfi)
                                                                    <option value="{{ $rfi->id }}"> {{ $rfi->code }}</option>
                                                                @endforeach
                                                            </select>
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
                                                            <textarea class="form-control" name="description" id="description" rows="3"></textarea>
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

                                                        {{-- <input type="hidden" name="service_item_id" id="service_item_id"> --}}

                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            <select class="form-control form-control-sm" name="level_01" id="level_01">
                                                                <option value="">{{__('messages.Select')}}</option>
                                                                @for($x=1; $x<100; $x++)
                                                                    <option value="{{ $x }}">{{ $x }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <div class="form-group">
                                                            <label>&nbsp;</label>
                                                            <select class="form-control form-control-sm" name="level_02" id="level_02">
                                                                <option value="">{{__('messages.Select')}}</option>
                                                                @for($x=0; $x<100; $x++)
                                                                    <option value="{{ $x }}">{{ $x }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label>Item Description</label>
                                                            <input type="text" name="item_description" id="item_description" class="form-control form-control-sm" value="" maxlength="150">
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="item_cost" id="item_cost">

                                                    {{-- <div class="col-sm-2">
                                                        <div class="form-group">
                                                            <label>Item Cost</label>
                                                            <input type="text" name="item_cost" id="item_cost" class="form-control form-control-sm"
                                                            maxlength="6"
                                                            @if("{{ Config::get('app.locale') }}" == 'pt_BR')
                                                            {
                                                                onkeypress="return fc_decimal(this, '.', ',', event, 8);"
                                                            }
                                                            @else {
                                                                onkeypress="return fc_decimal(this,',','.',event, 8);"
                                                            }
                                                            @endif
                                                            value=""
                                                            >
                                                        </div>
                                                    </div> --}}


                                                    <div class="col-sm-1">
                                                        <label>&nbsp;</label>
                                                        <div class="input-group input-group-sm">
                                                            <span class="input-group-append">
                                                                <button type="button" class="btn btn-info btn-flat" onclick="fcAddServiceItem()"    id="btnSaveSI" title="Add">&nbsp;<span class="fas fa-plus"></span></button>
                                                                <button type="button" class="btn btn-info btn-flat" onclick="fcUpdateServiceItem()" id="btnUpdateSI" title="Update" style="display: none;">&nbsp;<span class="fas fa-sync"></span></button>&nbsp;
                                                                <button type="button" class="btn btn-danger btn-flat" onclick="fcCancelServiceItemRow()" id="btnCancelSI" title="Cancel" style="display: none;">&nbsp;<span class="fas fa-ban"></span></button>
                                                            </span>
                                                        </div>
                                                    </div>


                                                </div>


                                                <div class="row">

                                                    <div class="col-sm-12">
                                                        <table style="font-size: 14px;" class="table table-striped table-sm" id="ajax-datatable-service-item">
                                                        {{-- <table style="font-size: 14px;" class="table table-striped table-sm no-footer dataTable" id="ajax-datatable-service-item" aria-describedby="ajax-crud-datatable_info"> --}}
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col" aria-controls="ajax-datatable-service-item" aria-sort="ascending">#</th>
                                                                    <th scope="col" aria-controls="ajax-datatable-service-item" aria-sort="ascending">Item Description</th>
                                                                    <th scope="col" aria-controls="ajax-datatable-service-item" style="text-align: right;">Item Cost</th>
                                                                    {{-- <th scope="col" aria-controls="ajax-datatable-service-item" style="width: 10%; text-align: right;">Avanço</th>
                                                                    <th scope="col" aria-controls="ajax-datatable-service-item" style="width: 10%; text-align: right;">Status</th> --}}
                                                                    <th scope="col" aria-controls="ajax-datatable-service-item" aria-sort="ascending"></th>
                                                                    <th scope="col" aria-controls="ajax-datatable-service-item" aria-sort="ascending"></th>
                                                                    <th scope="col" aria-controls="ajax-datatable-service-item" aria-sort="ascending"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="divBodyIS">

                                                            </tbody>

                                                            {{-- <tbody> --}}
                                                                {{-- <tr>
                                                                    <th scope="col" aria-controls="ajax-crud-datatable" style="width: 1%;" aria-sort="ascending"><b>1</b></th>
                                                                    <td class="sorting_1"><b>EXTENDING THE WALL OF ELECTRICAL CLOSET B10</b></td>
                                                                    <td style="text-align: right;"><b>935,00</b></td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="" data-id="18" class="delete"></td>
                                                                </tr> --}}


                                                                {{-- ACRESCENTAR MAIS TARDE --}}
                                                                {{-- <td style="text-align: right;">100%</td>
                                                                <td><span class="pull-right badge bg-green" style="font-size: 12px;">Completed</span></td> --}}



                                                                {{-- TOTAIS --}}
                                                                {{-- <tr>
                                                                    <td></td>
                                                                    <td style="text-align: right; font-weight: bold;" class="sorting_3">Total Labor</td>
                                                                    <td style="text-align: right; font-weight: bold;" style="text-align: left; font-weight: bold;">25,435.00</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                </tr> --}}
                                                            {{-- </tbody> --}}
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

                                                                {{-- <tr>
                                                                    <td>20 GA 3-5/8" Stud</td>
                                                                    <td>3</td>
                                                                    <td>ea</td>
                                                                    <td>16.00</td>
                                                                    <td style="text-align: right;">55.20</td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                </tr> --}}



                                                                {{-- TOTAIS MATERIAIS --}}
                                                                {{-- <tr>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="text-align: right; font-weight: bold;" class="sorting_3">Total Material Costs</td>
                                                                    <td style="text-align: right; font-weight: bold;" style="text-align: left; font-weight: bold;">2,996.90</td>
                                                                    <td></td>
                                                                </tr> --}}

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

                                                                {{-- <tr>
                                                                    <td>Assumptions</td>
                                                                    <td>Material Cost Price Includes Mark Up. 15%</td>
                                                                    <td><a href="#" data-toggle="tooltip" onclick="deleteReg(18)" data-id="18" class="delete"><span class="fas fa-trash"></span></a></td>
                                                                </tr> --}}

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



                            </div>

                        </form>

                    </div>

                </div>

            </div>

      </div>




        <!-- Modal Labor Appropriation -->

        <div class="modal fade" id="myModalCost" tabindex="-1" role="dialog" aria-labelledby="myModalAttachLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header" style="background-color: #6c757d; color: white;">
                    <h5 class="modal-title" id="myModalCostLabel">Labor Appropriations</h5>
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

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Service Item</label>
                                                        <div class="input-group input-group-sm">
                                                            <input type="text" id="itemModalTxt" class="form-control form-control-sm" @readonly(true)>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">



                                                <div class="col-sm-6">

                                                    <input type="hidden" name="labor_appropriation_id" id="labor_appropriation_id" value="">
                                                    <input type="hidden" name="service_item_labor" id="service_item_labor" value="">

                                                    <div class="form-group">
                                                        <label>Function</label>
                                                        <select class="form-control form-control-sm" name="employee_role_id" id="employee_role_id">
                                                            <option value="">-- {{__('messages.Select')}} --</option>
                                                            @foreach ($result['employeeRoleCombo'] as $rule)
                                                                <option value="{{ $rule->id }}"> {{ $rule->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-2">
                                                    <label>Hours</label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="hours" id="hours" class="form-control form-control-sm"
                                                            maxlength="5"
                                                            @if("{{ Config::get('app.locale') }}" == 'pt_BR')
                                                            {
                                                                onkeypress="return fc_decimal(this, '.', ',', event, 5);"
                                                            }
                                                            @else {
                                                                onkeypress="return fc_decimal(this,',','.',event, 5);"
                                                            }
                                                            @endif
                                                        >
                                                    </div>
                                                </div>

                                                <div class="col-sm-2">
                                                    <label>Rate</label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="rate" id="rate" class="form-control form-control-sm"
                                                        maxlength="9"
                                                        @if("{{ Config::get('app.locale') }}" == 'pt_BR')
                                                        {
                                                            onkeypress="return fc_decimal(this, '.', ',', event, 9);"
                                                        }
                                                        @else {
                                                            onkeypress="return fc_decimal(this,',','.',event, 9);"
                                                        }
                                                        @endif
                                                        >
                                                    </div>
                                                </div>

                                                <div class="col-sm-2">
                                                    <label>&nbsp;</label>
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-append">
                                                            <button type="button" class="btn btn-info btn-flat" onclick="fcAddLaborAppropriation()"     id="btnSaveLaborAppropriation" title="Add">&nbsp;<span class="fas fa-plus"></span></button>
                                                            <button type="button" class="btn btn-info btn-flat" onclick="fcUpdateLaborAppropriation()"  id="btnUpdateLaborAppropriation" title="Update" style="display: none;">&nbsp;<span class="fas fa-sync"></span></button>&nbsp;
                                                            <button type="button" class="btn btn-danger btn-flat" onclick="fcCancelLaborRow()"          id="btnCancelLaborAppropriation" title="Cancel" style="display: none;">&nbsp;<span class="fas fa-ban"></span></button>
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="tab-content">

                                                            <table style="font-size: 14px;" class="table table-striped table-sm" id="ajax-datatable-labor-appropriation">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">{{ __('messages.Function') }}</th>
                                                                        <th scope="col">{{ __('messages.Hour') }}</th>
                                                                        <th scope="col">{{ __('messages.Rate') }}</th>
                                                                        <th scope="col">{{ __('messages.Total') }}</th>
                                                                        <th></th>
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


        <form name="formItemService" id="formItemService" class="form-horizontal" method="POST">
            @csrf
            <input type="hidden" name="service_item_id" id="service_item_id">
            <input type="hidden" name="level_01" value="">
            <input type="hidden" name="level_02" value="">
            <input type="hidden" name="item_description" value="">
            <input type="hidden" name="item_cost" value="">
        </form>


        <form name="form_data_delete_by_user" id="form_data_delete_by_user" method="POST">
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            @csrf
        </form>

        <form name="form_delete_service_item" id="form_delete_service_item" method="POST">
            <input type="hidden" name="id" value="">
            @csrf
        </form>

        <form name="form_delete_labor_appropriation" id="form_delete_labor_appropriation" method="POST">
            <input type="hidden" name="id" value="">
            @csrf
        </form>


    </section>
    <!-- /.content -->

    <style>
        input, select { margin-bottom: 8px; }


        /* #myModalCost .modal-dialog{

            width:80%;

        } */

        .modal-content {
                width: 800px;
                margin-left: 15%;
            }
            .model-modal  {
                width: 1200px;
                margin-left: 15%;
        }

        .modal-dialog  {
                width: 1200px;
                margin-left: 15%;
        }

        /* #ajax-datatable-service-item td:nth-of-type(1) {
            font-weight: bold;
        } */

    </style>

    <script>

        // ********* SAVING FORM **********
        $(".submit-form").click(function(e) {

            e.preventDefault();
            var data = $('#form-data').serialize();

            $.ajax({
                type: 'post',
                url: "{{ url('pco/store/') }}",
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

                    } else if(errors.responseJSON.errors.pco_date) {
                        message_erro_aux = errors.responseJSON.errors.pco_date[0];
                        message_erro = message_erro_aux.replace("pco date", "<b>{{ __('messages.PCO Date') }}</b>")

                    } else if(errors.responseJSON.errors.description) {
                        message_erro_aux = errors.responseJSON.errors.description[0];
                        message_erro = message_erro_aux.replace("description", "<b>{{ __('messages.Description') }}</b>")


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

                        // console.log(response);

                        document.getElementById("client_name").value =  response.project[0]['client_name'];
                        document.getElementById("address").value =  response.project[0]['street'];
                        document.getElementById("city").value =  response.project[0]['city'];
                        document.getElementById("state").value =  response.project[0]['state'];
                        document.getElementById("client_id").value =  response.project[0]['client_id'];
                        document.getElementById("project_manager").value =  response.project[0]['project_manager'];
                        document.getElementById("email").value =  response.project[0]['email'];

                        return false;

                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });



            }

        }


        function openModalLaborAppropriation(id, indx) {

            document.getElementById("service_item_labor").value = id;
            document.getElementById('itemModalTxt').value = document.getElementById("colSI-A-"+indx+"").innerText+'. '+document.getElementById("colSI-B-"+indx+"").innerText;

            $('#myModalCost').modal({
                backdrop: 'static',
                keyboard: false
            });

            setTimeout(function() {
                loadLaborAppropriationByUser(id, {{ Auth::user()->id }})
            }, 300);


        }

        function closeModalLaborAppropriation() {
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


            $('#link-pco').addClass('active');


        // ENTER DISABLED
        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                event.preventDefault();
                return false;
                }
            });
        });



        // Clear all temporary service items records
        setTimeout(function() {

            var data = $('#form_data_delete_by_user').serialize();

            $.ajax({
                type: 'post',
                url: "{{ 'delete-service-item-by-user' }}",
                data: data,
                success: function(response){
                    console.log('chegou');
                },
                error: function(errors) {
                    console.log('ERRO: ', errors.responseJSON);
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },


            });

        }, 150);





    </script>

    <script src="{{ asset('backend/dist/js/decimal.js') }}"></script>


@endsection
