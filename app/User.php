<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\RestauranteVotacion;
use App\PlatilloVotacion;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'username', 'nombre', 'apellido', 'fecha_nacimiento', 'email', 'estado', 'tipo_usuario_id', 'password', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function tipoUsuario()
    {
        return $this->belongsTo('App\TipoUsuario');
    }

    public function actividades(){
        return  $this->belongsToMany('App\Actividad', 'detalle_usuario_actividad', 'usuario_id', 'id');
    }

    public function restaurantes(){
        return  $this->belongsToMany('App\Restaurante', 'detalle_usuario_restaurante', 'usuario_id', 'id');
    }

    public function comentariosPlatillos()
    {
        return $this->hasMany('App\PlatilloComentario', 'usuario_id', 'id');
    }

    public function votacionesPlatillos()
    {
        return $this->hasMany('App\PlatilloVotacion', 'usuario_id', 'id');
    }

    public function recomendacionesPlatillos()
    {
        return $this->hasMany('App\PlatilloRecomendacion', 'usuario_id', 'id');
    }

    public function comentariosRestaurantes()
    {
        return $this->hasMany('App\RestauranteComentario', 'usuario_id', 'id');
    }

    public function votacionesRestaurantes()
    {
        return $this->hasMany('App\RestauranteVotacion', 'usuario_id', 'id');
    }

    public function recomendacionesRestaurantes()
    {
        return $this->hasMany('App\RestauranteRecomendacion', 'usuario_id', 'id');
    }

    public function premios(){
        return  $this->belongsToMany('App\Premio', 'detalle_usuario_premio', 'usuario_id', 'id');
    }

    public function anuncios()
    {
        return $this->hasMany('App\Anuncio', 'usuario_id', 'id');
    }

    public function isAdmin()
    {
        return $this->tipoUsuario->id == 4;
    }

    public function isClient()
    {
        return $this->tipoUsuario->id == 1;
    }

    public function isModerator()
    {
        return $this->tipoUsuario->id == 3;
    }

    public function isEmpleado()
    {
        return $this->tipoUsuario->id == 2;
    }

    public function votacionRestauranteId($id){
        $votacion = RestauranteVotacion::where('usuario_id', $this->id)->where('restaurante_id', $id)->first();

        if (isset($votacion))
            return $votacion->voto;
        else
            return 0;
    }

    public function votacionPlatilloId($id){
        $votacion = PlatilloVotacion::where('usuario_id', $this->id)->where('platillo_id', $id)->first();

        if (isset($votacion))
            return $votacion->voto;
        else
            return 0;
    }
}
