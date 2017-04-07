@extends('layouts.app')



@section('contenedor')

<link rel="stylesheet" href="/librerias/css/Estilo.css">


<div id="formulario"  class="row">
	<!-- Division superior del formulario -->
	<div class="form row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="form-group">
				<div class="page-header">
					<!-- Url de la imagen central -->
					<img class="img img-responsive  img-circle" src="/librerias/Imagenes/promedio.jpg">
				</div>
			</div>
		</div>
	</div>
	<div class="form row" >
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 " style="padding-bottom: 30px">
			<!-- Titulo central -->
			<h3 id="Encabezado_del_formulario">PROMEDIO POR ANIMAL</h3>
		</div>
	</div>
	<!-- Division izquierda del formulario -->
	{{-- {!!Form::open(['url'=>'promedioleche','method'=>'post'])!!}	 --}}
	<div class="form row">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				{!!Form::select('Animal',$ani, null,['class'=>'form-control' , 'id'=>'Corrales','placeholder'=>'Seleccione el animal' ,'onchange'=>'promedio.marcado(this.value)'])!!}

			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				{!!Form::text('Marcado',null,['id'=>'Marcado','class'=>'form-control','disabled'])!!}
			</div>
		</div>
	</div>
	<br>
	<br>

	<br>




	<!-- Botones del formulario -->
	<div class="form row">
		<div class="col-lg-2 col-lg-offset-4 col-md-2 col-md-offset-4 col-sm-2 col-sm-offset-3 col-xs-5 col-xs-offset-1">


			<button type="submit" id="btnGuardar" onclick="promedio.guardar()" class="btn btn-success"><img src="/librerias/Imagenes/Iconos/guardar.png" /> Guardar</button>	
		</div>
		<div class="col-lg-1 col-md-1 col-md-offset-0 col-sm-1 col-sm-offset-1 col-xs-5">
			<button type="reset" id="btnCancelar" class="btn btn-warning"><img src="/librerias/Imagenes/Iconos/limpiar.png" /> Limpiar</button>

		</div>
	</div>
</div>
{{-- {!!Form::close()!!} --}}


@endsection




@section('scripts')
<script>
promedio.marcado()
</script>

@endsection