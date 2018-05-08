<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Restaurante;

class RecommendationController extends Controller
{

	public function list($id)
	{

		$restaurante=DB::table('detalle_usuario_restaurante')->where('usuario_id','=',$id)->get();

		$recomendaciones = DB::table('detalle_restaurante_recomendacion')
		->join('users','users.id','=','detalle_restaurante_recomendacion.usuario_id')
		->select('users.username','detalle_restaurante_recomendacion.recomendacion','detalle_restaurante_recomendacion.created_at','detalle_restaurante_recomendacion.id')
		->where('detalle_restaurante_recomendacion.restaurante_id','=',$restaurante[0]->restaurante_id)
		->get();

		return view('recommendation.recomendation')->with(compact('recomendaciones'));
	}

	public function destroy(Request $request,$id)
	{
		
		DB::table('detalle_restaurante_recomendacion')->where('id', $id)->delete();

		return redirect('/mod/recommendation/'.$request["moderador"]);
	}
}