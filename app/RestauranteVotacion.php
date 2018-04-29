<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestauranteVotacion extends Model
{
    protected $table = 'detalle_restaurante_votacion';

    protected $fillable = [
        'id', 'restaurante_id', 'usuario_id', 'voto', 'created_at', 'updated_at'
    ];

    public function usuario()
    {
        return $this->belongsTo('App\User', 'usuario_id', 'id');
    }

    public function restaurante()
    {
        return $this->belongsTo('App\Restaurante', 'restaurante_id', 'id');
    }
}
