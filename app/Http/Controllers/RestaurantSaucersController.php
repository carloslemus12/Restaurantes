<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\FotoRestaurante;
use Carbon\Carbon;

class RestaurantSaucersController extends Controller
{
    public function add(Request $request, $id)
    {
        DB::table('detalle_restaurante_platillo')->insert(
            [
                'restaurante_id' => $id, 
                'platillo_id' => $request['platillo'],
                'created_at' => Carbon::now()
            ]
        );

        return redirect('/adm/restaurant/'.$id.'/edit');
    }

    public function remove(Request $request, $id)
    {
        DB::table('detalle_restaurante_platillo')->where('restaurante_id', $id)->where('platillo_id', $request['platillo'])->delete();
        return redirect('/adm/restaurant/'.$id.'/edit');
    }
}
