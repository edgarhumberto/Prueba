	@extends('layouts.master')
 
@section('sidebar')
	@parent
	Formulario de Negocio
@stop
 
@section('content')




<div class="row">
	<div class="col-md-12">
		<div class="clearfix btn-block">
        {{ HTML::link('negocios', 'Regresar al listado', array('class' => 'btn btn-default pull-left')); }}
		</div>
	</div>
</div>
        

  
        {{ Form::open(array('route' => 'negocios.store', 'class' => 'form-horizontal' , 'files' => true )) }}
        
        
		<div class="panel panel-success panel-custom">
			<div class="panel-heading">
				<h3 class="panel-title">1. Busca la ubicación de tu negocio en el mapa</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-2 control-label">Buscar:</label>
					<div class="col-sm-4">
						<input type="text" class="form-control" id="us2-address" placeholder="Enter a location"/>
					</div>
					<label class="col-sm-2 control-label">*Radio:</label>
				    <div class="col-sm-4"><input type="text" class="form-control" name="radio" id="us2-radius"></div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">ó selecciona una en el mapa:</label>
					<div class="col-sm-10">
						<div id="us2" style="width: 100%; height: 400px;"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="panel panel-success panel-custom">
			<div class="panel-heading">
				<h3 class="panel-title">2. Llena la información faltante para ubicar tu negocio</h3>
			</div>
			<div class="panel-body">
				*campos obligatorios
				<div class="form-group">
					{{Form::label('nombre', '*Nombre:', array('class' => 'col-sm-2 control-label'))}}
					<div class="col-sm-10">
						{{Form::text('nombre', '', array('class' => 'form-control', 'id' => 'nombre'))}}
					</div>
				</div>
				
				<div class="form-group">
					{{Form::label('plaza', 'Plaza:', array('class' => 'col-sm-2 control-label'))}}
					<div class="col-sm-10">
						{{Form::text('plaza', '', array('class' => 'form-control', 'id' => 'plaza'))}}
					</div>
				</div>
				
				<div class="form-group">
					{{Form::label('calle', '*Calle:', array('class' => 'col-sm-2 control-label'))}}
					<div class="col-sm-10">
						{{Form::text('calle', '', array('class' => 'form-control', 'id' => 'calle'))}}
					</div>
				</div>
				
				<div class="form-group">
					{{Form::label('numeroExterior', '*Número Exterior:', array('class' => 'col-sm-2 control-label'))}}
					<div class="col-sm-4">
						{{Form::text('numeroExterior', '', array('class' => 'form-control', 'id' => 'numeroExterior'))}}
					</div>
					{{Form::label('numeroInterior', 'Número Interior:', array('class' => 'col-sm-2 control-label'))}}
					<div class="col-sm-4">
						{{Form::text('numeroInterior', '', array('class' => 'form-control', 'id' => 'numeroInterior'))}}
					</div>
				</div>
				
				<div class="form-group">
					{{Form::label('colonia', '*Colonia:', array('class' => 'col-sm-2 control-label'))}}
					<div class="col-sm-4">
						{{Form::text('colonia', '', array('class' => 'form-control', 'id' => 'colonia'))}}
					</div>
					{{Form::label('delegacion', 'Delegación:', array('class' => 'col-sm-2 control-label'))}}
					<div class="col-sm-4">
						{{Form::text('delegacion', '', array('class' => 'form-control', 'id' => 'delegacion'))}}
					</div>
				</div>
				
				<div class="form-group">
					{{Form::label('cp', '*Código Postal:', array('class' => 'col-sm-2 control-label'))}}
					<div class="col-sm-4">
						{{Form::text('cp', '', array('class' => 'form-control', 'id' => 'cp'))}}
					</div>
					{{Form::label('ciudad', '*Ciudad:', array('class' => 'col-sm-2 control-label'))}}
					<div class="col-sm-4">
						{{Form::text('ciudad', '', array('class' => 'form-control', 'id' => 'ciudad'))}}
					</div>
				</div>
				
				<div class="form-group">
					{{Form::label('estado', '*Estado:', array('class' => 'col-sm-2 control-label'))}}
					<div class="col-sm-4">
						<input type="text" class="form-control" id="estado" name="estado"/>
					</div>
					{{Form::label('pais', '*País:', array('class' => 'col-sm-2 control-label'))}}
					<div class="col-sm-4">
						<input type="text" class="form-control" id="pais" name="pais"/>
					</div>
				</div>
			</div>
		</div>

       <div class="panel panel-success panel-custom">
			<div class="panel-heading">
				<h3 class="panel-title">3. Describe tu negocio y publica una imagen de portada</h3>
			</div>
			<div class="panel-body">
				<div class="form-group">
					{{Form::label('categoria', '*Categoría:', array('class' => 'col-sm-2 control-label'))}}
					<div class="col-sm-4">
						{{ Form::select('categoria', $categorias, null, array('class' => 'form-control')) }}
					</div>
					{{Form::label('etiquetas', 'Tags:', array('class' => 'col-sm-2 control-label'))}}
					<div class="col-sm-4">
						<input type="text" class="form-control" id="etiquetas" name="etiquetas"/>
					</div>
				</div>
				<div class="form-group">
					{{Form::label('descripcion', 'Descripción:', array('class' => 'col-sm-2 control-label'))}}
					<div class="col-sm-10">
						<textarea name="descripcion" class="form-control" rows="4"></textarea>
					</div>
				</div>
				
				<div class="form-group">
					{{Form::label('icono', 'Icono por default:', array('class' => 'col-sm-2 control-label'))}}
					<div class="col-sm-4">
						<input type="file" name="icono_default" class="form-control"/>
					</div>
					{{Form::label('portada', 'Imagen de portada:', array('class' => 'col-sm-2 control-label'))}}
					<div class="col-sm-4">
						<input type="file" name="portada" class="form-control"/>
					</div>
				</div>
				
			</div>
       </div>
        
        
        
        






<div class="form-group hidden">
	<label class="col-sm-2 control-label">Latitud:</label>
	<div class="col-sm-4">
		<input type="text" class="form-control" name="latitud" id="us3-lat"/>
	</div>
	<label class="col-sm-2 control-label">Longitud:</label>
	<div class="col-sm-4">
		<input type="text" class="form-control" name="longitud" id="us3-lon"/>
	</div>
</div>


		<div class="clearfix btn-block">
        	{{Form::submit('Guardar', array('class' => 'btn btn-default pull-right'))}}
		</div>
        
            
            
            
        {{ Form::close() }}




@stop



@section('js')
		
		<script type="text/javascript">
		$(function(){
			
		});
		</script>
		
		<script>
// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see a blank space instead of the map, this
// is probably because you have denied permission for location sharing.

var map;

function initialize() {
  var mapOptions = {
    zoom: 6
  };
  //map = new google.maps.Map(document.getElementById('us2'), mapOptions);

  // Try HTML5 geolocation
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      
      var pos = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);

      var infowindow = new google.maps.InfoWindow({
        map: map,
        position: pos,
        content: 'Location found using HTML5.'
      });

      //map.setCenter(pos);
	  
	  //var mapContext = $('#us2').locationpicker('map');

	  //mapContext.marker.setPosition(pos);
	  //mapContext.map.setCenter(pos);
	  
		$('#us2').locationpicker({
		location: {latitude: position.coords.latitude, longitude: position.coords.longitude},	
		radius: 300,
		inputBinding: {
			latitudeInput: $('#us3-lat'),
			longitudeInput: $('#us3-lon'),
		    radiusInput: $('#us2-radius'),
		    locationNameInput: $('#us2-address')
		},
		enableAutocomplete: true,
		onchanged: function(currentLocation, radius, isMarkerDropped) {
			//alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
			var addressComponents = $(this).locationpicker('map').location.addressComponents;
			updateControls(addressComponents);
		},
		oninitialized: function(component) {
			var addressComponents = $(component).locationpicker('map').location.addressComponents;
			updateControls(addressComponents);
		}
		});
		
	  
    }, function() {
      handleNoGeolocation(true);
    });
  } else {
    // Browser doesn't support Geolocation
    handleNoGeolocation(false);
  }
}

function updateControls(addressComponents) {
	console.log(addressComponents);
	if($.trim($('#nombre').val()) == ""){
		$('#nombre').val(addressComponents.name);
	}
    $('#calle').val(addressComponents.streetName);
    $('#numeroExterior').val(addressComponents.streetNumber);
    $('#ciudad').val(addressComponents.city);
    $('#cp').val(addressComponents.postalCode);
    $('#estado').val(addressComponents.stateOrProvince);
    $('#pais').val(addressComponents.country);
    $('#colonia').val(addressComponents.neighborhood);
    
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
  
}

google.maps.event.addDomListener(window, 'load', initialize);			



		</script>
@stop