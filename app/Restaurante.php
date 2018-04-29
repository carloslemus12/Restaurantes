<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    protected $table = 'restaurantes';

    protected $fillable = [
        'id', 'departamendo', 'municipio', 'ciudad', 'calle', 'estado', 'created_at', 'updated_at'
    ];

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
        return  $this->belongsToMany('App\Platillo', 'detalle_restaurante_platillo', 'restaurante_id', 'id');
    }

    public function anuncios()
    {
        return $this->hasMany('App\Anuncio', 'restaurante_id', 'id');
    }

    public function fotos()
    {
        return $this->hasMany('App\FotoRestaurante', 'restaurante_id', 'id');
    }
}
