@auth
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    {{-- <a href="../../index3.html" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    </a> --}}

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
            <img src="../../../../backend/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
        </div> --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="card-body" style="color: white;">

                <img src="../../../../backend/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                <br/>
                    {{ Auth::user()->id}}<br>
                    {!! Helper::first_name(Auth::user()->name) !!}
                <br/>
                @can('is_admin')
                    Admin
                @endcan
            </div>
        </div>
        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
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
                                <p>{{ __('messages.Users') }}</p>
                            </a>
                        @endcan


                    </li>
                </ul>

            </li>

            <li class="nav-item
                {{ substr(request(), 5, 7) == 'company' ? 'menu-open' : '' }}
                {{ substr(request(), 5, 8) == 'supplyer' ? 'menu-open' : '' }}
                 {{ substr(request(), 5, 6) == 'driver' ? 'menu-open' : '' }}
                 {{ substr(request(), 5, 14) == 'field-activity' ? 'menu-open' : '' }}
                 {{ substr(request(), 5, 10) == 'supervisor' ? 'menu-open' : '' }}
                 {{ substr(request(), 5, 6) == 'client' ? 'menu-open' : '' }}
                 {{ substr(request(), 5, 7) == 'project' ? 'menu-open' : '' }}
                 {{ substr(request(), 5, 8) == 'location' ? 'menu-open' : '' }}
                 {{ substr(request(), 5, 13) == 'type-document' ? 'menu-open' : '' }}
                ">
                <a href="#" class="nav-link" style="background-color: #3f6791">
                    <i class="nav-icon fas fa-truck"></i>
                    <p>{{ __('messages.Menu.General Registrations') }}
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('company-list') }}" class="nav-link
                            {{ substr(request(), 5, 7) == 'company' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>{{ __('messages.Companies') }}</p>
                        </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('supplyer-list') }}" class="nav-link
                            {{ substr(request(), 5, 8) == 'supplyer' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-handshake"></i>
                            <p>{{ __('messages.Supplyers') }}</p>
                        </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('driver-list') }}" class="nav-link
                            {{ substr(request(), 5, 6) == 'driver' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-address-card"></i>
                            <p>{{ __('messages.Drivers') }}</p>
                        </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('field-activity-list') }}" class="nav-link
                            {{ substr(request(), 5, 14) == 'field-activity' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-building"></i>
                            <p>{{ __('messages.Activities') }}</p>
                        </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('supervisor-list') }}" class="nav-link
                            {{ substr(request(), 5, 10) == 'supervisor' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-address-card"></i>
                            <p>{{ __('messages.Supervisors') }}</p>
                        </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('client-list') }}" class="nav-link
                            {{ substr(request(), 5, 6) == 'client' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-address-card"></i>
                            <p>{{ __('messages.Clients') }}</p>
                        </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('project-list') }}" class="nav-link
                            {{ substr(request(), 5, 7) == 'project' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-map-marked-alt"></i>
                            <p>{{ __('messages.Projects') }}</p>
                        </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('location-list') }}" class="nav-link
                            {{ substr(request(), 5, 8) == 'location' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-map-signs"></i>
                            <p>{{ __('messages.Projects Locations') }}</p>
                        </a>
                    </li>
                </ul>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('type-document-list') }}" class="nav-link
                            {{ substr(request(), 5, 13) == 'type-document' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-file-code"></i>
                            <p>{{ __('messages.Type Documents') }}</p>
                        </a>
                    </li>
                </ul>

            </li>

            <li class="nav-item
                {{ substr(request(), 5, 5) == 'brand'              ? 'menu-open' : '' }}
                {{ substr(request(), 5, 6) == 'prefix'             ? 'menu-open' : '' }}
                {{ substr(request(), 5, 15) == 'equipment-group'    ? 'menu-open' : '' }}
                {{ substr(request(), 5, 6) == 'family'             ? 'menu-open' : '' }}
                {{ substr(request(), 5, 5) == 'model'              ? 'menu-open' : '' }}
                {{ substr(request(), 5, 7) == 'vehicle'            ? 'menu-open' : '' }}
                ">
                <a href="#" class="nav-link" style="background-color: #3f6791">
                    <i class="nav-icon fas fa-truck"></i>
                    <p>{{ __('messages.Menu.Logistic') }}
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('brand-list') }}" class="nav-link
                            {{ substr(request(), 5, 5) == 'brand' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-shield-alt"></i>
                            <p>{{ __('messages.Brands') }}</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('prefix-list') }}" class="nav-link
                            {{ substr(request(), 5, 6) == 'prefix' ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tag"></i>
                            <p>{{ __('messages.Prefixes') }}</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('equipment-group-list') }}" class="nav-link
                            {{ substr(request(), 5, 15) == 'equipment-group' ? 'active' : '' }}
                            ">
                            <i class="nav-icon fas fa-boxes"></i>
                            <p>{{ __('messages.Equipment Groups') }}</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('family-list') }}" class="nav-link
                        {{ substr(request(), 5, 6) == 'family' ? 'active' : '' }}
                        ">
                            <i class="nav-icon fas fa-sitemap"></i>
                            <p>{{ __('messages.Families') }}</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('model-list') }}" class="nav-link
                        {{ substr(request(), 5, 5) == 'model' ? 'active' : '' }}
                        ">
                            <i class="nav-icon fas fa-snowplow"></i>
                            <p>{{ __('messages.Models') }}</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        {{-- <a href="{{ route('vehicle-list') }}" class="nav-link  {{ request()->is(['vehicle', 'vehicle/create']) ? 'active' : '' }}"> --}}
                        <a href="{{ route('vehicle-list') }}" class="nav-link
                            {{ substr(request(), 5, 7) == 'vehicle' ? 'active' : '' }}
                            ">
                            <i class="nav-icon fas fa-car-alt"></i>
                            <p>{{ __('messages.Vehicles') }} {{ __('messages.and') }} {{ __('messages.Equipments') }}</p>
                        </a>
                    </li>
                </ul>
            </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
        </div>
    <!-- /.sidebar -->
  </aside>

  @endauth
