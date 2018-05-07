<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPremio extends Model
{
    protected $table = 'tipos_premios';

    protected $fillable = [
        'id', 'tipo', 'created_at', 'updated_at'
    ];

    public function premios()
    {
        return $this->hasMany('App\Premio', 'tipo_premio_id', 'id');
    }
}
