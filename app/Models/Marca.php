<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    //
    protected $table = 'marcas';

    protected $fillable = [
        'caracteristica_id',
    ];

    //Relaciones tablas
    public function caracteristica()
    {
        return $this->belongsTo(Caracteristica::class);
    }
}
