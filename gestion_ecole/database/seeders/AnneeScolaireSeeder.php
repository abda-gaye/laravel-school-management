<?php

namespace Database\Seeders;

use App\Models\AnneeScolaire;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnneeScolaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AnneeScolaire::insert([
            [
                'libelle'=>'2021-2022',
            ],
            [
                'libelle'=>'2022-2023',
            ]
        ]);
    }
}
