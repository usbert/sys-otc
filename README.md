# before instalation 
remove the content (file and folders) from src folder

Criar imagem dentro da pasta onde estivar a imagem (C:\Users\User\Documents\docker\php)
docker build -t meuphp . (nome da imagem)

# install Laravel
1 - run the container:
docker-compose up 
2 - enter container and execute:
  docker exec -it container_name bash
  php artisan serve


3 - install laravel:
composer create-project laravel/laravel sge
4 - change the owner of the files: 
chown 1000:1000 -R sge
5 - move files to the correct folder: 
mv sge/* . (o conteúdo de sge será movido para src sem a pasta sge)
6 - adjust .env file to user your database credentials

# install fortify
* Important: this is inside the container
1 - composer require laravel/fortify
2 - php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
* Important: this is using vscode
3 - open vscode and then open  file config/app.php and add this provider: App\Providers\FortifyServiceProvider::class, (in general line 171)
4 - open file App\Providers\FortifyServiceProvider.php and add : 
        Fortify::loginView(function () {
            return view('auth.login');
        });
        Fortify::registerView(function () {
            return view('auth.register');
        });
to the function boot

this gonna be the final result: 
    public function boot(): void
    {
        Fortify::loginView(function () {
            return view('auth.login');
        });
        Fortify::registerView(function () {
            return view('auth.register');
        });

5: run php artisan migrate 


# install adminLte
* Important: this is inside the container
1 - run the command:
npm install admin-lte@^3.2 --save
2 - change the owner of the files: 
chown 1000:1000 -R *
3 - Change the folders permission:
chmod 777 -R bootstrap/cache/
chmod 777 -r storage

# create master blade
* Important: using vscode
1 - create folder backend in resources/views
2 - create folder layouts in resources/views/backend
3 - create inside it the file master.blade.php (in layouts folder)
4 - create folder backend/includes in resources/views
5 - copy content of the file blank.html (this file can be found at node_modules/admin-lte/pages/examples) to master.blade.php
6 - create folder backend insinde public folder
7 - copy dist and plugin folder from admin lte to public/backend (folders are in this folder node_modules/admin-lte)
8 - change line 11 and 13 of master.blade.php to get the assets from public/backend
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/adminlte.min.css') }}">
9 - remove from  master.blade.php
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
10 - master.blade.php - adjusts assets line 898 and so forth
 <!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>

11 - create footer.blade.php file at resourcers/view/includes and cut and paste the footer section from master.blade.php and include the footer in the master.blade.php : @include('backend.includes.footer')

12 - create header.blade.php and follow the step 11 
  <!-- Navbar -->
@include('backend.includes.header')
  <!-- /.navbar -->

13  - same for side bar
  <!-- Main Sidebar Container -->
@include('backend.includes.sidebar')

14 - create folder resourcers/views/backend/dashboard and create a filed called index.blade.php inside it

15 - cut and past the content of the content wrapper in master.blade file inside index.blade.php

16 - add section to master.blade.php 
  <!-- Content Wrapper. Contains page content -->
@yield('section')
  <!-- /.content-wrapper -->

17 - add it at the begining of file resourcers/views/backend/dashboard/index.blade.php
@extends('backend.layouts.master')

@section('section')

and it to the end
@endsection

18 - add this route to routes/web.php

Route::get('dashboard', function () {
    return view('backend.dashboard.index');
})->name('dashboard');

# Create login 
1 - create folder auth in resources/views
2 - inside this folder create the file login.blade.php

3 - copy the content from  node_modules/admin-lte/pages/example/login-v2.html, paste into login.blade.php and adjsts header and footer 
example: 
  from this: <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  to this :<link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">

and also change the page tittle and other texts regarding Admin Lte to your brand

4 - adjusts form action, add csrf and add name to input fields
      <form action="{{route('login') }}" method="post">
        @csrf
    
    example:  name="email">

# register section

1 - Create file register.blade.php inside resources/views/auth

2 - copy the content from  node_modules/admin-lte/pages/example/register-v2.html and adjust assets, route, add csrf and add form names (same as login)

# routes

3 - add this to routes/web.php
use Illuminate\Support\Facades\Auth;

Route::get('/home', function () {
    return view('welcome');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->back();
});

# test register, login e logout
1 - access /register and register a new user
2 - access /logout
3 - access /login and login with the new registered user

# Integrating users with admin panel
1 - open file app/Provider/RouteServiceProvider.php and change the value of const HOME to dashboar
public const HOME = '/dashboard';

2 - Open sidebar.blade.php and remove the examples

3 - Rename Tables to Users and Simple Tables to Users List and remove the nav items block below it

3 - Change the href to 
<a href="{{ route('user-list') }}" class="nav-link">

4 - Create controller:
php artisan make:controller UserController
* dont forget to change the file owner

4.1 - create index function
    public function index() 
    {
        $users = User::latest()->get();
        return view('backend.userlist', compact('users'));
    }
}

5 - add router to web.php
use App\Http\Controllers\UserController;
Route::get('user-list', [UserController::class, 'index'])->name('user-list');

6 - create file resources/views/backend/userlist.blade.php and copy the content of resources/views/backend/dashboard/index.blade.php to it and remove footer and make the adjustments 

7 - change the card board on the new file for this content below
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Registered at</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($users as $user)
                    <tr>
                      <th scope="row">{{ $user->id }}</th>
                      <td>{{ $user->name }}</td>
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->created_at }}</td>
                    </tr>
                  @empty
                  <tr>
                    <td>Data not found </td>
                  </tr>
                      
                  @endforelse
                </tbody>
              </table>
        </div>
        <!-- /.card-body -->

8  - Adjust sidebar replace the div for users with this one below
          <li class="nav-item  {{ request()->is(['user-list']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link  {{  request()->is(['user-list']) ? 'active' : '' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('user-list') }}" class="nav-link  {{ request()->is(['user-list']) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users List</p>
                </a>
              </li>
            </ul>
          </li>


# install spatie
1 - composer require spatie/laravel-permission
* change owner and storage permission
2 - open config/app.php and add provider
Spatie\Permission\PermissionServiceProvider::class,

3 - finalize and migration
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"


# PAGINAÇÃO
  Open src/app/Providers and add:
    use Illuminate\Pagination\Paginator;
    ...
    public function boot(): void
    {
          Paginator::useBootstrapFive();
    }

# ICONS fas fa
https://www.w3schools.com/icons/icons_reference.asp


======================================

- Fazer jQuery no Fetch da tabela grid
- Fazer Modal de Create (jQuery)
- Implantar o Request StoreUpdate

======================================
# Install DataTable
https://tutorial101.blogspot.com/2023/07/laravel-10-ajax-datatables-crud-create.html
https://www.youtube.com/watch?v=47er3YeFbZo


======================================
# Install Locale Multilanguage
1 - Create path: src\app\Http\Middleware\Language.php run below:
 php artisan make:middleware Language

 https://5balloons.info/localization-laravel-multi-language-language-switcher/

 2 - In Kernel.php add below:
  protected $middlewareGroups = [
      'web' => [
          \App\Http\Middleware\Language::class,

3 - In path src\config create a new file named languages.php inside the config directory
<?php
return [
    'en' => 'English',
    'fr' => 'Français',
    'es' => 'Spanish',
    'pt_BR' => 'Português BR',
];

4 - Create new controller:
 php artisan make:controller LanguageController

  Modify below:
      use Illuminate\Http\Request;
      use Illuminate\Support\Facades\Config;
      use Illuminate\Support\Facades\Session;
      use Illuminate\Support\Facades\Redirect;

      class LanguageController extends Controller
      {

          public function switchLang($lang)
          {
              if (array_key_exists($lang, Config::get('languages'))) {
                  Session::put('applocale', $lang);
              }
              return Redirect::back();
          }
      }

5 - Add Route (web.php)
  Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

6 - Add composer dependency for Laravel Pacakge
    composer require laravel/ui
7 - Install Bootstrap with Auth scaffolding
    php artisan ui bootstrap --auth
8 - npm commands
    npm install
    npm run dev

9 - npm install flag-icon-css
10 - icon images and path menu
    src\config\languages.php
    https://icons8.com/icon/set/flags/officexs


    Default em porguguês
    \src\config\app.php


  <!-- https://yajrabox.com/docs/laravel-datatables/10.0

  1 - Executar no container
    composer require yajra/laravel-datatables:^10.0

  2 - Adicionar no provider do arquivo  \config\app.php
  'providers' => [
      Yajra\DataTables\DataTablesServiceProvider::class,

  3 - Executar no container
      php artisan vendor:publish --tag=datatables
  

  4 - https://yajrabox.com/docs/laravel-datatables/master/buttons-installation
    Adicionar no provider do arquivo  \config\app.php
    Yajra\DataTables\ButtonsServiceProvider::class,
    php artisan vendor:publish --tag=datatables-buttons -->

======================================

Modelo:
01 StoreEquipmentFamilyRequest
02 RequestEquipmentFamily
03 ServiceEquipmentFamily
04 RepositoryEquipmentFamily


1) Laravel Sanctun/Fortify/Breeze...
2) Laravel Localization (BR / EU / ES)
3) AdminLte
4) Datatable AdminLte
  - Habilitar botões exportar (Copy, PDF, CSV, Excel, Print)
  - Habilitar quantidade registros na paginação
  - Habilitar Localization Datatable  (BR / EU / ES)

5) Helpers
  (https://pt.stackoverflow.com/questions/353879/como-criar-fun%C3%A7%C3%B5es-dispon%C3%ADvel-globalmente-no-laravel)
  - App/Helpers/Helper.php
    config/app.php
        'aliases' => [
        ...
            'Helper' => App\Helpers\Helper::class,

   5.1) Functions no helper >>>> https://medium.com/@shahburhan/adding-helper-functions-accessible-and-usable-across-the-laravel-app-645c0ffe8b55



Implementar
  - Black Theme
  - Toast Alerts

======================================

1) Migrate
2) Model
3) Controller
4) Rota
5) View


Layers Repository Pattem
1) MODEL
    Vehicle
2) DTO
    VehicleDTO
3) REPOSITORY
4) REPOSITORY INTERFACE
5) REQUEST  (Regras e validação)
   VehicleRequest
  * usar DTO
6) SERVICE
7) CONTROLLER
  * usar Service
  * usar Request



======================================


php artisan cache:clear
php artisan route:clear
php artisan config:cache
php artisan optimize:clear



https://github.com/urnauzao/laravel-repositories/blob/main/app/Interfaces/RepositoryInterface.php




Layers Repository Pattem
1) MODEL
2) DTO
3) REPOSITORY
4) REPOSITORY INTERFACE
5) REQUEST
6) SERVICE
7) CONTROLLER


1 - Driver (MODEL)  
                              <- SoftDelete / Campos utilizados / Campos não utilizados (ex created_at e updated_at)
2 - DriverController          
                              <- CreateDriverRequest
                              <- UpdateDriverRequest
3 - DriverRepositoryInterface 
                              <- adicionar os métodos usados)
4 - DriverRepository

5 - DriveService (store)
        DriverRepositoryInterface
        driverRepository  (create)
                          (update)
6 - CreateDriveRequest valida com DriveService




Enviar emails
https://www.youtube.com/playlist?list=PLyugqHiq-SKfJcQFnTxxzO7VGX-Fq2HnT
https://mailtrap.io/inboxes
  php artisan make:mail Contact



Criar o arquivo em database/migrations
https://www.youtube.com/watch?v=4Hi9-etl2iQ
(https://laravel.com/docs/10.x/queues)

  php artisan queue:table
  php artisan migrate

Criar um job na pasta App/Jobs:
  php artisan make:job PaymentJob


  php artisan queue:work



====================
Generating public/private rsa key pair.
Enter passphrase (empty for no passphrase): 
Enter same passphrase again: 
Your identification has been saved in /home1/hg99ep28/.ssh/id_rsa.
Your public key has been saved in /home1/hg99ep28/.ssh/id_rsa.pub.
The key fingerprint is:
SHA256:iFmbuJ85+e1yRmtFQoSSNOBFHI20yzXJueLsLJnBJ4E 
The key's randomart image is:
+---[RSA 2048]----+
|    .*B= o.      |
|   . .=+oo.      |
|   .. o.*.       |
|  E .* * o. .    |
|   .+.B S  o     |
|    ++..  . .    |
|    .*o. . o     |
|    ++oo..=      |
|     .*o.*o      |
+----[SHA256]-----+



ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQCmgXDLJrJDBX/mVcOk5GeNZE7tVdcN8P9W59a8v/0h0ZJ+df9hO8vZKTJ2Lttxj2DimJLl4/EEtWH5KgIzQ0eg65mQrPeLUyVqUcjDBojihDC+KJq9rjQubTzLx1rpaC0+2ayl9Kk1a2f+Hyh1rgKsarnITOscWD4CXcyecl3urUCJNJL+X7mr9LReMyCqvcJAtrkNgv/sWi7rA0azomZ2a0HRRZt6U1R7+TqAtq/d4ooWnT7P3Xc/PWKexR54ZfKP6BXH1UpPnvVmvqDcHnRuGc4Vy6fuNphB1fNh1uhBQ85dSSH8kgUC9IIXBFCtR2YiS+cyy55wuy5CF9mmUM3P