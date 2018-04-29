@extends('layouts.app')

@section('opciones_menu')
    <li class="nav-item">
        <a class="nav-link" href="#">Restaurante</a>
    </li>
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