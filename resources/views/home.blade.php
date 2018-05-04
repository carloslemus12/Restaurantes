@extends(auth()->check()? (auth()->user()->isAdmin()? 'layouts.admin' : (auth()->user()->isModerator()? 'layouts.moderator' : (auth()->user()->isEmpleado()? 'layouts.empleado' : 'layouts.client'))) : 'layouts.app')

@section('title')
    Home
@endsection

@section('content')
    @guest
        <div class="container w-100 d-flex justify-content-center align-items-center mt-5">
            <img src="{{ asset('img/bad.svg') }}" />
        </div>
        <div class="container w-100 d-flex justify-content-center">
            <h3 class="text-danger">Debe de iniciar la sesion</h3>
        </div>
    @else
    <div class="container">
        <div class="container w-100 d-flex justify-content-center align-items-center mt-5">
            <img src="{{ asset('img/internet.svg') }}" />
        </div>
        <div class="container w-100 d-flex justify-content-center">
            <h3 class="text-success" >Bienvenido <strong>{{ auth()->user()->username }}</strong></h3>
        </div>
    </div>
    @endguest
@endsection
