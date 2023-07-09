<?php

namespace Database\Seeders;

use App\Models\Semestre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SemestreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Semestre::insert([
            [
                'libelle'=>'semestre 1',
            ],
            [
                'libelle'=>'semestre 2',
            ],
            [
                'libelle'=>'semestre 3'
            ]
        ]);
    }
}
