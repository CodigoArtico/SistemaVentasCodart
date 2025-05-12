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
        'destacado',
    ];

    //Relaciones tablas
    public function categorias()
    {
        return $this->hasMany(Categoria::class);
    }

    public function marcas()
    {
        return $this->hasMany(Marca::class);
    }

    public function presentaciones()
    {
        return $this->hasMany(Presentacion::class);
    }
}
