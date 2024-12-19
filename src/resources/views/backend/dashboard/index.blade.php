@extends('backend.layouts.master')

@section('section')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blank Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Title</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">


            DASHBOARD INDEX


            {{-- <div style="float: : left">

                <aside class="main-sidebar sidebar-dark-primary elevation-4">
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <li class="nav-item  {{ request()->is(['user-list', 'roles']) ? 'menu-open' : '' }}">
                                <a href="#" class="nav-link  {{  request()->is(['user-list', 'roles']) ? 'active' : '' }}" style="background-color: #3f6791">
                                    <i class="nav-icon fas fa-marker"></i>
                                    <p>
                                        Admin
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">

                                        @can('is_admin')
                                            <a href="{{ route('user-list') }}" class="nav-link  {{ request()->is(['user-list']) ? 'active' : '' }}">
                                                <i class="nav-icon fas fa-user"></i>
                                                <p>Usuários</p>
                                            </a>
                                        @else
                                            <a href="#" class="nav-link" style="color: #848181">
                                                <i class="nav-icon fas fa-user"></i>
                                                <p>Usuários</p>
                                            </a>
                                        @endcan


                                    </li>
                                </ul>

                            </li>
                        </ul>
                    </nav>

                </aside>

            </div> --}}


            <div style="float: left">
                    MONTADO<br>

                <div id="divMenudo"></div>

            </div>

            <script>

                const jsonMenu = {
                    systemModule:
                    [
                        //   {name: 'Admin', icon: '0', route: '#', sub: null},
                        {moduleName: 'Admin', icon: '<i class="nav-icon fas fa-marker"></i>', route: '#', sub:
                            [
                                {name: 'Usuários', icon: '<i class="nav-icon fas fa-user"></i>', route: '{{ route('user-list') }}', sub: null},
                            ]
                        },
                        {moduleName: 'Cadastros Gerais', icon: '<i class="nav-icon fas fa-truck"></i>', route: '#', sub:
                            [
                                {name: 'Empresas', icon: '<i class="nav-icon fas fa-building"></i>', route: '{{ route('company-list') }}', sub: null},
                                {name: 'Fornecedores', icon: '<i class="nav-icon fas fa-handshake"></i>', route: '#', sub: null},
                                {name: 'Motoristas', icon: '<i class="nav-icon fas fa-address-card"></i>', route: '#', sub: null},
                                {name: 'Atividades', icon: '<i class="nav-icon fas fa-building"></i>', route: '#', sub: null},
                                {name: 'Localidades/Canteiros', icon: '<i class="nav-icon fas fa-map-signs"></i>', route: '#', sub: null},
                                {name: 'Projetos', icon: '<i class="nav-icon fas fa-handshake"></i>', route: '#', sub: null},
                                {name: 'Supervisores', icon: '<i class="nav-icon fas fa-address-card"></i>', route: '#', sub: null},
                            ]
                        },
                        {moduleName: 'Logística', icon: '<i class="nav-icon fas fa-truck"></i>', route: '#', sub:
                            [
                                {name: 'Marcas', icon: '2-0', route: '#', sub: null},
                                {name: 'Prefixos', icon: '2-1', route: '#', sub: null},
                                {name: 'Grupos de Equipamentos', icon: '2-1', route: '#', sub: null},
                                {name: 'Famílias', icon: '2-1', route: '#', sub: null},
                                {name: 'Modelos', icon: '2-1', route: '#', sub: null}

                            ]
                        }
                    ]

                };

                // localStorage.getItem("menu", JSON.stringify(jsonMenu));
                localStorage.setItem("menu", JSON.stringify(jsonMenu));

                var lengthMenu = jsonMenu['systemModule'].length;

                var conteudoMenu = '<aside class="main-sidebar sidebar-dark-primary elevation-4">';
                    conteudoMenu += '<div class="sidebar">';


                for(i=0; i<lengthMenu; i++) {

                    moduleMenu  = jsonMenu['systemModule'][i]['moduleName'];
                    icon = jsonMenu['systemModule'][i]['icon'];

                        conteudoMenu += '<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">';

                            // var routeURL = "{{ substr(request(), 5, 9) }}";
                            // if(routeURL == 'dashboard') {
                            //     menuOpen = 'menu-open';
                            // } else {
                            //     menuOpen = '';
                            // }

                            menuOpen = '';

                            conteudoMenu += '<li class="nav-item  '+menuOpen+' ">';

                                conteudoMenu += '<a href="#" class="nav-link  " style="background-color: #3f6791">';
                                    conteudoMenu += ''+icon+'';
                                    conteudoMenu += '<p>';
                                        conteudoMenu += ''+moduleMenu+'';
                                    conteudoMenu += '</p>';
                                conteudoMenu += '</a>';

                                // conteudoMenu += '<p>Usuários</p>';
                                // titName (Empresas, Fornecedores, etc.)
                                var totLinks = jsonMenu['systemModule'][i]['sub'].length;   // QUANTIDADE NO OBJETO DE SUBS
                                console.log('totLinks='+totLinks);
                                for(lin=0; lin<totLinks; lin++) {

                                    conteudoMenu += '<ul class="nav nav-treeview">';
                                        conteudoMenu += '<li class="nav-item">';

                                            titName = jsonMenu['systemModule'][i]['sub'][lin]['name'];
                                            titIcon = jsonMenu['systemModule'][i]['sub'][lin]['icon'];
                                            routeName = jsonMenu['systemModule'][i]['sub'][lin]['route'];

                                            conteudoMenu += '<a href="'+routeName+'" class="nav-link">';
                                                conteudoMenu += ''+titIcon+'';
                                                conteudoMenu += '<p>'+titName+'('+routeName+')'+'</p>';
                                            conteudoMenu += '</a>';

                                        conteudoMenu += '</li>';
                                    conteudoMenu += '</ul>';

                                } // fim do for de links


                            conteudoMenu += '</li>';


                        conteudoMenu += '</ul>';
                    conteudoMenu += '</nav>';

                }

                conteudoMenu += '</aside>';

                document.getElementById("divMenudo").innerHTML = conteudoMenu;

                console.log(jsonMenu);


            </script>


        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>

  @endsection
