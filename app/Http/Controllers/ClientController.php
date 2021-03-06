<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Anuncio;
use App\Platillo;
use App\RestauranteVotacion;
use App\RestauranteComentario;
use App\RestauranteRecomendacion;
use Illuminate\Http\Request;
use App\Restaurante;
use Carbon\Carbon;
use App\Premio;

class ClientController extends Controller
{
    public function restaurant($id){
        $restaurante = Restaurante::find($id);
        return view('clients.restaurant')->with(compact('restaurante'));
    }

    public function saucer($id){
        $platillo = Platillo::find($id);
        return view('clients.saucer')->with(compact('platillo'));
    }

    public function recomendaciones($id){
        $restaurante = Restaurante::find($id);
        return view('clients.recommendations')->with(compact('restaurante'));
    }

    public function addRecomendacion(Request $request, $id)
    {
        $recomendacion = new RestauranteRecomendacion;

        $recomendacion->restaurante_id = $id;
        $recomendacion->usuario_id = $request['usuario'];
        $recomendacion->recomendacion = $request['recomendacion'];
        $recomendacion->created_at = Carbon::now();
        
        $recomendacion->save();
    }

    public function removeRecomendacion(Request $request, $id)
    {
        $recomendacion = RestauranteRecomendacion::find($id);
        $recomendacion->delete();
    }

    public function getRecomendaciones($id){
        $restaurante = Restaurante::find($id);
        return view('clients.recommendationslight')->with(compact('restaurante'));
    }

    public function addComentario(Request $request, $id)
    {
        $comentario = new RestauranteComentario;

        $comentario->restaurante_id = $id;
        $comentario->usuario_id = $request['usuario'];
        $comentario->comentario = $request['comentario'];
        $comentario->created_at = Carbon::now();
        
        $comentario->save();
    }

    public function removeComentario(Request $request, $id)
    {
        $comentario = RestauranteComentario::find($id);
        $comentario->delete();
    }

    public function getComentarios($id){
        $restaurante = Restaurante::find($id);
        return view('clients.commentslight')->with(compact('restaurante'));
    }

    public function comentarios($id){
        $restaurante = Restaurante::find($id);
        return view('clients.comments')->with(compact('restaurante'));
    }

    public function start(Request $request, $id){
        $star = $request['star'];
        $usuario = $request['usuario'];

        if (RestauranteVotacion::where('restaurante_id', $id)->where('usuario_id', $usuario)->exists()) {
            $votacion = RestauranteVotacion::where('restaurante_id', $id)->where('usuario_id', $usuario)->first();
            $votacion->voto = $star;
            $votacion->updated_at = Carbon::now();
            $votacion->save();

        } else {
            $votacion = new RestauranteVotacion;
            $votacion->restaurante_id = $id;
            $votacion->usuario_id = $usuario;
            $votacion->voto = $star;
            $votacion->created_at = Carbon::now();
            $votacion->save();
        }
    }

    public function getSaucerComentarios($id){
        $platillo = Platillo::find($id);
        return view('clients.saurceCommentslight')->with(compact('platillo'));
    }

    public function saucerComentarios($id){
        $platillo = Platillo::find($id);
        return view('clients.saurceComments')->with(compact('platillo'));
    }

    public function getSaucerRecomendaciones($id){
        $platillo = Platillo::find($id);
        return view('clients.saucerRecommendationslight')->with(compact('platillo'));
    }

    public function saucerRecomendaciones($id){
        $platillo = Platillo::find($id);
        return view('clients.saucerRecommendations')->with(compact('platillo'));
    }

    public function advertisements(){
        $anuncios = Anuncio::whereRaw('fecha_final >= NOW()')->get();
        return view('clients.advertisements')->with(compact('anuncios'));
    }

    public function awards(){
        $premios = Premio::join('detalle_usuario_premio', 'detalle_usuario_premio.premio_id', '=', 'premios.id')->join('tipos_premios', 'tipos_premios.id', '=', 'premios.tipo_premio_id')->where('detalle_usuario_premio.usuario_id', Auth::user()->id)->select('premios.premio', 'premios.descripcion', DB::raw('DATE_ADD(DATE_ADD(DATE_ADD(detalle_usuario_premio.created_at, interval premios.dia day), interval premios.mes MONTH), interval premios.anio YEAR) as created_at'), 'tipos_premios.tipo as tipo')->get();
        return view('clients.awards')->with(compact('premios'));
    }
}
