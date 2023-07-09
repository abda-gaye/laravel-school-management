<?php

namespace App\Http\Controllers;

use App\Http\Resources\EleveRessource;
use App\Http\Resources\InscriptionRessource;
use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Inscription;
use DateInterval;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registerStudent = Inscription::with(['anneeScolaire', 'classe','eleve'])->get()->orderBy('prenom');
        return $registerStudent;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {

            $validator = Validator::make($request->all(), [
                'prenom' => 'required',
                'nom' => 'required',
                'date_naissance' => 'required|date_format:Y-m-d',"sometimes|before:today-5",
                'profil' => 'required|boolean',
                'state' => 'required|boolean',
                'sexe' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            } else {
                DB::beginTransaction();
                try{
                    $datenow = new DateTime(date("Y-m-d"));
                    $studentdatetime = $request->date_naissance;
                    $age= (new DateTime($studentdatetime))->add(new DateInterval("P5Y"));
                    if ($age->format("Y-m-d") > $datenow->format("Y-m-d")) {
                        dd("votre age est insuffisant");

                    }

                    $eleves =  Eleve::create([
                        'prenom' => $request->prenom,
                        'nom' => $request->nom,
                        'date_naissance' => $request->date_naissance,
                        'profil' => $request->profil,
                        'sexe' => $request->sexe,
                        'state' => $request->state
                    ]);
                    $inscriptions = new Inscription([
                        "classe_id" => $request['classe_id'],
                        'annee_scolaire_id'=>$request["annee_scolaire_id"],
                        'eleve_id'=>$eleves['id'],
                        "date_inscription" => now()
                    ]);
                    $inscriptions->save();
                    DB::commit();
                    return $eleves;
                }
                catch(Exception $e){
                    dd($e);
                    DB::rollBack();
                }





            }
        }

    }
    public function indexByClass($id)
    {
        $eleves = Classe::findOrFail($id)
            ->eleves()
            ->get();

        return EleveRessource::collection($eleves);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Eleve::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function sortie(Request $request)
    {
        return Eleve::whereIn('id', $request->all())->update(["state"=>1]);


    }
}
