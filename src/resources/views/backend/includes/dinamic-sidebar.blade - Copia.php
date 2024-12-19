@auth
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="card-body" style="color: white;">

                <img src="../../../../backend/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                <br/>
                    {!! Helper::first_name(Auth::user()->name) !!}
                <br/>
                @can('is_admin')
                    Admin
                @endcan
            </div>
        </div>

        <nav class="mt-2">

            <div id="divMenudo">
                {{-- CARREGA O MENU AQUI DENTRO --}}
            </div>

        </nav>

    </div>
</aside>

@endauth


<script>


    // $.ajax({
    //     type:'get',
    //     enctype: 'multipart/form-data',
    //     url: "{{ url('permission/get-permission/1/') }}",
    //     // contentType: false,
    //     // processData: false,
    //     success:function(data) {

    //         console.log(data);

    //     }
    // });



    // JASON FAKE PARA ARMAZENAR NO localStorage

    $.ajax({
        type:'get',
        enctype: 'multipart/form-data',
        url: "{{ url('permission/get-permission/1/') }}",
        // contentType: false,
        // processData: false,
        success:function(data) {

            console.log(data);
            localStorage.setItem("menu2", data);

            data_aux = data.permissions;
            var lengthData = data_aux.length;

            for(d=0; d<lengthData; d++) {

                data_module = data.permissions[d]['module_name'];
                data_icon   = data.permissions[d]['icon_name'];
                data_menu   = data.permissions[d]['menu_name'];
                data_route  = data.permissions[d]['route_name'];

                console.log(data_module + ' - ' + data_icon + ' - ' + data_menu + ' - ' + data_route);
            }

            const jsonMenu = {
                systemModule:
                [
                    {
                       moduleName: 'Admin', icon: '<i class="nav-icon fas fa-marker"></i>',  route: '#', sub:
                       [
                        {name: 'Usuários', icon: '<i class="nav-icon fas fa-user"></i>',  route: '{{ route('user-list') }}', sub: null},
                       ]
                    },
                ]
            };

            // const jsonMenu = {
            //     systemModule:
            //     [
            //         { moduleName: 'Admin', icon: '<i class="nav-icon fas fa-marker"></i>',  route: '#', sub:
            //             [
            //                 {name: 'Usuários', icon: '<i class="nav-icon fas fa-user"></i>',  route: '{{ route('user-list') }}', sub: null},
            //             ]
            //         },
            //     ]
            // };

            localStorage.setItem("menu", JSON.stringify(jsonMenu));



            // LÊ A ARRAY DO LOCALSTORAGE E JOGA DENTRO DO divMenudo

            var lengthMenu = jsonMenu['systemModule'].length;
            var conteudoMenu = '';
            var seq = 0;

            for(i=0; i<lengthMenu; i++) {

                moduleMenu  = jsonMenu['systemModule'][i]['moduleName'];
                icon = jsonMenu['systemModule'][i]['icon'];

                conteudoMenu += '<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">';

                    menuOpen = 'menu-open';

                    conteudoMenu += '<li class="nav-item  '+menuOpen+' ">';

                        // MODULO
                        conteudoMenu += '<a href="#" class="nav-link" style="background-color: #3f6791">';
                            conteudoMenu += ''+icon+'';
                            conteudoMenu += '<p>';
                                conteudoMenu += ''+moduleMenu+'';
                            conteudoMenu += '</p>';
                        conteudoMenu += '</a>';

                        // conteudoMenu += '<p>Usuários</p>';
                        // titName (Empresas, Fornecedores, etc.)
                        var totLinks = jsonMenu['systemModule'][i]['sub'].length;   // QUANTIDADE NO OBJETO DE SUBS

                        // MENUS

                        for(lin=0; lin<totLinks; lin++) {

                            conteudoMenu += '<ul class="nav nav-treeview">';
                                conteudoMenu += '<li class="nav-item">';

                                    titName = jsonMenu['systemModule'][i]['sub'][lin]['name'];
                                    iconName = jsonMenu['systemModule'][i]['sub'][lin]['icon'];
                                    routeName = jsonMenu['systemModule'][i]['sub'][lin]['route'];

                                    conteudoMenu += '<a href="'+routeName+'" id="link'+seq+'" class="nav-link">';
                                        conteudoMenu += seq+') '+iconName+'';
                                        conteudoMenu += '<p>'+titName+'('+routeName+')'+'</p>';
                                    conteudoMenu += '</a>';

                                conteudoMenu += '</li>';
                            conteudoMenu += '</ul>';

                            seq++;

                        } // fim do for de links

                    conteudoMenu += '</li>';

                conteudoMenu += '</ul>';

            }

            document.getElementById("divMenudo").innerHTML = conteudoMenu;

            console.log(jsonMenu);

        }
    });

</script>




