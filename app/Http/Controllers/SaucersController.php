<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Platillo;
use App\Restaurante;
use App\TipoPlatillo;
use App\FotoPlatillo;
use Carbon\Carbon;


class SaucersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $platillos = Platillo::all();
        
        //$books = App\Book::with(['author', 'publisher'])->get();

        return view('saucer.index')->with(compact('platillos'));    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $restaurantes=Restaurante::all();
         $tipos=TipoPlatillo::all();
         return view('saucer.create')->with(compact('tipos','restaurantes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Platillo::create(
            [
                'platillo' => $request['nombre'], 
                'descripcion' => $request['descripcion'], 
                'especialidad' => $request['especialidad'],                 
                'estado' => 1,
                'precio' => $request['precio'], 
                'tipo_id' => $request['tipo'], 
                'created_at' => Carbon::now()
            ]
        );

        $platillo = Platillo::all();
        $restaurantes = Restaurante::all();
        if($request['sucursal']=='todos'){
            foreach($restaurantes as $restaurante){
                DB::table('detalle_restaurante_platillo')->insert(
                    [
                        'restaurante_id' => $restaurante->id, 
                        'platillo_id' => $platillo->last()->id,
                        'created_at' => Carbon::now()
                    ]
                );       
            }
        }else{
             DB::table('detalle_restaurante_platillo')->insert(
                [
                    'restaurante_id' => $request['sucursal'], 
                    'platillo_id' => $platillo->last()->id,
                    'created_at' => Carbon::now()
                ]
            );
        }

        return redirect('/adm/saucer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $platillo = Platillo::find($id);

        return view('saucer.picture')->with(compact('platillo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $platillo = Platillo::find($id);
         $restaurantes=Restaurante::all();
         $tipos=TipoPlatillo::all();

        return view('saucer.edit')->with(compact('platillo','restaurantes','tipos'));
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
        $platillo = Platillo::find($id);

        $platillo->platillo = $request['nombre']; 
        $platillo->descripcion = $request['descripcion'];
        $platillo->especialidad = $request['especialidad'];        
        $platillo->estado = 1;
        $platillo->precio = $request['precio'];
        $platillo->tipo_id = $request['tipo'];
        $platillo->updated_at = Carbon::now();
        $platillo->save();

        return redirect('/adm/saucer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        DB::table('detalle_restaurante_platillo')->where('platillo_id', $id)->delete();

        $platillo = Platillo::find($id);
        $platillo->delete();

        return redirect('/adm/saucer');
    }

    public function pictureAdd(Request $request, $id)
    {
        $img = $request->file('img')->getClientOriginalName();

        if ($request->hasFile('img')) {
            Storage::disk('local')->putFileAs('public/', $request->file('img'), $img);
        }

        FotoPlatillo::create(
            [
                'foto' => $img, 
                'platillo_id' => $id, 
                'created_at' => Carbon::now()
            ]
        );

        return redirect('/adm/saucer/'.$id);
    }

    public function pictureRemove(Request $request, $id)
    {
        $foto = FotoPlatillo::find($request['id']);
        $foto->delete();

        return redirect('/adm/saucer/'.$id);
    }

}
