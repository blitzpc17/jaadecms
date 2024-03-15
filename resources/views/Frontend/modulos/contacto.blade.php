@extends('Frontend.layout')

@section('title', 'Contacto')

@section('contenido')

  <!--/ Intro Single star /-->
  <section class="intro-single">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-8">
          <div class="title-single-box">
            <h1 class="title-single">Contactanos</h1>
            <span class="color-text-a">Aut voluptas consequatur unde sed omnis ex placeat quis eos. Aut natus officia corrupti qui autem fugit consectetur quo. Et ipsum eveniet laboriosam voluptas beatae possimus qui ducimus. Et voluptatem deleniti. Voluptatum voluptatibus amet. Et esse sed omnis inventore hic culpa..</span>
          </div>
        </div>
        <div class="col-md-12 col-lg-4">
          <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{route('home')}}">Inicio</a>
              </li>
              <li class="breadcrumb-item active" aria-current="page">
                Contacto
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>
  <!--/ Intro Single End /-->

  <!--/ Contact Star /-->
  <section class="contact">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="contact-map box">
            <div id="map" class="contact-map">
              <iframe src="{{$ubicacion}}"
                width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
          </div>
        </div>
        <div class="col-sm-12 section-t8">
          <div class="row">
            <div class="col-md-7">
              <form id="frm-contacto" class="form-a contactForm" >  
                @csrf            
                <div class="row">
                  <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <input type="text" name="nombre" id="nombre" class="form-control form-control-lg form-control-a" placeholder="Nombre">
                      <small id="nombre_err"></small>
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <input name="correo" id="correo" type="email" class="form-control form-control-lg form-control-a" placeholder="Correo electrónico">
                      <small id="correo_err"></small>
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <div class="form-group">
                      <input name="telefono" id="telefono" type="text" class="form-control form-control-lg form-control-a" placeholder="Télefono">
                      <small id="telefono_err"></small>
                    </div>
                  </div>
                  <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <input type="text" name="asunto" id="asunto" class="form-control form-control-lg form-control-a" placeholder="Asunto" >
                      <small id="asunto_err"></small>
                    </div>
                  </div>
                  <div class="col-md-12 mb-3">
                    <div class="form-group">
                      <textarea name="comentario" id="comentario" class="form-control" cols="45" rows="8" placeholder="Ingrese sus comentarios"></textarea>
                      <small id="comentario_err"></small>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-a">Enviar comentario</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-md-5 section-md-t3">
              <div class="icon-box section-b2">
                <div class="icon-box-icon">
                  <span class="ion-ios-phone-portrait color-a"></span>
                </div>
                <div class="icon-box-content table-cell">
                  <div class="icon-box-title">
                    <h4 class="icon-title color-a">¡Conocenos!</h4>
                  </div>
                  <div class="icon-box-content">
                    @foreach($telefonos as $tel)
                    <p class="mb-1">
                      <span class="color-a">{{$tel}}</span>
                    </p>
                    @endforeach
                 
                  </div>
                </div>
              </div>
              <div class="icon-box section-b2">
                <div class="icon-box-icon">
                  <span class="ion-ios-pin color-a"></span>
                </div>
                <div class="icon-box-content table-cell">
                  <div class="icon-box-title">
                    <h4 class="icon-title color-a">Nos ubicamos en</h4>
                  </div>
                  <div class="icon-box-content">
                    <p class="mb-1">
                      {{$direccion}}
                    </p>
                  </div>
                </div>
              </div>
              <div class="icon-box">
                <div class="icon-box-icon">
                  <span class="ion-ios-star color-a"></span>
                </div>
                <div class="icon-box-content table-cell">
                  <div class="icon-box-title">
                    <h4 class="icon-title color-a">Siguenos en</h4>
                  </div>
                  <div class="icon-box-content">
                    <div class="socials-footer">
                      <ul class="list-inline">
                       
                        @foreach($redes as $rd)
                          <li class="list-inline-item">
                            <a href="{{$rd->enlace}}" class="link-one">
                              <i class="fa fa-{{$rd->icono}}" aria-hidden="true"></i>
                            </a>
                          </li>
                        @endforeach
                      
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--/ Contact End /-->

@endsection



@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$('#frm-contacto').on('submit', function(e){

    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
      type: "POST",
      url: "{{route('contacto.save')}}",
      data: formData,
      processData: false,
      contentType: false,  
      beforeSend:function(){
        LimpiarMensajes();
      },
      success: function (res) {
        if(res.status==200){

          Swal.fire({
          title: '¡Exito!',
          text: res.msj,
          icon: 'success',
          confirmButtonText: 'Ok'
        }).then(()=>{
            $('#nombre').val('')
            $('#correo').val('')
            $('#telefono').val('')
            $('#asunto').val('')
            $('#comentario').val('')
        })


        }else if(res.status==422){

          Swal.fire({
          title: '¡Exito!',
          text: "Faltarón datos por ingresar. Verifica tu información." ,
          icon: 'warning',
          confirmButtonText: 'Ok'
        }).then(()=>{
           $.each(res.errors, function (i, val) { 
            console.log(i)
             MostrarMensaje(i, val);
           });
        })

        }else{
          console.log("error interno")
        }
      

      }
    });
});



    function MostrarMensaje(idctrl, msj){
        $('#'+idctrl+'_err').text(msj)
    }

    function LimpiarMensajes(){
       $('small').text('')
    }


</script>

@endpush