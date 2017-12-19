@extends("layouts.app")

@section('contenedor')
<!-- Cuerpo del formulario, aca deben ir todos los input y demas elementos -->
@if(count($errors)>0)
<div class="alert alert-danger">
	<ul>
		@foreach($errors->all() as $error)
		<li>{{$error}}</li>
		@endforeach
	</ul>
</div>
@endif
{!!Form::open(array('url'=>'Animal','method'=>'post','autocomplete'=>'off'))!!}
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
			<h3 id="Encabezado_del_formulario">REGISTRO DE BOVINO</h3>
		</div>
	</div>
	<!-- Division izquierda del formulario -->
	<div class="form row">
		<div class="col-lg-4 col-lg-offset-2 col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-10 col-xs-offset-1">
			<div class="form-group">
				<input autofocus="" onfocus="(txtFecha.type='text')" type="text" id="txtNombre" name="Nombre" class="form-control" placeholder="Ingrese Nombre:">
			</div>
			<div class="form-group">
				<input type="text" id="txtMarcado" name="Marcado" class="form-control" placeholder="Ingrese Numero de Marcado:">
			</div>
			<div class="form-group">
				<div class="input-group">
					<select class="form-control" name="Raza" id="sltRaza">
						<option selected="">--- Seleccione Raza ---</option>				
						@foreach($Raza as $raza){
						<option value="{{$raza->Codigo}}">{{$raza->Nombre}}</option>}
						@endforeach
					</select>
					<span class="input-group-btn">
						<button class="btn btn-success" id="btn_modal" type="button">Crear</button>
					</span>
				</div>
			</div>
			<div class="form-group">
				<select class="form-control" id="sltSexo" name="Sexo" >
					<option value="" selected="" >--- Seleccione Sexo ---</option>
					<option value="Masculino">Masculino</option>
					<option value="Femenino">Femenino</option>
				</select>
			</div>
		</div>
		<!-- Division derecha del formulario -->
		<div class="col-lg-4 col-md-4 col-md-offset-0 col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1">
			<div class="form-group">
				<input autofocus="" type="date" onblur="(this.type='text')" onfocus="(this.type='date')" id="txtFecha" name="Fecha" class="form-control" placeholder="Fecha de nacimiento:">
			</div>
			<div class="form-group">
				<div class="input-group">
					<input type="number" id="txtPeso" name="Peso" class="form-control" placeholder="Ingrese Peso:">
					<p class="input-group-addon ">Kg</p>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<label for="txtEstado" class="input-group-addon">Estado:</label>
					<input type="text" class="form-control" readonly="readonly" name="Estado" id="txtEstado" value="Disponible">
				</div>
			</div>
		<!--<div class="form-group">
				<div class="input-group">
					<input type="text" name="txtArchivo" placeholder="Seleccionimagen del animal" class="form-control" id="url-archivo">
					<label class="input-group-addon"> 
						<img src="{{asset('librerias/Imagenes/cargar.png')}}" alt=""> 
						<span>
							<input type="file" id="archivo" name="archivo">
						</span>
					</label>	
				</div>
			</div>-->								
		</div>
	</div>
	<br>
	<!-- Botones del formulario -->
	<div class="form row">
		<div class="col-lg-2 col-lg-offset-4 col-md-2 col-md-offset-4 col-sm-2 col-sm-offset-3 col-xs-5 col-xs-offset-1">
			<button type="submit" id="btnGuardar" name="Registro" class="btn btn-success"><img src="/librerias/Imagenes/Iconos/guardar.png" /> Guardar</button>	
		</div>
		<div class="col-lg-1 col-md-1 col-md-offset-0 col-sm-1 col-sm-offset-1 col-xs-5">
			<button type="reset" id="btnCancelar" class="btn btn-warning"><img src="/librerias/Imagenes/Iconos/limpiar.png" /> Limpiar</button>
		</div>
	</div>
</div>
<!-- modal para el regstro de raza -->
{!!Form::close()!!}
<div class="row">
	<div class="col-md-12">
		<div class="modal fade" id="mod_crear" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content col-md-10 col-md-offset-2">
					{!!Form::open(array('url'=>'/Animal/Raza','method'=>'post','autocomplete'=>'off'))!!}
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel"><img src="/librerias/Imagenes/Iconos/vaca_modal.png" alt=""> Registrar Raza</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12"  style="padding-bottom: 10px">
								<label for="">Nombre Raza</label>
								<input type="text" id="txtRaza" name="NombreRaza" placeholder="Raza:" class="form-control">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button id="btn_crear" type="submit" class="btn btn-success">Crear</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					</div>					
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection<!-- Cuerpo del formulario, aca deben ir todos los input y demas elementos -->

@section('scripts')
<script type="text/javascript">
	$('#btn_modal').click(function () 
	{
		$('#mod_crear').modal();
	});

	$('#btn_crear').click(function () 
	{
		$('#mod_crear').modal();
	});

</script>
@endsection