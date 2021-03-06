<!DOCTYPE html>
<html>
    <head>
        <title>
            @section('title')
            Qpon
            @show
        </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link href='http://fonts.googleapis.com/css?family=Exo+2:400,300,200,100,500,600,700,800,900' rel='stylesheet' type='text/css'>	
		{{ HTML::style("css/font-awesome.min.css") }}
        <!-- CSS are placed here -->
        {{ HTML::style('css/bootstrap.css') }}
        {{ HTML::style("css/style.css") }}
        {{ HTML::style("css/icons.css") }}
        
        {{ HTML::style("css/jquery.datetimepicker.css") }}
        
		 <!-- Add fancyBox -->
		{{ HTML::style("source/jquery.fancybox.css?v=2.1.5") }}
    </head>

    <body>
		<header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
		<div class="container">
		<div class="navbar-header">
		<button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
		<a href="negocios" class="navbar-brand">
			<img src="{{ URL::asset('img/qpon-logo.png') }}"/>
		</a>
		</div>
		<nav class="collapse navbar-collapse bs-navbar-collapse">
		<ul class="nav navbar-nav">
		
		</ul>
		<ul role="menu" class="nav navbar-nav navbar-right">
			<li>
				<a class="dropdown-toggle"
       data-toggle="dropdown" href="#">
       			Negocios
       			<i class="fa fa-angle-down"></i>
       			</a>
       			<ul class="dropdown-menu" style="background-color: #EC2979;">
					<li>
						<a href="{{ url('negocios') }}">Mis Negocios</a>
					</li>
					<li>
						<a href="{{ url('categoriasNegocios') }}">Categorias</a>
					</li>
				</ul>
			</li>
			<li>
				<a class="dropdown-toggle"
       data-toggle="dropdown" href="#">
       			Qpones
       			<i class="fa fa-angle-down"></i>
       			</a>
       			<ul class="dropdown-menu" style="background-color: #EC2979;">
					<li>
						<a href="{{ url('qpones') }}">Mis Qpones</a>
					</li>
					<li>
						<a href="{{ url('categoriasQpones') }}">Categorias</a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a class="dropdown-toggle"
       data-toggle="dropdown" href="#">
					{{ Auth::user()->name }}
					<i class="fa fa-angle-down"></i>
				</a>
				<ul class="dropdown-menu" style="background-color: #EC2979;">
					<li>
						<a href="#">Mi perfil</a>
					</li>
					<li>
						<a href="#">Configuración</a>
					</li>
					<li>
						<a href="{{ url('logout') }}">Cerrar sesión</a>
					</li>
				</ul>
			</li>
		</ul>
		</nav>
		</div>
		</header>
    
    
        <!-- Container -->
        <div class="container-fluid">
			<div class="container">
            <!-- Content -->
            @yield('content')
			</div>

        </div>
		
		
        <!-- Scripts are placed here -->
        {{ HTML::script('js/jquery-2.1.3.min.js') }}
        {{ HTML::script('js/locationpicker.jquery.js') }} 
        {{ HTML::script('https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places')}}
        {{ HTML::script('js/bootstrap.min.js') }}
		
		{{ HTML::script('js/uploader/plupload.full.min.js') }}
		{{ HTML::script('js/uploader/plupload.queue.min.js') }}
		{{ HTML::script('js/uploader/es.js') }}
		
		{{ HTML::script('js/jquery.datetimepicker.js') }}
		 <!-- Add fancyBox -->
		 {{ HTML::script('source/jquery.fancybox.pack.js?v=2.1.5') }}
		 
		@section('js')
		
		@show
		
		
		
    </body>
</html>