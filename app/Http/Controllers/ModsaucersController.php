<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Platillo;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Restaurante;
use App\TipoPlatillo;
use App\FotoPlatillo;


class ModsaucersController extends Controller
{

	public function index($id)
	{

		$restaurant=DB::table('detalle_usuario_restaurante')->where('usuario_id','=',$id)->get();		
				
		$platillos=DB::table('platillos')
		->join('detalle_restaurante_platillo','detalle_restaurante_platillo.platillo_id','=','platillos.id')
		->join('tipos_platillo','tipos_platillo.id','=','platillos.tipo_id')
		->select('platillos.id','platillos.platillo','tipos_platillo.tipo_platillo','platillos.estado','platillos.precio','platillos.descripcion','platillos.especialidad')
		->where('detalle_restaurante_platillo.restaurante_id','=',$restaurant[0]->restaurante_id)
		->get();


		return view('modsaucers.index')->with(compact('platillos'));

	}

	 public function create()
    {         
         $tipos=TipoPlatillo::all();
         return view('modsaucers.create')->with(compact('tipos'));
    }

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

        $restaurant=DB::table('detalle_usuario_restaurante')->where('usuario_id','=',$request['sucursal'])->get();	

        DB::table('detalle_restaurante_platillo')->insert(
                [
                    'restaurante_id' => $restaurant[0]->restaurante_id, 
                    'platillo_id' => $platillo->last()->id,
                    'created_at' => Carbon::now()
                ]
            );
        

        return redirect('/mod/modsaucers/'.$request['sucursal']);
    }

    public function show($id)
    {
        $platillo = Platillo::find($id);

        return view('modsaucers.picture')->with(compact('platillo'));
    }

    public function edit($id)
    {
    	
        $platillo = Platillo::find($id);        
        $tipos=TipoPlatillo::all();

    	return view('modsaucers.edit')->with(compact('platillo','tipos'));
        
    }
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

        return redirect('/mod/modsaucers/'.$request['id']);
    }

    public function destroy(Request $request,$id)
    {
		
        DB::table('detalle_restaurante_platillo')->where('platillo_id', $id)->delete();

        $platillo = Platillo::find($id);
        $platillo->delete();

        return redirect('/mod/modsaucers/'.$request['sucursal']);        
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

        return redirect('/mod/modsaucer/'.$id);
        
    }

    public function pictureRemove(Request $request, $id)
    {
        $foto = FotoPlatillo::find($request['id']);
        $foto->delete();

        return redirect('/mod/modsaucer/'.$id);
    }

}