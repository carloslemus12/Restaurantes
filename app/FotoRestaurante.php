<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FotoRestaurante extends Model
{
    protected $table = 'fotos_restaurante';

    protected $fillable = [
        'id', 'foto', 'restaurante_id', 'created_at', 'updated_at'
    ];

    public function restaurante()
    {
        return $this->belongsTo('App\Restaurante', 'restaurante_id', 'id');
    }
}
