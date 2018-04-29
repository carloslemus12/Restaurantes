<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anuncio extends Model
{
    protected $table = 'anuncios';

    protected $fillable = [
        'id', 'anuncio', 'fecha_inicio', 'fecha_final', 'restaurante_id', 'usuario_id', 'created_at', 'updated_at'
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
