<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JAADE | Iniciar Sesion</title>
      <!-- Favicons -->
    <link href="{{asset('frontend/img/favicon.png')}}" rel="icon">
    <link href="http://127.0.0.1:8000/frontend/img/favicon.png" rel="icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
   

    <style>

        body{
            background:#f1f1f1;
        }

        #login{
            background:#fff;
            width:40vh;
            height:60vh;
            border-radius:15px;
            margin:20vh auto;
            padding:3rem;
        }

        #login form{
            width:100%;
        }

        .form-button{
            width:100%;
            display:flex;
            justify-content:center;
        }

        .form-button button{
            background:#18A852;
            color:white;
            margin-top:1rem;
        }

        label{
            color:#053622;
        }

        .logo{
            width:100%;
            height:100px;
            display:flex;
            justify-content:center;
            margin-top:2rem;
            margin-bottom:2rem;
        }

        .logo img{
            width:100px;
        }

        @media (max-width:600px) {
            #login{
               
                width:100%;
                height:100vh;
                border-radius:15px;
                margin:0;
                /*margin-left:0;*/
                padding:3rem;
            }
        }


    </style>


</head>
<body>


<div id="login">
    <form action="{{route('admin.auth')}}" method="POST">
    @csrf

        <div class="logo">
            <img src="{{asset('frontend/img/logo.png')}}" alt="" srcset="">
        </div>

        <div class="form-group">
            <label for="">Usuario</label>
            <input id="usuario" name="usuario" class="form-control" type="text">
        </div>

        <div class="form-group">
            <label for="">Contraseña</label>
            <input id="password" name="password" class="form-control" type="password">
        </div>

        <div class="form-button">
            <button class="btn">Iniciar sesión</button>
        </div>


    </form>

</div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>


    
</body>
</html>