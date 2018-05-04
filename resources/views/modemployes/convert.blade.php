@extends(auth()->check()? (auth()->user()->isAdmin()? 'layouts.admin' : 'layouts.moderator') : 'layouts.app')

@section('title')
    Empleados
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
                                <th>Codigo</th>
                                <th>Usuario</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Estado</th>                                
                                <th><span class="glyphicon glyphicon-italic"></span>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td>{{'USR'.str_repeat("0", 3 - strlen("$usuario->id") ).$usuario->id }}</td>
                                <td>{{$usuario->username}}</td>
                                <td>{{$usuario->nombre}}</td>
                                <td>{{$usuario->apellido}}</td>
                                <td>{{($usuario->estado == 1)? 'Habilitado' : 'Desabilitado' }}</td>                                

                                <td class="text-center d-flex justify-content-around">
                                    <form method="POST" action="{{url('mod/modemployes/add/'.$usuario->id)}}">
                                        {!! csrf_field() !!}
                                        
                                        <input type="hidden" name="sucursal" id="sucursal" value="{{Auth::user()->id}}">
                                        <button type="submit" onclick="return confirm('¿Convertir usuario a empleado de la sucursal?');" class="p-0 m-0 btn-unstyled"><img src="{{ asset('svg/si-glyph-button-plus.svg')  }}" style="width:32px;"/></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <center><h2>Empleados de la sucursal</h2></center>
                    <table id="tbl_empleados" class="table table-bordered" style="width:100%">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>Codigo</th>
                                <th>Usuario</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Estado</th>                                    
                            </tr>
                        </thead>
                        <tbody>                       
                        @foreach ($empleados as $empleado)
                            <tr>
                                <td>{{ 'USR'.str_repeat("0", 3 - strlen("$empleado->id") ).$empleado->id }}</td>
                                <td>{{$empleado->username}}</td>
                                <td>{{$empleado->nombre}}</td>
                                <td>${{$empleado->apellido}}</td>
                                <td>{{($empleado->estado == 1)? 'Habilitado' : 'Desabilitado'}}</td>                        
                            </tr>
                        @endforeach                        
                        </tbody>
                    </table>                
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#tbl_platillo').DataTable();
        });
    </script>
@endsection
