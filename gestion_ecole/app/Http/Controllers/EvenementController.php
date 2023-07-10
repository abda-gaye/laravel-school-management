<?php

namespace App\Http\Controllers;

use App\Mail\ParticipationConfirmationMail;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Evenement;
use EvenementCreatedMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Evenement::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validator = Validator::make([
        "libelle" => $request->libelle,
        "event_date" => $request->event_date,
        "classe_id" => $request->classe_id
    ],[
        "libelle" =>"required",
        "event_date" =>"required",
        "classe_id" =>"required",
    ])->validate();

    if (!$validator) {
        return response()->json(['errors' =>"Les données ne sont pas valides"]);
    }
    $evenement = new Evenement();
    $evenement->libelle = $request->libelle;
    $evenement->event_date = $request->event_date;
    $evenement->classe_id = $request->classe_id;
    $evenement->save();

    return $evenement;
}


    /**
     * Display the specified resource.
     */
    public function show(Evenement $evenement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evenement $evenement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evenement $evenement)
    {
        //
    }
    public function sendEmailsToParticipants($evenementId)
    {
        $evenement = Evenement::find($evenementId);

        if (!$evenement) {
            return ;
        }

        $participants = Eleve::join('inscriptions', 'eleves.id', '=', 'inscriptions.eleve_id')
        ->where('inscriptions.classe_id', $evenement->classe_id)
        ->get();

        foreach ($participants as $participant) {

            Mail::to($participant->email)->send(new ParticipationConfirmationMail($participant, $evenement));
        }

        $classe = Classe::find($evenement->classe_id);
        if ($classe) {
            $user = $classe->user;
            if ($user) {
                Mail::to($user->email)->send(new EvenementCreatedMail($evenement));
            }
        }

    }
}
