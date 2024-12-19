
// localStorage.clear();
console.log('CHEGOU');

const jsonMenu = {
    menu:
       [
        //   {name: 'Admin', link: '0', sub: null},
          {name: 'Admin', link: '1', sub:
             [
                {name: 'Usuários',link: '0-0', sub: null},
             ]
          },
          {name: 'Cadastros Gerais', link: '1', sub:
             [
                {name: 'Empresas',link: '0-0', sub: null},
                {name: 'Projetos',link: '0-1', sub: null},
                {name: 'Localidades/Canteiros',link: '0-2', sub: null},
                {name: 'Fornecedores',link: '0-2', sub: null},
                {name: 'Motoristas',link: '0-2', sub: null},
                {name: 'Supervisores',link: '0-2', sub: null},
                {name: 'Tipos de Documentos',link: '0-2', sub: null},
             ]
          },
          {name: 'Logística', link: '2', sub:
             [
                {name: 'Marcas',link: '2-0', sub: null},
                {name: 'Prefixos',link: '2-1', sub: null},
                {name: 'Grupos de Equipamentos',link: '2-1', sub: null},
                {name: 'Famílias',link: '2-1', sub: null},
                {name: 'Modelos',link: '2-1', sub: null}

             ]
           }
       ]

    };

    // localStorage.getItem("menu", JSON.stringify(jsonMenu));
    localStorage.setItem("menu", JSON.stringify(jsonMenu));

    const jsoMenu = localStorage.getItem("jsmenu");

    console.log(jsonMenu);



// localStorage.setItem("name", "Manu");
// localStorage.setItem("lastname", "Usbert");

// const name = localStorage.getItem("name");
// const lastname = localStorage.getItem("lastname");


// // O TIPO DE CAMPO SEMPRE É STRING
// console.log(typeof localStorage.getItem("name"));


// if(!name) {
//     console.log(name);
// }

// if(lastname) {
//     console.log(lastname);
// }

// if(menu) {
//     console.log(menu);
// }



// // LIMPAR CAMPO
// // localStorage.removeItem("name");

// // localStorage.removeItem("name");

