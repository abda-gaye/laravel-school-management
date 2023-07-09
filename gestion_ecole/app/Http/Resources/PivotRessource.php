<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PivotRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [

        'discipline' => $this->discipline,
        'annee' => $this->anneeScolaire,
        'classe' => $this->classe,
        'evaluation' => $this->evaluation,
       ];
    }
}
