<?php

namespace Database\Seeders;

use App\Models\Classe;
use App\Models\Niveau;
use App\Models\Semestre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            Classe::insert([
                [
                    "libelle"=> 'CE1',
                "niveau_id" => Niveau::where('libelle','primaire')->first()->id,
                "semestre_id" => Semestre::where('libelle','semestre 1')->first()->id
                ],
                [
                    "libelle"=> 'seconde',
                "niveau_id" => Niveau::where('libelle','secondaire')->first()->id,
                "semestre_id" => Semestre::where('libelle','semestre 2')->first()->id

                ],
                [
                "libelle"=> '4 eme',
                "niveau_id" => Niveau::where('libelle','moyen')->first()->id,
                "semestre_id" => Semestre::where('libelle','semestre 3')->first()->id

                ]
            ]);
    }
}
