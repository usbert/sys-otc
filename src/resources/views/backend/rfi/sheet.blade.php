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
                                                                            <td><span style="font-size: 20px; font-weight: bold">{{ $r->client_name }}</span> - CONTRACT</td>
                                                                            <td rowspan="2">LOGO</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>{{ $r->street }}, {{ $r->city }}, {{ $r->state }} - {{ $r->zip_code }}</td>
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
        .table-print {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0px;
            border: 1px solid #999 !important;
        }

        .table-print tr td {
            padding: 2px;
            font-size: 11px;
            border: 1px solid #999 !important;
        }

        body { margin: 0 }
            .sheet-outer {
                margin: 0;
            }
            .sheet {
                margin: 0;
                overflow: hidden;
                position: relative;
                box-sizing: border-box;
                page-break-after: always;
            }

            @media screen {
                body {
                    background: #e0e0e0
                }

                .sheet {
                    background: white;
                    box-shadow: 0 .5mm 2mm rgba(0,0,0,.3);
                    margin: 5mm auto;
                }
            }
            /* Add the page size for A4 in mm. */

            .sheet-outer.A4 .sheet {
                width: 210mm;
                height: 296mm
            }
            .sheet.padding-5mm { padding: 5mm }


            @page {
                size: A4;
                margin: 0
            }
            @media print {
                .sheet-outer.A4, .sheet-outer.A5.landscape {
                    width: 210mm
                }
            }

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
