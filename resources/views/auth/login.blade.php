@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col w-100 h-100 d-flex justify-content-center">
            <div class="card bg-transparent border-0 mt-2"  style="width: 18rem;">
                <div class="card-header text-center bg-transparent text-white border-0">
                    <img class="card-img-top" src="{{ asset('img/login.svg')  }}" alt="Card image cap">
                </div>
                <form id="form-login" method="POST" action="{{ route('login') }}">
                    <div class="card-body border-0">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">Correo electronico</label>

                            <div class="col">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        <strong>Error: </strong>{{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Contraseña</label>

                            <div class="col">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <div class="alert alert-danger mt-2" role="alert">
                                        <strong>Error: </strong>{{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="exampleCheck1">Recordar cuenta</label>
                        </div>

                    </div>
                    <div class="card-footer text-muted p-0">
                        <button type="submit" class="btn btn-primary w-100 h-100 m-0">Iniciar sesion</button>
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
@endsection
