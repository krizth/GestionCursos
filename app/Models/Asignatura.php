<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;

    protected $table="asignatura";
    protected $fillable = ['description','title'];
    protected $timestamps=true;
    
    public function secciones() {
        
        return $this->hasMany(Secciones::class,'id_asignatura','id');
    }


}
