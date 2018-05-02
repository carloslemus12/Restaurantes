@extends('layouts.app')

@section('opciones_menu')
    @auth
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/adm/restaurant') }}">Restaurante</a>
    </li>
    <li class="nav-item">
            <a class="nav-link" href="{{ route('adm.statistic') }}">Estadisticas</a>
        </li>
    <li class="nav-item">
        <a class="nav-link" href="{{url('/adm/saucer')}}">Platillos</a>
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