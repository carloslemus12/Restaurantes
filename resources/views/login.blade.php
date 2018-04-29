<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::script('js/jquery-3.3.1.min.js') !!}
    {!! Html::script('js/bootstrap.min.js') !!}
    {!! Html::script('js/jquery.validate.min.js') !!}
    {!! Html::script('js/additional-methods.min.js') !!}    

    <style>
        html, body, form{
            height: 100%;
        }

        body{
            background: url({{ asset('img/back_login.jpg')  }});
        }
    </style>
</head>
<body>
    
    <div class="container h-100">
        <div class="row w-100 h-100">
            <div class="col w-100 h-100 d-flex justify-content-center align-items-center">

                <div class="card bg-transparent border-0" style="width: 18rem;">
                    <img class="card-img-top" src="{{ asset('img/coffee.svg')  }}" alt="Card image cap">
                    <div class="card-body">
                        <form id="form-login" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Correo electronico</label>
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Correo electronico">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contraseña</label>
                                <input type="password" namse="pass" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Iniciar sesion</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#form-login').validate({
                rules: {
                    email: {
                        required: true,
                        email:true
                    },
                    pass: {
                        required: true
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>

</body>
</html>