@extends('layouts.master')
 
@section('sidebar')
     @parent
     Formulario de Negocio
@stop
 
@section('content')






        {{ HTML::link('negocios', 'volver'); }}
        <h1>Crear Negocio</h1>
  
        {{ Form::open(array('url' => 'negocios/crear')) }}
        
        
        
        
        
        
        
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
        	{{Form::label('nombre', 'Nombre')}}
        	{{Form::text('nombre', '', array('class' => 'form-control'))}}
        </div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
        	{{Form::label('categoria', 'Categoría')}}
        	<select class="form-control">
				<option value="">A</option>
			</select>
        </div>
	</div>
</div>





<div class="form-group">
	<label class="col-sm-1 control-label">Location</label>
	<div class="col-sm-5">
		<input type="text" class="form-control" id="us2-address" placeholder="Enter a location"/>
	</div>
</div>
<div class="form-group">
    <label class="col-sm-1 control-label">Radius:</label>
    <div class="col-sm-2"><input type="text" class="form-control" id="us2-radius"></div>
</div>



<div id="us2" style="width: 100%; height: 400px;"></div>

<div class="form-group">
	<input type="text" id="us3-lat"/>
	<input type="text" id="us3-lon"/>
</div>


<div class="row">
	<div class="col-md-12 text-right">
		{{Form::submit('Guardar', array('class' => 'btn btn-default'))}}
	</div>
</div>
        
            
            
            
        {{ Form::close() }}




@stop



@section('js')
		
		
		
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
			console.log('abc');
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