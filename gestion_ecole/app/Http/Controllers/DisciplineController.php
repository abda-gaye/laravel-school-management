<?php
namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\DiscEleve;
use App\Models\Discipline;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DisciplineController extends Controller
{
    public function index() {
        return Discipline::all();
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
                    "libelle" => "required|unique:disciplines",

                ]);
                if ($validator->fails()) {
                    return response()->json([
                        'errors' => $validator->errors()
                    ], 422);
                }

        $discipline = Discipline::create([
            'libelle' => $request['libelle']
        ]);
        return $discipline;
    }


    /**
     * Store a newly created resource in storage for the specified class.
     */
    // public function store(Request $request, $id)
    // {
    //     $validator = Validator::make($request->all(),[
    //         "libelle" => "required|unique:disciplines",
    //         "note_max" => "required|integer|min:10"

    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'errors' => $valida$validator = Validator::make($request->all(),[
    //         "libelle" => "required|unique:disciplines",
    //         "note_max" => "required|integer|min:10"

    //     ]);
    //     if ($validator->fails()) {
    //         return response()->json([
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }tor->errors()
    //         ], 422);
    //     }
    //     DB::beginTransaction();
    //     try {
    //         $classe = Classe::find($id);

    //         if (!$classe) {
    //             return response()->json(['message' => 'Classe non trouvée'], 404);
    //         }

    //         $discipline = Discipline::create([
    //             'libelle' => $request['libelle']
    //         ]);

    //         $disceleve = new DiscEleve([
    //             "classe_id" => $classe->id,
    //             'annee_scolaire_id' => $request->annee_scolaire_id,
    //             'discipline_id' => $request->discipline_id,
    //             'evaluation_id' => $request["evaluation_id"],
    //             'note_max' => $request['note_max'],
    //         ]);
    //         $disceleve->save();
    //         DB::commit();
    //         return $discipline;
    //     } catch (Exception $e) {
    //         dd($e);
    //         DB::rollBack();
    //     }
    // }
}
