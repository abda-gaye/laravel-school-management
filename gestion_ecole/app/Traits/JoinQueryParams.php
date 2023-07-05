<?php
namespace App\Traits;

use App\Http\Resources\NiveauRessource;
use App\Models\Classe;
use App\Models\Niveau;
use Illuminate\Http\Request;

trait JoinQueryParams
{
    public function getClasseByLevel($relation)
   {
    return NiveauRessource::collection(Niveau::with($relation)->get());
   }
   public function getStudenteByClasse($relation)
   {
    return NiveauRessource::collection(Classe::with($relation)->get());
   }


}

