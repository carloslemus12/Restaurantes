@extends('layouts.app')

@section('opciones_menu')
    @auth
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/mod/modsaucers/'.Auth::user()->id)}}"> Platillos</a>
    </li>
    <li class="nav-item">
            <a class="nav-link" href="{{ url('/mod/modemployes/'.Auth::user()->id) }}">Empleados</a>
        </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('/mod/prize')}}">Premios</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('/mod/recommendation')}}">Recomendaciones</a>
    </li>
    @endauth
@endsection

@section('title')
    @yield('tittle')
@endsection

@section('content')
    @yield('content')    
@endsection

@section('script')
    @yield('script')
@endsection
