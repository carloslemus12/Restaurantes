<?php

namespace App\Http\Controllers;

use App\Platillo;
use App\Restaurante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index(){
        $res_votos = DB::table('restaurantes')->selectRaw('restaurantes.id as id, CAST((CASE WHEN AVG(detalle_restaurante_votacion.voto) is null THEN 0 else AVG(detalle_restaurante_votacion.voto) END) as int) as votaciones')->leftJoin('detalle_restaurante_votacion', 'restaurantes.id', '=', 'detalle_restaurante_votacion.restaurante_id')->groupBy('restaurantes.id')->orderBy('votaciones', 'desc')->limit(1)->first();
        $res_comentario = DB::table('restaurantes')->selectRaw('restaurantes.id as id, COUNT(detalle_restaurante_comentario.id) as comentarios')->leftJoin('detalle_restaurante_comentario', 'restaurantes.id', '=', 'detalle_restaurante_comentario.restaurante_id')->groupBy('restaurantes.id')->orderBy('comentarios', 'desc')->limit(1)->first();

        $restaurante_votos = Restaurante::find($res_votos->id);
        $restaurante_votos->votos = $res_votos->votaciones;

        $restaurante_comentarios = Restaurante::find($res_comentario->id);
        $restaurante_comentarios->comentarios = $res_comentario->comentarios;


        $pla_votos = DB::table('platillos')->selectRaw('platillos.id as id,  CAST((CASE WHEN AVG(detalle_platillo_votacion.voto) is null THEN 0 else AVG(detalle_platillo_votacion.voto) END) as int) as votaciones')->leftJoin('detalle_platillo_votacion', 'platillos.id', '=', 'detalle_platillo_votacion.platillo_id')->groupBy('platillos.id')->orderBy('votaciones', 'desc')->limit(1)->first();
        $pla_comentario = DB::table('platillos')->selectRaw('platillos.id as id, COUNT(detalle_platillo_comentario.id) as comentarios')->leftJoin('detalle_platillo_comentario', 'platillos.id', '=', 'detalle_platillo_comentario.platillo_id')->groupBy('platillos.id')->orderBy('comentarios', 'desc')->limit(1)->first();

        $platillo_votos = Platillo::find($pla_votos->id);
        $platillo_votos->votos = $pla_votos->votaciones;

        $platillo_comentarios = Platillo::find($pla_comentario->id);
        $platillo_comentarios->comentarios = $pla_comentario->comentarios;

        $restaurantes = Restaurante::all();

        return view('statistic.index')->with(compact('platillo_votos'))->with(compact('platillo_comentarios'))->with(compact('restaurante_votos'))->with(compact('restaurante_comentarios'))->with(compact('restaurantes'));
    }

    public function restaurant(){
        $res_votos = DB::table('restaurantes')->selectRaw('restaurantes.id as id, CAST((CASE WHEN AVG(detalle_restaurante_votacion.voto) is null THEN 0 else AVG(detalle_restaurante_votacion.voto) END) as int) as votaciones')->leftJoin('detalle_restaurante_votacion', 'restaurantes.id', '=', 'detalle_restaurante_votacion.restaurante_id')->groupBy('restaurantes.id')->orderBy('votaciones', 'desc')->limit(1)->first();
        $res_comentario = DB::table('restaurantes')->selectRaw('restaurantes.id as id, COUNT(detalle_restaurante_comentario.id) as comentarios')->leftJoin('detalle_restaurante_comentario', 'restaurantes.id', '=', 'detalle_restaurante_comentario.restaurante_id')->groupBy('restaurantes.id')->orderBy('comentarios', 'desc')->limit(1)->first();

        $restaurante_votos = Restaurante::find($res_votos->id);
        $restaurante_votos->votos = $res_votos->votaciones;

        $restaurante_comentarios = Restaurante::find($res_comentario->id);
        $restaurante_comentarios->comentarios = $res_comentario->comentarios;


        $pla_votos = DB::table('platillos')->selectRaw('platillos.id as id,  CAST((CASE WHEN AVG(detalle_platillo_votacion.voto) is null THEN 0 else AVG(detalle_platillo_votacion.voto) END) as int) as votaciones')->leftJoin('detalle_platillo_votacion', 'platillos.id', '=', 'detalle_platillo_votacion.platillo_id')->groupBy('platillos.id')->orderBy('votaciones', 'desc')->limit(1)->first();
        $pla_comentario = DB::table('platillos')->selectRaw('platillos.id as id, COUNT(detalle_platillo_comentario.id) as comentarios')->leftJoin('detalle_platillo_comentario', 'platillos.id', '=', 'detalle_platillo_comentario.platillo_id')->groupBy('platillos.id')->orderBy('comentarios', 'desc')->limit(1)->first();

        $platillo_votos = Platillo::find($pla_votos->id);
        $platillo_votos->votos = $pla_votos->votaciones;

        $platillo_comentarios = Platillo::find($pla_comentario->id);
        $platillo_comentarios->comentarios = $pla_comentario->comentarios;

        $restaurantes = Restaurante::all();

        return view('statistic.index')->with(compact('platillo_votos'))->with(compact('platillo_comentarios'))->with(compact('restaurante_votos'))->with(compact('restaurante_comentarios'))->with(compact('restaurantes'));
    }

    public function saucers(){
        $res_votos = DB::table('restaurantes')->selectRaw('restaurantes.id as id, CAST((CASE WHEN AVG(detalle_restaurante_votacion.voto) is null THEN 0 else AVG(detalle_restaurante_votacion.voto) END) as int) as votaciones')->leftJoin('detalle_restaurante_votacion', 'restaurantes.id', '=', 'detalle_restaurante_votacion.restaurante_id')->groupBy('restaurantes.id')->orderBy('votaciones', 'desc')->limit(1)->first();
        $res_comentario = DB::table('restaurantes')->selectRaw('restaurantes.id as id, COUNT(detalle_restaurante_comentario.id) as comentarios')->leftJoin('detalle_restaurante_comentario', 'restaurantes.id', '=', 'detalle_restaurante_comentario.restaurante_id')->groupBy('restaurantes.id')->orderBy('comentarios', 'desc')->limit(1)->first();

        $restaurante_votos = Restaurante::find($res_votos->id);
        $restaurante_votos->votos = $res_votos->votaciones;

        $restaurante_comentarios = Restaurante::find($res_comentario->id);
        $restaurante_comentarios->comentarios = $res_comentario->comentarios;


        $pla_votos = DB::table('platillos')->selectRaw('platillos.id as id,  CAST((CASE WHEN AVG(detalle_platillo_votacion.voto) is null THEN 0 else AVG(detalle_platillo_votacion.voto) END) as int) as votaciones')->leftJoin('detalle_platillo_votacion', 'platillos.id', '=', 'detalle_platillo_votacion.platillo_id')->groupBy('platillos.id')->orderBy('votaciones', 'desc')->limit(1)->first();
        $pla_comentario = DB::table('platillos')->selectRaw('platillos.id as id, COUNT(detalle_platillo_comentario.id) as comentarios')->leftJoin('detalle_platillo_comentario', 'platillos.id', '=', 'detalle_platillo_comentario.platillo_id')->groupBy('platillos.id')->orderBy('comentarios', 'desc')->limit(1)->first();

        $platillo_votos = Platillo::find($pla_votos->id);
        $platillo_votos->votos = $pla_votos->votaciones;

        $platillo_comentarios = Platillo::find($pla_comentario->id);
        $platillo_comentarios->comentarios = $pla_comentario->comentarios;

        $platillos = Platillo::all();

        return view('statistic.saucers')->with(compact('platillo_votos'))->with(compact('platillo_comentarios'))->with(compact('restaurante_votos'))->with(compact('restaurante_comentarios'))->with(compact('platillos'));
    }
}
