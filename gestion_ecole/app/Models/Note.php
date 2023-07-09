<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function eleve()
    {
        return $this->belongsTo(Eleve::class);
    }
    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }
    public function semestre()
    {
        return $this->belongsTo(Semestre::class);
    }
    protected $hidden = [
        'updated_at','created_at'
    ];

    protected $guarded =
    [
        'id'
    ];
}
