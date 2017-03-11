@extends("layout.app")

@section('contenedor')
<div class="row">
	<div class="col-md-8">
		<h3>Listado Animales</h3>
		@include('Animal.ListarAnimales')	
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Marcado</th>
					<th>Nombre</th>
					<th>Fecha Nacimiento</th>
					<th>Sexo</th>
					<th>Peso</th>
					<th>Estado</th>
					<th>Raza</th>
				</thead>
				@foreach($Nombre as $ani)
				<tr>
					<td>{{$ani->Nombre}}</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
@endsection