<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Asignatura extends Model
{
    use HasFactory;

    protected $table="asignatura";
    protected $fillable = ['description','title'];
    public $timestamps=true;
    
    public function secciones() {
        
        return $this->hasMany(Secciones::class,'id_asignatura','id');
    }
    public function scopeImpart($query){
        return $query->join('imparte',function($join){
            $join->on('imparte.id_asignatura', "=",'asignatura.id')
            ->where('imparte.id_user',Auth::id());
        });
    }

}
