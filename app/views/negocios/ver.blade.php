@extends('layouts.master')
 
@section('sidebar')
     @parent
     Información de negocio
@stop
 
@section('content')
        {{ HTML::link('negocios', 'Volver'); }}
        <h1>
  Negocio {{$negocio->id}}
      
</h1>
        
        {{ $negocio->nombre }}
        
        
<hr/>
Listado de Qpones del negocio <br/>
<ul>
	@foreach($negocio->qpones as $qpon)
	
		<li>{{ HTML::link('qpones/'.$qpon->id, $qpon->nombre); }} </li>
	@endforeach
</ul>    
<br />
        {{ $negocio->created_at}}
@stop