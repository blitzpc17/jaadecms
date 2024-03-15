@extends('Backend.layout')

@section('title', 'Contacto')

@section('contenido')


<div class="row">

    <div class="col-sm-12 mt-3">
        <h4>Gestión de mensajes</h4>
    </div>

    <hr>
 
    <div  class="table-responsive">
        <table style="width:100%;" id="tb-registros" class="table table-bordered">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Asunto</th>
                    <th>Fecha Recibido</th>
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
                        <label for="">Correo</label>
                        <input class="form-control" type="email" name="correo" id="correo">
                        <small id="correo_err"></small>
                    </div>  

                    <div class="form-group">
                        <label for="">Télefono</label>
                        <input class="form-control" type="text" name="telefono" id="telefono">
                        <small id="telefono_err"></small>
                    </div>  

                    <div class="form-group">
                        <label for="">Asunto</label>
                        <input class="form-control" type="text" name="asunto" id="asunto">
                        <small id="asunto_err"></small>
                    </div> 
                    
                    
                    <div class="form-group">
                        <label for="">Comentario</label>
                        <textarea class="form-control" name="comentario" id="comentario" cols="30" rows="10"></textarea>
                        <small id="comentario_err"></small>
                    </div> 

               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
        Listar();        
    });  

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
                                                <td>${val.asunto}</td>
                                                <td>${val.fecha}</td>
                                                <td>
                                                    <button class="btn btn-warning" onclick="Ver(${val.id})"><i class="fas fa-edit"></i></button>                                                   
                                                </td>
                                            </tr>`)
        });

        table = $('#tb-registros').DataTable();
    }

    function Listar(){
        $.ajax({
            type: "GET",
            url: "{{route('admin.contacto.listar')}}",
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
            url: "{{route('admin.contacto.ver')}}",
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
        $('#correo').val(data.correo)
        $('#telefono').val(data.telefono)
        $('#asunto').val(data.asunto)
        $('#comentario').val(data.comentario)

       $('.modal-title').text('Ver mensaje')
        $('#md-registro').modal('toggle')
    }

    function LimpiarForm(){
        $('#id').val('')
        $('#correo').val('')
        $('#telefono').val('')
        $('#asunto').val('')
        $('#comentario').val('')
       
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