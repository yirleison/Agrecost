@extends("layouts.app")

@section('contenedor')
<!-- Cuerpo del formulario, aca deben ir todos los input y demas elementos -->
{!!Form::open(array('url'=>'Monta','method'=>'get', 'id'=>'form_data', 'autocomplete'=>'off'))!!}
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
			<h3 id="Encabezado_del_formulario">LISTADO DE MONTAS</h3>
		</div>
	</div>
	<!-- Tabla del formulario -->
	<div class="form row table-responsive">
		
		<div class="col-md-10 col-md-offset-1">
			<table id="Tabla_montas" class="table table-bordered table-condensed table-hover">
				<thead>
					<tr>
						<th>Codigo</th>
						<th>Toro</th>
						<th>Vaca</th>
						<th>Tipo</th>						
						<th>Fecha Monta</th>
						<th>Estado</th>						
						<th>Observaciones</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>	
</div>

{!!Form::close()!!}

<div class="row">
	<div class="col-md-12">
		<div class="modal fade" id="mod_actualiz" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
						<h4 class="modal-title" id="myModalLabel"><img src="/librerias/Imagenes/Iconos/monta_modal.png" alt=""> Modificar Monta</h4>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label for="sltTipo">Tipo:</label>
									<select onchange="Mostrar()" class="form-control" id="sltTipo" name="Tipo" >
										<option value="" selected="" >--- Seleccione el Tipo de Monta ---</option>
										<option value="Natural">Natural</option>
										<option value="Inseminacion">Inseminacion</option>
										<option value="Prestamo">Prestamo</option>
									</select>
								</div>
								<div class="form-group">
									<label for="txtToro">Toro:</label>
									<input type="text" id="txtToro" name="Toro" class="form-control" readonly="">
								</div>
								<div class="form-group">
									<label for="txtVaca">Vaca:</label>
									<input type="text" id="txtVaca" name="Vaca" class="form-control" readonly="">
								</div>
								<div class="form-group">
									<label for="txtPeso">Peso de la Vaca:</label>
									<div class="input-group">
										<input type="number" id="txtPeso" name="Peso" class="form-control" placeholder="Ingrese Peso Vaca:">
										<p class="input-group-addon ">Kg</p>
									</div>
								</div>
								<div class="form-group">
									<div class="form-group">
										<label for="txtObservaciones">Observaciones:</label>
										<textarea placeholder="Observaciones:" class="form-control" name="Observaciones" id="txtObservaciones" cols="10" rows="1"></textarea>	
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="form-group">
									<label for="txtFecha">Fecha Monta:</label>
									<input autofocus="" type="date" onblur="(this.type='text')" onfocus="(this.type='date')" id="txtFecha" name="Fecha" class="form-control" placeholder="Fecha de Monta:">
								</div>
								<div class="form-group">
									<label for="txtFecha_palp">Fecha Palpada:</label>
									<input id="txtFecha_palp" name="Fecha_palp" class="form-control" readonly="">
								</div>
								<div class="form-group">
									<label for="txtFecha_sec">Fecha Secada:</label>
									<input id="txtFecha_sec" name="Fecha_sec" class="form-control" readonly="">
								</div>
								<div class="form-group">
									<label for="txtValor">Valor:</label>
									<input type="text" id="txtValor" name="Valor" class="form-control" placeholder="Ingrese Costo Monta $:">
								</div>
								<div class="form-group">
									<label for="sltEstado">Estado:</label>
									<select class="form-control" id="sltEstado" name="Estado" >
										<option value="" selected="" >--- Seleccione el Estado de Monta ---</option>
										<option value="Efectiva">Efectiva</option>
										<option value="No efectiva">No efectiva</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button id="btn_actualizar" onclick="actualizar_monta()" type="" class="btn btn-success"><img src="/librerias/Imagenes/Iconos/actualizar.png" alt=""> Actualizar</button>
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
	tabla = $('#Tabla_montas').DataTable({
		processing: true,
		serverSide: true,
		ajax: '/Monta/Consulta',
		columns: [		
		{data: 'Codigo', name: 'monta.Codigo'},
		{data: 'toro', name: 'toro'},
		{data: 'vaca', name: 'vaca'},
		// data es como lo devuelve el datatable name es como se llama en base de datos
		{data: 'Tipo', name: 'monta.Tipo'},
		{data: 'Fecha_monta', name: 'monta.Fecha_monta'},
		{data: 'Estado', name: 'monta.Estado'},
		{data: 'Observaciones', name: 'monta.Observaciones'},
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
			url: '/Monta/Editar/'+ID,
			type: 'get',
			dataType: 'json'
		}).done(function(datos){
			// con la variable datos se capturan los datos de la tabla y estos se envian para cargar los input
			console.log(datos);
			$('#sltTipo').val(datos.Tipo);
			$('#txtToro').val(datos.toro);
			$('#txtVaca').val(datos.vaca);
			$('#txtPeso').val(datos.peso);
			$('#txtObservaciones').val(datos.Observaciones);
			$('#txtFecha').val(datos.Fecha_monta);
			$('#txtFecha_palp').val(datos.Fecha_palpada);
			$('#txtFecha_sec').val(datos.Fecha_secada);
			$('#txtValor').val(datos.Valor);
			$('#sltEstado').val(datos.Estado);
			id_animal=datos.Codigo;
		});

		$('#mod_actualiz').modal();
	}
	function Mostrar()
	{
		if(sltTipo.value == 'Natural')
		{
			document.getElementById('txtValor').disabled=true;
			document.getElementById('txtValor').value=0;
		}
		else 
		{
			document.getElementById('txtValor').disabled=false;
			document.getElementById('txtValor').value="";
		}
	}
	function Enviar()
	{
		document.getElementById('txtValor').disabled=false;
	}

</script>
@endsection