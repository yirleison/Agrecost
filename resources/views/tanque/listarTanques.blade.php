@extends("layouts.app")

@section('contenedor')
  <!-- Cuerpo del formulario, aca deben ir todos los input y demas elementos -->
  <link rel="stylesheet" href="/librerias/css/Estilo.css">
  <div id="formulario"  class="row">
    <!-- Division superior del formulario -->
    <div class="form row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
          <div class="page-header">
            <!-- Url de la imagen central -->
            <img class="img img-responsive  img-circle" src="/librerias/Imagenes/vaca.jpg">
          </div>
        </div>
      </div>
    </div>
    <div class="form row" >
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <!-- Titulo central -->
        <h3 id="Encabezado_del_formulario">Tanques</h3>
      </div>
    </div>
    <br>
    <!-- Division izquierda del formulario -->

    <div class="form row" >
      <div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1" >
        <table class="table table-bordered table-responsive text-center "  id="users-table">
          <thead>
            <tr>
              <th class="text-center">Codigo</th>
              <th class="text-center">Cantidad</th>
              <th class="text-center">Capacidad</th>
              <th class="text-center">Estado</th>
              <th class="text-center">Acciones</th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


{{-- modal para actualizar tanque --}}
<div class="row">
  <div class="col-md-12">
    <div class="modal fade" id="mod_editar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-lg">
        <div class="modal-content col-md-10 col-md-offset-2">
          {!!Form::open(['id'=>'tanque-actualizar'])!!}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user" aria-hidden="true"></i> Información del tanque</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12"  style="padding-bottom: 10px">
                {!!form::label('Código animal')!!}
                {!!form::number('codigo',null,['class'=>'form-control','id'=>'codigo','readonly'=>'readonly'])!!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-12"  style="padding-bottom: 10px">
                {!!form::label('Cantidad')!!}
                {!!form::number('cantidad',null,['class'=>'form-control','id'=>'cantidad'])!!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-12"  style="padding-bottom: 10px">
                {!!form::label('Capacidad')!!}
                {!!form::input('text','capacidad',null,['class'=>'form-control','id'=>'capacidad'])!!}
              </div>
            </div>
            <div class="row">
              <div class="col-md-12"  style="padding-bottom: 10px">
                {!!form::label('Estado')!!}
                {!!form::select('estado',['0'=>'Disponible','1'=>'Lleno','2'=>'Producción'],null,['class'=>'form-control','id'=>'estado'])!!}
              </div>
            </div>
            {!! Form::close() !!}
            <div id="area-example"></div>
            <div class="modal-footer">
              {!!Form::submit('Actualizar',['class'=>'btn btn-success'])!!}
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

@endsection

@section('scripts')
  <script type="text/javascript">
  tanque.tabla_tanque();
  validaciones.validar_actualizar_tanque();

  </script>
@endsection
