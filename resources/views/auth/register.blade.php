@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col w-100 h-100 d-flex justify-content-center">
            <div class="card bg-transparent border-0 mt-2">
                <div class="card-header border-0">
                    <center><img class="card-img-top" src="{{ asset('img/register.svg')  }}" alt="Card image cap" style="width: 18rem;"></center>
                </div>
                <form id="form_register" method="POST" action="{{ route('register') }}">
                    <div class="card-body">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <label for="name">Nombre</label>

                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        <strong>Error: </strong>{{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="lastname">Apellido</label>

                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required>
    
                                @if ($errors->has('lastname'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        <strong>Error: </strong>{{ $errors->first('lastname') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <label for="username">Username</label>

                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>

                                @if ($errors->has('username'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        <strong>Error: </strong>{{ $errors->first('username') }}
                                    </div>
                                @endif
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="nacimiento">Fecha nacimiento</label>
                                <input id="nacimiento" type="date" class="form-control" value="02-16-2012" name="nacimiento" />

                                @if ($errors->has('nacimiento'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        <strong>Error: </strong>{{ $errors->first('nacimiento') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col">
                                <label for="email">Correo electronico</label>

                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <label for="password">Contraseña</label>

                                <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}" required>

                                @if ($errors->has('password'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        <strong>Error: </strong>{{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="password-confirm">Confirmar contraseña</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-0">
                        <button type="submit" class="btn btn-success m-0 w-100">Registrase</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            jQuery.validator.addMethod("password_confirm", function(value, element) {
                return $('#password').val() == $('#password-confirm').val();
            }, "the keys do not match");

            $('#form_register').validate({
                rules: {
                    name: {
                        required: true
                    },
                    lastname: {
                        required: true
                    },
                    username: {
                        required: true
                    },
                    nacimiento: {
                        required: true,
                        date: true
                    },
                    email: {
                        required: true,
                        email:true
                    },
                    password: {
                        required: true
                    },
                    password_confirmation: {
                        required: true,
                        password_confirm: true
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
