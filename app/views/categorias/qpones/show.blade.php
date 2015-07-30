@extends('layouts.master')
 
@section('sidebar')
     @parent
     Formulario de Negocio
@stop
 
@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="clearfix btn-block">
        {{ HTML::link('categoriasQpones', 'Regresar a categorias', array('class' => 'btn btn-default pull-left')); }}
		</div>
	</div>
</div>

<div class="panel panel-success panel-custom">
	<div class="panel-heading">
		<h3 class="panel-title">Categoria de Negocio</h3>
	</div>
	<div class="panel-body">
		<table class="table">
			<tr>
				<td>Nombre</td>
				<td>{{ $categoria->nombre }}</td>
			</tr>
			<tr>
				<td>Icono</td>
				<td>@if(!empty($categoria->icono_emblema)) {{ HTML::image('img/emblemas/categorias/'.$categoria->icono_emblema, 'a picture', array('class' => 'thumb icono-emblema-detalle')) }} @endif </td>
			</tr>
			<tr>
				<td>Descripción</td>
				<td>{{ $categoria->descripcion }}</td>
			</tr>
		</table>
	</div>
</div>

<div class="clearfix btn-block">
	<div class="pull-right">
		{{ HTML::link(route('categoriasQpones.edit', array($categoria->id)), 'Editar', array('class' => 'btn btn-default')); }}
		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal">Eliminar</button>
	
	</div>
</div>

{{ Form::open(array('url' => 'categoriasQpones/' . $categoria->id, 'class' => 'pull-right')) }}
        {{ Form::hidden('_method', 'DELETE') }}
        
<div class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" id="gridSystemModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Eliminar categoria</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-offset-1 col-md-8">@if(!empty($categoria->negocios[0])) No se puede eliminar esta categoria ya que hay negocios relacionados a esta categoria @else Si realmente desea eliminar esta categoria presione eliminar. @endif
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        @if(empty($categoria->negocios[0]))
        	<button type="submit" class="btn btn-primary" id="eliminar">Eliminar</button>
        @endif
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{{ Form::close() }}

@stop

@section('js')	
<script>
$(function(){
});
</script>
@stop