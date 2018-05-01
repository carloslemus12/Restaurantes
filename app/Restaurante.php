<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Platillo;

class Restaurante extends Model
{
    protected $table = 'restaurantes';

    protected $fillable = [
        'id', 'departamendo', 'municipio', 'ciudad', 'calle', 'estado', 'created_at', 'updated_at'
    ];

    public function codigo(){
        return substr(strtoupper(trim($this->departamendo)), 0, 3).str_repeat("0", 3 - strlen("$this->id") ).$this->id;
    }

    public function usuarios(){
        return  $this->belongsToMany('App\User', 'detalle_usuario_restaurante', 'restaurante_id', 'id');
    }

    public function comentarios()
    {
        return $this->hasMany('App\RestauranteComentario', 'restaurante_id', 'id');
    }

    public function recomendaciones()
    {
        return $this->hasMany('App\RestauranteRecomendacion', 'restaurante_id', 'id');
    }

    public function votaciones()
    {
        return $this->hasMany('App\RestauranteVotacion', 'restaurante_id', 'id');
    }

    public function platillos(){
        return  $this->belongsToMany('App\Platillo', 'detalle_restaurante_platillo', 'restaurante_id', 'platillo_id');
    }

    public function anuncios()
    {
        return $this->hasMany('App\Anuncio', 'restaurante_id', 'id');
    }

    public function fotos()
    {
        return $this->hasMany('App\FotoRestaurante', 'restaurante_id', 'id');
    }

    public function sinPlatillos()
    {
        $platillos = [];

        $platillos_all = Platillo::all();
        $platillos_cont = $this->platillos;

        foreach ($platillos_all as $platillo) {
            $existe = false;
            foreach ($platillos_cont as $value) {
                if ($platillo->id == $value->id) {
                    $existe= true;
                    break;
                }
            }

            if (!$existe) {
                array_push($platillos, $platillo);
            }
        }

        return $platillos;
    }

    public function constaintSinPlatillos()
    {
        return count($this->sinPlatillos()) > 0;
    }

    public function constaintFotos()
    {
        return count($this->fotos()) > 0;
    }

    public function votos(){
        $votos = DB::table('restaurantes')->selectRaw('restaurantes.id as id, CAST((CASE WHEN AVG(detalle_restaurante_votacion.voto) is null THEN 0 else AVG(detalle_restaurante_votacion.voto) END) as int) as votaciones')->leftJoin('detalle_restaurante_votacion', 'restaurantes.id', '=', 'detalle_restaurante_votacion.restaurante_id')->where('restaurantes.id', $this->id)->groupBy('restaurantes.id')->limit(1)->first();
        return $votos->votaciones;
    }
}
