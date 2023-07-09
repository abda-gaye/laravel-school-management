<?php
namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\DiscEleve;
use App\Models\Evaluation;
use App\Models\Semestre;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    // Autres méthodes du contrôleur

    /**
     * Store a newly created resource in storage for the specified class.
     */
    public function store(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $classe = Classe::find($id);

            if (!$classe) {
                return response()->json(['message' => 'Classe non trouvée'], 404);
            }

            $evaluation = Evaluation::create([
                'libelle' => $request['libelle']
            ]);
            $semestre = Semestre::create([
                'semestre_id' => $request['libelle']

            ]);

            $disceleve = new DiscEleve([
                "classe_id" => $classe->id,
                'annee_scolaire_id' => $request->annee_scolaire_id,
                'discipline_id' => $request->discipline_id,
                'evaluation_id' => $evaluation->id,
                'semestre_id' => $request->semestre_id,
                'note_max' => $request['note_max'],
            ]);

            $disceleve->save();
            DB::commit();
            return $evaluation;
        } catch (Exception $e) {
            dd($e);
            DB::rollBack();
        }
    }
}
