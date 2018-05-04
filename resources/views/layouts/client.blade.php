@extends('layouts.app')

@section('opciones_menu')
    @auth
    <li class="nav-item">
        <a class="nav-link" href="{{ route('cli.restaurants') }}">Sucursales</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('cli.saucers') }}">Platillos</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Anuncios</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Premios</a>
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