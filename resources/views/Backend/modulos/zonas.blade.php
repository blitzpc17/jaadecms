@extends('Backend.layout')

@section('title', 'Zonas')

@section('contenido')


<div class="row">

    <div class="col-sm-12 mt-3">
        <h4>Gestión de zonas</h4>
    </div>

    <hr>

    <div class="col-sm-12 mb-5 mt-5">
        <button class="btn btn-primary" onclick="Nuevo()">Nuevo registro</button>
    </div>
    <div  class="table-responsive">
        <table style="width:100%;" id="tb-registros" class="table table-bordered">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

            </tbody>

        </table>
    </div>

</div>




<!-- Modal -->
<div class="modal fade" id="md-registro" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">sm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form id="frm-registro">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input class="form-control" type="text" name="nombre" id="nombre">
                        <small id="nombre_err"></small>
                    </div>

                    <div class="form-group">
                        <label for="">Ubicación</label>
                        <input class="form-control" type="text" name="ubicacion" id="ubicacion">
                        <small id="ubicacion_err"></small>
                    </div>

                    <div class="form-group">
                        <label for="">Medidas</label>
                        <input class="form-control" type="text" name="medidas" id="medidas">
                        <small id="medidas_err"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Servicios</label>
                        <input class="form-control" type="text" name="servicios" id="servicios">
                        <small id="servicios_err"></small>
                    </div>

                    <div class="form-group">
                        <label for="">Desde</label>
                        <input class="form-control" type="text" name="desde" id="desde">
                        <small id="desde_err"></small>
                    </div>


                    <div class="form-group">
                        <label for="">Precio</label>
                        <input class="form-control" type="text" name="precio" id="precio">
                        <small id="precio_err"></small>
                    </div>

                    <div class="form-group">
                        <label for="">Coordenadas</label>
                        <input class="form-control" type="text" name="coordenadas" id="coordenadas">
                        <small id="coordenadas_err"></small>
                    </div>

                    <div class="form-group">
                        <label for="">Miniatura</label>
                        <input class="form-control" type="file" name="miniatura" id="miniatura">
                        <small id="miniatura_err"></small>
                    </div>
                    <div class="form-group">
                        <label for="">Slider</label>
                        <input class="form-control" type="file" name="slider[]" id="slider" multiple>
                        <small id="slider_err"></small>
                    </div>

                    <div class="form-group">
                        <label for="">Plano</label>
                        <input class="form-control" type="file" name="plano" id="plano">
                        <small id="plano_err"></small>
                    </div>

                    <div class="form-group">
                        <label for="">Video</label>
                        <input class="form-control" type="file" name="video" id="video">
                        <small id="video_err"></small>
                    </div>

                    <div class="form-group">
                        <label for="">¿Reciente?</label>
                        <select class="form-control" type="text" name="reciente" id="reciente"> 
                            <option value="">Seleccione una opción</option>
                            <option value="1">SÍ</option>
                            <option value="0">NO</option>
                        </select>
                        <small id="reciente_err"></small>
                    </div>

               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>


@push('js')

<script>

    let table;

    $(document).ready(function () {
        console.log("listo!")

        $('#frm-registro').on('submit', function(e){
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: "{{route('admin.zonas.save')}}",
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
                            Listar();
                            LimpiarForm();
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


        Listar();

        
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

    function Listar(){
        $.ajax({
            type: "GET",
            url: "{{route('admin.zonas.listar')}}",
            //data: "",
            dataType: "json",
            success: function (res) {
               LlenarTabla(res);    
            }
        });
        
    }

    function Ver(id){
        $.ajax({
            type: "GET",
            url: "{{route('admin.zonas.ver')}}",
            data: {id:id},
            dataType: "json",
            success: function (res) {
                SetData(res);
            }
        });

    }

    function SetData(data){
        $('#id').val(data.id)
        $('#nombre').val(data.nombre)
        $('#ubicacion').val(data.ubicacion)
        $('#medidas').val(data.medidas)
        $('#servicios').val(data.servicios)
        $('#precio').val(data.precio)
        $('#coordenadas').val(data.coordenadagoogle)
        $('#reciente').val(data.reciente)
        $('#desde').val(data.desde)

       $('.model-title').text('Modificar registro')
        $('#md-registro').modal('toggle')

    }

    function Eliminar(id){
        $.ajax({
            type: "GET",
            url: "{{route('admin.zonas.delete')}}",
            data: {id:id},
            dataType: "json",
            success: function (res) {
                if(res.status==200){
                        Swal.fire({
                            title: "Aviso",
                            text:"Registro eliminado correctamente",
                            icon:"success"
                        }).then(()=>{
                            Listar();
                        })
                    }else{
                        Swal.fire({
                            title: "Advertencia",
                            text:"Ocurrio un problema al intentar eliminar el registro.",
                            icon:"warning"
                        })
                    }
            }
        });
    }

    function LimpiarForm(){
        $('#id').val('')
        $('#nombre').val('')
        $('#ubicacion').val('')
        $('#medidas').val('')
        $('#servicios').val('')
        $('#precio').val('')
        $('#coordenadas').val('')
        $('#reciente').val('')
        $('#desde').val('')
        $('#miniatura').val('');
        $('#slider').val('');
        $('#plano').val('');
        $('#video').val('');
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