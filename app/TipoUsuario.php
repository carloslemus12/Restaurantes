<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoUsuario extends Model
{
    protected $table = 'tipos_usuario';

    protected $fillable = [
        'id', 'tipo', 'created_at', 'updated_at'
    ];

    public function usuarios()
    {
        return $this->hasMany('App\User', 'tipo_usuario_id', 'id');
    }
}
 