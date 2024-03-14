@extends('Frontend.layout')
@section('title', $titulo)
@section('contenido')

  <!--/ Intro Single star /-->
  <section class="intro-single">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8">
          <div class="title-single-box">
            <h1 class="title-single">{{$titulo}}</h1>
          </div>
        </div>
        <div class="col-md-12 col-lg-4">
          <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{route('home')}}">Inicio</a>
              </li>
              <li class="breadcrumb-item">
                <a href="{{route('zonas')}}">Lotificaciones</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                {{$titulo}}
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!--/ Intro Single End /-->

  <!--/ Property Single Star /-->
  <section class="property-single nav-arrow-b">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div id="property-single-carousel" class="owl-carousel owl-arrow gallery-property">

            @if($sliders!=null)
              @foreach($sliders as $sl)
                <div class="carousel-item-b">
                  <img src="{{asset('sliders')}}/{{$sl}}" alt="">
                </div>
              @endforeach
            @endif
           
          </div>
          <div class="row justify-content-between">
            <div class="col-md-5 col-lg-4">
              <div class="property-price d-flex justify-content-center foo">
                <div class="card-header-c d-flex">
                  <div class="card-box-ico">
                    <span class="ion-money">$</span>
                  </div>
                  <div class="card-title-c align-self-center">
                    <h5 class="title-c">{{$zona->desde}}</h5>
                  </div>
                </div>
              </div>             
            </div>
            <div class="col-md-7 col-lg-7 section-md-t3">
              <div class="row">
                <div class="col-sm-12">
                  <div class="title-box-d">
                    <h3 class="title-d">Ubicación</h3>
                  </div>
                </div>
              </div>
              <div class="property-description">
                <p class="description color-text-a">
                  {{$zona->ubicacion}}
                </p>
              </div>


              <div class="row">
                <div class="col-sm-12">
                  <div class="title-box-d">
                    <h3 class="title-d">Servicios</h3>
                  </div>
                </div>
              </div>
              <div class="property-description">
                <p class="description color-text-a">
                  {{$zona->servicios}}
                </p>
              </div>


              <div class="row">
                <div class="col-sm-12">
                  <div class="title-box-d">
                    <h3 class="title-d">Precio</h3>
                  </div>
                </div>
              </div>
              <div class="property-description">
                <p class="description color-text-a">
                  {{$zona->precio}}
                </p>
              </div>
         

            </div>





          </div>
        </div>
        <div class="col-md-10 offset-md-1">
          <ul class="nav nav-pills-a nav-pills mb-3 section-t3" id="pills-tab" role="tablist">
          @if($ubicacion)
            <li class="nav-item">
              <a class="nav-link active" id="pills-map-tab" data-toggle="pill" href="#pills-map" role="tab" aria-controls="pills-map"
                aria-selected="false">Ubicación</a>
            </li>
            @endif
            @if($video!=null)
            <li class="nav-item">
              <a class="nav-link" id="pills-video-tab" data-toggle="pill" href="#pills-video" role="tab"
                aria-controls="pills-video" aria-selected="true">Video</a>
            </li>
            @endif
            @if($plano!=null)
            <li class="nav-item">
              <a class="nav-link" id="pills-plans-tab" data-toggle="pill" href="#pills-plans" role="tab" aria-controls="pills-plans"
                aria-selected="false">Planos</a>
            </li>
            @endif
           
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade  show active" id="pills-map" role="tabpanel" aria-labelledby="pills-map-tab">
              <iframe src="{{$ubicacion}}"
                width="100%" height="460" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="tab-pane fade" id="pills-video" role="tabpanel" aria-labelledby="pills-video-tab">
              <iframe src="{{asset('videos')}}/{{$video}}" width="100%" height="460" frameborder="0"
                webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            </div>
            <div class="tab-pane fade" id="pills-plans" role="tabpanel" aria-labelledby="pills-plans-tab">
              <img src="{{asset('planos')}}/{{$plano}}" alt="" class="img-fluid">
            </div>
           
          </div>
        </div>
      
      </div>
    </div>
  </section>
  <!--/ Property Single End /-->

    
@endsection