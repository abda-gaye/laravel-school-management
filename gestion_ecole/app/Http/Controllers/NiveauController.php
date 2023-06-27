<?php

namespace App\Http\Controllers;

use App\Http\Resources\NiveauCollection;
use App\Http\Resources\NiveauRessource;
use App\Models\Classe;
use App\Models\Niveau;
use App\Traits\JoinQueryParams;
use Illuminate\Http\Request;

class NiveauController extends Controller
{
   use JoinQueryParams;
   public function index(Request $request)
   {
     if (array_key_exists('join',$request->all())) {
        if (method_exists(Niveau::class,$request->input('join'))) {
            return NiveauRessource::collection(Niveau::with($request->input('join'))->get());
        }
        else
        {
            return ["message" => "route introuvable"];
        }

     }
     else{
        return Niveau::all()->map(function($niveau){
            return [
                'libelle' => $niveau->libelle,
                'id' => $niveau->id
            ];
        });
     }
   }
   public function find(Niveau $niveau)
   {
    //    return $niveau->load('classes');
   }



}
