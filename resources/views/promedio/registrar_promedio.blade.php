@extends('layout.app')



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
			<h3 id="Encabezado_del_formulario">REGISTRO DE PROMEDIO DE LECHE</h3>
		</div>
	</div>
	<!-- Division izquierda del formulario -->
	{{-- {!!Form::open(['url'=>'promedioleche','method'=>'post'])!!}	 --}}
	<div class="form row">
		
		<div class="row">			
			<div class="col-lg-4 col-lg-offset-2 col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-4 col-xs-offset-2">
				<div class="form-group" style="padding-bottom: 5px">					
					{!!Form::date('Fecha', \Carbon\Carbon::now(),['id'=>'Fecha' , 'class' => 'form-control' ]);!!}
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				{!!Form::select('Jornada',['Mañana'=>'Mañana' , 'Tarde'=>'Tarde'],null,['class'=>'form-control' , 'id'=>'Jornada','placeholder'=>'Ingrese jornada'])!!}
			</div>
		</div>

		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				{!!Form::select('Corrales',$input,null,['class'=>'form-control' , 'id'=>'Corrales','onchange'=>'promedio.consulta()','placeholder'=>'Ingrese el corral'])!!}

			</div>
		</div>
	</div>
	<br>
	<br>
	{!!Form::open(['id'=>'frmTabla'])!!}
		<div class="form row" style="display: none" id="Divpromedio">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">

					<table  class="table table-responsive table-bordered table-striped" id="Tblpromedio">
						<thead>
							<tr>
								<th>Codigo</th>
								<th>Animal</th>
								<th>Cantidad de leche</th>
							</tr>
						</thead>
						<tbody id = "tbl_promedio">

						</tbody>
					</table>
					<label id = "lblTotal" for="">Total: <span id="to"></span></label>
				</div>
			</div>
		</div>	
	{!!Form::close()!!}
</div>
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






@section('script')

<script>
	



	$("#Jornada").select2();
	$("#Corrales").select2();

	var acumulador = {
		calcular:function(){
			
			var suma = 0;
				$('#tbl_promedio tr').each(function(i, e){ //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas
					var td = $(e).find('td').eq(2);
 				suma += parseInt($(td).find("input").eq(0).val()||0,10) //numero de la celda 3
 			})

				$("#to").text(suma);
				
			}
		}

		

		promedio.guardar();









	</script>

	@endsection