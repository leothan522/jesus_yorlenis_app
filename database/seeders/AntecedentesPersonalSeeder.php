<?php

namespace Database\Seeders;

use App\Models\AntecedentesPersonal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AntecedentesPersonalSeeder extends Seeder
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
                'nombre' => 'Cirugías',
                'is_bool' => 1
            ],
            [
                'nombre' => 'Asma',
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
            AntecedentesPersonal::create([
                'nombre' => $antecedente['nombre'],
                'is_bool' => $antecedente['is_bool']
            ]);
        }
    }
}
