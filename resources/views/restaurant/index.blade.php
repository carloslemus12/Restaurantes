@extends(auth()->check()? (auth()->user()->isAdmin()? 'layouts.admin' : 'layouts.moderator') : 'layouts.app')

@section('title')
    Restaurantes
@endsection

@section('content')
<div class="container">
    <div class="row w-100">
        <div class="col w-100 mt-4">
            <div class="card bg-transparent">
                <div class="card-header">
                    <a class="btn btn-success" href="{{ url('/adm/restaurant/create') }}">Registrar restaurante</a>
                </div>
                <div class="card-body">
                    <script>var restaurante = {};</script>
                    <table id="tbl_restaurante" class="table table-bordered" style="width:100%">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Codigo</th>
                                <th>Estado</th>
                                <th>Apertura</th>
                                <th>Actualizacion</th>
                                <th> <span class="glyphicon glyphicon-italic"></span>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($restaurantes as $restaurante)
                            <tr>
                                <td>{{ substr(strtoupper(trim($restaurante->departamendo)), 0, 3).str_repeat("0", 3 - strlen("$restaurante->id") ).$restaurante->id }}</td>
                                <td>{{ ($restaurante->estado == 1)? 'Habilitado' : 'Desabilitado' }}</td>
                                <td>{{ date('d/m/y',strtotime($restaurante->created_at)) }}</td>
                                <td>{{ date('d/m/y',strtotime($restaurante->updated_at)) }}</td>

                                <script>
                                    var direccion = {};

                                    direccion['codigo'] = '{{ substr(strtoupper(trim($restaurante->departamendo)), 0, 3).str_repeat("0", 3 - strlen("$restaurante->id") ).$restaurante->id }}';
                                    direccion['departamento'] = '{{ $restaurante->departamendo }}';
                                    direccion['municipio'] = '{{ $restaurante->municipio }}';
                                    direccion['ciudad'] = '{{ $restaurante->ciudad }}';
                                    direccion['calle'] = '{{ $restaurante->calle }}';

                                    restaurante[{{ $restaurante->id }}] = direccion;
                                </script>

                                <td class="text-center d-flex justify-content-around">
                                    <a href="{{ url('adm/restaurant/'.$restaurante->id) }}"><img src="{{ asset('svg/si-glyph-picture.svg')  }}" style="width:32px;"/></a>
                                    
                                    <a href="{{ url('adm/restaurant/'.$restaurante->id.'/edit') }}"><img src="{{ asset('svg/si-glyph-edit.svg')  }}" style="width:32px;"/></a>

                                    <button type="button" class="btn_direccion p-0 m-0 btn-unstyled" restaurante_id="{{ $restaurante->id }}" data-toggle="modal" data-target="#exampleModalLong">
                                        <img src="{{ asset('svg/si-glyph-subway.svg')  }}" style="width:32px;"/>
                                    </button>

                                    <form method="POST" action="{{ url('adm/restaurant/'.$restaurante->id) }}">
                                        {!! csrf_field() !!}

                                        <input type="hidden" name="_method" value="DELETE">

                                        <button type="submit" onclick="return confirm('¿Realmente desea eliminar este local?');" class="p-0 m-0 btn-unstyled"><img src="{{ asset('svg/si-glyph-trash.svg')  }}" style="width:32px;"/></button>
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
                    <div class="col-12 col-md-6">
                        <label for="departamento">Departamento del restaurante</label>
                        <input type="text" class="form-control" id="departamento" name="departamento" placeholder="Departamento" disabled>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="municipio">Municipio del restaurante</label>
                        <input type="text" class="form-control" id="municipio" name="municipio" placeholder="Municipio" disabled>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-12 col-md-6">
                        <label for="ciudad">Ciudad del restaurante</label>
                        <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad" disabled>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="calle">Calle del restaurante</label>
                        <input type="text" class="form-control" id="calle" name="calle" placeholder="Calle" disabled>
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
            $('#tbl_restaurante').DataTable();

            $('.btn_direccion').click(function(){
                var id = $(this).attr('restaurante_id');

                var informacion = restaurante[id];

                $('#tittle').html("Direccion sucursal: " + informacion['codigo']);
                $('#departamento').val(informacion['departamento']);
                $('#municipio').val(informacion['municipio']);
                $('#ciudad').val(informacion['ciudad']);
                $('#calle').val(informacion['calle']);
            });
        });
    </script>
@endsection