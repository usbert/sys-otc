@auth
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="card-body" style="color: white;">
                <div class="pull-left image">
                    <img src="../../../../backend/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="pull-left info">
                    {{-- Jonatas --}}
                    {!! Helper::first_name(Auth::user()->name) !!}
                </div>
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

    localStorage.removeItem("menu");
    localStorage.removeItem("lista-acoes");


    if(!localStorage.getItem("menu")) {

        console.log('localstorage NÃO existe');

        $.ajax({
            type:'get',
            enctype: 'multipart/form-data',
            url: "{{ url('permission/get-permission/1/') }}",
            // contentType: false,
            // processData: false,
            success:function(data) {

                data_aux = data.permissions;
                var lengthData = data_aux.length;

                conteudoMenu  = '<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">';
                conteudoMenu += '<li class="nav-item menu-open">';

                    var module_aux = '';
                    var menu_aux = '';

                    var seq = 0;

                    // console.log(data);

                    for(d=0; d<lengthData; d++) {

                        data_module_id  = data.permissions[d]['module_id'];
                        data_menu_id    = data.permissions[d]['menu_id'];
                        data_module     = data.permissions[d]['module_name'];
                        data_icon       = data.permissions[d]['icon_name'];
                        icon_module     = data.permissions[d]['icon_module'];
                        data_menu       = data.permissions[d]['menu_name'];
                        data_route      = data.permissions[d]['route_name'];

                        if(module_aux != data_module_id) {

                            //  MODULO
                            conteudoMenu += '<a href="#" class="nav-link" style="background-color: #3f6791">';
                                conteudoMenu += '<i class="'+data_icon+icon_module+'"></i>';
                                conteudoMenu += '<p>';
                                    conteudoMenu += data_module;
                                conteudoMenu += '</p>';
                            conteudoMenu += '</a>';
                        }

                        // LINKS DO MÓDULO
                        if(menu_aux != data_menu_id) {
                            conteudoMenu += '<ul class="nav nav-treeview">';
                                conteudoMenu += '<li class="nav-item">';

                                    conteudoMenu += '<a href="/'+data_route+'" id="link-'+data_route+'" class="nav-link">';
                                        conteudoMenu += '<i class="'+data_icon+'"></i>';
                                        conteudoMenu += '<p>'+data_menu+'</p>';
                                        // conteudoMenu += '<p>{{ __("messages.'+data_menu+'") }}</p>';

                                    conteudoMenu += '</a>';

                                conteudoMenu += '</li>';
                            conteudoMenu += '</ul>';
                        }

                        module_aux = data_module_id;
                        menu_aux = data_menu_id;

                        seq++;



                        data_action = data.permissions[d]['action_name'];
                        // console.log(data_route+' e '+data_action);

                    }

                conteudoMenu += '</li>';
                conteudoMenu += '</ul>';

                document.getElementById("divMenudo").innerHTML = conteudoMenu;

                localStorage.setItem("menu", conteudoMenu);



                var lista_acoes = JSON.parse(localStorage.getItem('lista-acoes') || '[]');
                lista_acoes.push(
                    jsonAcoes = {
                        supplyer:
                        {
                            ler: 'SIM',
                            alterar: 'NÃO',
                            excluir: 'SIM'
                        },
                        brand:
                        {
                            ler: 'SIM',
                            alterar: 'NÃO',
                            excluir: 'NÃO'
                        },
                        vehicle:
                        {
                            ler: 'SIM',
                            alterar: 'NÃO',
                            excluir: 'NÃO',
                            aprovar: 'SIM'
                        }

                    }
                );

                // Salva a lista alterada
                localStorage.setItem("lista-jsonAcoes", JSON.stringify(lista_acoes));



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

                // localStorage.setItem("menu", JSON.stringify(jsonMenu));



                // LÊ A ARRAY DO LOCALSTORAGE E JOGA DENTRO DO divMenudo



                // var lengthMenu = jsonMenu['systemModule'].length;
                // var conteudoMenu = '';
                // var seq = 0;

                // for(i=0; i<lengthMenu; i++) {

                //     moduleMenu  = jsonMenu['systemModule'][i]['moduleName'];
                //     icon = jsonMenu['systemModule'][i]['icon'];

                //     conteudoMenu += '<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">';

                //         menuOpen = 'menu-open';

                //         conteudoMenu += '<li class="nav-item  '+menuOpen+' ">';

                //             // MODULO
                //             conteudoMenu += '<a href="#" class="nav-link" style="background-color: #3f6791">';
                //                 conteudoMenu += ''+icon+'';
                //                 conteudoMenu += '<p>';
                //                     conteudoMenu += ''+moduleMenu+'';
                //                 conteudoMenu += '</p>';
                //             conteudoMenu += '</a>';

                //             // conteudoMenu += '<p>Usuários</p>';
                //             // titName (Empresas, Fornecedores, etc.)
                //             var totLinks = jsonMenu['systemModule'][i]['sub'].length;   // QUANTIDADE NO OBJETO DE SUBS

                //             // MENUS

                //             for(lin=0; lin<totLinks; lin++) {

                //                 conteudoMenu += '<ul class="nav nav-treeview">';
                //                     conteudoMenu += '<li class="nav-item">';

                //                         titName = jsonMenu['systemModule'][i]['sub'][lin]['name'];
                //                         iconName = jsonMenu['systemModule'][i]['sub'][lin]['icon'];
                //                         routeName = jsonMenu['systemModule'][i]['sub'][lin]['route'];

                //                         conteudoMenu += '<a href="'+routeName+'" id="link'+seq+'" class="nav-link">';
                //                             conteudoMenu += seq+') '+iconName+'';
                //                             conteudoMenu += '<p>'+titName+'('+routeName+')'+'</p>';
                //                         conteudoMenu += '</a>';

                //                     conteudoMenu += '</li>';
                //                 conteudoMenu += '</ul>';

                //                 seq++;

                //             } // fim do for de links

                //         conteudoMenu += '</li>';

                //     conteudoMenu += '</ul>';

                // }

                // document.getElementById("divMenudo").innerHTML = conteudoMenu;

                // console.log(jsonMenu);

            }
        });

    } else {

        console.log('localstorage já existe');


        var xxxxx = localStorage.getItem("menu");
        document.getElementById("divMenudo").innerHTML = xxxxx;


    }

</script>




