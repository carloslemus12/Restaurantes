@extends(auth()->check()? (auth()->user()->isAdmin()? 'layouts.admin' : 'layouts.moderator') : 'layouts.app')

@section('title')
    Permisos
@endsection

@section('content')
<div class="container">
    <div class="row w-100">
        <div class="col w-100 mt-4">
            <div class="card bg-transparent border-0">
                <div class="card-header bg-transparent border-0">
                    <center><img src="{{ asset('img/employee.svg') }}" style="max-width: 200px;" alt=""></center>
                </div>
                <center><h2>Usuarios disponibles</h2></center>
                
                    {!! csrf_field() !!}
                    <table id="tbl_usuarios" class="table table-bordered" style="width:100%">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Usuario</th>
                                <th>Tipo Usuario</th>                             
                                <th><span class="glyphicon glyphicon-italic"></span>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{$usuario->username}}</td>
                                <td>{{($usuario->tipo_usuario_id == 1)? 'Cliente' : 'Empleado'}}</td>

                                <td class="text-center d-flex justify-content-around">                                                                                                 

                                    <form method="POST" action="{{url('adm/permits/add/'.$usuario->id)}}">
                                        {!! csrf_field() !!}
                                        
                                        <input type="hidden" name="sucursal" id="sucursal" value="{{Auth::user()->id}}">
                                        <select class="form-control" id="sucursal" name="sucursal">
                                            @foreach($restaurantes as $restaurante)
                                                <option value="{{$restaurante->id}}">Sucursal {{$restaurante->departamendo}}</option>
                                            @endforeach
                                            <option value="null" selected="true">Todas las sucursales</option>
                                        </select>
                                        <button type="submit" onclick="return confirm('¿Convertir usuario a empleado de la sucursal?');" class="p-0 m-0 btn-unstyled"><img src="{{ asset('svg/si-glyph-button-plus.svg')  }}" style="width:32px;"/></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                     <center><h2>Moderadores</h2></center>
                    <table id="tbl_empleados" class="table table-bordered" style="width:100%">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Usuario</th>
                                <th>Nombre</th>
                                <th>Apellido</th>                                 
                            </tr>
                        </thead>
                        <tbody>                       
                        @foreach ($moderadores as $usuario)
                            <tr>
                                <td>{{$usuario->username}}</td>
                                <td>{{$usuario->nombre}}</td>
                                <td>{{$usuario->apellido}}</td>                  
                            </tr>
                        @endforeach                        
                        </tbody>
                    </table>                     
            </div>
        </div>
    </div>
</div>
@endsection
