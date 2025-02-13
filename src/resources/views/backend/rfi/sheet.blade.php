@extends('backend.layouts.master')

@section('section')

    @include('backend.includes.datatables')

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">

        <!-- Default box -->
        <div class="card">

            <div class="card-body">

                <div class="row">

                    <div class="col-sm-12">

                        <div class="form-group">

                            @foreach ($result['rfis'] as $row => $r)

                                <div class="row">

                                    <div class="col-sm-12">

                                        <div class="card card-secondary">
                                            <div class="card-body">
                                                <div class="row">

                                                    <div class="col-sm-12">
                                                        <div class="form-group">

                                                            <div class="sheet-outer A4">
                                                                <section class="sheet padding-5mm">
                                                                    <table style="font-size: 14px; width: 1458px;" class="table table-striped table-sm no-footer dataTable"
                                                                        id="table-print" aria-describedby="ajax-datatable-rfi-overview_info">

                                                                        <tr>
                                                                            <td style="width: 70%;"><span style="font-size: 20px; font-weight: bold">
                                                                                {{ $r->client_name }}</span> - CONTRACT<br>
                                                                                {{ $r->street }}, {{ $r->city }}, {{ $r->state }} - {{ $r->zip_code }}
                                                                            </td>
                                                                            <td style="width: 30%; text-align: right;">LOGO</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="2">
                                                                                <hr id="hr1">
                                                                                <span style="font-size: 16px; font-weight: bold">
                                                                                    Request For Information (RFI) #{{ $r->code }}
                                                                                </span>
                                                                            </td>
                                                                        </tr>
                                                                    </table>

                                                                    <table style="font-size: 14px; width: 1458px;" class="table table-striped table-sm no-footer dataTable"
                                                                        aria-describedby="ajax-datatable-rfi-overview_info">

                                                                        <tr>
                                                                            <td style="width: 20%;">Name</td>
                                                                            <td style="width: 80%;">{{ $r->name }}</td>
                                                                        </tr>
                                                                         <tr>
                                                                            <td style="width: 20%;">Received From</td>
                                                                            <td style="width: 80%;">{{ $r->received_from }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width: 20%;">Status</td>
                                                                            <td style="width: 80%;">FSFD</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="width: 20%;">Data</td>
                                                                            <td style="width: 80%;">{{ $r->rfi_date }}</td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td colspan="2">
                                                                                <span style="font-size: 16px; font-weight: bold">
                                                                                    General Information
                                                                                </span>
                                                                                <hr id="hr2">
                                                                            </td>
                                                                        </tr>

                                                                    </table>
                                                                </section>

                                                            </div>


                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

            </div>

        </div>

        </section>
    </div>
    <!-- /.content -->



    <style>
            #hr1 {
                width: 100%;
                height: 3px;
                border-bottom: 2px solid #FFA500;
                background: #FFA500;

                /* box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.5); */
            }

            #hr2 {
                height: 1px;
                border-bottom: 2px solid gray;

                /* box-shadow: inset 0 12px 12px -12px rgba(0, 0, 0, 0.5); */
            }

            td { font-size: 16px;}

    </style>


    <script>

    setTimeout(function() {

        // $('[data-widget="pushmenu"]').PushMenu('toggle');

        jQuery(document).ready(function(){
            jQuery('nav').hide();
            jQuery('aside').hide();

        });

    }, 200);




</script>


@endsection
