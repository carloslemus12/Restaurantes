<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platillo extends Model
{
    protected $table = 'platillos';

    protected $fillable = [
        'id', 'platillo', 'descripcion', 'especialidad', 'estado', 'precio', 'tipo_id', 'created_at', 'updated_at'
    ];

    public function tipoPlatillo()
    {
        return $this->belongsTo('App\TipoPlatillo', 'tipo_id', 'id');
    }

    public function comentarios()
    {
        return $this->hasMany('App\PlatilloComentario', 'platillo_id', 'id');
    }

    public function recomendaciones()
    {
        return $this->hasMany('App\PlatilloRecomendacion', 'platillo_id', 'id');
    }

    public function votaciones()
    {
        return $this->hasMany('App\PlatilloVotacion', 'platillo_id', 'id');
    }

    public function restaurantes(){
        return  $this->belongsToMany('App\Restaurante', 'detalle_restaurante_platillo', 'platillo_id', 'id');
    }

    public function fotos()
    {
        return $this->hasMany('App\FotoPlatillo', 'platillo_id', 'id');
    }
}
