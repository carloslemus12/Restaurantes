@extends(auth()->check()? (auth()->user()->isAdmin()? 'layouts.admin' : 'layouts.moderator') : 'layouts.app')

@section('title')
    Estadisticas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row px-md-5 mt-3">
            <div class="col d-md-flex justify-content-between">
                <div class="card text-white bg-primary mb-3" style="width: 18rem;">
                    <div class="card-header text-center">Restaurante mas votados</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $restaurante_votos->codigo() }}</h5>
                        <div class="w-100 d-flex justify-content-center">
                            @if ($restaurante_votos->constaintFotos())
                                <img class="border border-white bg-dark" src="{{ asset('storage/'.$restaurante_votos->fotos[0]->foto) }}" style="width: 10rem;height: 10rem;" />
                            @else
                                <img class="border border-white bg-dark" src="{{ asset('img/store.svg') }}" style="width: 10rem;height: 10rem;" />
                            @endif
                        </div>
                        <img src="{{ asset('img/favorite.png') }}" class="mr-1"/>: {{ $restaurante_votos->votos }}
                    </div>
                </div>

                <div class="card text-white bg-secondary mb-3 ml-md-2" style="width: 18rem;">
                    <div class="card-header text-center">Platillo mas votado</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $platillo_votos->platillo }}</h5>
                        <div class="w-100 d-flex justify-content-center">
                            @if ($platillo_votos->constaintFotos())
                                <img class="border border-white bg-info" src="{{ asset('storage/'.$platillo_votos->fotos[0]->foto) }}" style="width: 10rem;height: 10rem;" />
                            @else
                                <img class="border border-white bg-info" src="{{ asset('img/food.svg') }}" style="width: 10rem;height: 10rem;" />
                            @endif
                        </div>
                        <img src="{{ asset('img/favorite.png') }}" class="mr-1"/>: {{ $platillo_votos->votos }}
                    </div>
                </div>

                <div class="card text-white bg-danger mb-3 ml-md-2" style="width: 18rem;">
                    <div class="card-header text-center">Restaurante mas comendado</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $restaurante_comentarios->codigo() }}</h5>
                        <div class="w-100 d-flex justify-content-center">
                            @if ($restaurante_comentarios->constaintFotos())
                                <img class="border border-white bg-dark" src="{{ asset('storage/'.$restaurante_comentarios->fotos[0]->foto) }}" style="width: 10rem;height: 10rem;" />
                            @else
                                <img class="border border-white bg-dark" src="{{ asset('img/store.svg') }}" style="width: 10rem;height: 10rem;" />
                            @endif
                        </div>
                        <img src="{{ asset('img/chat.png') }}" class="mr-1" />: {{ $restaurante_comentarios->comentarios }}
                    </div>
                </div>

                <div class="card text-white bg-dark mb-3 ml-md-2" style="width: 18rem;">
                    <div class="card-header text-center">Platillo mas comendado</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $platillo_comentarios->platillo }}</h5>
                        <div class="w-100 d-flex justify-content-center">
                            @if ($platillo_comentarios->constaintFotos())
                                <img class="border border-white bg-info" src="{{ asset('storage/'.$platillo_comentarios->fotos[0]->foto) }}" style="width: 10rem;height: 10rem;" />
                            @else
                                <img class="border border-white bg-info" src="{{ asset('img/food.svg') }}" style="width: 10rem;height: 10rem;" />
                            @endif
                        </div>
                        <img src="{{ asset('img/chat.png') }}" class="mr-1"/>: {{ $platillo_comentarios->comentarios }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card text-center">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('restaurant.statistic') }}">Restaurantes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('saucers.statistic') }}">Platillos</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <table id="tbl_restaurante" class="table table-light table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Sucursal</th>
                            <th scope="col">Votaciones</th>
                            <th scope="col">Informacion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <script>
                            var comentarios = {};
                            var comentarios_usuario = {};

                            var recomendaciones = {};
                            var recomendaciones_usuario = {};
                        </script>
                        @foreach ($restaurantes as $restaurante)
                            <tr>
                                <th scope="row">{{ $restaurante->codigo() }}</th>
                                <td>
                                    @php
                                        $count =  $restaurante->votos();
                                    @endphp
                                    
                                    <script> 
                                        comentarios['{{ $restaurante->id }}'] = @json($restaurante->comentarios);
                                        
                                        @foreach ($restaurante->comentarios as $comentario)
                                            comentarios_usuario['{{ $comentario->id }}'] = @json($comentario->usuario);                                       
                                        @endforeach

                                        recomendaciones['{{ $restaurante->id }}'] = @json($restaurante->recomendaciones);
                                        
                                        @foreach ($restaurante->recomendaciones as $recomendaciones)
                                            recomendaciones_usuario['{{ $recomendaciones->id }}'] = @json($recomendaciones->usuario);                                       
                                        @endforeach

                                    </script>
                                    @for ($i = 0; $i < $count; $i++)
                                        <img src="{{ asset('img/favorite.png') }}" />
                                    @endfor
                                    @for ($i = 0; $i < (5 -$count); $i++)
                                        <img src="{{ asset('img/dislike.png') }}" />
                                    @endfor
                                </td>
                                <td>
                                    <button id="btn_chat" restaurante="{{ $restaurante->id }}" type="button" class="btn btn-primary bg-transparent" data-toggle="modal" data-target="#modal_chat">
                                        <img src="{{ asset('img/chat.png') }}" />
                                    </button>
                                    <button id="btn_box" restaurante="{{ $restaurante->id }}" type="button" class="btn btn-dark bg-transparent" data-toggle="modal" data-target="#modal_box">
                                        <img src="{{ asset('img/box.png') }}" />
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_box" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Recomendaciones</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="list-group pt-0" id="list_box">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_chat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Comentarios</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="list-group pt-0" id="list_chat">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#tbl_restaurante').DataTable();

            $('#btn_chat').click(function () {
                $('#list_chat').html("");
                var item = "";
                $.each(comentarios[$(this).attr('restaurante')], function( index, value ) {
                    item += '<span class="mt-3 list-group-item list-group-item-action flex-column align-items-start active">';
                    item += '<div class="d-flex w-100 justify-content-between">';
                    item += '<h5 class="mb-1">' + comentarios_usuario[value.id].username +  '</h5>';
                    item += '<small>' + value.created_at + '</small>';
                    item += '</div>';
                    item += '<p class="mb-1">' + value.comentario + '</p>';
                    item += '</span>';
                });
                $('#list_chat').html(item);
            });

            $('#btn_box').click(function () {
                $('#list_box').html("");
                var item = "";
                $.each(recomendaciones[$(this).attr('restaurante')], function( index, value ) {
                    item += '<span class="mt-3 list-group-item list-group-item-action flex-column align-items-start active bg-success border-success">';
                    item += '<div class="d-flex w-100 justify-content-between">';
                    item += '<h5 class="mb-1">' + recomendaciones_usuario[value.id].username +  '</h5>';
                    item += '<small>' + value.created_at + '</small>';
                    item += '</div>';
                    item += '<p class="mb-1">' + value.recomendacion + '</p>';
                    item += '</span>';
                });
                $('#list_box').html(item);
            });
        });
    </script>
@endsection