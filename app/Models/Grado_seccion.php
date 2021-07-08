<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado_seccion extends Model
{
    protected $table = 'grado_secciones';
    use HasFactory;

    public function grado()
    {
        return $this->belongsTo(Grado::class);
    }

    public function seccion()
    {
        return $this->belongsTo(Seccion::class);
    }

    public function getGradoSeccionAttribute()
    {
        return "{$this->grado->descripcion}{$this->seccion->descripcion}";
    }
}
