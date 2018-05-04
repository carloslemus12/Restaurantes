@extends(auth()->check()? (auth()->user()->isAdmin()? 'layouts.admin' : 'layouts.moderator') : 'layouts.app')

@section('title')
    Registrar platillos
@endsection

@section('content')
<div class="container">
    <div class="row w-100">
        <div class="col w-100 mt-4">
            <div class="card bg-transparent border-0">
                <div class="card-header bg-transparent border-0">
                    <center><img src="{{ asset('img/food.svg') }}" style="max-width: 200px;" alt=""></center>
                </div>
                <form id="form-platillos" method="POST" action="{{ url('mod/modsaucers') }}">
                    {!! csrf_field() !!}

                    <div class="card-body bg-dark text-white">
                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <label for="nombre">Nombre del platillo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="descripcion">Descripcion del platillo</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <label for="precio">Precio del platillo</label>
                                <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="tipo">Tipo del platillo</label>                                
                                <select class="form-control" id="tipo" name="tipo">
                                    @foreach($tipos as $tipo)
                                        <option value="{{$tipo->id}}">{{$tipo->tipo_platillo}}</option>
                                    @endforeach                                                                    
                                </select>
                            </div>                            
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <label for="especialidad">Especialidad</label>
                                <select class="form-control" id="especialidad" name="especialidad">
                                    <option value="1">Si</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <input type="text" name="sucursal" id="sucursal" hidden="true" value="{{Auth::user()->id}}">						                           
                        </div>
                    </div>
                    <div class="card-footer bg-transparent p-0">
                        <div class="btn-group p-0 pb-2 pl-2 m-0" role="group" aria-label="Basic example">
                            <button type="submit" class="btn btn-success">Registrar</button>
                            <button type="reset" class="btn btn-danger">Limpiar</button>
                        </div>
                    </div>
                </form>
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
                return value.trim().length >= 10;
            }, "Min character 10");

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