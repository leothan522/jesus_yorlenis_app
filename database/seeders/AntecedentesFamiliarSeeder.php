<?php

namespace Database\Seeders;

use App\Models\AntecedentesFamiliar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AntecedentesFamiliarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $antecedentes = [
            [
                'nombre' => 'Diabetes',
                'is_bool' => 1
            ],
            [
                'nombre' => 'Hipertensión',
                'is_bool' => 1
            ],
            [
                'nombre' => 'Gemelar',
                'is_bool' => 1
            ],
            [
                'nombre' => 'Cáncer',
                'is_bool' => 1
            ],
            [
                'nombre' => 'Nefropatía',
                'is_bool' => 1
            ],
            [
                'nombre' => 'Otros',
                'is_bool' => 0
            ],
        ];
        foreach ($antecedentes as $antecedente){
            AntecedentesFamiliar::create([
                'nombre' => $antecedente['nombre'],
                'is_bool' => $antecedente['is_bool']
            ]);
        }
    }
}
