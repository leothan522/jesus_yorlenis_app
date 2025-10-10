<?php

namespace Database\Seeders;

use App\Models\AntecedentesOtro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AntecedentesOtroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $antecedentes = [
            [
                'nombre' => 'Ultima citología',
                'is_bool' => 0
            ],
            [
                'nombre' => 'Peso fetal mayor',
                'is_bool' => 0
            ],
            [
                'nombre' => 'Exposición a químicos',
                'is_bool' => 0
            ],
            [
                'nombre' => 'Edad pareja',
                'is_bool' => 0
            ],
            [
                'nombre' => 'Fuma / café / alcohol',
                'is_bool' => 0
            ],
            [
                'nombre' => 'Alto riesgo',
                'is_bool' => 0
            ],
        ];
        foreach ($antecedentes as $antecedente){
            AntecedentesOtro::create([
                'nombre' => $antecedente['nombre'],
                'is_bool' => $antecedente['is_bool']
            ]);
        }
    }
}
