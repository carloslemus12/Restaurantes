<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Restaurante;
use App\FotoRestaurante;
use Carbon\Carbon;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $restaurantes = Restaurante::all();


        return view('restaurant.index')->with(compact('restaurantes'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('restaurant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Restaurante::create(
            [
                'departamendo' => $request['departamento'], 
                'municipio' => $request['municipio'], 
                'ciudad' => $request['ciudad'], 
                'calle' => $request['calle'], 
                'estado' => 1,
                'created_at' => Carbon::now()
            ]
        );

        return redirect('/adm/restaurant');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $restaurante = Restaurante::find($id);

        return view('restaurant.picture')->with(compact('restaurante'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $restaurante = Restaurante::find($id);

        return view('restaurant.edit')->with(compact('restaurante'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $restaurante = Restaurante::find($id);

        $restaurante->departamendo = $request['departamento']; 
        $restaurante->municipio = $request['municipio'];
        $restaurante->ciudad = $request['ciudad'];
        $restaurante->calle = $request['calle'];
        $restaurante->estado = 1;
        $restaurante->updated_at = Carbon::now();

        $restaurante->save();

        return redirect('/adm/restaurant');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurante = Restaurante::find($id);
        $restaurante->delete();

        return redirect('/adm/restaurant');
    }

    public function pictureAdd(Request $request, $id)
    {
        $img = $request->file('img')->getClientOriginalName();

        if ($request->hasFile('img')) {
            Storage::disk('local')->putFileAs('public/', $request->file('img'), $img);
        }

        FotoRestaurante::create(
            [
                'foto' => $img, 
                'restaurante_id' => $id, 
                'created_at' => Carbon::now()
            ]
        );

        return redirect('/adm/restaurant/'.$id);
    }

    public function pictureRemove(Request $request, $id)
    {
        $foto = FotoRestaurante::find($request['id']);
        $foto->delete();

        return redirect('/adm/restaurant/'.$id);
    }

    public function client()
    {
        $restaurantes = Restaurante::all();

        return view('clients.restaurants')->with(compact('restaurantes'));
    }
}
