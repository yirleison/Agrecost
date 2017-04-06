@extends("layout.app")

@section('contenedor')
<table id="tblList" class="table">
  <thead>
    <tr>
      <th>Nombre</th> 
      <th>Periodicidad</th> 
      <th>Dosis</th> 
      <th>Opciones</th> 
    </tr>
  </thead>
  <tbody>

  </tbody>
</table>


<div class="row">
  <div class="col-md-12">
    <div class="modal fade" id="mod_ventas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-lg">
        <div class="modal-content col-md-10 col-md-offset-2">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel"><i class="fa fa-user" aria-hidden="true"></i> Vacunacion</h4>
          </div>
          <div class="modal-body">            
            


            
            <div id="area-example"></div>
            <div class="modal-footer">
              {!!Form::button('Guardar',['class'=>'btn btn-success', 'onclick'=>'vacunacion_js.guardar_vacuna();'])!!}  
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 



  @endsection





  

  @section('script')
  



  @endsection

