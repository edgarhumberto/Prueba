<?php
function checkPath($anioMes, $negocio_id, $tipoImagen){
	//$path = public_path().'/negocios/'.$anioMes.'/'.$negocio->id.'/icon';
	$path = public_path().'/storage';
	
	if(!File::exists($path)) {
	    // path does not exist
	    File::makeDirectory($path);
	    $path = public_path().'/storage/negocios';
	    File::makeDirectory($path);
	    $path = public_path().'/storage/negocios/'.$anioMes;
	    File::makeDirectory($path);
	    $path = public_path().'/storage/negocios/'.$anioMes.'/'.$negocio_id;
	    File::makeDirectory($path);
	    if($tipoImagen == 1){
		    $path = public_path().'/storage/negocios/'.$anioMes.'/'.$negocio_id.'/icon';
	    }else if($tipoImagen == 2){
		    $path = public_path().'/storage/negocios/'.$anioMes.'/'.$negocio_id.'/portada';
	    }else if($tipoImagen == 3){
		    $path = public_path().'/storage/negocios/'.$anioMes.'/'.$negocio_id.'/imagenes';
	    }
	    File::makeDirectory($path);
	}
	
	$path = public_path().'/storage/negocios';
	if(!File::exists($path)){
		File::makeDirectory($path);
		$path = public_path().'/storage/negocios/'.$anioMes;
		File::makeDirectory($path);
		$path = public_path().'/storage/negocios/'.$anioMes.'/'.$negocio_id;
		File::makeDirectory($path);
		if($tipoImagen == 1){
		    $path = public_path().'/storage/negocios/'.$anioMes.'/'.$negocio_id.'/icon';
	    }else if($tipoImagen == 2){
		    $path = public_path().'/storage/negocios/'.$anioMes.'/'.$negocio_id.'/portada';
	    }else if($tipoImagen == 3){
		    $path = public_path().'/storage/negocios/'.$anioMes.'/'.$negocio_id.'/imagenes';
	    }
		File::makeDirectory($path);
	}
	
	$path = public_path().'/storage/negocios/'.$anioMes;
	if(!File::exists($path)){
		File::makeDirectory($path);
		$path = public_path().'/storage/negocios/'.$anioMes.'/'.$negocio_id;
		File::makeDirectory($path);
		if($tipoImagen == 1){
		    $path = public_path().'/storage/negocios/'.$anioMes.'/'.$negocio_id.'/icon';
	    }else if($tipoImagen == 2){
		    $path = public_path().'/storage/negocios/'.$anioMes.'/'.$negocio_id.'/portada';
	    }else if($tipoImagen == 3){
		    $path = public_path().'/storage/negocios/'.$anioMes.'/'.$negocio_id.'/imagenes';
	    }
		File::makeDirectory($path);
	}
	
	$path = public_path().'/storage/negocios/'.$anioMes.'/'.$negocio_id;
	if(!File::exists($path)){
		File::makeDirectory($path);
		if($tipoImagen == 1){
		    $path = public_path().'/storage/negocios/'.$anioMes.'/'.$negocio_id.'/icon';
	    }else if($tipoImagen == 2){
		    $path = public_path().'/storage/negocios/'.$anioMes.'/'.$negocio_id.'/portada';
	    }else if($tipoImagen == 3){
		    $path = public_path().'/storage/negocios/'.$anioMes.'/'.$negocio_id.'/imagenes';
	    }		
	    File::makeDirectory($path);
	}
	
	if($tipoImagen == 1){
	    $path = public_path().'/storage/negocios/'.$anioMes.'/'.$negocio_id.'/icon';
    }else if($tipoImagen == 2){
	    $path = public_path().'/storage/negocios/'.$anioMes.'/'.$negocio_id.'/portada';
    }else if($tipoImagen == 3){
	    $path = public_path().'/storage/negocios/'.$anioMes.'/'.$negocio_id.'/imagenes';
    }
	if(!File::exists($path)){
		File::makeDirectory($path);
	}
	
	if($tipoImagen == 1){
	     return 'storage/negocios/'.$anioMes.'/'.$negocio_id.'/icon';
    }else if($tipoImagen == 2){
	    return 'storage/negocios/'.$anioMes.'/'.$negocio_id.'/portada';
    }else if($tipoImagen == 3){
	    return 'storage/negocios/'.$anioMes.'/'.$negocio_id.'/imagenes';
    } 
}

function checkPathQpon($qpon_id){
	$path = public_path().'/storage';
	
	if(!File::exists($path)) {
		File::makeDirectory($path);
		$path = public_path().'/storage/qpones';
		File::makeDirectory($path);
		$path = public_path().'/storage/qpones/'.$qpon_id;
		File::makeDirectory($path);
	}
	
	$path = public_path().'/storage/qpones';
	if(!File::exists($path)) {
		File::makeDirectory($path);
		$path = public_path().'/storage/qpones/'.$qpon_id;
		File::makeDirectory($path);
	}
	
	$path = public_path().'/storage/qpones/'.$qpon_id;
	
	if(!File::exists($path)) {
		File::makeDirectory($path);
	}
	
	return 'storage/qpones/'.$qpon_id;
}
?>