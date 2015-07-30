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
        <div class="pull-right">
        	{{ HTML::link(route('negocios.edit', array($negocio->id)), 'Editar información', array('class' => 'btn btn-default')); }}
        <a  class="btn btn-info uploadFiles"><i class="icon-upload"></i> Agregar imagenes</a>
        </div>
		</div>
	</div>
</div>
        


<div class="row">
	<div class="col-md-4">
		
		<!--<div id="us2" style="width: 100%; height: 400px;"></div>-->
		<div id="map-canvas" style="height: 400px; width: 100%; margin: 0; padding: 0;"></div>
		
	</div>
	<div class="col-md-8">
		<div class="panel panel-success panel-custom">
			<div class="panel-heading">
				<div class="icon @if($negocio->icono_default) 
					active @endif">
					@if($negocio->icono_default)
					{{ HTML::image('storage/negocios/'.$negocio->icono_default, 'icon', array('class' => 'icon-image icono')) }}
					@endif
				</div>
				<h3 class="panel-title">{{ $negocio->nombre }}</h3>
			</div>
			<div class="panel-body">
				
				
				<div class="row">
					<div class="col-md-3">
				        	{{Form::label('nombre', 'Nombre')}}
					</div>
					<div class="col-md-9">
						<p>{{$negocio->nombre}}</p>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
				        	{{Form::label('descripcion', 'Descripción')}}
					</div>
					<div class="col-md-9">
						<p>
							{{ $negocio->descripcion }}
						</p>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
				        {{Form::label('categoria', 'Categoría')}}
					</div>
					<div class="col-md-9">
						<p>
							@if($negocio->category)
								{{$negocio->category->nombre}}
							@else
								Ninguna categoría
							@endif
						</p>
					</div>
				</div>
				
				
				
				<div class="row">
					<div class="col-md-3">
				        	{{Form::label('plaza', 'Plaza')}}
					</div>
					<div class="col-md-9">
						<p>
							{{ $negocio->plaza }}
						</p>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
				        	{{Form::label('calle', 'Calle')}}
					</div>
					<div class="col-md-9">
						<p>
							{{ $negocio->calle }}
						</p>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
				        {{Form::label('numeroExterior', 'Número Exterior')}}
					</div>
					<div class="col-md-3">
				        <p>{{ $negocio->numeroExterior }}</p>
					</div>
					<div class="col-md-3">
						{{Form::label('numeroInterior', 'Número Interior')}}
					</div>
					<div class="col-md-3">
						<p>
							{{ $negocio->numeroInterior }}
						</p>
					</div>
				</div>
				
				
				<div class="row">
					<div class="col-md-3">
				        {{Form::label('colonia', 'Colonia')}}
					</div>
					<div class="col-md-3">
				        <p>{{ $negocio->colonia }}</p>
					</div>
					<div class="col-md-3">
						{{Form::label('cp', 'Código Postal')}}
					</div>
					<div class="col-md-3">
						<p>
							{{ $negocio->cp }}
						</p>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
				        {{Form::label('ciudad', 'Ciudad')}}
					</div>
					<div class="col-md-3">
				        <p>{{ $negocio->ciudad }}</p>
					</div>
					<div class="col-md-3">
						{{Form::label('delegacion', 'Delegación')}}
					</div>
					<div class="col-md-3">
						<p>
							{{ $negocio->delegacion }}
						</p>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-3">
				        {{Form::label('estado', 'Estado')}}
					</div>
					<div class="col-md-3">
				        <p>{{ $negocio->estado }}</p>
					</div>
					<div class="col-md-3">
						{{Form::label('pais', 'País')}}
					</div>
					<div class="col-md-3">
						<p>
							{{ $negocio->pais }}
						</p>
					</div>
				</div>
				
			</div>
		
		
		
		</div>
		
		<a href="#" class="thumbnail">
	      	@if($negocio->portada)
				{{ HTML::image('storage/negocios/'.$negocio->portada, 'portada') }}
			@else
				<img src="{{ URL::asset('img/no-banner-qpon.jpg') }} " alt="...">	
			@endif
			
	      
	    </a>
		<div class="clearfix btn-block text-right">
			{{ HTML::link('negocios', 'Eliminar portada', array('class' => 'btn btn-danger')); }}
			{{ HTML::link('negocios', 'Modificar portada', array('class' => 'btn btn-default')); }}
		</div>

		
	</div>
</div>


<div class="row">
	<div class="col-md-4">
		<ul class="nav nav-pills nav-stacked">
		    <li role="presentation" class="active"><a data-toggle="pill" href="#imagenes">Imágenes</a></li>
			<li role="presentation"><a data-toggle="pill" href="#qpons">Qpones</a></li>
			<li role="presentation"><a data-toggle="pill" href="#comentarios">Comentarios</a></li>
		</ul>
	</div>
	<div class="col-md-8">
		<div class="tab-content">
			<div class="tab-pane fade in active" id="imagenes">
				<div class="row imagenes">
					@if(!empty($imagenes))
						@foreach($imagenes as $imagen)
							<div class="col-md-4">
								<a class="fancybox" rel="gallery1" href="{{ asset('storage/negocios').'/'.$imagen->imagen }}">
									{{ HTML::image('storage/negocios/'.$imagen->imagen, '', array('class' => 'thumbnail imgsize')) }}
								</a>
							</div>	
						@endforeach
					@endif
				</div>
			</div>
			<div class="tab-pane fade" id="qpons">
				@foreach($qpones as $qpon)
				<div class="col-md-6 qpon">
					<div class="row">
						<div class="col-md-3">
							<a href="#" class="thumbnail">
						      <img src="{{ URL::asset('img/no-icon-qpon.jpg') }} " alt="...">
						    </a>
						</div>	
						<div class="col-md-9">
								<h3>{{$qpon->nombre }}</h3>
								@if(!empty($negocio->plaza))
									<p>Plaza {{ $negocio->plaza }}</p>
								@endif
							<p class="ciudad">{{ $negocio->ciudad }}, {{ $negocio->pais }}</p>	
							<div class="row">
								<div class="col-md-offset-1 col-md-3">
									<a href="#"><i class="glyphicon glyphicon-heart"></i> {{ $qpon->likes->count() }}</a>
								</div>
								<div class="col-md-8">
									<a href="#"><i class="glyphicon glyphicon-time"></i>{{ strftime("%e %B %Y", strtotime($qpon->vigenciaHasta)) }}</a>
								</div>
							</div>					
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<div class="tab-pane fade" id="comentarios">
				<div class="row">
					<div class="col-md-4 scroll">
						<ul class="nav nav-pills nav-stacked">
							@foreach($qpones as $qpon)
								<li role="presentation"><a data-toggle="pill" href="#{{$qpon->id}}">{{ $qpon->nombre }}</a></li>
							@endforeach
						</ul>
					</div>
					<div class="col-md-8">
						<div class="tab-content">
							@foreach($qpones as $qpon)
							<div class="tab-pane fade scroll" id="{{ $qpon->id }}">
								@foreach($qpon->comments as $comment)
								<div class="row comment">
									<div class="col-md-2">
										<img class="img-responsive" src="{{ URL::asset('img/qpon-avatar.png') }} " alt="...">				
									</div>
									<div class="col-md-10">
										<h3>{{ $comment->user->name }} </h3>
										<p class="date"> {{ strftime("%e %B %Y", strtotime($comment->created_at))}} </p> <!5 de febrero a las 10:14 p.m.>
										<p class="content">
											{{ $comment->comment }}
										</p>
									</div>
								</div>
								@endforeach
							</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--<div class="clearfix btn-block text-right">
	{{ HTML::link('negocios', 'Ver más', array('class' => 'btn btn-default')); }}
</div>
<div class="clearfix btn-block text-right">
	{{ HTML::link('negocios', 'Ver todos', array('class' => 'btn btn-default')); }}
</div>-->
		
<div id="modal_upload_files" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"><i class="icon-upload3"></i> Adjuntar Imagenes</h4>
				</div>
				<form action="#" role="form">
						<div class="modal-body with-padding">
								<div class="form-group">
										<div class="block">	
												<div class="multiple-uploader-activities with-header">Your browser doesn't support native upload.</div>
												<input type="hidden" name="upload_negocio_id" value="{{ $negocio->id }}" id="upload_negocio_id"/>
										</div>
								</div>
						</div>
				</form>
			</div>	
		</div>
</div>

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
	
	zoomChangeBoundsListener = 
    google.maps.event.addListenerOnce(map, 'bounds_changed', function(event) {
        if (this.getZoom()){
            this.setZoom(16);
        }
});
setTimeout(function(){google.maps.event.removeListener(zoomChangeBoundsListener)}, 2000);
	//map.setZoom(10);
	//map.setCenter(new google.maps.LatLng(parseFloat({{ $negocio->latitud }}), parseFloat({{ $negocio->longitud }})));
}

google.maps.event.addDomListener(window, 'load', initialize);			

</script>
<script type="text/javascript">
$(function(){

	$(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
	
	$('.uploadFiles').click(function(){
						$('#modal_upload_files').modal('toggle');
						$(".multiple-uploader-activities").pluploadQueue({
								runtimes : 'html5,html4',
								url : "{{ URL::to('negocios/uploadFile') }}",
								chunk_size: '1mb',
								rename : true,
								dragdrop: true,
					
								filters : {
										max_file_size : '6mb',
										mime_types: [
												{ title : "Image files", extensions : "jpg, jpeg, png" }
										]
								},
								//resize : {width : 320, height : 240, quality : 90},
								prevent_duplicates: true,
								multipart_params : {
									"negocio_id" : $("input[name='upload_negocio_id']").val()
								},
								init: {

										FilesAdded: function (up, files) {},
										FileUploaded: function (up, file, res) {
												var res1 = res.response.replace('"{', '{').replace('}"', '}');
												var objResponse = JSON.parse(res1);
												
												var newURL = '{{ asset("storage/negocios") }}';
												
												//alert(objResponse.fn);
												$("div.imagenes").append("<div class='col-md-4'>"
														+"<a class='fancybox' rel='gallery1' href='"+newURL+"/"+objResponse.img+"'>"
														+"<img src='"+newURL+"/"+objResponse.img+"' class='thumbnail imgsize' >"
														+"</a>"
														+"</div>");

												fileEvents();
										},
										UploadComplete: function (up, files) {
										
										 $('#modal_upload_files').modal('toggle');
											 up.destroy();
											/*initUploader();*/
										}
								}
						});   
				});
						
});
</script>
@stop