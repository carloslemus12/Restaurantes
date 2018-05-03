<?php

namespace App\Http\Controllers;

use App\Anuncio;
use App\Restaurante;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anuncios=Anuncio::all();
        $restaurantes=Restaurante::all();
        return view('advertisement.index')->with(compact('anuncios','restaurantes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurantes=Restaurante::all();        
        return view('advertisement.create')->with(compact('restaurantes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cadena =($request['contenido']);
        $texto=explode("\n",$cadena);
        $anuncio="";

        foreach ($texto as $lineas) {
            $anuncio.=trim($lineas).'\n';            
        }

        $fecha = Date('Y-m-d');

        ($request['sucursal']=="null")? $sucursal=NULL: $sucursal=$request['sucursal'];                    
        Anuncio::create(
            [
                'anuncio' => $anuncio, 
                'fecha_inicio' => $fecha, 
                'fecha_final' => $request['fecha'],                 
                'restaurante_id' => $sucursal,
                'usuario_id' => 1, 
                'tipo_id' => $request['tipo'], 
                'created_at' => Carbon::now()
            ]
        );

        return redirect('/adm/advertisement');
        
    }
    
    public function show($id)
    {
       //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $anuncio = Anuncio::find($id);
        $restaurantes=Restaurante::all();
        

        return view('advertisement.edit')->with(compact('anuncio','restaurantes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $cadena =($request['contenido']);
        $texto=explode("\n",$cadena);
        $anuncio="";

        foreach ($texto as $lineas) {
            $anuncio.=trim($lineas).'\n';            
        }

        ($request['sucursal']=="null")? $sucursal=NULL: $sucursal=$request['sucursal'];

        $anuncios = Anuncio::find($id);

        $anuncios->anuncio = $anuncio; 
        $anuncios->fecha_final = $request['fecha'];
        $anuncios->restaurante_id = $sucursal;               
        $anuncios->updated_at = Carbon::now();
        $anuncios->save();

        return redirect('/adm/advertisement');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Anuncio  $anuncio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {        

        $anuncio = Anuncio::find($id);
        $anuncio->delete();

        return redirect('/adm/advertisement');
    }
}
