@extends('layouts.app')


@section('contenedor')
<table class="table table-bordered table-responsive table-striped" id="tblVenta">
	<thead>
		<tr>
			<th>Animal</th>
			<th>Fecha de venta</th>
			<th>Valor</th>			
			<th>Opciones</th>
		</tr>
	</thead>
	<tbody>
		
	</tbody>
</table>




<div class="row">
	<div class="col-md-12">
		<div class="modal fade" id="mod_ventas" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content col-md-10 col-md-offset-3">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<h3 class="modal-title" id="myModalLabel"><i class="fa fa-handshake-o" aria-hidden="true"></i> Vista en detalle de la venta</h3>

					</div>
					<div class="modal-body"> 
						<div class="form-group" style="padding-bottom: 5px">
							{!!Form::text('Codigo',null,['class'=>'form-control' , 'id'=>'Codigo','style'=>'visibility:hidden;'])!!}
						</div>  
						<div class="form-group">							
							<div class="row">
								<div class="col-md-6 col-md-offset-3">
									<label for="">Nombre del animal</label>	
									{!!Form::text('Nombre',null,['class'=>'form-control' ,'id'=>'Nombre' , 'readonly'])!!}
								</div>
							</div>
						</div>         
						<div class="form-group">	
							<div class="row">
								<div class="col-md-6 col-md-offset-3">
									<label for="">Fecha de venta</label>								
									<div class="input-group date" id="date" style="padding-top: 10px ">
										<input type="text" id="Fecha_venta" name="Fecha_venta" placeholder="fecha de la venta" class="form-control"><span class="input-group-addon">
										<i class="glyphicon glyphicon-th"></i></span>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="row">
								<div class="col-md-6 col-md-offset-3">
									<label for="">Valor de la venta</label>
									{!!Form::number('Valor',null,['class'=>'form-control' ,'id'=>'Valor'])!!}
								</div>
							</div>
						</div>
						<br>
						<br>
						<br>
						<div class="row">
							<div class="col-md-4 col-md-offset-1">
								<h3>Datos del animal</h3>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group">
								<div class="col-md-4 col-md-offset-1">
									<label for="">Marcado</label>									
									{!!Form::number('Marcado',null,['class'=>'form-control' ,'id'=>'Marcado' ,'readonly'])!!}
								</div>	
								<div class="col-md-4 col-md-offset-1">
									<label for="">Peso</label>	
									<div class="input-group">
										{!!Form::number('Peso',null,['class'=>'form-control' ,'id'=>'Peso' , 'readonly'])!!}
										<span class="input-group-addon"><i>KG</i></span>
									</div>
								</div>
							</div>
						</div>
						<br>
						<div class="row">
							<div class="form-group">
								<div class="col-md-4 col-md-offset-1">
									<label for="">Sexo</label>									
									{!!Form::text('Sexo',null,['class'=>'form-control' ,'id'=>'Sexo' ,'readonly'])!!}
								</div>								
								<div class="col-md-4 col-md-offset-1">
									<label for="">Fecha de nacimiento</label>
									<div class="input-group" id="date">
										<input type="text" id="Fecha_nacimiento" name="Fecha_nacimiento" class="form-control" readonly="">
										<span class="input-group-addon">
										<i class="glyphicon glyphicon-th"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group">															
								<div class="col-md-4 col-md-offset-1">
									<label for="">Raza</label>	
									{!!Form::text('raza',null,['class'=>'form-control' ,'id'=>'raza' , 'readonly'])!!}
								</div>
							</div>	
						</div>
						<br>

						<div id="area-example"></div>
						<div class="modal-footer">
							{!!Form::button('Actualizar',['class'=>'btn btn-success', 'onclick'=>'ventas.actualizar_venta();'])!!}  
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
							

							<button type="button" class="btn btn-info"  onclick="window.location='{{ url("/ventaAnimal/pdf") }}'">Generar en PDF</button>


						</div>
					</div>
				</div>
			</div>
		</div>
	</div> 




	<div class="row">
	<div class="col-md-12">
		<div class="modal fade" id="mod_animal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
			<div class="modal-dialog modal-lg">
				<div class="modal-content col-md-10 col-md-offset-2">

					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
						<h4 class="modal-title" id="myModalLabel"><i class="fa fa-user" aria-hidden="true"></i> Seleccione el animal</h4>
					</div>
					<div class="modal-body">            

						<table id="tabla_venta" class="table table-bordered table-responsive table-hover table-bordered">
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
		ventas.listar_ventas()	

		$('#date').datepicker({
			language: "es",
			autoclose: true,
			format: "yyyy-mm-dd"
		});

	</script>


	@endsection