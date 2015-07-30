@extends('layouts.master')
 
@section('sidebar')
     @parent
     Formulario de Qpon
@stop
 
@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="clearfix btn-block">
        {{ HTML::link('qpones', 'Regresar al listado', array('class' => 'btn btn-default pull-left')); }}
		</div>
	</div>
</div>

{{ Form::open(array('url' => 'qpones/crear', 'files'=>true, "class" => "form-horizontal")) }}

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
        <h1 class="panel-title">Crear Qpon</h1>
    </div>
    <div class="panel-body">
    	*campos obligatorios
	        <div class="form-group">
	            {{Form::label('nombre', '*Nombre', array("class" => "col-sm-2 control-label"))}}
	            <div class="col-sm-4">
	                {{Form::text('nombre', '', array("class" => "form-control"))}}
	                @if($errors->has("nombre"))
	                    <p><em>{{ $errors->first("nombre") }}</em></p>
	                @endif
	            </div>
	            {{Form::label('banner', '*Banner', array("class" => "col-sm-2 control-label"))}}
	            <div class="col-sm-4">
	                {{ Form::file('banner', ['class' => 'form-control']) }}
	                @if($errors->has("banner"))
	                    <p><em>{{ $errors->first("banner") }}</em></p>
	                @endif
	            </div>
	        </div>
	        <div class="form-group">
	            {{Form::label('vigenciaHasta', '*Vigente hasta', array("class" => "col-sm-2 control-label"))}}
	            <div class="col-sm-4">
	                {{Form::text('vigenciaHasta', '', array("class" => "form-control", "id" => "vigencia"))}}
	                @if($errors->has("vigenciaHasta"))
	                    <p><em>{{ $errors->first("vigenciaHasta") }}</em></p>
	                @endif
	            </div>
				{{Form::label('negocio', '*Negocio:', array('class' => 'col-sm-2 control-label'))}}
				<div class="col-sm-4">
					{{ Form::select('id_negocio', $negocios, null, array('class' => 'form-control')) }}
				</div>
	        </div>
	        <div class="form-group">
	        	{{Form::label('habilitado', 'Habilitado:', array('class' => 'col-sm-2 control-label'))}}
				<div class="col-sm-4">
					{{ Form::checkbox('habilitado', 1, true, ['class' => 'form-control']) }}
				</div>
	        	{{Form::label('categoria', '*Categoría:', array('class' => 'col-sm-2 control-label'))}}
				<div class="col-sm-4">
					{{ Form::select('categoria_id', $categorias, null, array('class' => 'form-control')) }}
				</div>
	        </div>
	        <div class="form-group">
				<label class="col-sm-2 control-label">*Latitud:</label>
				<div class="col-sm-4">
					{{Form::text('latitud', '', array("class" => "form-control", "id" => "us3-lat", "readonly"))}}
				</div>
				<label class="col-sm-2 control-label">*Longitud:</label>
				<div class="col-sm-4">
					{{Form::text('longitud', '', array("class" => "form-control", "id" => "us3-lon", "readonly"))}}
				</div>
			</div>
	        <div class="form-group">
	            {{Form::label('descripcion', 'Descripción', array("class" => "col-sm-2 control-label"))}}
	                <div class="col-sm-10">
	                {{ Form::textarea('descripcion', null, array('class' => 'form-control', 'rows' => 4)) }}
	                @if($errors->has("descripcion"))
	                    <p><em>{{ $errors->first("descripcion") }}</em></p>
	                @endif
	            </div>
	        </div>
	        <div class="form-group">
	            <div class="col-sm-offset-3 col-sm-9">
	                {{Form::submit('Guardar', array("class" => "btn btn-success pull-right"))}}
	            </div>
	        </div>
    </div>
    <!--<div class="panel-footer">
        <div class="row">
            <div class="col-sm-1">
                {{ HTML::link('qpones', 'volver', array("class" => "btn btn-primary")); }}
            </div>
        </div>
    </div>-->
</div>

{{ Form::close() }}
@stop

@section('js')
		
		<script type="text/javascript">
		$(function(){
			$('#vigencia').datetimepicker({
				format:'Y-m-d H:i',
				minDate: 0
			});
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