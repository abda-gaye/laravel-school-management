<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClasseCollection;
use App\Http\Resources\ClasseRessource;
use App\Models\Classe;
use App\Traits\JoinQueryParams;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function index()
    {
        return ClasseRessource::collection(Classe::all());
    }

}
