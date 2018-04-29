<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Premio extends Model
{
    protected $table = 'premios';

    protected $fillable = [
        'id', 'premio', 'dia', 'mes', 'anio', 'descripcion', 'created_at', 'updated_at'
    ];

    public function usuarios(){
        return  $this->belongsToMany('App\User', 'detalle_usuario_premio', 'premio_id', 'id');
    }
}
