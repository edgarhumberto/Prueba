@extends('layouts.master')
 
@section('sidebar')
     @parent
     Formulario de Negocio
@stop
 
@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="clearfix btn-block">
        	{{ HTML::link('categoriasQpones', 'Regresar a Categorias', array('class' => 'btn btn-default pull-left')); }}
		</div>
	</div>
</div>

{{ Form::open(array('route' => 'categoriasQpones.store', 'class' => 'form-horizontal' , 'files' => true )) }}

<div class="panel panel-success panel-custom">
	<div class="panel-heading">
		<h3 class="panel-title">1. Ingresar nueva categoria</h3>
	</div>
	<div class="panel-body">
		<div class="form-group">
			<label class="col-sm-2 control-label">Nombre</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="nombre">
			</div>
			{{Form::label('icono', 'Icono por default:', array('class' => 'col-sm-2 control-label'))}}
			<div class="col-sm-4">
				<input type="file" name="icono" class="form-control" accept="image/x-png"/>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">Descripción</label>
			<div class="col-sm-10">
				<textarea name="descripcion" class="form-control" rows="4"></textarea>
			</div>
		</div>
	</div>
</div>

<div class="clearfix btn-block">
	{{Form::submit('Guardar', array('class' => 'btn btn-default pull-right'))}}
</div>

{{ Form::close() }}

@stop