<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\premio;
use Illuminate\Support\Facades\DB;
use App\User;
use App\tipopremio;

class GiftsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $premios=premio::all();
        $usuarios=User::all();
        return view('gifts.index')->with(compact('premios','usuarios'));
    }
   

     public function create()
    {
        $tipo=tipopremio::all();        
        return view('gifts.create')->with(compact('tipo'));
    }
   
    public function store(Request $request)
    {   

        $sucursal=$request['sucursal'];                    

        premio::create(
            [
                'premio' => $request['nombre'], 
                'dia' => $request['dia'], 
                'mes' => $request['mes'],                 
                'anio' => $request['año'],
                'tipo_premio_id' => $sucursal,
                'descripcion' => $request['descripcion'], 
                'created_at' => Carbon::now()
            ]
        );

        return redirect('/adm/gifts');
        
    }

    public function destroy(Request $request,$id)
    {        

        $premio = premio::find($id);
        $premio->delete();

        return redirect('/adm/gifts');
    }

}