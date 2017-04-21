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
				{!!Form::select('Animal',$ani, null,['class'=>'form-control' , 'id'=>'Animal','placeholder'=>'Seleccione el animal','onchange'=>'promedio.marcado(this.value)'])!!}

			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				{!!Form::text('Marcado',null,['value'=>'.$var.','id'=>'Marcado','class'=>'form-control','readonly'])!!}
			</div>
		</div>
	</div>
	<br>
	<br>
	<br>
	
	<div class="form row" style="display: " id="Divpromedio">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-lg-8 col-lg-offset-2">

				<table  class="table table-responsive table-bordered table-striped" id="tblPorAnimal">
					<thead>
						<tr>							
							<th>Fecha de produccion</th>
							<th>Cantidad de leche</th>
							
						
						</tr>
					</thead>
					<tbody >

					</tbody>
				</table>

				{{-- <div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
					<label id="lblTotal" for="">Total</label>					
					<input readonly type="text" id="total" name="total" class="form-control">
				</div> --}}

			</div>
		</div>
	</div>
</div>
{{-- {!!Form::close()!!} --}}


@endsection




@section('scripts')
<script>
	promedio.marcado()
	promedio.mandar();	

	$("#Animal").select2();

	var acumulador = {
		calcular:function(){

			var suma = 0;
				$('#tbl_promedio tr').each(function(i, e){ //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas
					var td = $(e).find('td').eq(1);
 				suma += parseInt($(td).find("input").eq(0).val()||0,10) //numero de la celda 3
 			})
				$("#total").val(suma);			

			}
		}
	</script>

	@endsection