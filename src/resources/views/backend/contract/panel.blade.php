@extends('backend.layouts.master')

@section('section')

@include('backend.includes.datatables')

<section id="loading">
    <div id="loading-content"></div>
  </section>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>{{ __('messages.Contract') }}s</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ __('messages.Contract') }}s</li>
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


            <div style="padding: 5px; width: 100%; text-align: center;">

                <table style="font-size: 14px;" class="table table-striped table-sm" id="ajax-crud-datatable">
                    <tr>
                        <td>


                            <div class="row">

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <a href="{{ url('contract/') }}" class="btn btn-block btn-outline-secondary">
                                            <i class="fas fa-marker fa-2x"></i>
                                            <br>
                                            <label>{{ __('messages.Contracts List') }}</label>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <a href="{{ url('contract/equipment-contract/') }}" class="btn btn-block btn-outline-secondary">
                                            <i class="fas fa-marker fa-2x"></i>
                                            <br>
                                            <label>{{ __('messages.Equipment Contract') }}</label>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <a href="#" class="btn btn-block btn-outline-secondary" style="color: #cac9c9;">
                                            <i class="fas fa-print fa-2x"></i>
                                            <br>
                                            <label>{{ __('messages.Contract Report') }}</label>
                                        </a>
                                    </div>
                                </div>

                            </div>

                        </td>
                    </tr>

              </table>

            </div>


        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->


  </div>




 <style>

     @keyframes spin {
         0% { transform: rotate(0deg); }
         100% { transform: rotate(360deg); }
     }

     .content-header {
         padding: 0%;
     }

 </style>


@endsection
