<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InscriptionRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "prenom" => $this->eleve->prenom,
            "nom"=>$this->eleve->nom,
            "libelle" => $this->classe->libelle,
            "annee_scolaire" => $this->anneeScolaire->libelle
            
        ];

    }
}
