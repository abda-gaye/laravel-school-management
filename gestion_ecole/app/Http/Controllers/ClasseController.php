<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClasseCollection;
use App\Http\Resources\ClasseRessource;
use App\Models\Classe;
use App\Models\Discipline;
use App\Models\Inscription;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function index()
    {
        return Inscription::with(['inscription'])->get();

    }

    public function find(Classe $classe)
    {
         return $classe->load('inscription');
    }

    public function insertDiscipline(Request $request){
        $discipline = Discipline::create([
            'libelle' => $request['libelle']
        ]);
        return $discipline;
    }

    public function allDiscipline(){
        return Discipline::all();
    }

}
