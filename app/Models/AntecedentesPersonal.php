<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AntecedentesPersonal extends Model
{
    use SoftDeletes;
    protected $table = 'antecedentes_personales';
    protected $fillable = [
        'nombre',
        'is_bool',
        'estatus',
    ];

    public function pacientes(): HasMany
    {
        return $this->hasMany(PacienteAntPersonal::class, 'antecedentes_id', 'id');
    }

}
