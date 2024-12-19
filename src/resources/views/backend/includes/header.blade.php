
<script type="text/javascript" language="javascript" src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Left navbar links (show / hidden sidebar) -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" style="font-size: 16px" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="../../index3.html" class="nav-link">Home</a>
        </li> --}}
    </ul>


    <!-- Right navbar links -->
    {{-- BOTÃO DE NOTIFICAÇÃO --}}
    <ul class="navbar-nav ml-auto">

        {{-- <div class="dropdown">

            <button id="dLabel" class="btn btn-sm btn-danger dropdown-toggle" role="button" data-toggle="dropdown" data-target="#">
                <i class="fas fa-bell text-white"></i>
                Transferir / Desmob.
                <span class="badge rounded-pill badge-notification bg-white">65</span>
            </button>

            <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">

                <div class="notification-heading"><h4 class="menu-title">Notifications</h4><h4 class="menu-title pull-right">View all
                    <i class="glyphicon glyphicon-circle-arrow-right"></i></h4>
                </div>
                <li class="divider"></li>
                <div class="notifications-wrapper">

                    <a class="content" href="#">
                    <div class="notification-item">
                        <h4 class="item-title">Evaluation Deadline 1 · day ago</h4>
                        <p class="item-info">Marketing 101, Video Assignment</p>
                    </div>
                    </a>
                    <a class="content" href="#">
                    <div class="notification-item">
                        <h4 class="item-title">Evaluation Deadline 1 · day ago</h4>
                        <p class="item-info">Marketing 101, Video Assignment</p>
                    </div>
                    </a>

                </div>
                <li class="divider"></li>
                <div class="notification-footer">
                    <h4 class="menu-title">View all<i class="glyphicon glyphicon-circle-arrow-right"></i></h4>
                </div>

            </ul>

        </div> --}}

        {{-- Flags --}}
        <div>
            <ul>
                <li class="nav-item dropdown">
                    {{-- <a href="{{ url('vehicle/create') }}" class="btn btn-block btn-outline-secondary">
                        <i class="fas fa-car-alt"></i>
                    </a> --}}

                    <a class="nav-link dropdown-toggle" style="padding: 0px; margin-top: 2px;" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{-- <span class="fas fa-flag-{{Config::get('languages')[App::getLocale()]['flag-icon']}}"></span> {{ Config::get('languages')[App::getLocale()]['display'] }} --}}
                        <img src="/{{Config::get('languages')[App::getLocale()]['flag-icon']}}" />
                        {{-- {{ Config::get('languages')[App::getLocale()]['display'] }} --}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        @foreach (Config::get('languages') as $lang => $language)
                            @if ($lang != App::getLocale())
                            <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}">
                                {{-- <span class="fas fa-flag-{{$language['flag-icon']}}"></span> --}}
                                <img src="/{{$language['flag-icon']}}" />
                                {{$language['display']}}</a>
                            @endif
                        @endforeach
                    </div>
                </li>
            </ul>
        </div>


        <div>

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" style="font-size: 18px; margin-right: 10px; margin-top: 6px;" href="{{ route('logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                   </a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                <a href="../../index3.html" class="nav-link">Home</a>
                </li> --}}
            </ul>
            {{--
            <button id="dLabel" class="btn btn-sm btn-danger dropdown-toggle" role="button" data-toggle="dropdown" data-target="#">
                <i class="" aria-hidden="true"></i>
            </button> --}}

            {{-- <a href="" class="nav-link"> --}}


        </div>



      <!-- Navbar Search -->
      {{-- <li class="nav-item">




        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li> --}}

      <!-- Messages Dropdown Menu -->
      {{-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li> --}}
      <!-- Notifications Dropdown Menu -->
      {{-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
    </ul>
  </nav>
