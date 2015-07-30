@extends('layouts.master')
 
@section('sidebar')
     @parent
     Información de qpon
@stop
 
@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="clearfix btn-block">
        {{ HTML::link('qpones', 'Regresar al listado', array('class' => 'btn btn-default pull-left')); }}
        <div class="pull-right">
        	{{ HTML::link('qpones/editar/'.$qpon->id, 'Editar información', array('class' => 'btn btn-default')); }}
        </div>
		</div>
	</div>
</div>
    
<div class="row">
	<div class="col-sm-4">
    	<div id="map-canvas" style="height: 400px; width: 100%; margin: 0; padding: 0;"></div>
    </div>	
	<div class="col-sm-8">
		<div class="row">
	        <div class="col-sm-12">
	            <div class="panel panel-success panel-custom">
	                <div class="panel-heading">
	                    <h1 class="panel-title">Qpon -  {{ $qpon->nombre }}</h1>
	                </div>
	                <div class="panel-body">
	                    <div class="row">
	                        <div class="col-sm-3">
	                            <img @if(!empty($qpon->banner)) src="{{ asset("storage/qpones/".$qpon->id."/".$qpon->banner) }}" @else src="{{ asset("img/coupon.png") }}" @endif alt="coupon" class="img-responsive center-block">
	                        </div>
	                        <div class="col-sm-9">
	                        	<div class="row">
	                        		<div class="col-sm-3 text-info">Negocio:</div>
	                        		<div class="col-sm-9 text-info">{{ $qpon->negocio->nombre }}</div>
	                        	</div>
	                        	<div class="row">
	                        		<div class="col-sm-3 text-info">Categoria:</div>
	                        		<div class="col-sm-9 text-info">{{ $qpon->category->nombre }}</div>
	                        	</div>
	                        	<div class="row">
	                        		<div class="col-sm-3 text-info">Descripcion:</div>
	                        		<div class="col-sm-9 text-info">{{ $qpon->descripcion }}</div>
	                        	</div>
	                        	<div class="row">
	                        		<div class="col-sm-3 text-info">Habilitado:</div>
	                        		<div class="col-sm-9 text-info">
	                        		@if(empty($qpon->habilitado))
		                        		<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
		                        	@else
		                        		<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
		                        	@endif
	                        		</div> 
	                        	</div>
	                        	<div class="row">
	                        		<div class="col-sm-3 text-info">Creado:</div>
	                        		<div class="col-sm-9 text-info">{{ $qpon->created_at }}</div>
	                        	</div>
	                        	<div class="row">
	                        		<div class="col-sm-3 text-info">Vigente hasta:</div>
	                        		<div class="col-sm-9 text-info">{{ $qpon->vigenciaHasta }}</div>
	                        	</div>
	                            <!--<p class="text-info">Latitud: {{ $qpon->latitud }}</p><br>
	                            <p class="text-info">Longitud: {{ $qpon->longitud }}</p><br>
	                            <p class="text-info">{{ $qpon->created_at }}</p>-->
	                        </div>
	                    </div>
	                </div>
	                <!--<div class="panel-footer">
	                    <div class="row">
	                        <div class="col-sm-3 col-centered">
	                            {{ HTML::link('qpones', 'Volver', array("class" => "btn btn-primary")); }}
	                            {{ HTML::link('qpones/editar/'.$qpon->id, 'Editar', array("class" => "btn btn-success")); }}
	                        </div>
	                    </div>
	                </div>-->
	            </div>
	        </div>
	    </div>
	    <div class="clearfix btn-block">
			<div class="pull-right">
				<button type="button" class="btn btn-default" data-toggle="modal" data-target="#gridSystemModal">Eliminar</button>
			</div>
		</div>
	</div>
</div>


{{ Form::open(array('url' => 'qpones/eliminar/' . $qpon->id, 'class' => 'pull-right')) }}
        	
<div class="modal fade" role="dialog" aria-labelledby="gridSystemModalLabel" id="gridSystemModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Eliminar Qpon</h4>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-offset-1 col-md-8"> Si realmente desea eliminar este qpon presione eliminar.
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    	<button type="submit" class="btn btn-primary" id="eliminar">Eliminar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{{ Form::close() }}


@stop

@section('js')
<script>
// Note: This example requires that you consent to location sharing when
// prompted by your browser. If you see a blank space instead of the map, this

function initialize() {
  var mapOptions = {
    zoom: 15
  };
  //map = new google.maps.Map(document.getElementById('us2'), mapOptions);
  
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        
  // Try HTML5 geolocation
  /*if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);
	  
	  var infowindow = new google.maps.InfoWindow({
		        map: map,
		        position: pos,
		        content: 'Tu ubicación'
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
  }*/
  
  	var infowindow = new google.maps.InfoWindow();
	var bounds = new google.maps.LatLngBounds();
   		
	var latLng = new google.maps.LatLng(parseFloat({{ $qpon->latitud }}), parseFloat({{ $qpon->longitud }}));
	
	var marker = new google.maps.Marker({
	    position: latLng,
	    map: map,
	    icon: 'http://dev.dvlop.mx/qpon/public/storage/icons/qpon_map_pin.png',
	});
	
	bounds.extend(marker.position);
	
	google.maps.event.addListener(marker, 'click', (function (marker) {
	    return function () {
	        infowindow.open(map, marker);
	    }
	}));
	
	map.fitBounds(bounds);
	
	zoomChangeBoundsListener = 
    google.maps.event.addListenerOnce(map, 'bounds_changed', function(event) {
        if (this.getZoom()){
            this.setZoom(16);
        }
});
setTimeout(function(){google.maps.event.removeListener(zoomChangeBoundsListener)}, 2000);
	//map.setZoom(10);
	
}

google.maps.event.addDomListener(window, 'load', initialize);			

</script>
@stop