<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscEleve extends Model
{
    use HasFactory;
    protected $guarded = [
        "id"
    ];

    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class);
    }

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }
}
