@extends('Backend.layout')

@section('title', 'Usuarios')

@section('contenido')


<div class="row">

    <div class="col-sm-12 mt-3">
        <h4>Gestión de usuarios</h4>
    </div>

    <hr>

    <div class="col-sm-12 mb-5 mt-5">
        <button class="btn btn-primary" onclick="Nuevo()">Nuevo registro</button>
    </div>
    <div  class="table-responsive">
        <table id="tb-registros" class="table table-bordered">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
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
    <div class="modal-dialog modal-sm" role="document">
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
                        <label for="">Usuario</label>
                        <input class="form-control" type="text" name="username" id="username">
                    </div>

                    <div class="form-group">
                        <label for="">Correo</label>
                        <input class="form-control" type="email" name="email" id="email">
                    </div>

                    <div class="form-group">
                        <label for="">Contraseña</label>
                        <input class="form-control" type="password" name="password" id="password">
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
                url: "{{route('admin.users.save')}}",
                data: new FormData($(this)[0]),
                dataType: "json",
                contentType: false,
                    processData: false,
                success: function (res) {

                    if(res.status==200){
                        Swal.fire({
                            title: "Aviso",
                            text:"Registro guardado correctamente",
                            icon:"success"
                        }).then(()=>{
                            Listar();
                        })
                    }else{
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
                                                <td>${val.name}</td>
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
            url: "{{route('admin.users.listar')}}",
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
            url: "{{route('admin.users.ver')}}",
            data: {id:id},
            dataType: "json",
            success: function (res) {
                SetData(res);
            }
        });

    }

    function SetData(data){
        $('#id').val(data.id)
        $('#username').val(data.name)
        $('#email').val(data.email)
        $('#password').val('')
        $('#md-registro').modal('toggle')

    }

    function Eliminar(id){
        $.ajax({
            type: "GET",
            url: "{{route('admin.users.delete')}}",
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
        $('#username').val('')
        $('#email').val('')
        $('#password').val('')
    }

   


</script>

@endpush

@endsection