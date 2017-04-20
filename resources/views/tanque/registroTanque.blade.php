
@extends("layouts.app")

@section('contenedor')
	<!-- Cuerpo del formulario, aca deben ir todos los input y demas elementos -->
	<link rel="stylesheet" href="/librerias/css/Estilo.css">
	
	{!!Form::open(array('route'=>'registrar-tanque', 'method'=>'post','id'=>'registrar-tanque','autocomplete'=>'off'))!!}
	{!!Form::token()!!}
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
		<div class="form row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<!-- Titulo central -->
				<h3 id="Encabezado_del_formulario">REGISTRO TANQUE</h3>
			</div>
		</div>
		<!-- Division izquierda del formulario -->
		<div class="form row">
			<div class="col-lg-4 col-lg-offset-2 col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-10 col-xs-offset-1">
				<div class="form-group">
					<input class="form-control" placeholder="Capacidad" type="text" name="capacidad" id="capacidad" value="">
				</div>
			</div>
			<!-- Division derecha del formulario -->
			<div class="col-lg-4 col-md-4 col-md-offset-0 col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1">
				<div class="form-group">
					<div class="input-group">
						<label for="txtEstado" class="input-group-addon " >Estado:</label>
						<input class="form-control "  id="txtEstado" readonly="readonly" placeholder="Disponible" type="text" name="Estado" value="">
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
@endsection<!-- Cuerpo del formulario, aca deben ir todos los input y demas elementos -->

@section('scripts')
	<script type="text/javascript">
	validaciones.validarTanque();
	</script>
@endsection
