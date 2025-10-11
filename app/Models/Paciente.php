<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    use SoftDeletes;

    protected $table = 'pacientes';
    protected $fillable = [
        'cedula',
        'nombre',
        'fecha_nacimiento',
        'edad',
        'telefono',
        'direccion',
        'fur',
        'fpp',
        'gestas',
        'partos',
        'cesareas',
        'abortos',
    ];

    public function controlPrenatal(): HasMany
    {
        return $this->hasMany(ControlPrenatal::class, 'pacientes_id', 'id');
    }

    public function antFamiliares(): HasMany
    {
        return $this->hasMany(PacienteAntFamiliar::class, 'pacientes_id', 'id');
    }

    public function antPersonales(): HasMany
    {
        return $this->hasMany(PacienteAntPersonal::class, 'pacientes_id', 'id');
    }

    public function antOtros(): HasMany
    {
        return $this->hasMany(PacienteAntOtro::class, 'pacientes_id', 'id');
    }

    public function vacunas(): HasMany
    {
        return $this->hasMany(PacienteVacuna::class, 'pacientes_id', 'id');
    }

}
