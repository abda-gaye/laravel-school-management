<?php

use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\DiscEleve;
use App\Models\Discipline;
use App\Models\Eleve;
use App\Models\Evaluation;
use App\Models\Inscription;
use App\Models\Semestre;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->integer('note_value');
            $table->foreignIdFor(Inscription::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(DiscEleve::class)->constrained()->cascadeOnDelete();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
