@extends(auth()->check()? (auth()->user()->isAdmin()? 'layouts.admin' : 'layouts.moderator') : 'layouts.app')


@section('title')
    Crear Anuncio
@endsection

@section('content')
<div class="container">
    <div class="row w-100">
        <div class="col w-100 mt-4">
            <div class="card bg-transparent border-0">
                <div class="card-header bg-transparent border-0">
                    <center><img src="{{ asset('img/panel.svg')  }}" style="max-width: 200px;" alt=""></center>
                </div>
                <form id="form-anuncio" method="POST" action="{{ url('adm/advertisement') }}">
                    {!! csrf_field() !!}

                    <div class="card-body bg-dark text-white">
                        <div class="form-group row">
                            <div class="col-12 col-md-12">
                                <label for="contenido">Contenido del anuncio</label>
                                <textarea style="height: 90px; max-height: 90px;" class="form-control" id="contenido" name="contenido" placeholder="Contenido"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">

                        	<div class="col-12 col-md-6">
                                <label for="sucursal">Anuncio dirigido a </label>
                                <select class="form-control" id="sucursal" name="sucursal">
                                	@foreach($restaurantes as $restaurante)
                                		<option value="{{$restaurante->id}}">Sucursal {{$restaurante->departamendo}}</option>
                                	@endforeach
                                	<option value="null" selected="true">Todas las sucursales</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="fecha">Fecha limite del anuncio</label>
                                <input type="date" class="form-control" id="fecha" name="fecha">
                            </div>                                       
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
            jQuery.validator.addMethod("range",function(value,element){
            	var endDate = $('#fecha').val();
				return Date.parse(endDate) > Date.now();
			}, "date must be higher that today");

            $('#form-anuncio').validate({
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