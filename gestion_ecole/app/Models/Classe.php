<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperClasse
 */
class Classe extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
    ];
    public function eleves()
    {
        return $this->belongsToMany(Eleve::class, 'inscriptions', 'classe_id', 'eleve_id');
    }

}
