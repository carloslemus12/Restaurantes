@extends(auth()->check()? (auth()->user()->isAdmin()? 'layouts.admin' : 'layouts.moderator') : 'layouts.app')


@section('title')
    Premios
@endsection

@section('content')
<div class="container">
    <div class="row w-100">
        <div class="col w-100 mt-4">
            <div class="card bg-transparent">
                <div class="card-header">
                    <a class="btn btn-success" href="{{ url('/adm/gifts/create') }}">Crear premios</a>
                </div>
                <div class="card-body">
                    <script>var premios = {};</script>
                    <table id="tbl_anuncio" class="table table-bordered" style="width:100%">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>premio</th>
                                <th>Fecha</th>
                                <th>tipo premio</th>
                                <th>descripcion</th>                          
                                <th> <span class="glyphicon glyphicon-italic"></span>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($premios as $premios)
                            <tr>
                                <td>{{$premios->premio}}</td>
                                <td>{{$premios->dia}} / {{$premios->mes}} / {{$premios->anio}}</td>
                                <td>{{$premios->tipo_premio_id}}</td>
                                <td>{{$premios->descripcion}}</td>

                                <script>
                                    var detalle = {};

                                    detalle['contenido'] = '{{$premios->premios}}';
                                                                                                            
                                  premios[{{ $premios->id }}] = detalle;
                                </script>

                                <td class="text-center d-flex justify-content-around">
                                                                        
                                    <form method="POST" action="{{route('gifts.destroy', $premios->id) }}">
                                        {!! csrf_field() !!}

                                        <input type="hidden" name="premios" id="premios" value="{{ $premios->id }}">

                                        <button type="submit" onclick="return confirm('¿Realmente desea eliminar este premio?');" class="p-0 m-0 btn-unstyled"><img src="{{ asset('svg/si-glyph-trash.svg')  }}" style="width:32px;"/></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#tbl_anuncio').DataTable();

            $('.btn_detalle').click(function(){
                var id = $(this).attr('premio_id');

                var informacion = premios[id];

                $('#tittle').html("Detalles del premios");
                $('#contenido').val(informacion['contenido']);
                
            });
        });
    </script>
@endsection