<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FotoPlatillo extends Model
{
    protected $table = 'fotos_platillo';

    protected $fillable = [
        'id', 'foto', 'platillo_id', 'created_at', 'updated_at'
    ];

    public function platillo()
    {
        return $this->belongsTo('App\Platillo', 'platillo_id', 'id');
    }
}
