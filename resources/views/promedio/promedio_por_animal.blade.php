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
				{!!Form::select('Animal',$ani, null,['class'=>'form-control' , 'id'=>'Animal','placeholder'=>'Seleccione el animal','onchange'=>'cargar(this)'])!!}

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


				<div class="col-md-2 col-xs-2 col-lg-2 col-sm-2">
					<label id="lblTotal" for="">Total</label>					
					<input readonly type="text" id="total" name="total" class="form-control">
				</div>

			</div>
		</div>
	</div>
</div>
{{-- {!!Form::close()!!} --}}





<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
	<div class="menu_section">
		<ul class="nav side-menu">
			<li><a><img src="/librerias/Imagenes/Iconos/inicio.png" alt=""> Inicio </a>
			</li>
			<li><a><img src="/librerias/Imagenes/Iconos/vaca.png" alt=""> Animales <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="#">Registro Animal</a></li>
					<li><a href="">Consulta Animal</a></li>

					<li><a href="{{url('promedioleche/poranimal')}}">Promedio produccion por animal</a></li>

				</ul>
			</li>
			<li><a><img src="/librerias/Imagenes/Iconos/vaca.png" alt=""> Ventas <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="{{url('ventaAnimal')}}">Venta Animal</a></li>
					<li><a href="{{url('ventaAnimal/listar')}}">Consultar venta</a></li>
				</ul>
			</li>
			<li><a><img src="/librerias/Imagenes/Iconos/corral.png" alt=""> Corrales <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="corrales">Registro Corrales</a></li>
					<li><a href="consultar/corrales">Consultar Corral</a></li>
				</ul>
			</li>
			<li><a><img src="/librerias/Imagenes/Iconos/leche.png" alt=""> Tanques <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="{{route('tanques')}}">Registro Tanques</a></li>
					<li><a href="{{route('listar-tanques')}}">Consultar Tanque</a></li>
				</ul>
			</li>
			<li><a><img src="/librerias/Imagenes/Iconos/leche.png" alt=""> Produccion <span class="fa fa-chevron-down"></span></a>
				<ul class="nav child_menu">
					<li><a href="/movimiento">Movimiento</a></li>
					<li><a href="/consultar/movimiento">Consultar movimientos</a></li>
					<li><a href="{{url('promedioleche')}}">Produccion animal</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<div class="menu_section">
	</div>
</div>








@endsection




@section('scripts')
<script>


	$("#Animal").select2();

	var tabla =  $('#tblPorAnimal').DataTable({
		"order":[0,'desc'],
		processing: true,
		serverSide: true,
		paging:false,
		ajax: '/promedioleche/tablaPorAnimal/0',
		columns: [
		{ data: 'Fecha', name: 'Fecha' },
		{ data: 'Cantidad_leche', name: 'Cantidad_leche' },

		],
		'language': traduccion
		
	});
	var traduccion = {
		"sProcessing":     "Procesando...",
		"sLengthMenu":     "Mostrar _MENU_ registros",
		"sZeroRecords":    "No se encontraron resultados",
		"sEmptyTable":     "Ningún dato disponible en esta tabla",
		"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix":    "",
		"sSearch":         "Buscar:",
		"sUrl":            "",
		"sInfoThousands":  ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}
	};

	function cargar(data){
		let id=$(data).val();
		tabla.ajax.url('/promedioleche/tablaPorAnimal/'+id).load();

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			url: '/promedioleche/marcado/'+id,
			type: 'get',
			dataType:'json'		
		}).done(function(mar){
			console.log(mar);
			$("#Marcado").val(mar.Marcado);
		});

	}




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