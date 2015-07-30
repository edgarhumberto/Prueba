@extends('layouts.master')
 
@section('sidebar')
     @parent
     Formulario de Negocio
@stop
 
@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="clearfix btn-block">
        	{{ HTML::link('negocios', 'Regresar a Negocios', array('class' => 'btn btn-default pull-left')); }}
        	<div class="pull-right">
        		{{ HTML::link('categoriasNegocios/create', 'Agregar Categoria', array('class' => 'btn btn-default pull-left')); }}	
        	</div>
		</div>
	</div>
</div>


<div class="panel panel-success panel-custom">
	<div class="panel-heading">
		<h3 class="panel-title">Categorias de Negocio</h3>
	</div>
	<div class="panel-body">
		<table class="table table-hover">
			<tr>
				<th>Nombre</th>
				<th>Descripcion</th>
				<th>Icono</th>
			</tr>
			<tbody>
				@foreach($categories as $category)
					<tr>
						<td>{{ HTML::link(route('categoriasNegocios.show', array($category->id)), $category->nombre) }}</td>
						<td>{{ HTML::link(route('categoriasNegocios.show', array($category->id)), $category->descripcion) }}</td>
						<td>@if(!empty($category->icono_emblema)) {{ HTML::image('img/emblemas/categorias/'.$category->icono_emblema, 'a picture', array('class' => 'thumb icono-emblema')) }} @endif</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<div class="row">
	<div class="pull-right">
		{{ $categories->links(); }}
	</div>
</div>
@stop
