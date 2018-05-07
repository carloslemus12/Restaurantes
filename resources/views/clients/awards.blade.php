@extends('layouts.client')

@section('title')
    Premios
@endsection

@section('content')
    
    <div class="container">

        @foreach ($premios as $premio)
            
            <div class="jumbotron">
                <h2 class="display-6">
                    {{ $premio->tipo }}
                </h2>
                <h1 class="display-4">
                    {{ $premio->premio }}
                </h1>
                <hr class="my-4">
                <p class="lead">
                    {{ $premio->descripcion }}
                </p>
                <p>
                    Premio valido hasta {{ $premio->created_at }}
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