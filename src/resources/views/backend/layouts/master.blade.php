<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sys-OTC</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
    {{-- <link rel="stylesheet" href="backend/dist/css/font-awesome.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('backend/dist/css/filter_multi_select.css') }}">
    {{-- MILTIPLE SELECT COM FILTRO --}}
    <link rel="stylesheet" href="{{ asset('backend/dist/css/filter_multi_select.css') }}">
    {{-- TOAST --}}
    <link rel="stylesheet" href="{{ asset('backend/dist/css/toastr.css') }}">

 </head>
<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('backend.includes.header')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        {{-- @include('backend.includes.sidebar') --}}
        @include('backend.includes.dinamic-sidebar')

        <!-- Content Wrapper. Contains page content -->
        @yield('section')
        <!-- /.content-wrapper -->

        {{-- @include('backend.includes.footer') --}}

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        {{-- Desmobilizar<br>
        Transferir<br> --}}

        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->

    <!-- Bootstrap 4 -->
    <script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('backend/dist/js/sweetalert2.js') }}"></script>
    {{-- <script src="{{ asset('backend/dist/js/localstorage-teste.js') }}"></script> --}}
    <script src="{{ asset('backend/dist/js/filter-multi-select-bundle.min.js') }}"></script>
    <script src="{{ asset('backend/dist/js/toastr.min.js') }}"></script>

    {{-- <script src="{{ asset('backend/dist/js/pages/projectlist.js') }}"></script> --}}

    <script>
          // MANTÉM O SIDEMENU FECHADO POR DEFAULT
        //   $('[data-widget="pushmenu"]').PushMenu('toggle');

          // Message Sweet Alert popup
          function alertSwal(message, timeDelay, typeIcon) {
            Swal.fire({
                position: "center",
                icon: typeIcon,
                title: message,
                showConfirmButton: true,
                timer: timeDelay,
            });
        }

    </script>


    <style>
        .form-control-sm {
            border-bottom-color: black;
        }

        /* style="border-bottom-color: black;" */

        .content-header {
             /* padding: 15px .5rem; */
             padding: 1px .5rem;
             margin-top: 5px;
        }

        .card {
            /* box-shadow: 0 0 0px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2); */
            box-shadow: 0 0 0px rgba(0, 0, 0, 0), 0 0px 0px rgba(0, 0, 0, .0);
            margin-bottom: 1rem;
        }

        .card-body {
            /* padding: 1.25rem; */
            padding: 0.25rem;
        }

        .toast-title {
            font-weight: bold;
            font-size: 20px;
        }
        .toast-message {
            font-weight: normal;
            font-size: 20px;
        }

        /* SWEETALERT */
        .swal2-popup {
            width: 350px;
            font-size: 0.8em !important;
            font-family: sans-serif;
        }

        .navbar {
            background-color: #cccccc;
            padding: 0;
        }
        /*
        .sidebar {
            background-color: #3c8dbc;
        }
        */




        /* NOTIFICATION BELL WITH SCROLLER */
        .dropdown {
            display:inline-block;
            margin-left:20px;
            padding:10px;
        }
        .glyphicon-bell {
            font-size:1.5rem;
        }

        .notifications {
            min-width:420px;
        }

        .notifications-wrapper {
            overflow:auto;
            max-height:250px;
            }

        .menu-title {
            color:#ff7788;
            font-size:1.5rem;
            display:inline-block;
            }

        .glyphicon-circle-arrow-right {
            margin-left:10px;
        }


        .notification-heading, .notification-footer  {
            padding:2px 10px;
        }


        .dropdown-menu.divider {
            margin:5px 0;
        }

        .item-title {

            font-size:1.3rem;
            color:#000;

            }

        .notifications a.content {
            text-decoration:none;
            background:#ccc;

        }

        .notification-item {
            padding:10px;
            margin:5px;
            background:#ccc;
            border-radius:4px;
        }




    </style>

</body>
</html>
