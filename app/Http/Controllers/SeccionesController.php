<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Secciones;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\Vue;

class SeccionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($message=null)
    {
        $asignaturas = Asignatura::with('secciones')->get();
        return $message == null ? View('secciones',compact('asignaturas')):View('secciones',['asignaturas'=>$asignaturas,'successMsg'=>$message]);
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
        $seccion = new Secciones();
        $seccion->title=$request->input('title');
        $seccion->description=$request->input('description');
        $seccion->id_asignatura=$request->input('id_asignatura');
        $seccion->save();
        return $this->index('Se ha creado exitosamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $seccion = Secciones::find($id);
        if($seccion){
            $seccion->title=$request->input('title');
            $seccion->description=$request->input('description');
            $seccion->id_asignatura=$request->input('id_asignatura');
            $seccion->save();
           
        }
      return $this->index('Actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Secciones::destroy($id);
        return $this->index('Se ha eliminado satisfactoriamente');
    }
}
