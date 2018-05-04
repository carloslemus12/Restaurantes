@extends('layouts.client')

@section('title')
    Sucursal {{ $restaurante->codigo() }}
@endsection

@section('content')
    <div class="container-fluid" style="background: url({{ asset('img/back.jpg') }})">
        <div class="row p-5">
            <div class="col-12 col-md-4">
                @if ($restaurante->constaintFotos())
                <div id="carouselExampleControls" class="carousel slide border border-white rounded" data-ride="carousel">
                    <div class="carousel-inner">
                        @php $estado = true; @endphp
                        @foreach ($restaurante->fotos as $foto)
                        <div class="carousel-item {{ ($estado)? 'active':'' }}">
                            <img class="bg-transparent" src="{{ asset('storage/'.$foto->foto) }}" style="width: 100%;height:20rem;" />
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
                @else
                <center>
                    <img class="bg-transparent" src="{{ asset('img/store.svg') }}" style="width: 100%;height:20rem;" />
                </center>
                @endif
            </div>
            <div class="col-12 col-md-8">
                <center><h2 class="text-white">Sucursal #{{ $restaurante->codigo() }}</h2></center>

                <div class="text-white mt-md-5">
                    <div class="form-group row">
                        <div class="col-12 col-md-6">
                            <label for="departamento">Departamento del restaurante</label>
                            <input type="text" disabled class="form-control" value="{{ $restaurante->departamendo }}" id="departamento" name="departamento" placeholder="Departamento">
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="municipio">Municipio del restaurante</label>
                            <input type="text" disabled class="form-control" id="municipio" value="{{ $restaurante->municipio }}" name="municipio" placeholder="Municipio">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12 col-md-6">
                            <label for="ciudad">Ciudad del restaurante</label>
                            <input type="text" disabled class="form-control" id="ciudad" value="{{ $restaurante->ciudad }}" name="ciudad" placeholder="Ciudad">
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="calle">Calle del restaurante</label>
                            <input type="text" disabled class="form-control" id="calle" value="{{ $restaurante->calle }}" name="calle" placeholder="Calle">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pb-2">
            <div class="col">
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
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card text-center bg-transparent">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="ml-2" id="li_star">
                                <center>
                                @php
                                    $cont =  auth()->user()->votacionRestauranteId($restaurante->id);
                                @endphp
                                
                                @for ($i = 0; $i < $cont; $i++)
                                    <img star="{{ $i + 1 }}" class="star" src="{{ asset('img/favorite.png') }}" />
                                @endfor
                                
                                @for ($i = $cont; $i < 5; $i++)
                                    <img star="{{ $i + 1 }}" class="star" src="{{ asset('img/dislike.png') }}" />
                                @endfor
                                </center>
                            </li>
                            <li class="nav-item ml-0 ml-md-4">
                                <a id="btn_chat" class="nav-link active" href="#"><img src="{{ asset('img/chat.png') }}" /></a>
                            </li>
                            <li class="nav-item">
                                <a id="btn_box" class="nav-link" href="#"><img src="{{ asset('img/box.png') }}" /></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="modal" data-target="#exampleModal" href="#"><img src="{{ asset('img/diet.png') }}" /></a>
                            </li>
                        </ul>
                    </div>
                    <div id="cont" class="card-body">
                        <ul id="list-comments" class="list-group">
                        @foreach ($restaurante->comentarios as $comentario)
                            @if ($comentario->usuario_id == auth()->user()->id)
                            <li class="list-group-item d-flex justify-content-between">{{ $comentario->comentario }}<img comentario={{ $comentario->id }} id="btn_delete" src="{{ asset('img/quit.png') }}" /></li>
                            @else
                            <li class="list-group-item left-align">{{ $comentario->comentario }}</li>
                            @endif
                        @endforeach
                        <script>
                            $('#btn_delete').on('click', function(){
                                var comentario = $('#coment').val();

                                var url = "{{ url('/cli/restaurant/comment/delete') }}/"+$(this).attr("comentario");
                                
                                $.post(url, { _token:"{{ csrf_token() }}" },function(){
                                    $( "#list-comments" ).load( "{{ route('cli.commentslight', $restaurante->id) }}");
                                });
                            });
                        </script>
                        </ul>

                        <div class="input-group mb-3">
                            <input id="coment" type="text" class="form-control" placeholder="Comentario" aria-label="Comentario" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button id="comentario" class="btn btn-outline-dark" type="button"><img src="{{ asset('img/send.png') }}" /></button>
                            </div>
                        </div>

                        <script>
                            $('#comentario').on('click', function(){
                                var comentario = $('#coment').val();

                                var url = "{{ route('cli.restaurantComment', $restaurante->id) }}";
                                
                                $.post(url, { usuario: {{ auth()->user()->id }}, comentario:comentario, _token:"{{ csrf_token() }}" }, function(){
                                    $( "#list-comments" ).load( "{{ route('cli.commentslight', $restaurante->id) }}");
                                    $('#coment').val("");
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Lista de platillos</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        @foreach ($restaurante->platillos as $platillo)
                        <li class="list-group-item"><a href="#" >{{ $platillo->platillo }} [{{$platillo->tipoPlatillo->tipo_platillo}}]</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('.carousel').carousel();

            $(document).on( "click", ".star", function(){
                var star = $(this).attr('star');

                var url = "{{ route('cli.start', $restaurante->id) }}";

                $.post(url, { usuario: {{ auth()->user()->id }}, star:star, _token:"{{ csrf_token() }}" }, function(){
                    var str = "<center>";
                    for (var i = 0; i < star; i++) {
                        str+= "<img star=\"" + (i + 1) + "\" class=\"star\" src=\"{{ asset('img/favorite.png') }}\" />";
                    }
                    
                    for (var i = star; i < 5; i++){
                        str += "<img star=\"" + (i + 1) + "\" class=\"star\" src=\"{{ asset('img/dislike.png') }}\" />";
                    }
                    str += "</center>";
                    $('#li_star').html(str);
                });
            });

            $('#btn_chat').on('click', function(){
                if (!$('#btn_chat').hasClass('active')){
                    $('#btn_chat').addClass('active');
                    $('#btn_box').removeClass('active');

                    $( "#cont" ).load( "{{ route('cli.comments', $restaurante->id) }}");
                }
                return false;
            });

            $('#btn_box').on('click', function(){
                if (!$('#btn_box').hasClass('active')){
                    $('#btn_box').addClass('active');
                    $('#btn_chat').removeClass('active');
                    
                    $( "#cont" ).load( "{{ route('cli.recommendations', $restaurante->id) }}");
                }
                return false;
            });
        });
    </script>
@endsection