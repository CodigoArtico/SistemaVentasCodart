<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentacion extends Model
{
    use HasFactory;

    //
    protected $table = 'presentaciones';

    protected $fillable = [
        'caracteristica_id',
    ];


    //Relaciones tablas
    public function caracteristica()
    {
        return $this->belongsTo(Caracteristica::class);
    }
}
