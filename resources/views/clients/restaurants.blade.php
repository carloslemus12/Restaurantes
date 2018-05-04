@extends('layouts.client')

@section('title')
    Sucursales
@endsection

@section('content')
    <div class="container mt-3">
        <div class="card-columns">
            @foreach ($restaurantes as $restaurante)
                <div class="card border-danger mb-3 bg-transparent" style="max-width: 18rem;">
                    <div class="card-header">Sucursal: {{ $restaurante->codigo() }}</div>
                    <div class="card-body bg-transparent text-danger">
                        <h5 class="card-title">
                            <center>
                                @php
                                    $count =  $restaurante->votos();
                                @endphp
                                
                                @for ($i = 0; $i < $count; $i++)
                                    <img src="{{ asset('img/favorite.png') }}" />
                                @endfor
                                
                                @for ($i = 0; $i < (5 -$count); $i++)
                                    <img src="{{ asset('img/dislike.png') }}" />
                                @endfor
                            </center>
                        </h5>
                        <div class="card-text">
                            @if ($restaurante->constaintFotos())
                            <center>
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @php $estado = true; @endphp
                                        @foreach ($restaurante->fotos as $foto)
                                        <div class="carousel-item {{ ($estado)? 'active':'' }}">
                                            <img class="border border-white bg-transparent" src="{{ asset('storage/'.$foto->foto) }}" style="width: 100%;height:14rem;" />
                                        </div>
                                        @php $estado = false; @endphp
                                        @endforeach
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div> 
                            </center>
                            @else
                            <center>
                                <img class="border border-white bg-transparent" src="{{ asset('img/store.svg') }}" style="width: 100%;height:14rem;" />
                            </center>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('cli.restaurant', $restaurante->id) }}" class="btn btn-danger btn-lg btn-block rounded-0 text-white">Ver restaurante</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('.carousel').carousel();
        });
    </script>
@endsection