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
{!!Form::open(array('url'=>'Raza','method'=>'post','autocomplete'=>'off'))!!}
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
			<h3 id="Encabezado_del_formulario">RAZA</h3>
		</div>
	</div>
	<!-- Division izquierda del formulario -->
	<div class="form row">
		<div class="col-lg-4 col-lg-offset-2 col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-10 col-xs-offset-1">
			<div class="form-group">
				<select class="form-control" name="Raza" id="sltRaza">
					<option selected="">--- Seleccione Raza ---</option>				
					@foreach($Raza as $raza)
					{<option value="{{$raza->Codigo}}">{{$raza->Nombre}}</option>}
					@endforeach
				</select>
			</div>
		</div>
		<!-- Division derecha del formulario -->
		<div class="col-lg-4 col-md-4 col-md-offset-0 col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1">
			<div class="form-group">
				<select onchange="Mostrar()" class="form-control" id="sltAccion" name="Accion" >
					<option value="" selected="" >--- Accion a Realizar ---</option>
					<option value="Modificar">Modificar</option>
					<option value="Eliminar">Eliminar</option>
				</select>
			</div>				
		</div>	
	</div>
	<div class="form row">
		<div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-12 col-xs-12">
			<input name="nuevaRaza" id="nuevaRaza" style="visibility: hidden;" type="text" placeholder="Ingrese Raza:" class="form-control">
		</div>
	</div>
</div>
<!-- Botones del formulario -->
<div class="form row">
	<div class="col-lg-2 col-lg-offset-4 col-md-2 col-md-offset-4 col-sm-2 col-sm-offset-3 col-xs-5 col-xs-offset-1">
		<button type="submit" onclick="Enviar()" id="btnGuardar" class="btn btn-success"><img src="/librerias/Imagenes/Iconos/guardar.png" /> Guardar Cambios</button>	
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
	function Mostrar()
	{
		if(sltAccion.value == 'Modificar')
		{
			document.getElementById('nuevaRaza').style.visibility="visible";
			document.getElementById('sltRaza').disabled=true;
		}
		else 
		{
			document.getElementById('nuevaRaza').style.visibility="hidden";
			document.getElementById('sltRaza').disabled=false;
		}
	}
	function Enviar()
	{
		document.getElementById('sltRaza').disabled=false;
	}
</script>
@endsection