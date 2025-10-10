<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AntecedentesOtro extends Model
{
    use SoftDeletes;
    protected $table = 'antecedentes_otros';
    protected $fillable = [
        'nombre',
        'is_bool',
        'estatus',
    ];

    public function pacientes(): HasMany
    {
        return $this->hasMany(PacienteAntOtro::class, 'antecedentes_id', 'id');
    }

}
