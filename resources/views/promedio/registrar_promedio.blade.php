@extends('layouts.app')



@section('contenedor')

<link rel="stylesheet" href="/librerias/css/Estilo.css">
<link rel="stylesheet" href="/librerias/css/EstiloCel.css">




<div id="formulario"  class="row">
	{!!Form::open(['id'=>'frmTabla'])!!}

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
	<div class="form row">		
		<div class="row">			
			<div class="col-lg-4 col-lg-offset-2 col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-4 col-xs-offset-2">
				<div class="form-group" style="padding-bottom: 5px">					
					{!!Form::date('Fecha', \Carbon\Carbon::now(),['id'=>'Fecha' , 'class' => 'form-control' ]);!!}
				</div>
			</div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				<div class="form-group" style="padding-bottom: 5px">
					{!!Form::select('Jornada',[''=>'Ingrese la jornada','Mañana'=>'Mañana' , 'Tarde'=>'Tarde'],null,['class'=>'form-control' , 'id'=>'Jornada'])!!}
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4 col-md-offset-4 col-xs-4 col-xs-offset-4 col-sm-4 col-sm-offset-4 col-lg-4 col-lg-offset-4">
				{!!Form::select('Corrales',$input,null,['class'=>'form-control' , 'id'=>'Corrales','onchange'=>'promedio.consulta()','placeholder'=>'Ingrese el corral'])!!}

			</div>
		</div>
	</div>
	<br>
	<br>
	<div class="form row" style="display: none" id="Divpromedio">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 col-xs-8 col-xs-offset-2 col-sm-8 col-sm-offset-2 col-lg-8 col-lg-offset-2">

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

				<div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
					<label id="lblTotal" for="">Total</label>					
					<input readonly type="text" id="total" name="total" class="form-control">
				</div>

			</div>
		</div>
	</div>	
</div>

<br>

<div id="fondoModalCalculadora">
	<div id="modalCalculadora">
		<i id="cerrarCalculadora" class="fa fa-times"></i>

		<div id="calculadora">	

			<input id="pantalla" type="text">

			<div id="numeros">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<div class="num" numero="1">1</div>
				</div> 
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<div class="num" numero="2">2</div>
				</div> 
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<div class="num" numero="3">3</div>
				</div> 
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<div class="num" numero="4">4</div>
				</div> 
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<div class="num" numero="5">5</div>
				</div> 
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<div class="num" numero="6">6</div>
				</div> 
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<div class="num" numero="7">7</div>
				</div> 
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<div class="num" numero="8">8</div>
				</div> 
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<div class="num" numero="9">9</div>
				</div> 
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<div class="num" numero="" id="borrar">Borrar</div>
				</div> 
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<div class="num" numero="0">0</div>
				</div> 
			</div>

		</div>

	</div>
</div>

{!!Form::close()!!}


<div class="form row">
	<div class="col-lg-2 col-lg-offset-4 col-md-2 col-md-offset-4 col-sm-2 col-sm-offset-3 col-xs-5 col-xs-offset-1">


		<button  id="btnGuardar" onclick="promedio.guardar()" class="btn btn-success"><img src="/librerias/Imagenes/Iconos/guardar.png" /> Guardar</button>	
	</div>
	<div class="col-lg-1 col-md-1 col-md-offset-0 col-sm-1 col-sm-offset-1 col-xs-5">
		<button type="reset" id="btnCancelar" class="btn btn-warning"><img src="/librerias/Imagenes/Iconos/limpiar.png" /> Limpiar</button>

	</div>
</div>

@endsection






@section('scripts')

<script>



	$("#btnGuardar").click(function() {
		if ($("#Corrales").val() =="" || $("#Jornada").val()=="") {
			new PNotify({
				title: 'Campos vacios',
				text: 'Por favor completa los campos',
				type:'error'
			});
			return false;
		}else{
			var fd = new FormData(document.getElementById("frmTabla"));
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: "promedioleche",
				type: "POST",
				data: fd,
 			processData: false,  // tell jQuery not to process the data  				
  			contentType: false   // tell jQuery not to set contentType
  		}).done(function(success){  			
  			new PNotify({
  				title: 'Noticia',
  				text: 'Se guardo correctamente',
  				type:'success'
  			});  			

  		});
  	}

  });	


		// ocultar campos al cargar por completo la pagina
		$(function(){
			$("#total").hide();
			$("#lblTotal").hide();	
		});		
		// fin del ocultar


		$("#Jornada").select2();
		$("#Corrales").select2();

		// Function para poder sumar el total de leche debajo de la tabla
		var acumulador = {
			calcular:function(){

				var suma = 0;
				$('#tbl_promedio tr').each(function(i, e){ //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas
					var td = $(e).find('td').eq(2);
 				suma += parseInt($(td).find("input").eq(0).val()||0,10) //numero de la celda 3
 			})
				$("#total").val(suma);
				$("#total").show();
				$("#lblTotal").show();				
			}
		}
		// Fin de la funcion

		// Funcion para vaciar campo de texto del teclado numerico
		function vaciar(){
			$(".tel").val("");
		}
		// Fin de la funcion
	</script>

	@endsection