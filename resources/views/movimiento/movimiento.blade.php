@extends("layouts.app")

@section('contenedor')
  <link rel="stylesheet" href="/librerias/css/Estilo.css">
  <div id="formulario"  class="row container-fluid">
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
    <div class="row">
      <div class="col-md-6 ">
        <div class="form-group">
          <label for="">Movimiento</label>
          {!!Form::select('movimiento',[''=>'Seleccione','1'=>'Venta','2'=>'Produccion'],null,['class'=>'form-control','id'=>'ocultar-produccion'])!!}
        </div>
      </div>
      <div class="col-md-3 text-center venta" style="margin-top: 23px;" id="btn-registrar">
        <div class="form-group">
          <button type="button" id="btn_r_venta"  class="btn btn-success" onclick="movimiento.registar_venta();" name="button">Registrar</button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="venta">
        <div class="col-md-6">
          <div class="form-group">
            <label for="">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad" value="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="">Valor</label>
            <div class="input-group">
              <span class="input-group-addon">$</span>
              <input type="number" name="valor" id="valor" class="form-control" placeholder="Valor" value="">

            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" >
      <div class="col-md-12 hidden ">
        <div class="total-leche" id="">
          <h3><span class="label label-warning"><label for="">Total $ </label> <label for="" id="total" name="total"></label></span></h3>
        </div>
      </div>
    </div>
    <div class="row" style="margin-top:20px;">
      <div class="col-md-12" style="background:white;">
        <div class="content-tabla table-responsive" id="tabla-detalle-venta">
          <table  class="table table-striped table-bordered table-list text-center" style="width:100%;">
            <thead >
              <tr>
                <th class="text-center">Codigo Venta</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Valor Venta</th>
                <th class="text-center">Tipo Movimiento</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody id="tblTq">

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center Produccion" style="margin-bottom:20px;">
        <h3>Producción</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 Produccion">
        <div class="form-group">
          <select class=" form-control" id="corrales" name="corrales" style="width:100%;">
            <option value="">Seleccione</option>
            @foreach ($corrales as  $value)
                <option value="{{$value->Codigo}}"> <p> Codigo </p>{{$value->Codigo}}<b> --- Estado </b> {{$value->Estado}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="col-md-6 Produccion">
        <div class="form-group">
          {!!Form::select('jornada',[''=>'Seleccione Jornada','1'=>'Mañana','2'=>'Tarde'],null,['class'=>'form-control','id'=>'jornada_p'])!!}
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 Produccion">
        <div class="form-group">
          <input type="number" name="cantidad_produccion" id="cantidad_produccion" class="form-control" placeholder="Cantidad" value="">
        </div>
      </div>
    </div>
    <div class="row" style="margin-top:20px;">
      <div class="col-md-12" style="background:white;">
        <div class="content-tabla table-responsive" id="tabla-detalle-produccion">
          <table  class="table table-bordered table-striped table-responsive text-center" style="width:100%;">
            <thead >
              <tr>
                <th class="text-center">Codigo</th>
                <th class="text-center">Tipo Movimiento</th>
                <th class="text-center">Cantidad</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Acción</th>
              </tr>
            </thead>
            <tbody id="tblprod">

            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row" style="margin-top:35px;">
      <div class="col-lg-2 col-lg-offset-4 col-md-2 col-md-offset-4 col-sm-2 col-sm-offset-3 col-xs-5 col-xs-offset-1 Produccion">
        <button type="submit" id="btn-produccion" onclick="movimiento.registrar_produccion();" class="btn btn-success"><img src="/librerias/Imagenes/Iconos/guardar.png" /> Registrar</button>
      </div>
      <div class="col-lg-1 col-md-1 col-md-offset-0 col-sm-1 col-sm-offset-1 col-xs-5 Produccion">
        <button type="reset" id="btnCancelar" class="btn btn-warning"><img src="/librerias/Imagenes/Iconos/limpiar.png" /> Limpiar</button>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
  <script type="text/javascript">
  $('#sandbox-container').datepicker({
    language: "es",
    format: 'yyyy-mm-dd'
  });
  movimiento.init();

  </script>
@endsection
