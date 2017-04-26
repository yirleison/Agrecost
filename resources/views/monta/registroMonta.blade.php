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
{!!Form::open(array('url'=>'Monta','method'=>'post','autocomplete'=>'off'))!!}
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
			<h3 id="Encabezado_del_formulario">REGISTRO DE MONTA</h3>
		</div>
	</div>
	<!-- Division izquierda del formulario -->
	<div class="form row">
		<div class="col-lg-4 col-lg-offset-2 col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-10 col-xs-offset-1">
			<div class="form-group">
				<select onchange="Mostrar()" class="form-control" id="sltTipo" name="Tipo" >
					<option value="" selected="" >--- Seleccione el Tipo de Monta ---</option>
					<option value="Natural">Natural</option>
					<option value="Inseminacion">Inseminacion</option>
					<option value="Prestamo">Prestamo</option>
				</select>
			</div>
		</div>
	</div>
	<div class="form row">
		<div class="col-lg-4 col-lg-offset-2 col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-10 col-xs-offset-1">
			<div class="form-group">
				<div class="input-group">
					<input autofocus="" onfocus="(txtFecha.type='text')" readonly="" type="text" id="txtToro" name="Toro" class="form-control" placeholder="Seleccione Toro para Monta:">
					<span class="input-group-btn">
						<button id="btn_modal" type="button" class="btn btn-success">seleccione</button>
					</span>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<input type="text" id="txtVaca" readonly="" name="Vaca" class="form-control" placeholder="Seleccione Vaca para Monta:">
					<span class="input-group-btn">
						<button id="btn_modal2" type="button" class="btn btn-success">seleccione</button>
					</span>
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<input type="number" id="txtPeso" name="Peso" class="form-control" placeholder="Ingrese Peso Vaca:">
					<p class="input-group-addon ">Kg</p>
				</div>
			</div>
		</div>
		<!-- Division derecha del formulario -->
		<div class="col-lg-4 col-md-4 col-md-offset-0 col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1">
			<div class="form-group">
				<input autofocus="" type="date" onblur="(this.type='text')" onfocus="(this.type='date')" id="txtFecha" name="Fecha" class="form-control" placeholder="Fecha de Monta:">
			</div>
			<div class="form-group">
				<input type="text" id="txtValor" name="Valor" class="form-control" placeholder="Ingrese Costo Monta $:">
			</div>
			<div class="form-group">
				<div class="input-group">
					<label for="txtEstado" class="input-group-addon">Estado:</label>
					<input type="text" class="form-control" readonly="readonly" name="Estado" id="txtEstado" value="Efectiva">
				</div>
			</div>
		</div>
	</div>
	<div class="form row">
		<div class="col-lg-8 col-lg-offset-2 col-md-4 col-md-offset-2 col-sm-4 col-sm-offset-2 col-xs-10 col-xs-offset-1">
			<div class="form-group">
				<label for="txtObservaciones">Observaciones:</label>
				<textarea placeholder="Observaciones:" class="form-control" name="Observaciones" id="txtObservaciones" cols="10" rows="5"></textarea>	
			</div>
		</div>
	</div>
	<br>
	<!-- Botones del formulario -->
	<div class="form row">
		<div class="col-lg-2 col-lg-offset-4 col-md-2 col-md-offset-4 col-sm-2 col-sm-offset-3 col-xs-5 col-xs-offset-1">
			<button type="submit" onclick="Enviar()" id="btnGuardar" name="Registro" class="btn btn-success"><img src="/librerias/Imagenes/Iconos/guardar.png" /> Guardar</button>	
		</div>
		<div class="col-lg-1 col-md-1 col-md-offset-0 col-sm-1 col-sm-offset-1 col-xs-5">
			<button type="reset" id="btnCancelar" class="btn btn-warning"><img src="/librerias/Imagenes/Iconos/limpiar.png" /> Limpiar</button>
		</div>
	</div>
</div>
{!!Form::close()!!}
<div class="row">
	<div class="col-md-12">
		<div class="modal fade" id="mod_crear" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content col-md-10 col-md-offset-2">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel"><img src="/librerias/Imagenes/Iconos/vaca_modal.png" alt=""> Seleccion Toro</h4>
					</div>
					<div class="modal-body">
						<div class="row table-responsive">			
							<table id="Tabla-animales" class="table table-bordered table-condensed table-hover">
								<thead>
									<tr>
										<th>Codigo</th>
										<th>Nombre</th>
										<th>Chapeta</th>
										<th>Raza</th>	
										<th>Estado</th>
										<th>Acciones</th>
									</tr>
								</thead>
								<tbody>

								</tbody>
							</table>
						</div>	
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					</div>	
				</div>				
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
	var tabla=null;
	function Tabla(ruta) {
		tabla=$('#Tabla-animales').DataTable({
			processing: true,
			serverSide: true,
			ajax: ruta,
			columns: [		
			{data: 'Codigo', name: 'animal.Codigo'},
			{data: 'Nombre', name: 'animal.Nombre'},
			{data: 'Marcado', name: 'animal.Marcado'},
		// data es como lo devuelve el datatable name es como se llama en base de datos
		{data: 'raza', name: 'raza.Nombre'},
		{data: 'estado', name: 'estado_animal.Nombre'},
		{data: 'action', name: 'action', orderable: false, searchable: false}
		],
		'language': traduccion
	});
		tabla.destroy();
	};
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

	$('#btn_modal').click(function () 
	{
		var ruta='/Monta/ConsultaToro/';
		$(Tabla(ruta));
		$('#mod_crear').modal();
	});
	$('#btn_modal2').click(function () 
	{
		var ruta='/Monta/ConsultaVaca/';
		$(Tabla(ruta));
		$('#mod_crear').modal();
	});

	function seleccionVaca(ID) {
		$('#txtVaca').val(ID);
		$('#mod_crear').modal('toggle');
	}

	function seleccionToro(ID) {
		$('#txtToro').val(ID);
		$('#mod_crear').modal('toggle');
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