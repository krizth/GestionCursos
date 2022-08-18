<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secciones extends Model
{

    use HasFactory;

    protected $table="secciones";

    protected $fillable=["title","description","id_asignatura"];

    public function asignatura(){
        return $this->hasOne(Asignatura::class,'id','id_asignatura');
    }

    public function archivos(){
        return $this->hasMany(Archivos::class,'id_seccion','id');
    }

}
