<?php

use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Discipline;
use App\Models\Evaluation;
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
        Schema::create('disc_eleves', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('note_max');
            $table->foreignIdFor(AnneeScolaire::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Discipline::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Classe::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Evaluation::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disc_eleves');
    }
};
