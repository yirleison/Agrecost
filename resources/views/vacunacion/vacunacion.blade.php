@extends("layout.app")

@section('contenedor')
<!-- Cuerpo del formulario, aca deben ir todos los input y demas elementos -->
<link rel="stylesheet" href="/librerias/css/Estilo.css">

{!!Form::open(array('method'=>'POST'))!!}
{!!Form::token()!!}
<div id="formulario"  class="row">
	<!-- Division superior del formulario -->
	<div class="form row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
				<div class="page-header">
					<!-- Url de la imagen central -->
					<img class="img img-responsive  img-circle" src="/librerias/Imagenes/vacuna.jpg">
				</div>
			</div>
		</div>
	</div>
	<div class="form row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<!-- Titulo central -->
			<h3 id="Encabezado_del_formulario">REGISTRO DE VACUNACION</h3>
		</div>
	</div>
	<!-- Division izquierda del formulario -->
	{!!Form::open(['url'=>'/vacunacion/create','method'=>'post'])!!}
	<div class="form row">
		<div class="col-lg-4 col-lg-offset-2 col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-10 col-xs-offset-1">
			{{-- <div class="form-group">
            {!!Form::text('Nombre',null,['class'=>'form-control' , 'id'=>'Nombre','placeholder'=>'Ingrese el nombre'])!!}
        </div> --}}

        <div class="form-group">  

        	<div class="input-group">
        		{!!Form::select('Tipo',$input1,null,['class'=>'js form-control' , 'id'=>'Tipo', 'placeholder'=>'Ingrese tipo de vacuna'])!!}  
        		<span class="input-group-addon" id="spa">Crear</span>
        		
        	</div>
        </div>
        <div class="form-group">
        	{!!Form::text('Cantidad',null,['class'=>'form-control' , 'id'=>'Cantidad','placeholder'=>'Ingrese la cantidad'])!!}
        </div>


    </div>
    <!-- Division derecha del formulario -->
    
    <div class="col-lg-4 col-md-4 col-md-offset-0 col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1">
    	
    	<div class="form-group" style="margin-bottom: 14px">
    		{!!Form::text('Presentacion',null,['class'=>'form-control' , 'id'=>'Presentacion','placeholder'=>'Ingrese la Presentacion'])!!}
    	</div>


    	<div class="form-group">

    		<div class="input-group date" id="datevacu">

    			<input type="text" placeholder="Ingrese fecha de compra" class="form-control"><span class="input-group-addon">
    			<i class="glyphicon glyphicon-th"></i></span>
    		</div>
    	</div>
    </div>
</div>
<br>
<!-- Botones del formulario -->
<div class="form row">
	<div class="col-lg-2 col-lg-offset-4 col-md-2 col-md-offset-4 col-sm-2 col-sm-offset-3 col-xs-5 col-xs-offset-1">


		<button type="submit" id="btnGuardar" class="btn btn-success"><img src="/librerias/Imagenes/Iconos/guardar.png" /> Guardar</button>	
	</div>
	<div class="col-lg-1 col-md-1 col-md-offset-0 col-sm-1 col-sm-offset-1 col-xs-5">
		<button type="reset" id="btnCancelar" class="btn btn-warning"><img src="/librerias/Imagenes/Iconos/limpiar.png" /> Limpiar</button>
	</div>
</div>
</div>
{!!Form::close()!!}
{{-- Modal --}}

<div class="row">
	<div class="col-md-12">
		<div class="modal fade" id="mod_vacunaciones" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content col-md-10 col-md-offset-2">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel"><i class="fa fa-user" aria-hidden="true"></i> Vacunacion</h4>
					</div>
					<div class="modal-body">            
						<div class="row">
							<div class="col-md-12"  style="padding-bottom: 10px">
								{!!form::label('Nombre vacunacion')!!}
								{!!Form::text('Nombre',null,['class'=>'form-control' , 'id'=>'Nombre','placeholder'=>'Ingrese el nombre'])!!}
							</div>
						</div>
						<div class="row">
							<div class="col-md-12"  style="padding-bottom: 10px">
								{!!form::label('Tipo de vacuna')!!}							
								<div class="input-group">
									{!!Form::select('Tipov',$input,null,['class'=>' form-control' , 'id'=>'Tipov'])!!}
									<span class="input-group-addon" id="spaModal">Crear</span>

								</div>

							</div>
						</div>

						<div class="row">
							<div class="col-md-12"  style="padding-bottom: 10px">
								{!!form::label('Periodicidad')!!}
								<div class="input-group date" id="dateModal">
									<input type="text" id="Periodicidad"  name="Periodicidad" placeholder="Ingrese Periodicidad" class="form-control"><span class="input-group-addon">
									<i class="glyphicon glyphicon-th"></i></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12"  style="padding-bottom: 10px">
								{!!form::label('Dosis')!!}
								{!!Form::text('Dosis',null,['class'=>'form-control','id'=>'Dosis','placeholder'=>'Ingrese dosis'])!!}
							</div>
						</div>
						<div class="row">
							<div class="col-md-12"  style="padding-bottom: 10px">
								{!!form::label('Tipo administracion')!!}
								{!!Form::text('Tipo_administracion',null,['class'=>'form-control','id'=>'Tipo_administracion','placeholder'=>'Tipo administracion'])!!}

							</div>
						</div>
						<div class="row">
							<div class="col-md-12"  style="padding-bottom: 10px">
								{!!form::label('Stock')!!}
								{!!Form::text('Stock',null,['class'=>'form-control','id'=>'Stock','placeholder'=>'Stock'])!!}
							</div>
						</div>
						{!! Form::close() !!}
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



<div class="row">
	<div class="col-md-12">
		<div class="modal fade" id="mod_vacunaciones_editar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content col-md-10 col-md-offset-2">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel"><i class="fa fa-user" aria-hidden="true"></i> Información vacunacion</h4>
					</div>
					<div class="modal-body">            
						<div class="row">
							<div class="col-md-12"  style="padding-bottom: 10px">
								{!!form::label('Nombre vacunacion')!!}
								{!!Form::text('Nombre',null,['class'=>'form-control' , 'id'=>'Nombre','placeholder'=>'Ingrese el nombre'])!!}
							</div>
						</div>
						<div class="row">
							<div class="col-md-12"  style="padding-bottom: 10px">
								{!!form::label('Tipo de vacuna')!!}							
								<div class="input-group">
									{!!Form::select('Tipo_editar',$input,null,['class'=>' form-control' , 'id'=>'Tipo_editar'])!!}
									<span class="input-group-addon" id="spaModal">Crear</span>

								</div>

							</div>
						</div>

						<div class="row">
							<div class="col-md-12"  style="padding-bottom: 10px">
								{!!form::label('Periodicidad')!!}
								<div class="input-group date" id="dateModal">
									<input type="text" id="Periodicidad"  name="Periodicidad" placeholder="Ingrese Periodicidad" class="form-control"><span class="input-group-addon">
									<i class="glyphicon glyphicon-th"></i></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12"  style="padding-bottom: 10px">
								{!!form::label('Dosis')!!}
								{!!Form::text('Dosis',null,['class'=>'form-control','id'=>'Dosis','placeholder'=>'Ingrese dosis'])!!}
							</div>
						</div>
						<div class="row">
							<div class="col-md-12"  style="padding-bottom: 10px">
								{!!form::label('Tipo administracion')!!}
								{!!Form::text('Tipo_administracion',null,['class'=>'form-control','id'=>'Tipo_administracion','placeholder'=>'Tipo administracion'])!!}

							</div>
						</div>
						<div class="row">
							<div class="col-md-12"  style="padding-bottom: 10px">
								{!!form::label('Stock')!!}
								{!!Form::text('Stock',null,['class'=>'form-control','id'=>'Stock','placeholder'=>'Stock'])!!}
							</div>
						</div>
						{!! Form::close() !!}
						<div id="area-example"></div>
						<div class="modal-footer">
							{!!Form::button('Guardar',['class'=>'btn btn-success'])!!}	
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>




	{{-- Modal del Modal vacunacion , para crear tipo --}}

	<div class="row">
		<div class="col-md-12">
			<div class="modal fade" id="mod_ventas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
				<div class="modal-dialog modal-lg">
					<div class="modal-content col-md-10 col-md-offset-2">

						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
							<h4 class="modal-title" id="myModalLabel"><i class="fa fa-user" aria-hidden="true"></i> Crear tipo de vacuna</h4>
						</div>
						<div class="modal-body">            
							<div class="row">
								<div class="col-md-12"  style="padding-bottom: 10px">
									{!!form::label('Tipo')!!}
									{!!Form::text('Nombretipo',null,['class'=>'form-control' , 'id'=>'Nombretipo','placeholder'=>'Ingrese el tipo de vacuna'])!!}
								</div>
							</div>

							<div id="area-example"></div>
							<div class="modal-footer">
								{!!Form::button('Guardar',['class'=>'btn btn-success', 'onclick'=>'vacunacion_js.guardar_tipo();'])!!}	
								<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		@endsection<!-- Cuerpo del formulario, aca deben ir todos los input y demas elementos -->

		@section('script')


		
		<script>
	vacunacion_js.guardar_vacuna();

			$("#spa").click(function(event) {
				$("#mod_vacunaciones").modal();
			});

			$("#spaModal").click(function(event) {
				$("#mod_Tipovacunaciones").modal();
			});


			$('#dateModal').datepicker({
				language: "es",
				autoclose: true,
				format: "yyyy-mm-dd"
			});


			$('#datevacu').datepicker({
				language: "es",
				autoclose: true,
				format: "yyyy-mm-dd"
			});


		</script>
		@endsection