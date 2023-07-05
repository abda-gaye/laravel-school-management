<?php

namespace App\Models;

use App\Traits\JoinQueryParams;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperNiveau
 */
class Niveau extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',

    ];
    public function classes()
    {
        return $this->hasMany(Classe::class);

    }

}
