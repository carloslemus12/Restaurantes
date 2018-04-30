@extends(auth()->check()? (auth()->user()->isAdmin()? 'layouts.admin' : 'layouts.moderator') : 'layouts.app')

@section('title')
    Registrar restaurante
@endsection

@section('content')
<div class="container">
    <div class="row w-100">
        <div class="col w-100 mt-4">
            <div class="card bg-transparent border-0">
                <div class="card-header bg-transparent border-0">
                    <center><img src="{{ asset('img/croissant.svg')  }}" style="max-width: 200px;" alt=""></center>
                </div>
                <form id="form-restaurante" method="POST" action="{{ url('adm/restaurant') }}">
                    {!! csrf_field() !!}

                    <div class="card-body bg-dark text-white">
                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <label for="departamento">Departamento del restaurante</label>
                                <input type="text" class="form-control" id="departamento" name="departamento" placeholder="Departamento">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="municipio">Municipio del restaurante</label>
                                <input type="text" class="form-control" id="municipio" name="municipio" placeholder="Municipio">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-12 col-md-6">
                                <label for="ciudad">Ciudad del restaurante</label>
                                <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="calle">Calle del restaurante</label>
                                <input type="text" class="form-control" id="calle" name="calle" placeholder="Calle">
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