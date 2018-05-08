@extends(auth()->check()? (auth()->user()->isAdmin()? 'layouts.admin' : 'layouts.moderator') : 'layouts.app')


@section('title')
    Crear Premio
@endsection

@section('content')
<div class="container">
    <div class="row w-100">
        <div class="col w-100 mt-4">
            <div class="card bg-transparent border-0">
                <div class="card-header bg-transparent border-0">
                    <center><img src="{{ asset('img/panel.svg')  }}" style="max-width: 200px;" alt=""></center>
                </div>
                <form id="form-premio" method="POST" action="{{ url('adm/gifts') }}">
                    {!! csrf_field() !!}

                    <div class="card-body bg-dark text-white">
                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <label for="nombre">Nombre del premio</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="">
                            </div>

                            <div class="col-12 col-md-1">
                                <label for="descripcion">dia</label>
                                <input type="number" min="1" max="31" class="form-control" id="dia" name="dia" placeholder="">
                            </div>
                            <div class="col-12 col-md-1">
                                <label for="descripcion">mes</label>
                                <input type="number" class="form-control" id="mes" name="mes" min="1" max="12" placeholder="">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="descripcion">año</label>
                                <input type="number" class="form-control" id="año" name="año" min="2019" placeholder="">
                            </div>
                            <div class="col-12 col-md-12">
                                <label for="precio">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="descripcion">
                            </div>
                        </div>                    

                        <div class="form-group row">

                        	<div class="col-12 col-md-6">
                                <label for="sucursal">tipo premio</label>
                                <select class="form-control" id="sucursal" name="sucursal">
                                	@foreach($tipo as $tipo)
                                		<option value="{{$tipo->id}}">{{$tipo->tipo}}</option>
                                	@endforeach
                                </select>
                            </div>                                     
                        </div>
                        <div class="card-footer bg-transparent p-0">
                        <div class="btn-group p-0 pb-2 pl-2 m-0" role="group" aria-label="Basic example">
                            <button type="submit" class="btn btn-success">Registrar</button>
                            <button type="reset" class="btn btn-danger">Limpiar</button>
                        </div>
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
            jQuery.validator.addMethod("range",function(value,element){
            	var endDate = $('#fecha').val();
				return Date.parse(endDate) > Date.now();
			}, "date must be higher that today");

            $('#form-premio').validate({
                rules: {
                    contenido: {
                        required: true,
                        empty: true,
                        lenght: true,
                        range:false
                    },
                     fecha: {
                        required: true,
                        empty: false,
                        lenght: false,
                        range:true
                    },                                  
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection