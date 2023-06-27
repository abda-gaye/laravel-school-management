<?php

namespace Database\Seeders;

use App\Models\Classe;
use App\Models\Niveau;
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
                "niveau_id" => Niveau::where('libelle','primaire')->first()->id
                ],
                [
                    "libelle"=> 'seconde',
                "niveau_id" => Niveau::where('libelle','secondaire')->first()->id
                ],
                [
                "libelle"=> '4 eme',
                "niveau_id" => Niveau::where('libelle','moyen')->first()->id
                ]
            ]);
    }
}
