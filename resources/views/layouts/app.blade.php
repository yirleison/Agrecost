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
  <link rel="stylesheet" href="/librerias/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="/librerias/datatable/datatable.css">
  <link rel="stylesheet" href="/vendors/select2/dist/css/select2.css">

  <link rel="stylesheet" href="/librerias/pnotify/pnotify.custom.min.css">

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
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="/librerias/Imagenes/usuario.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Bienvenido,</span>
              <h2>Nombre del usuario</h2>
            </div>
            <div class="clearfix"></div>
          </div>
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
                    <li><a href="#">Registro Animal</a></li>
                    <li><a href="">Consulta Animal</a></li>
                    <li><a href="form_validation.html">Venta Animal</a></li>
                    <li><a href="{{url('promedioleche/poranimal')}}">Promedio Produccion</a></li>
                    <li><a href="form_wizards.html">Generar Reporte</a></li>
                  </ul>
                </li>
                <li><a><img src="/librerias/Imagenes/Iconos/vaca.png" alt=""> Ventas <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{url('ventaAnimal')}}">Venta Animal</a></li>
                    <li><a href="{{url('ventaAnimal/listar')}}">Consultar venta</a></li>
                  </ul>
                </li>
                <li><a><img src="/librerias/Imagenes/Iconos/corral.png" alt=""> Corrales <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="corrales">Registro Corrales</a></li>
                    <li><a href="consultar/corrales">Consultar Corral</a></li>
                  </ul>
                </li>
                <li><a><img src="/librerias/Imagenes/Iconos/leche.png" alt=""> Tanques <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="{{route('tanques')}}">Registro Tanques</a></li>
                    <li><a href="{{route('listar-tanques')}}">Consultar Tanque</a></li>
                    <li><a href="morisjs.html">Moris JS</a></li>
                    <li><a href="echarts.html">ECharts</a></li>
                    <li><a href="other_charts.html">Other Charts</a></li>
                  </ul>
                </li>
                <li><a><img src="/librerias/Imagenes/Iconos/leche.png" alt=""> Produccion <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="movimiento">Movimiento</a></li>
                  <li><a href="{{url('promedioleche')}}">Produccion animal</a></li>
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
            <li class="">
              <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="/librerias/Imagenes/admin.png" alt="">Administrador
                <span class=" fa fa-angle-down"></span>
              </a>
              <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li>
                  <a href="login.html"><i class="fa fa-sign-out pull-right"></i> Cerrar Sesion</a>
                </li>
              </ul>
            </li>

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

<script src="/build/js/custom.js"></script>
<script src="/vendors/nprogress/nprogress.js"></script>
<script src="/librerias/datatable/datatable.js"></script>
<script src="/librerias/js/agrecost.js"></script>
<script src="/librerias/js/validar_venta.js"></script>
<script src="/librerias/js/movimiento.js"></script>
<script src="/librerias/js/promedioScript.js"></script>
<script src="/librerias/js/Venta_animalScript.js"></script>
<script src="/librerias/jquery-validate/jquery.validate.min.js"></script>
<script src="/librerias/jquery-validate/additional-methods.min.js"></script>
<script src="/librerias/jquery-validate/messages_es.min.js"></script>
<script src="/librerias/js/agrecost.validaciones.js"></script>
<script type="text/javascript" src="/librerias/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="/librerias/bootstrap-datepicker/locales/bootstrap-datepicker.es.min.js"></script>
<script type="text/javascript" src="/vendors/select2/dist/js/select2.full.js"></script>

@yield('scripts')

<script src="/librerias/pnotify/pnotify.custom.min.js"></script>
@if (Session::has('notifier.notice'))
<script>
<?php
  $datos = json_decode(Session::get('notifier.notice'));
?>
    new PNotify({"title":'<?= $datos->title ?>', "text":'<?= $datos->text ?>', "type":'<?= $datos->type ?>'});
</script>
@endif


</html>
