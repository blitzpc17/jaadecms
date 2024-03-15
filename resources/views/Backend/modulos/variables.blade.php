@extends('Backend.layout')

@section('title', 'Datos')

@section('contenido')


<div class="row">

    <div class="col-sm-12 mt-3">
        <h4>Gestión de datos</h4>
    </div>


    <form id="frm-registro" action="" style="width:100%;">
    @csrf
        <div class="col-sm-12">
            <div class="form-group">
            <label for="">Redes Sociales</label>
            <input type="text"
                class="form-control" name="redes" id="redes" placeholder="">
            <small id="redes_err" class="form-text text-muted"></small>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
            <label for="">Télefonos</label>
            <input type="text"
                class="form-control" name="telefonos" id="telefonos" placeholder="">
            <small id="telefonos_err" class="form-text text-muted"></small>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
            <label for="">Ubicación</label>
            <input type="text"
                class="form-control" name="ubicacion" id="ubicacion" placeholder="">
            <small id="ubicacion_err" class="form-text text-muted"></small>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
            <label for="">Domicilio</label>
            <input type="text"
                class="form-control" name="domicilio" id="domicilio" placeholder="">
            <small id="domicilio_err" class="form-text text-muted"></small>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
            <label for="">Correo contacto</label>
            <input type="text"
                class="form-control" name="correo" id="correo" placeholder="">
            <small id="correo_err" class="form-text text-muted"></small>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
            <label for="">Télefono WhatsApp</label>
            <input type="text"
                class="form-control" name="whats" id="whats" placeholder="">
            <small id="whats_err" class="form-text text-muted"></small>
            </div>
        </div>
        <center>
        <button type="submit" class="btn btn-primary">Guardar</button>
        </center>
       

    </form>


</div>








@push('js')

<script>

    let table;

    $(document).ready(function () {
        console.log("listo!")

        Ver();

        $('#frm-registro').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "{{route('admin.datos.save')}}",
                data: new FormData($(this)[0]),
                dataType: "json",
                contentType: false,
                    processData: false,
                success: function (res) {
                    LimpiarMensajes();
                    if(res.status==200){

                        Swal.fire({
                            title: "Aviso",
                            text:"Registro guardado correctamente",
                            icon:"success"
                        }).then(()=>{
                            $('#md-registro').modal('toggle')

                        })
                    }else if(res.errors!=null){
                        console.log(res.errors)
                        $.each(res.errors, function (i, val) { 
                            MostrarMensaje(i, val[0])
                        });
                        
                    }
                    else{
                        Swal.fire({
                            title: "Advertencia",
                            text:"Verifique su información.",
                            icon:"warning"
                        })
                    }
                    
                }
            });
        });



        
    });



    function Nuevo(){
        $('.modal-title').text('Nuevo registro')
        $('#md-registro').modal('toggle')
    }

    function LlenarTabla(data){
        console.log(table)
        if(table!= undefined){
            $('#tb-registros').DataTable().destroy();
        }
        $('#tb-registros tbody').empty();
        $.each(data, function (i, val) { 
            $('#tb-registros tbody').append(`<tr>
                                                <td>${i+1}</td>
                                                <td>${val.nombre}</td>
                                                <td>
                                                    <button class="btn btn-warning" onclick="Ver(${val.id})"><i class="fas fa-edit"></i></button>
                                                    <button class="btn btn-danger" onclick="Eliminar(${val.id})"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>`)
        });

        table = $('#tb-registros').DataTable();
    }

    

    function Ver(id){
        $.ajax({
            type: "GET",
            url: "{{route('admin.datos.ver')}}",
            data: {id:id},
            dataType: "json",
            success: function (res) {
                SetData(res);
            }
        });

    }

    function SetData(data){
        console.log(data)
        $('#redes').val(data.redes.valor)
        $('#telefonos').val(data.telefonos.valor)
        $('#ubicacion').val(data.ubicacion.valor)
        $('#domicilio').val(data.domicilio.valor)
        $('#correo').val(data.correoContacto.valor)
        $('#whats').val(data.telefonoWhats.valor)

       $('.modal-title').text('Modificar registro')
        $('#md-registro').modal('toggle')

    }
    

  

    function MostrarMensaje(idctrl, msj){
        $('#'+idctrl+'_err').text(msj)
    }

    function LimpiarMensajes(){
       $('small').text('')
    }

   


</script>

@endpush

@endsection