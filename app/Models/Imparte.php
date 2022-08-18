<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imparte extends Model
{
    use HasFactory;
    protected $table = 'imparte';
    protected $fillable = ["id_user", "id_asignatura"];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }

    public function asignatura()
    {
        return $this->hasMany(Asignatura::class,'id','id_asignatura')
    }
}
