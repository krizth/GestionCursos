<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archivos extends Model
{
    use HasFactory;

    protected $table="archivos";
    
    protected $fillable=["url","mimetype","name","id_seccion"];
    protected $timestamps=true;

    public function secciones(){
        return $this->belongsTo(Secciones::class,'id_seccion','id')
    }



}
