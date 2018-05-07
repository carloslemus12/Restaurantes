@extends('layouts.client')

@section('title')
    Anuncios
@endsection

@section('content')
    
    <div class="container">

        @foreach ($anuncios as $anuncio)
            
            <div class="jumbotron">
                <h1 class="display-4">
                    {{ isset($anuncio->restaurante_id)? "Sucurcal #".$anuncio->restaurante->codigo() : "Anuncio global" }}
                </h1>
                <p class="lead">
                    {{ $anuncio->anuncio }}
                </p>
                <hr class="my-4">
                <p>
                    Anuncio valido desde {{ $anuncio->fecha_inicio }} hasta {{ $anuncio->fecha_final }}
                </p>
            </div>

        @endforeach

    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            
        });
    </script>
@endsection