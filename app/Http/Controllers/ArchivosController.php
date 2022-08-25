<?php

namespace App\Http\Controllers;

use App\Models\Archivos;
use App\Models\Asignatura;
use App\Models\Secciones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchivosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $message=null)
    {
        if($request->wantsJson()){
            $id_seccion=$request->query('id_seccion');
            $seccion = Secciones::find($id_seccion);
            $impartida=Asignatura::impart()->where('asignatura.id',$seccion->id_asignatura)->first();
            return $impartida ? Archivos::where('id_seccion',$id_seccion)->get() : null;
        }else{
           return  redirect('secciones');
        }
      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->hasFile('file')){
            $archivo = new Archivos();
            $archivo->id_seccion=$request->input('id_seccion');
            $archivo->mimetype=$request->file('file')->getClientOriginalExtension();
            $archivo->name=$request->input('name');
            $archivo->url=$request->file->storeAs('archivos/descargas',$request->file->getClientOriginalName());
            $archivo->save();
            
        }
        return (new SeccionesController)->index('Se ha creado exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloads($file)
    {
        return Storage::get('Archivos/descargas/'.$file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $archivo = Archivos::find($id);
        Storage::delete($archivo->url);
        Archivos::destroy($id);
         return route('secciones.index');
    }
}
