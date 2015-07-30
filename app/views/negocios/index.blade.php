@extends('layouts.master')
 
@section('sidebar')
	@parent
	Formulario de Negocio
@stop

@section('js')
@parent

<script type="text/javascript">
  function initialize() {
	  var mapOptions = {
	      zoom: 15
	  };
	  
    var map = new google.maps.Map(document.getElementById('map-canvas'),
        mapOptions);
   
   // Try HTML5 geolocation
	  if(navigator.geolocation) {
	    navigator.geolocation.getCurrentPosition(function(position) {
	      var pos = new google.maps.LatLng(position.coords.latitude,
	                                       position.coords.longitude);
	      
		  @if(!empty($busqueda))
		   	 	map.setZoom(17);
		   		map.setCenter(new google.maps.LatLng(parseFloat({{ $busqueda->latitud }}), parseFloat({{ $busqueda->longitud }})));
		  @else
		  	
		  	var infowindow = new google.maps.InfoWindow({
		        map: map,
		        position: pos,
		        content: 'Tu ubicación'
		      });
	      
		  	map.setCenter(pos);
		  @endif
	    }, function() {
	      handleNoGeolocation(true);
	    });
	  } else {
	    // Browser doesn't support Geolocation
	    handleNoGeolocation(false);
	  } 
	  
	  var infowindow = new google.maps.InfoWindow();
	  var bounds = new google.maps.LatLngBounds();
	  
	  
   @foreach($negocios as $negocio)
   	@if((!empty($negocio->latitud)) && (!empty($negocio->latitud)))
   		var content = '{{ $negocio->calle }} {{ $negocio->numeroExterior }} {{ $negocio->numeroInterior}} {{ $negocio->colonia}} {{ $negocio->cp}} {{ $negocio->delegacion}} {{ $negocio->ciudad}}{{ $negocio->municipio }} {{ $negocio->estado }} {{ $negocio->pais }}';
   		
	    var latLng = new google.maps.LatLng(parseFloat({{ $negocio->latitud }}), parseFloat({{ $negocio->longitud }}));
	    var marker = new google.maps.Marker({
	        position: latLng,
	        map: map,
	        icon: 'http://dev.dvlop.mx/qpon/public/storage/icons/qpon_map_pin.png',
	    });
	    
	    bounds.extend(marker.position);
	    
	    google.maps.event.addListener(marker, 'click', (function (marker, content) {
            return function () {
                infowindow.setContent(content);
                infowindow.open(map, marker);
            }
        })(marker, content));
		
		map.fitBounds(bounds);
	    /*var infoWindow = new google.maps.InfoWindow({
                content: content
            });
            
        google.maps.event.addListener(marker, 'click', function() {
		    infoWindow.open(map,marker);
		  });*/
		  
	 @endif
	@endforeach
  }
  
  function handleNoGeolocation(errorFlag) {
	  if (errorFlag) {
	    var content = 'Error: The Geolocation service failed.';
	  } else {
	    var content = 'Error: Your browser doesn\'t support geolocation.';
	  }
	
	  var options = {
	    map: map,
	    position: new google.maps.LatLng(60, 105),
	    content: content
	  };
	
	  var infowindow = new google.maps.InfoWindow(options);
	  map.setCenter(options.position);
	}

  google.maps.event.addDomListener(window, 'load', initialize);
  
</script>

 @stop
 
@section('content')
<div class="row">

	<div class="col-md-12">
		<div class="clearfix btn-block">
		
		<h1 class="pull-left">
			Mis negocios
			<span class="sub"><br/>Mostrando 4 de tus 15 negocios registrados</span>
		</h1>
		<div class="pull-right">
			{{ HTML::link('categoriasNegocios/create', 'Agregar categoria', array('class' => 'btn btn-default')); }}
			{{ HTML::link('negocios/create', 'Agregar negocio', array('class' => 'btn btn-default')); }}
		</div>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-md-8 listado-negocios">
	
		
		@if(empty($busqueda))
			@foreach($negocios as $negocio)
			<div class="row negocio">
				<div class="col-md-12">
	
					@if($negocio->icono_default)
						<a href="{{URL::route('negocios.show', array($negocio->id));}}">
							{{ HTML::image('storage/negocios/'.$negocio->icono_default, 'icon', array('class' => 'icon-image pull-left', 'width' => '78', 'height' => '86')) }}
						</a>
					@else
						<a href="{{URL::route('negocios.show', array($negocio->id));}}">
							{{ HTML::image('img/no-icon-qpon.jpg', 'icon', array('class' => 'icon-image pull-left', 'width' => '78', 'height' => '86')) }}
						</a>
					@endif
					
					<div class="pull-left info">
						<h3><a href="{{URL::route('negocios.show', array($negocio->id));}}" class="nombreNegocio">{{ $negocio->nombre }}</a></h3>
						<p class="address">
							
							{{ $negocio->calle }} {{ $negocio->numeroExterior }}<br/>
							{{ $negocio->ciudad }}, {{ $negocio->pais }}
							
						</p>
						
						<a class="followers"><i class="fa fa-heart-o"></i> 3 seguidores</a>
						<a class="followers"><i class="fa fa-tags"></i> 4 Qpons desde sept 1</a>
						
					</div>
				</div>
			</div>
			<hr/>
			@endforeach
		@else
			<div class="row negocio">
				<div class="col-md-12">
					@if($busqueda->icono_default)
						<a href="{{URL::route('negocios.show', array($busqueda->id));}}">
							{{ HTML::image('storage/negocios/'.$busqueda->icono_default, 'icon', array('class' => 'icon-image pull-left', 'width' => '78', 'height' => '86')) }}
						</a>
					@else
						<a href="{{URL::route('negocios.show', array($busqueda->id));}}">
							{{ HTML::image('img/no-icon-qpon.jpg', 'icon', array('class' => 'icon-image pull-left', 'width' => '78', 'height' => '86')) }}
						</a>
					@endif
					<div class="pull-left info">
						<h3><a href="{{URL::route('negocios.show', array($busqueda->id));}}" class="nombreNegocio">{{ $busqueda->nombre }}</a></h3>
						<p class="address">
							{{ $busqueda->calle }} {{ $busqueda->numeroExterior }}<br/>
							{{ $busqueda->ciudad }}, {{ $busqueda->pais }}
						</p>
						<a class="followers"><i class="fa fa-heart-o"></i> 3 seguidores</a>
						<a class="followers"><i class="fa fa-tags"></i> 4 Qpons desde sept 1</a>
					</div>
				</div>
			</div>
		@endif
	</div>
	<div class="col-md-4">
		{{ Form::open(array('url' => 'negocios/find')) }}
		<div class="panel panel-success panel-custom">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-search"></i> Buscar negocios</h3>
			</div>
			
			<div id="map-canvas" style="height: 200px; margin: 0; padding: 0;"></div>
			
			<div class="panel-body">
				<div class="form-group">
					{{Form::label('nombre', 'Nombre:', array('class' => 'control-label'))}}
					@if(!empty($nombre))
						{{Form::text('nombre', $nombre, array('class' => 'form-control', 'id' => 'nombre'))}}
					@else
						{{Form::text('nombre', '', array('class' => 'form-control', 'id' => 'nombre'))}}
					@endif
				</div>
				<div class="form-group">
					{{Form::label('ubicacion', 'Ubicación o Dirección:', array('class' => 'control-label'))}}
					@if(!empty($ubicacion))
						{{Form::text('ubicacion', $ubicacion, array('class' => 'form-control', 'id' => 'plaza'))}}
					@else
						{{Form::text('ubicacion', '', array('class' => 'form-control', 'id' => 'plaza', 'placeholder'=>'calle # col cp delegacion ciudad mun estad pais'))}} 
					@endif
				</div>
				<div class="clearfix">
				  <button type="submit" class="btn btn-default pull-right"><i class="fa fa-search"></i> Buscar</button>
				</div>
		</div>
		{{ Form::close() }}
	</div>
</div>

@stop