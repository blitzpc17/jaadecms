@extends('Frontend.layout')

@section('title', 'Bienvenido')

@section('contenido')

    <!--/ Carousel Star /-->
  <div class="intro intro-carousel">
    <div id="carousel" class="owl-carousel owl-theme">

      @foreach($sliders as $sl)
        <div class="carousel-item-a intro-item bg-image" style="background-image: url({{asset('carousels')}}/{{$sl->imagen}})">
          <div class="overlay overlay-a"></div>
          <div class="intro-content display-table">
            <div class="table-cell">
              <div class="container">
                <div class="row">
                  <div class="col-lg-8">
                    <div class="intro-body">
                      <!-- <p class="intro-title-top">{{$sl->zona}}</p>-->
                      <h1 class="intro-title mb-4">
                        <span class="color-b">{{$sl->zona}}</span></h1>
                      <p class="intro-subtitle intro-price">
                        <a href="{{route('zonas')}}"><span class="price-a">Desde | $ {{$sl->precio}}</span></a>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
     
    </div>
  </div>
  <!--/ Carousel end /-->

  <!--/ Services Star /-->
  <section class="section-services section-t8">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-wrap d-flex justify-content-between">
            <div class="title-box">
              <h2 class="title-a">Te ofrecemos</h2>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
       @foreach($servicios as $serv)     
       <div class="col-md-4">
          <div class="card-box-c foo">
            <div class="card-header-c d-flex">
              <div class="card-box-ico">
                <span class="fa fa-{{$serv->icono}}"></span>
              </div>
              <div class="card-title-c align-self-center">
                <h2 class="title-c">{{$serv->nombre}}</h2>
              </div>
            </div>
            <div class="card-body-c">
              <p class="content-c">
                {{$serv->descripcion}}
              </p>
            </div>          
          </div>
        </div>  
       @endforeach
      </div>
    </div>
  </section>
  <!--/ Services End /-->

  <!--/ Property Star /-->
  <section class="section-property section-t8">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-wrap d-flex justify-content-between">
            <div class="title-box">
              <h2 class="title-a">Nuevas zonas</h2>
            </div>
            <div class="title-link">
              <a href="{{route('lotificaciones')}}">Conoce todas
                <span class="ion-ios-arrow-forward"></span>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div id="property-carousel" class="owl-carousel owl-theme">


        
       
        @foreach ($zonas as $zn)
          <div class="carousel-item-b">
            <div class="card-box-a card-shadow">
              <div class="img-box-a">
                <img src="{{asset('miniaturas')}}/{{$zn->miniatura}}" alt="" class="img-a img-fluid">
              </div>
              <div class="card-overlay">
                <div class="card-overlay-a-content">
                  <div class="card-header-a">
                    <h2 class="card-title-a">
                      <a href="property-single.html">{{$zn->nombre}}</a>
                    </h2>
                  </div>
                  <div class="card-body-a">
                    <div class="price-box d-flex">
                      <span class="price-a">Desde | $ {{$zn->desde}}</span>
                    </div>
                    <a href="{{route('zonas.info')}}?lote={{$zn->id}}" class="link-a">Ver más
                      <span class="ion-ios-arrow-forward"></span>
                    </a>
                  </div>
                  <div class="card-footer-a">
                    <ul class="card-info d-flex justify-content-around">
                      <!-- 
                      <li>
                        <h4 class="card-info-title">Area</h4>
                        <span>340m
                          <sup>2</sup>
                        </span>
                      </li>
                      <li>
                        <h4 class="card-info-title">Beds</h4>
                        <span>2</span>
                      </li>
                      <li>
                        <h4 class="card-info-title">Baths</h4>
                        <span>4</span>
                      </li>
                      <li>
                        <h4 class="card-info-title">Garages</h4>
                        <span>1</span>
                      </li> -->
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach


      </div>
    </div>
  </section>
  <!--/ Property End /-->

@endsection

