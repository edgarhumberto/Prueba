@extends('layouts.master')
 
@section('sidebar')
     @parent
     Lista de negocios
@stop
 
@section('content')
        <h1>
  Negocios
      
    
  
</h1>
        {{ HTML::link('negocios/nuevo', 'Crear Negocio'); }}
 
<ul>
  @foreach($negocios as $negocio)
           <li>
    {{ HTML::link( 'negocios/'.$negocio->id , $negocio->nombre.' '.$negocio->apellido ) }}
      
  </li>
          @endforeach
  </ul>
@stop