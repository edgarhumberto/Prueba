@extends('layouts.master')
 
@section('sidebar')
     @parent
     Formulario de Negocio
@stop
 
@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="clearfix btn-block">
        	{{ HTML::link(route('categoriasQpones.show', array($categoria->id)), 'Regresar a detalle', array('class' => 'btn btn-default pull-left')); }}
		</div>
	</div>
</div>

{{ Form::model($categoria, array('route' => array('categoriasQpones.update', $categoria->id), 'class' => 'form-horizontal', 'files' => true, 'method' => 'PUT')) }}

<div class="panel panel-success panel-custom">
	<div class="panel-heading">
		<h3 class="panel-title">Ingresar nueva categoria</h3>
	</div>
	<div class="panel-body">
		<div class="form-group">
			<label class="col-sm-2 control-label">Nombre</label>
			<div class="col-sm-4">
				 {{ Form::text('nombre',null, array('class' => 'form-control')) }}
			</div>
			{{Form::label('icono', 'Icono por default:', array('class' => 'col-sm-2 control-label'))}}
			<div class="col-sm-4">
				<input type="file" name="icono" class="form-control" accept="image/x-png"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Descripción</label>
			<div class="col-sm-10">
				{{ Form::textarea('descripcion', null, array('class' => 'form-control', 'rows'    => 4)) }}
			</div>
		</div>
	</div>
</div>

<div class="clearfix btn-block">
	{{Form::submit('Actualizar', array('class' => 'btn btn-default pull-right'))}}
</div>

{{ Form::close() }}

@stop