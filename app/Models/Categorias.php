<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;
    //
    protected $table = 'categorias';

    protected $fillable = [
        'caracteristica_id',
    ];


    //Relaciones tablas
    public function caracteristicas()
    {
        return $this->belongsTo(Caracteristica::class);
    }
}
