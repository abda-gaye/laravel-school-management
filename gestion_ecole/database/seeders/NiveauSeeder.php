<?php

namespace Database\Seeders;

use App\Models\Classe;
use App\Models\Niveau;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Niveau::insert([
            [
                'libelle'=>'primaire',
            ],
            [
                'libelle'=>'secondaire',
            ],
            [
                'libelle'=>'moyen',
            ]
        ]);
    }
}
