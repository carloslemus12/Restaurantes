@extends('layouts.client')

@section('title')
    Platillos
@endsection

@section('content')
    <div class="container mt-3">
        <div class="card-columns">
            @foreach ($platillos as $platillo)
                <div class="card border-danger mb-3 bg-transparent" style="max-width: 18rem;">
                    <div class="card-header">Platillo: {{ $platillo->platillo }}</div>
                    <div class="card-body bg-transparent text-danger">
                        <h5 class="card-title">
                            <center>
                                @php
                                    $count =  $platillo->votos();
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
                            @if ($platillo->constaintFotos())
                            <center>
                                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">
                                        @php $estado = true; @endphp
                                        @foreach ($platillo->fotos as $foto)
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
                    <a href="{{ route('cli.saucer', $platillo->id) }}" class="btn btn-danger btn-lg btn-block rounded-0 text-white">Ver platillo</a>
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