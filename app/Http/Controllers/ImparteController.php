<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Imparte;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImparteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all(); //Imparte::with("user","asignatura")->get();
        $asignaturas = Asignatura::with('users')->get();
        return View('imparte',['users'=>$users,'asignaturas'=>$asignaturas]);
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
        if(User::isAdmin()){
            $imparte=new Imparte();
            $imparte->id_user=$request->id_user;
            $imparte->id_asignatura=$request->id_asignatura;
            $imparte->save();
        }
    
        return $this->index();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($usuario,$asignatura)
    {
        if(User::isAdmin()){
        $imparte= Imparte::where([['id_asignatura',"=",$asignatura],['id_user',"=",$usuario]])->delete();
        }
        return $this->index();
    }
}
