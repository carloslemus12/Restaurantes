<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlatilloComentario extends Model
{
    protected $table = 'detalle_platillo_comentario';

    protected $fillable = [
        'id', 'platillo_id', 'usuario_id', 'comentario', 'created_at', 'updated_at'
    ];

    public function usuario()
    {
        return $this->belongsTo('App\User', 'usuario_id', 'id');
    }

    public function platillo()
    {
        return $this->belongsTo('App\Platillo', 'platillo_id', 'id');
    }
}
