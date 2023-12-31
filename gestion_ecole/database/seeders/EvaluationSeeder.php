<?php

namespace Database\Seeders;

use App\Models\Evaluation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Evaluation::insert([
            [
                'libelle'=>'devoir',
            ],
            [
                'libelle'=>'examen',
            ],
            [
                'libelle'=>'composition',
            ]
        ]);
    }
}
