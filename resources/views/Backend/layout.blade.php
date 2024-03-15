<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
  <!-- Favicons -->
  <link href="{{asset('frontend/img/favicon.png')}}" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/v/dt/dt-2.0.1/datatables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
      small{
        color:orange;
      }
    </style>
    @stack('css')
</head>
<body>
    

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">JAADE CMS</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="{{route('admin.home')}}">Inicio<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('admin.users')}}">Usuarios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('admin.slider')}}">Carousel</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('admin.zonas')}}">Zonas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('admin.servicios')}}">Servicios</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('admin.contacto')}}">Contacto</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('admin.datos')}}">Datos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">Salir</a>
      </li>
    </ul>    
  </div>
</nav>


<div class="container">


@section('contenido')


@show

</div>

















<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/v/dt/dt-2.0.1/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('js')


</body>
</html>