@extends(auth()->check()? (auth()->user()->isAdmin()? 'layouts.admin' : 'layouts.moderator') : 'layouts.app')


@section('title')
    Platillos
@endsection

@section('content')
<div class="container">
    <div class="row w-100">
        <div class="col w-100 mt-4">
            <div class="card bg-transparent">
                <div class="card-header">
                    <a class="btn btn-success" href="{{url('/mod/modsaucer/create')}}">Registrar platillo</a>
                </div>
                <div class="card-body">
                    <script>var platillo = {};</script>
                    <table id="tbl_platillo" class="table table-bordered" style="width:100%">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Codigo</th>
                                <th>Platillo</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Precio</th>                                
                                <th> <span class="glyphicon glyphicon-italic"></span>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($platillos as $platillo)
                            <tr>
                                <td>{{ 'PTL'.str_repeat("0", 3 - strlen("$platillo->id") ).$platillo->id }}</td>
                                <td>{{$platillo->platillo}}</td>
                                <td>{{$platillo->tipo_platillo}}</td>
                                <td>{{($platillo->estado == 1)? 'Habilitado' : 'Desabilitado' }}</td>
                                <td>${{$platillo->precio}}</td>

                                <script>
                                    var detalle = {};

                                    detalle['descripcion'] = '{{$platillo->descripcion}}';
                                    detalle['especialidad'] = '{{($platillo->especialidad==1)? "Si" : "No"}}';                                      
                                  platillo[{{ $platillo->id }}] = detalle;
                                </script>

                                <td class="text-center d-flex justify-content-around">
                                    <a href="{{ url('mod/modsaucer/'.$platillo->id) }}"><img src="{{ asset('svg/si-glyph-picture.svg')  }}" style="width:32px;"/></a>

                                    <a href="{{url('mod/modsaucers/comments/'.$platillo->id)}}"><img src="{{ asset('svg/si-glyph-bubble-message.svg')  }}" style="width:32px;"/></a>          

                                    <a href="{{ url('mod/modsaucers/'.$platillo->id.'/edit') }}"><img src="{{ asset('svg/si-glyph-edit.svg')  }}" style="width:32px;"/></a>

                                    <button type="button" class="btn_detalle p-0 m-0 btn-unstyled" platillo_id="{{ $platillo->id }}" data-toggle="modal" data-target="#exampleModalLong">
                                        <img src="{{asset('svg/si-glyph-bread.svg')}}" style="width:32px;"/>
                                    </button>

                                    <form method="POST" action="{{route('modsaucer.destroy', $platillo->id) }}">
                                        {!! csrf_field() !!}
                                        

                                        <input type="hidden" name="sucursal" id="sucursal" value="{{Auth::user()->id}}">

                                        
                                        <button type="submit" onclick="return confirm('¿Realmente desea eliminar este platillo?');" class="p-0 m-0 btn-unstyled"><img src="{{ asset('svg/si-glyph-trash.svg')  }}" style="width:32px;"/></button>
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
                        <label for="departamento">Descripcion del platillo</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="descripcion" disabled>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="municipio">Especialidad del restaurante</label>
                        <input type="text" class="form-control" id="especialidad" name="especialidad" placeholder="especialidad" disabled>
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
            $('#tbl_platillo').DataTable();

            $('.btn_detalle').click(function(){
                var id = $(this).attr('platillo_id');

                var informacion = platillo[id];

                $('#tittle').html("Detalles del platillo");
                $('#descripcion').val(informacion['descripcion']);
                $('#especialidad').val(informacion['especialidad']);                
            });
        });
    </script>
@endsection