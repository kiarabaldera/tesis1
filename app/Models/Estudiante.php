<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;

    public function grado_seccion()
    {
        return $this->belongsTo(Grado_seccion::class);
    }
}
