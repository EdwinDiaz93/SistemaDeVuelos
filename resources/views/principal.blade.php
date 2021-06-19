<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema Ventas Laravel Vue Js- IncanatoIT">
    <meta name="author" content="Incanatoit.com">
    <meta name="keyword" content="Sistema ventas Laravel Vue Js, Sistema compras Laravel Vue Js">
    <link rel="shortcut icon" href="img/favicon.png">
    <title>Sistema de Vuelos  </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Icons -->
    <link href="css/plantilla.css" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <div id="app"> 
        <header class="app-header navbar">
            <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
            <span class="navbar-toggler-icon"></span>
            </button>
            <a>
            </a>

            <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
            <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="nav navbar-nav d-md-down-none">
              <!-- <li class="nav-item px-3">
                    <a class="nav-link" href="#">Reservas</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link" href="#">Vuelos</a>
                </li> -->
                
            </ul>
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item d-md-down-none">
                   
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header text-center">
                            <strong>Notificaciones</strong>
                        </div>
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-envelope-o"></i> Ingresos
                            <span class="badge badge-success">3</span>
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fa fa-tasks"></i> Ventas
                            <span class="badge badge-danger">2</span>
                        </a>
                    </div>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link" href="#">{{now()}}</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown"  aria-haspopup="true" >
                        <img src="img/avatars/avion2.png" class="img-avatar" alt="admin@bootstrapmaster.com">
                        <span >{{Auth::user()->nomusuario}}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header text-center">
                            <strong>Cuenta</strong>
                        </div>
                    </div>
                </li>  
                 
            </ul>
            <li class="nav-item px-3">
            <span><a href="http://127.0.0.1:8000/" class="btn btn-danger" >Cerrar Sesión</a></span>
            </li>
        </header>

        <div class="app-body">

          @if(Auth::check())
                @if(Auth::user()->idrol == 1)
                    @include('plantilla.sidebaradministrador')
                @elseif(Auth::user()->idrol == 2)
                    @include('plantilla.sidebarempleado')
                @elseif(Auth::user()->idrol == 3)
                    @include('plantilla.sidebarcliente')    
                @else

                @endif  

            @endif 
            
          
            <!-- Contenido Principal  -->
            @yield('contenido')
            <!-- /Fin del contenido principal -->
        </div>
    </div>
    

    <footer class="app-footer">
        <span><a href="{{ route('main') }}">Sistema De Vuelos</a> &copy; 2021</span>
    </footer>

    <script src="js/app.js"></script>
    <script src="js/plantilla.js"></script>
    
</body>

</html>