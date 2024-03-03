@extends('Backend.layout')

@push('css')

<style>
.card-img-top{
    width:35vh;
    height:35vh;
}

.div-img{
    width:100%;
    height:65vh;
    padding:3rem;
    display:flex;
    justify-content:center;
}


</style>

@endpush

@section('title', 'Admin|Inicio')

@section('contenido')

<div class="card">
   
    <div class="card-body">
        <h4 class="card-title">Bienvenido {{$user->name}}</h4>
        <hr>
        <div class="div-img">
            <img class="card-img-top" src="{{asset('frontend/img/logo.png')}}" alt="">
        </div>
        
       
    </div>
</div>


@endsection