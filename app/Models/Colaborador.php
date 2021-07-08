<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    protected $table = 'colaboradores';
    use HasFactory;

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }
}
