<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Facade\FlareClient\View;
use Illuminate\Http\Request;

class AsignaturasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($message=null)
    {
        $asignaturas = Asignatura::all();
        return View('asignaturas',['asignaturas'=>$asignaturas,'successMsg'=>$message]);
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
        $asignatura = new Asignatura();
        $asignatura->title = $request->title;
        $asignatura->description = $request->description;
        $asignatura->save();
        $asignaturas = Asignatura::all();
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
    public function update(Request $request,$id)
    {
        $asignatura=Asignatura::find($id);
        if($asignatura){
            $asignatura->title=$request->input('title');
            $asignatura->description=$request->input('description');
            $asignatura->save();
            $asignaturas=Asignatura::all();
            return $this->index('Actualizado exitosamente');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Asignatura::destroy($id);
        return $this->index('Se ha eliminado satisfactoriamente');
    }
}
