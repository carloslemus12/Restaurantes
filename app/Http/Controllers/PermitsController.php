<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Restaurante;
use App\TipoUsuario;

class PermitsController extends Controller
{
    public function index()
    {   

        $restaurantes=Restaurante::all();
        $usuarios=DB::table('users')
        ->select('*')
        ->where('tipo_usuario_id','!=',3)
        ->where('tipo_usuario_id','!=',4)
        ->get();

        $moderadores=DB::table('users')
        ->select('*')
        ->where('tipo_usuario_id','=',3)
        ->get();

        
        return view('permits.index')->with(compact('usuarios', 'moderadores', 'restaurantes'));
    }

    public function add(Request $request,$id)
    {        
         ($request['sucursal']=="null")? $sucursal=NULL: $sucursal=$request['sucursal'];

        $verificar=DB::table('detalle_usuario_restaurante')
        ->select('*')
        ->where('usuario_id','=',$id)
        ->where('restaurante_id','=',$sucursal)
        ->get();

        if ($verificar=="[]") {
             DB::table('detalle_usuario_restaurante')->insert(
            [
                'restaurante_id' => $sucursal, 
                'usuario_id' => $id,
                'created_at' => Carbon::now()
            ]
            );
             $usuarios = User::find($id);
        
        if ($usuarios->tipo_usuario_id == 1) {
          $usuarios->tipo_usuario_id = 2; 
        }elseif($usuarios->tipo_usuario_id == 2){
              $usuarios->tipo_usuario_id = 3; 
        }else{
            return redirect('/adm/permits');
        }


                      
        $usuarios->updated_at = Carbon::now();
        $usuarios->save();

        return redirect('/adm/permits');

        
        }else{
            $usuarios = User::find($id);
        
        if ($usuarios->tipo_usuario_id == 1) {
          $usuarios->tipo_usuario_id = 2; 
        }elseif($usuarios->tipo_usuario_id == 2){
              $usuarios->tipo_usuario_id = 3; 
        }else{
            return redirect('/adm/permits');
        }


                      
        $usuarios->updated_at = Carbon::now();
        $usuarios->save();

        return redirect('/adm/permits');
        }
    }
}