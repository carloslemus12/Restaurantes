@extends('layouts.app')

@section('opciones_menu')
    @auth
    <li class="nav-item">
        <a class="nav-link" href="{{ url('/adm/restaurant') }}">Restaurante</a>
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