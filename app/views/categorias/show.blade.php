@extends('layouts.master')
 
@section('sidebar')
     @parent
     Formulario de Negocio
@stop
 
@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="clearfix btn-block">
        {{ HTML::link('categorias', 'Regresar a categorias', array('class' => 'btn btn-default pull-left')); }}
        {{ HTML::link(route('categorias.edit', array($categoria->id)), 'Editar información', array('class' => 'btn btn-default pull-right')); }}
        <a  class="btn btn-info uploadFiles pull-right" style="margin-right: 10px;"><i class="icon-upload"></i> Agregar imagenes</a>
		</div>
	</div>
</div>


@stop
@section('js')	

@stop