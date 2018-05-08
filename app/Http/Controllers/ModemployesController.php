<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Restaurante;
use App\TipoUsuario;

class ModemployesController extends Controller
{
	public function index($id)
	{	


		$restaurante=DB::table('detalle_usuario_restaurante')->where('usuario_id','=',$id)->get();

		$usuarios=DB::table('users')
		->join('tipos_usuario','tipos_usuario.id','=','users.tipo_usuario_id')
		->leftjoin('detalle_usuario_restaurante','detalle_usuario_restaurante.usuario_id','=','users.id')		
		->select('users.id','users.username','users.nombre','users.apellido','users.estado')
		->whereNULL('detalle_usuario_restaurante.usuario_id')
		->where('users.tipo_usuario_id','=',1)
		->get();

		$empleados=DB::table('users')
		->join('detalle_usuario_restaurante','detalle_usuario_restaurante.usuario_id','=','users.id')
		->select('users.id','users.username','users.nombre','users.apellido','users.estado')
		->where('detalle_usuario_restaurante.restaurante_id','=',$restaurante[0]->restaurante_id)
		->where('users.id','!=',$id)
		->get();
		
		
		return view('modemployes.convert')->with(compact('restaurante','usuarios','empleados'));
	}

	public function add(Request $request,$id)
	{
		$restaurante=DB::table('detalle_usuario_restaurante')->where('usuario_id','=',$request['sucursal'])->get();

		

		DB::table('detalle_usuario_restaurante')->insert(
            [
                'restaurante_id' => $restaurante[0]->restaurante_id, 
                'usuario_id' => $id,
                'created_at' => Carbon::now()
            ]
        );

        $usuario=User::find($id);
        $usuario->tipo_usuario_id=2;
        $usuario->updated_at = Carbon::now();

        $usuario->save();
        

        return redirect('mod/modemployes/'.$request['sucursal']);
        
	}
}