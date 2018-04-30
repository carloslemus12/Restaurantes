@extends(auth()->check()? (auth()->user()->isAdmin()? 'layouts.admin' : 'layouts.moderator') : 'layouts.app')

@section('title')
    Modificar {{ substr(strtoupper(trim($restaurante->departamendo)), 0, 3).str_repeat("0", 3 - strlen("$restaurante->id") ).$restaurante->id }}
@endsection

@section('content')
<div class="container">
    <div class="row w-100">
        <div class="col w-100 mt-4">
            <div class="card bg-transparent border-0">
                <div class="card-header bg-transparent border-0">
                    <center><img src="{{ asset('img/croissant.svg')  }}" style="max-width: 200px;" alt=""></center>
                </div>
                <form id="form-restaurante" method="POST" action="{{ url('adm/restaurant/'.$restaurante->id) }}">
                    {!! csrf_field() !!}

                    <input type="hidden" name="_method" value="PUT">

                    <div class="card-body bg-dark text-white">
                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <label for="departamento">Departamento del restaurante</label>
                                <input type="text" class="form-control" value="{{ $restaurante->departamendo }}" id="departamento" name="departamento" placeholder="Departamento">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="municipio">Municipio del restaurante</label>
                                <input type="text" class="form-control" id="municipio" value="{{ $restaurante->municipio }}" name="municipio" placeholder="Municipio">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <label for="ciudad">Ciudad del restaurante</label>
                                <input type="text" class="form-control" id="ciudad" value="{{ $restaurante->ciudad }}" name="ciudad" placeholder="Ciudad">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="calle">Calle del restaurante</label>
                                <input type="text" class="form-control" id="calle" value="{{ $restaurante->calle }}" name="calle" placeholder="Calle">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent p-0 d-flex justify-content-between">
                        <div class="btn-group p-0 pb-2 pl-2 m-0" role="group" aria-label="Basic example">
                            <button type="submit" class="btn btn-success">Modificar</button>
                            <button type="reset" class="btn btn-danger">Limpiar</button>
                        </div>
                    </form>

                    @if ($restaurante->constaintSinPlatillos())
                        <div class="col-auto">
                            <label class="sr-only" for="inlineFormInputGroup">Username</label>
                            <form method="POST" action="{{ route('saucers.add', $restaurante->id) }}">
                                {!! csrf_field() !!}
    
                                <div class="input-group mb-2">
                                    <select class="form-control" name="platillo">
                                        @foreach ($restaurante->sinPlatillos() as $platillo)
                                            <option value="{{ $platillo->id }}">{{ $platillo->platillo }}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-prepend">
                                        <button type="submit" class="btn btn-success">Añadir</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table id="tbl_platillo" class="table table-bordered" style="width:100%">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>Platillo</th>
                        <th>Descripcion</th>
                        <th>Tipo</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($restaurante->platillos as $platillo)
                    <tr>
                        <td>{{ $platillo->platillo }}</td>
                        <td>{{ $platillo->descripcion }}</td>
                        <td>{{ $platillo->tipoPlatillo->tipo_platillo }}</td>
            
                        <td class="d-flex justify-content-center">
                            <form method="POST" action="{{ route('saucers.remove', $restaurante->id) }}">
                                {!! csrf_field() !!}

                                <input type="hidden" name="platillo" value="{{ $platillo->id }}">

                                <button type="submit" class="p-0 m-0 btn-unstyled"><img src="{{ asset('svg/si-glyph-delete.svg')  }}" style="width:32px;"/></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('script')
    <script>
        $(document).ready(function(){
            jQuery.validator.addMethod("empty", function(value, element, params) {
                return value.trim() != "";
            }, "No empty value");

            jQuery.validator.addMethod("lenght", function(value, element, params) {
                return value.trim().length >= 7;
            }, "Min character 7");

            $('#form-restaurante').validate({
                rules: {
                    departamento: {
                        required: true,
                        empty: true,
                        lenght: true
                    },
                    municipio: {
                        required: true,
                        empty: true,
                        lenght: true
                    },
                    ciudad: {
                        required: true,
                        empty: true,
                        lenght: true
                    },
                    calle: {
                        required: true,
                        empty: true,
                        lenght: true
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection