@extends("layouts.app")

@section('contenedor')
<!-- Cuerpo del formulario, aca deben ir todos los input y demas elementos -->
{!!Form::open(array('url'=>'Animal','method'=>'get', 'id'=>'form_data', 'autocomplete'=>'off'))!!}
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
			<h3 id="Encabezado_del_formulario">LISTADO DE ANIMALES</h3>
		</div>
	</div>
	<!-- Tabla del formulario -->
	<div class="form row table-responsive">
		
		<div class="col-md-10 col-md-offset-1">
			<table id="Tabla-animales" class="table table-bordered table-condensed table-hover">
				<thead>
					<tr>
						<th>Codigo</th>
						<th>Nombre</th>
						<th>Chapeta</th>
						<th>Raza</th>						
						<th>Fecha Nacimiento</th>
						<th>Sexo</th>
						<th>Estado</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
			<div class="block">
				<button type="button" onclick="inactivar_animal()" class="btn btn-danger" data-dismiss="modal"><img src="/librerias/Imagenes/Iconos/block.png" alt=""> Inactivar</button>
			</div>
		</div>
		
	</div>	
</div>

{!!Form::close()!!}
<!-- Modal para Modificar Animal -->
<div class="row">
	<div class="col-md-12">
		<div class="modal fade" id="mod_actualiz" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
						<h4 class="modal-title" id="myModalLabel"><img src="/librerias/Imagenes/Iconos/vaca_modal.png" alt=""> Modificar Animal</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label for="txtNombre">Nombre:</label>
									<input type="text" id="txtNombre" name="Nombre" class="form-control" placeholder="Ingrese Nombre:">
								</div>
								<div class="form-group">
									<label for="txtMarcado">Marcado:</label>
									<input type="text" id="txtMarcado" name="Marcado" class="form-control" placeholder="Ingrese Numero de Chapeta:">
								</div>
								<div class="form-group">
									<label for="sltRaza">Raza:</label>
									<select class="form-control" name="Raza" id="sltRaza">
										<option value="" selected="" >--- Seleccione Raza ---</option>
										@foreach($Raza as $raza)
										<option value="{{$raza->Codigo}}">{{$raza->Nombre}}</option>
										@endforeach
									</select>
								</div>
								<div class="form-group">
									<label for="sltSexo">Sexo:</label>
									<select class="form-control" id="sltSexo" name="Sexo" >
										<option value="" selected="" >--- Seleccione Sexo ---</option>
										<option value="Masculino">Masculino</option>
										<option value="Femenino">Femenino</option>
									</select>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label for="txtFecha">Fecha:</label>
									<input type="date" id="txtFecha" name="Fecha" class="form-control" placeholder="Fecha de nacimiento">
								</div>
								<div class="form-group">
									<label for="txtPeso">Peso:</label>
									<div class="input-group">
										<input type="number" id="txtPeso" name="Peso" class="form-control" placeholder="Ingrese Peso:">
										<p class="input-group-addon ">Kg</p>
									</div>
								</div>
								<div class="form-group">
									<label for="sltEstado">Estado:</label>
									<select class="form-control" name="Estado" id="sltEstado">
										<option value="" selected="" >--- Seleccione Estado ---</option>
										@foreach($Estado as $estado)
										{<option value="{{$estado->Codigo}}">{{$estado->Nombre}}</option>}
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button id="btn_actualizar" onclick="actualizar_animal()" type="" class="btn btn-success"><img src="/librerias/Imagenes/Iconos/actualizar.png" alt=""> Actualizar</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal"><img src="/librerias/Imagenes/Iconos/cerrar.png" alt=""> Cerrar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection<!-- Cuerpo del formulario, aca deben ir todos los input y demas elementos -->

@section('scripts')
<script type="text/javascript">
	var tabla= null;
// Funcion para cambiar el idioma de la Tabla
$(function () {
	tabla = $('#Tabla-animales').DataTable({
		processing: true,
		serverSide: true,
		ajax: '/Animal/Consulta',
		columns: [		
		{data: 'Codigo', name: 'animal.Codigo'},
		{data: 'Nombre', name: 'animal.Nombre'},
		{data: 'Marcado', name: 'animal.Marcado'},
		// data es como lo devuelve el datatable name es como se llama en base de datos
		{data: 'raza', name: 'raza.Nombre'},
		{data: 'Fecha_nacimiento', name: 'animal.Fecha_nacimiento'},
		{data: 'Sexo', name: 'animal.Sexo'},
		{data: 'estado', name: 'estado_animal.Nombre'},
		{data: 'action', name: 'action', orderable: false, searchable: false}
		],
		'language': traduccion
	});
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

var id_animal = 0;

// funcion para motrar los datos en el modal
function editar(ID) {
		// Obligatorio en todos los formularios
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});

		$.ajax({
			// Debe crearse la ruta la cual nos pinta los datos
			url: '/Animal/Editar/'+ID,
			type: 'get',
			dataType: 'json'
		}).done(function(datos){
			// con la variable datos se capturan los datos de la tabla y estos se envian para cargar los input
			$('#txtNombre').val(datos.Nombre);
			$('#txtMarcado').val(datos.Marcado);
			$('#sltRaza').val(datos.Codigo_raza);
			$('#sltSexo').val(datos.Sexo);
			$('#txtFecha').val(datos.Fecha_nacimiento);
			$('#txtPeso').val(datos.Peso);
			$('#sltEstado').val(datos.Codigo_estado);
			id_animal=datos.Codigo;
		});

		$('#mod_actualiz').modal();
	}

	// funcion para actualizar en base de datos 
	function actualizar_animal(){

		datos = {
				// nombre: es el nombre con el que vamos a enviar el dato capturado del id al cual pertenezca el dato
				chapeta: $('#txtMarcado').val(),
				nombre: $('#txtNombre').val(),				
				fecha_nacimiento: $('#txtFecha').val(),
				sexo: $('#sltSexo').val(),
				peso: $('#txtPeso').val(),
				estado: $('#sltEstado').val(),
				raza: $('#sltRaza').val(),
			};
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});
			$.ajax({
				url: '/Animal/'+id_animal,
				type: 'put',
				data: datos,
				dataType: 'json'
			}).done(function(mensaje)
			{
				tabla.ajax.reload();
				$('#mod_actualiz').modal('toggle');
				new PNotify({
					title: 'Actualizar Animal',
					text: 'Los Cambios Fueron Realizados Con Exito',
					type: 'success'
				});
			});
		}

		function inactivar_animal(){
			var formElement = document.getElementById("form_data");
			formData = new FormData(formElement);
			
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
				}
			});
			$.ajax({
				url: '/Animal/Inactivar/',
				type: 'post',
				data: formData,
				dataType: 'json',
				processData: false,  
				contentType: false,
			}).done(function(mensaje)
			{
				tabla.ajax.reload();
				new PNotify({
					title: 'Inactivar Animal',
					text: 'Los Cambios Fueron Realizados Con Exito',
					type: 'info'
				});
			});

		}

	</script>
	@endsection