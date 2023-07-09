<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClasseCollection;
use App\Http\Resources\ClasseRessource;
use App\Http\Resources\NoteRessource;
use App\Http\Resources\PivotRessource;
use App\Models\Classe;
use App\Models\DiscEleve;
use App\Models\Discipline;
use App\Models\Inscription;
use App\Models\Note;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ClasseController extends Controller
{
    public function index()
    {
        return Inscription::with(['inscription'])->get();

    }

    public function find(Classe $classe)
    {
         return $classe->load('inscription');
    }

    public function insertDiscipline(Request $request){
        $discipline = Discipline::create([
            'libelle' => $request['libelle']
        ]);
        return $discipline;
    }

    public function store(Request $request, $id)
     {
         $validator = Validator::make($request->all(),[
             "note_max" => "required|integer|min:10"

         ]);

         if ($validator->fails()) {
             return response()->json([
                 'errors' => $validator->errors()
             ], 422);

         }
         DB::beginTransaction();
         try {
             $classe = Classe::find($id);

             if (!$classe) {
                 return response()->json(['message' => 'Classe non trouvée'], 404);
             }


             $disceleve = new DiscEleve([
                 "classe_id" => $classe->id,
                 'annee_scolaire_id' => $request->annee_scolaire_id,
                 'discipline_id' => $request->discipline_id,
                 'evaluation_id' => $request["evaluation_id"],
                 'note_max' => $request['note_max'],
                 'semestre_id' => $request->semestre_id
             ]);
             $disceleve->save();
             DB::commit();
             return $disceleve;
         } catch (Exception $e) {
             dd($e);
             DB::rollBack();
         }
     }

     public function getAll(){
        // return DiscEleve::with(['anneeScolaire', 'classe','discipline','evaluation'])->get();
        return PivotRessource::collection(DiscEleve::all());

     }

     public function getDisciplineNotes($idclasse, $iddiscipline)
{
    $inscription = Inscription::where('classe_id', $idclasse)->firstOrFail();

    if (!$inscription) {
        return response()->json(['message' => 'Inscription non trouvée'], 404);
    }

    $disc_eleve = DiscEleve::where('discipline_id', $iddiscipline)
    ->where('classe_id', $idclasse)->firstOrFail();

    if (!$disc_eleve) {
        return response()->json(['message' => 'Relation DiscEleve non trouvée'], 404);
    }

    $note = Note::where('inscription_id', $inscription->id)
        ->where('disc_eleve_id', $disc_eleve->id)->firstOrFail();

    if (!$note) {
        return response()->json(['message' => 'Note non trouvée'], 404);
    }

    return new NoteRessource($note);
}

public function getAllNotesOfClass($idclasse)
{
    $inscription = Inscription::where('classe_id',$idclasse)->first();
    if (!$inscription) {
        return response()->json(['message' => 'Inscription non trouvée'], 404);
    }
    $inscription_id = $inscription->id;
    $note = Note::where('inscription_id',$inscription_id)->get();
    return $note;


}

public function getNoteOfEleveInClass($classeId, $eleveId){
    $inscription = Inscription::where('eleve_id',$eleveId)
    ->where('classe_id',$classeId)->first();
    $note = Note::where('inscription_id',$inscription->id)->get();
     return $note;
}




}
