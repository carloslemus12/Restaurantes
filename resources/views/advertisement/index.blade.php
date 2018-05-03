@extends(auth()->check()? (auth()->user()->isAdmin()? 'layouts.admin' : 'layouts.moderator') : 'layouts.app')


@section('title')
    Anuncios
@endsection

@section('content')
<div class="container">
    <div class="row w-100">
        <div class="col w-100 mt-4">
            <div class="card bg-transparent">
                <div class="card-header">
                    <a class="btn btn-success" href="{{ url('/adm/advertisement/create') }}">Crear anuncio</a>
                </div>
                <div class="card-body">
                    <script>var anuncio = {};</script>
                    <table id="tbl_anuncio" class="table table-bordered" style="width:100%">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Codigo</th>
                                <th>Disponible desde</th>
                                <th>Visible hasta</th>
                                <th>Estado</th>
                                <th>Local asignado</th>                                
                                <th> <span class="glyphicon glyphicon-italic"></span>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($anuncios as $anuncio)
                            <tr>
                                <td>{{ 'ANC'.str_repeat("0", 3 - strlen("$anuncio->id") ).$anuncio->id }}</td>
                                <td>{{$anuncio->fecha_inicio}}</td>
                                <td>{{$anuncio->fecha_final}}</td>
                                <td>Habilitado</td>
                                <td>{{($anuncio->restaurante_id == NULL)? 'Anuncio global' : $anuncio->restaurante->departamendo}}</td>

                                <script>
                                    var detalle = {};

                                    detalle['contenido'] = '{{$anuncio->anuncio}}';
                                                                                                            
                                  anuncio[{{ $anuncio->id }}] = detalle;
                                </script>

                                <td class="text-center d-flex justify-content-around">
                                                                        
                                    <a href="{{ url('adm/advertisement/'.$anuncio->id.'/edit') }}"><img src="{{ asset('svg/si-glyph-edit.svg')  }}" style="width:32px;"/></a>

                                    <button type="button" class="btn_detalle p-0 m-0 btn-unstyled" anuncio_id="{{ $anuncio->id }}" data-toggle="modal" data-target="#exampleModalLong">
                                        <img src="{{asset('svg/si-glyph-calendar-1.svg')}}" style="width:32px;"/>
                                    </button>

                                    <form method="POST" action="{{route('advertisement.destroy', $anuncio->id) }}">
                                        {!! csrf_field() !!}

                                        <input type="hidden" name="anuncio" id="anuncio" value="{{ $anuncio->id }}">

                                        <button type="submit" onclick="return confirm('¿Realmente desea eliminar este anuncio?');" class="p-0 m-0 btn-unstyled"><img src="{{ asset('svg/si-glyph-trash.svg')  }}" style="width:32px;"/></button>
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

<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="tittle">Direccion del restaurante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <div class="col-12 col-md-12">
                        <label for="contenido">Contenido del anuncio</label>                        
                        <textarea style="height: 200px; max-height: 200px;" class="form-control" id="contenido" name="contenido" disabled ></textarea>                        

                    </div>

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
                var id = $(this).attr('anuncio_id');

                var informacion = anuncio[id];

                $('#tittle').html("Detalles del anuncio");
                $('#contenido').val(informacion['contenido']);
                
            });
        });
    </script>
@endsection