@extends(auth()->check()? (auth()->user()->isAdmin()? 'layouts.admin' : 'layouts.moderator') : 'layouts.app')

@section('title')
    Modificar {{ 'PTL'.str_repeat("0", 3 - strlen("$platillo->id") ).$platillo->id }}
@endsection

@section('content')
<div class="container">
    <div class="row w-100">
        <div class="col w-100 mt-4">
            <div class="card bg-transparent border-0">
                <div class="card-header bg-transparent border-0">
                    <center><img src="{{ asset('img/croissant.svg')  }}" style="max-width: 200px;" alt=""></center>
                </div>
                <form id="form-platillos" method="POST" action="{{ url('adm/saucer/'.$platillo->id) }}">
                    {!! csrf_field() !!}

                    <input type="hidden" name="_method" value="PUT">

                    <div class="card-body bg-dark text-white">
                         <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <label for="nombre">Nombre del platillo</label>
                                <input type="text" class="form-control" id="nombre" value="{{$platillo->platillo}}" name="nombre" placeholder="Nombre">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="descripcion">Descripcion del platillo</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{$platillo->descripcion}}" placeholder="Descripcion">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <label for="precio">Precio del platillo</label>
                                <input type="number" class="form-control" value="{{$platillo->precio}}" id="precio" name="precio" placeholder="Precio">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="tipo">Tipo del platillo</label>                                
                                <select class="form-control" id="tipo" name="tipo">
                                    @foreach($tipos as $tipo)
                                        @if($tipo->id==$platillo->tipo_id)
                                        <option value="{{$tipo->id}}" selected="true">
                                            {{$tipo->tipo_platillo}}</option>
                                        @else
                                        <option value="{{$tipo->id}}">
                                            {{$tipo->tipo_platillo}}</option>
                                        @endif                                    
                                    @endforeach                                                                    
                                </select>
                            </div>                            
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <label for="especialidad">Especialidad</label>
                                <select class="form-control" id="especialidad" name="especialidad">
                                    @if($platillo->especialidad==1)
                                    <option value="1" selected="true">Si</option>
                                    <option value="0">No</option>
                                    @else
                                    <option value="1">Si</option>
                                    <option value="0" selected="true">No</option>
                                    @endif

                                </select>
                            </div>
                           
                        </div>
                    </div>
                    <div class="card-footer bg-transparent p-0 d-flex justify-content-between">
                        <div class="btn-group p-0 pb-2 pl-2 m-0" role="group" aria-label="Basic example">
                            <button type="submit" class="btn btn-success">Modificar</button>
                            <button type="reset" class="btn btn-danger">Limpiar</button>
                        </div>
                    </form>

                </div>
            </div>
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

            $('#form-platillos').validate({
                rules: {
                    nombre: {
                        required: true,
                        empty: true,
                        lenght: true
                    },
                    descripcion: {
                        required: true,
                        empty: true,
                        lenght: true
                    },
                    precio: {
                        required: true,
                        empty: true,
                        lenght: false
                    },                    
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection