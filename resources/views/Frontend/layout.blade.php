<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>JAADE | @yield('title')</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="{{asset('frontend/img/favicon.png')}}" rel="icon">
  <link href="{{asset('frontend/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{asset('frontend/lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="{{asset('frontend/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/lib/animate/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="{{asset('frontend/css/style.css')}}" rel="stylesheet">

</head>

<body>

 

  <!--/ Nav Star /-->
  <nav class="navbar navbar-default navbar-trans navbar-expand-lg fixed-top">
    <div class="container">
      <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarDefault"
        aria-controls="navbarDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>
      <a class="navbar-brand text-brand" href="{{route('home')}}">INMOBILIARIA<span class="color-b">JAADE</span></a>
      <button type="button" class="btn btn-link nav-search navbar-toggle-box-collapse d-md-none" data-toggle="collapse"
        data-target="#navbarTogglerDemo01" aria-expanded="false">
        <span class="fa fa-search" aria-hidden="true"></span>
      </button>
      <div class="navbar-collapse collapse justify-content-center" id="navbarDefault">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" href="{{route('home')}}">Inicio</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              Lotificaciones
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{route('lotificaciones')}}">Ver todas</a>
            </div>
          </li>
                
          <li class="nav-item">
            <a class="nav-link" href="{{route('contacto')}}">Contacto</a>
          </li>
        </ul>
      </div>     
    </div>
  </nav>
  <!--/ Nav End /-->

  
  @section('contenido')
  @show  

  

  <!--/ footer Star /-->
  <section class="section-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-4">
          <div class="widget-a">
            <div class="w-header-a">
              <h3 class="w-title-a text-brand">Inmobiliaria JAADE</h3>
            </div>
            <div class="w-body-a">
              <p class="w-text-a color-text-a">
                Estamos en Calle Lazaro Cardenas # San Loranzo Teotipilco, Tehuacán Puebla.
              </p>
            </div>
            <div class="w-footer-a">
              <ul class="list-unstyled">
                <li class="color-a">
                  <span class="color-text-a"><i class="fa fa-phone-square"></i> .</span> 238 147 3674</li>
                <li class="color-a">
                  <span class="color-text-a"><i class="fa fa-phone-square"></i> .</span> 221 208 1076</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-8 section-md-t3">
          <div class="widget-a">
            <div class="w-header-a">
              <h3 class="w-title-a text-brand">LOTIFICACIONES</h3>
            </div>
            <div class="w-body-a">
              <div class="w-body-a">
                <ul class="list-unstyled">
                  @foreach($zonas as $zn)
                    <li class="item-list-a">
                      <i class="fa fa-angle-right"></i><a href="{{route('zonas.info')}}?lote={{$zn->id}}">{{$zn->nombre}}</a>
                    </li>
                  @endforeach                 
                </ul>
              </div>
            </div>
          </div>
        </div>
      
      </div>
    </div>
  </section>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <nav class="nav-footer">
            <ul class="list-inline">
              <li class="list-inline-item">
                <a href="#">Inicio</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Lotificaciones</a>
              </li>
              <li class="list-inline-item">
                <a href="#">Contacto</a>
              </li>
            </ul>
          </nav>
          <div class="socials-a">
            <ul class="list-inline">
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-facebook" aria-hidden="true"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-pinterest-p" aria-hidden="true"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a href="#">
                  <i class="fa fa-dribbble" aria-hidden="true"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="copyright-footer">
            <p class="copyright color-text-a">
              &copy; 
              <span class="color-a">INMOBILIARIA JAADE</span> {{date('Y')}}
            </p>
          </div>
          <div class="credits">
           
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--/ Footer End /-->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- JavaScript Libraries -->
  <script src="{{asset('frontend/lib/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('frontend/lib/jquery/jquery-migrate.min.js')}}"></script>
  <script src="{{asset('frontend/lib/popper/popper.min.js')}}"></script>
  <script src="{{asset('frontend/lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('frontend/lib/easing/easing.min.js')}}"></script>
  <script src="{{asset('frontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('frontend/lib/scrollreveal/scrollreveal.min.js')}}"></script>
  <!-- Contact Form JavaScript File -->
  <script src="{{asset('frontend/contactform/contactform.js')}}"></script>

  <!-- Template Main Javascript File -->
  <script src="{{asset('frontend/js/main.js')}}"></script>

</body>
</html>
