<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Eleve extends Model
{
    use HasFactory;

    protected $fillable = [
        'prenom',
        'nom',
        'date_naissance',
        'profil',
        'lieu',
        'state',
        'sexe',
        'numero'
    ];

    public function inscription()
    {
        return $this->hasMany(Inscription::class);
    }

    // 0 interne

    // 1 externe

    public static function boot()
    {
        parent::boot();

        static::creating(function ($eleve) {
            if ($eleve->profil === 0 && $eleve->state===0) {
                $lastCode = self::getLastStudentCode();
                $nextCode = $lastCode + 1;
                $eleve->numero = $nextCode;
            }
        });

        static::deleting(function ($eleve) {
            if ($eleve->profil === 0 && $eleve->state===0) {
                self::handleStudentCodeReusability($eleve->numero);
            }
        });
    }

    protected static function getLastStudentCode()
    {
        $lastStudent = self::where('state', 0)->orderBy('numero', 'desc')->first();
        if ($lastStudent) {
            return $lastStudent->numero;
        } else {
            return 0;
        }
    }

    protected static function handleStudentCodeReusability($code)
    {
        $nextCode = $code + 1;
        while (self::where('profil', 0)->where('numero', $nextCode)->exists()) {
            $nextCode++;
        }

        DB::table('eleves')->where('state', 0)->where('numero', $code)->update(['numero' => $nextCode]);
    }

    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'inscriptions', 'eleve_id', 'classe_id');
    }
    protected $hidden = [
        'updated_at','created_at'
    ];
}
