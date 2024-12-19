const jsonMenu = {
    systemModule:
    [
        //   {name: 'Admin', icon: '0',   route: '#', sub: null},
        { moduleName: 'Admin', icon: '<i class="nav-icon fas fa-marker"></i>',  route: '#', sub:
            [
                {name: 'Usuários', icon: '<i class="nav-icon fas fa-user"></i>',  route: '{{ route('user-list') }}', sub: null},
            ]
        },
        {moduleName: 'Cadastros Gerais', icon: '<i class="nav-icon fas fa-truck"></i>',  route: '#', sub:
            [
                {name: 'Empresas', icon: '<i class="nav-icon fas fa-building"></i>',  route: '{{ route('company-list') }}', sub: null},
                {name: 'Fornecedores', icon: '<i class="nav-icon fas fa-handshake"></i>',  route: '{{ route('supplyer-list') }}', sub: null},
                {name: 'Motoristas', icon: '<i class="nav-icon fas fa-address-card"></i>',  route: '{{ route('driver-list') }}', sub: null},
                {name: 'Atividades', icon: '<i class="nav-icon fas fa-building"></i>',  route: '#', sub: null},
                {name: 'Localidades/Canteiros', icon: '<i class="nav-icon fas fa-map-signs"></i>',  route: '#', sub: null},
                {name: 'Projetos', icon: '<i class="nav-icon fas fa-handshake"></i>',   route: '#', sub: null},
                {name: 'Supervisores', icon: '<i class="nav-icon fas fa-address-card"></i>',  route: '#', sub: null},
            ]
        },
        {moduleName: 'Logística', icon: '<i class="nav-icon fas fa-truck"></i>',  route: '#', sub:
            [
                {name: 'Marcas', icon: '2-0',   route: '#', sub: null},
                {name: 'Prefixos', icon: '2-1',   route: '#', sub: null},
                {name: 'Grupos de Equipamentos', icon: '2-1',   route: '#', sub: null},
                {name: 'Famílias', icon: '2-1',   route: '#', sub: null},
                {name: 'Modelos', icon: '2-1',   route: '#', sub: null}

            ]
        }
    ]

};

localStorage.setItem("menu", JSON.stringify(jsonMenu));
