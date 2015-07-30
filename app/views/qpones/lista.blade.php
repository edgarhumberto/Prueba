@extends('layouts.master')
 
@section('sidebar')
     @parent
     Lista de qpones
@stop
 
@section('content')

    
    <nav class="navbar navbar-default nav-fixed-top top-bar">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Qpones</a>
            </div>
            {{ HTML::link('qpones/nuevo', 'Crear Qpon', array("class" => "btn btn-primary navbar-btn pull-right")); }}
        </div><!-- /.container-fluid -->
    </nav>

    <div class="row">
        @foreach($qpones as $qpon)
            @if($qpon->nombre != "")
                <div class="col-sm-4">
                    <div class="thumbnail">
                        <img @if(!empty($qpon->banner)) src="{{ asset("storage/qpones/".$qpon->id."/".$qpon->banner) }}" @else src="{{ asset("img/coupon.png") }}" @endif alt="coupon">
                        <div class="caption">
                            <h4 class="text-center">{{$qpon->nombre}}</h4>
                            <p>{{ HTML::link( 'qpones/'.$qpon->id , "Ver Qpon", array("class" => "btn btn-success btn-block") ) }}</p>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@stop