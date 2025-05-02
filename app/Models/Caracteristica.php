<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    use HasFactory;

    protected $table = 'caracteristicas';
    //
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
        'detacado',
    ];

    //Relaciones tablas
    public function categorias()
    {
        return $this->hasMany(Categorias::class);
    }

    public function marcas()
    {
        return $this->hasMany(Marcas::class);
    }

    public function presentaciones()
    {
        return $this->hasMany(Presentaciones::class);
    }
}
