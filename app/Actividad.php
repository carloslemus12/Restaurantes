<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividades';

    protected $fillable = [
        'id', 'actividad', 'created_at', 'updated_at'
    ];

    public function usuarios(){
        return  $this->belongsToMany('App\User', 'detalle_usuario_actividad', 'actividad_id', 'id');
    }
}
