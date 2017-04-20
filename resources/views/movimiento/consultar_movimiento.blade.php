@extends("layouts.app")

@section('contenedor')
<link rel="stylesheet" href="/librerias/css/Estilo.css">
<div id="formulario"  class="row container-fluid"> 

 <div class="row">
   <div class="col-md-6 ">
    <div class="form-group">
      <label for="">Movimiento</label>
      {!!Form::select('cons_mov',[''=>'Seleccione','1'=>'Venta','2'=>'Produccion'],null,['class'=>'form-control','id'=>'cons_mov'])!!}
    </div>
  </div>
  <div class="col-md-6 ">
  <div class="" id="pro_mov">
       <div class="form-group">
      <label for="">Seleccione Jornada</label>
      {!!Form::select('jornada',[''=>'Seleccione Jornada','1'=>'Mañana','2'=>'Tarde'],null,['class'=>'form-control','id'=>'jornada'])!!}
    </div>
  </div>
   </div>
</div>

<div class="row" style="margin-top:20px;">
  <div class="col-md-12" style="background:white;">
    <div class="content-tabla table-responsive" id="cont_tbl_vent">
      <table class="display table-bordered  text-center table-hover " id="tbl_d_movi" style="width:100%">
        <thead>
          <tr>
            <th class="text-center">Codigo Venta</th>
            <th class="text-center">Cantidad</th>
            <th class="text-center">Fecha</th>
            <th class="text-center">Valor Venta</th>
            <th class="text-center">Tipo Movimiento</th>
            <th class="text-center">Acciones</th>
          </tr>
        </thead>
        <tbody id="tb_mv">

        </tbody>
      </table>

    </div>
  </div>
</div>


<div class="row" style="margin-top:20px;">
  <div class="col-md-12" style="background:white;">
    <div class="content-tabla table-responsive" id="cont_tbl_prod">
      <table class="display table-bordered  text-center table-hover " id="tbl_d_movi" style="width:100%">
        <thead>
          <tr>
            <th class="text-center">Codigo Produccion</th>
            <th class="text-center">Cantidad</th>
            <th class="text-center">Fecha</th>
            <th class="text-center">Tipo Movimiento</th>
            <th class="text-center">Acciones</th>
          </tr>
        </thead>
        <tbody id="tb_mv_p">

        </tbody>
      </table>

    </div>
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
