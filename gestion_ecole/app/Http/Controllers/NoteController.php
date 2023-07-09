<?php

namespace App\Http\Controllers;

use App\Models\DiscEleve;
use App\Models\Inscription;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $idClasse, $idDisc, $idEval)
{
    // Récupérer les enregistrements pertinents
    $discEleve = DiscEleve::where('classe_id', $idClasse)
        ->where('discipline_id', $idDisc)
        ->where('evaluation_id', $idEval)
        ->firstOrFail();
    // Tableau pour stocker les notes ajoutées avec succès
    $successNotes = [];

    // Parcourir les données des notes pour chaque étudiant
    foreach ($request->notes as $noteData) {
        $eleveId = $noteData['eleve_id'];
        $noteValue = $noteData['note_value'];
        if ($noteValue > $discEleve->note_max) {
        return response()->json(['message' => 'la note est superieure à la note max']);
        }
        if ($noteValue < 0) {
        return response()->json(['message' => 'la note ne peut pas être negative']);

        }
        // Récupérer l'inscription de l'étudiant
        $inscription = Inscription::where('classe_id', $idClasse)
            ->where('eleve_id', $eleveId)
            ->firstOrFail();

        // Ajouter une nouvelle note
        $note = Note::firstOrCreate([
            'inscription_id' => $inscription->id,
            'disc_eleve_id' => $discEleve->id,
        ],
        [
        'note_value' => $noteValue
        ]);

        // Ajouter la note à la liste des notes ajoutées avec succès
        $successNotes[] = $note;
    }

    // Retourner une réponse appropriée avec les notes ajoutées
    return response()->json(['message' => 'Notes ajoutées avec succès', 'notes' => $successNotes]);
}


    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        //
    }
}
