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
					<img class="img img-responsive  img-circle" src="/librerias/Imagenes/venta.jpg">
				</div>
			</div>
		</div>
	</div>
	<div class="form row" >
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<!-- Titulo central -->
			<h3 id="Encabezado_del_formulario">REGISTRO DE VENTAS</h3>
		</div>
	</div>
	<!-- Division izquierda del formulario -->
	{!!Form::open(['url'=>'ventaAnimal/guardar','method'=>'post' , 'id'=>'frmRegister'])!!}	
	<div class="form row">
		<div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4 col-xs-10 col-xs-offset-2 " style="padding-bottom: 10px">
			<div class="form-group" style="padding-bottom: 5px">
				{!!Form::text('Codigo_animal',null,['class'=>'form-control' , 'id'=>'Codigo_animal','style'=>'visibility:hidden;'])!!}
			</div>
			<div class="form-group" style="padding-bottom: 5px">
				<div class="input-group">
					{!!Form::text('Animal',null,['class'=>'form-control' , 'id'=>'Animal','placeholder'=>'Inserte el animal','readonly'=>''])!!}
					<span class="input-group-btn"><input type="button" id="btn" class="btn btn-primary" value=" Animal"></span>
				</div>
			</div>
			<div id="Animal_validate">
				
			</div>
			{!!Form::date('Fecha_venta', \Carbon\Carbon::now(),['id'=>'Fecha_venta' , 'class' => 'form-control' ]);!!}
			{{-- <div class="input-group date" id="date" style="padding-bottom: 20px">

				<input type="text" id="Fecha_venta" name="Fecha_venta" placeholder="Ingrese fecha de la venta" class="form-control"><span class="input-group-addon">
				<i class="glyphicon glyphicon-th"></i></span>
			</div> --}}
			<div class="form-group" style="padding-top: 20px">
				{!!Form::number('Valor',null,['class'=>'form-control' , 'id'=>'Valor','placeholder'=>'Ingrese el valor de la venta'])!!}
			</div>
		</div>
	</div>
	<br>
	<!-- Botones del formulario -->
	<div class="form row">
		<div class="col-lg-2 col-lg-offset-4 col-md-2 col-md-offset-4 col-sm-2 col-sm-offset-3 col-xs-5 col-xs-offset-1">


			<button type="submit" id="btnGuardar" onclick="" class="btn btn-success"><img src="/librerias/Imagenes/Iconos/guardar.png" /> Guardar</button>	
		</div>
		<div class="col-lg-1 col-md-1 col-md-offset-0 col-sm-1 col-sm-offset-1 col-xs-5">
			<button type="reset" id="btnCancelar" class="btn btn-warning"><img src="/librerias/Imagenes/Iconos/limpiar.png" /> Limpiar</button>
		</div>
	</div>
</div>
{!!Form::close()!!}


{{-- Modal para traer animales --}}


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="modal fade" id="mod_animal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content col-xs-12 col-xs-offset-2 col-sm-12 col-sm-offset-2 col-md-12 col-md-offset-2 col-lg-12 col-lg-offset-2">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel"><i class="fa fa-user" aria-hidden="true"></i> Seleccione el animal</h4>
					</div>
					<div class="modal-body">            

						<table id="tabla_venta" class="table table-bordered table-responsive table-bordered">
							<thead>
								<tr>
									<th>Marcado</th> 
									<th>Nombre</th> 
									<th>Fecha nacimiento</th> 
									<th>Sexo</th> 
									<th>Peso</th> 
									<th>Raza</th> 
									<th>Estado</th> 
									<th>Opciones</th> 									
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>
						


						<div id="area-example"></div>
						<div class="modal-footer">
							{!!Form::button('Enviar',['class'=>'btn btn-success', 'onclick'=>''])!!}	
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>






	@endsection

	@section('scripts')
	<script>    
		// ventas.editar_ventas();
		ventas.table_venta();
		


		$("#frmRegister").validate({

			rules : {
				Fecha_venta:{
					required:true,
					date: true
				},

				Valor:{
					required:true,
				},
				Animal:{
					required:true,
				}, 
				errorPlacement: function (error, element) {
					var name = $(element).attr("name");
					error.appendTo($("#" + name + "_validate"));
				},
				
			}

		});

		$('#date').datepicker({
			language: "es",
			autoclose: true,
			format: "yyyy-mm-dd"
		});


		$("#btn").click(function(){

			$("#mod_animal").modal();

		})

		$("#animal_modal").select2();

		
	</script>


	@endsection