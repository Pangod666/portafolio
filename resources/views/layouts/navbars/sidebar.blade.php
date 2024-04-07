<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('dashboard') }}">
            <img src="{{ asset('argon') }}/img/brand/sisam.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="https://assets.stickpng.com/images/585e4bf3cb11b227491c339a.png">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Bienvenido!</h6>
                    </div>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Configuracion') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            {{-- <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span>aea</span>
                            <span>bcb</span>
                        </button>
                    </div>
                </div>
            </div> --}}
            
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('PRINCIPAL') }}
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        <i class="fab fa-laravel" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('Laravel Examples') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile.edit') }}">
                                    {{ __('User profile') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('user.index') }}">
                                    {{ __('User Management') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                @can('reports')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('userlist') }}">
                    <i class="fa fa-user-md" aria-hidden="true"></i> {{ __('USUARIOS') }}
                    </a>
                </li>
                @endcan
                    
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('bedindex') }}">
                    <i class="fa fa-stethoscope" aria-hidden="true"></i>
                      <span class="nav-link-text">ESPECIALIDADES</span>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('patientindex') }}">
                    <i class="fa fa-users" aria-hidden="true"></i> {{ __('PACIENTES') }}
                    </a>
                </li>

                @can('laboratorio')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('providerlist') }}">
                    <i class="fa fa-medkit" aria-hidden="true"></i>
                      <span class="nav-link-text">PROVEEDORES</span>
                    </a>
                </li>
                @endcan


                
                
                @can('agregar_categoria')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index_category') }}">
                      <i class="ni ni-single-copy-04 text-default"></i>
                      <span class="nav-link-text">GRUPOS DE MEDICAMENTOS</span>
                    </a>
                </li>
                @endcan
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('productlist') }}">
                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                      <span class="nav-link-text">ALMACEN DE MEDICAMENTOS</span>
                    </a>
                </li>

                @can('reports')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('report_index') }}">
                    <i class="fa fa-folder" aria-hidden="true"></i>
                      <span class="nav-link-text">INGRESO Y EGRESO DE MEDICAMENTOS </span>
                    </a>
                </li>
                @endcan


                <li class="nav-item">
                    <a class="nav-link" href="{{ route('descargosindex') }}">
                    <i class="fa fa-download" aria-hidden="true"></i>
                      <span class="nav-link-text">DESCARGOS</span>
                    </a>
                </li>
                
            </ul>
            <!-- Divider -->
            {{-- <hr class="my-3"> --}}
            <!-- Heading -->
            
        </div>
    </div>
</nav>
