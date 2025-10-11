<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PacienteTipaje extends Model
{
    protected $table = 'pacientes_tipajes';
    protected $fillable = [
        'pacientes_id',
        'madre',
        'padre',
        'sensibilidad',
    ];
}
