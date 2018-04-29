<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPlatillo extends Model
{
    protected $table = 'tipos_platillo';

    protected $fillable = [
        'id', 'tipo_platillo', 'created_at', 'updated_at'
    ];

    public function platillos()
    {
        return $this->hasMany('App\Platillo', 'tipo_id', 'id');
    }
}
