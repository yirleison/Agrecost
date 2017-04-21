@extends("layouts.app")

@section('contenedor')
<link rel="stylesheet" href="/librerias/css/Estilo.css">
<div id=""  class="row container-fluid"> 

  <div class="row" >
    <div class="col-md-4" style="margin-top: 30px; font-weight: bold; font-size: 17px;">
      <a href="/consultar/movimiento" class="btn btn-info fa fa-arrow-left"> Regresar</a>
    </div>
  </div>

  <div class="row" >
    <div class="col-md-12 text-center" style="margin-top: 30px; font-weight: bold; font-size: 17px;">
      <h3>DETALLE MOVIMIENTOS PRODUCIÓN</h3>
    </div>
  </div>

  <div class="row" >
    <div class="col-md-10" style="margin-top: 30px; font-weight: bold; font-size: 17px;">
     <h4 style="margin-bottom: 20px;">Cantidad Producción <span class="label label-success"> {{$can_m}} LT</span></h4>
    </div>
    <div class="col-md-2 text-right" style="margin-top: 30px; font-weight: bold; font-size: 17px;">
      <i class="fa fa-file-excel-o est_excel"> Exportar</i>
    </div>
  </div>

  <div class="row" style="margin-top:20px;">
    <div class="col-md-12" style="background:white;">
      <div class="content-tabla table-responsive" id="cont_tbl_dtv">
        <table class="display table-bordered table-striped  text-center table-hover " id="tbl_d_movi" style="width:100%">
          <thead>
            <tr>
              <th class="text-center">Codigo Tanque</th>
              <th class="text-center">Cantidad</th>
            </tr>
          </thead>
          <tbody id="tbl_tv">
              @foreach ($dtv as $v)
                <tr>
                  <td>{{$v->Codigo_tanque}}</td>
                  <td>{{$v->Cantidad}}</td>
                </tr>
              @endforeach()

            
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
