<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="/vendors/nprogress/nprogress.css" rel="stylesheet">
  <link href="/build/css/custom.min.css" rel="stylesheet">
  <link href="/librerias/pnotify/pnotify.custom.min.css" rel="stylesheet">
  <link href="/librerias/datatable/datatables.min.css" rel="stylesheet">
  <link href="/librerias/datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link href="/librerias/select2/css/select2.min.css" rel="stylesheet">

  
  
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>
  <script>
    window.Laravel = {!! json_encode([
      'csrfToken' => csrf_token(),
      ]) !!};
    </script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title">
                <img src="/librerias/Imagenes/logo.png" alt=""> <span>AGRECOST</span>
              </a>
            </div>

            <div class="clearfix"></div>

            <!--Menu Perfil de inicio -->

            <!--FIN Menu perfil de inicio -->
            <br />
            <!--Menu Navegacion -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a><img src="/librerias/Imagenes/Iconos/inicio.png" alt=""> Inicio </a>
                  </li>
                  <li><a><img src="/librerias/Imagenes/Iconos/vaca.png" alt=""> Animales <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('Animal.create')}}">Registro Animal</a></li>
                      <li><a href="">Consulta Animal</a></li>  
                      <li><a href="{{url('promedioleche/poranimal')}}"> Promedio de leche por animal</a></li>                    

                    </ul>
                  </li>
                  <li><a><img src="/librerias/Imagenes/Iconos/vacuna.png" alt=""> Venta  <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">                      
                      <li><a href="{{url('ventaAnimal')}}"> Registrar una venta de animal</a></li>
                      <li><a href="{{url('ventaAnimal/listar')}}"> Listar ventas de animal</a></li> 

                    </ul>
                  </li> 
                  <li><a><img src="/librerias/Imagenes/Iconos/corral.png" alt=""> Corrales <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables.html">Tables</a></li>
                      <li><a href="tables_dynamic.html">Table Dynamic</a></li>
                    </ul>
                  </li>
                  <li><a><img src="/librerias/Imagenes/Iconos/leche.png" alt=""> Produccion <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('promedioleche')}}">Producion por animal</a></li>
                      
                    </ul>
                  </li>
                  <li>
                    <a>
                      <img src="/librerias/Imagenes/Iconos/insumo.png" alt=""> Insumos <span class="fa fa-chevron-down"></span>
                    </a>
                    <ul class="nav child_menu">
                      <li><a href="fixed_sidebar.html">Fixed Sidebar</a></li>
                      <li><a href="fixed_footer.html">Fixed Footer</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
              </div>
            </div>
            <!--FIN Menu Navegacion-->

            <!--Menu Footer-->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!--FIN Menu Footer-->
          </div>
        </div>
        <!--Menu Superior -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <!--Navegacion Mensajes y perfil-->
              <ul class="nav navbar-nav navbar-right">
            
                 
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->nombre }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                   
        

              <li role="presentation" class="dropdown">
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">Notificaciones 
                  <i class="fa fa-envelope-o"></i>
                  <span class="badge bg-green">6</span>
                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                  <li>
                    <a>
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <a>
                      <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                      <span>
                        <span>John Smith</span>
                        <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                        Film festivals used to be do-or-die moments for movie makers. They were where...
                      </span>
                    </a>
                  </li>
                  <li>
                    <div class="text-center">
                      <a>
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
            <!--FIN Navegacion Mensajes y perfil-->
          </nav>
        </div>
      </div>
      <!--FIN Menu Superior-->

      <!--CONTENIDO-->
      <div class="right_col" style="background-color: rgba(255,255,265,0.9)" role="main">
        @yield('contenedor')
      </div>
      <!--FIN CONTENIDO -->

      <!--Pie de pagina-->
      <footer>
        <div class="clearfix">
          <span class="footer">Copyrigth © 2017 Agrecost</span>
        </div>
      </footer>
      <!--FIN pie de pagina-->
    </div>
  </div>
</body>

<script src="/vendors/jquery/dist/jquery.min.js"></script>
<script src="/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/vendors/fastclick/lib/fastclick.js"></script>
<script src="/vendors/nprogress/nprogress.js"></script>
<script src="/build/js/custom.js"></script>
<script src="/librerias/datatable/datatables.min.js"></script>
<script src="/librerias/select2/js/select2.min.js"></script>
<script src="/librerias/pnotify/pnotify.custom.min.js"></script>
<script src="/librerias/datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="/librerias/datepicker/locales/bootstrap-datepicker.es.min.js"></script>
<script src="/librerias/js/Venta_animalScript.js"></script>
<script src="/librerias/js/promedioScript.js"></script>
<script src="/librerias/jqueryvalidation/dist/jquery.validate.min.js"></script>
<script src="/librerias/jqueryvalidation/dist/localization/messages_es.min.js"></script>



@if (Session::has('notifier.notice'))
<script>
  new PNotify({!! Session::get('notifier.notice') !!});
</script>
@endif

@yield('script')
</html>
